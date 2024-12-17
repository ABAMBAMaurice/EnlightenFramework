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

        public static function Insert($data){
            $item = new Item();
            foreach ($data as $key => $value) {
                $item->Validate($key, $value);
            }
            $result = $item->Insert();

            echo json_encode($result);
        }

        public static function Delete($code){
            $item = new Item();
            if($item->get($code)){
                if($item->Delete()){
                    echo json_encode(array("status" => 200, "message" => "deleted"));
                }
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found"));
            }
        }

}


?>
