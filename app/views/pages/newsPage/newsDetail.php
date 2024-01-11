<?php
require_once __DIR__.'/../../../controllers/newsController.php';
class NewsDetailPage{
       protected $id = null ;
    function __construct($id){
        $this->id = $id;
    }

    public function show(){
        $id = $this->id;
        $ctrl = new NewsController();
        $new = $ctrl->getNewsById($id )[0];
        $paragraphs = $ctrl->getParagraphsByNewsId($id);

        echo "<div class='newsDetailPage'>";

        echo "<h1>".$new["title"]."</h1>"; // title is a resume .
        echo "<img src='".$new['image']."' alt='NEWS IMAGE' width=800 > ";
        echo "<h4>".$new['text']."</h4>";

        foreach($paragraphs as $paragraph){
            echo "<h3>".$paragraph['paragraphTitle']."</h3>";
            echo "<p>".$paragraph['paragraphText']."</p>" ;
        }

        echo "</div>"; // end of newsDetailPage
    }
}