<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment;

class OfflinePurchaseResponse implements ResponseInterface
{
    /**
     * {@inheritdoc}
     */
    public function isSuccess(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isRedirect(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isCancelled(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getError()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getRedirectUrl()
    {
        return null;
    }
}
