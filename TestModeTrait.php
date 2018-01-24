<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment;

trait TestModeTrait
{
    /**
     * @var bool
     */
    protected $testMode = false;

    /**
     * @param bool $testMode
     */
    public function setTestMode(bool $testMode)
    {
        $this->testMode = $testMode;
    }

    /**
     * @return bool
     */
    public function getTestMode(): bool
    {
        return $this->testMode;
    }
}
