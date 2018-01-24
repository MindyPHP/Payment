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
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerAwareTrait;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class AbstractGateway implements GatewayInterface
{
    use TestModeTrait;
    use ParametersAwareTrait;
    use LoggerAwareTrait;

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * AbstractGateway constructor.
     *
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $optionsResolver = $this->getOptionsResolver();
        $this->configureOptions($optionsResolver);
        $this->createParameters($parameters);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * @return ClientInterface
     */
    protected function getDefaultHttpClient(): ClientInterface
    {
        if (null === $this->httpClient) {
            $this->httpClient = new Client();
        }
        return $this->httpClient;
    }

    protected function formatAmount($amount)
    {
        return number_format($amount, 2, '.', '');
    }

    /**
     * {@inheritdoc}
     */
    public function supportValidate(): bool
    {
        return method_exists($this, 'validate');
    }

    /**
     * {@inheritdoc}
     */
    public function supportComplete(): bool
    {
        return method_exists($this, 'complete');
    }

    /**
     * @param string $content
     *
     * @return Response
     */
    public function xml(string $content): Response
    {
        return new Response($content, 200, [
            'Content-Type' => 'text/xml',
        ]);
    }
}
