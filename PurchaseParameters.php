<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment;

class PurchaseParameters implements PurchaseParametersInterface
{
    /**
     * @var OrderInterface
     */
    protected $order;
    /**
     * @var CustomerInterface
     */
    protected $customer;
    /**
     * @var AttemptInterface
     */
    protected $attempt;

    /**
     * @return OrderInterface
     */
    public function getOrder(): OrderInterface
    {
        return $this->order;
    }

    /**
     * @param OrderInterface $order
     */
    public function setOrder(OrderInterface $order)
    {
        $this->order = $order;
    }

    /**
     * @return CustomerInterface
     */
    public function getCustomer(): CustomerInterface
    {
        return $this->customer;
    }

    /**
     * @param CustomerInterface $customer
     */
    public function setCustomer(CustomerInterface $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return AttemptInterface
     */
    public function getAttempt(): AttemptInterface
    {
        return $this->attempt;
    }

    /**
     * @param AttemptInterface $attempt
     */
    public function setAttempt(AttemptInterface $attempt)
    {
        $this->attempt = $attempt;
    }
}
