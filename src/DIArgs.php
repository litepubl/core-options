<?php

namespace litepubl\core\options;

use litepubl\core\container\DI\Args;
use litepubl\core\storage\ItemsStorableTrait;

class DIArgs extends Args
{
    use ItemsStorableTrait;

    protected $baseName = 'diargs';

    public function set(string $className, array $args)
    {
        parent::set($className, $args);
        $this->save();
    }
}
