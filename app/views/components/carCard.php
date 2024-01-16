<?php





class  carCard {
    function render($data){
        echo "<div class='carCard col border'>";
        echo "<div class='carCardImageContainer' id={$data['id']}>";
        echo "<img src='".ROOT."/{$data['image']}' width='200' height='200'";
        echo "alt='car image'>";

        echo "</div>";
        echo "<div class='carCardDataContainer col'>";
        // 
        echo "<div class='grid-two-col col'>";
        echo "<h1>{$data['name']}</h1>";
     
        echo "<p>{$data['type']}</p>";
        echo "<p>{$data['price']} $</p>";
        echo "<button id='{$data['id']}' class='viewCarDetails' > View Details </button>";
        echo "</div>";
        // 
        echo "</div>";
    
        echo "</div>";
    }
    




}