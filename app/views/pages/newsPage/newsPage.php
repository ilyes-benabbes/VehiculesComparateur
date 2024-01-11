<?php 
require_once __DIR__.'/../../../controllers/newsController.php';
require_once __DIR__.'/../../../views/components/newsCard.php';
class NewsPage{
    
    public function show(){
        
        
        $ctrl = new NewsController();
        $news = $ctrl->getNews();
        echo "<h1>News</h1>";
        echo "<div class='newsContainer'>";
        foreach($news as $new){
            $card = new NewsCard();
            $card->render($new);
        }
        echo "</div>"; // end of newsContainer
    } // end of show
}