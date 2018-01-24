<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment\Tests;

use Mindy\Payment\AttemptInterface;
use Mindy\Payment\CustomerInterface;
use Mindy\Payment\OrderInterface;
use Mindy\Payment\PurchaseParameters;
use PHPUnit\Framework\TestCase;

class PurchaseParametersTest extends TestCase
{
    public function testParameters()
    {
        $p = new PurchaseParameters();

        $order = $this->getMockBuilder(OrderInterface::class)->getMock();
        $customer = $this->getMockBuilder(CustomerInterface::class)->getMock();
        $attempt = $this->getMockBuilder(AttemptInterface::class)->getMock();

        $p->setAttempt($attempt);
        $p->setCustomer($customer);
        $p->setOrder($order);

        $this->assertInstanceOf(AttemptInterface::class, $p->getAttempt());
        $this->assertInstanceOf(CustomerInterface::class, $p->getCustomer());
        $this->assertInstanceOf(OrderInterface::class, $p->getOrder());
    }
}
