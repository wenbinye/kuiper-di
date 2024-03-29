<?php

declare(strict_types=1);

namespace kuiper\di;

use DI\Definition\Source\DefinitionSource;
use DI\Definition\ValueDefinition;
use kuiper\helper\PropertyResolverInterface;

class PropertiesDefinitionSource implements DefinitionSource
{
    /**
     * @var PropertyResolverInterface
     */
    private $properties;

    /**
     * @var string
     */
    private $prefix;

    /**
     * PropertiesDefinitionSource constructor.
     */
    public function __construct(PropertyResolverInterface $properties, string $prefix = 'application.')
    {
        $this->properties = $properties;
        $this->prefix = $prefix;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefinition(string $name)
    {
        $value = $this->properties->get($name);
        if (null !== $value || 0 === strpos($name, $this->prefix)) {
            return new ValueDefinition($value);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefinitions(): array
    {
        return [];
    }
}
