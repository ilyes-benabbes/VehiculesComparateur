<?php
class ImageContainer{
    function render ( $imgSource , $size , $className){
       echo '<div class="imageContainer border row">';
                echo '<img class="'.$className .'" src="' . $imgSource . '" width="' . $size . '" alt=""> ';
                echo "</div>";

    }
}