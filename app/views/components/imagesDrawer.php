<?php


class imagesDrawer
{





    function showBrands($imagesListWithIds, $size)
    {
        echo
        '<div class="imagesDrawer row">';
        for ($i = 0; $i < sizeof($imagesListWithIds); $i++) {
            echo '<div class ="border">';
            echo '<img class="brands" src="' . $imagesListWithIds[$i] . '" width="' . $size . '" alt=""> ';
            // echo '<img'.'brandId="'.$imagesListWithIds[$i].id .'" src="' .$imagesListWithIds[$i] .'" width="'.$size.'" alt=""> ' ;
            echo "</div>";
        }
        echo "</div>";
    }
}
