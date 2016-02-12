<?php
/**
 * Created by PhpStorm.
 * User: xander
 * Date: 12.02.16
 * Time: 0:10
 */

namespace sys_controllers;
use views;

class Controller
{
    public $model;
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

    function index()
    {
        echo 'This is default controller';
    }
}