<?php

namespace litepubl\core\options;

use litepubl\core\container\EventsInterface;
use litepubl\core\container\ContainerInterface;
use litepubl\core\storage\StorageAware;
use litepubl\core\events\EventManagerInterface;

class ContainerEvents implements EventsInterface, StorageAware
{
    const RESULT = 'result';
    const INSTANCE = 'instance';
    const CLASSNAME = 'className';

    protected $container;
    protected $eventManager;

    public function __construct(EventManagerInterface $eventManager)
    {
        $this->eventManager = $eventManager;
    }

    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;
        $this->load();
    }

    public function getBaseName(): string
    {
        return 'containerEvents';
    }

    public function onBeforeGet(string $className)
    {
        $a = $this->eventManager->trigger('onBeforeGet', $this->container, [static::CLASSNAME => $className, static::RESULT => null]);
        return a[static::RESULT];
    }

    public function onAfterGet(string $className, $instance)
    {
        $this->eventManager->trigger('onAfterGet', $this->container, [static::CLASSNAME => $className, static::INSTANCE => $instance]);
    }

    public function onSet($instance, string $name)
    {
        $this->eventManager->trigger('onSet', $this->container, ['name' => $name, static::INSTANCE => $instance]);
    }

    public function onBeforeCreate(string $className)
    {
        $a = $this->eventManager->trigger('onBeforeGet', $this->container, [static::CLASSNAME => $className, static::RESULT => null]);
        return a[static::RESULT];
    }

    public function onAfterCreate(string $className, $instance)
    {
        $this->eventManager->trigger('onAfterCreate', $this->container, [static::CLASSNAME => $className, static::INSTANCE => $instance]);
    }

    public function onNotFound(string $className)
    {
        $a = $this->eventManager->trigger('onBeforeGet', $this->container, [static::CLASSNAME => $className, static::RESULT => null]);
        return a[static::RESULT];
    }
}
