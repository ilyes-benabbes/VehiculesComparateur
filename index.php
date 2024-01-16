<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="" href="/VehiculesComparateur%20(ProjetWeb)/public/css/components.css">
    <link rel="stylesheet" type="" href="/VehiculesComparateur%20(ProjetWeb)/public/css/index.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css"> -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="public/js/index.js"></script>
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="/VehiculesComparateur%20(ProjetWeb)/public/js/jquery.js"></script>
    <script src="/VehiculesComparateur%20(ProjetWeb)/public/js/components.js"></script>
    <title>Comparateur des véhicules</title>
</head>

<body>
    <?php
    $url = isset($_GET['url']) ? $_GET['url'] : '/';
    $uriComponents = explode('/', $url);
            require_once __DIR__ . "/config.php";

    require_once './app/controllers/viewsController.php';
    require_once __DIR__ . '/app/controllers/vehiclesController.php';
    require_once __DIR__ . '/app/controllers/brandsController.php';
    require_once __DIR__ . '/app/models/brandsModel.php';
    $controller = new ViewsController();
    $layout = null;





    switch ($uriComponents[0]) {


        case "home":
            require_once './app/views/pages/homePage/homePage.php';
            $view = new HomePage();
            $layout = new Layout();
            break;
        case "contact":
            require_once './app/views/pages/contactPage/contactPage.php';
            $view = new ContactPage();
            $layout = new Layout();
            break;

        case "comparator":
            $comparisonId = $uriComponents[1] ?? null;
            if ($comparisonId !== null && is_numeric($comparisonId)) {
                require_once './app/views/pages/comparatorPage/comparatorPage.php';
                $layout = new Layout();
                 $view = new ComparatorPage($comparisonId);

                break; }
                else {

                require_once './app/views/pages/comparatorPage/comparatorPage.php';
                $view = new ComparatorPage();
                $layout = new Layout();
            break;
                }







        case "brands":
            $brandId = $uriComponents[1] ?? null;
            echo $brandId;
            if ($brandId !== null && is_numeric($brandId)) {
                require_once './app/views/pages/brandsPage/brandDetails.php';
                $layout = new Layout();
                $view = new BrandDetailsPage($brandId);
                break;  
                
            } else {
                require_once './app/views/pages/brandsPage/brandsPage.php';
                $layout = new Layout();
                $view = new BrandsPage();
                break;
            }
        case "vehiculs":
            $carId = $uriComponents[1] ?? null;

            if ($carId !== null && is_numeric($carId)) {
                require_once './app/views/pages/vehiclePages/vehicleDesciptionPage.php';
                $layout = new Layout();
                $view = new VehicleDescriptionPage($carId);
                break;  
                
            } else {
                require_once './app/views/error.php';
                $layout = new Layout();
                $view = new ErrorPage();
                break;
            }

         

            case "news":
            $layout = new Layout();

                $option = $uriComponents[1] ?? null;
            
                switch ($option) {
                    case 'details':
                        $id = $uriComponents[2] ?? null;
            
                        if ($id === null || !is_numeric($id)) {
                            require_once './app/views/error.php';
                            $view = new ErrorPage();
                            break;}

                        include_once './app/views/pages/newsPage/newsDetail.php';
                        $view = new NewsDetailPage($id);
                        $layout = new Layout();
                        break;
            
                    default:
                        require_once './app/views/pages/newsPage/newsPage.php';
                        $view = new NewsPage();
                        break;
                }
                break;
            

            // *********************
        case "signUp":
            require_once './app/views/auth/signUp.php';
            $layout = new Layout();
            $view = new SingUpPage();
            break;
        case "logIn":
            require_once './app/views/auth/logIn.php';
            $layout = new Layout();
            $view = new LogInPage();
            break;

        case "myProfile":
            require_once './app/views/pages/profilePage/profilePage.php';
            $layout = new Layout();
            $view = new ProfilePage();
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

            //! nested url : 
        case "reviews":

            $id = isset($_GET['carId']) ? $_GET['carId'] : null;
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            if ($id !== null && is_numeric($id)) {
                require_once __DIR__ . '/app/views/pages/reviewsPages/reviewOfSelectedCar.php';
                $view = new ReviewOfSelectedCarPage($id, $page);  // Assuming your view takes an id as a parameter
                $layout = new Layout();
            } else {

                require_once './app/views/pages/reviewsPages/reviewsPage.php';
                $layout = new Layout();
                $view = new ReviewsMainPage();
            }
            break;

            //!-------------------------------- admin -------------------
            // admin dashboard 
        case 'admin':

            if (!isset($_COOKIE['logedIn_user'])) {
                echo "Soory, You are not authorised to access this page", "403";
                break;
            } else {


                // if ($user['role'] != "admin") {
                //     // ?? fix this later and add it in the backend
                //     // $sharedView->notFoundPage("Soory, You are not authorised to access this page", "403");
                //     // break;
                // }


                //     if (!isset($_GET['page'])) {


                //     require_once './app/views/admin/adminDashboard.php';
                //     $view = new AdminDashboardPage();
                //     break;
                // } 

                $page = $uriComponents[1] ?? null;
                $option = $uriComponents[2] ?? null;
                $id = $uriComponents[3] ?? null;

                switch ($page):
                    case 'users':
                        require_once './app/views/admin/adminUsers.php';
                        $view = new AdminUsersPage();
                        break;

                    case 'brands':

                        switch ($option):

                            case 'add':
                                require_once './app/views/admin/pagesAdministration/brand.php';
                                $view = new BrandAdministration();
                                break;
                            case 'edit':
                                require_once './app/views/admin/pagesAdministration/brand.php';
                                $view = new BrandAdministration($id);

                                break;
                            case 'details':
                                require_once './app/views/admin/detailsPages/brandDetail.php';
                                $view = new AdminBrandDetailsPage();
                                break;

                            default:
                                require_once './app/views/admin/adminBrandsDashboard.php';
                                $view = new AdminBrandsPage();
                                break;

                        endswitch;
                        break;

                    case 'vehicles':
                        switch ($option):
                            case 'add':
                                require_once './app/views/admin/pagesAdministration/vehicle.php';
                                $view = new VehicleAdministration();
                                break;
                            case 'edit':
                                require_once './app/views/admin/pagesAdministration/vehicle.php';
                                $view = new VehicleAdministration($id);
                                break;
                            case 'details':
                                require_once './app/views/admin/detailsPages/vehicleDetail.php';
                                $view = new AdminVehicleDetailsPage();
                                break;

                        endswitch;
                        break;


                    case 'reviews':
                        require_once './app/views/admin/adminReviews.php';
                        $view = new AdminReviewsPage();
                        break;
                    case 'news':
                        require_once './app/views/admin/adminNews.php';
                        $view = new AdminNewsPage();
                        break;
                    default:

                        require_once './app/views/admin/adminDashboard.php';
                        $view = new AdminDashboardPage();
                // require_once './app/views/error.php';
                // $view = new ErrorPage();
                endswitch;
            }
            // require_once './app/views/admin/adminDashboard.php';
            // $view = new AdminDashboardPage();
            // require_once './app/views/admin/adminDashboard.php';
            // $view = new AdminDashboardPage();

            break;

            //!-------------------------- end -------------------

        default:

            require_once("./app/views/error.php");
            $view = new ErrorPage();
    }

    $controller->showPage($view, $layout);
    ?>

</body>

</html>