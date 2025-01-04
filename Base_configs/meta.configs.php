<?php
//Inclusion des fichiers

$new_tables = null;
$declared_classes_before = get_declared_classes();

foreach (glob("Base_app/Tables/*.php") as $filename) {
    require_once $filename;
}

$declared_classes_after = get_declared_classes();
$new_tables = array_diff($declared_classes_after, $declared_classes_before);

if(isset($_GET['SystemUpdateSchema'])) {
    foreach ($new_tables as $object) {
        $base = Database::base();
        $t = new $object;
        if (!$base->table_exists($t->table_name)) {
            $e = $base->executeQuery($t->MySQL_CreateQuery());
            if($base->getError()[0]>0){
                echo Error($base->getError()[2].'. Error on table Table: '.$t->table_name);
            }
        } else {
            $e = $base->executeQuery($t->MySQL_UpdateSchema());
            if($base->getError()[0]>0){
                echo Error("Table: '".$t->table_name."' ".$base->getError()[2]);
            }
        }
    }
}


$new_pages = null;
$declared_classes_before = get_declared_classes();

foreach (glob("Base_app/Pages/*.php") as $filename) {
    require_once $filename;
}

$declared_classes_after = get_declared_classes();
$new_pages = array_diff($declared_classes_after, $declared_classes_before);


if(isset($_GET['SystemUpdateSchema'])) {
    foreach ($new_pages as $object) {
        $base = Database::base();
        $o = new $object;
        //var_dump($o->pageName);
        $view = new Views();
        $view->Validate('Id', $o->id);
        $view->Validate('className', $o::class);
        $view->Validate('caption', $o->pageName);
        $view->Validate('pageType', $o->type->name);
        if(isset($o->rec))
            $view->Validate('SourceTableID', $o->rec->table_id);
        $view->Validate('SourceTableName', $o->rec->table_name);
        $view->Insert(true);

    }
}

?>