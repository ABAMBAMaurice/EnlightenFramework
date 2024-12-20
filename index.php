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

    //region Achat
        App::route('POST','/purchase', function(){
            $data = json_decode(file_get_contents('php://input'), true);
            echo purchaseController::Insert_purchaseHeader($data);
        });

        App::route('POST','/purchase/lines', function(){
            $data = json_decode(file_get_contents('php://input'), true);
            echo purchaseController::Insert_purchaseLine($data);
        });

            //region Commandes achat
            App::route('GET','/purchaseOrders', function(){
                echo purchaseOrdersController::getAllOrders();
            });

            App::route('GET','/purchaseOrders/{code}', function($code){
                echo purchaseOrdersController::getOrder($code);
            });
            //endregion

            //region Factures achat
            App::route('GET','/purchaseInvoices', function(){
                echo purchaseInvoiceController::getAllInvoices();
            });

            App::route('GET','/purchaseInvoices/{code}', function($code){
                echo purchaseInvoiceController::getInvoice($code);
            });
        //endregion

    //endregion

    //region Ventes
        App::route('POST','/sales', function(){
            $data = json_decode(file_get_contents('php://input'), true);
            echo saleController::Insert_saleHeader($data);
        });
        App::route('POST','/sales/lines', function(){
            $data = json_decode(file_get_contents('php://input'), true);
            echo saleController::Insert_saleLine($data);
        });

        //region Commande vente
            App::route('GET', '/salesOrders', function(){
                echo saleOrdersController::getAllOrders();
            });

            App::route('GET','/salesOrders/{code}', function($code){
                echo saleOrdersController::getOrder($code);
            });

        //endregion


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

    //region Comptabilité

        //region planComptables

        //endregion


        //region Groupe compta
            //region client
                App::route('GET','/accounting/customers/groups', function(){
                    echo PostingGroupsController::getCustomerPostingGroups();
                });
                App::route('GET','/accounting/customers/groups/{code}', function($code){
                    echo PostingGroupsController::getCustomerPostingGroup($code);
                });

                App::route('POST','/accounting/customers/groups', function(){
                    $data = json_decode(file_get_contents('php://input'), true);
                    echo PostingGroupsController::InsertCustomerPostingGroup($data);
                });

                App::route('DELETE','/accounting/customers/groups/{code}', function($code){
                    echo PostingGroupsController::deleteCustomerPostingGroup($code);
                });
            //endregion

            //region fournisseurs
                App::route('GET','/accounting/vendors/groups', function(){
                    echo PostingGroupsController::getVendorPostingGroups();
                });
                App::route('GET','/accounting/vendors/groups/{code}', function($code){
                    echo PostingGroupsController::getVendorPostingGroup($code);
                });

                App::route('POST','/accounting/vendors/groups', function(){
                    $data = json_decode(file_get_contents('php://input'), true);
                    echo PostingGroupsController::InsertVendorPostingGroup($data);
                });

                App::route('DELETE','/accounting/vendors/groups/{code}', function($code){
                    echo PostingGroupsController::deleteVendorPostingGroup($code);
                });
            //endregion



        //endregion

        //region paramètres compta
        //endregion

        //region ecritures compta
        //endregion

    //endregion

//endregion




