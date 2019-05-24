<?php
class DomaineActiviteView {
	private $myDomaineActivite;
	public function __construct($aDomaineActivite) {
		$this->myDomaineActivite = $aDomaineActivite;
	}
	public function render($mod) {

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="index.php">Domaine Activit&eacute;</a>&nbsp;>&nbsp;';
		$aff .= ($mod == 'c' ? 'Création' : 'Edition') . '</div><br/><br/>';

		$aff .= '<form method="post" name="formDomaineActivite">';

		$aff .= '<table>';
		$aff .= '<tr><td><label>Nom</label></td>';
		$aff .= '<td><input type="text" id="Nom" name="Nom" value="' . $this->myDomaineActivite->getName () . '" maxlength="100" size="100" /></td></tr>';

		$aff .= '<tr><td><label>Num&eacute;ro Ordre</label></td>';
		$aff .= '<td><input type="text" id="NumeroOrdre" name="NumeroOrdre" value="' . $this->myDomaineActivite->getNumOrdre () . '" maxlength="4" size="3" /></td></tr>';
		$aff .= '</table>';
		$aff .= '<br><br>';

		if (isset ( $_GET ['id'] )) {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.DomaineActivite.btEnregistrer()"> ';
			$aff .= '<input type="button" value="Enregistrer & Fermer" onclick="ListeValeurAnnuaire.DomaineActivite.btEnregistrerFermer()">';
		} else {
			$aff .= '<input type="button" value="Enregistrer" onclick="ListeValeurAnnuaire.DomaineActivite.btEnregistrerFermer()">';
		}
		$aff .= '</form>';
		echo $aff;
	}
}
?>