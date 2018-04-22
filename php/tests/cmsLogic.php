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
    //malformed
    public function testsanitizeUrlMalformed ()
    {
        $input1 =  ['string', 'string2', 1,2,3,4];
        $this->expectException(TypeError::class);
        sanitizeString($input1);
    }


    //sanitizeNum
    //success
    public function testsanitizeNumSuccess ()
    {
        $input = 334533;
        $expected = 334533;
        $case = sanitizeNum($input);
        $this->assertEquals($case, $expected);
    }

    //failure
    public function testsanitizeNumFailure ()
    {
        $input = 50.3;
        $expected = 50;
        $case = sanitizeNum($input);
        $this->assertEquals($case, $expected);
    }

    //malformed
    public function testsanitizeNumMalformed ()
    {
        $input1 =  ['string', 'string2', 1,2,3,4];
        $this->expectException(TypeError::class);
        sanitizeNum($input1);
    }

    //makeDropDown
    //success
    public function testmakeDropDownSuccess ()
    {
        $input = [['id'=>1, 'name'=>'one'],['id'=>2, 'name'=>'two']];
        $expected = "<option value= 1 >'one'</option><option value=2>'two'</option>";
        $case = makeDropDown($input);
        $this->assertEquals($case, $expected);
    }

    //malformed
    public function testmakeDropDownMalformed ()
    {
        $input1 =  ['string', 'string2', 1,2,3,4];
        $this->expectException(TypeError::class);
        makeDropDown($input1);
    }

    //buildImageTable
    //success
    public function testbuildImageTableSuccess ()
    {
        $input = [['image'=>'pic1', 'project'=>'proj1'],['image'=>'pic2', 'project'=>'proj2']];
        $expected = "<p>pic1 - project1</p><p>pic2 - project2</p>";
        $case = buildImageTable($input);
        $this->assertEquals($case, $expected);
    }

    //malformed
    public function testbuildImageTableMalformed ()
    {
        $input1 =  ['string', 'string2', 1,2,3,4];
        $this->expectException(TypeError::class);
        buildImageTable($input1);
    }

    //buildSkillList
    //success
    public function testbuildSkillListSuccess ()
    {
        $input = [['name'=>'skill1'],['name'=>'skill2']];
        $expected = "<li>skill1</li><li>skill2</li>";
        $case = buildImageTable($input);
        $this->assertEquals($case, $expected);
    }
    //malformed
    public function testbuildSkillListMalformed ()
    {
        $input1 =  [];
        $this->expectException(TypeError::class);
        buildSkillList($input1);
    }

}