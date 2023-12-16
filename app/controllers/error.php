<?php
require_once "./app/controllers/mainController.php";
require_once "./app/views/homepage.php";
require_once "./app/views/layout.php";
class ErrorPage extends MainController
{
    function showPage()
    {
        echo "error 404 , no such routes found in our website";
    }
}
