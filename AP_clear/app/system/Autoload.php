<?php
/**
 * Simple class autoloader
 *
 * @author Kondratenko Alexander (Xander)
 */
namespace autoload;

class Autoload
{
    /**
     * Load class
     *
     * @param $class_name
     *
     * @return bool
     *
     * @author Kondratenko Alexander (Xander)
     */
    public static function load_class($class_name)
    {
        $path = explode('\\', $class_name);

        //var_dump($path);

        if (empty($path[1]))
        {
            return FALSE;
        }

        $_final_class = $path[1] . '.php';

        if (file_exists(SYSTEMPATH . $_final_class))
        {
            require_once($_final_class);
            return TRUE;
        }

        return FALSE;
    }
}