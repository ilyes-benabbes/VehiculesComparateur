<?php

class ViewsController {
    
    function showPage($page , $layout = null){
        if($layout){
            $layout->showPage($page);
        }else{
        
            $page->show();
        }
    }
   
}