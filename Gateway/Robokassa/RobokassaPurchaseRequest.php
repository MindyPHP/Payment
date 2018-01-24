<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Modules\Payment\Gateway\Robokassa;

use Omnipay\Common\Message\AbstractRequest;

class RobokassaPurchaseRequest extends AbstractRequest
{
    use RobokassaTrait;

    public function getData()
    {
        $this->validate('MerchantLogin', 'InvId', 'amount', 'currency');

        return [
            'MerchantLogin' => $this->getMerchantLogin(),
            'OutSum' => $this->getAmount(),
            'InvId' => $this->getInvId(),
            'IncCurrLabel' => $this->getCurrency(),
            'SignatureValue' => $this->getSignatureValue(),
        ];
    }

    public function sendData($data)
    {
        return $this->response = new RobokassaPurchaseResponse($this, $data);
    }
}
