<?php
    class ItemLedgerEntry extends Table{
        public function __construct(){
            parent::__construct(28, 'itemledgerentry');
            
            
            $this->field(1,'Entry_No', FieldType::integer(),caption:'N° séquence');
            $this->field(2,'Enty_date', FieldType::date(),caption:'Date écriture');
            $this->field(3,'Entry_Type', FieldType::text(30), caption: 'Type écriture');
            $this->field(4,'document_type', FieldType::text(30),caption:'Type de document');
            $this->field(5,'document_No', FieldType::text(30), caption: 'N° de document');
            $this->field(6,'Quantite', FieldType::decimal(), caption: 'Quantité');
            $this->field(7,'Code_magasin', FieldType::text(30),tableRelation: new Magasin(), caption: 'Code magasin');
            $this->field(8,'description_magasin', FieldType::text(30), caption: 'Description magasin');

            $this->Keys('Entry_No');
        }

        public function onInsert() {
            $magasin = new Magasin();
            if($magasin->get($this->Code_magasin->value)){
                $this->Validate('description_magasin', $magasin->Description->value);
            }
        }
        
    }


?>