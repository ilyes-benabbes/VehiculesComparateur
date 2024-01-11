<?php 
require_once __DIR__ . '/../components/form.php';
class LogInPage {

    function show(){
        $form = new Form();
        echo "<h1>Log In</h1>";
        echo "<form>";
        $form->renderFields([["email" , "text"] , ["password" , "password"]  ] );
        echo "<button id='logInButton'>Log In</button>";
        //already have an account
        echo "<a href='signUp'>Sign Up</a>";
        echo "</form>";
    }

}