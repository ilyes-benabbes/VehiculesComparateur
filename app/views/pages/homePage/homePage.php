<?php
require_once "C:\wamp64\www\VehiculesComparateur (ProjetWeb)\config.php";
require_once __DIR__ . '/../../components/imagesDrawer.php';
require_once __DIR__ . '/../../components/form.php';
require_once __DIR__ . '/../../mainView.php';
require_once __DIR__ . '/../../components/select.php';
require_once __DIR__ . '/../../components/menu.php';
require_once __DIR__ . '/../../components/comparisonForm.php';
require_once __DIR__ . "/components/comparisonCard.php";



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


   

    function configure()
    {
        echo '<link rel="stylesheet" href="./public/css/homePage.css">';
        echo '<script src="public/js/homePage.js"></script>';
    }

    function showDiaporama()
    {
        include 'app/views/components/diaporama.php';
    }
 


    function renderForm()
    {
        $form = new ComparisonForm();
        $formId = "comparisonForm";
        $ctrl = new VehiclesController();
        $form->renderComparisonForm($formId, $ctrl->getBrands());
    }




    function showFirstZone()
    {  
        $helperView = new HelperView();
        $helperView->renderBrandsDrawer("150px");

    
    }

    function showSecondZone()
    {
        $helperView = new HelperView();
        $helperView->renderComparisonFormsSection(); 
    }


    function showThirdZone()
    {
        $this->showGoToBuyingGuideSection();
        $this->showMostPopularComparisons();
    }

  

    function show()
    {
        $helperView = new HelperView();
        $this->configure();
        //! do not delete this 
        // $this->showDiaporama();
        $menu = new Menu();
        $menu->render();
        $this->showFirstZone();
        $this->showSecondZone();
        $this->showThirdZone();
    }

function showGoToBuyingGuideSection(){
    include __DIR__ . "/components/goToBuyingGuideSection.php";
}


function showMostPopularComparisons(){
    $ctrl = new VehiclesController();
    $arrayOfcomparisons =$ctrl->getMostPopularComparisons(5);
    echo "<div class='comparisons'>";
        echo'<button class="leftArrow">
        <
         </button>';
        echo  '<div class="popularComparisons border rowLeft">' ;  
        echo '<div class="slidesContainer">';    
            foreach ($arrayOfcomparisons as $comparison){
                $arrofVs = $ctrl->getVehiculesByComparisonId($comparison["id"]);
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

