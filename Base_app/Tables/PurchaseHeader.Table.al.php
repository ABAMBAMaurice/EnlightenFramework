<?php

    class purchaseHeader extends table {

        public function __construct()
        {
            parent::__construct('80', 'purchaseheader');

            $this->field(1,'No',FieldType::text(30));
            $this->field(2,'Document_type',FieldType::text(30), tableRelation: new PurchaseDocumentType());
            $this->field(3,'Order_Date',FieldType::date());
            $this->field(4,'Release_date',FieldType::date());
            $this->field(5,'discount',FieldType::decimal());
            $this->field(6,'VAT',FieldType::decimal());
            $this->field(7,'vendor_No',FieldType::text(30),tableRelation: new Vendor());
            $this->field(8,'vendor_Name',FieldType::text(150), editable: false);
            $this->field(9,'Amount',FieldType::decimal(), editable: false);
            $this->field(10,'VAT_Amount',FieldType::decimal(), editable: false);
            $this->field(11,'FT_Amount',FieldType::decimal(), editable: false);

            $this->Keys('No', 'Document_type');
        }


        function onInsert()
        {
            $this->testField($this->No);
            $this->testField($this->Order_Date);
            $this->testField($this->vendor_No);
            $this->testField($this->Document_type);
            $vend = new Vendor();
            if($vend->get($this->vendor_No->value)){
                if(!$vend->blocked->value)
                    $this->Validate('vendor_Name',$vend->vendor_Name->value);
                else
                    Error('Impossible de créer une commande avec ce fournisseur. Car Il est bloqué');
            }
        }
    }



?>
