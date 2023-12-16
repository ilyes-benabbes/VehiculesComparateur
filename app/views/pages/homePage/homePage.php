<?php

class HomePage
{
    function configure()
    {
        echo '<link rel="stylesheet" href="/public/styles/homePage.css">';
        echo '<script src="public/js/homePage.js"></script>' ;
        
    }

    function showDiaporama()
    {
        include 'app/views/components/diaporama.php';
    }
    function showMenu()
    {
        include 'app/views/components/menu.php';
    }
    function showFirstZone()
    {
        require_once 'app/views/components/imagesDrawer.php';
        $myImagesList = [
            'public/images/pictures/b.png',
            'public/images/pictures/c.png',
            'public/images/pictures/a.png'
        ];
        $logoDrawer = new imagesDrawer();
        $logoDrawer->show($myImagesList, "300px");
    }
    function showSecondZone()
    {
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
