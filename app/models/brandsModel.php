<?php
require_once  __DIR__ . '/../models/mainModel.php';

class BrandsModel extends MainModel {

function updateBrandById($id , $data){
    $request = "UPDATE `brand` SET `name`='$data[name]',`origin`='$data[origin]',`yearOfCreation`='$data[yearOfCreation]',`founder`='$data[founder]',`ceo`='$data[ceo]',`headQuarters`='$data[headQuarters]',`worth`='$data[worth]',`description`='$data[description]',`slogan`='$data[slogan]' WHERE id = $id";
    $this->request($request);
}

function deleteBrand($id){
    $request = "DELETE FROM `brand` WHERE id = $id";
    $this->request($request);
    $request = "DELETE FROM `brandfact` WHERE brand_id = $id";
    $this->request($request);
    $request = "DELETE FROM `brandaward` WHERE brand_id = $id";
    $this->request($request);
    
}


function deleteImage($id){
    $res = "update brand set imagePath = '' where id = $id";
    $res = $this->request($res );
    
}









public function addBrand($name , $origin , $yearOfCreation , $founder , $ceo , $headQuarters , $worth , $description , $slogan , $imagePath , $videoPath){
    $request = "INSERT INTO `brand`(`name`, `origin`, `yearOfCreation`, `founder`, `ceo`, `headQuarters`, `worth`, `description`, `slogan`, `imagePath`, `videoPath`) VALUES ('$name' , '$origin' , '$yearOfCreation' , '$founder' , '$ceo' , '$headQuarters' , '$worth' , '$description' , '$slogan' , '$imagePath' , '$videoPath')";
   $id =  $this->requestWithoutDisconnect($request);
   return $id;

}
   


public function addfacts($brandId , $features){
    $request = "INSERT INTO `brandfact`(`brand_id`, `factText`) VALUES ";
    for ($i=0; $i < count($features) ; $i++) { 
        $request .= "($brandId , '$features[$i]')";
        if($i != count($features) - 1){
            $request .= " , ";
        }
    }
    return $this->request($request);
}

public function addAwards($brandId , $awards){
    $request = "INSERT INTO `brandaward`(`brand_id`, `awardName`) VALUES ";
    for ($i=0; $i < count($awards) ; $i++) { 
        $request .= "($brandId , '$awards[$i]')";
        if($i != count($awards) - 1){
            $request .= " , ";
        }
    }
    return $this->request($request);
}






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