<?php
    class GenLedgerEntries extends Page{
        public function __construct() {
            parent::__construct(26,'GenLedgerEntries', PagesType::List,'Ecritures comptables');
            $this->sourceTable = new GenLedgerEntry();
            $this->setActions();
            $this->layout();
        }

        function setActions(){

        }

        function layout(){
            new PageField('Entry_No',$this->rec->Entry_No,editable: false, enabled: false, visible:true,caption: 'N° de séquence');
            new PageField('document_type',$this->rec->document_type,editable: false, enabled: false, visible:true,caption: 'Type de document');
            new PageField('No_doc',$this->rec->No_doc,editable: false, enabled: false, visible:true,caption: 'N° de document');
            new PageField('gle_account',$this->rec->gle_account,editable: false, enabled: false, visible:true,caption: 'Compte générale');
            new PageField('Description',$this->rec->Description,editable: false, enabled: false, visible:true,caption: 'Description');
            new PageField('Montant_debit',$this->rec->Montant_debit,editable: false, enabled: false, visible:true,caption: 'Montant débit');
            new PageField('Montant_credit',$this->rec->Montant_credit,editable: false, enabled: false, visible:true,caption: 'Montant crédit');
        }
    }

