<?php


class purchaseController{

    public static function Insert_purchaseHeader($data){
        $purchHeader = new purchaseHeader();
        foreach ($data as $key => $value) {
            $purchHeader->Validate($key, $value);
        }
        $result = $purchHeader->Insert();

        echo json_encode($result);
    }

    public static function Insert_purchaseLine($data){
        $purchLine = new purchaseLine();
        foreach ($data as $key => $value) {
            $purchLine->Validate($key, $value);
        }
        $purchLine->testField($purchLine->Document_No);
        $purchLine->testField($purchLine->Document_type);
        $result = $purchLine->Insert();

        echo json_encode($result);
    }


}
