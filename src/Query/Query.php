<?php

namespace AndreasWeber\YealinkWorkflow\Query;

class Query
{
    public function __construct($query)
    {
        // we must have a valid query string
        if (empty($query)) {
            throw new \InvalidArgumentException('Missing or empty input query.');
        }


    }
}
