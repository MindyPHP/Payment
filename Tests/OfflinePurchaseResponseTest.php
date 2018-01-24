<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment\Tests;

use Mindy\Payment\OfflinePurchaseResponse;
use PHPUnit\Framework\TestCase;

class OfflinePurchaseResponseTest extends TestCase
{
    public function testOfflinePurchaseResponse()
    {
        $resp = new OfflinePurchaseResponse();
        $this->assertFalse($resp->isSuccess());
        $this->assertFalse($resp->isCancelled());
        $this->assertFalse($resp->isRedirect());
        $this->assertNull($resp->getError());
        $this->assertNull($resp->getRedirectUrl());
    }
}
