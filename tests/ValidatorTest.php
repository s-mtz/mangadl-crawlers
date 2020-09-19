<?php

use PHPUnit\Framework\TestCase;

use MangaCrawlers\Validator;

final class ValidatorTest extends TestCase
{
    public function testCheckCrawler()
    {
        $valid = new Validator();
        $result = $valid->check_crawler("mangapanda");
        $this->assertTrue($result);
    }

    public function testCheckManga()
    {
        $valid = new Validator();
        $result = $valid->check_manga("mangapanda", "bleach");
        $this->assertTrue($result);
    }

    public function testCheckChapter()
    {
        $valid = new Validator();
        $result = $valid->check_chapter("mangapanda", "bleach", 1);
        $this->assertTrue($result);
    }
    public function testCheckFuckedChapter()
    {
        $valid = new Validator();
        $result = $valid->check_chapter("mangapanda", "bleach", 454545);
        $this->assertTrue(!$result);
    }
}
