<?php

class saleInvoiceController{
        public static function getInvoice($code){
            /*$order = new saleOrder();
            if ($order->rec->get($code,'INVOICE')) {
                echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($order)));
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found", "result" => json_decode($order)));
            }*/
        }

        public static function getAllInvoices(){
            /*$orders = new saleOrders();
            $orders->setRange('Document_type', 'INVOICE');
            if($orders->rec->FindSet()){
                echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($orders)));
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found","result" => json_decode($orders)));
            }*/
        }
}
