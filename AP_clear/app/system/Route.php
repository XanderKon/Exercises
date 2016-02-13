<?php

/**
 * SIMPLE ROUTER CLASS
 *
 * @author Kondratenko Alexander (Xander)
 */
namespace routes;

use sys_controllers;
use controllers;

class Route extends sys_controllers\Controller
{
    private static $url;
    private static $controller = 'controllers\Index';
    private static $method = 'index';
    private static $params = array();
    private static $routes = array();

    /**
     * Define some stuff vars
     *
     * @author Kondratenko Alexander (Xander)
     */
    private static function define_vars()
    {
        self::$url = $_SERVER['REQUEST_URI'];

        if (!empty(parse_url(self::$url)['query']))
        {
            parse_str(parse_url(self::$url)['query'], self::$params);
        }

        // parse url
        $url = explode('/', parse_url(self::$url)['path']);

        // define controller & method
        self::$controller = !empty($url[1]) ? 'controllers\\' . $url[1] : self::$controller;
        self::$method = !empty($url[2]) ? $url[2] : self::$method;
    }

    /**
     * Provide set new router functionality
     *
     * @param $pattern
     * @param $action
     *
     * @author Kondratenko Alexander (Xander)
     */
    public static function set($pattern, $action)
    {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        self::$routes[$pattern] = $action;
    }

    /**
     * Provide simple route workflow by controller/method
     *
     * return mixed
     */
    public static function init()
    {
        self::define_vars();

        // check special set routes
        foreach (self::$routes as $pattern => $action)
        {
            if (preg_match($pattern, self::$url, $params))
            {
                return call_user_func_array($action, array_values(array_shift($params)));
            }
        }

        // default routes
        if (class_exists(self::$controller))
        {
            return call_user_func_array(array(new self::$controller(), self::$method), self::$params);
        }

        return self::return_404();
    }

    private static function return_404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        header('Location:' . $host . '404');
        return FALSE;
    }
}