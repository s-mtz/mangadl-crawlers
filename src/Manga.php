<?php

namespace MangaCrawlers;
use MangaCrawlers\MangaPanda;

class Manga
{
    private $error = ["message" => ""];

    public function remove_cache_files($_chapter_path)
    {
        for ($i = 1; file_exists($_chapter_path . $i . '.jpg'); $i++) {
            if (!unlink($_chapter_path . $i . '.jpg')) {
                $this->error["message"] .= $i . " problem in path unlink " . $_chapter_path;
            }
        }
    }

    public function downloader(string $_crawler, string $_manga, int $_chapter, string $_path)
    {
        switch ($_crawler) {
            case 'mangapanda':
                $obj = new MangaPanda();
                $chapter_path = $obj->download($_manga, $_chapter, $_path);
                if (!$chapter_path) {
                    $this->error["message"] = $obj->get_error();
                    return false;
                }
                if (!$this->pdf_maker($_manga, $_chapter, $chapter_path)) {
                    $this->remove_cache_files($chapter_path);
                    return false;
                }
                if (!$this->zip_maker($_manga, $_chapter, $chapter_path)) {
                    $this->remove_cache_files($chapter_path);
                    return false;
                }
                $this->remove_cache_files($chapter_path);

                return true;
        }
    }

    private function pdf_maker(string $_manga, int $_chapter, string $_chapter_path)
    {
        $image_list = [];

        for ($i = 1; file_exists($_chapter_path . $i . '.jpg'); $i++) {
            array_push($image_list, $_chapter_path . $i . '.jpg');
        }
        try {
            $im = new \Imagick($image_list);
            $im->setImageFormat('pdf');
            $im->writeImages($_chapter_path . $_manga . "_" . $_chapter . ".pdf", true);
            return true;
        } catch (\ImagickException $th) {
            $this->error["message"] = $th->getMessage();
            return false;
        }
    }

    private function zip_maker(string $_manga, int $_chapter, string $_chapter_path)
    {
        $zip = new \ZipArchive();
        $job = $zip->open($_chapter_path . $_manga . "_" . $_chapter . ".zip", \ZipArchive::CREATE);
        if (!$job) {
            $this->error["message"] = $job;
            return false;
        }

        for ($i = 1; file_exists($_chapter_path . $i . '.jpg'); $i++) {
            $zip->addFile($_chapter_path . $i . '.jpg');
        }

        $zip->close();
        return true
    }

    public function get_error()
    {
        return $this->error;
    }
}
