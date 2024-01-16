<?php
require_once __DIR__ ."/../controllers/mainController.php";
require_once __DIR__. "/../models/usersModel.php";

class UsersController extends MainController
 {  
function likeReviewCar($reviewId , $userId){
    if (!isset($_COOKIE["logedIn_user"])) {
        echo "you must be logged in to add to favourite";
        return;}
        else {
            $userModel = new usersModel();
            $userModel->likeReviewCar($reviewId , $userId  );
            return true;
        }
    }



    function removeReviewReactionCar($reviewId , $userId){    
        $userModel = new usersModel();
        $userModel->removeReviewReactionCar($reviewId , $userId);
    }


    function dislikeReviewCar($reviewId , $userId){
        if (!isset($_COOKIE["logedIn_user"])) {
            echo "you must be logged in to add to favourite";
            return;}

        $userModel = new usersModel();
        $userModel->dislikeReviewCar($reviewId , $userId  );
        return true;
    }




     function addBrandReview($review , $brandId , $rating){
        if (!isset($_COOKIE["logedIn_user"])) {
            echo "you must be logged in to add to favourite";
            return;}

        $userModel = new usersModel();
        $userModel->addBrandReview($review , $brandId , $rating , $_COOKIE["logedIn_user"]  );
        return true;
        }
        


        function removeReviewReactionBrand($reviewId , $userId){    
            $userModel = new usersModel();
            $userModel->removeReviewReactionBrand($reviewId , $userId);
        }
        

            function createUser($data){
                $userModel = new usersModel();
                $userModel->createUser($data["firstName"] , $data["lastName"] , $data["birthDate"] , $data["gender"] , $data["password"] , $data["email"]);
                return;
            }
            function logIn($data){
                
                    $userModel = new usersModel();
                    $response = $userModel->logIn($data['email'], $data['password']);
                    return $response;
                
            }

            function addCarReview($review , $carId , $rating){
                if (!isset($_COOKIE["logedIn_user"])) {
                    echo "you must be logged in to add to favourite";
                    return;}

                $userModel = new usersModel();
                $userModel->addCarReview($review , $carId , $rating , $_COOKIE["logedIn_user"]  );
                return true;
            }

            function likeReview($reviewId){
                if (!isset($_COOKIE["logedIn_user"])) {
                    echo "you must be logged in to add to favourite";
                    return;}

                $userModel = new usersModel();
                $userModel->likeReview($reviewId , $_COOKIE["logedIn_user"]  );
                return true;
            }

            function dislikeReview($reviewId){
                if (!isset($_COOKIE["logedIn_user"])) {
                    echo "you must be logged in to add to favourite";
                    return;}

                $userModel = new usersModel();
                $userModel->dislikeReview($reviewId , $_COOKIE["logedIn_user"]  );
                return true;
            }
 }