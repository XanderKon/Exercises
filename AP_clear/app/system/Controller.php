<?php
/**
 * Created by PhpStorm.
 * User: xander
 * Date: 12.02.16
 * Time: 0:10
 */

namespace sys\controllers;
use views;

class Controller
{
    public $model;
    public $view;

    function __construct()
    {
        $this->view = new views\View();
    }

    function index()
    {
        echo 'Hello World';
    }
}