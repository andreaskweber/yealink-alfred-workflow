<?php

namespace AndreasWeber\YealinkWorkflow;

use AndreasWeber\YealinkWorkflow\Command\CallCommand;
use AndreasWeber\YealinkWorkflow\Command\CommandInterface;
use AndreasWeber\YealinkWorkflow\Command\HangupCommand;
use AndreasWeber\YealinkWorkflow\Command\MainMenuCommand;
use AndreasWeber\YealinkWorkflow\Phone\PhoneGateway;
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
     * @var PhoneGateway Phone gateway
     */
    private $phoneGateway;

    /**
     * @var CommandInterface[] Registered commands
     */
    private $commands;

    /**
     * __construct()
     */
    public function __construct()
    {
        $this->initConfig();
        $this->initCommands();
        $this->responseBuilder = new ResponseXmlBuilder();
        $this->phoneGateway = new PhoneGateway(
            $this->config['phone']['ip'],
            $this->config['phone']['username'],
            $this->config['phone']['password']
        );
    }

    /**
     * Runs the application filter with the given query.
     *
     * @param Query $query The query
     *
     * @return null
     */
    public function filter(Query $query)
    {
        $items = array();
        foreach ($this->commands as $command) {
            if ($command->supports($query)) {
                $items = array_merge(
                    $items,
                    $command->getItems($query)
                );
            }
        }

        echo $this->responseBuilder->render($items);
    }

    /**
     * Runs the application action with the given query.
     *
     * @param Query $query The query
     *
     * @return null
     */
    public function action(Query $query)
    {
        foreach ($this->commands as $command) {
            if ($command->getCommand() === $query->getCommand()) {
                $command->invoke($query);

                return;
            }
        }

        throw new \LogicException(
            sprintf(
                'Could not invoke command. No registered command for "%s" found.',
                $query->getCommand()
            )
        );
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
     * Returns the phone gateway.
     *
     * @return PhoneGateway
     */
    public function getPhoneGateway()
    {
        return $this->phoneGateway;
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
     * Initializes the commands by instantiating them.
     *
     * @return null
     */
    public function initCommands()
    {
        $this->commands = array(
            new MainMenuCommand($this),
            new CallCommand($this),
            new HangupCommand($this)
        );
    }
}
