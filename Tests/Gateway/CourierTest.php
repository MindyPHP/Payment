<?php
/**
 * Created by IntelliJ IDEA.
 * User: max
 * Date: 24/01/2018
 * Time: 16:40
 */

namespace Mindy\Payment\Tests\Gateway;

use Mindy\Payment\Gateway\Courier\Courier;
use Mindy\Payment\OfflinePurchaseResponse;
use Mindy\Payment\PurchaseParameters;
use Mindy\Payment\Tests\MockAttempt;
use Mindy\Payment\Tests\MockCustomer;
use Mindy\Payment\Tests\MockOrder;
use PHPUnit\Framework\TestCase;

class CourierTest extends TestCase
{
    public function testGateway()
    {
        $purchaseParameters = new PurchaseParameters();
        $purchaseParameters->setOrder(new MockOrder(1, 100));
        $purchaseParameters->setAttempt(new MockAttempt(1));
        $purchaseParameters->setCustomer(new MockCustomer(['id' => 1]));

        $gateway = new Courier();
        $response = $gateway->purchase($purchaseParameters);
        $this->assertInstanceOf(OfflinePurchaseResponse::class, $response);
    }
}
