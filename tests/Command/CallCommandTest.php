<?php

namespace AndreasWeber\YealinkWorkflow\Test\Command;

use AndreasWeber\YealinkWorkflow\Application;
use AndreasWeber\YealinkWorkflow\Command\CallCommand;
use AndreasWeber\YealinkWorkflow\Query\Query;
use AndreasWeber\YealinkWorkflow\Test\TestCase;

class CallCommandTest extends TestCase
{
    /**
     * @var Application|\PHPUnit_Framework_MockObject_MockObject Application mock
     */
    private $appMock;

    /**
     * @var CallCommand Call command
     */
    private $command;

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

        $this->command = new CallCommand($this->appMock);
    }


    public function testGetNumberFromNormalArgument()
    {
        $query = new Query('ye:call +4916090282219 line1@foobar.de');

        $this->assertSame(
            '+4916090282219',
            $this->command->getNumberFromQuery($query)
        );
    }

    public function testGetNumberFromContactsActionArgumentWithoutLine()
    {
        $query = new Query('ye:call +4916090282219');

        $this->assertSame(
            '+4916090282219',
            $this->command->getNumberFromQuery($query)
        );
    }

    public function testGetNumberWithSpacesRemovedFromArgument()
    {
        $query = new Query('ye:call +49 160 90282219 line1@foobar.de');

        $this->assertSame(
            '+4916090282219',
            $this->command->getNumberFromQuery($query)
        );
    }

    public function testGetNumberWithSpacesRemovedFromArgumentWithoutLine()
    {
        $query = new Query('ye:call +49 160 90282219');

        $this->assertSame(
            '+4916090282219',
            $this->command->getNumberFromQuery($query)
        );
    }

    public function testGetLine()
    {
        $query = new Query('ye:call +4916090282219 line1@foobar.de');

        $this->assertSame(
            'line1',
            $this->command->getLineFromQuery($query)
        );
    }

    public function testGetLineWhenLineIsMissing()
    {
        $query = new Query('ye:call +4916090282219');

        $this->assertNull($this->command->getLineFromQuery($query));
    }
}
