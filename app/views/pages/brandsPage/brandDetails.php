<?php 
require_once __DIR__ . "/../../../controllers/brandsController.php";
require_once __DIR__ . "/../../components/brandSection.php";
require_once __DIR__ . "/../../components/reviewCard.php";
class BrandDetailsPage{
    private $id;

    function __construct($id)
    {
        $this->id = $id;
    }


    function show(){
   $this->showBrandDataById($this->id);


    // ! here show the popular carCards and the dropDown list of all cars
    $this->showPopularCarsSection($this->id);
            
    // ! here show the reviews section and the review section to add a review
    $this->showReviewSection($this->id);


}

function showBrandDataById($id){
    $controller = new brandsController();
    $brand = $controller->getBrandById($id);
    $brandSection = new BrandSection();
    $brandSection->render($brand);
}



function showPopularCarsSection($id){
    $POPULAR_CARS_NUMBER = 3;
    $controller = new brandsController();
    $popularCars = $controller->getPopularCarsByBrandId($id , $POPULAR_CARS_NUMBER);
    $isEmpty = empty($popularCars);
    if($isEmpty){
        echo "<div class='popularCarsSection col'>";
        echo "<h1>Popular Cars : </h1>";
        echo "<p>There are no popular cars for this brand yet , be the first to add a car</p>";
        echo "<button class='addACar'>Add a car</button>";
        echo "</div>";
    } else {
        echo "<div class='popularCarsSection col'>";
        echo "<h1>Popular Cars : </h1>";
        echo "<div class='row g3'> ";
    echo "<div class='row carCardsContainer'> ";
    foreach($popularCars as $key =>$car){
        $carCard = new carCard();
        $carCard->render($car[0]);
    }
    echo "</div>";  // end of cards decks 

    echo "<h2>OR</h2>";
    
    echo "<div>";
    $this->showCarsDropDownList($id);
    echo "</div>";

    echo "</div>";
}}

function showCarsDropDownList($id){
    $controller = new VehiclesController();
    $carsList = $controller->getVehiculesByBrandId($id);

    echo "<div class='dropDownSection col'>";
    echo "<h1>Select a model : </h1>";
    echo "<select name='cars' id='carsDropDownSelect'>";
    foreach($carsList as $car){
        echo "<option value='{$car["id"]}'>{$car["name"]}</option>";
    }
    echo "</select>";    
    echo "<button class='showSelectedCar'>See details</button>";
    echo "</div>";
    
} // end of function
    


function showReviewSection($id){
    $NUMBER_OF_REVIEWS_TO_SHOW = 3;
    $controller = new brandsController();
    $reviewList = $controller->getReviewsByBrandId($id , $NUMBER_OF_REVIEWS_TO_SHOW);

    // check if the user is logged in or not , if it is , gets its reactions to the reviews
    if(isset($_COOKIE["logedIn_user"])){
        $userId = $_COOKIE["logedIn_user"];
        $userReactions = $controller->getUserReactionsToReviewsByBrandId($userId , $id);
        
    } else {
        $userReactions = null;
    }


    $isEmpty = empty($reviewList);
    if($isEmpty){
        echo "<div class='reviewsSection col'>";
        echo "<h1>Reviews : </h1>";
        echo "<p>There are no reviews for this brand yet , be the first to add a review</p>";
        echo "<button class='reviewABrand'>Add a review</button>";
        echo "</div>";
    } else {
        echo "<div class='reviewsSection col'>";
        echo "<h1>Reviews : </h1>";
    
    
        $isHidden = false ;
        foreach($reviewList as $key=>$review){

            if  ($key >= $NUMBER_OF_REVIEWS_TO_SHOW){
                $isHidden = true;
            } else {
                $isHidden = false;
            } 


        $like = false ; 
        $dislike = false ;
        $reviewCard = new ReviewCard();
      foreach($userReactions as $key=>$reaction){


          if($reaction["brandreview_id"] == $review["id"]){
              if($reaction["reaction"] == "liked"){
                  $like = true;
              } else
              if($reaction["reaction"] == "disliked") {
                  $dislike = true;
              }
          } 
        }
        
        $reviewCard->render($review , $like , $dislike , $isHidden , "brand");
    }
}

    echo "<button class='showAllBrandReviewButton' id={$id}>Show all Reviews</button>";
    echo "</div>";
}

}

