<?php

declare(strict_types=1);

namespace kuiper\di\annotation;

use kuiper\di\ComponentCollection;
use ReflectionClass;

trait ComponentTrait
{
    /**
     * @var ReflectionClass
     */
    protected $class;

    public function setTarget($class): void
    {
        /* @var ReflectionClass $class */
        ComponentCollection::register($class, $this);
        $this->class = $class;
    }

    public function getTarget(): ReflectionClass
    {
        return $this->class;
    }

    public function handle(): void
    {
    }
}
