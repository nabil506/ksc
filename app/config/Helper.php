<?php

namespace app\config;

class Helper
{
    public static function error404()
    {
        http_response_code(404);
        require_once __DIR__. '/../view/error/error404.php';
        }

    public static function error405()
    {
        http_response_code(405);
        require_once __DIR__. '/../view/error/error405.php';
    }
}
