<?php
class LangueView {
	private $myLangue;
	public function __construct($aLangue) {
		$this->myLangue = $aLangue;
	}

	// ###############
	public function render($mod) {
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="index.php">Langue</a>&nbsp;>&nbsp;';
		$aff .= ($mod == 'c' ? 'Création' : 'Edition') . '</div><br/><br/>';

		$aff .= '<form method="post" name="formLangue">';

		$aff .= '<table border=0><tr><td>';
		$aff .= '<label width="150">Code</label>';
		$aff .= '</td><td>';
		$aff .= '<input type="text" id="Code" name="Code" value="' . $this->myLangue->getCode () . '" maxlength="10" size="10" />';
		$aff .= '</td></tr><tr><td>';

		$aff .= '<label width="150">Langue</label>';
		$aff .= '</td><td>';
		$aff .= '<input type="text" id="Nom" name="Nom" value="' . $this->myLangue->getName () . '" maxlength="100" size="100" />';
		$aff .= '</td></tr></table>';

		if (isset ( $_GET ['id'] )) {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.Langue.btEnregistrer()"> ';
			$aff .= '<input type="button" value="Enregistrer & Fermer" onclick="ListeValeurAnnuaire.Langue.btEnregistrerFermer()">';
		} else {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.Langue.btEnregistrerFermer()">';
		}

		$aff .= '</form>';
		echo $aff;
	}
}
?>