<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment\Gateway\YandexKassa;

use Mindy\Payment\AbstractFormResponse;
use Mindy\Payment\FormBuilder;
use Symfony\Component\OptionsResolver\OptionsResolver;

class YandexKassaPurchaseResponse extends AbstractFormResponse
{
    /**
     *{@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'cps_email' => null,
            'cps_phone' => null,
            'customerNumber' => null,
        ]);
        $resolver->setRequired([
            'orderNumber',
            'scId',
            'shopId',
            'shop_password',
            'sum',
        ]);
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        if ($this->testMode) {
            return 'https://demomoney.yandex.ru/eshop.xml';
        }

        return 'http://money.yandex.ru/eshop.xml';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(): string
    {
        return FormBuilder::build($this->getEndpoint(), $this->parameters->all());
    }
}
