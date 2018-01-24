<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment;

interface ResponseInterface
{
    /**
     * @return bool
     */
    public function isSuccess();

    /**
     * @return bool
     */
    public function isRedirect();

    /**
     * @return bool
     */
    public function isCancelled();

    /**
     * @return string
     */
    public function getError();

    /**
     * @return string
     */
    public function getRedirectUrl();
}
