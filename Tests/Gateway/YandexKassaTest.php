<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment\Tests\Gateway;

use Mindy\Payment\FormResponseInterface;
use Mindy\Payment\Gateway\YandexKassa\YandexKassa;
use Mindy\Payment\Gateway\YandexKassa\YandexKassaPurchaseResponse;
use Mindy\Payment\PurchaseParameters;
use Mindy\Payment\Tests\MockAttempt;
use Mindy\Payment\Tests\MockCustomer;
use Mindy\Payment\Tests\MockOrder;
use PHPUnit\Framework\TestCase;

class YandexKassaTest extends TestCase
{
    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\MissingOptionsException
     */
    public function testGatewayOptionsException()
    {
        new YandexKassa();
    }

    public function testYandexKassaPurchaseResponse()
    {
        $r = new YandexKassaPurchaseResponse([
            'orderNumber' => '',
            'scId' => '',
            'shopId' => '',
            'shop_password' => '',
            'sum' => '',
        ], true);
        $this->assertSame('https://demomoney.yandex.ru/eshop.xml', $r->getEndpoint());
        $r->setTestMode(false);
        $this->assertSame('http://money.yandex.ru/eshop.xml', $r->getEndpoint());
    }

    public function testGateway()
    {
        $y = new YandexKassa(['scId' => 1, 'shopId' => 1, 'shop_password' => 1]);
        $this->assertFalse($y->getTestMode());
        $y->setTestMode(true);
        $this->assertTrue($y->getTestMode());

        $purchaseParameters = new PurchaseParameters();
        $purchaseParameters->setOrder(new MockOrder(1, 100));
        $purchaseParameters->setAttempt(new MockAttempt(1));
        $purchaseParameters->setCustomer(new MockCustomer(['id' => 1]));

        $response = $y->purchase($purchaseParameters);
        $this->assertInstanceOf(YandexKassaPurchaseResponse::class, $response);
        $this->assertInstanceOf(FormResponseInterface::class, $response);

        $this->assertSame('<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Redirecting...</title>
    </head>
    <body onload="document.forms[0].submit();">
        <form action="https://demomoney.yandex.ru/eshop.xml" method="post">
            <div>Redirecting to payment page...</div>
            <div>
                <input type="hidden" name="cps_email" value="" />
<input type="hidden" name="cps_phone" value="" />
<input type="hidden" name="customerNumber" value="1" />
<input type="hidden" name="scId" value="1" />
<input type="hidden" name="shopId" value="1" />
<input type="hidden" name="shop_password" value="1" />
<input type="hidden" name="sum" value="100.00" />
<input type="hidden" name="orderNumber" value="1" />

                <input type="submit" value="Continue" />
            </div>
        </form>
    </body>
</html>', $response->buildForm());
    }
}
