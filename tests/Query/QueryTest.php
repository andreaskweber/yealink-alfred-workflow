<?php

namespace AndreasWeber\YealinkWorkflow\Test\Query;

use AndreasWeber\YealinkWorkflow\Query\Query;
use AndreasWeber\YealinkWorkflow\Test\TestCase;

class QueryTest extends TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Could not create query instance. Empty input query given.
     */
    public function testEmptyQueryFails()
    {
        new Query('');
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Could not create query instance. Query does not match expected format.
     */
    public function testInvalidQueryFails()
    {
        new Query('asda dasd !!');
    }

    public function testValidQueryUppercase()
    {
        $queryString = 'CALL:COmmAND';
        $query = new Query($queryString);

        $this->assertSame(
            strtolower($queryString),
            $query->getQuery()
        );
    }

    public function testValidQuery()
    {
        $queryString = 'call:command';
        $query = new Query($queryString);

        $this->assertSame(
            $queryString,
            $query->getQuery()
        );
    }
}
