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
            $query = COMMAND_PREFIX;
        }

        if (0 === strpos($query, ':')) {
            $query = COMMAND_PREFIX . $query;
        }

        $queryParts = explode(' ', $query);

        $this->command = strtolower(array_shift($queryParts));
        if (0 === preg_match('/^[a-z\:]*$/', $this->command)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'Could not create query "%s" instance. Command "%s" does not match expected format.',
                    $query,
                    $this->command
                )
            );
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
     * Returns the command without the prefix.
     *
     * @return string
     */
    public function getCommandWithoutPrefix()
    {
        return rtrim(str_replace(COMMAND_PREFIX, '', $this->getCommand()), ' ') . ' ';
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
