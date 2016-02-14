<?php
/**
 * Main Object Class
 *
 * This is a parent class for all geometric figure
 *
 * @author Kondratenko Alexander (Xander)
 */

namespace object;

use Exception;
use models\Model;

abstract class Object extends Model
{
    /**
     * In pixels
     * @var
     */
    public $line_width = '1';

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

    /**
     * @var string
     */
    private $image_width = '500';

    /**
     * @var string
     */
    private $image_height = '500';


    /**
     * Set just one object param
     *
     * @param $name
     * @param $value
     *
     * @return bool
     * @throws Exception
     *
     * @author Kondratenko Alexander (Xander)
     */
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
     * Set base params by user query
     *
     * @param $data
     *
     * @author Kondratenko Alexander (Xander)
     */
    public function set_params($data)
    {
        foreach ($data as $param => $value)
        {
            if (property_exists($this, $param))
            {
                $this->{$param} = $value;
            }
        }
    }

    /**
     * Get "imagecolorallocate" color from HEX source
     *
     * @param resource $img
     * @param string   $hex
     *
     * @return mixed
     *
     * @author Kondratenko Alexander (Xander)
     */
    public function get_line_color($img, $hex)
    {
        $hex = ltrim($hex, '#');

        $red = hexdec(substr($hex, 0, 2));
        $green = hexdec(substr($hex, 2, 2));
        $blue = hexdec(substr($hex, 4, 2));

        return imagecolorallocate($img, $red, $green, $blue);
    }

    /**
     * Set line width
     *
     * @param $image
     *
     * @author Kondratenko Alexander (Xander)
     */
    public function set_line_width($image)
    {
        imagesetthickness($image, $this->line_width);
    }

    /**
     * Prepare image
     *  - set params
     *  - create image resource
     *  - set line width
     *
     * @param array $data
     *
     * @return resource
     *
     * @author Kondratenko Alexander (Xander)
     */
    protected function prepare_image($data)
    {
        // set object params
        $this->set_params($data);

        // create image resource
        $img = imagecreatetruecolor($this->image_width, $this->image_height);

        // make it white
        $white = imagecolorallocate($img, 255, 255, 255);
        imagefill($img, 0, 0, $white);

        // set line width
        $this->set_line_width($img);

        return $img;
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

        foreach (get_class_vars(get_called_class()) as $name => $value)
        {
            $vars[$name] = $value;
        }

        return $vars;
    }

    /**
     * Return image resource to browser
     *
     * @param $image
     *
     * @author Kondratenko Alexander (Xander)
     */
    final protected function _draw($image)
    {
        header("Content-type: image/png");
        imagepng($image);
        imagedestroy($image);
    }

    /**
     * Draw the object
     *
     * @return mixed
     *
     * @author Kondratenko Alexander (Xander)
     */
    abstract public function draw($data);

    /**
     * Draw the object on 3D
     *
     * @param $data
     *
     * @return mixed
     *
     * @author Kondratenko Alexander (Xander)
     */
    abstract public function draw3d($data);
}