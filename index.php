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

$currentMethod = $_SERVER['REQUEST_METHOD'];
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$currentPath = str_replace('/enlighten', '', $currentPath);
$pathRegex = "@^" . preg_replace('/([a-zA-Z0-9_]+)/', '([^/]+)', $currentPath ) . "$@";
$recRef = '';

if(preg_match($pathRegex, $currentPath, $matches)) {
    array_shift($matches);

    if(count($matches)>0)
        $recRef = $matches[0];

    $view = new Views;
    $view->setRange('className', $recRef);
    if($view->FindFirst()) {
        $page = new $recRef();
        if ('SELECT' === $currentMethod) {
            array_shift($matches);
            if (count($matches) <= 0) {
                if ($page->rec->FindAll())
                    echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($page)));
                else
                    echo json_encode(array("status" => 204, "message" => "No results found", "result" => json_decode($page)));
            } else {
                if ($page->rec->get(...$matches))
                    echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($page)));
                else
                    echo json_encode(array("status" => 204, "message" => "No results found", "result" => json_decode($page)));
            }
        }else if('INSERT' == $currentMethod){
            $data = json_decode(file_get_contents('php://input'), true);
            App::Insert($page->rec, $data);
        }else if('DELETE' == $currentMethod){
            array_shift($matches);
            if (count($matches) > 0) {
                if ($page->rec->get(...$matches)) {
                    if ($page->rec->Delete())
                        echo json_encode(array("status" => 200, "message" => "deleted"));
                }else
                    echo json_encode(array("status" => 204, "message" => "No results found"));
            }else{
                Error('Veuillez définir la (les) valeur(s) de la (des) clé(s) pour la table '.$page->rec->table_name.'.');
            }
        }else if('UPDATE' == $currentMethod){
            $data = json_decode(file_get_contents('php://input'), true);
            array_shift($matches);
            if (count($matches) > 0) {
                if ($page->rec->get(...$matches)) {
                    foreach ($data as $key => $value) {
                        $page->rec->Validate($key, $value);
                    }
                    $result = $page->rec->Modify();
                    echo json_encode($result);
                } else
                    echo json_encode(array("status" => 204, "message" => "No results found"));
            }else {
                Error('Veuillez définir la (les) valeur(s) de la (des) clé(s) pour la table ' . $page->rec->table_name . '.');
            }
        }
    }else{
        //add your own route here

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


        App::route('GET', '/Allcountries', function(){
            echo CountriesController::getAllCountries();
        });
    }
}