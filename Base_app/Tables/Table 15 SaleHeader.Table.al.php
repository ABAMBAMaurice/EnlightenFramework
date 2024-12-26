<?php
    class SaleHeader extends table {
        public function __construct()
        {
            parent::__construct(15, 'saleheader');
            $this->field(1,'No',FieldType::text(30));
            $this->field(2,'Document_type',FieldType::text(30), tableRelation: new SalesDocumentType());
            $this->field(3,'Order_Date',FieldType::date());
            $this->field(4,'Release_date',FieldType::date());
            $this->field(5,'discount',FieldType::decimal());
            $this->field(6,'VAT',FieldType::decimal());
            $this->field(7,'customer_No',FieldType::text(30),tableRelation: new Customer());
            $this->field(8,'customer_Name',FieldType::text(150), editable: false);
            $this->field(9,'Amount',FieldType::decimal(), editable: false);
            $this->field(10,'VAT_Amount',FieldType::decimal(), editable: false);
            $this->field(11,'FT_Amount',FieldType::decimal(), editable: false);

            $this->Keys('No', 'Document_type');
        }

        function onInsert()
        {
            $this->testField($this->No);
            $this->testField($this->Order_Date);
            $this->testField($this->customer_No);
            $this->testField($this->Document_type);
            $cust = new Customer();
            if($cust->get($this->customer_No->value)){
                if(!$cust->blocked->value) {
                    $fullName = $cust->first_name->value.' '.$cust->last_name->value;
                    $this->Validate('customer_Name', $fullName);
                }
                else
                    Error('Impossible de créer une vente avec ce client. Car Il est bloqué');
            }
        }
    }
?>