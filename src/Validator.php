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
            if (empty($html)) {
                $this->error["message"] = "manga input error";
                return false;
            }
            return true;
        }
        return false;
    }

    public function check_chapter(string $_crawler, string $_manga, int $_chapter)
    {
        if ($_crawler == "mangapanda") {
            $url = "http://www.mangapanda.com/$_manga/$_chapter";
            $html = file_get_contents($url);
            if (!$html) {
                $this->error["message"] = "couldent get the site content";
                return false;
            }
            $image_url = $this->get_inner_string($html, 'id="img"', 'alt=');
            $image_url = substr($image_url, strpos($image_url, 'https://'));
            $image_url = substr($image_url, 0, strpos($image_url, '"'));

            if (strlen($image_url) > 10) {
                return true;
            }
            return false;
        }
        return false;
    }

    private function get_inner_string($string, $begin, $end)
    {
        if ($begin === 0) {
            return substr($string, 0, strpos($string, $end));
        }
        if ($end === 0) {
            return substr($string, strpos($string, $begin) + strlen($begin));
        }

        $string = ' ' . $string;
        $init = strpos($string, $begin);

        if ($init == 0) {
            return '';
        }

        $init += strlen($begin);
        $len = strpos($string, $end, $init) - $init;

        return substr($string, $init, $len);
    }

    public function get_error()
    {
        if (empty($this->error)) {
            return false;
        }
        return $this->error;
    }
}
