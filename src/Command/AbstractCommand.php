<?php

namespace AndreasWeber\YealinkWorkflow\Command;

use AndreasWeber\YealinkWorkflow\Query\Query;

abstract class AbstractCommand implements CommandInterface
{
    /**
     * @var Query The query
     */
    protected $query;

    /**
     * __construct()
     *
     * @param Query $query The query
     */
    public function __construct(Query $query)
    {
        $this->query = $query;
    }

    /**
     * @inheritDoc
     */
    public function supports()
    {
        return 0 === strpos(
            $this->getCommand(),
            $this->query->getCommand()
        );
    }
}
