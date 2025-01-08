<?php

class VATSetup extends Table
{
    public function __construct()
    {
        parent::__construct(25, 'vatsetup');

        $this->field(1,'Grpe_compta_marche_tva', FieldType::date(),tableRelation: new GrpeCompaMarcheTVA(),caption:'Groupe compta marché');
        $this->field(2,'Grpe_compa_produit_tva', FieldType::date(),tableRelation: new GrpeCompaProduitTVA(),caption:'Groupe compta produit');
        $this->field(3,'Description', FieldType::text(30), caption: 'Description');
        $this->field(4,'taux_tva', FieldType::decimal(), caption: '% TVA');
        $this->field(5,'Compte_tva_achat', FieldType::text(30), caption: 'Compte Remise client',tableRelation: new GLAccounts());
        $this->field(6,'Compte_tva_vente', FieldType::text(30), caption: 'Compte Remise client',tableRelation: new GLAccounts());

        $this->Keys('Grpe_compta_marche_tva', 'Grpe_compa_produit_tva');
    }
}

?>
