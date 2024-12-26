<?php

class App{

    public static Database $db;
    public static function route($method, $path, $callback){

        $currentMethod = $_SERVER['REQUEST_METHOD'];
        $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $currentPath = str_replace('/enlighten', '', $currentPath);
        // Convertir le chemin prévu (path) en expression régulière
        $pathRegex = "@^" . preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([^/]+)', $path ) . "$@";

        if(preg_match($pathRegex, $currentPath, $matches)) {
            if ($method === $currentMethod) {
                array_shift($matches);
                $callback(...$matches);
                exit;
            }
        }
    }

    public static function base(){
        return Database::base();
    }
}
