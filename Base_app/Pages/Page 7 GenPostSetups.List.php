<?php

    class GenPostSetups extends Page{
        public function __construct()
        {
            parent::__construct(7, 'General_Posting_setup', PagesType::List);
            $this->sourceTable = new GenPostSetup();
            $this->setActions();
            $this->layout();
        }

        function setActions()
        {
        }

        function layout()
        {
            $this->repeater('Currencies', 'Liste des devises',
                new PageField(name:'Grpe_compta_marche', source: $this->rec->Grpe_compta_marche, editable: true, caption: 'Groupe compta. marché'),
                new PageField(name:'Grpe_compa_produit', source: $this->rec->Grpe_compa_produit, editable: true, caption: 'Groupe compta. produit'),
                new PageField(name:'Compte_achat', source: $this->rec->Compte_achat, editable: true, caption: 'Compte achat'),
                new PageField(name:'Compte_remise_achat', source: $this->rec->Compte_remise_achat, editable: true, caption: 'Cpmpte remise achat'),
                new PageField(name:'Compte_acompte_achat', source: $this->rec->Compte_acompte_achat, editable: true, caption: 'Compte acompte achat'),
                new PageField(name:'Compte_vente', source: $this->rec->Compte_vente, editable: true, caption: 'Compte vente'),
                new PageField(name:'Compte_remise_vente', source: $this->rec->Compte_remise_vente, editable: true, caption: 'Compte remise vente'),
                new PageField(name:'Compte_acompte_vente', source: $this->rec->Compte_acompte_vente, editable: true, caption: 'Compte acompte vente'),
            );
        }
    }
