<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment\Tests;

use Mindy\Payment\FormBuilder;
use PHPUnit\Framework\TestCase;

class FormBuilderTest extends TestCase
{
    public function testFormBuilder()
    {
        $output = FormBuilder::build('https://example.com', [
            'foo' => 'bar',
        ]);
        $this->assertSame('<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Redirecting...</title>
    </head>
    <body onload="document.forms[0].submit();">
        <form action="https://example.com" method="post">
            <div>Redirecting to payment page...</div>
            <div>
                <input type="hidden" name="foo" value="bar" />

                <input type="submit" value="Continue" />
            </div>
        </form>
    </body>
</html>', $output);
    }
}
