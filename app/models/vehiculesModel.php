<?php
require_once  __DIR__ . '/../models/mainModel.php';

class VehiculesModel extends mainModel
{

function getUserReactionsToReviewsByCarId( $userId){
    
    $request = "SELECT * FROM vehiclereviewreaction WHERE user_id = ? ";
    $res = $this->request($request , [ $userId]);
    return $res;

}



    function hasReviewedThisCar($userId , $carId){
        $request = "SELECT * FROM vehiclereview WHERE user_id = ? AND vehicle_id = ?";
        $res = $this->request($request , [$userId , $carId]);
        return !empty($res);
    }

    function editCar($id , $data){
        $request = "UPDATE `vehicle` SET `brand_id`='$data[brand]',`version_id`='$data[version]',`name`='$data[origin]',`type`='$data[type]',`year`='$data[year]',`number_of_seats`='$data[number_of_seats]',`capacity`='$data[capacity]',`consumption`='$data[consumption]',`engine_power`='$data[engine_power]',`acceleration`='$data[acceleration]',`max_speed`='$data[max_speed]',`warranty`='$data[warranty]',`price`='$data[price]',`height`='$data[height]',`length`='$data[length]',`weight`='$data[weight]',`width`='$data[width]',`cargo_space`='$data[cargo_space]' WHERE id = $id";
        $this->request($request);
        // now for the features , remove all its features and colors , and reinsert the new ones 

        $request = "DELETE FROM `vehiclefeaturelink` WHERE vehicle_id = $id";
        $this->request($request);
        
        foreach($data["features"] as $feature){
            $request = "INSERT INTO `vehiclefeaturelink`(`vehicle_id`, `feature_id`) VALUES ($id , '$feature')";
            $this->request($request);
        }
        
        $request = "DELETE FROM `vehiclecolorlink` WHERE vehicle_id = $id";
        $this->request($request);
        foreach($data["colors"] as $color){
            $request = "INSERT INTO `vehiclecolorlink`(`vehicle_id`, `color_id`) VALUES ($id , '$color')";
            $this->request($request);
        }

    }



    function deleteCar($id){
        $request = "DELETE FROM `vehicle` WHERE id = $id";
        $this->request($request);
        $request = "DELETE FROM `vehiclefeaturelink` WHERE vehicle_id = $id";
        $this->request($request);
        $request = "DELETE FROM `vehiclecolorlink` WHERE vehicle_id = $id";
        $this->request($request);
        $request = "DELETE FROM `vehicleimages` WHERE vehicle_id = $id";
        $this->request($request);
    }
        

function   addColorsofCar($carId , $colors){
    $request = "INSERT INTO `vehiclecolorlink`(`vehicle_id`, `color_id`) VALUES ";
    for ($i=0; $i < count($colors) ; $i++) { 
        $request .= "($carId , '$colors[$i]')";
        if($i != count($colors) - 1){
            $request .= " , ";
        }
    }
    return $this->request($request);
}  

function deleteImage($imgPath){
    $request = "delete FROM `vehicleimages` WHERE vehicleimages.imagePath ='$imgPath'";
    $res = $this->request($request );
    print_r($res);
}

function getAllColors(){
    $request = "SELECT * FROM color";
    $res = $this->request($request );
    return $res;
}

function addFeaturesToCar($carId , $features){
    $request = "INSERT INTO `vehiclefeaturelink`(`vehicle_id`, `feature_id`) VALUES ";
    for ($i=0; $i < count($features) ; $i++) { 
        $request .= "($carId , '$features[$i]')";
        if($i != count($features) - 1){
            $request .= " , ";
        }
    }
    return $this->request($request);
}

function addImagesofCar($carId , $images){
 $BASE = 'public/images/modelImages/vehicles/';

    $request = "INSERT INTO `vehicleimages`(`vehicle_id`, `imagePath`) VALUES ";
    for ($i=0; $i < count($images) ; $i++) { 
        $BASE = 'public/images/modelImages/vehicles/';
        $path = $BASE . $images[$i];
        $request .= "($carId , '$path')";
        if($i != count($images) - 1){
            $request .= " , ";
        }
    }
    return $this->request($request);
}

function addVehicle( $data){
 
    $request = "INSERT INTO `vehicle`(`brand_id`, `version_id`, `name`, `type`, `year`, `number_of_seats`, `capacity`, `consumption`, `engine_power`, `acceleration`, `max_speed`, `warranty`, `price`, `height`, `length`, `weight`, `width`, `cargo_space`, `image`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $id =  $this->requestWithoutDisconnect($request , [$data["brand"] , $data["version"] , $data["origin"] , $data["type"] , $data["year"] , $data["number_of_seats"] , $data["capacity"] , $data["consumption"] , $data["engine_power"] , $data["acceleration"] , $data["max_speed"] , $data["warranty"] , $data["price"] , $data["height"] , $data["length"] , $data["weight"] , $data["width"] , $data["cargo_space"] , $data["image"]]);
    return $id;


}

function addFeature($data){
    $query = "INSERT INTO features (featureName) VALUES (?)";
    $this->request($query , [$data]);
}

function addVersion($data){
    $query = "INSERT INTO version (name) VALUES (?)";
    $this->request($query , [$data]);
}
    //! admin functions begin
    function getAllCars()
    {
        $query = "SELECT * FROM vehicle";
        return $this->request($query);
    }
    function getVersions()
    {
        $query = "SELECT * FROM version";
        return $this->request($query);
    }

