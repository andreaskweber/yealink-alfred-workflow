<?php

namespace AndreasWeber\YealinkWorkflow\Command;

use AndreasWeber\YealinkWorkflow\Query\Query;

class HangupCommand extends AbstractCommand
{
    /**
     * @inheritDoc
     */
    public function getCommand()
    {
        return COMMAND_PREFIX . ':hangup';
    }

    /**
     * @inheritDoc
     */
    public function supports(Query $query)
    {
        return $this->getCommand() === $query->getCommand();
    }

    /**
     * @inheritDoc
     */
    public function invoke(Query $query)
    {
        $this->app->getPhoneGateway()->hangup();

        echo 'Call ended';
    }

    /**
     * @inheritDoc
     */
    public function getItems(Query $query)
    {
        return array();
    }
}
