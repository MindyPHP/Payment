<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Payment;

use Symfony\Component\OptionsResolver\OptionsResolver;

trait ParametersAwareTrait
{
    /**
     * @var Parameters
     */
    protected $parameters;
    /**
     * @var OptionsResolver
     */
    protected $optionsResolver;

    /**
     * @return OptionsResolver
     */
    public function getOptionsResolver(): OptionsResolver
    {
        if (null === $this->optionsResolver) {
            $this->optionsResolver = new OptionsResolver();
        }

        return $this->optionsResolver;
    }

    /**
     * @return Parameters
     */
    public function getParameters(): Parameters
    {
        if (null === $this->parameters) {
            $this->parameters = new Parameters($this->getDefaultParameters());
        }

        return $this->parameters;
    }

    /**
     * @param array $parameters
     */
    protected function createParameters(array $parameters)
    {
        $result = array_merge($this->getDefaultParameters(), $parameters);
        $this->parameters = new Parameters($this->optionsResolver->resolve($result));
    }

    /**
     * @return array
     */
    protected function getDefaultParameters(): array
    {
        return [];
    }
}
