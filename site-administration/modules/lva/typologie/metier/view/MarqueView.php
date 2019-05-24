<?php
class TypologieView {
	private $myTypologie;
	public function __construct($aTypologie) {
		$this->myTypologie = $aTypologie;
	}

	// ###############
	public function render($mod) {
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="index.php">Typologie</a>&nbsp;>&nbsp;';
		$aff .= ($mod == 'c' ? 'Création' : 'Edition') . '</div><br/><br/>';

		$aff .= '<form method="post" name="formTypologie">';

		$aff .= '<label>Nom</label>';
		$aff .= '<input type="text" id="Nom" name="Nom" value="' . $this->myTypologie->getName () . '" maxlength="100" size="100" />';
		$aff .= '<br><br>';

		if (isset ( $_GET ['id'] )) {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.Typologie.btEnregistrer()"> ';
			$aff .= '<input type="button" value="Enregistrer & Fermer" onclick="ListeValeurAnnuaire.Typologie.btEnregistrerFermer()">';
		} else {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.Typologie.btEnregistrerFermer()">';
		}

		$aff .= '</form>';
		echo $aff;
	}
}
?>