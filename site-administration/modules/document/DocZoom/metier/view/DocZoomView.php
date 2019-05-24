<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocZoomView {
	private $myDocZoom;
	public function __construct($aDocZoom) {
		$this->myDocZoom = $aDocZoom;
	}

	// ###
	public function render($mod) {
		$aff = '<div id="FilAriane"><a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;';
		switch ($mod) {
			case 'new' :
				$aff .= '<a href="../DocInfoDyn/?action=edit&id=' . $this->myDocZoom->getDocInfoDynID () . '">DocZoom</a>&nbsp;>&nbsp;Cr&eacute;ation</div><br/><br/>';
				$aff .= '<form method="post" name="formDocZoom">';
				$aff .= '<input type="hidden" name="DocInfoDynID" value="' . $_GET ['id'] . '"/>';
				break;
			case 'edit' :
				$aff .= '<a href="?">DocZoom</a>&nbsp;>&nbsp;Edition</div><br/><br/>';
				$aff .= '<form method="post" name="formDocZoom">';
				break;
		}

		$aff .= '<table border=0>';

		$aff .= '<tr>';
		$aff .= '	<td>Lien vers DocInfoDyn</td>';
		$aff .= '	<td><a href="../DocInfoDyn/?action=edit&id=' . $this->myDocZoom->getDocInfoDynID () . '"><img src="../../../include/images/doc.jpeg" border="0"/></a></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td colspan="2">&nbsp;</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Titre</td>';
		$aff .= '	<td><input type="text" id="Titre" name="Titre" size="100" value="' . stripslashes ( $this->myDocZoom->getTitre () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Accroche</td>';
		$aff .= '	<td><textarea id="Accroche" name="Accroche" cols="100">' . stripslashes ( $this->myDocZoom->getAccroche () ) . '</textarea></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Images Portail</td>';
		$aff .= '	<td><input type="text" id="ImagesURL" name="ImagesURL" value="' . $this->myDocZoom->getImagePortail () . '"/>';
		$aff .= '	<input type="button" value="Parcourir le serveur" onclick="OpenServerBrowser(\'../../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Num&eacute;ro Ordre</td>';
		$aff .= '	<td><input type="text" id="NumOrdre" name="NumOrdre" value="' . $this->myDocZoom->getNumOrdre () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Publication</td>';
		$aff .= '	<td>';
		$aff .= '		<input type="radio" value="1" name="Publication"' . ($this->myDocZoom->getPublication () == 1 ? ' CHECKED=CHECKED' : '') . '/>OUI';
		$aff .= '		<input type="radio" value="0" name="Publication"' . ($this->myDocZoom->getPublication () == 0 ? ' CHECKED=CHECKED' : '') . '/>NON';
		$aff .= '	</td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		$aff .= '<input type="button" value="Enregistrer" onclick="Form.DocZoom.btEnregistrer()" /> ';
		$aff .= '<input type="button" value="Enregistrer et Fermer" onclick="Form.DocZoom.btEnregistrerEtFermer()"/>';

		$aff .= '</form>';

		echo $aff;
	}
}
?>