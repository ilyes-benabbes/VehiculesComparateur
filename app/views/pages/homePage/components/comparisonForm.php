<?php
require_once __DIR__ . '/../../../components/form.php' ;
require_once __DIR__ . '/../../../components/select.php' ;
require_once __DIR__ . '/../../../components/imageContainer.php' ;


class ComparisonForm extends Form{
    
     function renderComparisonForm(  $formeId , $controller ){
         echo "<form class='comparisonForm'>";
         $img = new ImageContainer();
         $img->render("public/images/commonPictures/defaultCar.svg" , "200px" , "defaultCar") ;
         $formId="homeComparison"; 
         // Using custom keys for value and text
         // $selectBrand->render('Car Brands', $brandsList, 'id', 'name');
         $selectBrand = new Select();
         $selectModel = new Select();
         $brandsList = $controller->getBrands();
         $selectBrand->render("Brand" , "SelectBrand" ,$brandsList);
        //  $selectModel->renderDisabled("Model");
        //  echo '<button class="button"> click me </button>';


         // foe each brand , generate models , for each model , generate its years kamel
       
        echo "</form>";
    }
}