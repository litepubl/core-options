<?php

namespace litepubl\core\options;

use litepubl\core\container\DI\Args;
use litepubl\core\storage\storables\StorableInterface;
use litepubl\core\storage\storables\AgregatableInterface;
use litepubl\core\data\ItemsStorableTrait;

class DIArgs extends Args implements StorabbleInterface, AgregatableInterface
{
    use ItemsStorableTrait;
    use StorableAwareTrait;

    protected $baseName = 'diargs';

    public function set(string $className, array $args)
    {
        parent::set($className, $args);
        $this->saveable->save();
    }
}
