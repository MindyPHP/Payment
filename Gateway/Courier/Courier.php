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
use Mindy\Payment\PurchaseParameters;
use Mindy\Payment\PurchaseParametersInterface;
use Mindy\Payment\ResponseInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method ResponseInterface validate(Request $request)
 * @method ResponseInterface complete(PurchaseParameters $parameters)
 */
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
