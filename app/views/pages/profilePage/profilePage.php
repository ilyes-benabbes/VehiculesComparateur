<?php
require_once __DIR__ ."/../../components/menu.php";
class ProfilePage {
    function show() {
        // $menu = new Menu();
        // $menu->render();
        //   Registered users can access their profiles, allowing them to view their favorite vehicles and participate in vehicle ratings. The rating feature is disabled for non-authenticated users. Additionally, registered users can add a review, which, once approved by the administrator, will be published on the site. (1pt)
         $this->showFavoriteVehicles();
          

    }
    function showFavoriteVehicles(){
         $ctrl = new VehiclesController();
         $id =  $_COOKIE['logedIn_user'];
        $vehicles = $ctrl->getFavoriteVehicles($id);
        echo "<h1>Favorite Vehicles : </h1>";
        echo "<div class='favouriteContainer rowLeft'>" ;
        foreach ($vehicles as $car) {
            echo "<div class='favouriteCard'>" ;
            echo ' <i class="fas fa-trash delete"></i> ';
            $carCard = new carCard();
            $carCard->render($car[0]);
            echo "</div>";
       
        }
        
    }
}