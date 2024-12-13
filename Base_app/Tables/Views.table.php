<?php

class Views extends Table {
    public function __construct()
    {
        parent::__construct('9999999', 'views');

        $this->field(1, 'Id', FieldType::text(30),caption:'N°');
        $this->field(2, 'className', FieldType::text(150, 'NOT NULL UNIQUE'),caption:'Nom classe');
        $this->field(3, 'caption', FieldType::text(150),caption:'caption');
        $this->field(4, 'pageType', FieldType::text(50), caption: 'Type de page');
        $this->field(6, 'SourceTableID', FieldType::text(30), caption: 'Id table');
        $this->field(7, 'SourceTableName', FieldType::text(150), caption: 'Nom table');

        $this->Keys('Id');
    }
}