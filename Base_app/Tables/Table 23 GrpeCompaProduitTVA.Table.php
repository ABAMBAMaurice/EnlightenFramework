<?php
    class GrpeCompaProduitTVA extends Table{
        public function __construct() {
            parent::__construct(23, 'grpe_compa_produit_tva');

            $this->field(1,'Code', FieldType::text(30));
            $this->field(2,'Description', FieldType::text(100));


            $this->Keys('Code');
        }
    }
?>
