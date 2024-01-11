<?php 
// require_once __DIR__ . "/../../controllers/vehiclesController.php";
require_once __DIR__ . "/../../components/pagination.php";
require_once __DIR__ . "/../../components/reviewCard.php";
class ReviewOfSelectedCarPage{
    function showResult($res)
    {

        echo '<pre>';
        print_r($res);
        echo '</pre>';

    }

    protected $carId;
    protected $page;

    function __construct($carId , $page){
        $this->carId = $carId;
        $this->page = $page;
    }
    
        
    
    function show(){
      $this->showFirstSection();
      $this->showReviewPaginationSection($this->page);
        // in this page , what should i do ?
        // car id i show the image of car , it name  on the right , side  big button to go to car details . 
        // and reviews here of the car 5 by five ghir  b chwiya .
    }
        
    function showFirstSection(){
        $ctrl = new VehiclesController();
        $car = $ctrl->getVehicleById($this->carId);
        echo "<div class='firstSection fullWidth col'>";
        echo "<div class='carImage'>";
        echo "<img src='".$car['image']."' alt=''>";
        echo "</div>";  
        echo "<div class='row'>";
        echo "<h1>".$car['name']."</h1>"; 
        echo "<button id=".$car['id']."'>  go to car details </button>";
        echo "</div>";
        
    }

    function showReviewPaginationSection($page){

       //??  i just render the first five , 
       //? id pass the page to it and that's it i think

        $ctrl = new VehiclesController();
        $reviews = $ctrl->getReviewsOfVehicle($this->carId );
        // echo $this->carId ; 
        $reviewsToRender =[]; 
        for ($i=0; $i < count($reviews); $i++) { 
            $temp = $reviews[0] ; 
            $temp['first_name'] = "first name ".$i ;
            $reviewsToRender[$i] = new ReviewCard();
            // $reviewsToRender[$i] = new ReviewCard($reviews[0]);
        }
        $pagination = new Pagination( $reviews , 5, $page);
        $pagination->render();
         
    }

        
    
    
}