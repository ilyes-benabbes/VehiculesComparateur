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

}
