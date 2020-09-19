<?php

namespace MangaCrawlers;

class Validator
{
    public function check_crawler(string $_crawler)
    {
        $arr = ['mangapanda'];

        if (in_array($_crawler, $arr)) {
            return true;
        }
        return false;
    }

    public function check_manga(string $_crawler, string $_manga)
    {
        if ($_crawler == "mangapanda") {
            $url = "http://www.mangapanda.com/$_manga";

            $html = file_get_contents($url);
            if (!$html) {
                return false;
            }
            return true;
        }
    }

    public function check_chapter(string $_crawler, string $_manga, int $_chapter)
    {
        if ($_crawler == "mangapanda") {
            $url = "http://www.mangapanda.com/$_manga/$_chapter";

            $html = file_get_contents($url);
            if (!$html) {
                return false;
            }
            return true;
        }
    }
}
