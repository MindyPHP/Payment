<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment;

interface OrderInterface
{
    /**
     * @return int|float|string
     */
    public function getPrice(): float;

    /**
     * @return string|int
     */
    public function getId();
}
