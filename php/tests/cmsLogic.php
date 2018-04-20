<?php

use PHPUnit\Framework\TestCase;

require_once('../cmsLogic.php');

class StackTest extends TestCase
{
    //sanitizeString
    //success

    public function testsanitizeStringSuccess ()
    {
        $input = '  &passWord$';
        $expected = '&amp;passWord&dollar;';
        $case = sanitizeString($input);
        $this->assertEquals($case, $expected);
    }

    public function testsanitizeStringFailure ()
    {
        $input = 55412;
        $expected = "";
        $case = sanitizeString($input);
        $this->assertEquals($case, $expected);
    }

    //malformed
    public function testDropDownMalformed ()
    {
        $input1 =  ['string', 'string2', 1,2,3,4];
        $this->expectException(TypeError::class);
        sanitizeString($input1);
    }


    //sanitizeURL
    //success
    public function testsanitizeUrlSuccess ()
    {
        $input = '  <testurl##]]';
        $expected = 'testurl';
        $case = sanitizeUrl($input);
        $this->assertEquals($case, $expected);
    }

    //failure
    public function testsanitizeUrlFailure ()
    {
        $input = 779898;
        $expected = 779898;
        $case = sanitizeUrl($input);
        $this->assertEquals($case, $expected);
    }

    public function testsanitizeUrlMalformed ()
    {
        $input1 =  ['string', 'string2', 1,2,3,4];
        $this->expectException(TypeError::class);
        sanitizeString($input1);
    }


    //sanitizeNum

    //makeDropDown

    //buildImageTable

    //buildSkillList

    //

}