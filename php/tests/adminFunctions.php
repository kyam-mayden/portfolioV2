<?php

use PHPUnit\Framework\TestCase;

require_once('../adminFunctions.php');

class StackTest extends TestCase
{
    //strip Password
    //success

    public function teststripPasswordSuccess ()
    {
        $input = '  &passWord$';
        $expected = '&amp;passWord&dollar;';
        $case = stripPassword($input);
        $this->assertEquals($case, $expected);
    }

    //malformed
    public function testDropDownMalformed ()
    {
        $input1 = ['string', 'string2', 1,2,3,4];
        $this->expectException(TypeError::class);
        makeDropDown($input1);
    }

}