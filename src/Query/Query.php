<?php

namespace AndreasWeber\YealinkWorkflow\Query;

class Query
{
    /**
     * @var string The query
     */
    private $query;

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

        $query = strtolower($query);

        if (0 === preg_match('/^[a-z\:]*$/', $query)) {
            throw new \InvalidArgumentException('Could not create query instance. Query does not match expected format.');
        }

        $this->query = $query;
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
