<?php
require_once __DIR__ . "/../../components/table/row.php";
class Table {
    function render($rows){
        // rows is a dictionary of lists : ["brand" => ["brand1" , "brand2"] , "model" => ["model1" , "model2"] 

        echo "<div class='tableContainer col'>";
        foreach($rows as $dictKey => $row){
            $rowObj = new Row();
            $rowObj->render($dictKey,$row);
        }
        echo "</div>";

    }
}