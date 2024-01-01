<?php
class carCard{
    function render($data){
        echo "<div class='carCard col border'>";
        echo "<div class='carCardImageContainer' id={$data['id']}>";
        echo "<img src='{$data['image']}' alt='car image'>";
        echo "</div>";
        echo "<div class='carCardDataContainer col'>";
        // 
        echo "<div class='grid-two-col col'>";
        echo "<h1>{$data['name']}</h1>";
        echo "<p>{$data['engine_power']}<p/>";
        echo "<p>{$data['type']}</p>";
        echo "<p>{$data['price']}</p>";
        echo "</div>";
        // 
        echo "</div>";
        echo "<button id='{$data['id']}' > View </button>";
    
        echo "</div>";
    }
    




}