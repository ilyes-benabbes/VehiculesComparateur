<?php
require_once  __DIR__ . '/../models/mainModel.php';

class VehiculesModel extends mainModel
{
    public function getBrands()
    {
        $query = "SELECT * FROM brand";
        return $this->request($query);
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


   function showResult($res)
   {
       echo '<pre>';
       print_r($res);
       echo '</pre>';
   }
}


