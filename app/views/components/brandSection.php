<?php
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
    echo "<div class='row around'>
         <img src='{$data["imagePath"]}' alt='logo' class='logo'>
         <h1 class='quotes'>{$data["slogan"]}</h1>
         </div>"; 
    // the video here
    echo "<div class='videoContainer row'> 
         <video width='900' height='350' controls>
            <source src='{$data["videoPath"]}' type='video/mp4'>
            Your browser does not support the video tag.
            </video>
        </div>";
    // the overview section here
    echo "<div class='overView colLeft'>
        <h1>Brand Overview</h1>
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
    // history section here
    echo "<div class='description'>
        <h1>Description</h1>
        <p>{$data["description"]}</p>
        </div>";
    // facts section
    echo "<div class='facts'>
        <h1>Notable Facts</h1>";
    foreach ($data["notableFacts"] as $key =>$fact) {
        echo "<p>$fact</p>";
    }
    echo "</div>";

    // awards section
    echo "<div class='awards'>
        <h1>Awards and Recognition</h1>";
    foreach ($data["awards"] as $award) {
        echo "<p>$award</p>";
    }
    echo "</div>";
      // rating 
      echo "<div class='rating'>  
      <h1>Rating</h1>
      <p>{$data["rating"]}</p>
      </div> ";

    // rateBrand button 
    echo "<div class='rateBrand'>
        <button class='rateBrandButton' id={$data["id"]}>Rate Brand</button>
        </div>";
  

    echo '</div>'; // the end of the brandSection div
}

}