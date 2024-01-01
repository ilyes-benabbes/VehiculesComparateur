<?php
class ComparatorPage{

    function configure()
    {
        echo '<link rel="stylesheet" href="./public/css/comparator.css">';
        echo '<script src="public/js/comparator.js"></script>';
    }



    function show()
    {   
        $helperView = new HelperView();  
        $this->configure(); 
        $menu = new Menu();
        $menu->render();
        $helperView->renderComparisonFormsSection();
  
    }
}