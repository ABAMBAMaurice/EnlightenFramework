<?php

use Cassandra\Value;

class purchaseLine extends table {
        public function __construct()
        {
            parent::__construct(14, 'purchaseline');

            $this->field(1,'Line_No',FieldType::Integer(), editable: false);

            $this->field(2,'Document_No',FieldType::text(30), tableRelation: new purchaseHeader(), editable: false);

            $this->field(3,'Document_type',FieldType::text(30), editable: false, tableRelation: new PurchaseDocumentType());

            $this->field(4,'Item_No',FieldType::text(30), tableRelation: new Item(), onValidate: function(){
                $item = new Item();
                if($item->get($this->Item_No->value)){
                    $this->Validate('Item_description', $item->description->value);
                    $this->Validate('Item_description2', $item->description2->value);
                }
            });

            $this->field(5,'Item_description',FieldType::text(150), editable: false);

            $this->field(6,'Item_description2',FieldType::text(150));

            $this->field(7,'Unit_price',FieldType::decimal(), onValidate: function() {
                $Amnt = $this->Qty->value * $this->Unit_price->value;
                $this->Validate('Amount',$Amnt);
            });

            $this->field(8,'Qty',FieldType::decimal(), onValidate: function() {
                $Amnt = $this->Qty->value * $this->Unit_price->value;
                $this->Validate('Amount',$Amnt);
            });

            $this->field(9,'Amount',FieldType::decimal(), editable: false);

            $this->field(10,'Discount',FieldType::decimal(), onValidate: function() {
                $discAmnt = $this->Amount->value * ($this->Discount->value/100);
                $this->Validate('Discount_amount',$discAmnt);
            });

            $this->field(11,'Discount_amount',FieldType::decimal(), editable: false);

            $this->field(12,'VAT',FieldType::decimal(), onValidate: function() {
                $VATAmnt = $this->Amount->value * ($this->VAT->value/100);
                $this->Validate('VAT_amount',$VATAmnt);
            });

            $this->field(13,'VAT_amount',FieldType::decimal(), editable: false);
            
            $this->field(14,'Code_magasin',FieldType::text(30),tableRelation: new Magasin(), caption: 'Code magasin');

            $this->Keys('Line_No', 'Document_No', 'Document_type');

        }

        function onInsert()
        {
            $lastNo = $this->getLastLineNo();
            $this->Validate('Line_No', $lastNo+10000);
            $this->Validate('VAT', $this->getVATFormHeader());
            $this->Validate('Discount', $this->getDiscFormHeader());
        }

        function getVATFormHeader(){
            $header = new purchaseHeader();
            if($header->get($this->Document_No->value, $this->Document_type->value)){
                if($this->VAT->value == 0 || $this->VAT->value == "")
                    return $header->VAT->value;
                else
                    return $this->VAT->value;
            }
        }
        function getDiscFormHeader(){
            $header = new purchaseHeader();
            if($header->get($this->Document_No->value, $this->Document_type->value)){
                if($this->Discount->value == 0 || $this->Discount->value == "")
                    return $header->discount->value;
                else
                    return $this->Discount->value;
            }
        }

        function getLastLineNo(){
            $line = new PurchaseLine();
            $line->setRange('Document_type', $this->Document_type);
            $line->setRange('Document_No', $this->Document_No);

            if($line->FindLast())
                return $line->Line_No->value;
            else
                return 0;
        }

    }



?>
