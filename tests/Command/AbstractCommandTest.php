<?php

namespace AndreasWeber\YealinkWorkflow\Test\Command;

use AndreasWeber\YealinkWorkflow\Query\Query;
use AndreasWeber\YealinkWorkflow\Test\Command\Stub\CommandStub;
use AndreasWeber\YealinkWorkflow\Test\TestCase;

class AbstractCommandTest extends TestCase
{
    public function testSupportsEqualStartingQuery()
    {
        $query = $this->createQuery('p:call 0160123456789');
        $command = new CommandStub($query);

        $this->assertTrue($command->supports());
    }

    public function testSupportsEqualStartingAndCaseNotMatchingQuery()
    {
        $query = $this->createQuery('P:CALL 0160123456789');
        $command = new CommandStub($query);

        $this->assertTrue($command->supports());
    }

    public function testDoesNotSupportOtherQuery()
    {
        $query = $this->createQuery('p:foo 0160123456789');
        $command = new CommandStub($query);

        $this->assertFalse($command->supports());
    }

    /**
     * Creates a query instance with the given query string.
     *
     * @param string $query The query
     *
     * @return Query
     */
    private function createQuery($query)
    {
        return new Query($query);
    }
}
