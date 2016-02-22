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
        $items = array();
        foreach ($this->config['lines'] as $line) {
            $items[] = new Item(
                $line['title'],
                sprintf('Calls "%s" with line "%s"', $this->query->getArgument(), $line['title']),
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
