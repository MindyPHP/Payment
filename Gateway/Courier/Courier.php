<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment\Gateway\Courier;

use Mindy\Payment\AbstractGateway;
use Mindy\Payment\OfflineGatewayInterface;
use Mindy\Payment\OfflinePurchaseResponse;
use Mindy\Payment\PurchaseParametersInterface;

class Courier extends AbstractGateway implements OfflineGatewayInterface
{
    /**
     * {@inheritdoc}
     */
    public function purchase(PurchaseParametersInterface $parameters)
    {
        return new OfflinePurchaseResponse();
    }
}
