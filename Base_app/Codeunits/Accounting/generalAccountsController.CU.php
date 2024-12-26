<?php
    class generalAccountsController
    {
        public static function getAccounts()
        {
             $comptes = new GLAccountsList();
            if($comptes->rec->FindAll()){
                echo '{"status":200,"message":"success","result":'.$comptes.'}';
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found"));
            }
        }

        public static function getAccount($code){
            $comptes = new GLAccountsList();

            if($comptes->rec->get($code)){
                echo '{"status":200,"message":"success","result":'.$comptes.'}';
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found"));
            }
        }

        public static function deleteAccount($code){
            $comptes = new GLAccounts();
            if($comptes->get($code)){
                if($comptes->Delete()){
                    echo '{"status":200,"message":"deleted"}';
                }
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found"));
            }
        }

        public static function InsertAccount($data){
            $account = new GLAccounts();
            foreach ($data as $key => $value) {
                $account->Validate($key, $value);
            }
            $result = $account->Insert();
            echo json_encode($result);
        }

        public static function UpdateAccount($code, $data){
            $account = new GLAccounts();
            if($account->get($code)){
                foreach ($data as $key => $value) {
                    $account->Validate($key, $value);
                }
                $result = $account->Modify();
                echo json_encode($result);
            }else{
                echo json_encode(array("status" => 204, "message" => "No results found"));
            }
        }

    }