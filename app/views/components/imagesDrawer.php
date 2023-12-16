<?php 


class imagesDrawer {



 

function show($imagesList , $size){
    echo 
'<div class="imagesDrawer row">' ;
for ($i=0; $i < sizeof($imagesList); $i++) { 
    echo '<img src="' .$imagesList[$i] .'" width="'.$size.'" alt=""> ' ;
}
echo "</div>" ;

}
}