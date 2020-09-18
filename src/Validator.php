<?php

namespace MangaCrawlers;

class Validator
{
    public function check_crawler(string $_name)
    {
        $arr = ['mangapanda'];

        if (in_array($_name, $arr)) {
            return true;
        }
        return false;
    }

    public function check_manga(string $_name)
    {
        $url = "http://www.mangapanda.com/$_name";

        $html = file_get_contents($url);
        if (!$html) {
            $this->error["message"] = "url intrrupt";
            return false;
        }
        return true;
    }
}
