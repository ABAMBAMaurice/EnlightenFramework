<?php


    foreach (glob("Base_app/Codeunits/*/*.php") as $filename) {
        require_once $filename;
    }


?>

