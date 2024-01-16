<?php
require_once __DIR__."/../../../../controllers/vehiclesController.php";
require_once __DIR__."/../../../components/carCard.php";
class ComparisonCard {

    function render($arrayOfVs , $comparisonId){
        echo  '<div class= "comparisonCard col border ">';
        echo "<div class='row border g3 comparisonContainerMini'>";
        
        foreach ($arrayOfVs as $v){
            $card =  new carCard();
            $card->render($v);

            echo "<div class='col '>";

            if($v != end($arrayOfVs)){
                echo "<h1> VS </h1>";
            }
            
            echo "</div>";
        }
                echo "<button class='comparisonButton' id={$comparisonId}>Compare</button>";


        echo "</div>";

        // echo "<button class='compareButton'>Compare</button>";
        
            // echo $vehiculeContainer;
        echo "</div>";
}


        

}