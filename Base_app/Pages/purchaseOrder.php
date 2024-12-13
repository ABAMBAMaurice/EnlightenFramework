<?php

class purchaseOrder extends Page{
    public function __construct()
    {
        parent::__construct('80', 'PurchaseOrder', PagesType::Document,'Commande achat');
        $this->sourceTable = new purchaseHeader();
        $this->setActions();
        $this->layout();
    }


    function setActions(){

        $this->actions(name: 'DelOrder', icon: 'minus', caption: 'Supprimer commande', onAction: function(){
            if(Confirm("Supprimer la commande ".$this->rec->No." ?")){
                if($this->rec->Delete()){
                    Page::open(82);
                }
            }

        }, style: 'danger');
    }

    function layout()
    {
        $this->group('General', 'Général',
            new PageField('No',$this->rec->No, editable: true, enabled: true, caption: 'N°'),
            new PageField('Document_type',$this->rec->Document_type, editable: false, enabled: false, caption: 'Type de document'),
            new PageField('Order_Date',$this->rec->Order_Date, editable: true, enabled: true, caption: 'Date de commande'),
            new PageField('Release_date',$this->rec->Release_date, editable: true, enabled: true, caption: 'Date d échéance'),
            new PageField('discount', source: $this->rec->discount, editable: true, enabled: true, caption: 'Remise %'),
            new PageField('VAT',$this->rec->VAT, editable: true, enabled: true, caption: 'TVA %'),
            new PageField('vendor_No',$this->rec->vendor_No, editable: true, enabled: true, caption: 'N° fournisseur'),
            new PageField('vendor_Name',$this->rec->vendor_Name, editable: false, enabled: true, caption: 'Nom client'),
        );

        $this->part('81', array("Document_type" => "Document_type", "No" => "Document_No"));
    }

    function setItemDesc(){
        if($this->subPageLink->Item_No != ''){
            $item = new Item();
            $item->setRange('No', $this->subPageLink->Item_No);
            if($item->FindFirst()){
                $this->subPageLink->Validate('Item_description', $item->description);
            }
        }
    }

    function setLineAmount(){
        if($this->subPageLink->Qty != ''){
            $this->subPageLink->Validate('Amount', $this->subPageLink->Qty->value*$this->subPageLink->Unit_price->value);
        }

        if($this->subPageLink->Unit_price != ''){
            $this->subPageLink->Validate('Amount', $this->subPageLink->Qty->value*$this->subPageLink->Unit_price->value);
        }
    }

    function setDiscount(){
        if($this->subPageLink->Discount != '')
            $this->subPageLink->Validate('Discount_amount',$this->getPercentDiscount($this->subPageLink->Discount->value, $this->subPageLink->Amount->value));

    }

    function getPercentDiscount($discountPercent, $lineAmount){
        if($discountPercent < 0)
            Error('Le taux de la remise ne doit pas être négatif');

        return $lineAmount * $discountPercent/100;
    }

    function addNewLine(){

        $achatLine = new PurchaseLine();

        $achatLine->Validate('Line_No', $this->getLineNo());
        $achatLine->Validate('Document_No', $this->rec->No);
        $achatLine->Validate('Document_type', 'COMMANDE');
        $achatLine->Insert();

    }

}
?>

