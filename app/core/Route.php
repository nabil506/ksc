<?php

namespace app\core;
session_start();

use app\config\Helper;


class Route
{

    private static $routes = [];
    public static function get($path, $controller, $function)
    {
        self::$routes[] = [
            'method' => 'GET',
            'path' => $path,
            'controller' => $controller,
            'function' => $function
        ];
    }
    public static function post($path, $controller, $function)
    {
        self::$routes[] = [
            'method' => 'POST',
            'path' => $path,
            'controller' => $controller,
            'function' => $function
        ];
    }

    public static function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $parseuri = parse_url($uri, PHP_URL_PATH);
        $requestmethod = $_SERVER['REQUEST_METHOD'];
        $found = false;
        foreach (self::$routes as $route) {
            if ($route['path'] === $parseuri) {
                $found = true;
                if ($route['method'] === $requestmethod) {
                    $controller = $route['controller'];
                    $function = $route['function'];
                    $instancecontroller = new $controller();
                    $instancecontroller->$function();
                    return;
                }
            }
        }
        if ($found) {
            return Helper::error405();
        }
        return Helper::error404();
    }
}
