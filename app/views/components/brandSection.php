<?php
// require_once __DIR__ . "/../../../config.php";
class BrandSection{


function showResult($res)
{
    echo '<pre>';
    print_r($res);
    echo '</pre>';
}


function render($data) {
    // this component renders only one brand; 
    echo '<div class="brandSection border col">';
    // the brand and its slogan here in a row
    echo "<div class='row g3'>
         <img src='".ROOT."/{$data["imagePath"]}' alt='logo' class='logo' width=200>
         <h3 class='quotes'>{$data["slogan"]}</h3>
         </div>"; 
    // the video here
    echo "<div class='videoContainer row'> 
         <video width='750' height='350' controls>
            <source src='".ROOT."/{$data["videoPath"]}' type='video/mp4'>
            Your browser does not support the video tag.
            </video>
        </div>";
    // the overview section here
    echo "<div class='overView row up'>";

    echo "<div class='colLeft'>
     <div class='description'>
    <h3>Description</h3>
    <p>{$data["description"]}</p>
    </div>
    
        <h4>Origin : </h4>
        <p>{$data["origin"]}</p>
        <h4>Year of Creation : </h4>
        <p>{$data["yearOfCreation"]}</p>
        <h4>Founder : </h4>
        <p>{$data["founder"]}</p>
        <h4>CEO : </h4>
        <p>{$data["ceo"]}</p>
        <h4>Headquarters : </h4>
        <p>{$data["headQuarters"]}</p>
        <h4>Worth : </h4>
        <p>{$data["worth"]}</p>
     </div>";

    echo "<div class='rightCol col g3'>";
 
    // facts section
    echo "<div class='facts'>
        <h3>Notable Facts</h3>";
    foreach ($data["notableFacts"] as $key =>$fact) {
        echo "<p>$fact</p>";
    }
    echo "</div>";

    // awards section
    echo "<div class='awards'>
        <h3>Awards and Recognition</h3>";
    foreach ($data["awards"] as $award) {
        echo "<p>$award</p>";
    }
    echo "</div>";
      // rating 
      echo "<div class='rating row g3'>  ";
            if($data["rating"] == 0){
                echo "<p>Not Rated Yet</p>";
            } else {
                echo "<p>Rating : {$data["rating"]}</p>";
            } 
     
            // check if user has reviewdThis brand before
            if (isset($_COOKIE["logedIn_user"])){
                $userId = $_COOKIE["logedIn_user"];
                $controller = new brandsController();
                $hasReviewed = $controller->hasReviewedThisBrand($userId , $data["id"]);
                if ($hasReviewed){
                    echo "<p>You have already reviewed this brand</p>";
                } else {
                    echo "<button class='reviewBrandButton' id={$data["id"]}>Rate Brand</button>";
                }
            } else {
                echo "<p>You have to log in to review this brand</p>";
            }
    // echo "  <button class='reviewBrandButton' id={$data["id"]}>Rate Brand</button>  
    
  echo "  </div> ";


    echo "</div>"; // the end of the brandSection div
  

    echo '</div>'; // the end of the brandSection div
}

}