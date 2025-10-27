<?php

namespace JonoM\SomeConfig;

use SilverStripe\Admin\LeftAndMain;

trait SomeConfigAdmin
{
    public static function isConfig($class)
    {
        return method_exists($class, 'current_config');
    }

    /**
     * @return \SilverStripe\ORM\ArrayList An ArrayList of all managed models to build the tabs for this ModelAdmin
     */
    protected function getManagedModelTabs()
    {
        $forms = parent::getManagedModelTabs();
        // Override the tab link for config classes to go directly to the item
        foreach ($forms as $formData) {
            $class = $formData->ClassName;
            if (static::isConfig($class)) {
                $config = $class::current_config();
                $formData->Link = $this->getCMSEditLinkForManagedDataObject($config);
            }
        }
        return $forms;
    }

    /**
     * Make the back link for configs point to the root
     *
     * @return string
     */
    public function BackLink()
    {
        if (static::isConfig($this->getModelClass())) {
            return LeftAndMain::Link();
        }
        return parent::Link();
    }
}
