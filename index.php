<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="" href="./public/css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="public/js/index.js"></script>
    <script src="public/js/jquery.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <title>Comparateur des véhicules</title>
</head>

<body>

    <?php

    $url = isset($_GET['url']) ? $_GET['url'] : '/';
    // echo $url;

    switch ($url) {
        case "/":
            require_once './app/controllers/homeController.php';
            $controller = new HomeController();
            break;
        case "brands":
            require_once './app/controllers/brandsController.php';
            $controller = new BrandsController();
            break;
        case "news":
            require_once './app/controllers/newsController.php';
            $controller = new NewsController();
            break;
        case "signUp":
            require_once './app/controllers/signUpController.php';
            $controller = new SignUpController();
            break;
        case "logIn":
            require_once './app/controllers/logInController.php';
            $controller = new LogInController();
            break;
        case "buyingGuide":
            require_once './app/controllers/buyingGuideController.php';
            $controller = new buyingGuideController();
            break;
        default:
            require_once("./app/controllers/error.php");
            $controller = new ErrorPage();
    }

    $controller->showPage();
    ?>

</body>

</html>
