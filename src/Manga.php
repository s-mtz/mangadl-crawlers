<?php

namespace MangaCrawlers;
use MangaCrawlers\MangaPanda;

class Manga
{
    public function downloader(string $_crawler, string $_manga, int $_chapter, string $_path)
    {
        switch ($_crawler) {
            case 'mangapanda':
                $obj = new MangaPanda();
                $chapter_path = $obj->download($_manga, $_chapter, $_path);

                $this->pdf_maker($_manga, $_chapter, $chapter_path);
                $this->zip_maker($_manga, $_chapter, $chapter_path);

                for ($i = 1; file_exists($chapter_path . $i . '.jpg'); $i++) {
                    unlink($chapter_path . $i . '.jpg');
                }

                return true;
        }
    }

    private function pdf_maker(string $_manga, int $_chapter, string $_chapter_path)
    {
        $image_list = [];

        for ($i = 1; file_exists($_chapter_path . $i . '.jpg'); $i++) {
            array_push($image_list, $_chapter_path . $i . '.jpg');
        }

        $im = new \Imagick($image_list);
        $im->setImageFormat('pdf');
        $im->writeImages($_chapter_path . $_manga . " " . $_chapter . ".pdf", true);
    }

    private function zip_maker(string $_manga, int $_chapter, string $_chapter_path)
    {
        $zip = new \ZipArchive();
        $zip->open($_chapter_path . $_manga . " " . $_chapter . ".zip", \ZipArchive::CREATE);

        for ($i = 1; file_exists($_chapter_path . $i . '.jpg'); $i++) {
            $zip->addFile($_chapter_path . $i . '.jpg');
        }

        $zip->close();
    }
}
