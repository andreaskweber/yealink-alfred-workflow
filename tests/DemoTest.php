<?php

namespace AndreasWeber\YealinkWorkflow\Test;

use AndreasWeber\YealinkWorkflow\Demo;

class DemoTest extends TestCase
{
    public function testDemo()
    {
        $demo = new Demo();

        $this->assertTrue($demo->isTrue());
    }
}
