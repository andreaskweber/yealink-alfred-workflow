<?php

namespace AndreasWeber;

use AndreasWeber\FilterScriptInput\ResponseXmlBuilder;
use AndreasWeber\ResponseXml\Item;

class FilterScriptInput extends AbstractScript
{
    /**
     * @inheritDoc
     */
    public function invoke($query)
    {
        $builder = new ResponseXmlBuilder();

        $item = new Item();
        $item->title = 'The title';
        $item->subtitle= 'The subtitle';
        $item->icon = 'directory';
        $item->uid = 'uniqueunique';
        $item->autoComplete = 'The title';
        $item->arg = 'argument';

        $builder->addItem($item);

        return $builder->render();
    }
}
