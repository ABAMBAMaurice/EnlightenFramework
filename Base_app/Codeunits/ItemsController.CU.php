<?php

class ItemsController{
    public static function getAllItems(){
            $items = new ItemList();
            if ($items->rec->FindAll()) {
                echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($items)));
            }else{
                echo json_encode(array("status" => 404, "message" => "No results found"));
            }
        }
        public static function getItem($code){
            $item = new ItemCard();
            if($item->rec->get($code)){
                echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($item)));
            }else{
                echo json_encode(array("status" => 404, "message" => "No results found"));
            }
        }

}


?>
