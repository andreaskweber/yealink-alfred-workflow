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
        $builder = new ResponseXmlBuilder();
        $number = $this->extractNumberFromQuery($query);

        //
        // If hangup command is expected, render xml
        //

        if ('H' == strtoupper(substr($number, 0, 1))) {
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

        //
        // only valid numbers are supported
        //

        if (!preg_match('/^\+?\d+$/', $number)) {
            return;
        }

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

        echo $builder->render();
    }

    /**
     * Extracts and returns the filtered number from the given query.
     *
     * @param string $query The query
     *
     * @return string The number
     */
    private function extractNumberFromQuery($query)
    {
        return str_replace(' ', '', $query);
    }
}
