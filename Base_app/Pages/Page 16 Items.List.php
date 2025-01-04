<?php


    class Items extends Page
    {
        public function __construct()
        {
            parent::__construct(16, 'Item list', PagesType::List, 'Liste articles');
            $this->sourceTable = new Item();
            $this->setAction();
            $this->layout();
            $this->cardPageID = 15;
        }


        function setAction(){

            $this->actions(
                name:'NewItems',
                icon:'account-plus',
                caption:'Nouveau',
                onAction: function(){
                    Page::open(40);
                    $this->rec = new Item();
                },
                style: 'primary'
            );
        }


        function layout()
        {
            $this->repeater('ListeItems', 'Liste articles',
                new PageField('No', $this->rec->No, caption: 'N°'),
                new PageField('Description', $this->rec->description, caption:'Description'),
                new PageField('Type', $this->rec->Type, caption:'Type'),
                new PageField(name: 'desc_categ', source: $this->rec->desc_categ, caption: 'Description catégorie'),
                new PageField(name: 'desc_unite', source: $this->rec->desc_unite, caption: 'Description unite'),
                new PageField('Stock', $this->rec->Stock, caption: 'Stock'),
            );
        }

    }


?>
