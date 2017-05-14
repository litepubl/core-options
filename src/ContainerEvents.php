<?php

namespace litepubl\core\options;

use litepubl\core\container\EventsInterface as ContainerEventsInterface;
use litepubl\core\storage\StorageAware;

class ContainerEvents implements ContainerEventsInterface, StorageAware
{
    const RESULT = 'result';
    const INSTANCE = 'instance';
    const CLASSNAME = 'className';
    protected $eventManager;

    public function __construct(EventsInterface $eventManager)
    {
        $this->eventManager = $eventManager;
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
        $a = $this->eventManager->call('onBeforeGet', [static::CLASSNAME => $className, static::RESULT => null]);
        return a[static::RESULT];
    }

    public function onAfterGet(string $className, $instance)
    {
        $this->eventManager->call('onAfterGet', [static::CLASSNAME => $className, static::INSTANCE => $instance]);
    }

    public function onSet($instance, string $name)
    {
        $this->eventManager->call('onSet', ['name' => $name, static::INSTANCE => $instance]);
    }

    public function onBeforeCreate(string $className)
    {
        $a = $this->eventManager->call('onBeforeGet', [static::CLASSNAME => $className, static::RESULT => null]);
        return a[static::RESULT];
    }

    public function onAfterCreate(string $className, $instance)
    {
        $this->eventManager->call('onAfterCreate', [static::CLASSNAME => $className, static::INSTANCE => $instance]);
    }

    public function onNotFound(string $className)
    {
        $a = $this->eventManager->call('onBeforeGet', [static::CLASSNAME => $className, static::RESULT => null]);
        return a[static::RESULT];
    }
}
