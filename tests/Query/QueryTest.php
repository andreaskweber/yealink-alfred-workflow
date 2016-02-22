<?php

namespace AndreasWeber\YealinkWorkflow\Test\Query;

use AndreasWeber\YealinkWorkflow\Query\Query;
use AndreasWeber\YealinkWorkflow\Test\TestCase;

class QueryTest extends TestCase
{
    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        if (!defined('COMMAND_PREFIX')) {
            define('COMMAND_PREFIX', 'ye');
        }
    }

    public function testEmptyQueryGetsPrefixAdded()
    {
        $query = new Query('');

        $this->assertSame(COMMAND_PREFIX, $query->getCommand());
    }

    public function testIncompleteCommandGetsPrefixAdded()
    {
        $query = new Query(':call');

        $this->assertSame(COMMAND_PREFIX . ':call', $query->getCommand());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Could not create query "invalid-command 0160123456789" instance. Command
     *                           "invalid-command" does not match expected format.
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
