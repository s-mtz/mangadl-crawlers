<?php

use PHPUnit\Framework\TestCase;

use MangaCrawlers\Manga;

final class MangaTest extends TestCase
{
    public function testDownloader()
    {
        $obj = new Manga();
        $result = $obj->downloader("mangapanda", "bleach", 6, "up");
        $this->assertTrue($result);
    }
}
