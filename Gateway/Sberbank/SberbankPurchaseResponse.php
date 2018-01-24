<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment\Gateway\Sberbank;

use Mindy\Payment\AbstractResponse;
use Mindy\Payment\OrderNumberInterface;

class SberbankPurchaseResponse extends AbstractResponse implements OrderNumberInterface
{
    /**
     * @return bool
     */
    public function isSuccess()
    {
        return false;
    }

    public function getOrderNumber()
    {
        $parameters = json_decode($this->response->getBody(), true);

        return $parameters['orderId'];
    }

    /**
     * @return bool
     */
    public function isRedirect()
    {
        if (200 === $this->response->getStatusCode()) {
            $parameters = json_decode($this->response->getBody(), true);
            if (isset($parameters['orderId'], $parameters['formUrl'])) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    public function isCancelled()
    {
        // TODO: Implement isCancelled() method.
    }

    /**
     * @return string
     */
    public function getError()
    {
        return (string) $this->response->getBody();
    }

    /**
     * @return string
     */
    public function getRedirectUrl()
    {
        $json = json_decode($this->response->getBody(), true);

        return $json['formUrl'];
    }
}
