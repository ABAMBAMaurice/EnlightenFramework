<?php

    class GrpesComptaProduitsTVA extends Page {

        public function __construct() {
            parent::__construct(14,'GrpeComptaProduitsTVA', PagesType::List, 'Groupe compta. produits');
            $this->sourceTable = new GrpeCompaProduitTVA();
            $this->setActions();
            $this->layout();
        }

        function setActions()
        {

        }

        function layout()
        {
            $this->repeater('ListeGrpeComptaProduitsTVA', 'Groupes Compta. Produits',
                new PageField('Code',$this->rec->Code, caption: 'Code',enabled: true, editable: true),
                new PageField('Description',$this->rec->Description, caption: 'Description',enabled: true, editable: true)
            );
        }
    }

?>
