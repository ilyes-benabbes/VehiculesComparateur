<?php
require_once  __DIR__ . '/../models/mainModel.php';

class BrandsModel extends MainModel {

    function showResult($res)
    {
        echo '<pre>';
        print_r($res);
        echo '</pre>';
    }
function getReviewsByBrandId($id , $nbrOfReviews){

    $request = "SELECT reviewText , first_name , last_name  FROM `brandreview` join user on (user.id = brandreview.userId) WHERE `brand_id` = $id LIMIT $nbrOfReviews";
    return $this->request( $request);    
 }


  
        function getBrandById($id){
            $request = "SELECT * FROM brand WHERE id = $id";
            echo "in model : "; 
            $this->showResult($this->request( $request));
            return $this->request( $request);     

        }//end of method

        function getBrandRatingById($id){
            $query = "SELECT AVG(rating) as rating FROM brandRating WHERE brand_id = $id"; 
            return $this->request($query);
        }

        function getBrandFactsById($id){
            $query = "SELECT factText FROM brandFact WHERE brand_id = $id";
            return $this->request($query);

        }  
        function getBrandAwardsById($id){
            $query = "SELECT awardName FROM brandaward WHERE brand_id = $id";
            return $this->request($query);

        }  
       
    
} // end of class