<?php

class App{

    public static Database $db;
    public static function route($method, $path, $callback){

        $currentMethod = $_SERVER['REQUEST_METHOD'];
        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $currentPath = str_replace('/Enlighten', '', $currentPath);

        // Convertir le chemin prévu (pathPattern) en expression régulière
        $pathRegex = "@^" . preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $path ) . "$@";

        if ($method === $currentMethod) {
            if(preg_match($pathRegex, $currentPath, $matches)) {
                array_shift($matches);
                $callback(...$matches);
                exit;
            }
        }
    }

    public static function config_db($hostame, $port, $username, $password, $dbname){
        App::$db = new Database($hostame, $port, $username, $password, $dbname);
        return App::$db;
    }
    public static function base(){
        return Database::base();
    }



}
