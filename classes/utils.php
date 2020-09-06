<?php
namespace classes;
use classes\Messages;

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

    static function find_file($path)
    {
        while (false == file_exists($path)) {
            $path = '../' . $path;
        }
        return $path;
    }

    static function login_required($redirect_url='/user/login') {
        if (!isset($_SESSION['user'])) {
            Messages::add(
                "Must be <strong>logged in</strong> to use the system.",
                "warning"
            );
            header('Location: ' . $redirect_url);
        }
    }
}
