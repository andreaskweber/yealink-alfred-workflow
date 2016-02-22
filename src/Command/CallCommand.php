<?php

namespace AndreasWeber\YealinkWorkflow\Command;

use AndreasWeber\YealinkWorkflow\Item\Item;

class CallCommand extends ConfigAwareCommand
{
    /**
     * @inheritDoc
     */
    public function getCommand()
    {
        return 'ye:call';
    }

    /**
     * @inheritDoc
     */
    public function supports()
    {
        return $this->getCommand() === $this->query->getCommand();
    }

    /**
     * @inheritDoc
     */
    public function getItems()
    {
        $number = str_replace(' ', '', $this->query->getArgument());

        if ($number && !preg_match('/^\+?\d+$/', $number)) {
            return array();
        }

        $items = array();
        foreach ($this->config['lines'] as $line) {
            if ($number) {
                $subtitle = sprintf('Calls "%s" with line "%s"', $number, $line['title']);
            } else {
                $subtitle = sprintf('Enter number to call with line "%s"', $line['title']);
            }

            $items[] = new Item(
                $line['title'],
                $subtitle,
                $line['icon'],
                'the argument',
                $line['title'],
                $line['uri'],
                true
            );
        }

        return $items;
    }
}
