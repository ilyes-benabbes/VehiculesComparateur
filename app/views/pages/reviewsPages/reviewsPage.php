<?php 
    class ReviewsMainPage 
    {

        function showResult($res)
        {
            echo '<pre>';
            print_r($res);
            echo '</pre>';
        }
        function show()
        {  // on clicking on a brand i think , after that i should show the dropDown i think
            $this->showBrandImagesDrawer();

        }

        function handleABrandIsSelected($id){
            //? when a brand is selected , i should show the drop shown
            $controller = new VehiclesController();
            $carsList = $controller->getVehiculesByBrandId($id);

            echo "<div class='dropDownSection col'>";
            echo "<h1>Select a model : </h1>";
            echo "<select name='cars' id='carsDropDownSelect'>";
            foreach($carsList as $car){
                echo "<option value='{$car["id"]}'>{$car["name"]}</option>";
            }
            echo "</select>";    
            echo "<button class='showSelectedCar'>See reviews </button>";
            echo "</div>";



            // $view = new ReviewOfSelectedCarPage($id ,$page = 1);
            // $view->show();
            // when a brand is selected on this page , it shows the second page called
        }

        function showBrandImagesDrawer(){

            $helperView = new HelperView();
            echo "<div class='brandsToReview'>";
            echo "<h1> Brands : </h1>"; 
            echo "<p>please select a brand to check its reviews</p>";
            $helperView->renderBrandsDrawer("250px");
            echo "</div >";
        } // end of 
            
          

}