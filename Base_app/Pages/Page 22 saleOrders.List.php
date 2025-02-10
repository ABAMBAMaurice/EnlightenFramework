<?php
class saleOrders extends Page {
    public function __construct()
    {
        parent::__construct(22, 'Sale orders list', PagesType::List, 'Commandes ventes');
        $this->sourceTable = new SaleHeader();
        $this->setAction();
        $this->layout();
    }
    function setAction(){

    }
    function layout()
    {
        $this->repeater('SalesOrdersList','Liste des commandes ventes',
            new PageField(name:'No', source:$this->rec->No, caption: 'N°'),
            new PageField(name:'customer_No', source:$this->rec->customer_No, caption: 'N° client'),
            new PageField(name:'customer_Name', source:$this->rec->customer_Name, caption: 'Nom client'),
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

        $lignes = new SalesLine();
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
