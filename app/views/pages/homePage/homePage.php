<?php
// require_once  $_SERVER['DOCUMENT_ROOT'].'/../app/controllers/homeController.php';
// require_once dirname(__DIR__)."/components/comparisonForm.php"; 
echo "serverdocroot";
echo "<br>";
echo dirname($_SERVER['DOCUMENT_ROOT']);
echo "<br>";
echo "dirnaemofndi";
echo "<br>";
echo  __DIR__;
require_once "C:\wamp64\www\VehiculesComparateur (ProjetWeb)\config.php";
require_once ROOT_DIR . '/app/views/components/imagesDrawer.php';
require_once './app/views/components/imagesDrawer.php';
require_once './app/views/components/form.php';
require_once './app/views/mainView.php';
require_once './app/views/components/select.php';
require_once("app/views/pages/homePage/components/comparisonForm.php");
require_once  './app/controllers/homeController.php';
class HomePage extends MainView
{

    function showResult($res)
    {
        echo '<pre>';
        print_r($res);
        echo '</pre>';
    }
    private $homeController;


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
        // specifying the fields of the form here [[label , type]]
    }




    function renderAddFormBox()
    {
        include("app/views/pages/homePage/components/addFormBox.php");
    }
    function showFirstZone()
    {

        if ($this->controller instanceof HomeController) {
            $brands =   $this->controller->getBrands();
        }
        $imagePaths = $this->listify($brands, "imagePath");
        $logoDrawer = new imagesDrawer();
        $logoDrawer->showBrands($imagePaths, "150px");
        // $this->showResult($imagePaths);
    }
    function showSecondZone()
    {
        echo "<div class = 'formsContainer rowLeft g2'>";
        $this->renderForm();
        $this->renderForm();
        $this->renderAddFormBox();
        $this->renderAddFormBox();

        echo "<div>";
    }
    function showThirdZone()
    {
    }


    function show()
    {
        $this->configure();
        // $this->showDiaporama();
        $this->showMenu();
        $this->showFirstZone();
        $this->showSecondZone();
        $this->showThirdZone();
    }
}


// $myImagesList = [
//     'public/images/pictures/b.png',
//     'public/images/pictures/c.png',
//     'public/images/pictures/a.png'
// ];
