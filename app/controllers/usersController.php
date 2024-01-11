<?php
require_once __DIR__ ."/../controllers/mainController.php";
require_once __DIR__. "/../models/usersModel.php";

class UsersController extends MainController
 {
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
 }