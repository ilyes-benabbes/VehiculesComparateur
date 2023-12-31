<?php
require_once __DIR__."/../../../../controllers/homeController.php";
class ComparisonCard {

    function render($arrayOfVs){
        echo  '<div class= "comparisonCard row border">';

        foreach ($arrayOfVs as $v){
            $vehiculeContainer = "<div class='col comparedVehicle'>";
            $vehiculeContainer .= '<img src="'.$v["image"].'" alt="car" srcset=""></img>';
            $vehiculeContainer .= '<h2> Brand </h2>';
            $vehiculeContainer .= '<p> ' . $v["brand"] . ' </p>';
            $vehiculeContainer .= '<h2> Model </h2>';
            $vehiculeContainer .= '<p> ' . $v["name"] . ' </p>';
            $vehiculeContainer .= '<h2> Version </h2>';
            $vehiculeContainer .= '<p> ' . $v["version"] . ' </p>';
            $vehiculeContainer .= '<h2> Year </h2>';
            $vehiculeContainer .= '<p> ' . $v["year"] . ' </p>';
            $vehiculeContainer .= "</div>";
        
            echo $vehiculeContainer;
    }
    echo "</div>";
    }


        

}