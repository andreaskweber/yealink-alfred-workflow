<?php

namespace AndreasWeber\YealinkWorkflow\Command;

use AndreasWeber\YealinkWorkflow\Item\ItemInterface;

interface CommandInterface
{
    /**
     * Returns the command.
     *
     * @return string
     */
    public function getCommand();

    /**
     * Returns whether the command supports the injected query or not.
     *
     * @return bool
     */
    public function supports();

    /**
     * Returns the commands items.
     *
     * @return ItemInterface[]
     */
    public function getItems();
}
