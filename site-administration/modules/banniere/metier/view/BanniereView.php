<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage banniere
 * @version 1.0.4
 */
class BanniereView {
	private $myBanniere;
	public function __construct($aBanniere) {
		$this->myBanniere = $aBanniere;
	}
	public function renderHTML($mod) {
		$this->render ( $mod );
	}
	public function render($mod) {
		$aff = '<div id="FilAriane"><a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;Bannière';
		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Création</div><br/><br/>';
				$aff .= '<form name="FormBanniere" method="POST" action="?action=new" onsubmit="return formValidater()">';
				break;
			case 'edit' :
				$aff .= '&nbsp;>&nbsp;Edition</div><br/><br/>';
				$aff .= '<form name="FormBanniere" method="POST" action="?action=edit&id=' . $_GET ['id'] . '" onsubmit="return formValidater()">';
				break;
		}
		$aff .= HelperHead::includeJS ( '../../include/js/ckfinder/ckfinder.js' );
		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '	<td>Titre*</td>';
		$aff .= '	<td><input type="text" name="Titre" value="' . $this->myBanniere->getTitre () . '" size="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td colspan="2">&nbsp;</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Lien vers</td>';
		$aff .= '	<td><input type="text" name="URL" value="' . $this->myBanniere->getURL () . '" size="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Image (460x60)*</td>';
		$aff .= '	<td>';
		// FCKEDITOR
		$aff .= '	<input type="text" id="ImagesURL" name="ImagesURL" value="' . $this->myBanniere->getURLImage () . '" size="50"/>';
		$aff .= '	<input type="button" value="Parcourir le Serveur" onclick="OpenServerBrowser(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/>';
		// CKFINDER
		/*
		 * $aff .= '<input id="xImagesURL" name="ImagesURL" type="text" size="60" />';
		 * $aff .= '<input type="button" value="Parcourir le serveur" onclick="BrowseServer( \'Images:/banniere/\', \'xImagesURL\' );" />';
		 * $aff .= '<div id="preview" style="display:none">';
		 * $aff .= '<div id="thumbnails"></div>';
		 * $aff .= '</div>';
		 */

		$aff .= '	</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td colspan="2">&nbsp;</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Date Début</td>';
		$aff .= '	<td><input type="text" name="DateDebut" id="DateDebut" value="' . ($this->myBanniere->getDateDebut () != '' ? CommunFunction::getDateFR ( $this->myBanniere->getDateDebut () ) : '') . '">';
		$aff .= '	<img src="../../include/images/info.jpg" title="Peut être vide"/>';
		$aff .= '</td></tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Date Fin</td>';
		$aff .= '	<td><input type="text" name="DateFin" id="DateFin" value="' . ($this->myBanniere->getDateFin () != '' ? CommunFunction::getDateFR ( $this->myBanniere->getDateFin () ) : '') . '"/>';
		$aff .= '	<img src="../../include/images/info.jpg" title="Peut être vide"/>';
		$aff .= '</td></tr>';

		$aff .= '<tr>';
		$aff .= '	<td colspan="2">&nbsp;</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Publication</td>';
		$aff .= '	<td><input type="radio" name="Publication" value="0"' . ($this->myBanniere->getPublication () == '0' ? ' CHECKED' : '') . '/>NON';
		$aff .= '	<input type="radio" name="Publication" value="1"' . ($this->myBanniere->getPublication () == '1' ? ' CHECKED' : '') . '/>OUI</td>';
		$aff .= '</tr>';

		/*
		 * $aff .= '<tr>';
		 * $aff .= ' <td>Par Défaut</td>';
		 * $aff .= ' <td><input type="checkbox" name="ParDefaut" value="1"'.($this->myBanniere->getParDefaut()=='1'?' CHECKED':'').'/></td>';
		 * $aff .= '</tr>';
		 */

		$aff .= '<tr>';
		switch ($mod) {
			case 'new' :
				$aff .= '<td colspan="2"><input type="submit" value="Créer"/></td>';
				break;
			case 'edit' :
				$aff .= '<td colspan="2"><input type="submit" value="Mettre à jour"/></td>';
				break;
		}
		$aff .= '</tr>';
		$aff .= '</table>';
		$aff .= '</form>';

		echo $aff;
	}
}
?>