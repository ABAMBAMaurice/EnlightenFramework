<?php


class purchaseController{
    public static function getOrder($code){
        $order = new purchaseOrder();
        if ($order->rec->get($code,'ORDER')) {
            echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($order)));
        }else{
            echo json_encode(array("status" => 204, "message" => "No results found", "result" => json_decode($order)));
        }
    }

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

    public static function getAllOrders(){
        $orders = new purchaseOrders();
        $orders->setRange('Document_type', 'ORDER');
        if($orders->rec->FindSet()){
            echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($orders)));
        }else{
            echo json_encode(array("status" => 204, "message" => "No results found","result" => json_decode($orders)));
        }
    }


    /**
     *
     *  This function is Marked for removal
     *
     */
    public static function getLastLineNo($type, $code){
        $header = new purchaseHeader();
        if($header->get($code, $type)){
            $line = new purchaseLine();
            $line->setRange('Document_type',$type);
            $line->setRange('Document_No',$code);
            if($line->FindLast())
                return json_encode(array("status" => 200, "Message" => "success", "warning" => "this method is marked for removal", "result" => $line->Line_No->value));
            else
                return json_encode(array("status" => 200, "Message" => "success", "warning" => "this method is marked for removal", "result" => 0));
        }else{
            return json_encode(array("status" => 204, "Message" => "No result found for the Order No you've provided", "warning" => "this method is marked for removal"));
        }
    }
}
