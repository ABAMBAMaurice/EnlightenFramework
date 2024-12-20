<?php


class saleController{

    public static function Insert_saleHeader($data){
        $saleHeader = new SaleHeader();
        foreach ($data as $key => $value) {
            $saleHeader->Validate($key, $value);
        }
        $result = $saleHeader->Insert();

        echo json_encode($result);
    }

    public static function Insert_saleLine($data){
        $saleLine = new SalesLine();
        foreach ($data as $key => $value) {
            $saleLine->Validate($key, $value);
        }
        $saleLine->testField($saleLine->Document_No);
        $saleLine->testField($saleLine->Document_type);
        $result = $saleLine->Insert();

        echo json_encode($result);
    }


}
