<?php
require_once('Base_Meta/Database/Database.php');
require_once('Base_Meta/_metaObjects/Tables/Field/FieldType.enum.php');
require_once('Base_Meta/_metaObjects/Tables/Table.class.php');
require_once('Base_Meta/_metaObjects/Pages/Pagetype.enum.php');
require_once('Base_Meta/_metaObjects/Controls/Control.class.php');
require_once('Base_Meta/_metaObjects/Pages/Page.class.php');
require_once('Base_Meta/_metaObjects/Controls/SubRepeater.class.php');
$currentObject = null;



if(isset($_POST['page'])) {
    $page = $_POST['page'];
}else
    $page ='';

function Error($message){
    die(json_encode(array("status"=>500, "Message"=>$message)));
}
function Message($message){
    return $message;
}

function IsNullOrEmptyString(string|null $str){
    return $str === null || trim($str) === '';
}

function OneIsNullOrEmptyString(string|null ...$str){
    $isNull = false;
    foreach ($str as $value) {
        if($value === null || trim($value) === ''){
            $isNull = true;
        }
    }
    return $isNull;
}


function Confirm($message){
    echo "<div class='alert alert-success'>".$message."</div>";
}

?>