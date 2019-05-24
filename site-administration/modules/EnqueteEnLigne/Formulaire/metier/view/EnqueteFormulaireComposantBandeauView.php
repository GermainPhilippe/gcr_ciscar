<?php
class EnqueteFormulaireComposantBandeauView {
	private $composant;
	public function __construct($composant) {
		$this->composant = $composant;
	}
	public function renderHTML() {
		$aff = '<h3>Composant - Bandeau</h3>';
		$aff .= '<script src="../../../include/js/fckeditor.js"></script>';
		$aff .= '<form method="post">';
		$aff .= '<b>Nom</b><br>';
		$aff .= '<input type="text" name="nom" size="50" value="' . $this->composant->getNom () . '"><br><br>';

		$aff .= '<b>Adresse</b><br>';
		$aff .= '<input type="text" id="ImagesURL" name="ImagesURL" value="' . $this->composant->getValeur () . '" size="50"/>';
		$aff .= '<input type="button" value="Parcourir le Serveur" onclick="OpenServerBrowser(\'../../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/><br><br>';

		$aff .= '<input type="submit" value="Enregistrer">';
		$aff .= '</form>';
		echo $aff;
	}
}