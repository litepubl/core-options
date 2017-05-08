<?php

namespace litepubl\core\options;

use litepubl\core\container\DI\Args as DIArgs;
use litepubl\core\storage\ItemsStorableTrait;

class Args extends DIArgs
{
    use ItemsStorableTrait;

    protected $baseName = 'diargs';

    public function set(string $className, array $args)
    {
        parent::set($className, $args);
        $this->save();
    }
}
