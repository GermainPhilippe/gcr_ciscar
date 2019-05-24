<?php
class EnqueteFormulaireComposantZoneTextView {
	private $composant;
	public function __construct($composant) {
		$this->composant = $composant;
	}
	public function renderHTML() {
		$aff = '<h3>Composant - Zone de texte</h3>';
		$aff .= '<form method="post">';
		$aff .= '<b>Nom</b><br>';
		$aff .= '<input type="text" name="nom" size="50" value="' . $this->composant->getNom () . '"><br><br>';

		$aff .= '<b>Contenu HTML</b><br>';
		include_once ("../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'valeur' );
		$oFCKeditor->BasePath = "../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "300";
		$oFCKeditor->ToolbarSet = "WCM";
		$oFCKeditor->Value = stripslashes ( $this->composant->getValeur () );
		$aff .= $oFCKeditor->CreateHtml ();

		$aff .= '<input type="submit" value="Enregistrer">';
		$aff .= '</form>';
		echo $aff;
	}
}