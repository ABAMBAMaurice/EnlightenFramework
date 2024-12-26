<?php

class GenAcctSetup extends Table
{
    public function __construct()
    {
        parent::__construct(24, 'genacct_setup');

        $this->field(1, 'Code', FieldType::text(30),caption:'Code');
        $this->field(2, 'posting_date_from', FieldType::date(),caption:'Date début période');
        $this->field(3, 'posting_date_to', FieldType::date(),caption:'Date fin période');
        $this->field(4, 'devise_societe', FieldType::text(10),tableRelation: new Currency(),caption:'Date fin période');

        $this->Keys('Code');
    }
}

?>