<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment\Tests;

use Mindy\Payment\Parameters;
use Mindy\Payment\ParametersAwareTrait;
use PHPUnit\Framework\TestCase;

class UseParameters
{
    use ParametersAwareTrait;
}

class ParametersTest extends TestCase
{
    public function testParameters()
    {
        $p = new Parameters(['foo' => 'bar', 'hello' => 'world']);
        $this->assertCount(2, $p->all());
        $this->assertTrue($p->has('foo'));

        $p->remove('hello');
        $this->assertCount(1, $p->all());

        $p->set('hello', 'world');
        $this->assertCount(2, $p->all());
        $this->assertSame('yo', $p->get('unknown', 'yo'));
        $this->assertNull($p->get('unknown'));

        $p->replace(['yo' => 'yo']);
        $this->assertSame(['yo' => 'yo'], $p->all());
    }

    public function testParametersAwareTrait()
    {
        $p = new UseParameters();
        $this->assertInstanceOf(Parameters::class, $p->getParameters());
        $this->assertCount(0, $p->getParameters()->all());
    }
}
