<?php
class ReviewCard{

function __construct(){
    
}


    function render($review ,  $IsLiked = null , $IsDisliked = null , $isHidden = false , $page){

       

        if($isHidden){
            echo "<div class='reviewCard row border hidden'>";

        } else {
            echo "<div class='reviewCard row border '>";

        }
        
        echo "<div >";
        echo "<h2>{$review['first_name']} {$review['last_name']}</h2>";

        echo "<p>{$review['reviewText']}</p>";

        echo "</div>"; // end of row
        // add like and dislike icons from fa fa

        echo "<div class='row g3' action='$page' id='{$review["id"]}'>";
        if($IsLiked){
            echo "<i class='fas fa-thumbs-up  reviewIcon' action='like'></i>";
            echo'<i class="far fa-thumbs-down reviewIcon" action="dislike"></i> ';
        } else if($IsDisliked){
            echo'<i class="far fa-thumbs-up reviewIcon" action="like"></i> ';
            echo "<i class='fas fa-thumbs-down  reviewIcon' action='dislike'></i>";
        } else {
                echo'<i class="far fa-thumbs-up reviewIcon" action="like"></i> ';
                echo'<i class="far fa-thumbs-down reviewIcon" action="dislike"></i> ';

        }

        echo "</div>"; // end of row
        echo "</div>";   
    }
}