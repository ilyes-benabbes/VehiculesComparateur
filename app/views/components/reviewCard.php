<?php
class ReviewCard{

function __construct(){
    
}


    function render($review){
        echo "<div class='reviewCard border '>";
        echo "<h2>{$review['first_name']} {$review['last_name']}</h2>";

        echo "<p>{$review['reviewText']}</p>";
        echo "</div>";   
    }
}