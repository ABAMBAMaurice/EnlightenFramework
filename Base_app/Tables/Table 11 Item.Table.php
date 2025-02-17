<?php
    class Item extends Table {
        public function __construct()
        {
            parent::__construct(11, 'items');

            $this->field(1, 'No', FieldType::text(30),caption:'N°');
            $this->field(2, 'description', FieldType::text(150),caption:'Description');
            $this->field(3, 'description2', FieldType::text(150),caption:'Description 2');
            $this->field(4, 'unite', FieldType::text(30), tableRelation: new unite(), caption: 'Unité de stockage');
            $this->field(6, 'desc_unite', FieldType::text(50), caption: 'Description Unité de stockage');
            $this->field(7, 'category', FieldType::text(30), tableRelation: new category(), caption: 'Catégorie');
            $this->field(8, 'desc_categ', FieldType::text(50), caption: 'Description Catégorie');
            $this->field(9, 'GrpeComptaProduit', FieldType::text(30), tableRelation: new grpecompaproduit(), caption: 'Groupe compta. produits');
            $this->field(10, 'Images', FieldType::text(250), caption: 'Image');
            $this->field(11, 'Stock', FieldType::decimal(), caption: 'Stock');
            $this->field(12, 'Type', FieldType::text(30), caption: 'Type');

            $this->Keys('No');
        }
    }

?>
