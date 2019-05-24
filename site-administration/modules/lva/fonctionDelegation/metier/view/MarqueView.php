<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class FonctionDelegationView {
	private $myFonctionDelegation;
	public function __construct($aFonctionDelegation) {
		$this->myFonctionDelegation = $aFonctionDelegation;
	}

	// ###############
	public function render($mod) {

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="index.php">Fonction D&eacute;l&eacute;gation</a>&nbsp;>&nbsp;';
		$aff .= ($mod == 'c' ? 'Création' : 'Edition') . '</div><br/><br/>';

		$aff .= '<form method="post" name="formFonctionDelegation">';

		$aff .= '<label>Nom</label>';
		$aff .= '<input type="text" id="Nom" name="Nom" value="' . $this->myFonctionDelegation->getName () . '" maxlength="100" size="100" />';
		$aff .= '<br><br>';

		if (isset ( $_GET ['id'] )) {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.FonctionDelegation.btEnregistrer()"> ';
			$aff .= '<input type="button" value="Enregistrer & Fermer" onclick="ListeValeurAnnuaire.FonctionDelegation.btEnregistrerFermer()">';
		} else {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.FonctionDelegation.btEnregistrerFermer()">';
		}
		$aff .= '</form>';
		echo $aff;
	}
}
?>