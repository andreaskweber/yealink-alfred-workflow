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

        foreach ($this->config['lines'] as $line) {
            $item = new Item();
            $item->title = $line['title'];
            $item->subtitle = sprintf('Call with line "%s"', $line['title']);
            $item->icon = 'assets/icon-phone.png';
            $item->uid = $line['uri'];
            $item->autoComplete = $line['title'];
            $item->arg = $line['uri'];
            $builder->addItem($item);
        }

        return $builder->render();
    }
}
