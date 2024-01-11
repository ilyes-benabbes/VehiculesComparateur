<head>
    <link rel="stylesheet" href="../public/css/components.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-...">
    <link rel="stylesheet" type="" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    </head>
<?php 
require_once __DIR__. '/../../controllers/admin/adminVehiculesController.php';
require_once __DIR__. '/../../controllers/vehiclesController.php';
class AdminBrandsPage {
//? now how to delete , on click , i show the alert first , then i get the id contained in the button , then i send it to the controller , then i delete it from the database , then i refresh the page
//? the edit , i change the page , fetch the data from backend , fill it , and make it modifiable , on click save , send all
//? data to the controller , then update the database , then refresh the page
//? details same thing as edit page but with no editing 
//? add a car , go to edit page , and all fields are blank 


    function show(){
        // $ctrl = new AdminVehController();
        $ctrl = new VehiclesController();
        $cars = $ctrl->getAllCars();
            echo "<div class='frow g2'>";
            echo "<h1>Vehicules</h1>";
            echo "<a href='vehicles/add' class='btn btn-primary'>Add a car</a>";
            echo "</div>";
            $this->showVehiclesTable();   
            echo "<div class='frow g2'>";
            echo "<h1>Brands</h1>";
            echo "<a href='brands/add/' class='btn btn-primary'>Add a brand</a>";
            echo "</div>";
        $this->showBrandsTable();   
        
        
    }



    public function showBrandsTable(){

        ?>
        <script src="../public/js/jquery.js"></script>
        <script src="../public/js/admin.js"></script>
        <div class="container">
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Brand Image</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        </div>


        <?php
                            $ctrl=new VehiclesController();
                            
                            $cars=$ctrl->getBrands();
                            foreach($cars as $car){
                                
                                
                                echo "<tr>";
                               // echo "<td>".$car['imagePath']."</td>";
                                echo "<td>";
                                echo "<img src='" ."../".$car['imagePath']."' alt='car image' width='50px' height='50px'>";
                               echo  "</td>";
                               echo "<td>".$car['name']."</td>";
                               echo "<td>";
                             
                               echo "<a href='brands/edit/".$car['id']."' class='btn btn-primary editBrandButton'>Edit</a>";
                               echo "<button id='".$car['id']."' class='btn btn-danger deleteBrandButton'>Delete</button>";
                               
                               echo  "</td>";
                                echo "</tr>";
                                }
                                ?>
                        

     
           
 
        </tbody>
   
    </table>

    <?php 
    }



        
 
    public function showVehiclesTable(){


        ?>
        <div class="container">
        <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Brand</th>
                <th>Model</th>
                <th>Version</th>
                <th>Year</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <!-- //!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
        <tbody>

        </div>
        <?php
                            $ctrl=new VehiclesController(); 
                            $cars=$ctrl->getAllCars();
                            foreach($cars as $row){
                                $car = $ctrl->getVehicleById($row['id']);
                                
                                echo "<tr>";
 
                                echo "<td>".$car['brand']."</td>";
                                echo "<td>".$car['name']."</td>";
                                    echo "<td>".$car['version']."</td>";
                                    echo "<td>".$car['year']."</td>";
                                    echo "<td>";
                                    echo "<img src='"."../".$car['image']."' alt='car image' width='50px' height='50px'>";
                                   echo  "</td>";
                                      echo "<td class =''>";
                                    
                                        echo "<a href='vehicles/edit/".$car['id']."' class='btn btn-warning editCarButton'>Edit</a>";
                                        echo "<button id='{$car['id']}' class='btn btn-danger deleteCarButton'>Delete car</a>";
                                      
                                      echo  "</td>";
                                    
                                    
                                    
                                    
                                    echo "</tr>";
                                }
                                ?>
                        

     
           
            <!-- <tr>
                <td>Shou Itou</td>
                <td>Regional Marketing</td>
                <td>Tokyo</td>
                <td>20</td>
                <td>2011-08-14</td>
                <td>$163,000</td>
            </tr>
            <tr>
                <td>Michelle House</td>
                <td>Integration Specialist</td>
                <td>Sydney</td>
                <td>37</td>
                <td>2011-06-02</td>
                <td>$95,400</td>
            </tr>
           
            <tr>
                <td>Hermione Butler</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>47</td>
                <td>2011-03-21</td>
                <td>$356,250</td>
            </tr>

            <tr>
                <td>Donna Snider</td>
                <td>Customer Support</td>
                <td>New York</td>
                <td>27</td>
                <td>2011-01-25</td>
                <td>$112,000</td>
            </tr> -->
        </tbody>
   
    </table>

    <?php 
    }
    
    private function show_table(){
        
        ?>
       <div class="container">
           
           
           <table id="table" 
           data-toggle="table"
           data-search="true"
                            data-filter-control="true" 
                            data-searchable="true"
                    class="table-responsive table table-bordered  ">
                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true"></th>
                            <th data-field="Marque" data-filter-control="select" data-sortable="true">Marque</th>
                            <th data-field="Model" data-filter-control="select" data-sortable="true">Model</th>
                            <th data-field="Version" data-sortable="true" data-filter-control="select">Version</th>
                            <th data-field="Annee" data-filter-control="select" data-sortable="true">Annee</th>
                            <th data-field="Caracteristique" >Caracteristique</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $v=new GestionVehiculeController();
                            
                            $r=$v->get_marqueversion_controller();
                            foreach($r as $row){
                                
                                echo "<tr>";
                                echo "<td></td>"; // Colonne de case à cocher
                                echo "<td>".$row['Marque']."</td>";
                                echo "<td>".$row['Model']."</td>";
                                    echo "<td>".$row['Version']."</td>";
                                    echo "<td>".$row['Annee']."</td>";
                                    echo "<td><a href=''>Lien</a></td>";
                                    
                                    
                                    echo "</tr>";
                                }
                                ?>
                        
                        
                        
                        <a href="/projetweb/Pweb/marque/" id="GererMarque" name="GererMarque" class="btn btn-primary">Gerer Marque</a>
                        <a href="/projetweb/Pweb/vehicule/" id="GererVehicules" name="GererVehicules" style="margin-left: 10px;"  class="btn btn-primary">Gerer Vehicules</a>
                        
                        
                        
                    </tbody>
                </table>
                <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

                
                
                </div>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
                <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.js"></script>
                <script src="https://unpkg.com/bootstrap-table@1.22.1/dist/extensions/filter-control/bootstrap-table-filter-control.min.js"></script>
                
                <?php
    }
    private function show_header(){
        echo  "<head>";
        echo "<meta charset='UTF-8' />";
        echo  "<meta name='viewport' content='width=device-width, initial-scale=1.0' />";
        echo  "<title>Comparateur de Vehecules</title>";
        echo " <link rel='stylesheet' href='/projetweb/Pweb/public/style.css' />";
        echo " <link rel='stylesheet' href='/projetweb/Pweb/public/styleadmin.css' />";
        echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN' crossorigin='anonymous'>";
        echo "<link rel='stylesheet' href='https://unpkg.com/bootstrap-table@1.22.1/dist/bootstrap-table.min.css'>";
        echo  "</head>";
        
    }
    private function show_body(){
        $this->show_NavBar('menu1');
        $this->show_title();
       $this->show_table();
    }

    
    
    
    

}
