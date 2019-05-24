<?php
class StatutEtablissementView {
	private $myStatutEtablissement;
	function __construct($aStatutEtablissement) {
		$this->myStatutEtablissement = $aStatutEtablissement;
	}

	// ###############
	function render($mod) {

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="index.php">Statut Etablissement</a>&nbsp;>&nbsp;';
		$aff .= ($mod == 'c' ? 'Création' : 'Edition') . '</div><br/><br/>';

		$aff .= '<form method="post" name="formStatutEtablissement">';

		$aff .= '<label>Nom</label>';
		$aff .= '<input type="text" id="Nom" name="Nom" value="' . $this->myStatutEtablissement->getName () . '" maxlength="100" size="100" />';
		$aff .= '<br><br>';

		if (isset ( $_GET ['id'] )) {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.StatutEtablissement.btEnregistrer()"> ';
			$aff .= '<input type="button" value="Enregistrer & Fermer" onclick="ListeValeurAnnuaire.StatutEtablissement.btEnregistrerFermer()">';
		} else {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.StatutEtablissement.btEnregistrerFermer()">';
		}
		$aff .= '</form>';
		echo $aff;
	}
}
?>