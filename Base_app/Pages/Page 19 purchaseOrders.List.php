<?php

class purchaseOrders extends Page {
    public function __construct()
    {
        parent::__construct(19, 'Purchase orders list', PagesType::List, 'Commandes achats');
        $this->sourceTable = new purchaseHeader();
        $this->setAction();
        $this->layout();
        $this->cardPageID = 17;
    }


    function setAction(){

    }

    function layout()
    {
        $this->repeater('OrdersList','Liste des commandes achats',
            new PageField(name:'No', source:$this->rec->No, caption: 'N°'),
            new PageField(name:'vendor_No', source:$this->rec->vendor_No, caption: 'N° fournisseur'),
            new PageField(name:'vendor_Name', source:$this->rec->vendor_Name, caption: 'Nom fournisseur'),
            new PageField(name:'Order_Date', source: $this->rec->Order_Date, caption: 'Date de commande'),
            new PageField(name: 'Release_date', source: $this->rec->Release_date, caption: 'Date de validation'),
            new PageField(name: 'Amount', source: $this->rec->Amount, caption: 'Montant total HT'),
            new PageField(name: 'VAT_Amount', source: $this->rec->VAT_Amount, caption: 'Montant TVA'),
            new PageField(name: 'FT_Amount', source: $this->rec->FT_Amount, caption: 'Montant TTC'),
        );
    }


    function OnAfterGetRecord(Table &$record)
    {
        $Amount = 0;
        $VAT_Amount = 0;
        $FT_Amount = 0;

        $lignes = new purchaseLine();
        $lignes->setRange('Document_type', $record->Document_type);
        $lignes->setRange('Document_No', $record->No);
        if($lignes->FindSet()){
            foreach ($lignes->recordSet as $ligne){
                 $Amount = $Amount + $ligne->Amount->value;
                 $VAT_Amount = $VAT_Amount + $ligne->VAT_amount->value;
            }
            $FT_Amount = ($Amount * (1-($record->discount->value/100))) + $VAT_Amount;
        }
        $record->Validate('Amount',$Amount);
        $record->Validate('VAT_Amount',$VAT_Amount);
        $record->Validate('FT_Amount',$FT_Amount);
        $record->Modify(true);
    }

}
