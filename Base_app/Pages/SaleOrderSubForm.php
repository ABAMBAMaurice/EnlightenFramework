<?php

class SaleOrderSubForm  extends Page{
    public function __construct(){
        parent::__construct(91, 'SalesOrderSubForm', PagesType::ListPart, 'Lignes vente');
        $this->sourceTable = new SalesLine();
        $this->setActions();
        $this->layout();
    }
    function setActions(){
        $this->actions(name: 'DelLine', icon: 'minus', caption: 'Supprimer la ligne', onAction: function(){
            $line = new SalesLine();
            $line->setRange('Line_No',$this->rec->Line_No);
            $line->setRange('Document_No',$this->rec->Document_No);
            $line->setRange('Document_type',$this->rec->Document_type);
            if($line->FindFirst()) {
                    $this->deleteLine();
            }
        }, style: 'danger');
    }

    function layout(){
        $this->repeater('Lines', 'Lignes',
            new PageField('Line_No',$this->rec->Line_No, editable: true, enabled: true,caption: 'N째 ligne'),
            new PageField('Document_No',$this->rec->Document_No, editable: true, enabled: true,caption: 'N째 document'),
            new PageField('Document_type',$this->rec->Document_type, editable: true, enabled: true, caption:'Type document'),
            new PageField('Item_No',$this->rec->Item_No, editable: true, enabled: true, caption: 'N째 article'),
            new PageField('Item_description',$this->rec->Item_description, editable: true, enabled: true),
            new PageField('Item_description2',$this->rec->Item_description2, editable: true, enabled: true),
            new PageField('Unit_price',$this->rec->Unit_price, editable: true, enabled: true),
            new PageField('Qty',$this->rec->Qty, editable: true, enabled: true),
            new PageField('Amount',$this->rec->Amount, editable: true, enabled: true),
            new PageField('Discount',$this->rec->Discount, editable: true, enabled: true),
            new PageField('Discount_amount',$this->rec->Discount_amount, editable: true, enabled: true),
            new PageField('VAT',$this->rec->VAT, editable: true, enabled: true),
            new PageField('VAT_amount',$this->rec->VAT_amount, editable: true, enabled: true)
        );
    }

}


?>
