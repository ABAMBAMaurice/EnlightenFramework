<?php
class Magasin extends Table {
    public function __construct()
    {
        parent::__construct(27, 'magasin');

        $this->field(1, 'Code', FieldType::text(30),caption:'N°');
        $this->field(2, 'Description', FieldType::text(50),caption: 'Description');
        $this->field(3, 'Adresse', FieldType::text(50),caption: 'Adresse');
        $this->field(4, 'Code_postal', FieldType::text(50),caption: 'Code postal');
        $this->field(5, 'Ville', FieldType::text(50),tableRelation: new City(),caption: 'Ville');
        $this->field(6, 'Bloque', FieldType::boolean(),caption: 'Bloqué');

        $this->Keys('Code');
    }
    public function onInsert(){
        if($this->Bloque->value === '' || $this->Bloque->value === null){
            $this->Validate('Bloque', false);
        }
    }
}

?>