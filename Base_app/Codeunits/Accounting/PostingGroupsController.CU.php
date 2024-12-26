<?php
    class PostingGroupsController {

        //region Client
            public static function getCustomerPostingGroups() {
                $gcc = new GrpesComptaClient();
                if($gcc->rec->FindAll()){
                    echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($gcc)));
                }else{
                    echo json_encode(array("status" => 204, "message" => "No results found"));
                }
            }
            public static function getCustomerPostingGroup($code) {
                $gcc = new GrpesComptaClient();
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

            public static function UpdateCustomerPostingGroup($code, $data) {
                $gcc = new GrpeComptaClient();
                if($gcc->get($code)){
                    foreach ($data as $key => $value) {
                        $gcc->Validate($key, $value);
                    }
                    $result = $gcc->Modify();
                    echo json_encode($result);
                }else{
                    echo json_encode(array("status" => 204, "message" => "No results found"));
                }
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
                $gcc = new GrpesComptaFournisseur();
                if($gcc->rec->FindAll()){
                    echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($gcc)));
                }else{
                    echo json_encode(array("status" => 204, "message" => "No results found"));
                }
            }
            public static function getVendorPostingGroup($code) {
                $gcc = new GrpesComptaFournisseur();
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
            public static function UpdateVendorPostingGroup($code, $data) {
            $gcc = new GrpeComptaFournisseur();
            if($gcc->get($code)){
                foreach ($data as $key => $value) {
                    $gcc->Validate($key, $value);
                }
                $result = $gcc->Modify();
                echo json_encode($result);
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found"));
            }
        }
        //endregion

        //region produit
            public static function getProductPostingGroups() {
                $gcc = new GrpesComptaProduits();
                if($gcc->rec->FindAll()){
                    echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($gcc)));
                }else{
                    echo json_encode(array("status" => 204, "message" => "No results found"));
                }
            }
            public static function getProductPostingGroup($code) {
                $gcc = new GrpesComptaProduits();
                if($gcc->rec->get($code)){
                    echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($gcc)));
                }else{
                    echo json_encode(array("status" => 204, "message" => "No results found"));
                }
            }
            public static function InsertProductPostingGroup($data) {
                $gcc = new GrpeCompaProduit();
                foreach ($data as $key => $value) {
                    $gcc->Validate($key, $value);
                }
                $result = $gcc->Insert();

                echo json_encode($result);
            }
            public static function deleteProductPostingGroup($code) {
                $gcc = new GrpeCompaProduit();
                if($gcc->get($code))
                    if($gcc->Delete())
                        echo json_encode(array("status" => 200, "message" => "deleted"));
                    else
                        echo json_encode(array("status" => 204, "message" => "No results found"));
            }
            public static function UpdateProductPostingGroup($code, $data)
            {
                $gcc = new GrpeCompaProduit();
                if ($gcc->get($code)) {
                    foreach ($data as $key => $value) {
                        $gcc->Validate($key, $value);
                    }
                    $result = $gcc->Modify();
                    echo json_encode($result);
                } else {
                    echo json_encode(array("status" => 204, "message" => "No results found"));
                }
            }

        //endregion

        //region Groupe compta marché
            public static function getGenBusPostingGroups() {
                $gcc = new GrpesComptaMarches();
                if($gcc->rec->FindAll()){
                    echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($gcc)));
                }else{
                    echo json_encode(array("status" => 204, "message" => "No results found", "result" => json_decode($gcc)));
                }
            }

            public function getGenBusPostingGroup($code) {
                $gcc = new GrpesComptaMarches();
                if($gcc->rec->get($code)){
                    echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($gcc)));
                }else{
                    echo json_encode(array("status" => 204, "message" => "No results found", "result" => json_decode($gcc)));
                }
            }

            public static function InsertGenBusPostingGroup($data) {
                $gcc = new GrpeCompaMarche();

                foreach ($data as $key => $value) {
                    $gcc->Validate($key, $value);
                }
                $result = $gcc->Insert();

                echo json_encode($result);
            }

            public static function deleteGenBusPostingGroup($code) {
                $gcc = new GrpeCompaMarche();
                if($gcc->get($code))
                    if($gcc->Delete())
                        echo json_encode(array("status" => 200, "message" => "deleted"));
                else
                    echo json_encode(array("status" => 204, "message" => "No results found"));
            }
            public static function UpdateGenBusPostingGroup($code, $data){
                $gcc = new GrpeCompaMarche();
                if ($gcc->get($code)) {
                    foreach ($data as $key => $value) {
                        $gcc->Validate($key, $value);
                    }
                    $result = $gcc->Modify();
                    echo json_encode($result);
                } else {
                    echo json_encode(array("status" => 204, "message" => "No results found"));
                }
            }
        //endregion

        //region Grpe compta marché TVA
            public static function getAllGrpeComptaMarcheTVA(){
                $grpeCptaMarcheTVA = new GrpesComptaMarchesTVA();
                if($grpeCptaMarcheTVA->rec->FindAll()){
                    echo '{"status":200,"message":"success","result":'.$grpeCptaMarcheTVA.'}';
                }else{
                    echo json_encode(array("status" => 204, "message" => "No results found"));
                }
            }

            public static function InsertGrpeComptaMarcheTVA($data) {
                $gcc = new GrpeCompaMarcheTVA();
                foreach ($data as $key => $value) {
                    $gcc->Validate($key, $value);
                }
                $result = $gcc->Insert();
                echo json_encode($result);
            }

            public static function getGrpeComptaMarcheTVA($code){
                $grpeCptaMarcheTVA = new GrpesComptaMarchesTVA();
                if($grpeCptaMarcheTVA->rec->get($code)){
                    echo '{"status":200,"message":"success","result":'.$grpeCptaMarcheTVA.'}';
                }else{
                    echo '{"status":204,"message":"No result found","result":'.$grpeCptaMarcheTVA.'}';
                }
            }

            public static function deleteGrpeComptaMarcheTVA($code){
                $grpeCptaMarcheTVA = new GrpeCompaMarcheTVA();
                if($grpeCptaMarcheTVA->rec->get($code)){
                    if($grpeCptaMarcheTVA->Delete())
                        echo '{"status":200,"message":"deleted"}';
                }else{
                    echo '{"status":204,"message":"No result found","result":'.$grpeCptaMarcheTVA.'}';
                }
            }
        //endregion

        //region Grpe compta prodtuit TVA
            public static function getAllGrpeComptaProduitTVA(){
                $gcc = new GrpesComptaProduitsTVA();
                if($gcc->rec->FindAll()){
                    echo '{"status":200,"message":"success","result":'.$gcc.'}';
                }else{
                    echo '{"status":204,"message":"No result found","result":'.$gcc.'}';
                }
            }

            public static function getGrpeComptaProduitTVA($code){
                $gcc = new GrpesComptaProduitsTVA();
                if($gcc->rec->get($code)){
                    echo '{"status":200,"message":"success","result":'.$gcc.'}';
                }else
                    echo '{"status":204,"message":"No result found","result":'.$gcc.'}';
            }

            public static function InsertGrpeComptaProduitTVA($data) {
                $gcc = new GrpeCompaProduitTVA();
                foreach ($data as $key => $value) {
                    $gcc->Validate($key, $value);
                }
                $result = $gcc->Insert();
                echo json_encode($result);
            }

            public static function deleteGrpeComptaProduitTVA($code){
                $gcc = new GrpeCompaProduitTVA();
                if($gcc->get($code))
                    if($gcc->Delete())
                        echo json_encode(array("status" => 200, "message" => "deleted"));
                else
                    echo json_encode(array("status" => 204, "message" => "No results found"));
            }
        //endregion

    }
