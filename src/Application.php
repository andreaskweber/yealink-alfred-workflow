<?php

namespace AndreasWeber\YealinkWorkflow;

use AndreasWeber\YealinkWorkflow\Command\CallCommand;
use AndreasWeber\YealinkWorkflow\Command\CommandInterface;
use AndreasWeber\YealinkWorkflow\Query\Query;
use AndreasWeber\YealinkWorkflow\Response\ResponseXmlBuilder;

class Application
{
    /**
     * @var array The config
     */
    protected $config;

    /**
     * @var ResponseXmlBuilder Response builder
     */
    private $responseBuilder;

    /**
     * __construct()
     */
    public function __construct()
    {
        $this->initConfig();

        $this->responseBuilder = new ResponseXmlBuilder();
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
     * Runs the application with the given query.
     *
     * @param Query $query The query
     *
     * @return null
     */
    public function run(Query $query)
    {
        /** @var CommandInterface[] $availableCommands */
        $availableCommands = array(
            new CallCommand($query, $this->config),
        );

        $commands = array();
        foreach ($availableCommands as $command) {
            if ($command->supports()) {
                $commands[] = $command;
            }
        }

        echo $this->responseBuilder->render($commands);
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
}
