<?php

namespace AndreasWeber;

abstract class AbstractScript
{
    /**
     * @var array Config
     */
    protected $config;

    /**
     * __construct()
     *
     * @param array $config Config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * Executes the script logic with the supplied query.
     *
     * @param string $query The query
     *
     * @return string Response xml
     */
    abstract public function invoke($query);

    /**
     * Parses the given query by exploding on the space character.
     *
     * @param string $query The query
     *
     * @return array
     */
    protected function parseQuery($query)
    {
        return explode(' ', $query);
    }
}
