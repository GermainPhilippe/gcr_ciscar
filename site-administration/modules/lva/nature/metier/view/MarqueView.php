<?php
class NatureView {
	private $myNature;
	public function __construct($aNature) {
		$this->myNature = $aNature;
	}

	// ###############
	public function render($mod) {
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="index.php">Nature</a>&nbsp;>&nbsp;';
		$aff .= ($mod == 'c' ? 'Création' : 'Edition') . '</div><br/><br/>';

		$aff .= '<form method="post" name="formNature">';

		$aff .= '<label>Nom</label>';
		$aff .= '<input type="text" id="Nom" name="Nom" value="' . $this->myNature->getName () . '" maxlength="100" size="100" />';
		$aff .= '<br><br>';

		if (isset ( $_GET ['id'] )) {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.Nature.btEnregistrer()"> ';
			$aff .= '<input type="button" value="Enregistrer & Fermer" onclick="ListeValeurAnnuaire.Nature.btEnregistrerFermer()">';
		} else {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.Nature.btEnregistrerFermer()">';
		}

		$aff .= '</form>';
		echo $aff;
	}
}
?>