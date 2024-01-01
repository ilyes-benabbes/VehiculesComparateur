<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="" href="./public/css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="public/js/index.js"></script>
    <script src="public/js/jquery.js"></script>
    <script src="public/js/components.js"></script>
    <title>Comparateur des véhicules</title>
</head>

<body>

    <?php

    $url = isset($_GET['url']) ? $_GET['url'] : '/';
    require_once './app/controllers/viewsController.php';
    require_once __DIR__ . '/app/controllers/vehiclesController.php';
    require_once __DIR__ . '/app/controllers/brandsController.php';
    require_once __DIR__ . '/app/models/brandsModel.php';

    $controller = new ViewsController();
    $layout = null; 

    switch ($url) {
        case "/":
            require_once './app/views/pages/homePage/homePage.php';
            $view = new HomePage();
            $layout = new Layout();
            break;

            case "comparator": 
            require_once './app/views/pages/comparatorPage/comparatorPage.php';
            require_once './app/views/helperView.php';
            $view = new ComparatorPage();
            $layout = new Layout();
            break;


        case "brands":
            require_once './app/views/pages/brandsPage/brandsPage.php';
            $layout = new Layout();
            $view = new BrandsPage();
            break;
        case "news":
            require_once './app/controllers/newsController.php';
            $view = new NewsController();
            break;
        case "signUp":
            require_once './app/controllers/signUpController.php';
            $view = new SignUpController();
            break;
        case "logIn":
            require_once './app/controllers/logInController.php';
            $view = new LogInController();
            break;
        case "buyingGuide":
            require_once './app/controllers/buyingGuideController.php';
            $view = new buyingGuideController();
            break;
        default:
            require_once("./app/views/error.php");
            $view = new ErrorPage();
    }

    $controller->showPage($view, $layout);
    ?>

</body>

</html>
