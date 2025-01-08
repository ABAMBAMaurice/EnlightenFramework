<?php

class GenPostSetup extends Table
{
    public function __construct()
    {
        parent::__construct(21, 'genpostsetup');

        $this->field(1,'Grpe_compta_marche', FieldType::text(30),tableRelation: new GrpeCompaMarche(),caption:'Groupe compta marché');
        $this->field(2,'Grpe_compa_produit', FieldType::text(30),tableRelation: new GrpeCompaProduit(),caption:'Groupe compta produit');
        $this->field(3,'Compte_achat', FieldType::text(30), caption: 'Compte achat',tableRelation: new GLAccounts());
        $this->field(4,'Compte_remise_achat', FieldType::text(30), caption: 'Compte remise achat',tableRelation: new GLAccounts());
        $this->field(5,'Compte_acompte_achat', FieldType::text(30), caption: 'Compte accompte achat',tableRelation: new GLAccounts());
        $this->field(6,'Compte_vente', FieldType::text(30), caption: 'Compte vente',tableRelation: new GLAccounts());
        $this->field(7,'Compte_remise_vente', FieldType::text(30), caption: 'Compte Remise vente',tableRelation: new GLAccounts());
        $this->field(8,'Compte_acompte_vente', FieldType::text(30), caption: 'Compte acompte vente',tableRelation: new GLAccounts());

        $this->Keys('Grpe_compta_marche', 'Grpe_compa_produit');
    }
}

?>