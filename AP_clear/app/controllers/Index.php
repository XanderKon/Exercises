<?php
/**
 * Default controller
 *
 * @author Kondratenko Alexander (Xander)
 */

namespace controllers;

use object\Square;
use object\Object;
use sys_controllers\Controller;

class Index extends Controller
{
    /**
     * Available draw types
     *
     * @var array
     */
    private $draw_types = array(
        'square',
        'circle'
    );

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // prepare form data
        $form_data = array(
            'draw_types' => $this->draw_types,
        );

        $this->view->render('draw_form', $form_data);
    }
}