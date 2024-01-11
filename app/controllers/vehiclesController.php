<?php
require_once __DIR__ . '/../views/pages/homePage/homePage.php';
require_once __DIR__ . '/../controllers/mainController.php';
require_once __DIR__ . '/../views/layout.php';
require_once __DIR__ . '/../views/helperView.php';
require_once __DIR__ . '/../models/vehiculesModel.php';

class VehiclesController extends MainController
{
    function editCar($id , $data){
        $model = new VehiculesModel();
        $model->editCar($id , $data);
    }


function getColorsByVehicleId($id){
    $model = new VehiculesModel();
    $res = $model->getColorsByVehicleId($id);
    return $res;
}

function deleteVehicle($id){
    $model = new VehiculesModel();
    $model->deleteCar($id);
}

function getAllColors(){
    $model = new VehiculesModel();
    $res = $model->getAllColors();
    return $res;
}

    
    //!!! admin functions begin
    function deleteImage($imgPath ){
        $model = new VehiculesModel();
        $model->deleteImage($imgPath);
    } 

function addFeature($data){
    $model = new VehiculesModel();
    $model->addFeature($data);
}
    function addVersion($data)
    {
        $model = new VehiculesModel();
        $model->addVersion($data);
    }

    function getAllCars()
    {
        $model = new VehiculesModel();
        $res = $model->getAllCars();
        return $res;
    }

    function addVehicle($data){
        $model = new VehiculesModel();
        $carId = $model->addVehicle($data);
        $model->addFeaturesToCar($carId , $data['features']);
        $model->addImagesofCar($carId , $data['images']);
        $model->addColorsofCar($carId , $data['colors']);
    }

    function getVersions()
    {
        $model = new VehiculesModel();
        $res = $model->getVersions();
        return $res;
    }

    function getFeatures()
    {
        $model = new VehiculesModel();
        $res = $model->getFeatures();
        return $res;
    }




    //!!! admin functions end

    function addToFavourite($id)
    {
        if  (!isset($_COOKIE["logedIn_user"])) {
            echo "you must be logged in to add to favourite";
            return;}

        $model = new VehiculesModel();
        $model->addToFavourite($id , $_COOKIE["logedIn_user"]);
    }

    function getFavoriteVehicles($id){
        $model = new VehiculesModel();
        $Vids = $model->getFavoriteVehiclesByUserId($id);
        $popCars = [] ;
      
        for ($i=0; $i < count($Vids) ; $i++) { 
            $popCars[$i] = $model->getVehicleById($Vids[$i]['id']);
        }
        return $popCars;
       

    }


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
    function getVehicleById($id){

        $model = new VehiculesModel();
       $fullCarData = $model->getVehicleById($id)[0];

        $keyfeatures =  $model->getKeyFeaturesById($id);
        $availableColors =$model->getColorsByVehicleId($id);

      

        $images = $model->getImagesByVehicleId($id);
        //! to decomment later
        // $rating =  $model->getVehicleRatingById($id)["rating"];


        
            foreach($keyfeatures as $key=>$feature){
                $fullCarData["features"][] = $feature["featureName"];
            }
            foreach($availableColors as $key=>$color){
                $fullCarData["colors"][] = $color["name"];
            }
            foreach($images as $key=>$image){
                $fullCarData["images"][] = $image["imagePath"];
            }

            // $fullCarData["rating"] =$rating ;
            $fullCarData["rating"] =4.5 ;



        return $fullCarData;
    }


    function getPopularComparisonByCarId($id , $nbr){
        $model = new VehiculesModel();
        $res = $model->getPopularComparisonByCarId($id , $nbr);
  

        return $res;
    }
function getTopPopularReviewsByCarId($id , $nbr){ 
    $model = new VehiculesModel();
    $res = $model->getTopPopularReviewsByCarId($id , $nbr);
    
    return $res; } 


    function getReviewsOfVehicle($id ){
        $reviewPerPage = 5 ;
        $model = new VehiculesModel();
        $res = $model->getReviewPerVehicle($id ,  $reviewPerPage);
        return $res;
    }
    

}
