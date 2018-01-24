<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface GatewayInterface.
 *
 * @method ResponseInterface validate(Request $request)
 * @method ResponseInterface complete(PurchaseParameters $parameters)
 */
interface GatewayInterface
{
    /**
     * @param bool $testMode
     */
    public function setTestMode(bool $testMode);

    /**
     * @param PurchaseParametersInterface $parameters
     *
     * @return ResponseInterface
     */
    public function purchase(PurchaseParametersInterface $parameters);

    /**
     * @return bool
     */
    public function supportValidate(): bool;

    /**
     * @return bool
     */
    public function supportComplete(): bool;
}
