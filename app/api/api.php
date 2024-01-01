<?php
// ! this is the api controller
require_once __DIR__ . "/../controllers/vehiclesController.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
        case 'addForm':
            $ctrl = new VehiclesController();
            $ctrl->addFormComparisonForm();  
            break; 

        case 'getNextSelect':
            $selectType = $_POST['type'];
            $selectedValues = $_POST['payload']; 
            $ctrl = new VehiclesController();
            $ctrl->getNextSelect($selectedValues , $selectType);

            break;

        case 'compare' :
            $arrayOfVehicles = $_POST['payload'];
            $ctrl = new VehiclesController();
            $ctrl->compare($arrayOfVehicles);

            default:

            break;
        }
    }
}