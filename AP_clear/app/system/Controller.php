<?php
/**
 * Base controller Class
 *
 * @author Kondratenko Alexander (Xander)
 */

namespace sys_controllers;
use views;

class Controller
{
    public $view;

    public $get;
    public $post;

    function __construct()
    {
        // init View
        $this->view = new views\View();

        // init GET & POST data
        $this->get = $_GET;
        $this->post = $_POST;
    }
}