<?php

// require __DIR__ ."/../../components/vehicleSection.php";
require __DIR__ ."/../../components/vehicleDescSection.php";
require_once __DIR__ ."/../../components/reviewCard.php";

class VehicleDescriptionPage {

  private  $carId= null ;

  function __construct($id)
  {
    $this->carId = $id ;
  }

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


    function show(){
        $carId = $this->carId;
        // $this->configure();
     
        $this->showAllCarData($carId);
        $this->showPopularComparisonsByCarId($carId);
        $this->showTopPopularReviews($carId);
    }

    function showAllCarData($id){
        $controller = new VehiclesController();
        $car = $controller->getVehicleById($id);
        $vehicleSection = new VehicleSection();
        $vehicleSection->render($car);
    }

    function showPopularComparisonsByCarId($id){ 
        $nbr = 3;
        // make a comparison card (it has a row , and inside it 2 columns , each column has a car card ) and in the middle bottm a button to compare

        $ctrl = new VehiclesController();
        $comparisonsIds =  $ctrl->getPopularComparisonByCarId($id , $nbr);
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
                    $card->render($arrofVs , $comparison["id"]);

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
        $nbrofReview =3 ;
        $ctrl = new VehiclesController();
        $reviews = $ctrl->getTopPopularReviewsByCarId($id );
        $isHidden = false;

        if(isset($_COOKIE["logedIn_user"])){
            $userId = $_COOKIE["logedIn_user"];
         $userReactions = $ctrl->getUserReactionsToReviewsByCarId( $userId);
       
        } else {
            $userReactions = null;
        }
 
        $isEmpty = empty($reviews);
        if($isEmpty){
            echo "<h1>no reviews found for this car</h1>";
        }else{
            echo "<div class='carReviews col'>";
         echo '<h1>Top Popular Reviews</h1>';
            echo '<div >';    
                foreach ($reviews as $key=>$review){
                    if ($key >= $nbrofReview){
                        $isHidden = true;
                    } else {
                        $isHidden = false;
                    }
                    $like = false ; 
                    $dislike = false ;
                    $card = new ReviewCard();


                    foreach($userReactions as $key=>$reaction){


                        if($reaction["vehiclereview_id"] == $review["id"]){
                            if($reaction["reaction"] == "liked"){
                                $like = true;
                            } else
                            if($reaction["reaction"] == "disliked") {
                                $dislike = true;
                            }
                        } 
                      }


                    $card->render($review ,$like , $dislike, $isHidden , "car");

                }
                 echo ' </div>';

                 echo "<button class='showAllCarReviews' id={$id}>Show all Reviews</button>";
                 
               
                echo ' </div>';
        }
    }



}