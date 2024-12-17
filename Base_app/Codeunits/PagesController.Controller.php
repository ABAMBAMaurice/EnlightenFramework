<?php
    class PagesController{
        public static Views $page;
        public static function getPage($id){
            PagesController::$page = new Views();

            if(PagesController::$page->get($id)){
                $currpage = new PagesController::$page->className->value;
                $currpage->rec->FindAll();
                $currpage->onOpenPage();
                echo($currpage);
            }else{
                echo json_encode(array("status" => 404, "message" => "Page not found"));
            }

        }


        public static function OnAction($params)
        {
            if (isset($params['id']) && isset($params['action']) && isset($params['record'])) {
                $pageID = $params['id'];
                $action = $params['action'];
                $record = $params['record'];

                PagesController::$page = new Views();
                if (PagesController::$page->get($pageID)) {
                    $currPage = new PagesController::$page->className->value;

                    foreach ($record as $key => $value) {
                        $currPage->rec->Validate($key, $value);
                    }

                    if (isset($currPage->actions[$action['name']])) {
                        $currPage->actions[$action['name']]->onAction();
                        echo json_encode(array("status" => 200, "message" => "success", "result" => json_decode($currPage)));
                    } else
                        echo json_encode(array("status" => 404, "message" => "Action" . $action['name'] . " not found"));
                } else
                    echo json_encode(array("status" => 404, "message" => "Page not found"));
            }else
                echo json_encode(array("status" => 400, "message" => "Bad request"));
        }

    }