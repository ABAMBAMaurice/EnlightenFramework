<?php
class Cities extends Page{
    public function __construct(){
        parent::__construct(2,'CityListe', PagesType::List, 'Villes');
        $this->sourceTable = new City();
        $this->setActions();
        $this->layout();
    }
    function setActions(){
    }
    function layout(){
        $this->repeater('CityList','Liste des villes',
            new PageField(
                name: 'pays_code',
                source: $this->rec->pays_code,
                onLookUp: function(){},
                editable: true,
                enabled: true,
                visible: true,
                caption: 'Code pays'
            ),
            new PageField(
                name: 'Code',
                source: $this->rec->Code,
                editable: true,
                enabled: true,
                visible: true,
                caption: 'Code'
            ),
            new PageField(
                name: 'Name',
                source: $this->rec->Name,
                editable: true,
                enabled: true,
                visible: true,
                caption: 'Nom'
            ),
        );
    }
    public function onOpenPage()
    {
    }
}
?>
