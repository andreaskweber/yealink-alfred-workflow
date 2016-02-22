<?php

namespace AndreasWeber\YealinkWorkflow\Test\Command\Stub;

use AndreasWeber\YealinkWorkflow\Command\AbstractCommand;
use AndreasWeber\YealinkWorkflow\Query\Query;

class CommandStub extends AbstractCommand
{
    /**
     * @inheritDoc
     */
    public function getCommand()
    {
        return 'p:call';
    }

    /**
     * @inheritDoc
     */
    public function getItems(Query $query)
    {
        return array();
    }

    /**
     * @inheritDoc
     */
    public function invoke(Query $query)
    {
    }

    /**
     * @inheritDoc
     */
    public function isValid()
    {
        return false;
    }
}
