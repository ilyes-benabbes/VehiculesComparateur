<?php
require_once __DIR__ . '/../views/pages/homePage/homePage.php';
require_once __DIR__ . '/../controllers/mainController.php';
require_once __DIR__ . '/../views/layout.php';
require_once __DIR__ . '/../views/helperView.php';
require_once __DIR__ . '/../models/vehiculesModel.php';

class VehiclesController extends MainController
{
    function showResult($res)
    {
        echo '<pre>';
        print_r($res);
        echo '</pre>';
    }
    function stringify($array){
        $res = "";
        foreach ($array as $element) {
            $res .= $element . " / ";
        }
        return $res;
    }  

    function getBrands()
    {
        $model = new VehiculesModel();
        $res = $model->getBrands();

        return $res;
    }

    function getVehiculesByBrandId($id){
        $model = new VehiculesModel();
        $carModels = $model->getModelsOfBrandById($id);
        return $carModels;
    }
    
        function getNextSelect($payload , $selectType){
     
            $model = new VehiculesModel();
            $view = new HelperView();
    
            switch ($selectType) {
                case 'SelectBrand':
                    $carModels = $model->getModelsOfBrandById($payload[$selectType]);
                    $view->renderNextSelect("Model" , "SelectModel" , $carModels );
                  
                    break;
                case 'SelectModel':
                    $versions = $model->getVersionsByVehicleId($payload["SelectModel"]);
                    $view->renderNextSelect("Version" , "SelectVersion" , $versions );
                    break;
    
    
                    case 'SelectVersion':
                        $years = $model->getYearsByVersion_VehicleId( $payload["SelectModel"], $payload["SelectVersion"]);
                        $view->renderNextSelect("Year" , "SelectYear" , $years);
                  
                    break;
                
                case 'SelectYear':          
                    break;
            }
    
        }
 

    function addFormComparisonForm()
    {
        $view = new HelperView(); 
        $view->renderComparisonForm();
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

    function compare($arrayOfVehiclesIds){
        $model = new VehiculesModel();
        $view = new HelperView();
        $tableRows = []; 

        
        foreach ($arrayOfVehiclesIds as $id) {
            
            $vehicle = $model->getVehicleById($id);
            $res = $model->getColorsByVehicleId($id); 
            $availableColors = [];
                // this to extract the colors from the array of arrays
            foreach ($res as $colorArray) {
                $availableColors[] = $colorArray["name"];
            }

            $availableColors = $this->stringify($availableColors);

            
            
            $model->getColorsByVehicleId($id);
            $vehicle = $vehicle[0];
            
            // add later in dataBase , fields like AvailableColors , fuelTypes , 
            $tableRows['image'][] = $vehicle['image'];
            $tableRows['brand'][] = $vehicle['brand'];
            $tableRows['model'][] = $vehicle['name'];
            $tableRows['version'][] = $vehicle['version'];
            $tableRows['price'][] = $vehicle['price'];
            $tableRows['number of seats'][]= $vehicle['number_of_seats']; 
            $tableRows['capacity'][] = $vehicle['capacity'];
            $tableRows['consumption'][] = $vehicle['consumption'];
            $tableRows['Engine power'][] = $vehicle['engine_power'];
            $tableRows['Year'][] = $vehicle['year'];
            $tableRows['width'][] = $vehicle['width'];
            $tableRows['height'][] = $vehicle['height'];
            $tableRows['length'][] = $vehicle['length'];
            $tableRows['weight'][] = $vehicle['weight'];
            $tableRows['max speed'][] = $vehicle['max_speed'];
            $tableRows['acceleration'][] = $vehicle['acceleration'];
            $tableRows['available colors'][] = $availableColors;    
        }

    


       

        $view->renderComparisonTable($tableRows);


    }

}
