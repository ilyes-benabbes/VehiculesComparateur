<?php

require_once "C:\wamp64\www\VehiculesComparateur (ProjetWeb)\config.php";
require_once __DIR__ . '/../../components/imagesDrawer.php';
require_once __DIR__ . '/../../components/form.php';
require_once __DIR__ . '/../../mainView.php';
require_once __DIR__ . '/../../components/select.php';
require_once __DIR__ . '/components/comparisonForm.php';
require_once __DIR__ . '/../../../controllers/homeController.php';
include __DIR__ . "/components/comparisonCard.php";



class HomePage extends MainView
{

    function showResult($res)
    {
        echo '<pre>';
        print_r($res);
        echo '</pre>';
  
    }
  
    function renderNextSelect($label ,  $NextclassName,  $options){
        $select = new Select();
        $select->render($label , $NextclassName, $options);

    }


    function listify($res, $param)
    {
        $list = [];
        foreach ($res as $row) {
            $list[] = $row[$param];
        }
        return $list;
    }


    function configure()
    {
        echo '<link rel="stylesheet" href="./public/css/homePage.css">';
        echo '<script src="public/js/homePage.js"></script>';
    }

    function showDiaporama()
    {
        include 'app/views/components/diaporama.php';
    }
    function showMenu()
    {
        include 'app/views/components/menu.php';
    }


    function renderForm()
    {
        $form = new ComparisonForm();
        $formId = "comparisonForm";
        $form->renderComparisonForm($formId, $this->controller);
    }




    function renderAddFormBox()
    {
        include __DIR__ . "/components/addFormBox.php";
        // include("app/views/pages/homePage/components/addFormBox.php");
    }
    function showFirstZone()
    {

        if ($this->controller instanceof HomeController) {
            $brands =   $this->controller->getBrands();
        }
        $imagePaths = $this->listify($brands, "imagePath");
        $logoDrawer = new imagesDrawer();
        $logoDrawer->showBrands($imagePaths, "150px");
    }
    function showSecondZone()
    {
        echo "<div class = 'formsContainer rowLeft g2'>";
        $this->renderForm();
        $this->renderForm();
        $this->renderAddFormBox();
        $this->renderAddFormBox();
        echo "<Button class='comparisonButton'> compare </Button>";
        echo "</div>";
    }
    function showThirdZone()
    {
        $this->showGoToBuyingGuideSection();
        $this->showMostPopularComparisons();
    }

  

    function show()
    {
        $this->configure();
        //! do not delete this 
        // $this->showDiaporama();
        $this->showMenu();
        $this->showFirstZone();
        $this->showSecondZone();
        $this->showThirdZone();
    }

function showGoToBuyingGuideSection(){
    include __DIR__ . "/components/goToBuyingGuideSection.php";

}
function showMostPopularComparisons(){
        $arrayOfcomparisons =$this->controller->getMostPopularComparisons(5);
echo "<div class='comparisons'>";
        echo   ' <button class="leftArrow">
        <
         </button>';


        echo  '<div class="popularComparisons border rowLeft">' ; 
        
        echo '<div class="slidesContainer">';
            
            
            
            foreach ($arrayOfcomparisons as $comparison){
                $arrofVs = $this->controller->getVehiculesByComparisonId($comparison["id"]);
                $card = new ComparisonCard();
                $card->render($arrofVs);
            }
            
            echo "</div>";
            
            
            echo ' </div>';
            echo   ' <button class="rightArrow arrow">
            >
             </button>';
            echo ' </div>';
            
            
            

            
            

 


}

}

