<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\ParameterBag;

/**
 * Class AbstractRequest.
 */
abstract class AbstractRequest implements RequestInterface
{
    /**
     * @var ParameterBag
     */
    protected $parameterBag;
    /**
     * @var bool
     */
    protected $testMode;
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * AbstractRequest constructor.
     *
     * @param array $parameters
     * @param bool  $testMode
     */
    public function __construct(array $parameters = [], $testMode = false)
    {
        $this->parameterBag = new ParameterBag($parameters);
        $this->testMode = $testMode;
    }

    public function getParameters()
    {
        return $this->parameterBag->all();
    }

    /**
     * @return Client
     */
    protected function getHttpClient()
    {
        if (null === $this->httpClient) {
            $this->httpClient = new Client();
        }

        return $this->httpClient;
    }

    /**
     * @return string
     */
    abstract public function getEndpoint();

    /**
     * @return ResponseInterface
     */
    public function send()
    {
        return $this
            ->getHttpClient()
            ->request('POST', $this->getEndpoint(), $this->parameterBag->all());
    }
}
