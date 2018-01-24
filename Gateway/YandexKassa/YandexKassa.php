<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment\Gateway\YandexKassa;

use Mindy\Payment\AbstractGateway;
use Mindy\Payment\PurchaseParametersInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;

class YandexKassa extends AbstractGateway
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired(['shopId', 'scId', 'shop_password']);
    }

    public function purchase(PurchaseParametersInterface $parameters)
    {
        $order = $parameters->getOrder();
        $customer = $parameters->getCustomer();

        $payParameters = array_merge($this->getParameters()->all(), [
            'sum' => $this->formatAmount($order->getPrice()),
            'orderNumber' => $order->getId(),
            'customerNumber' => $customer->getId(),
            'cps_phone' => $customer->getPhone(),
            'cps_email' => $customer->getEmail(),
        ]);

        return new YandexKassaPurchaseResponse($payParameters, $this->testMode);
    }

    protected function generateHash(Request $request)
    {
        $hashString = implode(';', [
            $request->request->get('action'),
            $request->request->get('orderSumAmount'),
            $request->request->get('orderSumCurrencyPaycash'),
            $request->request->get('orderSumBankPaycash'),
            $this->parameters->get('shopId'),
            $request->request->get('invoiceId'),
            $request->request->get('customerNumber'),
            $this->parameters->get('shop_password'),
        ]);

        return strtolower(md5($hashString));
    }

    public function validate(Request $request)
    {
        $content = sprintf(
            '<?xml version="1.0" encoding="UTF-8"?><checkOrderResponse performedDatetime="%s" code="%s" invoiceId="%s" shopId="%s"/>',
            $request->request->get('requestDatetime'),
            $this->validateCode($request),
            $request->request->get('invoiceId'),
            $this->parameters->get('shopId')
        );

        return $this->xml($content);
    }

    /**
     * @param Request $request
     *
     * @return int
     */
    protected function validateCode(Request $request)
    {
        // 1 - failure
        // 0 - success
        return (int) $this->generateHash($request) != strtolower($request->request->get('md5'));
    }

    public function complete(Request $request)
    {
        $content = sprintf(
            '<?xml version="1.0" encoding="UTF-8"?><paymentAvisoResponse performedDatetime="%s" code="%s" invoiceId="%s" shopId="%s"/>',
            $request->request->get('requestDatetime'),
            $this->validateCode($request),
            $request->request->get('invoiceId'),
            $this->parameters->get('shopId')
        );

        return $this->xml($content);
    }
}
