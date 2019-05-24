<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocPartenairePageView {
	private $myDocPartenairePage;
	public function __construct($aDocStatic) {
		$this->myDocPartenairePage = $aDocStatic;
	}
	public function render($mod) {
		$aDocPartenaire = new DocPartenaire ();
		$aDocPartenaire->SQL_selection ( $this->myDocPartenairePage->getDocPartenaireID () );

		// Navigation bar
		$aff = '<div id="FilAriane"><a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="../DocPartenaire/?">DocPartenaire (' . $aDocPartenaire->getNom () . ')</a>&nbsp;>&nbsp;<a href="?action=view&id=' . $this->myDocPartenairePage->getDocPartenaireID () . '">Page(s)</a>';

		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Création</div><br/><br/>';
				$aff .= '<form method="POST" name="formPagePartenaire" action="?action=new&id=' . $this->myDocPartenairePage->getDocPartenaireID () . '" onsubmit="return ValidationFormPage()">';
				break;
			case 'edit' :
				$aff .= '&nbsp;>&nbsp;Edition</div><br/><br/>';
				$aff .= '<form method="POST" name="formPagePartenaire" action="?action=edit&id=' . $_GET ['id'] . '&id2=' . $this->myDocPartenairePage->getDocPartenaireID () . '" onsubmit="return ValidationFormPage()">';
				break;
		}

		$aff .= '<table width="100%">';

		$aff .= '<tr>';
		$aff .= '	<td>Titre*</td>';
		$aff .= '	<td><input type="text" id="Titre" name="Titre" size="80" value="' . stripslashes ( $this->myDocPartenairePage->getTitre () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Picto Titre</td>';
		$aff .= '	<td><input type="text" size="80" id="ImagesURL" name="PictoTitre" value="' . $this->myDocPartenairePage->getPictoTitre () . '"/>';
		$aff .= '	<input type="button" value="Parcourir le serveur" onclick="OpenServerBrowser(\'../../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td colspan="2">';
		echo $aff;

		include_once ("../../../include/js/fckeditor/fckeditor.php");

		$oFCKeditor = new FCKeditor ( 'FCKeditor1' );
		$oFCKeditor->BasePath = '../../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myDocPartenairePage->getContenuRichText () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '512';
		$oFCKeditor->ToolbarSet = 'WCM';
		$oFCKeditor->Create ();

		$aff = '	<td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		$aff .= '<input type="button" value="Enregistrer" onclick="Form.PagePartenaire.btEnregistrer()" /> ';
		$aff .= '<input type="button" value="Enregistrer et Fermer" onclick="Form.PagePartenaire.btEnregistrerEtFermer()"/>';

		$aff .= '</form>';

		echo $aff;
	}
}
?>
