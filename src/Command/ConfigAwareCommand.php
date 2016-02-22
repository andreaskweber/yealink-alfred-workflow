<?php

namespace AndreasWeber\YealinkWorkflow\Command;

use AndreasWeber\YealinkWorkflow\Query\Query;

abstract class ConfigAwareCommand extends AbstractCommand
{
    /**
     * @var array Config
     */
    protected $config;

    /**
     * @inheritDoc
     *
     * @param array $config Config
     */
    public function __construct(Query $query, array $config)
    {
        parent::__construct($query);

        $this->config = $config;
    }
}
