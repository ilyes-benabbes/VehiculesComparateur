<?php
class Layout
{
    function configure()
    {
        require_once "config.php";
        echo '<link rel="stylesheet" href="./public/css/common.css">';
        echo '<link rel="stylesheet" href="./public/css/componendsts.css">';

        
    }

    function showHeader()
    {
        include __DIR__.'/../../app/views/components/header.php';
    }

    function showFooter()
    {
        include 'app/views/components/footer.php';
    }

    function showPage($page)
    {
        $this->configure();
        $this->showHeader();
        $this->showMenu();  
        $page->show();
        $this->showFooter();
    }
    function showMenu()
    {
        $menu = new Menu();
        $menu->render();
    }
}
