<?php
require_once __DIR__ ."/../../components/carCard.php";
require_once __DIR__ ."/../../components/reviewCard.php";
require_once __DIR__ ."/../../components/brandSection.php";
require_once __DIR__ ."/../../pages/vehiclePages/vehicleDesciptionPage.php";
class BrandsPage{
     function configure(){
        echo '<link rel="stylesheet" href="./public/css/brands.css">';
        echo '<script src="public/js/brands.js"></script>';
     }
        function show(){
            $this->configure();
           
            // $menu = new Menu();
            // $menu->render();
            $this->showBrandsDrawer();  
          



            //todo testing the page of vehicles 
            // $vehiclePage = new VehicleDescriptionPage();
            // $vehiclePage->show(4);

        }
        function showResult($res)
        {
            echo '<pre>';
            print_r($res);
            echo '</pre>';
        }


        function showBrandsDrawer(){
            $helperView = new HelperView();
            echo "<div class='brandsSection'>";
            echo "<h1>Brands : </h1>"; 
            echo "<p>please select a brand to show its informations</p>";
            $helperView->renderBrandsDrawer("350px");
            echo "</div >";
        }
        function showSelectedBrand($id){
            // this function show brans , popular cars , and review section
            // $this->showBrandDataById($id);
            // ! here show the popular carCards and the dropDown list of all cars
            // $this->showPopularCarsSection($id);
            
            // ! here show the reviews section and the review section to add a review
        
            // $this->showReviewSection($id);

        }

        // function showReviewSection($id){
        //     $NUMBER_OF_REVIEWS_TO_SHOW = 3;
        //     $controller = new brandsController();
        //     $reviewList = $controller->getReviewsByBrandId($id , $NUMBER_OF_REVIEWS_TO_SHOW);
        //     $isEmpty = empty($reviewList);
        //     if($isEmpty){
        //         echo "<div class='reviewsSection col'>";
        //         echo "<h1>Reviews : </h1>";
        //         echo "<p>There are no reviews for this brand yet , be the first to add a review</p>";
        //         echo "<button class='reviewBrandButton'>Add a review</button>";
        //         echo "</div>";
        //     } else {
        //         // show only three and the others are hidden 

        //     echo "<div class='reviewsSection col'>";

        //     foreach($reviewList as $key=>$review){

        //         if ($key >= $NUMBER_OF_REVIEWS_TO_SHOW){
        //             $isHidden = true;
        //         } else {
        //             $isHidden = false;
        //         }
                
        
        //         // the review must contain the user name , the review , the rating , the date of the review
        //         $reviewCard = new ReviewCard();
        //         // $reviewCard->render($review);
        //         $reviewCard->render($review , $isHidden);
        //     }
        //     echo "<button class='showMoreBrandReviewsButton' id={$id}>Show More Reviews</button>";
        //     echo "</div>";
        // }}

        // function showPopularCarsSection($id){
        //     $POPULAR_CARS_NUMBER = 1;
        //     $controller = new brandsController();
        //     $popularCars = $controller->getPopularCarsByBrandId($id , $POPULAR_CARS_NUMBER);
        //     $isEmpty = empty($popularCars);
        //     if($isEmpty){
        //         echo "<div class='popularCarsSection col'>";
        //         echo "<h1>Popular Cars : </h1>";
        //         echo "<p>There are no popular cars for this brand yet , be the first to add a car</p>";
        //         echo "<button class='addACar'>Add a car</button>";
        //         echo "</div>";
        //     } else {
        //     echo "<div class='popularCarsSection row'>";
        //     echo "<div class='row carCardsContainer'> ";
        //     foreach($popularCars as $key =>$car){
        //         $carCard = new carCard();
        //         $carCard->render($car[0]);
        //     }
        //     echo "</div>";  
            
        //     echo "<div>";
        //     echo "<h1>select a car : </h1>";
        //     $this->showCarsDropDownList($id);
        //     echo "</div>";
        //     echo "</div>";
        // }}
        
        // function showCarsDropDownList($id){
        //     $controller = new VehiclesController();
        //     $carsList = $controller->getVehiculesByBrandId($id);

        //     echo "<div class='dropDownSection col'>";
        //     echo "<h1>Select a model : </h1>";
        //     echo "<select name='cars' id='carsDropDownSelect'>";
        //     foreach($carsList as $car){
        //         echo "<option value='{$car["id"]}'>{$car["name"]}</option>";
        //     }
        //     echo "</select>";    
        //     echo "<button class='showSelectedCar'>See details</button>";
        //     echo "</div>";
            
        // } // end of function
            
            
            


        // function showBrandDataById($id){
        //     $controller = new brandsController();
        //     $brand = $controller->getBrandById($id);
        //     $this->showResult($brand) ;
        //     $brandSection = new brandSection();
        //     $brandSection->render($brand);
        // }


        //?page architecture : 
        //? 1- show the brands drawer
        //? 2- make a prompt , please select a brand to show its informations 
        //? 3- on click on a brand , in the jquery file , i will send to the controller the id of the brand
        //? 4- the controller will send the data to this view , and i will show it by making  a function aboce
        //? 5- inside that function , i call the controller to give me the following data :
        //? 5-1- the brandFull Infos , like origin , name , header quarters , year of Establishment....
        //? 5-2- show this in a componenet (brand Info) or table or whatever 
        //todo>>>> the brand info sectin or component 
        //todo : show cards of cars 
        //? 6- show the main cars of the brand , by calling the controller to give me the main cars of the brand
        //? 7- show a dropDown List of all resting cars .
//todo:the section idea:make three cars at left "OR" pick a car((in a dropDown list))on right side of the section 
        //? 9- show the Reviews sections (show3popularViewsForBrand($id))
        //? 10- show the reviewSection to add a review(this componenets on click of send get the review and the userId 
        //? and the brandId )
        //? most popular cars setion must calculate the rating of all cars and give the most 3 popular cars.
        // ?  before sending check if the userIsLoggedIn , using a cookie or i don't know ;
        
        // review.ocClick(function(){
        //     if(userIsLoggedIn){
            // reviewComponenetaddAType("reviewType");
            // make a rating section to rate the car or i don't know .
        

}