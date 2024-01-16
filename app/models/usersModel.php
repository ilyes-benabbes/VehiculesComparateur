<?php
require_once  __DIR__ . '/../models/mainModel.php';

class UsersModel extends mainModel {
    function likeReviewCar($reviewId , $userId){
        $query = "INSERT INTO `vehiclereviewreaction`(`vehiclereview_id` , `user_id` , `reaction`) VALUES (? , ? , ?)";
        $this->request($query , [$reviewId , $userId , "liked"]);
    }




function dislikeReviewCar($reviewId , $userId){
    $query = "INSERT INTO `vehiclereviewreaction`(`vehiclereview_id` , `user_id` , `reaction`) VALUES (? , ? , ?)";
    $this->request($query , [$reviewId , $userId , "disliked"]);
}


    function removeReviewReactionCar($reviewId , $userId){
        $query = "DELETE FROM `vehiclereviewreaction` WHERE `vehiclereview_id` = ? AND `user_id` = ?";
        $this->request($query , [$reviewId , $userId]);
    }

  function addBrandReview($review , $brandId , $rating , $userId){
    $query = "INSERT INTO `brandreview`(`reviewText` , `brand_id` , `rating` , `userId`) VALUES (? , ? , ? , ?)";
    $this->request($query , [$review , $brandId , $rating , $userId]);
    }




            function removeReviewReactionBrand($reviewId , $userId){
                $query = "DELETE FROM `brandreviewreaction` WHERE `brandreview_id` = ? AND `user_id` = ?";
                $this->request($query , [$reviewId , $userId]);
            }
        function createUser($firstName  , $lastName , $birthDate , $gender , $password , $email ){
            if ($gender == 0){
                $genderName = "Female";
            }else {
                $genderName = "Male" ;
            }
            $query = "INSERT INTO `user`(  `first_name` , `last_name` , `birth_date` , `gender`  , `password` , `email` ) VALUES (? , ? , ? , ?,? , ? )";
            return $this->request($query  , [ $firstName , $lastName , $birthDate , $genderName , $password , $email]);
        }
        function logIn($email , $pass){
                
                $query = "SELECT * FROM `user` WHERE `email` = ? AND `password` = ? ";
                $res =  $this->request($query , [$email , $pass]);
                if (count($res) > 0){
                    $cookie_name = "logedIn_user";
                    // $cookie_value = ["firstName" => $_POST['firstName'], "lastName" => $_POST['lasteName'], "role" => $_POST['role'], "id" => $db->lastInsertId(), "email" => $_POST['email']];
                    $cookie_value = $res[0]['id'];
                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
                    // returning the id 
                    return $res[0];}
                    else {
                        return false;
                    }



        }
        function addCarReview($review , $carId , $rating , $userId){
            $query = "INSERT INTO `vehiclereview`(`text` , `vehicle_id` , `rating` , `user_id`) VALUES (? , ? , ? , ?)";
            $this->request($query , [$review , $carId , $rating , $userId]);
        }

        function likeReview($reviewId , $userId){
            $query = "INSERT INTO `brandreviewreaction`(`brandreview_id` , `user_id` , `reaction`) VALUES (? , ? , ?)";
            $this->request($query , [$reviewId , $userId , "liked"]);
        }
        function dislikeReview($reviewId , $userId){
            $query = "INSERT INTO `brandreviewreaction`(`brandreview_id` , `user_id` , `reaction`) VALUES (? , ? , ?)";
            $this->request($query , [$reviewId , $userId , "disliked"]);
        }
}
