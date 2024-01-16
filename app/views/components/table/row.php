<?php
// require_once __DIR__ . "/../../../../config.php";
class Row{
    function render($headerCol ,$row ){

            
            echo '<div class="row tableRow">';
            echo '<div class="headerColumn">';
            echo $headerCol;
            echo '</div>';




            foreach ($row as $index => $value) {  
            if (("image" == $headerCol) ||  ("Vehicule Image" == $headerCol)){
                echo '<div class="column">';
                echo '<img src="'."/VehiculesComparateur (ProjetWeb)/".$value.'"alt="Avatar" class="imgColumn">';

                echo '</div>';
            } else {
                echo '<div class="column">';
                echo $value;
                echo '</div>';}
            }
            echo '</div>';

        }
        }

  
    
        
    

    

        
