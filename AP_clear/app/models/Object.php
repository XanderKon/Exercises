<?php
/**
 * Created by PhpStorm.
 * User: computer
 * Date: 12.02.16
 * Time: 17:33
 */

namespace object;

use Exception;

abstract class Object
{
    /**
     * Allow px and em
     * @var
     */
    public $line_height = '1 em';

    /**
     * Hex color code
     * @var string
     */
    public $line_color = '#006600';

    /**
     * Hex color code
     * @var string
     */
    public $fill_color = '#669933';


    public function set_property($name, $value)
    {
        if (property_exists($this, $name))
        {
            $this->{$name} = $value;
            return TRUE;
        }

        throw new Exception('Non-supported property');
    }

    /**
     * Return all object variables
     *
     * @return array
     *
     * @author Kondratenko Alexander (Xander)
     */
    final public function _getFields()
    {
        $vars = array();

        foreach (array_keys(get_class_vars(get_called_class())) as $var)
        {
            $vars[] = $var;
        }
        return $vars;
    }

    /**
     * Draw the object
     *
     * @return mixed
     */
    abstract public function draw();

}