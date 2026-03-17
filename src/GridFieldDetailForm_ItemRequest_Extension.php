<?php

namespace JonoM\SomeConfig;

use SilverStripe\Core\Extension;

class GridFieldDetailForm_ItemRequest_Extension extends Extension
{
    /**
     * Make the back link go to the root
     */
    public function updateBreadcrumbs($items)
    {
        $record = $this->owner->getRecord();
        if (!$record || !$items || !$items->count()) {
            return;
        }

        if (SomeHelper::isConfig($record->ClassName)) {
            $controller = $this->owner->getController();
            $firstLink = $items->first();
            $items->last()->setField('Title', $firstLink->getField('Title'));
            $firstLink->setField('Title', $controller->config()->get('menu_title'));
            // Link to the first tab of the ModelAdmin, not the config's list view
            $managedModels = array_keys($controller->getManagedModels());
            $firstLink->setField('Link', $controller->getLinkForModelTab($managedModels[0]));
        }
    }
}
