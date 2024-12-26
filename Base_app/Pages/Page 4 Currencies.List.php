<?php

    class Currencies extends Page{
        public function __construct()
        {
            parent::__construct(4, 'Currencies', PagesType::List);
            $this->sourceTable = new Currency();
            $this->setActions();
            $this->layout();
        }

        function setActions()
        {
        }

        function layout()
        {
            $this->repeater('Currencies', 'Liste des devises',
                new PageField(name:'Code', source: $this->rec->Code, editable: true, caption: 'Code'),
                    new PageField(name:'Description', source: $this->rec->Description, editable: true, caption: 'Description'),
                    new PageField(name:'Symbol', source: $this->rec->Symbol, editable: true, caption: 'Symbol'),
                    new PageField(name:'Rate', source: $this->rec->Rate, editable: true, caption: 'Taux de change'),
                    new PageField(name:'Code_Iso', source: $this->rec->Code_Iso, editable: true, caption: 'Code_Iso')
            );
        }
    }
