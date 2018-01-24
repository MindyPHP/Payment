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

abstract class AbstractFormResponse implements FormResponseInterface
{
    use ParametersAwareTrait;
    use TestModeTrait;

    /**
     * AbstractFormResponse constructor.
     *
     * @param array $parameters
     * @param bool  $testMode
     */
    public function __construct(array $parameters = [], bool $testMode = false)
    {
        $optionsResolver = $this->getOptionsResolver();
        $this->configureOptions($optionsResolver);
        $this->createParameters($parameters);
        $this->setTestMode($testMode);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * @return string
     */
    abstract public function getEndpoint(): string;

    /**
     * @return array
     */
    public function getFormParameters(): array
    {
        return $this->parameters->all();
    }

    /**
     * @return string
     */
    public function buildForm(): string
    {
        return FormBuilder::build($this->getEndpoint(), $this->getFormParameters());
    }
}
