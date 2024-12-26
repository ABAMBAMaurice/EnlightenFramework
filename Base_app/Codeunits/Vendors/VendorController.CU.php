<?php

class VendorController {

    public static function getAllVendors() {
        $vendors = new Vendors();
        if ($vendors->rec->FindAll()) {
            echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($vendors)));
        }else{
            echo json_encode(array("status" => 204, "message" => "No results found"));
        }

    }
    public static function getVendor($code){
        $vendor = new VendorCard();
        if($vendor->rec->get($code)){
            echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($vendor)));
        }else{
            echo json_encode(array("status" => 204, "message" => "No results found"));
        }
    }

    public static function Insert($data){
        $vendor = new Vendor();
        foreach ($data as $key => $value) {
            $vendor->Validate($key, $value);
        }
        $result = $vendor->Insert();

        echo json_encode($result);
    }
    public static function Delete($code){
        $vendor = new Vendor();
        if($vendor->get($code)){
            if($vendor->Delete()){
                echo json_encode(array("status" => 200, "message" => "deleted"));
            }
        }else{
            echo json_encode(array("status" => 204, "message" => "No results found"));
        }
    }

}
