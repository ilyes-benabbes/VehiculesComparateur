<?php

// require __DIR__ ."/../../components/vehicleSection.php";
require __DIR__ ."/../../components/vehicleDescSection.php";

class VehicleDescriptionPage {
    function showResult($res)
    {
        echo '<pre>';
        print_r($res);
        echo '</pre>';
    }
    function configure(){
        echo '<link rel="stylesheet" href="./public/css/vehicleDescription.css">';
        echo '<script src="public/js/vehicleDescription.js"></script>';
    }


    function show($carId){
        // $this->configure();
     
        $this->showAllCarData($carId);
        // $this->showPopularComparisonsByCarId($carId);
        // $this->showTopPopularReviews($carId);
    }
    function showAllCarData($id){
        $controller = new VehiclesController();
        $car = $controller->getVehicleById($id);
        $vehicleSection = new VehicleSection();
        $vehicleSection->render($car);
    }

    function showPopularComparisonsByCarId($id){
        // make a comparison card (it has a row , and inside it 2 columns , each column has a car card ) and in the middle bottm a button to compare

        $ctrl = new VehiclesController();
        $comparisonsIds =  $ctrl->getPopularComparisonByCarId($id , 3);
        $isEmpty = empty($comparisonsIds);
        if($isEmpty){
            echo "<h1>no comparisons found for this car</h1>";
        }else{
            echo "<div class='comparisons'>";
            echo'<button class="leftArrow">
            <
             </button>';
            echo  '<div class="popularComparisons border rowLeft">' ;  
            echo '<div class="slidesContainer">';    
                foreach ($comparisonsIds as $comparison){
                    $arrofVs = $ctrl->getVehiculesByComparisonId($comparison["id"]);
                    $card = new ComparisonCard();
                    $card->render($arrofVs);
                }
                echo "</div>";
                 echo ' </div>';
                echo   ' <button class="rightArrow arrow">
                >
                 </button>';
                echo ' </div>';
        }
    }

    function showTopPopularReviews($id){
        $ctrl = new VehiclesController();
        $reviews = $ctrl->getTopPopularReviewsByCarId(4 , 3);
        $isEmpty = empty($reviews);
        if($isEmpty){
            echo "<h1>no reviews found for this car</h1>";
        }else{
            echo "<div class='carReviews col'>";
         echo '<h1>Top Popular Reviews</h1>';
            echo '<div class="slidesContainer">';    
                foreach ($reviews as $review){
                    $card = new ReviewCard();
                    $card->render($review);
                }
                 echo ' </div>';
               
                echo ' </div>';
        }
    }



}