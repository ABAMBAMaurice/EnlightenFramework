<?php

    class CountriesController
    {
        public static function getAllCountries()
        {
            $countries = new CountryList();
            if ($countries->rec->FindAll()) {
                echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($countries)));
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found"));
            }
        }

        public static function getCountry($code){
            $countries = new CountryList();
            if($countries->rec->get($code)){
                echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($countries)));
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found"));
            }
        }

        public static function Insert($data){
            $countries = new Country();
            foreach ($data as $key => $value) {
                $countries->Validate($key, $value);
            }
            $result = $countries->Insert();

            echo json_encode($result);
        }

        public static function Delete($code){
            $countries = new Country();
            if($countries->get($code)){
                if($countries->Delete()){
                    echo json_encode(array("status" => 200, "message" => "deleted"));
                }
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found"));
            }
        }
    }

?>
