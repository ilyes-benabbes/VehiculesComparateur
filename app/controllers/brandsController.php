<?php
require_once "./app/controllers/mainController.php";

class BrandsController   extends MainController{
    function showResult($res)
    {
        echo '<pre>';
        print_r($res);
        echo '</pre>';
    }

    function getReviewsByBrandId($id , $nbrOfReviews){
        $model= new BrandsModel();
        return $model->getReviewsByBrandId($id , $nbrOfReviews);
    }

   function getPopularCarsByBrandId($id , $nbrOfCarsToShow){
    $model= new VehiculesModel();
    $popCars = [] ;
    $popCarsIds =  $model->getPopularCarsByBrandId($id , $nbrOfCarsToShow);
    for ($i=0; $i < count($popCarsIds) ; $i++) { 
        $popCars[$i] = $model->getVehicleById($popCarsIds[$i]['id']);
    }
    return $popCars;
   }
   function getBrandById($id){
       $model= new BrandsModel();
       $fullBrandData = $model->getBrandById($id)[0];
       $facts =  $model->getBrandFactsById($id);
     
    $awards =  $model->getBrandAwardsById($id); 

    // hey ai are you here 
    foreach($facts as $key =>$fact){
        $fullBrandData["notableFacts"][] = $fact["factText"] ;
    }

    foreach($awards as $key=>$award){
        $fullBrandData["awards"][] = $award["awardName"];
    }
    $fullBrandData["rating"] = $model->getBrandRatingById($id)["rating"];

    echo " this is the first brand after all change "; 
       $this->showResult($fullBrandData);

    return $fullBrandData ;
   }

  
}