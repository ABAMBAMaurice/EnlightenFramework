<?php

class saleOrder extends Page{
    public function __construct()
    {
        parent::__construct('20', 'SaleOrder', PagesType::Document,'Commande vente');
        $this->sourceTable = new SaleHeader();
        $this->setActions();
        $this->layout();
    }


    function setActions(){

        $this->actions(name: 'DelOrder', icon: 'minus', caption: 'Supprimer commande', onAction: function(){
            if(Confirm("Supprimer la commande ".$this->rec->No." ?")){
                if($this->rec->Delete()){
                    Page::open(21);
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
            new PageField('customer_No',$this->rec->customer_No, editable: true, enabled: true, caption: 'N° fournisseur'),
            new PageField('customer_Name',$this->rec->customer_Name, editable: false, enabled: true, caption: 'Nom client'),
        );

        $this->part('91', array("Document_type" => "Document_type", "No" => "Document_No"));
    }

}
?>

