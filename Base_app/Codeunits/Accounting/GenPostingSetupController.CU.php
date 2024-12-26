<?php
    class GenPostingSetupController{
        public static function getAllGenPostingSetup()
        {
            $gcc = new GenPostSetups();
            if($gcc->rec->FindAll()){
                echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($gcc)));
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found", "result" => json_decode($gcc)));
            }
        }

        public static function getGenPostingSetup($marche, $produit){
            $gcc = new GenPostSetups();
            if($gcc->get($marche, $produit)){
                echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($gcc)));
            }else
                echo json_encode(array("status" => 204, "message" => "No results found", "result" => json_decode($gcc)));
        }

        public static function InsertGenPostingSetup($data){
            $gcc = new GenPostSetup();
            foreach ($data as $key => $value) {
                $gcc->Validate($key, $value);
            }
            $result = $gcc->Insert();
            echo json_encode($result);
        }

        public static function deleteGenPostingSetup($marche, $produit){
            $gcc = new GenPostSetups();
            if($gcc->get($marche, $produit)){
                if ($gcc->Delete())
                    echo json_encode(array("status" => 200, "message" => "deleted"));
            }else
                echo json_encode(array("status" => 204, "message" => "No results found"));
        }

    }
?>
