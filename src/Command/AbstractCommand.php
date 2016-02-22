<?php

namespace AndreasWeber\YealinkWorkflow\Command;

use AndreasWeber\YealinkWorkflow\Application;
use AndreasWeber\YealinkWorkflow\Query\Query;

abstract class AbstractCommand implements CommandInterface
{
    /**
     * @var Application The application
     */
    protected $app;

    /**
     * __construct()
     *
     * @param Application $app The application
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * @inheritDoc
     */
    public function supports(Query $query)
    {
        return 0 === strpos(
            $this->getCommand(),
            $query->getCommand()
        );
    }
}
