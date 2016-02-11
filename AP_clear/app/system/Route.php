<?php

namespace routes;

use sys\controllers;

class Route
{
    private static $url;
    private static $controller = 'Controller';
    private static $method = 'index';

    private static $routes = array();

    private static function define_vars()
    {
        self::$url = $_SERVER['REQUEST_URI'];

        // parse url
        $url = explode('/', self::$url);

        // define controller & method
        self::$controller = !empty($url[1]) ? $url[1] : self::$controller;
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
    public function set($pattern, $action)
    {
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        self::$routes[$pattern] = $action;
    }

    /**
     * Provide simple route workflow by controller/method
     *
     * return mixed
     */
    static function init()
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
        $_controller = self::$controller . '.php';

        if (file_exists(CONTROLLERSPATH . $_controller))
        {
            require_once CONTROLLERSPATH . $_controller;

            var_dump(self::$controller())

            if (method_exists($object = new controllers\self::$controller(), $method = self::$method))
            {
                return $object->$method();
            }
        }
        elseif (file_exists(SYSTEMPATH . $_controller))
        {
            require_once SYSTEMPATH . $_controller;

            // TODO: fix namespace
            if (method_exists($object = new \sys\controllers\Controller(), $method = self::$method))
            {
                return $object->$method();
            }
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