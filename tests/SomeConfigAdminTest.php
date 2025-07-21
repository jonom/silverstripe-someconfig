<?php

namespace JonoM\SomeConfig;

use JonoM\SomeConfig\Tests\Data\TitleObjectAdmin;
use JonoM\SomeConfig\Tests\Data\TitleObjectConfig;
use SilverStripe\Dev\SapphireTest;

class SomeConfigAdminTest extends SapphireTest
{
    protected static $extra_dataobjects = [
        TitleObjectConfig::class,
    ];

    public function testModelAdmin(): void
    {
        $admin = TitleObjectAdmin::create();
        $tab = $admin->accessGetManagedModelTabs()->last();

        $this->assertSame('Settings', $tab->Title);
        $this->assertSame(TitleObjectConfig::class, $tab->Tab);
        $this->assertSame(
            'admin/titles/JonoM-SomeConfig-Tests-Data-TitleObjectConfig/EditForm/field/JonoM-SomeConfig-Tests-Data-TitleObjectConfig/item/1/edit',
            $tab->Link
        );

        $this->assertSame('admin/titles', $admin->BackLink());
    }
}
