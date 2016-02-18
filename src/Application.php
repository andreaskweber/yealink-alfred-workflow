<?php

namespace AndreasWeber\YealinkWorkflow;

use AndreasWeber\YealinkWorkflow\Query\Query;

class Application
{
    /**
     * @var array The config
     */
    protected $config;

    /**
     * @var Query The query
     */
    private $query;

    /**
     * __construct()
     *
     * @param string $query The query
     */
    public function __construct($query)
    {
        $this->initConfig();
        $this->initQuery($query);
    }

    /**
     * Returns the config.
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Returns the query.
     *
     * @return Query
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Initializes the config by reading the config file.
     *
     * @return null
     */
    private function initConfig()
    {
        $configFile = BASE_PATH . '/config.php';

        if (!file_exists($configFile) || !is_readable($configFile)) {
            throw new \RuntimeException(
                sprintf(
                    'Could not bootstrap application. Config file is missing or not readable: %s',
                    $configFile
                )
            );
        }

        $this->config = require_once $configFile;
    }

    /**
     * Initializes the query instance by parsing the query.
     *
     * @param string $query The query
     *
     * @return null
     */
    private function initQuery($query)
    {
        $this->query = new Query($query);
    }
}
