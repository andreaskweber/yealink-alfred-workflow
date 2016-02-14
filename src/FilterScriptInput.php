<?php

namespace AndreasWeber;

use AndreasWeber\FilterScriptInput\ResponseXmlBuilder;
use AndreasWeber\ResponseXml\Command;
use AndreasWeber\ResponseXml\Item;

class FilterScriptInput extends AbstractScript
{
    /**
     * @inheritDoc
     */
    public function invoke($query)
    {
        $number = $query;
        $builder = new ResponseXmlBuilder();

        //
        // Add lines
        //

        foreach ($this->config['lines'] as $line) {
            $item = new Item();
            $item->title = $line['title'];
            $item->subtitle = sprintf('Calls "%s" with line "%s"', $number, $line['title']);
            $item->icon = 'assets/glyphicons-668-call-outgoing.png';
            $item->uid = $line['uri'];
            $item->autoComplete = $line['title'];
            $item->arg = sprintf('%s %s %s', Command::DIAL, $line['uri'], $number);
            $builder->addItem($item);
        }

        //
        // Add hangup command
        //

        $item = new Item();
        $item->title = 'Hangup';
        $item->subtitle = sprintf('Ends an active call');
        $item->icon = 'assets/glyphicons-659-tick.png';
        $item->uid = 'hangup';
        $item->autoComplete = 'Hangup';
        $item->arg = Command::HANGUP;
        $builder->addItem($item);

        echo $builder->render();
    }
}
