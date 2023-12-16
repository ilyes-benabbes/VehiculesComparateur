<?php


require_once __DIR__ . '/../views/pages/homePage/homePage.php';
require_once  __DIR__ . '/../controllers/mainController.php';
require_once  __DIR__ . '/../views/layout.php';




class HomeController extends MainController
{
    function showPage()
    {
        $view = new HomePage();
        $layout = new Layout();
        $layout->showPage($view);
    }
}



// Check if the request is an AJAX request and if the 'action' parameter is set
if (isset($_POST['action']) && $_POST['action'] == 'showImages') {

    echo '
<script>
alert("yuuhii")
</script> ';
    // // Your list of images and size (modify this based on your actual data)
    // $imagesList = ['image1.jpg', 'image2.jpg', 'image3.jpg'];
    // $size = 200;
    // // Call the show method and send the HTML response
    // $drawer->show($imagesList, $size);
}
