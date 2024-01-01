<?php
require_once __DIR__ . '/../views/pages/homePage/homePage.php';
require_once __DIR__ . '/../controllers/mainController.php';
require_once __DIR__ . '/../views/layout.php';
require_once __DIR__ . '/../models/vehiculesModel.php';

class HomeController extends MainController
{
    protected $homePage;
    public $name = "home";

    function getRows($res)
    {
        foreach ($res as $row) {
        }
    }

    function showResult($res)
    {
        echo '<pre>';
        print_r($res);
        echo '</pre>';
    }

   

    function showPage()
    {
        $this->homePage = new HomePage();
        $layout = new Layout();
        $layout->showPage($this->homePage);
    }

    function getBrands()
    {
        $model = new VehiculesModel();
        $res = $model->getBrands();

        return $res;
    }
 
// to be deleted from here and moved into the vehicleController 
    function getNextSelect($payload , $selectType){
 
        $homepage = new HomePage($this);
        $model = new VehiculesModel();
        switch ($selectType) {
            case 'SelectBrand':
                $carModels = $model->getModelsOfBrandById($payload[$selectType]);
                $homepage->renderNextSelect("Model" , "SelectModel" , $carModels );

              
                break;
            case 'SelectModel':
                $versions = $model->getVersionsByVehicleId($payload["SelectModel"]);
                $homepage->renderNextSelect("Version" , "SelectVersion" , $versions );
                break;


                case 'SelectVersion':
                    $years = $model->getYearsByVersion_VehicleId( $payload["SelectModel"], $payload["SelectVersion"]);
                    $homepage->renderNextSelect("Year" , "SelectYear" , $years);
              
              
                break;
            
            case 'SelectYear':
                
                break;
        }

    }
// to be deleted from here and moved into the vehicleController
    function addForm()
    {
        $homePage = new HomePage($this);
        $homePage->renderForm();
    }

    function getMostPopularComparisons($nbr){
        $model = new VehiculesModel();
        $res = $model->getMostPopularComparisons($nbr);
        return $res;
    }

    function getVehiculesByComparisonId($id){
        $model = new VehiculesModel();
        $res = $model->getVehiculesByComparisonId($id);
        return $res;
    }


}
