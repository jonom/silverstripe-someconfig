<?php

namespace JonoM\SomeConfig\Tests\Data;

use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;

class TitleObject extends DataObject implements TestOnly
{
    private static string $table_name = 'TitleObject';

}
