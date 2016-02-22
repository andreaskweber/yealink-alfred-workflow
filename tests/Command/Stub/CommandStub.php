<?php

namespace AndreasWeber\YealinkWorkflow\Test\Command\Stub;

use AndreasWeber\YealinkWorkflow\Command\AbstractCommand;

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
    public function getItems()
    {
        return array();
    }

    /**
     * @inheritDoc
     */
    public function isValid()
    {
        return false;
    }
}
