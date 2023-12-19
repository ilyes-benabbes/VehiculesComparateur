<?php
require_once __DIR__ . '/../views/pages/homePage/homePage.php';
require_once  __DIR__ . '/../controllers/mainController.php';
require_once  __DIR__ . '/../views/layout.php';
require_once  __DIR__ . '/../models/vehiculesModel.php';

class HomeController extends MainController
{
    private static $instance;
    protected $homePage ; 

       // Public static method to provide access to the instance
       public static function getInstance() {
        if (self::$instance === null) {
            // If the instance is null, create a new one
            self::$instance = new self();
        }
        return self::$instance;
    }


function getRows($res){
    foreach ($res as $row) {
}}




function showResult($res){
    echo '<pre>';
    print_r($res);
    echo '</pre>';

}

    function showPage()
    {
        $this->homePage = new HomePage(HomeController::getInstance());
        $layout = new Layout();
        $layout->showPage($this->homePage);
    }


    function getBrands()
    {
        $model = new VehiculesModel();
        $res = $model->getBrands();

        foreach ($res as $row){
            $path =  $row["imagePath"];
        }
       ;
        return $res ;     
    }
}











echo "wtfabove";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "wtfunder";
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        echo "the action is " ; 
        echo $action ;
        
        switch ($action) {

            case 'addForm':
                // $this->homePage->renderAddFormBox();
                echo "hello there "; 
                
                break;


            default:
                // Handle unknown action
                break;
        }
    }
}