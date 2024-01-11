<?php 
class NewsCard {
    function render($new){
        echo "<div class='newsCard border'>";
        echo "<img src='".$new['image']."' alt=''> ";
        echo "<h2>".$new['title']."</h2>"; // title is a resume . 
        echo "<p class='toBeContinuedText'>".$new['text']."</p>";
        echo "<button id='{$new["id"]}' href='news/details/{$new["id"]}' class='newsDetails'>Read more</button>";
        echo "</div>";

    }
}