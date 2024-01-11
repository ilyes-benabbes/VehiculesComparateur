<?php
class VehicleReviewsPage {
    function configure(){
        echo '<link rel="stylesheet" href="./public/css/vehicleReviews.css">';
        echo '<script src="public/js/vehicleReviews.js"></script>';
    }
    function show($carId){
        $this->configure();


    }
}