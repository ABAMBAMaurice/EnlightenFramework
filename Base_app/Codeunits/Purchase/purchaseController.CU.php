<?php


class purchaseController{

    public static function Insert_purchaseHeader($data){
        $purchHeader = new purchaseHeader();
        foreach ($data as $key => $value) {
            $purchHeader->Validate($key, $value);
        }
        $result = $purchHeader->Insert();

        echo json_encode($result);
    }

    public static function Insert_purchaseLine($data){
        $purchLine = new purchaseLine();
        foreach ($data as $key => $value) {
            $purchLine->Validate($key, $value);
        }
        $purchLine->testField($purchLine->Document_No);
        $purchLine->testField($purchLine->Document_type);
        $result = $purchLine->Insert();

        echo json_encode($result);
    }

    //region Order
        public static function getOrder($code){
            $order = new purchaseOrder();
            if ($order->rec->get($code,'ORDER')) {
                echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($order)));
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found", "result" => json_decode($order)));
            }
        }

        public static function getAllOrders(){
            $orders = new purchaseOrders();
            $orders->setRange('Document_type', 'ORDER');
            if($orders->rec->FindSet()){
                echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($orders)));
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found","result" => json_decode($orders)));
            }
        }
    //endregion

}
