<?php

namespace MangaCrawlers;

use Exception;

/**
 * [MangaPanda description]
 */
class MangaPanda
{
    /**
     * [$error description]
     *
     * @var [type]
     */
    private $error = [];

    /**
     * [download description]
     *
     * @param   [type]  $_name     [$_name description]
     * @param   [type]  $_chapter  [$_chapter description]
     *
     * @return  boolean|string return false on failure (and also fill $error) and path of downloaded folder
     *
     */
    public function download(string $_name, int $_chapter, string $_path)
    {
        $_name = filter_var($_name, FILTER_SANITIZE_STRING);
        $_chapter = intval($_chapter);
        if ($_chapter === 0) {
            $this->error["message"] = "chapter not defiend";
            return false;
        }
        $_path = filter_var($_path, FILTER_SANITIZE_STRING);

        $last_page = $this->last_page_finder($_name, $_chapter);
        for ($i = 1; $i < $last_page; $i++) {
            $decider = true;
            $save_image_path =
                $this->make_manga_dir($_path, "mangapanda", $_name, $_chapter) . $i . '.jpg';
            try {
                if (!copy($this->image_finder($_name, $_chapter, $i), $save_image_path)) {
                    throw new Exception();
                }
            } catch (Exception $e) {
                for ($k = 0; $k < 4; $k++) {
                    try {
                        if (!copy($this->image_finder($_name, $_chapter, $i), $save_image_path)) {
                            throw new Exception();
                        } else {
                            $decider = true;
                            break;
                        }
                    } catch (Exception $e) {
                        if ($k == 4) {
                            $decider = false;
                        }
                    }
                }
                if (!$decider) {
                    $this->error["message"] = "coulnt download page number $i";
                    return $decider;
                }
            }
        }
    }

    /**
     * [get_inner_string description]
     *
     * @param   [type]  $string  [$string description]
     * @param   [type]  $begin   [$begin description]
     * @param   [type]  $end     [$end description]
     *
     * @return  [type]           [return description]
     */
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

    /**
     * [last_page_finder description]
     *
     * @param   [type]  $_name     [$_name description]
     * @param   [type]  $_chapter  [$_chapter description]
     *
     * @return  [type]             [return description]
     */
    private function last_page_finder($_name, $_chapter)
    {
        $url = "http://www.mangapanda.com/$_name/$_chapter";

        $html = file_get_contents($url);
        if (!$html) {
            $this->error["message"] = "url intrrupt";
            return false;
        }

        $last_page = intval($this->get_inner_string($html, '</select> of ', '</div>'));
        if ($last_page > 0) {
            return $last_page;
        }
        $this->error["message"] = "last page intrrupt";
        return false;
    }

    /**
     * [image_finder description]
     *
     * @param   [type]  $_name     [$_name description]
     * @param   [type]  $_chapter  [$_chapter description]
     * @param   [type]  $_page     [$_page description]
     *
     * @return  [type]             [return description]
     */
    private function image_finder($_name, $_chapter, $_page)
    {
        $url = "http://www.mangapanda.com/$_name/$_chapter/$_page";

        $html = file_get_contents($url);
        if (!$html) {
            $this->error["message"] = "couldent get the site content";
            return false;
        }
        $image_url = $this->get_inner_string($html, 'id="img"', 'alt=');
        $image_url = substr($image_url, strpos($image_url, 'https://'));
        $image_url = substr($image_url, 0, strpos($image_url, '"'));

        if (strlen($image_url) > 10) {
            return $image_url;
        }
        $this->error["message"] = "finder can't find";
        return false;
    }

    /**
     * [make_manga_dir description]
     *
     * @param   [type]  $job  [$job description]
     *
     * @return  [type]        [return description]
     */
    private function make_manga_dir($_path, $_crawler, $_name, $_chapter)
    {
        $file_crawler_path = $_path . $_crawler . '/';
        if (!file_exists($file_crawler_path)) {
            if (!mkdir($file_crawler_path)) {
                $this->error["message"] = "couldnt make crawler path";
                return false;
            }
        }
        $file_manga_path = $file_crawler_path . $_name . '/';
        if (!file_exists($file_manga_path)) {
            if (!mkdir($file_manga_path)) {
                $this->error["message"] = "couldnt make manga path";
                return false;
            }
        }
        $file_chapter_path = $file_manga_path . $_chapter . '/';
        if (!file_exists($file_chapter_path)) {
            if (!mkdir($file_chapter_path)) {
                $this->error["message"] = "couldnt make chapter path";
                return false;
            }
        }
        return $file_chapter_path;
    }

    /**
     * [get_error description]
     *
     * @return  boolean|array  return false on no error
     */
    public function get_error()
    {
        if (empty($this->error)) {
            return false;
        }
        return $this->error;
    }
}
