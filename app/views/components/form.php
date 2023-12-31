<?php
require_once  __DIR__ . '/../components/inputBox.php'; 
class Form {
    // the fields is a list like this [[label , type]] : [["email", "text"], ["age,"number"] , ["sexe" , "Select"]];
    function render($fields , $formId){
        echo '<form class ="border col" id="'.$formId.'">' ;
        foreach($fields as $field){
            $input = new InputBox(); 
            // 0 for label \\ 1 for type 
            $input->render($field[0], $field[1]);
        }
        echo "</form>";
    }
    function renderFields($fields){
        foreach($fields as $field){
            $input = new InputBox(); 
            // 0 for label \\ 1 for type 
            $input->render($field[0], $field[1]);
        }
    }
}