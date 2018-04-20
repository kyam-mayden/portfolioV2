<?php

use PHPUnit\Framework\TestCase;

require_once('../cmsLogic.php');

class StackTest extends TestCase
{
    //sanitize string
    //success

    public function sanitizeStringSuccess ()
    {
        $input = '  &passWord$';
        $expected = '&amp;passWord&dollar;';
        $case = stripPassword($input);
        $this->assertEquals($case, $expected);
    }

    public function sanitizeStringFailure ()
    {
        $input = 55412;
        $expected = "";
        $case = stripPassword($input);
        $this->assertEquals($case, $expected);
    }

    //malformed
    public function testDropDownMalformed ()
    {
        $input1 =  ['string', 'string2', 1,2,3,4];
        $this->expectException(TypeError::class);
        makeDropDown($input1);
    }

}