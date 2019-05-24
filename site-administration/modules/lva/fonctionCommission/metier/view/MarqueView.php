<?php
class FonctionCommissionView {
	private $myFonctionCommission;
	function __construct($aFonctionCommission) {
		$this->myFonctionCommission = $aFonctionCommission;
	}

	// ###############
	function render($mod) {

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="index.php">Fonction Commission</a>&nbsp;>&nbsp;';
		$aff .= ($mod == 'c' ? 'Création' : 'Edition') . '</div><br/><br/>';

		$aff .= '<form method="post" name="formFonctionCommission">';

		$aff .= '<label>Nom</label>';
		$aff .= '<input type="text" id="Nom" name="Nom" value="' . $this->myFonctionCommission->getName () . '" maxlength="100" size="100" />';
		$aff .= '<br><br>';

		if (isset ( $_GET ['id'] )) {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.FonctionCommission.btEnregistrer()"> ';
			$aff .= '<input type="button" value="Enregistrer & Fermer" onclick="ListeValeurAnnuaire.FonctionCommission.btEnregistrerFermer()">';
		} else {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.FonctionCommission.btEnregistrerFermer()">';
		}
		$aff .= '</form>';
		echo $aff;
	}
}
?>