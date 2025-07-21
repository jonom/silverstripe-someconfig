<?php

namespace JonoM\SomeConfig\Tests\Data;

use SilverStripe\Dev\TestOnly;
use JonoM\SomeConfig\SomeConfigAdmin;
use SilverStripe\Admin\ModelAdmin;

class TitleObjectAdmin extends ModelAdmin implements TestOnly
{
    use SomeConfigAdmin;

    private static array $managed_models = [
        TitleObject::class,
        // Cannot be first
        TitleObjectConfig::class,
    ];

    private static string $url_segment = 'titles';
    private static string $menu_title = 'titles';


    public function accessGetManagedModelTabs()
    {
        return $this->getManagedModelTabs();
    }
}
