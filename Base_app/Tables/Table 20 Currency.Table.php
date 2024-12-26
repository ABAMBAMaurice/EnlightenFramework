<?php
    class Currency extends Table
    {
        public function __construct() {
            parent::__construct(20, 'currency');

            $this->field(1, 'Code', FieldType::text(10), caption: 'Code');
            $this->field(2, 'Description', FieldType::text(50), caption: 'Description');
            $this->field(3, 'Symbol', FieldType::text(10), caption: 'Symbole');
            $this->field(4, 'Rate', FieldType::decimal(), caption: 'Taux de change');
            $this->field(5, 'Code_Iso', FieldType::text(3), caption: 'Code Iso');

            $this->Keys('Code');
        }

    }
