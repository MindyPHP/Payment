<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment\Tests;

use Mindy\Payment\OrderInterface;

class MockOrder implements OrderInterface
{
    protected $id;
    protected $price;

    /**
     * MockOrder constructor.
     *
     * @param $id
     * @param $price
     */
    public function __construct($id, $price)
    {
        $this->id = $id;
        $this->price = $price;
    }

    /**
     * @return int|float|string
     */
    public function getPrice(): float
    {
        return (float) $this->price;
    }

    /**
     * @return string|int
     */
    public function getId()
    {
        return $this->id;
    }
}
