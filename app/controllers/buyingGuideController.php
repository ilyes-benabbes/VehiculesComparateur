<?php
require_once __DIR__ . '/../views/pages/buyingGuide/buyingGuidePage.php';

class buyingGuideController extends mainController
{
    public function showPage()
    {
        $this->page = new BuyingGuidePage($this);
        $layout = new Layout();
        $layout->showPage($this->page);
    }
}