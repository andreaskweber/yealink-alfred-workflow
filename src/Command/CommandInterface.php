<?php

namespace AndreasWeber\YealinkWorkflow\Command;

use AndreasWeber\YealinkWorkflow\Item\ItemInterface;
use AndreasWeber\YealinkWorkflow\Query\Query;

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
     * @param Query $query The query
     *
     * @return bool
     */
    public function supports(Query $query);

    /**
     * Invokes the command execution.
     *
     * @param Query $query The query
     *
     * @return null
     */
    public function invoke(Query $query);

    /**
     * Returns the commands items.
     *
     * @param Query $query The query
     *
     * @return ItemInterface[]
     */
    public function getItems(Query $query);
}
