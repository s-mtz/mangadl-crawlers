<?php

use PHPUnit\Framework\TestCase;

use MangaCrawlers\Manga;

final class ZipTest extends TestCase
{
    public function testCanMakeFuckinZip()
    {
        $zipFile = new \PhpZip\ZipFile();
        try {
            $zipFile
                ->addDir(
                    "/home/geeksesi/public_html/Morteza/mangadl_tbot/upload/mangapanda/bleach/5/",
                    "bleache/5/"
                ) // add files from the directory
                ->saveAsFile(__DIR__ . "/up/../up/bleache_5.zip") // save the archive to a file
                ->close(); // close archive
        } catch (\PhpZip\Exception\ZipException $e) {
            var_dump("can't make zip");
            $this->assertTrue(false);
        } finally {
            $zipFile->close();
            $this->assertTrue(true);
        }
    }
}
