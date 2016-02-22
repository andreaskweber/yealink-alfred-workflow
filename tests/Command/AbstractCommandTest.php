<?php

namespace AndreasWeber\YealinkWorkflow\Test\Command;

use AndreasWeber\YealinkWorkflow\Application;
use AndreasWeber\YealinkWorkflow\Query\Query;
use AndreasWeber\YealinkWorkflow\Test\Command\Stub\CommandStub;
use AndreasWeber\YealinkWorkflow\Test\TestCase;

class AbstractCommandTest extends TestCase
{
    /**
     * @var Application|\PHPUnit_Framework_MockObject_MockObject Application mock
     */
    private $appMock;

    /**
     * @inheritDoc
     */
    protected function setUp()
    {
        parent::setUp();

        $this->appMock = $this
            ->getMockBuilder('AndreasWeber\\YealinkWorkflow\\Application')
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function testSupportsEqualStartingQuery()
    {
        $query = $this->createQuery('p:call 0160123456789');
        $command = new CommandStub($this->appMock);

        $this->assertTrue($command->supports($query));
    }

    public function testSupportsEqualStartingAndCaseNotMatchingQuery()
    {
        $query = $this->createQuery('P:CALL 0160123456789');
        $command = new CommandStub($this->appMock);

        $this->assertTrue($command->supports($query));
    }

    public function testDoesNotSupportOtherQuery()
    {
        $query = $this->createQuery('p:foo 0160123456789');
        $command = new CommandStub($this->appMock);

        $this->assertFalse($command->supports($query));
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