    function getFeatures()
    {
        $query = "SELECT * FROM features";
        return $this->request($query);
    }
    //! admin functions end


function addToFavourite($id , $userId){
    $query = "INSERT INTO favorite (user_id , vehicle_id) VALUES (? , ?)";
    $this->request($query , [$userId , $id]);
}

    public function getBrands()
    {
        $query = "SELECT * FROM brand";
        return $this->request($query);
    }

    public function getFavoriteVehiclesByUserId($id){
        $query = "SELECT vehicle_id as id FROM favorite WHERE user_id = ?";
        return $this->request($query , [$id]);
    }

    public function getVehicles()
    {
        $query = "SELECT * FROM vehicles";
        return $this->request($query);
    }
    
    public function getModelsOfBrandById($id)
    {
        $query = "SELECT * FROM vehicle WHERE brand_id = $id";
        return $this->request($query);
    }

    function getVersionsByVehicleId($id)
    {
        // $query = "SELECT * FROM version join vehicle on (version_id = version.id ) WHERE vehicle.id = ? ";
        $query = "SELECT version.id , version.name FROM version JOIN vehicle ON (version_id = version.id) WHERE vehicle.id = ?";

        
        return $this->request($query, [$id]);
        
    }

    function getYearsByVersionId($id)
    { // here i must give you the Version and the Vehicule id so you can get the years

        $query = "SELECT year ,  FROM version JOIN vehicle ON (version_id = version.id)  WHERE version_id = ? ";
        
        return $this->request($query, [$id]);
        
    }
    function getYearsByVersion_VehicleId($vehicleId , $versionId)
    { 

        $query = "SELECT  year as name FROM version JOIN vehicle ON (version_id = version.id)  WHERE version_id = ? AND vehicle.id = ? ";
        
        return $this->request($query, [$versionId , $vehicleId]);
        
    }

    function getMostPopularComparisons($nbrOfComparisons)
    {
        $query = "SELECT id  FROM comparison ORDER BY occurrence_count DESC LIMIT $nbrOfComparisons";
        return $this->request($query);
    }
   function getVehiculesByComparisonId($id){
    $query = "SELECT * FROM vehicle join comparisonvehiclelink on (vehicle.id = comparisonvehiclelink.vehicle_id) where comparison_id = $id ";
    return $this->getFullVehiculesInfos($this->request($query));


   }

