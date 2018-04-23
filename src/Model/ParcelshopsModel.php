<?php

namespace Wuunder\Model;

class ParcelshopsModel extends Model
{
    public function __construct($data)
    {
        parent::__construct();
        $this->setKeys(array(
            "parcelshops" => array(
                array(
                    "provider",
                    "parcelshop_id",
                    "opening_hours" => array(
                        array(
                            "weekday",
                            "open_morning",
                            "open_afternoon",
                            "close_morning",
                            "close_afternoon"
                        )
                    ),
                    "longitude",
                    "latitude",
                    "id",
                    "homepage",
                    "distance",
                    "company_name",
                    "carrier_name",
                    "address" => array(
                        "zip_code",
                        "street_name",
                        "state",
                        "phone_number",
                        "house_number",
                        "email_address",
                        "country_name",
                        "city",
                        "alpha2"
                    )
                )
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