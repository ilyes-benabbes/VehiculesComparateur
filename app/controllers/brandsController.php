<?php
require_once __DIR__."/../controllers/mainController.php";
require_once __DIR__."/../models/brandsModel.php";

class BrandsController   extends MainController{

    function deleteBrand($id){
        $model = new BrandsModel();
        $model->deleteBrand($id);
    }

    function editBrand($id , $data){
        $model = new BrandsModel();
        $model->updateBrandById($id , $data);
    }
    


    function deleteImage($id ){
        $model = new BrandsModel();
        $model->deleteImage($id);
    }

    function updateBrandById($id , $data){
        $model = new BrandsModel();
        $model->updateBrandById($id , $data);
    }
    public function addBrand($data){
        $this->showResult($data);
        $model = new BrandsModel();
        $brandId = $model->addBrand($data["name"] , $data["origin"] , $data["yearOfCreation"] , $data["founder"] , $data["ceo"] , $data["headQuarters"] , $data["worth"] , $data["description"] , $data["slogan"] , $data["imagePath"] , $data["videoPath"]);
        $this->addfacts($brandId , $data["facts"]);
        $this->addAwards($brandId , $data["awards"]);
   
    }
    public function addfacts( $id , $data){
        $model = new BrandsModel();
        $model->addFacts($id , $data);
    }
    public function addAwards($id , $data){
        $model = new BrandsModel();
        $model->addAwards($id  , $data);
    }














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

       $fullBrandData = $model->getBrandById($id)[0]??  null;
         if(!$fullBrandData){
              return null;
         }
       $facts =  $model->getBrandFactsById($id);
     
    $awards =  $model->getBrandAwardsById($id); 

    foreach($facts as $key =>$fact){
        $fullBrandData["notableFacts"][] = $fact["factText"] ;
    }

    foreach($awards as $key=>$award){
        $fullBrandData["awards"][] = $award["awardName"];
    }
    // $fullBrandData["rating"] = $model->getBrandRatingById($id)["rating"];

    // echo " this is the first brand after all change "; 
    //    $this->showResult($fullBrandData);

    return $fullBrandData ;
   }

  
}