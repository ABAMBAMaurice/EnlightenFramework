<?php

class GenLedgerEntry extends Table
{
    public function __construct()
    {
        parent::__construct(25, 'genledgerentry');

        $this->field(1,'Entry_No', FieldType::integer(),caption:'N° séquence');
        $this->field(2,'document_type', FieldType::text(30),caption:'Type de document');
        $this->field(3,'No_doc', FieldType::text(30), caption: 'N° de document');
        $this->field(4,'gle_account', FieldType::text(30),tableRelation: new GLAccounts(), caption: 'N° de compte général');
        $this->field(5,'Description', FieldType::text(150), caption: 'Description');
        $this->field(6,'Montant_debit', FieldType::decimal(), caption: 'Montant débit');
        $this->field(6,'Montant_credit', FieldType::decimal(), caption: 'Montant crédit');

        $this->Keys('Entry_No');
    }
}

?>
