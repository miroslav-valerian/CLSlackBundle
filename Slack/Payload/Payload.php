<?php

namespace CL\Bundle\SlackBundle\Slack\Payload;

use CL\Bundle\SlackBundle\Slack\Payload\Type\TypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Payload implements PayloadInterface
{
    /**
     * @var TypeInterface
     */
    protected $type;

    /**
     * @var array
     */
    protected $options = array();

    /**
     * {@inheritdoc}
     */
    public function __construct(TypeInterface $type)
    {
        $this->type = $type;
    }

    /**
     * Sets options
     *
     * @param array $options
     *
     * @return Payload
     */
    public function setOptions(array $options)
    {
        $this->options = $this->resolveOptions($options);

        return $this;
    }

    /**
     * Returns options
     *
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Resolves options
     *
     * @param array           $options
     * @param OptionsResolver $resolver
     *
     * @return array
     */
    protected function resolveOptions(array $options, OptionsResolver $resolver = null)
    {
        $resolver = $resolver ? : new OptionsResolver();

        $this->type->setDefaultOptions($resolver);

        return $resolver->resolve($options);
    }
}
