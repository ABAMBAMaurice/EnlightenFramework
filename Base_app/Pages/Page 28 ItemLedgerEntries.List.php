<?php
    class ItemLedgerEntries extends Page{
        public function __construct() {
            parent::__construct(28,"itemLedgerEntries",PagesType::List, "Ecritures articles");
            $this->sourceTable = new ItemLedgerEntry();
            $this->setActions();
            $this->layout();
        }

        function setActions(){

        }
        function layout(){
            new PageField(name: "Entry_No",source: $this->rec->Entry_No,caption: "N° de séquence");
            new PageField(name: "Enty_date",source: $this->rec->Enty_date,caption: "Date écriture");
            new PageField(name: "Entry_Type",source: $this->rec->Entry_Type,caption: "Type écriture");
            new PageField(name: "document_type",source: $this->rec->document_type,caption: "Type de document");
            new PageField(name: "document_No",source: $this->rec->document_No,caption: "N° de document");
            new PageField(name: "Quantite",source: $this->rec->Quantite,caption: "Quantité");
            new PageField(name: "Code_magasin",source: $this->rec->Code_magasin,caption: "Code magasin");
            new PageField(name: "description_magasin",source: $this->rec->description_magasin, enabled:false, editable: false, caption: "Description magasin");
        }
    }    


?>