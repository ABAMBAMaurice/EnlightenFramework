<?php
    class currencyController{
        public static function getAllCurrencies(){
            $currency = new Currencies();
            if($currency->rec->FindAll()){
                echo '{"status":200,"message":"success","result":'.$currency.'}';
            }else{
                echo '{"status":204,"message":"No results found","result":'.$currency.'}';
            }
        }

        public static function getCurrency($code){
            $currency = new Currencies();
            if($currency->rec->get($code))
                echo '{"status":200,"message":"success","result":'.$currency.'}';
            else
                echo '{"status":204,"message":"No results found","result":'.$currency.'}';
        }

        public static function InsertCurrency($data){
            $currency = new Currency();
            foreach ($data as $key => $value) {
                $currency->Validate($key, $value);
            }
            $result = $currency->Insert();
            echo json_encode($result);
        }

        public static function delete($code){
            $currency = new Currency();
            if($currency->rec->get($code)){
                if($currency->Delete())
                    echo '{"status":200,"message":"deleted"}';
            }
        }
    }