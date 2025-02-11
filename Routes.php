<?php
//add your own route here
    App::route('GET', '/purchases', function(){
        header('content-type: application/json');
        $puchases = new purchaseOrders();
        $puchases->rec->setFilter('Document_type', "=%1", 'ORDER');
        $puchases->rec->Find();
        echo $puchases;
    });
?>
