<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocPartenaireView {
	private $myDocPartenaire;
	public function __construct($aDocPartenaire) {
		$this->myDocPartenaire = $aDocPartenaire;
	}
	public function render($mod) {
		// Navigation Bar
		$aff = '<div id="FilAriane"><a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">DocPartenaire</a>';
		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Création</div><br/><br/>';
				$aff .= '<form method="POST" action="?action=new" onsubmit="return ValidationForm()">';
				break;
			case 'edit' :
				$aff .= '&nbsp;>&nbsp;Edition</div><br/><br/>';
				$aff .= '<form method="POST" action="?action=edit&id=' . $this->myDocPartenaire->getID () . '" onsubmit="return ValidationForm()">';
				break;
		}
		$aff .= '<table>';

		$aff .= '<tr>';
		$aff .= '	<td>Nom*</td>';
		$aff .= '	<td><input type="text" name="Nom" value="' . $this->myDocPartenaire->getNom () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Adresse</td>';
		$aff .= '	<td><textarea name="Adresse">' . $this->myDocPartenaire->getAdresse () . '</textarea></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Code Postal</td>';
		$aff .= '	<td><input type="text" name="CodePostal" value="' . $this->myDocPartenaire->getCodePostal () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Bureau Distributeur</td>';
		$aff .= '	<td><input type="text" name="BureauDistributeur" value="' . $this->myDocPartenaire->getBureauDistributeur () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Ville</td>';
		$aff .= '	<td><input type="text" name="Ville" value="' . $this->myDocPartenaire->getVille () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Téléphone</td>';
		$aff .= '	<td><input type="text" name="Telephone" value="' . $this->myDocPartenaire->getTelephone () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Fax</td>';
		$aff .= '	<td><input type="text" name="Fax" value="' . $this->myDocPartenaire->getFax () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>E-mail</td>';
		$aff .= '	<td><input type="text" name="EMail" value="' . $this->myDocPartenaire->getMail () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Interlocuteur</td>';
		$aff .= '	<td><input type="text" name="Interlocuteur" value="' . $this->myDocPartenaire->getNomContact () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Petit Logo (75x75)*</td>';
		$aff .= '	<td><input type="text" id="ImagesURL" name="PetitLogo" value="' . $this->myDocPartenaire->getLogoURLSmall () . '" readonly/>';
		$aff .= '	<input type="button" value="Parcourir le serveur" onclick="OpenServerBrowser(\'../../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Grand Logo (150x100)*</td>';
		$aff .= '	<td><input type="text" id="ImagesURL2" name="GrandLogo" value="' . $this->myDocPartenaire->getLogoURLBig () . '" readonly/>';
		$aff .= '	<input type="button" value="Parcourir le serveur" onclick="OpenServerBrowser2(\'../../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Position Logo</td>';
		$aff .= '	<td>';

		$aDocPartenaireList = new DocPartenaireList ();
		$aDocPartenaireList->SQL_SELECT_ALL_ACTIF ();

		$aff .= '<table>';
		$aff .= '		<tr><td' . (in_array ( '1', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="1"' . ($this->myDocPartenaire->getLogoPosition () == '1' || $mod == 'new' ? ' CHECKED=CHECKED' : '') . '/></td>';
		$aff .= '		<td' . (in_array ( '2', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="2"' . ($this->myDocPartenaire->getLogoPosition () == '2' ? ' CHECKED=CHECKED' : '') . '/></td>';
		$aff .= '		<td' . (in_array ( '3', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="3"' . ($this->myDocPartenaire->getLogoPosition () == '3' ? ' CHECKED=CHECKED' : '') . '/></td>';
		$aff .= '		<td' . (in_array ( '4', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="4"' . ($this->myDocPartenaire->getLogoPosition () == '4' ? ' CHECKED=CHECKED' : '') . '/></td></tr>';
		$aff .= '		<tr><td' . (in_array ( '5', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="5"' . ($this->myDocPartenaire->getLogoPosition () == '5' ? ' CHECKED=CHECKED' : '') . '/></td>';
		$aff .= '		<td' . (in_array ( '6', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="6"' . ($this->myDocPartenaire->getLogoPosition () == '6' ? ' CHECKED=CHECKED' : '') . '/></td>';
		$aff .= '		<td' . (in_array ( '7', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="7"' . ($this->myDocPartenaire->getLogoPosition () == '7' ? ' CHECKED=CHECKED' : '') . '/></td>';
		$aff .= '		<td' . (in_array ( '8', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="8"' . ($this->myDocPartenaire->getLogoPosition () == '8' ? ' CHECKED=CHECKED' : '') . '/></td></tr>';
		$aff .= '		<tr><td' . (in_array ( '9', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="9"' . ($this->myDocPartenaire->getLogoPosition () == '9' ? ' CHECKED=CHECKED' : '') . '/></td>';
		$aff .= '		<td' . (in_array ( '10', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="10"' . ($this->myDocPartenaire->getLogoPosition () == '10' ? ' CHECKED=CHECKED' : '') . '/></td>';
		$aff .= '		<td' . (in_array ( '11', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="11"' . ($this->myDocPartenaire->getLogoPosition () == '11' ? ' CHECKED=CHECKED' : '') . '/></td>';
		$aff .= '		<td' . (in_array ( '12', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="12"' . ($this->myDocPartenaire->getLogoPosition () == '12' ? ' CHECKED=CHECKED' : '') . '/></td></tr>';
		$aff .= '		<tr><td' . (in_array ( '13', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="13"' . ($this->myDocPartenaire->getLogoPosition () == '13' ? ' CHECKED=CHECKED' : '') . '/></td>';
		$aff .= '		<td' . (in_array ( '14', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="14"' . ($this->myDocPartenaire->getLogoPosition () == '14' ? ' CHECKED=CHECKED' : '') . '/></td>';
		$aff .= '		<td' . (in_array ( '15', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="15"' . ($this->myDocPartenaire->getLogoPosition () == '15' ? ' CHECKED=CHECKED' : '') . '/></td>';
		$aff .= '		<td' . (in_array ( '16', $aDocPartenaireList->getList () ) ? ' style="background-color:red;"' : '') . '><input type="radio" name="PositionLogo" value="16"' . ($this->myDocPartenaire->getLogoPosition () == '16' ? ' CHECKED=CHECKED' : '') . '/></td></tr>';
		$aff .= '</table>';
		$aff .= ' <i style="background-color:red;">&nbsp;&nbsp;&nbsp;&nbsp;</i> Il existe un logo partenaire actif à cette position';
		$aff .= '	</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Email Contact</td>';
		$aff .= '	<td><input type="text" name="EmailContact" value="' . $this->myDocPartenaire->getMailContact () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>URL Site Partenaire</td>';
		$aff .= '	<td><input type="text" name="URLSitePartenaire" value="' . $this->myDocPartenaire->getURL () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Actif</td>';
		$aff .= '	<td>';
		$aff .= '		<input type="radio" name="Actif" value="1"' . ($this->myDocPartenaire->getPublication () == '1' ? ' CHECKED=CHECKED' : '') . '/>OUI';
		$aff .= '		<input type="radio" name="Actif" value="0"' . ($this->myDocPartenaire->getPublication () == '0' ? ' CHECKED=CHECKED' : '') . '/>NON';
		$aff .= '	</td>';
		$aff .= '</tr>';
		switch ($mod) {
			case 'new' :
				$aff .= '<tr><td colspan="2"><input type="submit" value="Créer"></td></tr>';
				break;
			case 'edit' :
				$aff .= '<tr><td colspan="2"><input type="submit" value="Mettre à jour"></td></tr>';
				break;
		}
		$aff .= '</table>';
		$aff .= '</form>';

		echo $aff;
	}
}
?>