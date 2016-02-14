<?php
/**
 * Square Class
 *
 * @author Kondratenko Alexander (Xander)
 */

namespace object;

class Square extends Object
{
    /**
     * Special Square param
     * @var int
     */
    public $perimeter = 1000;

    private $padding = 10;

    public function draw($data)
    {
        $img = $this->prepare_image($data);

        // draw filled rectangle first
        if (!empty($data['fill_color']))
        {
            imagefilledrectangle(
                $img,
                $this->padding,
                $this->padding,
                $data['perimeter'] / 4,
                $data['perimeter'] / 4,
                $this->get_line_color($img, $data['fill_color'])
            );
        }

        // draw 'borders'
        ImageRectangle(
            $img,
            $this->padding,
            $this->padding,
            $data['perimeter'] / 4,
            $data['perimeter'] / 4,
            $this->get_line_color($img, $data['line_color'])
        );

        $this->_draw($img);
    }

    public function draw3d($data)
    {
        // TODO: Implement draw3d() method.
    }
}