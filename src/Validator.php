<?php

namespace MangaCrawlers;

class Validator
{
    private $error = [];

    public function check_crawler(string $_crawler)
    {
        $arr = ['mangapanda'];

        if (in_array($_crawler, $arr)) {
            return true;
        }
        $this->error["message"] = "crawler input error";
        return false;
    }

    public function check_manga(string $_crawler, string $_manga)
    {
        if ($_crawler == "mangapanda") {
            $url = "http://www.mangapanda.com/$_manga";

            $html = file_get_contents($url);
            if (!$html) {
                $this->error["message"] = "manga input error";
                return false;
            }
            return true;
        }
        return true;
    }

    public function check_chapter(string $_crawler, string $_manga, int $_chapter)
    {
        // if ($_crawler == "mangapanda") {
        //     $url = "http://www.mangapanda.com/$_manga/$_chapter";

        //     $html = file_get_contents($url);
        //     if (!$html) {
        //         $this->error["message"] = "manga or chapter input error";
        //         return false;
        //     }
        //     return true;
        // }
        // $this->error["message"] = "crawler input error";
        // return false;
        return true;
    }

    public function get_error()
    {
        if (empty($this->error)) {
            return false;
        }
        return $this->error;
    }
}
