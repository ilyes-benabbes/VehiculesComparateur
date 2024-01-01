<?php
require_once __DIR__ . '/../views/components/select.php';
require_once __DIR__ . '/../views/components/table/table.php';
require_once __DIR__ . '/../views/components/comparisonForm.php';
require_once __DIR__ . '/../views/components/comparisonForm.php';
require_once __DIR__ . '/../controllers/vehiclesController.php';
// ! work framework : use the componenets.render() if the components are static 
// ! if the section is dynamic and needs data from the controller, use the helperView.render() method



class HelperView{
    function renderNextSelect($label ,  $NextclassName,  $options){
        $select = new Select();
        $select->render($label , $NextclassName, $options);

    }

    function showMenu()
    {
        include __DIR__.'/../views/components/menu.php';
    }

    function renderComparisonForm()
    {
        $form = new ComparisonForm();
        $formId = "comparisonForm";
        $ctrl = new VehiclesController();
        $form->renderComparisonForm($formId, $ctrl->getBrands());
    }

    function renderAddFormBox()
    {
        include __DIR__ . "/../views/components/addFormBox.php";
    }
    function renderComparisonFormsSection(){
        echo "<div class = 'formsContainer rowLeft g2'>";
        $this->renderComparisonForm();
        $this->renderComparisonForm();
        $this->renderAddFormBox();
        $this->renderAddFormBox();
        echo "<Button class='comparisonButton' id='compareButton'> compare </Button>";
        echo "</div>";
    }

    function renderComparisonTable($rows){
        // rows is a dictionary of lists : ["brand" => ["brand1" , "brand2"] , "model" => ["model1" , "model2"] 
            $table = new Table();
            $table->render($rows);
    }
    function listify($res, $param)
    {
        $list = [];
        foreach ($res as $row) {
            $list[] = $row[$param];
        }
        return $list;
    }


    function renderBrandsDrawer($width){
        $ctrl = new VehiclesController();
        $brands =   $ctrl->getBrands();
        // $imagePaths = $this->listify($brands, "imagePath");
        $logoDrawer = new imagesDrawer();
        $logoDrawer->showBrands($brands, $width);
    }

}