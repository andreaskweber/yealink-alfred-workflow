<?php

namespace AndreasWeber\YealinkWorkflow\Command;

use AndreasWeber\YealinkWorkflow\Item\Item;
use AndreasWeber\YealinkWorkflow\Query\Query;

class MainMenuCommand extends AbstractCommand
{
    /**
     * @inheritDoc
     */
    public function getCommand()
    {
        return COMMAND_PREFIX . ':';
    }

    /**
     * @inheritDoc
     */
    public function invoke(Query $query)
    {
        throw new \LogicException('This command is not invokable.');
    }

    /**
     * @inheritDoc
     */
    public function getItems(Query $query)
    {
        $items = array(
            new Item(
                'Call someone',
                'This is the call subtitle',
                'assets/glyphicons-443-earphone@3x.png',
                COMMAND_PREFIX . ':call',
                ':call ',
                COMMAND_PREFIX . ':call',
                false
            ),
            new Item(
                'Hangup',
                'This is the hangup subtitle',
                'assets/glyphicons-659-tick@3x.png',
                COMMAND_PREFIX . ':hangup',
                ':hangup ',
                COMMAND_PREFIX . ':hangup',
                true
            ),
        );

        return $items;
    }
}
