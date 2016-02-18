<?php

namespace AndreasWeber\YealinkWorkflow\Query;

class Query
{
    /**
     * @var string The query
     */
    private $query;

    /**
     * @var string The command
     */
    private $command;

    /**
     * @var string The argument
     */
    private $argument;

    /**
     * Creates the query instance.
     *
     * @param string $query The query
     */
    public function __construct($query)
    {
        if (empty($query)) {
            throw new \InvalidArgumentException('Could not create query instance. Empty input query given.');
        }

        $queryParts = explode(' ', $query);

        $this->command = strtolower(array_shift($queryParts));
        if (0 === preg_match('/^[a-z\:]*$/', $this->command)) {
            throw new \InvalidArgumentException('Could not create query instance. Command does not match expected format.');
        }

        if (!empty($queryParts)) {
            $this->argument = implode(' ', $queryParts);
        }

        $this->query = $query;
    }

    /**
     * Returns the command.
     *
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Returns the argument.
     *
     * @return string
     */
    public function getArgument()
    {
        return $this->argument;
    }

    /**
     * Returns the query.
     *
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }
}
