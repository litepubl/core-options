<?php

namespace litepubl\core\options;

use litepubl\core\container\DI\Cache;
use litepubl\core\storage\ItemsStorableTrait;

class DICache extends Cache
{
    use ItemsStorableTrait;

    protected $baseName = 'cache/dicache';

    public function set(string $className, array $args)
    {
        parent::set($className, $args);
        $this->save();
    }
}
