<?php
/**
 * Default controller
 *
 * @author Kondratenko Alexander (Xander)
 */

namespace controllers;

use object;
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

    /**
     * Render main form
     *
     * @author Kondratenko Alexander (Xander)
     */
    public function index()
    {
        // prepare form data
        $form_data = array(
            'draw_types' => $this->draw_types,
        );

        if (!empty($this->get['type']) && in_array($this->get['type'], $this->draw_types))
        {
            $class_name = 'object\\' . ucfirst($this->get['type']);

            $figure = new $class_name();

            // add figure params to form data
            $form_data['params'] = $figure->_getFields();
        }

        $this->view->render('draw_form', $form_data);
    }

    /**
     * Draw select figure
     *
     * @return bool
     *
     * @author Kondratenko Alexander (Xander)
     */
    public function draw()
    {
        if (empty($this->get['type']))
        {
            return FALSE;
        }

        $class_name = 'object\\' . ucfirst($this->get['type']);
        $figure = new $class_name();
        return $figure->draw($this->get['params']);
    }
}