<?php
require_once("./app/controllers/mainController.php");

class MainView {
    protected $controller; 

    function __construct(MainController $controller) {
        $this->controller = $controller;  // Remove the dollar sign before 'controller'
    }
}
