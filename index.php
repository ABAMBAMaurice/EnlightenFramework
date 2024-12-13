<?php
ini_set('display_errors', 1);

require_once('Base_Meta/API/App.php');
require_once ('Base_Meta/global.config.php');
require_once ('Base_configs/meta.configs.php');
require_once ('Base_app/app.main.php');

header('content-type:application/json');

/***
 *  Route pour index
 */
App::route('GET', '/', function(){
   /* $pu = new ItemList();
    $pu->rec->FindAll();
    echo($pu);*/
});

//region gestion des pages
App::route('GET', '/Page/{id}', function($id){
    echo PagesController::getPage($id);
});

App::route('POST', '/Page/onAction', function(){
    $data = json_decode(file_get_contents('php://input'), true);
    echo PagesController::OnAction($data);
});
//endregion

//region Objets

//region Pays
App::route('GET', '/countries', function(){
    echo CountryListController::getAllCountries();
});

App::route('GET', '/countries/{code}', function($code){
    echo CountryListController::getCountry($code);
});

App::route('POST', '/countries', function(){
    $data = json_decode(file_get_contents('php://input'), true);
    echo CountryListController::Insert($data);
});

App::route('DELETE', '/countries/{code}', function($code){
    echo CountryListController::Delete($code);
});
//endregion


//region fournisseur
App::route('GET','/vendors', function(){
    echo VendorController::getAllVendors();
});

App::route('POST', '/vendors', function(){
    $data = json_decode(file_get_contents('php://input'), true);
    echo VendorController::Insert($data);
});

App::route('GET','/vendors/{code}', function($code){
    echo VendorController::getVendor($code);
});
//endregion


//region Articles
App::route('GET','/items', function(){
    echo ItemsController::getAllItems();
});

App::route('GET','/items/{code}', function($code){
    echo ItemsController::getItem($code);
});
//endregion


//region Commandes ventes
App::route('GET','/PurchaseOrders/{code}', function($code){
    echo purchaseController::getOrder($code);
});

App::route('GET','/PurchaseOrders/LastLineNo/{code}', function($code){
    echo purchaseController::getLastLineNo('ORDER', $code);
});

App::route('GET','/PurchaseOrders', function(){
    echo purchaseController::getAllOrders();
});

App::route('POST','/PurchaseOrders', function(){
    $data = json_decode(file_get_contents('php://input'), true);
    echo purchaseController::Insert_purchaseHeader($data);
});

App::route('POST','/PurchaseOrders/Lines', function(){
    $data = json_decode(file_get_contents('php://input'), true);
    echo purchaseController::Insert_purchaseLine($data);
});
//endregion

//endregion




