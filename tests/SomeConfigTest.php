<?php

namespace JonoM\SomeConfig\Tests;

use JonoM\SomeConfig\Tests\Data\TitleObjectConfig;
use SilverStripe\Dev\SapphireTest;
use SilverStripe\SiteConfig\SiteConfig;

class SomeConfigTest extends SapphireTest
{
    protected static $extra_dataobjects = [
        TitleObjectConfig::class,
    ];

    public function testCurrentConfig(): void
    {
        $this->assertNull(TitleObjectConfig::get()->first());

        $config1 = TitleObjectConfig::current_config();
        $config2 = TitleObjectConfig::current_config();

        $this->assertSame($config1->ID, $config2->ID);
        $this->assertGreaterThan(0, $config2->ID);
    }

    public function testPermission(): void
    {
        $config1 = TitleObjectConfig::current_config();
        $globalConfig = SiteConfig::current_site_config();

        $this->assertFalse($config1->canCreate());
        $this->assertSame($globalConfig->canEdit(), $config1->canEdit());
        $this->assertSame($globalConfig->canView(), $config1->canView());
    }

    public function testTemplateFunction(): void
    {
        $functions = TitleObjectConfig::get_template_global_variables();

        $this->assertSame([
            'TitleObjectConfig' => 'current_config',
        ], $functions);
    }
}
