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
     * @expectedExceptionMessage Could not create query instance. Command does not match expected format.
     */
    public function testInvalidQueryCommandFails()
    {
        new Query('invalid-command 0160123456789');
    }
    
    public function testValidQuery()
    {
        $queryString = 'call:number 0160123465789';
        $query = new Query($queryString);

        $this->assertSame(
            $queryString,
            $query->getQuery()
        );
    }

    public function testValidQueryCommand()
    {
        $queryString = 'call:number 0160123465789';
        $query = new Query($queryString);

        $this->assertSame(
            'call:number',
            $query->getCommand()
        );
    }

    public function testValidQueryCommandUppercase()
    {
        $queryString = 'CALL:NuMBer 0160123465789';
        $query = new Query($queryString);

        $this->assertSame(
            'call:number',
            $query->getCommand()
        );
    }

    public function testArgument()
    {
        $queryString = 'call:number 0160123465789';
        $query = new Query($queryString);

        $this->assertSame(
            '0160123465789',
            $query->getArgument()
        );
    }

    public function testArgumentWithSpaces()
    {
        $queryString = 'call:number 0160123465789 line2';
        $query = new Query($queryString);

        $this->assertSame(
            '0160123465789 line2',
            $query->getArgument()
        );
    }
}
