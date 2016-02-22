<?php

namespace AndreasWeber\YealinkWorkflow\Command;

use AndreasWeber\YealinkWorkflow\Item\Item;

class MainMenuCommand extends AbstractCommand
{
    /**
     * @inheritDoc
     */
    public function getCommand()
    {
        return 'ye:';
    }

    /**
     * @inheritDoc
     */
    public function getItems()
    {
        $items = array(
            new Item('Call someone', 'This is the call subtitle', 'assets/glyphicons-443-earphone@3x.png', 'ye:call', ':call ', 'ye:call', false)
        );

        return $items;
    }
}
