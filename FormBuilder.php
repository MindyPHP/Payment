<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment;

class FormBuilder
{
    public static function build($url, array $data)
    {
        $hiddenFields = '';
        foreach ($data as $key => $value) {
            $hiddenFields .= sprintf(
                    '<input type="hidden" name="%1$s" value="%2$s" />',
                    htmlentities((string)$key, ENT_QUOTES, 'UTF-8', false),
                    htmlentities((string)$value, ENT_QUOTES, 'UTF-8', false)
                )."\n";
        }
        $output = '<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Redirecting...</title>
    </head>
    <body onload="document.forms[0].submit();">
        <form action="%1$s" method="post">
            <div>Redirecting to payment page...</div>
            <div>
                %2$s
                <input type="submit" value="Continue" />
            </div>
        </form>
    </body>
</html>';

        return sprintf($output, htmlentities($url, ENT_QUOTES, 'UTF-8', false), $hiddenFields);
    }
}
