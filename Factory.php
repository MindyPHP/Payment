<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment;

class Factory
{
    /**
     * @var array|GatewayInterface[]
     */
    protected $gateways = [];

    /**
     * @var bool
     */
    protected $testMode = false;

    /**
     * Factory constructor.
     *
     * @param bool $testMode
     */
    public function __construct(bool $testMode = false)
    {
        $this->testMode = $testMode;
    }

    /**
     * @param array|GatewayInterface[] $gateways
     */
    public function setGateways(array $gateways)
    {
        $this->gateways = $gateways;
    }

    /**
     * @param $id
     *
     * @throws \RuntimeException
     *
     * @return GatewayInterface
     */
    public function getGateway($id)
    {
        if (isset($this->gateways[$id])) {
            $gateway = $this->gateways[$id];
            $gateway->setTestMode($this->testMode);

            return $gateway;
        }

        throw new \RuntimeException('Unknown payment gateway');
    }

    /**
     * @return GatewayInterface[]
     */
    public function getGateways()
    {
        return $this->gateways;
    }
}
