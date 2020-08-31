<?php
namespace classes;

class Utils
{
    static function render($path)
    {
        ob_start();
        include($path);
        $var = ob_get_contents();
        ob_end_clean();
        return $var;
    }

    static function rfile_exists($path)
    {
        return file_exists($path) ? $path : '../' . $path;
    }
}
