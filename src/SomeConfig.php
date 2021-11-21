<?php

namespace JonoM\SomeConfig;

use SilverStripe\ORM\DB;
use SilverStripe\ORM\DataObject;
use SilverStripe\SiteConfig\SiteConfig;

/**
 * SomeConfig
 *
 * Create an arbitrary configuration object similar to SiteConfig.
 *
 */
trait SomeConfig
{
    private static $singular_name = 'Settings';
    private static $plural_name = 'Settings';

    /**
     * Get the current site's config, and creates a new one through
     * {@link make_config()} if none is found.
     *
     * @return DataObject
     */
    public static function current_config()
    {
        $someConfig = DataObject::get_one(static::class);
        if (!$someConfig) {
            $someConfig = static::make_config();
        }
        return $someConfig;
    }

    /**
     * Create a default config record if none exists.
     */
    public function requireDefaultRecords()
    {
        parent::requireDefaultRecords();
        $config = DataObject::get_one(static::class);
        if (!$config) {
            static::make_config();
            DB::alteration_message("Added default " . $this->singular_name(), "created");
        }
    }

    /**
     * Create a config object and save it to the database.
     *
     * @return DataObject
     */
    public static function make_config()
    {
        $config = static::create();
        $config->write();
        return $config;
    }

    public function canCreate($member = null, $context = [])
    {
        // Only created automatically
        return false;
    }

    public function canView($member = null)
    {
        return SiteConfig::current_site_config()->canView($member);
    }

    public function canEdit($member = null)
    {
        return SiteConfig::current_site_config()->canEdit($member);
    }

    /**
     * Add config to all SSViewers
     */
    public static function get_template_global_variables()
    {
        return [
            static::getSchema()->tableName(static::class) => 'current_config',
        ];
    }
}
