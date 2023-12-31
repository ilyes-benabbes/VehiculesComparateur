<?php
require_once __DIR__ . "/../controllers/mainController.php";


class MainView {
    protected $controller; 

    function __construct(MainController $controller) {
        $this->controller = $controller;  // Remove the dollar sign before 'controller'
    }
}
