<?php

namespace JonoM\SomeConfig;

class SomeHelper
{
    public static function isConfig(string $class): bool
    {
        return method_exists($class, 'current_config');
    }
}
