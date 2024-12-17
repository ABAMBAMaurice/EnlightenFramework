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
        echo(json_encode(array("status"=>200, "Message" => "Welcome to enlighten")));
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
        echo CountriesController::getAllCountries();
    });

    App::route('GET', '/countries/{code}', function($code){
        echo CountriesController::getCountry($code);
    });

    App::route('POST', '/countries', function(){
        $data = json_decode(file_get_contents('php://input'), true);
        echo CountriesController::Insert($data);
    });

    App::route('DELETE', '/countries/{code}', function($code){
        echo CountriesController::Delete($code);
    });
//endregion


//region fournisseur
    App::route('GET','/vendors', function(){
        echo VendorController::getAllVendors();
    });

    App::route('GET','/vendors/{code}', function($code){
        echo VendorController::getVendor($code);
    });

    App::route('POST', '/vendors', function(){
        $data = json_decode(file_get_contents('php://input'), true);
        echo VendorController::Insert($data);
    });

    App::route('DELETE','/vendors/{code}', function($code){
        echo VendorController::Delete($code);
    });
//endregion


//region Articles
    App::route('GET','/items', function(){
        echo ItemsController::getAllItems();
    });
    App::route('GET','/items/counts', function(){
        echo (new Item())->Count();
    });

    App::route('GET','/items/{code}', function($code){
        echo ItemsController::getItem($code);
    });

    App::route('POST','/items', function(){
        $data = json_decode(file_get_contents('php://input'), true);
        echo ItemsController::Insert($data);
    });

    App::route('DELETE','/items', function($code){
        echo ItemsController::Delete($code);
    });

//endregion


//region Commandes ventes
    App::route('GET','/PurchaseOrders', function(){
        echo purchaseController::getAllOrders();
    });

    App::route('GET','/PurchaseOrders/{code}', function($code){
        echo purchaseController::getOrder($code);
    });

    /*App::route('GET','/PurchaseOrders/LastLineNo/{code}', function($code){
        echo purchaseController::getLastLineNo('ORDER', $code);
    });*/

    App::route('POST','/PurchaseOrders', function(){
        $data = json_decode(file_get_contents('php://input'), true);
        echo purchaseController::Insert_purchaseHeader($data);
    });

    App::route('POST','/PurchaseOrders/Lines', function(){
        $data = json_decode(file_get_contents('php://input'), true);
        echo purchaseController::Insert_purchaseLine($data);
    });
//endregion

//region Clients

    App::route('GET','/Customers', function(){
        echo CustomersController::getAllCustomers();
    });

    App::route('GET','/Customers/{code}', function($code){
        echo CustomersController::getCustomer($code);
    });

    App::route('POST','/Customers', function(){
        $data = json_decode(file_get_contents('php://input'), true);
        echo CustomersController::Insert($data);
    });

//endregion




