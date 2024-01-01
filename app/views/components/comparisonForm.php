<?php
require_once __DIR__ . '/../components/form.php';
require_once __DIR__ . '/../components/select.php' ;
require_once __DIR__ . '/../components/imageContainer.php' ;



class ComparisonForm extends Form{
    
     function renderComparisonForm(  $formeId , $brandsList ){

         echo "<form class='comparisonForm'>";
         $img = new ImageContainer();
         $img->render("public/images/commonPictures/defaultCar.svg" , "200px" , "defaultCar") ;
         $selectBrand = new Select();
         $selectModel = new Select();
         $selectBrand->render("Brand" , "SelectBrand" ,$brandsList);
         echo "</form>";
        }

       
}