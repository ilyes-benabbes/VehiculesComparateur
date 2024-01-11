<script src="/VehiculesComparateur%20(ProjetWeb)/public/js/jquery.js"></script>
<script src="/VehiculesComparateur%20(ProjetWeb)/public/js/admin.js"></script>
<link rel="stylesheet" href="/VehiculesComparateur%20(ProjetWeb)/public/css/components.css">
 <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-...">
    <link rel="stylesheet" type="" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    </head>

<?php 
require_once __DIR__ . '/../../../controllers/brandsController.php';
require_once __DIR__ . '/../../../controllers/vehiclesController.php';
class VehicleAdministration {
   private $id = null;
    public function __construct($id = null){
        $this->id = $id;
    }
    public function show(){
        $vehCtrl = new VehiclesController();
    
        $isEdit = null ;
        if($this->id && $vehCtrl->getVehicleById($this->id) ){
            $isEdit = true ;
         }
         else{
            if ( $this->id == null){
                $isEdit = false ;
            }
            else
            if(!$vehCtrl->getVehicleById($this->id)){
                echo "Vehicule not found";
                return;
            }
            
         }
   
         $this->showContainer($isEdit);
        } // end of function show

        function getVersions(){
            $model = new VehiculesModel();
            $res = $model->getVersions();
            return $res;
        }
   
