<?php

namespace litepubl\core\options;

use litepubl\core\container\factories\Items;
use litepubl\core\storage\StorableTrait;
use litepubl\core\storage\StorageInterface;

class Factories extends Items
{
    use StorableTrait;

    public function __construct(ContainerInterface $container, StorageInterface $storage)
    {
        parent::__construct($container, [], []);
        $this->storage = $storage;
        $this->load();
    }

    public function getBaseName(): string
    {
        return 'factories';
    }

    public function getData(): array
    {
        return [
        'items' => $this->items,
        'implementations' => $this->implementations,
        ];
    }

    public function setData(array $data): void
    {
        $this->items = $data['items'];
        $this->implementations = $data['implementations'];
    }

    public function set(string $className, string $factoryClass)
    {
        $this->items[$className] = $factoryClass;
        $this->save();
    }

    public function setImplementation(string $className, string $implementationClass)
    {
        $this->implementations[$className] = $implementationClass;
        $this->save();
    }
}
