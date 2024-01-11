<?php
require_once __DIR__ . '/../components/form.php';
require_once __DIR__ . '/../components/select.php';
class SingUpPage {
    function show(){
        $form = new Form();
        $select = new Select();
        echo "<h1>Sign Up</h1>";
        // fix this 
          
        echo "<form >";
 
        $form->renderFields([  ["First Name" , "text"] , ["Last name" , "text"]  , ["Birth Date" , "date"]  ] );
        $list = []; 
        $list[0]["id"] = 0 ; 
        $list[0]["name"] = "female" ; 
        $list[1]["id"] = 1 ;
        $list[1]["name"] = "male" ;


        $select->render("Gender", "genderSelect" , $list , "id" , "name");


        $form->renderFields([  ["email" , "text"] , ["password" , "password"]  , ["confirm Password" , "password"]  ] );
        echo "<button  id='signUpButton'>Sign Up</button>";
        //already have an account
        echo "<a href='logIn'>Log In</a>";
        echo "</form>";
    }
    
}   