        public function showContainer($isEdit){
        $vc = new VehiclesController();

            if ($isEdit){
                $car = $vc->getVehicleById($this->id);
            }else {
                $car = null;
            }

            echo "
            <h1>Vehicle Overview</h1> " ;


            if (!$isEdit){
                // if is edit show the main image , the images , the selected features , the version , and the brand and not the select










                echo "<h4>Brand : </h4>";
                echo "<select name='brand' id='brand'>";
                echo "<option value='' disabled selected>----------------</option>";
                $brands = $vc->getBrands();
                foreach ($brands as $brand) {
                    echo "<option value='{$brand["id"]}'>{$brand["name"]}</option>";
                }
                echo "</select>";
                echo "<h4>Version:</h4>";
                echo "<div class='frow' >";
                echo "<select name='version' id='brand'>";
                echo "<option value='' disabled selected>----------------</option>";
    
                $versions = $vc->getVersions();
                foreach ($versions as $v) {
                    echo "<option value='{$v["id"]}'>{$v["name"]}</option>";
                }
                echo "</select>";
                echo "<p>or</p>";
                echo "<button id='addVersion'class='btn btn-primary' >Add missing Version</button>";
                echo "</div>"; // end of version div
    
                echo "<h4>Features : </h4>";


                echo "<div class='frow'>";
                echo "<select name='features' id='features' multiple>";
                $features = $vc->getFeatures();
                foreach ($features as $f) {
                    echo "<option value='{$f["id"]}'>{$f["featureName"]}</option>";
                }
                echo "</select>";
                echo "<p>or</p>";
                echo "<button id='addFeature' class='btn btn-primary'>Add missing Feature</button>";
                echo "</div>"; 

                echo "<h4>Colors : </h4>";
                echo "<div >";
                echo "<select name='colors' id='colors' multiple>";
                $colors = $vc->getAllColors();
                foreach ($colors as $c) {
                    echo "<option value='{$c["id"]}'>{$c["name"]}</option>";
                }
                echo "</select>";
            }

            echo "<h4>Brand name : </h4>";
            echo "<select name='brand' id='brand' >";
            echo "<option value=''  disabled>----------------</option>";
            $brands = $vc->getBrands();
            foreach ($brands as $brand) {
                if ($brand["id"] == $car["brand_id"]){   
                    echo "<option selected=''    value='{$brand["id"]}'>{$brand["name"]}</option>";
                }
                else
                echo "<option     value='{$brand["id"]}'>{$brand["name"]}</option>";
            }
            echo "</select>";
        
            echo "<h4>Model name : </h4>
               <input type='text' name='origin'  value='" . ($car ? $car["name"] : "") . "'> " ;
            echo "<h4>Type : </h4>";
            echo "<input type='text' name='type' value='" . ($car ? $car["type"] : "") . "'>";
            echo "<h4>Version : </h4>";
            echo "<select name='version' id='version'>";
            echo "<option value='' disabled selected>----------------</option>";
            $versions = $vc->getVersions();
            foreach ($versions as $version) {
                if ($version["id"] == $car["version_id"]){   
                    echo "<option selected=''    value='{$version["id"]}'>{$version["name"]}</option>";
                }
                else
                echo "<option selected=''    value='{$version["id"]}'>{$version["name"]}</option>";
            }
            echo "</select>";


            // echo "<input type='text' name='version' value='" . ($car ? $car["version"] : "") . "'>";
            echo "<h4>Year : </h4>";
            echo "<input type='text' name='year' value='" . ($car ? $car["year"] : "") . "'>";
            echo "<h4>Number of seats : </h4>";
            echo "<input type='text' name='number_of_seats' value='" . ($car ? $car["number_of_seats"] : "") . "'>";
            echo "<h4>Capacity : </h4>";
            echo "<input type='text' name='capacity' value='" . ($car ? $car["capacity"] : "") . "'>";
            echo "<h4>Consumption : </h4>";
            echo "<input type='text' name='consumption' value='" . ($car ? $car["consumption"] : "") . "'>";
            echo "<h4>Engine power : </h4>";
            echo "<input type='text' name='engine_power' value='" . ($car ? $car["engine_power"] : "") . "'>";
            echo "<h4>Acceleration : </h4>";
            echo "<input type='text' name='acceleration' value='" . ($car ? $car["acceleration"] : "") . "'>";
            echo "<h4>Max speed : </h4>";
            echo "<input type='text' name='max_speed' value='" . ($car ? $car["max_speed"] : "") . "'>";
            echo "<h4> warranty : </h4>";
            echo "<input type='text' name='warranty' value='" . ($car ? $car["warranty"] : "") . "'>";
            echo "<h4>Price : </h4>";
            echo "<input type='text' name='price' value='" . ($car ? $car["price"] : "") . "'>";
            echo "<h4>Height : </h4>";
            echo "<input type='text' name='height' value='" . ($car ? $car["height"] : "") . "'>";
            echo "<h4>Length : </h4>";
            echo "<input type='text' name='length' value='" . ($car ? $car["length"] : "") . "'>";
            echo "<h4>Weight : </h4>";
            echo "<input type='text' name='weight' value='" . ($car ? $car["weight"] : "") . "'>";
            echo "<h4>Width : </h4>";
            echo "<input type='text' name='width' value='" . ($car ? $car["width"] : "") . "'>";
            echo "<h4>Cargo space : </h4>";
            echo "<input type='text' name='cargo_space' value='" . ($car ? $car["cargo_space"] : "") . "'>";


            
                        if (!$isEdit){

            echo "<h4>main image : </h4>";
            echo "<input type='file' name='image' value='" . ($car ? $car["image"] : "") . "'>";
            echo "<h4>other Images : </h4>";
            echo "<input  multiple type='file' name='images' id='imageInput' accept='image/*' value='" . ($car ? $car["images"] : "") . "'>";
        
                        // if is edit show the main image , the images , the selected features , the version , and the brand and not the select

                        
                        echo "<button  class='addCarButton btn btn-success'>Add Vehicle</button>";
            }
            else {
                $features = $vc->getFeatures();
                echo "<h4>Features : </h4>";
                foreach ($features as $feature) {

                    

                    foreach ($car["features"] as $key=>$featureText) {
                        if ($featureText == $feature["featureName"]){
                            $feature["checked"] = true ;
                            break;
                        }
                        else {
                            $feature["checked"] = false ;
                        }
                    }
                    echo '<div class="rowLeft" >';
                    // echo "<input type='checkbox' name='features' value='{$feature['id']}'>";
                    // echo "<input type='checkbox' name='features'  >";
                    echo "<input class='feature' type='checkbox' name='features' value='{$feature['id']}' " . ($feature["checked"] ? "checked" : "") . ">";
                    echo "<label for='features'>{$feature['featureName']}</label>";
                    echo "</div>";
                }
                echo "<h4>Colors : </h4>";
                $colors = $vc->getAllColors();
                foreach ($colors as $color) {
                    foreach ($car["colors"] as $key=>$colorText) {
                        if ($colorText == $color["name"]){
                            $color["checked"] = true ;
                            break;
                        }
                        else {
                            $color["checked"] = false ;
                        }
                    }
                    echo '<div class="rowLeft" >';
                    // echo "<input type='checkbox' name='features' value='{$feature['id']}'>";
                    // echo "<input type='checkbox' name='features'  >";
                    echo "<input class='color' type='checkbox' name='colors' value='{$color['id']}' " . ($color["checked"] ? "checked" : "") . ">";
                    echo "<label for='colors'>{$color['name']}</label>";
                    echo "</div>";
                }



            echo "<h4>main image : </h4>";
            echo "<div class='relative fit'>";  
            echo "<img class='relative ' src='/VehiculesComparateur%20(ProjetWeb)/{$car["image"]}' alt='main image' width=150 id='{$car["image"]}' action='deleteMainImage'
            carId='{$car["id"]}'
            >";
            echo ' <i class="fas fa-trash delete"></i> ';
            echo "</div>";
            
            
            echo "<h4>other Images : </h4>";
            
            if (isset($car["images"]) == 0){
                echo "<p>No other images</p>";
            }
            else {

            $images = $car["images"];   
            echo "<div class='imagesContainer frow'>";

            foreach ($images as $image) {
                echo "<div class='relative fit'>";
                echo "<img src='/VehiculesComparateur%20(ProjetWeb)/{$image}' alt='other image' width=100 id='$image' action='deleteOtherImage' carId='{$car["id"]}'>";
                echo ' <i class="fas fa-trash delete"></i> ';
                echo "</div>";
                
            }

            echo "</div>";
        }
            echo "<button id='{$car["id"]}' class='editCarButton btn btn-success'>Edit Vehicle</button>";}



          



           

        

    }
   

}