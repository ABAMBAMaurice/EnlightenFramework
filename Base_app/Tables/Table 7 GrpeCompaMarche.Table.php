<?php
    class GrpeCompaMarche extends Table{
        public function __construct() {
            parent::__construct(7, 'grpe_compa_marche');

            $this->field(1,'Code', FieldType::text(30));
            $this->field(2,'Description', FieldType::text(100));


            $this->Keys('Code');
        }
    }
?>
