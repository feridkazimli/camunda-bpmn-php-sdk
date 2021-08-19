<?php

use PHPUnit\Framework\TestCase;

class TaskTest extends TestCase
{
    public function testThatStringMatch()
    {
        $string1 = 'test 1';
        $string2 = 'test 1';

        $this->assertSame($string1, $string2);
    }

    public function testThatNumbersAddUp()
    {
        $this->assertEquals(10, 5 + 5);
    }
}