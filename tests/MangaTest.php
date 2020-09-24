<?php

use PHPUnit\Framework\TestCase;

use MangaCrawlers\Manga;

final class MangaTest extends TestCase
{
    public function testDownloader()
    {
        $obj = new Manga();
        $result = $obj->downloader("mangapanda", "bleach", 11, __DIR__ . "/up/");
        var_dump($obj->get_error());
        $this->assertTrue($result);
    }
}
