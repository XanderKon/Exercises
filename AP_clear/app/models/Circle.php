<?php
/**
 * Circle Class
 *
 * @author Kondratenko Alexander (Xander)
 */

namespace object;

class Circle extends Object
{
    /**
     * Special circle param
     * @var int
     */
    public $radius = 100;

    private $padding = 100;

    public function draw($data)
    {
        $img = $this->prepare_image($data);

        if (!empty($data['fill_color']))
        {
            imagefilledellipse (
                $img,
                $this->padding + $data['radius'],
                $this->padding + $data['radius'],
                $data['radius'],
                $data['radius'],
                $this->get_line_color($img, $data['fill_color'])
            );
        }

        imagearc(
            $img,
            $this->padding + $data['radius'],
            $this->padding + $data['radius'],
            $data['radius'],
            $data['radius'],
            0,
            360,
            $this->get_line_color($img, $data['line_color'])
        );

        $this->_draw($img);
    }
}