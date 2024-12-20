<?php
    class PostingGroupsController {

        //region Client
            public static function getCustomerPostingGroups() {
                $gcc = new GrpeComptaClientList();
                if($gcc->rec->FindAll()){
                    echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($gcc)));
                }else{
                    echo json_encode(array("status" => 204, "message" => "No results found"));
                }
            }
            public static function getCustomerPostingGroup($code) {
                $gcc = new GrpeComptaClientList();
                if($gcc->rec->get($code)){
                    echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($gcc)));
                }else{
                    echo json_encode(array("status" => 204, "message" => "No results found"));
                }
            }
            public static function InsertCustomerPostingGroup($data) {
                $gcc = new GrpeComptaClient();
                foreach ($data as $key => $value) {
                    $gcc->Validate($key, $value);
                }
                $result = $gcc->Insert();
                echo json_encode($result);
            }
            public static function deleteCustomerPostingGroup($code) {
                $gcc = new GrpeComptaClient();
                if($gcc->get($code))
                    if($gcc->Delete())
                        echo json_encode(array("status" => 200, "message" => "deleted"));
                else
                    echo json_encode(array("status" => 204, "message" => "No results found"));
            }
        //endregion

        //region Fournisseurs
            public static function getVendorPostingGroups() {
                $gcc = new GrpeComptaFournisseurList();
                if($gcc->rec->FindAll()){
                    echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($gcc)));
                }else{
                    echo json_encode(array("status" => 204, "message" => "No results found"));
                }
            }
            public static function getVendorPostingGroup($code) {
                $gcc = new GrpeComptaFournisseurList();
                if($gcc->rec->get($code)){
                    echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($gcc)));
                }else{
                    echo json_encode(array("status" => 204, "message" => "No results found"));
                }
            }
            public static function InsertVendorPostingGroup($data) {
                $gcc = new GrpeComptaFournisseur();
                foreach ($data as $key => $value) {
                    $gcc->Validate($key, $value);
                }
                $result = $gcc->Insert();
                echo json_encode($result);
            }
            public static function deleteVendorPostingGroup($code) {
                $gcc = new GrpeComptaFournisseur();
                if($gcc->get($code))
                    if($gcc->Delete())
                        echo json_encode(array("status" => 200, "message" => "deleted"));
                else
                    echo json_encode(array("status" => 204, "message" => "No results found"));
            }
        //endregion
    }