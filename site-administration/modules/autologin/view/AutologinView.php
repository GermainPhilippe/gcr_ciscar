<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage autologin
 * @version 1.0.4
 */
class AutologinView {
	public function __construct() {
	}
	public function renderHTML() {
		include_once ("../../include/js/fckeditor/fckeditor.php");
		$aParam = new Param ();
		$aff = '<div id="FilAriane"><a href="../../?menu=2">Site</a>&nbsp;>&nbsp;Autologin</div>';
		$aff .= '<form method="POST" action="?action=edit" name="formAutologin">';
		$aff .= '<br/>';

		$aff .= '<img src="../../include/images/1.png" border="0"/> <b>Connexion au site Carterie</b>';
		$aff .= '<table width="100%" border="1">';
		$aff .= '<tr>';
		$aff .= '	<td width="300">Texte de la page de connexion</td>';
		$aff .= '	<td>';
		echo $aff;

		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_CARTERIE_PAGE_CONNEXION' );
		$oFCKeditor = new FCKeditor ( 'CARTERIE_PAGE_CONNEXION' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>Message d\'erreur<br/>(Pas de concession ou pas d\'Identifiant Constructeur(RRF))</td>';
		$aff .= '	<td>';
		echo $aff;
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_CARTERIE_MESSAGE_ERREUR' );
		$oFCKeditor = new FCKeditor ( 'CARTERIE_MESSAGE_ERREUR' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>Message d\'erreur sur login</td>';
		$aff .= '	<td>';
		echo $aff;
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_CARTERIE_MESSAGE_ERREUR_LOGIN' );
		$oFCKeditor = new FCKeditor ( 'CARTERIE_MESSAGE_ERREUR_LOGIN' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>Clé Autologin</td>';
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_CARTERIE_CLEF_AUTOLOGIN' );
		$aff .= '	<td><input type="password" id="CARTERIE_CLEF_AUTOLOGIN" name="CARTERIE_CLEF_AUTOLOGIN" value="' . $aParam->getValue () . '"/></td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		$aff .= '<br/>';

		$aff .= '<img src="../../include/images/1.png" border="0"/> <b>Connexion au site CIS-COM</b>';
		$aff .= '<table width="100%" border="1">';
		$aff .= '<tr>';
		$aff .= '	<td width="300">Texte de la page de connexion</td>';
		$aff .= '	<td>';
		echo $aff;
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_CIS-COM_PAGE_CONNEXION' );
		$oFCKeditor = new FCKeditor ( 'CIS-COM_PAGE_CONNEXION' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>Message d\'erreur<br/>(Pas de concession ou pas d\'Identifiant Constructeur(RRF))</td>';
		$aff .= '	<td>';
		echo $aff;
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_CIS-COM_MESSAGE_ERREUR' );
		$oFCKeditor = new FCKeditor ( 'CIS-COM_MESSAGE_ERREUR' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>Message d\'erreur sur login</td>';
		$aff .= '	<td>';
		echo $aff;
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_CIS-COM_MESSAGE_ERREUR_LOGIN' );
		$oFCKeditor = new FCKeditor ( 'CIS-COM_MESSAGE_ERREUR_LOGIN' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>Clé Autologin</td>';
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_CIS-COM_CLEF_AUTOLOGIN' );
		$aff .= '	<td><input type="password" id="CIS-COM_CLEF_AUTOLOGIN" name="CIS-COM_CLEF_AUTOLOGIN" value="' . $aParam->getValue () . '"/></td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		$aff .= '<br/>';

		$aff .= '<img src="../../include/images/1.png" border="0"/> <b>Connexion au site E-COMMERCE</b>';
		$aff .= '<table width="100%" border="1">';
		$aff .= '<tr>';
		$aff .= '	<td width="300">Texte de la page de connexion</td>';
		$aff .= '	<td>';
		echo $aff;
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_E-COMMERCE_PAGE_CONNEXION' );
		$oFCKeditor = new FCKeditor ( 'E-COMMERCE_PAGE_CONNEXION' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>Message d\'erreur<br/>(Pas de concession ou pas d\'Identifiant Constructeur(RRF))</td>';
		$aff .= '	<td>';
		echo $aff;
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_E-COMMERCE_MESSAGE_ERREUR' );
		$oFCKeditor = new FCKeditor ( 'E-COMMERCE_MESSAGE_ERREUR' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>Message d\'erreur sur login</td>';
		$aff .= '	<td>';
		echo $aff;
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_E-COMMERCE_MESSAGE_ERREUR_LOGIN' );
		$oFCKeditor = new FCKeditor ( 'E-COMMERCE_MESSAGE_ERREUR_LOGIN' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>Clé Autologin</td>';
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_E-COMMERCE_CLEF_AUTOLOGIN' );
		$aff .= '	<td><input type="password" id="E-COMMERCE_CLEF_AUTOLOGIN" name="E-COMMERCE_CLEF_AUTOLOGIN" value="' . $aParam->getValue () . '"/></td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		$aff .= '<input type="button" value="Enregistrer" onclick="Form.Autologin.btEnregistrer()" /> ';
		$aff .= '<input type="button" value="Enregistrer et Fermer" onclick="Form.Autologin.btEnregistrerEtFermer()"/>';

		$aff .= '</form>';
		echo $aff;
	}
}
?>
