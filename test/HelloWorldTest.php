<?php

use PHPUnit\Framework\TestCase;

class HelloWorldTest extends TestCase
{

    public function testWorldExits()
    {
        $this->assertTrue(true);

        echo "\n\nHelloWorldTest \n\n";
    }
}
