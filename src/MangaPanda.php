<?php

namespace MangaCrawlers;

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
     *
     *
     * @return  [type]  [return description]
     */
    public function __construct()
    {
    }

    /**
     * [download description]
     *
     * @param   [type]  $_name     [$_name description]
     * @param   [type]  $_chapter  [$_chapter description]
     *
     * @return  boolean|string return false on failure (and also fill $error) and path of downloaded folder
     *
     */
    public function download($_name, $_chapter, $_path)
    {
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
