<?php
// require_once ("app/views/components/imageContainer.php");
require_once __DIR__.'/../components/imageContainer.php';
$DEFAULT_PLUS_CAR_PATH = "public\images\commonPictures\addCar.svg";
echo' <div class="addFormBox border col">';
$plusIcons = new ImageContainer(); 
$plusIcons->render($DEFAULT_PLUS_CAR_PATH , "50px" , "addFormImage") ;
echo "<p>Click here to add another vehicule </p>";

echo '</div>' ;