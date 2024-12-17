<?php

class CustomersController {
    public static function getAllCustomers() {
        $customers = new CustomerList();
        if($customers->rec->FindAll()) {
            echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($customers)));
        }else{
            echo json_encode(array("status" => 404, "message" => "No results found"));
        }
    }

    public static function getCustomer($code){
        $customer = new CustomerCard();
        if($customer->rec->get($code)){
            echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($customer)));
        }else{
            echo json_encode(array("status" => 404, "message" => "No results found"));
        }
    }


    public static function Insert($data){
        $customer = new Customer();
        foreach ($data as $key => $value) {
            $customer->Validate($key, $value);
        }
        $result = $customer->Insert();

        echo json_encode($result);
    }



}
