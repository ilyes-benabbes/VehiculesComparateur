<?php
// ! this is the api controller

require_once __DIR__ . "/../controllers/homeController.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
        case 'addForm':

            $ctrl = new HomeController();
            // $ctrl = new VehicleController();
            // $ctrl->addForm();
            
            $ctrl->addForm();

            break; 

        case 'getNextSelect':

            $selectType = $_POST['type'];
            $selectedValues = $_POST['payload']; 
            $ctrl = new HomeController();
            $ctrl->getNextSelect($selectedValues , $selectType);

            break;

            default:

            break;
        }
    }
}