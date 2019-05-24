<?php
class FonctionBNView {
	private $myFonctionBN;
	public function __construct($aFonctionBN) {
		$this->myFonctionBN = $aFonctionBN;
	}

	// ###############
	public function render($mod) {

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="index.php">Fonction Bureau National</a>&nbsp;>&nbsp;';
		$aff .= ($mod == 'c' ? 'Création' : 'Edition') . '</div><br/><br/>';

		$aff .= '<form method="post" name="formFonctionBureauNational">';

		$aff .= '<table>';
		$aff .= '<tr><td><label>Nom</label></td>';
		$aff .= '<td><input type="text" id="Nom" name="Nom" value="' . $this->myFonctionBN->getName () . '" maxlength="100" size="100" /></td></tr>';

		$aff .= '<tr><td><label>Num&eacute;ro Ordre</label></td>';
		$aff .= '<td><input type="text" id="NumeroOrdre" name="NumeroOrdre" value="' . $this->myFonctionBN->getNumeroOrdre () . '" maxlength="4" size="3" /></td></tr>';
		$aff .= '</table>';
		$aff .= '<br><br>';

		if (isset ( $_GET ['id'] )) {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.FonctionBureauNational.btEnregistrer()"> ';
			$aff .= '<input type="button" value="Enregistrer & Fermer" onclick="ListeValeurAnnuaire.FonctionBureauNational.btEnregistrerFermer()">';
		} else {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.FonctionBureauNational.btEnregistrerFermer()">';
		}
		$aff .= '</form>';
		echo $aff;
	}
}
?>