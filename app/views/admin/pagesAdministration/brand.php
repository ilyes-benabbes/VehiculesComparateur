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
class BrandAdministration {
   private $id = null;
    public function __construct($id = null){
        $this->id = $id;
    }
    public function show(){
        $BrandCtrl = new BrandsController();
    
        $isEdit = null ;
        if($this->id && $BrandCtrl->getBrandById($this->id) ){
            $isEdit = true ;
         }
         else{
            if ( $this->id == null){
                $isEdit = false ;
            }
            else
            if(!$BrandCtrl->getBrandById($this->id)){
                echo "Brand not found";
                return;
            }
            
         }
   
         $this->showContainer($isEdit);
        } // end of function show
   
        public function showContainer($isEdit){
        $brandCtrl = new BrandsController();

            if ($isEdit){
                $brand = $brandCtrl->getBrandById($this->id);
            }else {
                $brand = null;
            }
            
            echo "<div class='overView colLeft'>
                <h1>Brand Overview</h1>";



echo "
                <h4>Name : </h4>
                <input type='text' name='name' value='" . ($brand ? $brand["name"] : "") . "'>
                <h4>Origin : </h4>
                <input type='text' name='origin' value='" . ($brand ? $brand["origin"] : "") . "'>
                <h4>Year of Creation : </h4>
                <input type='text' name='yearOfCreation' value='" . ($brand ? $brand["yearOfCreation"] : "") . "'>
                <h4>Founder : </h4>
                <input type='text' name='founder' value='" . ($brand ? $brand["founder"] : "") . "'>
                <h4>CEO : </h4>
                <input type='text' name='ceo' value='" . ($brand ? $brand["ceo"] : "") . "'>
                <h4>Headquarters : </h4>
                <input type='text' name='headQuarters' value='" . ($brand ? $brand["headQuarters"] : "") . "'>
                <h4>Worth : </h4>
                <input type='text' name='worth' value='" . ($brand ? $brand["worth"] : "") . "'>
                </div>";

                echo "<div class='description'>
                    <h1>Description</h1>
                    <input type='text' name='description' value='" . ($brand ? $brand["description"] : "") . "' ></input>
                    </div>";
 // slogan
                    echo "<div class='slogan'>"
                    . "<h1>Slogan</h1>"
                    . "<input type='text' name='slogan' value='" . ($brand ? $brand["slogan"] : "") . "'>"
                    . "</div>";
                    // video
                  

                if ($isEdit){
                    //images section
                    echo "<div class='images wild'>
                    <h1>image</h1>";
                    echo "<div class='relative fit' >";
                    echo  "  <i class='delete fa-trash fas' ></i>";;    
                    echo "<img src='./../../../" . $brand["imagePath"] . "' alt=' ".$brand["imagePath"]." 'width=150 action='deleteBrandImage' id='{$brand["id"]}'>";
                    echo "</div>";

  
                    echo "<div class='video'>"
                    . "<h1>Video</h1>"
                    . "<video src='./../../../" . $brand["videoPath"] . "' width='500' height='350' controls  >"
                    . "</div>";
                    // rating

                // facts section
                echo "<div class=' fcol'>
                    <h1>Notable Facts</h1>";
                    echo "<div class='fcol'>";
                    if (isset($brand["notableFacts"]) == 0){
                        echo "<p>No notable facts</p>";
                    }
                    else    

                foreach ($brand["notableFacts"] as $key =>$fact) {
                    echo "<input type='text' name='notableFacts[]' value='$fact'>";
                }

                echo "</div>";
                echo "</div>";
                // awards section
                echo "<div class='awards wild'>
                    <h1>Awards and Recognition</h1>";
                     if (isset($brand["awards"]) == 0){
                        echo "<p>No awards</p>";
                    }
                    else
                    
                foreach ($brand["awards"] as $award) {
                    echo "<input type='text' name='awards[]' value='$award'>";
                }
                echo "</div>";

                echo "<button action='updateBrand' id='{$brand["id"]}'  class='addBrandButton'>save modification</button>";


            }
            else {
                   //images section
                   echo "<div class='images '>
                   <h1>image</h1>";
                   echo "<div >";
                   echo "<input type='file' name='imagePath'>";
                   echo "</div>";

             

             



                echo "<div class='video'>"
                . "<h1>Video</h1>"
                . "<input type='file' name='videoPath'>"

                . "</div>";

                echo "<div class=' fcol'>
                    <h1>Notable Facts</h1>";
                    echo "<div class='fcol'>";
                for ($i=0; $i < 3; $i++) { 
                    echo "<label for='notableFacts[]'>Fact $i</label>";
                    echo "<input class='facts' type='text' name='notableFacts[]'>";
                }

                echo "</div>";
                echo "</div>";
                // awards section
                echo "<div class='awards fcol'>
                    <h1>Awards and Recognition</h1>";
                for ($i=0; $i < 3; $i++) { 
                    echo "<label for='awards[]'>Award $i</label>";
                    echo "<input class='awards' type='text' name='awards[]'>";
                }
                echo "</div>";

                echo "<button action='addBrand'  class='addBrandButton btn btn-success'>Add Brand</button>";
            }

           

        

    }
   

}