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
        $this->homePage = new HomePage($this);
        $layout = new Layout();
        $layout->showPage($this->homePage);
    }

    function getBrands()
    {
        $model = new VehiculesModel();
        $res = $model->getBrands();

        return $res;
    }
 

    function getNextSelect($payload , $selectType){
        // ? if i move this to a separate file called api.php , 
        // ? if another file want same info it can do that by calling the api.php file 
        // in the api file , i must instanciate the view , and model , and that's it i think 
        // 
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
