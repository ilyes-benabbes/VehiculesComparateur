<?php
// ! this is the api controller
require_once __DIR__ . "/../controllers/vehiclesController.php";
require_once __DIR__ . "/../controllers/brandsController.php";
require_once __DIR__ . "/../controllers/usersController.php";



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {

        case 'addForm':
            $ctrl = new VehiclesController();
            $ctrl->addFormComparisonForm();  
            break; 
        case 'addVersion':
            
            $ctrl = new VehiclesController();
            $data = $_POST['payload'];
            $ctrl->addVersion($data);  
            break; 
        case 'addFeature':
            
            $ctrl = new VehiclesController();
            $data = $_POST['payload'];
            $ctrl->addFeature($data);  
            break; 

        case 'getNextSelect':
            $selectType = $_POST['type'];
            $selectedValues = $_POST['payload']; 
            $ctrl = new VehiclesController();
            $ctrl->getNextSelect($selectedValues , $selectType);

            break;

        case 'brandSelectedForReviews':
            $brand = $_POST['payload']; 
            $ctrl = new VehiclesController();
            $carModels = $ctrl->getVehiculesByBrandId($brand);
            $view = new HelperView();
            $view->renderNextSelect("Model" , "SelectModel" , $carModels );
            break;
            
            case 'carSelectedForReviews':

                $ctrl = new VehiclesController();
                $carId = $_POST['payload'];
                
                break;

                case 'signUp':
                    $data = $_POST['payload'];
                    $ctrl = new UsersController();
                    $response = $ctrl->createUser($data);
                    
                    header("Location:/VehiculesComparateur%20(ProjetWeb)/logIn/");
                    exit ;

                    break;
                case 'logIn':
                    $data = $_POST['payload'];
                    $ctrl = new UsersController();
                    $response = $ctrl->logIn($data);
                    echo json_encode($response);
                    break;
                case 'reviewCar':
                    $review = $_POST['payload']["review"];
                    $carId = $_POST['payload']["carId"];
                    $rating = $_POST['payload']["rating"];
                    $ctrl = new UsersController();
                    $response = $ctrl->addCarReview($review , $carId , $rating);
                    echo json_encode($response);
                    break;
            
            
            
            case 'compare' :
                $arrayOfVehicles = $_POST['payload'];
                $ctrl = new VehiclesController();
                $ctrl->compare($arrayOfVehicles);
                break;

            case 'addToFavorites' :
                $carId = $_POST['payload'];
                $ctrl = new VehiclesController();
                $ctrl->addToFavourite($carId);
                break;

                //! admin 
                case 'addBrand' : 
                $data = $_POST['payload'];
                $ctrl = new BrandsController();
                $ctrl->addBrand($data);
                break ;
                case 'updateBrand' : 
                $data = $_POST['payload'];
                $id = $_POST['id'];
                $ctrl = new BrandsController();
                $ctrl->updateBrandById($id ,$data);
                break ;
                
                case 'addCar' : 
                $data = $_POST['payload'];
                $ctrl = new VehiclesController();
                $ctrl->addVehicle($data);
                break ;
                case 'deleteMainImage' : 
                $img = $_POST['payload']["image"];
                $ctrl = new VehiclesController();
                // $ctrl->deleteMainImage($data);
                break ;
                case 'deleteOtherImage' :  
                    $img = $_POST['payload']["image"];
                    $id = $_POST['payload']["id"];
                    $ctrl = new VehiclesController();
                    $ctrl->deleteImage($img);
                    echo "here";
                break ;
                case 'deleteBrandImage' :  
                    $id = $_POST['payload']['image'];;
                    $ctrl = new BrandsController();
                    $ctrl->deleteImage($id);

                break ;
                case 'deleteBrand' :                    
                    $id = $_POST['payload'];
                    $ctrl = new BrandsController();
                    $ctrl->deleteBrand($id);

                break ;
                case 'editCar' :                    
                    $id = $_POST['id'];
                    $data = $_POST['payload'];
                    $ctrl = new VehiclesController();
                    $ctrl->EditCar($id ,$data);

                break ;
                case 'editBrand' :                    
                    $id = $_POST['id'];
                    $data = $_POST['payload'];
                    $ctrl = new BrandsController();
                    $ctrl->editBrand($id ,$data);

                break ;
                case 'deleteCar' :                    
                    $id = $_POST['payload'];
                    $ctrl = new VehiclesController();
                    $ctrl->deleteVehicle($id);

                break ;

            default:

            break;
        }
    } 

}