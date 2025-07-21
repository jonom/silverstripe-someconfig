<?php

namespace JonoM\SomeConfig;

use SilverStripe\Control\Controller;
use SilverStripe\Core\Extension;

class GridFieldDetailForm_ItemRequest_Extension extends Extension
{
    /**
     * Make the back link go to the root
     */
    public function updateBreadcrumbs($items)
    {
        if ($items && $items->count()) {
            // Get the class from the link
            $firstLink = $items->first();
            $linkParts = explode('/', $firstLink->toMap()['Link']);
            $linkPartsLength = count($linkParts);
            if ($linkPartsLength) {
                $class = array_pop($linkParts);
                if (SomeHelper::isConfig($class)) {
                    // Update the breadcrumbs
                    $controller = Controller::curr();
                    $items->last()->setField('Title', $firstLink->getField('Title'));
                    $firstLink->setField('Link', implode('/', $linkParts));
                    $firstLink->setField('Title', $controller->config()->get('menu_title'));
                }
            }
        }
    }
}
