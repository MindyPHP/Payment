<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment\SberbankPre;

use Mindy\Payment\Gateway\Sberbank\Sberbank;
use Mindy\Payment\PrePaymentInterface;

class SberbankPre extends Sberbank implements PrePaymentInterface
{
    public function getName()
    {
        return 'Предоплата 50% с помощью Сбербанк Онлайн';
    }
}
