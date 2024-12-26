<?php

    class GrpesComptaMarchesTVA extends Page {

        public function __construct() {
            parent::__construct(12,'GrpeComptaMarchesTVA', PagesType::List, 'Groupe compta. marché');
            $this->sourceTable = new GrpeCompaMarcheTVA();
            $this->setActions();
            $this->layout();
        }

        function setActions()
        {
        }

        function layout()
        {
            $this->repeater('ListeGrpeComptaMarchesTVA', 'Groupes Compta. Marchés',
                new PageField('Code',$this->rec->Code, caption: 'Code',enabled: true, editable: true),
                new PageField('Description',$this->rec->Description, caption: 'Description',enabled: true, editable: true)
            );
        }
    }

?>
