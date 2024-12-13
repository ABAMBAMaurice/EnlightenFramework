
<?php

    require('Pages.interface.php');
    require('PageField.class.php');
    require('action.class.php');
    require('groups.class.php');
    require('repeater.class.php');

    class Page implements Pages {
        private int $_id;
        private int $_cardPageID;
        private string $_name;
        private string $_caption;
        private PagesType $_type;
        private Table $_rec;
        public static $_pageCollection = array();
        private $_fieldsList = array();
        private $_actionsList = array();
        private $_groups = array();
        private $subPage = '{}';
        private $subPageLinks = array();


        public function __construct($id, $name, $type, $caption = ''){
            $this->_id = $id;
            $this->_name = $name;
            $this->_type = $type;
            $this->_caption = $caption;

            Page::$_pageCollection[$id] = $this;

            $_SESSION['pageCollection'] = Page::$_pageCollection;

        }

        /**
         * @param $name
         * Nom du groupe. Unique, identitifie un groupe de la page
         * @param $caption
         * Libellé d'affichaqe de la page. Facultatif.
         * @param ...$fields
         * La liste des champs contenus dans le groupe créé
         * @return void
         *
         *
         * Cette methode permet de créer des groupes dans une page.
         * Il s'agit d'une methode obligatoire facilitant l'organisation des champs
         * de la page et de faciliter la maintenance de votre application
         */

        public function group($name, $caption='', ...$fields){
            if(isset($this->_groups[$name]))
                Error('Groupe '.$name.' existe déja');
            $nGroup = new group($name, $caption);
            $nGroup->SourceTableId = $this->rec->table_id;
            $nGroup->SourceTableName = $this->rec->table_name;
            $nGroup->SourcePageName = $this->pageName;
            $nGroup->SourcePageId = $this->id;

            foreach ($fields as $field){
                $nGroup->fields($field->_name, $field);
            }
            $this->_groups[$name] = $nGroup;
        }

        /**
         * @param $name
         * @param $caption
         * @param ...$fields
         * @return void
         *
         * Cette methode permet de créer des listes dans une page.
         * En réalité, cette methode vous permet de savoir qu'il s'agit d'une liste et peut être remplacée par
         * la methode groupe
         * * Il s'agit d'une methode obligatoire facilitant l'organisation des champs
         * * de la page et de faciliter la maintenance de votre application
         */
        public function repeater($name, $caption, ...$fields){
            if(isset($this->_groups[$name]))
                Error('Groupe '.$name.' existe déja');
            $nGroup = new repeater($name, $caption);
            $nGroup->SourceTableId = $this->rec->table_id;
            $nGroup->SourceTableName = $this->rec->table_name;
            $nGroup->SourcePageName = $this->pageName;
            $nGroup->SourcePageId = $this->id;

            foreach ($fields as $field){
                $nGroup->fields($field->_name, $field);
            }
            $this->_groups[$name] = $nGroup;
        }

        /**
         * This function is marked for update
         */
        public function part($PageID, $subPageFieldLink){
            $pge = new Views();

            if($pge->get($PageID)){
                $currPage = new $pge->className->value;
                $this->subPage = $currPage;
                $this->subPageLinks = $subPageFieldLink;
            }
        }

        /**
         * @param $name
         * @param $icon
         * @param $caption
         * @param $onAction
         * @param $html
         * @param $style
         * @return void
         *
         *
         * Cette methode permet de définir les différentes actions possibles sur cette page.
         * Actions, réalisable généralement à partir de boutons.
         */
        public function actions($name, $icon=null, $caption=null, $onAction = null, $html='', $style='inverse-dark'){
            if($onAction == null){
                $FctAction = function(){};
            }else{
                $FctAction = $onAction;
            }
            $this->_actionsList[$name] = new Control($name, $icon, $caption, $FctAction, $html, $style);
        }

        /**
         * @param $name
         * @param $source
         * @param $onValidate
         * @param $onLookUp
         * @param $editable
         * @param $enabled
         * @param $visible
         * @param $caption
         * @param $html
         * @return void
         *
         * Cette methode permet d'ajouter des champs dans la page en vrac.
         * Elle peut être utilisée si vous ne souhaitez pas structurer votre page avec des groupes
         * ou des repeaters
         */

        public function field($name, $source, $onValidate = null, $onLookUp = null, $editable = true, $enabled = true, $visible = true, $caption = null, $html=''){
            $pgeField =  new PageField(
                name: $name,
                source: $source,
                onValidate: $onValidate,
                onLookUp: $onLookUp,
                editable: $editable,
                enabled: $enabled,
                visible: $visible,
                caption: $caption,
                html: $html
            );
            $this->_fieldsList[$name] = $pgeField;
        }


        public function __set($name, $value){
            switch ($name) {
                case 'sourceTable':
                case 'rec':
                    $this->_rec = $value;
                    break;
                case 'html':
                    $this->_bodyHTML = $value;
                    break;
                case 'editionMode':
                    $this->_editionMode = $value;
                    break;
                case 'cardPageID':
                    $this->_cardPageID = $value;
                    break;
                case 'subPageLink':
                    $this->_subPageLink = $value;
                    break;
                case 'subPageFieldLink':
                    $this->_subPageFieldLink = $value;
                    break;
                case 'pageFieldLink':
                    $this->_pageFieldLink = $value;
                    break;
            }
        }

        public function __get($name){
            switch ($name) {
                case 'rec':
                    return $this->_rec;
                    break;
                case 'pageName':
                    return $this->_name;
                    break;
                case 'type':
                    return $this->_type;
                    break;
                case 'actions':
                    return $this->_actionsList;
                    break;
                case 'id':
                    return $this->_id;
                    break;
                case 'editionMode':
                    return $this->_editionMode;
                    break;
                case 'groups':
                    return $this->_groups;
                    break;
                case 'cardPageID':
                    return $this->_cardPageID;
                    break;
                case 'subPageLink':
                    return $this->_subPageLink;
                    break;
                case 'subPageFieldLink':
                    return $this->_subPageFieldLink;
                    break;
                case 'pageFieldLink':
                    return $this->_pageFieldLink;
                    break;

                default:
                    if(isset($this->_fieldsList[$name])){
                        return $this->_fieldsList[$name];
                    }
                    break;
            }
        }

        /**
         * @return void
         *
         * Cette méthode permet d'exécuter des instrcutions à l'ouverture de la page
         */
        public function onOpenPage(){}


        /**
         * @param $Pageid
         * @return mixed
         *
         * Cette methode static, permet d'ouvrir la page avec l'id $Pageid
         */
        public static function open($Pageid)
        {
            header("location:/Page/".$Pageid);
        }

        /**
         * @param Page $page
         * @param $record
         * @return void
         *
         * Cette methode permet d'ouvrir la page $page avec le record $record
         */
        public static function Record_open(Page $page, $record)
        {
            $page->rec = $record;
            $page->open();
        }


        /**
         * @return void
         *
         * Cette methode permet d'exécuter des instrcution lors de la fermetture de la page
         */
        public function OnClosePage(){}


        /**
         * @return string
         *
         *
         *
         * Cette methode sérialise la page et l'affiche sous forme de cgaîne de caractère
         */
        public function __toString()
        {
            $this->onOpenPage();
            if($this->subPage != '{}') {
                if(count($this->subPageLinks) > 0) {
                    foreach ($this->subPageLinks as $key => $field) {
                        $this->subPage->setRange($field, $this->rec->{$key});
                    }
                    $this->subPage->rec->FindSet();
                }
            }


            $r = '{';
                $r .='"id":"'.$this->_id.'",';
                $r .='"name":"'.$this->_name.'",';
                $r .='"PageType":"'.$this->_type->name.'",';
                $r .='"sourceTableID":"'.$this->_rec->table_id.'",';
                $r .='"sourceTableName":"'.$this->_rec->table_name.'",';
                $r .= '"actions":[ ';
                    foreach ($this->_actionsList as $action){
                        $r .= '{';
                            $r .='"name":"'.$action->name.'",';
                            $r .='"caption":"'.$action->caption.'"';
                        $r .='},';
                        //$r = substr($r, 0, strlen($r) - 1);
                    }
                        $r = substr($r, 0, strlen($r) - 1);
                $r .='],';
                $r .= '"record":'.$this->show();
                if($this->subPage != '{}')
                    $r .= ',"subPage":'.$this->subPage;

            $r .='}';
            return $r;
        }


        /**
         * @return void
         *
         * Cette fonction permet de structurer les différents groupes et repeater de la page. Implémentée dans votre page, elle est appelée
         * dans le constructeur de cette dernière
         */
        function layout(){}


        /**
         * @return void
         *
         *
         * Idem que la fonction "layout", cette fonction permet de structurer
         * les actions à définnir sur la page
         */
        function setActions(){}


        /**
         * @return void
         *
         * Permet de créer un nouveau record vide dans la base de donnée
         */
        public function newRecord(){
            $this->_rec->Insert(false);
        }

        /**
         * @param $field: Nom du champs. Attention sensible à la case
         * @param $value: Valeur du champs. Doit avoir le même type que le champ déclaré dans la table!
         * @return true|void
         *
         *Permet d'attribuer une valeur à un champs de la Page lié au record
         *
         */
        public function Validate($field, $value)
        {
            if($this->rec->Validate($field, $value)){
                return true;
            }else{
                Error('Erreur lors de la validation des données.');
            }
        }
        function SetRange($field, $value){
            $this->rec->SetRange($field, $value);
        }
        function Modify($trigger = true){
          $this->rec->Modify($trigger);
        }
        function Insert($trigger = true){
          $this->rec->Insert($trigger);
        }
        function Delete($trigger = true){
          $this->rec->Delete($trigger);
        }

        public function OnAfterGetRecord(Table &$record){}

        public function show(){
            if($this->_type == PagesType::List || $this->_type == PagesType::ListPart) {
                $r = '[';

                if(count($this->rec->recordSet)>0) {
                    foreach ($this->rec->recordSet as $record) {
                        $this->OnAfterGetRecord($record);
                        $r .= '{';
                        if (count($record->_fields)>0) {
                            foreach ($record->_fields as $field) {
                                $r .= '"' . $field->_name . '":"' . $field->_value . '",';
                            }
                            $r = substr($r, 0, strlen($r) - 1);
                        }
                        $r .= '},';
                    }
                    $r = substr($r, 0, strlen($r) - 1);
                }
                $r .= ']';
                return $r;
            }else if($this->_type == PagesType::Card || $this->_type == PagesType::Document){
                $this->OnAfterGetRecord($this->rec);
                    $r = '{';
                            foreach ($this->rec->_fields as $field) {
                                $r .= '"' . $field->_name . '":"' . $field->_value . '",';
                            }
                            $r = substr($r, 0, strlen($r) - 1);

                    $r .= '}';
                    $r .= '';
                return $r;
            }
        }

    }
?>
