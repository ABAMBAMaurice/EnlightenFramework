<?php

    class saleOrdersController{
        public static function getOrder($code){
            $order = new saleOrder();
            if ($order->rec->get($code,'ORDER')) {
                echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($order)));
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found", "result" => json_decode($order)));
            }
        }

        public static function getAllOrders(){
            $orders = new saleOrders();
            $orders->setRange('Document_type', 'ORDER');
            if($orders->rec->FindSet()){
                echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($orders)));
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found","result" => json_decode($orders)));
            }
        }
}