   function getFullVehiculesInfos($queryResults){
    $res = [];
    foreach ($queryResults as $vehicule){
        $id = $vehicule["vehicle_id"];
        $query = "SELECT vehicle.* ,  brand.name as brand , version.name as version  from (( vehicle join brand on (brand.id = vehicle.brand_id)) join version on (version.id = vehicle.version_id))  where  (vehicle.id = $id ) ";
        $res[] =  $this->request($query)[0];
        
    }

    
    
    return $res ;
}

function getVehicleById($id){
    // $query = "SELECT * FROM vehicle WHERE id = ?";
    $query = "SELECT vehicle.* ,  brand.name as brand , version.name as version  from (( vehicle join brand on (brand.id = vehicle.brand_id)) join version on (version.id = vehicle.version_id))  where  (vehicle.id = $id ) ";

    return $this->request($query); 
}

function getColorsByVehicleId($id){
    $query = "SELECT color.name FROM color JOIN vehiclecolorlink ON (color.id = vehiclecolorlink.color_id) WHERE vehicle_id = ?";
    return $this->request($query , [$id]);  
}

function getPopularCarsByBrandId($id , $nbrOfCarsToShow){
    // select the cars that have high vehiclerating and are of the brand with the id $id

    $request = "SELECT vehicle.id , AVG(rating) as rating FROM vehicle join vehiclereview on (vehicle.id = vehiclereview.vehicle_id) WHERE brand_id = $id GROUP BY vehicle.id ORDER BY rating DESC LIMIT $nbrOfCarsToShow";



//     $request = "SELECT vehicle.id as id ,  COUNT(favorite.id) AS favorite_count FROM vehicle
// LEFT JOIN
//     favorite ON vehicle.id = favorite.vehicle_id
// GROUP BY
//     vehicle.id
// ORDER BY favorite_count DESC LIMIT $nbrOfCarsToShow;";
    return $this->request( $request);
} // end of func

   function showResult($res)
   {
       echo '<pre>';
       print_r($res);
       echo '</pre>';
   }

  function getVehicleRatingById($id){
    $query = "SELECT AVG(rating) as rating FROM vehiclereview WHERE vehicle_id = ?";
    return $this->request($query , [$id])[0]["rating"];
  }

  function getImagesByVehicleId($id){
    $query = "SELECT imagePath FROM vehicleimages WHERE vehicle_id = ?";
    return $this->request($query , [$id]);
  }

  function getKeyFeaturesById($id){
    $query = "SELECT featureName FROM vehiclefeaturelink join features on (features.id =  vehiclefeaturelink.feature_id) WHERE vehicle_id = ?";
    return $this->request($query , [$id]);
  }


  function getPopularComparisonByCarId($id , $nbrOfComparisons){
    $query = "SELECT comparison.id , comparison.occurrence_count FROM comparison JOIN comparisonvehiclelink ON (comparison.id = comparisonvehiclelink.comparison_id) WHERE vehicle_id = ? ORDER BY occurrence_count DESC LIMIT $nbrOfComparisons";
    return $this->request($query , [$id]);
  }


  function getTopPopularReviewsByCarId($id ){
    $query = "SELECT text as reviewText , first_name , last_name , vehiclereview.id as id  FROM vehiclereview join user on (user.id =  vehiclereview.user_id) WHERE vehicle_id = ? ORDER BY rating DESC ";
    return $this->request($query , [$id]);
  }


  function getReviewPerVehicle($id , $nbrOfReviews = 0){
    // $offset = ($page-1) * $nbrOfReviews;
    $query = "SELECT text as reviewText , first_name , last_name  FROM vehiclereview join user on (user.id =  vehiclereview.user_id) WHERE vehicle_id = ? ORDER BY rating DESC ";
    return $this->request($query , [$id]);
  }




}


