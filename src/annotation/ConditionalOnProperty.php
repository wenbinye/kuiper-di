<?php

declare(strict_types=1);

namespace kuiper\di\annotation;

use kuiper\helper\PropertyResolverInterface;
use Psr\Container\ContainerInterface;

/**
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 */
class ConditionalOnProperty implements Conditional
{
    /**
     * @var string
     */
    public $value;

    /**
     * @var string
     */
    public $hasValue;

    /**
     * @var bool
     */
    public $matchIfMissing = false;

    public function match(ContainerInterface $container): bool
    {
        if (!$container->has(PropertyResolverInterface::class)) {
            throw new \InvalidArgumentException(PropertyResolverInterface::class.' should be registered in container');
        }
        $value = $container->get(PropertyResolverInterface::class)->get($this->value);
        if (isset($value)) {
            if (isset($this->hasValue)) {
                return (string) $value === $this->hasValue;
            }

            return true;
        }

        return $this->matchIfMissing;
    }
}
