<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocStaticView {
	private $myDocStatic;
	public function __construct($aDocStatic) {
		$this->myDocStatic = $aDocStatic;
	}
	public function render($mod) {
		// Navigation bar
		$aff = '<div id="FilAriane"><a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">DocStatic</a>';
		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Cr&eacute;ation</div><br/><br/>';
				break;
			case 'edit' :
				$aff .= '&nbsp;>&nbsp;Edition</div><br/><br/>';
				break;
		}
		$aff .= '<form method="post" name="formDocStatic">';
		$aff .= '<table width="100%">';

		$aff .= '<tr>';
		$aff .= '	<td>Titre *</td>';
		$aff .= '	<td><input type="text" id="Titre" name="Titre" size="80" value="' . stripslashes ( $this->myDocStatic->getTitre () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td colspan="2">';
		echo $aff;

		include_once ("../../../include/js/fckeditor/fckeditor.php");

		$oFCKeditor = new FCKeditor ( 'FCKeditor1' );
		$oFCKeditor->BasePath = '../../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myDocStatic->getContenuRichText () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '512';
		$oFCKeditor->ToolbarSet = 'WCM';
		$oFCKeditor->Create ();

		$aff = '	<td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		$aff .= '<input type="button" value="Enregistrer" onclick="Form.DocStatic.btEnregistrer()" /> ';
		$aff .= '<input type="button" value="Enregistrer et Fermer" onclick="Form.DocStatic.btEnregistrerEtFermer()"/>';

		$aff .= '</form>';
		echo $aff;
	}
}
?>
