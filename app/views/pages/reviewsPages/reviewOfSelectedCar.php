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
        echo "<button id=".$car['id']." class='viewCarDetails'>  go to car details </button>";
        echo "</div>";
        
    }

    function showReviewPaginationSection($page){
        $itemsPerPage = 5;

       //??  i just render the first five , 
       //? id pass the page to it and that's it i think

        $ctrl = new VehiclesController();
        $reviews = $ctrl->getReviewsOfVehicle($this->carId );
        $this->showResult($reviews);
        // echo $this->carId ; 
        $reviewsToRender =[]; 
        for ($i=0; $i < count($reviews); $i++) { 
            $reviewsToRender[$i] = new ReviewCard();

            $totalPages = ceil(count($reviews) / $itemsPerPage);
    
            $output = '<ul class="pagination">';
                // echo '<li>' . $this->totalItemsToRender[$i] . '</li>';
                // if item is out of this page range make it hidden
                if($i >=4){
                    echo '<div class=" pageItem pageItem'.$i.'" style="display:none;" >'; 
                    $reviewsToRender[$i]->render( $reviews[$i],null,null, $this->carId , "car");
                    echo '</div>';
                    continue;
                }
                echo '<div class="row border g3 pageItem"  >'; 
                $reviewsToRender[$i]->render( $reviews[$i],null,null, $this->carId , "car");
                echo '</div>';
                
            }
            
            $output .=
            '<div class="row border g3" ';
            
            // if ($this->currentPage > 0) {
            //     echo "----------------------";
            //     $output .= '<li><a id="previousPage" ' . '">Previous</a></li>';
            // }
            // Page links
            // for ($i = 1; $i <= $totalPages; $i++) {
            //     $output .= '<li  ' . ($i == $this->currentPage ? 'class="active paginationLink"' : 'class="paginationLink"') . '><a ' . '">' . $i . '</a></li>';
            // }
    
            $output .= '</div>';
        
            $output .= '</ul>';
            echo $output;
           
        }



    }



        

