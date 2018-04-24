<?php

namespace Wuunder\Model;

class ParcelshopsModel extends Model
{
    public function __construct($data)
    {
        parent::__construct();
        $this->setKeys(array(
            "parcelshops" => array(
                ParcelshopModel::getStructure()
            ),
            "address" => array(
                "zip_code",
                "street_name",
                "state",
                "house_number",
                "city"
            ),
            "location" => array(
                "lng",
                "lat"
            )
        ));

        $this->importData($data);
    }
}