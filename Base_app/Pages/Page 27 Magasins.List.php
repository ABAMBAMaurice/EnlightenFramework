<?php
    class Magasins extends Page{
        public function __construct() {
            parent::__construct(27,'MagasinsList', PagesType::List,'Magasins');
            $this->sourceTable = new Magasin();
            $this->setActions();
            $this->layout();
        }

        function setActions(){

        }

        function layout(){
            new PageField('Code',$this->rec->Code, editable: false, enabled: false, visible:true,caption: 'Code');   
            new PageField('Description',$this->rec->Description, editable: false, enabled: false, visible:true,caption: 'Description');   
            new PageField('Adresse',$this->rec->Adresse, editable: false, enabled: false, visible:true,caption: 'Adresse');   
            new PageField('Code_postal',$this->rec->Code_postal, editable: false, enabled: false, visible:true,caption: 'Code postal');   
            new PageField('Ville',$this->rec->Ville, editable: false, enabled: false, visible:true,caption: 'Ville');   
            new PageField('Bloque',$this->rec->Bloque, editable: false, enabled: false, visible:true,caption: 'Bloqué');   
        }
    }
?>

