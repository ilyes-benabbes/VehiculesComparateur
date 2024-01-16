<?php
class ComparatorPage{

        private $cId= null ;

        function __construct($id =null)
        {
            $this->cId = $id ;
        }


    function configure()
    {
        echo '<link rel="stylesheet" href="./public/css/comparator.css">';
        echo '<script src="public/js/comparator.js"></script>';
    }



    function show()
    {   
        $ctrl = new VehiclesController();
        $helperView = new HelperView();  
        $this->configure(); 
        // $menu = new Menu();
        // $menu->render();
        if($this->cId != null){
            $ctrl->compareByComparisonId($this->cId);

        }else{
        $helperView->renderComparisonFormsSection();
        }
  
    }
}