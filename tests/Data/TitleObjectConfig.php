<?php

namespace JonoM\SomeConfig\Tests\Data;

use JonoM\SomeConfig\SomeConfig;
use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;

class TitleObjectConfig extends DataObject implements TestOnly
{
    use SomeConfig;

    private static string $table_name = 'TitleObjectConfig';

    private static array $db = [
        'ConfigLabel' => 'Varchar(255)',
    ];
}
