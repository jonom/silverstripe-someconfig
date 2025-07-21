<?php

namespace JonoM\SomeConfig;

use SilverStripe\Admin\LeftAndMain;

trait SomeConfigAdmin
{
    /**
     * @return \SilverStripe\ORM\ArrayList An ArrayList of all managed models to build the tabs for this ModelAdmin
     */
    protected function getManagedModelTabs()
    {
        $forms = parent::getManagedModelTabs();
        // Override the tab link for config classes to go directly to the item
        foreach ($forms as $formData) {
            $class = $formData->ClassName;
            if (SomeHelper::isConfig($class)) {
                $config = $class::current_config();
                $segment = $this->sanitiseClassName($class);
                $formData->Link .= "/EditForm/field/$segment/item/$config->ID/edit";
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
        if (SomeHelper::isConfig($this->getModelClass())) {
            return LeftAndMain::Link();
        }
        return parent::Link();
    }
}
