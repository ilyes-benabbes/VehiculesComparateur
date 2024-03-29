<?php
require_once __DIR__. "/../components/reviewCard.php";
class VehicleSection {
 
    function render($data) {
        // this component renders only one brand; 
        // ! two columns , left of image and specifacation ...
        echo '<div class="vehicleSection col">';
        echo '<div class="row">';
        echo '<div class="brandImageContainer row">';
        echo "<img src='".ROOT."/{$data["image"]}'' alt='brandImage' class='mainCarImage' width=600>";
        echo "<h1>{$data["name"]}</h1> ";
        echo '</div>';
        echo '<button class="addToFavorite" id="' . $data["id"] . '">';
        echo '   <i class="far fa-heart"></i>';
        echo '</button>';
        echo '</div>'; 
        // row two :
        echo "<div class='row twoColumnsContainer'>";
    
        echo "<div class='colLeft'>";
        echo "<div class='carImagesContainer col'>";
        // echo "<img src='{$data["image"]}' alt='carImage' class='carImage border'>";
        
        echo "<div class='miniImages g2'>";
        //?comment this to uncomment later
        foreach ($data["images"] as $image) {
            echo "<img src='".ROOT."/{$image}'' alt='brandImage' width=150 >";
            // echo "<img src='".ROOT."/$image' alt='carImage' class='miniImage border'>";
        }
        //?comment this to uncomment later
        echo "</div>"; // end of miniImages div
        echo "</div>"; // end of carImagesContainer div

        echo "<div class='carDescription row g5 up'>";
        echo "<div class='specifications col g1'>";
        echo "<h1>Specifications :</h1>";
  
        echo "<h4>Model : </h4>";
        echo "<p>{$data["name"]}</p>";
        echo "<h4>Type : </h4>";
        echo "<p>{$data["type"]}</p>";
        echo "<h4>Version : </h4>";
        echo "<p>{$data["version"]}</p>";
        echo "<h4>Year : </h4>";
        echo "<p>{$data["year"]}</p>";
        echo "<h4>Number of seats : </h4>";
        echo "<p>{$data["number_of_seats"]}</p>";
        echo "<h4>Capacity : </h4>";
        echo "<p>{$data["capacity"]}</p>";
        echo "<h4>Consumption : </h4>";
        echo "<p>{$data["consumption"]}</p>";
        echo "<h4>Engine power : </h4>";
        echo "<p>{$data["engine_power"]}</p>";
        echo "<h4>Acceleration : </h4>";
        echo "<p>{$data["acceleration"]}</p>";
        echo "<h4>Max speed : </h4>";
        echo "<p>{$data["max_speed"]}</p>";
        echo "<h4> warranty : </h4>";
        echo "<p>{$data["warranty"]}</p>";
        echo "<h4>Price : </h4>";
        echo "<p>{$data["price"]}</p>";
        echo "</div>"; // end of specifications div


        echo "<div class='dimensions col'>";
        echo "<div class='col g1'>" ;
        echo "<h1>Dimensions :</h1>";
        echo "<h4>Height : </h4>";
        echo "<p>{$data["height"]}</p>";

        echo "<h4>Length : </h4>";
        echo "<p>{$data["length"]}</p>";
        echo "<h4>Weight : </h4>";
        echo "<p>{$data["weight"]}</p>";
        echo "<h4>Width : </h4>";
        echo "<p>{$data["width"]}</p>";
        echo "<h4>Cargo space : </h4>";
        echo "<p>{$data["cargo_space"]}</p>";
        echo "</div>"; // end of dimensions div

        echo "<div class='keyFeatures col g1'>";
        echo "<h1>Key Features</h1>";
        echo "<div class='col g1'>";
        foreach ($data["features"] as $key=>$keyFeature) {
            echo "<p>$keyFeature</p>";
        }
        echo "</div>"; // end of col
        echo "</div>"; // end of keyFeatures div


        echo "<div class='availableColors'>";
        echo "<h1>Available Colors</h1>";
        echo "<div class='row'>";
        foreach ($data["colors"] as $key=>$color) {
            echo "<div class='colorContainer'>";
            echo "<div class='color' style='background-color:$color'></div>";
            // echo "<p>$color</p>";
            echo "</div>"; // end of colorContainer div
        }
        echo "</div>"; // end of row
        echo "</div>"; // end of availableColors div


               // check if user has reviewdThis brand before
               if (isset($_COOKIE["logedIn_user"])){
                $userId = $_COOKIE["logedIn_user"];
                $controller = new VehiclesController();
                $hasReviewed = $controller->hasReviewedThisCar($userId , $data["id"]);
                if ($hasReviewed){
                    echo "<p>You have already reviewed this brand</p>";
                } else {
                    echo "<button class='reviewCarButton' id={$data["id"]}>Rate Brand</button>";
                }
            } else {
                echo "<p>You have to log in to review this brand</p>";
            }



 
        
        
 
        echo "</div>"; // end of dimension column
        echo "</div>"; // end of dimension column
        
        
        echo "<div class='colRight'>";
  
      


        // ! on click render the review section , with the stars and the review text area


        echo "</div>"; // end of right column

        echo '</div>' ; // end of twoColumnsContainer.;
        echo '</div>' ; // end of description.;




    }
}