<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage commun
 * @version 1.0.4
 */
class MenuModeINDRAView {
	public function __construct() {
	}
	public function renderHTML() {
		$aCategorie = new Categorie ();
		$aff = '<table width="100%" cellpadding="0" bgcolor="#FFFFFF" style="background-image:url(\'include/images/ciscar/modeConnecte/roundedcornr_340872_grad.gif\');background-repeat:repeat-x;padding-left:5px;">';
		$aff .= '<tr>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><a href="?" style="text-decoration:none;"><font face="Arial" size="2" color="#000000"><b>Retour Accueil</b></font></a></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		// ###
		$aff .= '<tr>';
		$aff .= '	<td><font face="Arial" size="2" color="#000000"><b>SITES (acces direct)</b></font></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		// $aff .= ' <td><img src="include/images/kit/PuceGrise_petite.jpg"/> <a style="text-decoration:none;" href="?action=doc&id=5703" target="_BLANK"><font face="Arial" size="2" color="#000000">Achats en ligne</font></a></td>';
		$aff .= '	<td><img src="include/images/kit/PuceGrise_petite.jpg"/> <a style="text-decoration:none;" href="/modules/AutoLogin/?type=ecommerce" target="_BLANK"><font face="Arial" size="2" color="#000000">Achats en ligne</font></a></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><img src="include/images/kit/PuceGrise_petite.jpg"/> <a style="text-decoration:none;" href="/modules/AutoLogin/?type=carterie" target="_BLANK"><font face="Arial" size="2" color="#000000">Papeterie</font></a></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><img src="include/images/kit/PuceGrise_petite.jpg"/> <a style="text-decoration:none;" href="/modules/AutoLogin/?type=ciscom" target="_BLANK"><font face="Arial" size="2" color="#000000">Mailing</font></a></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		// ###
		$aff .= '<tr>';
		$aff .= '	<td><font face="Arial" size="2" color="#000000"><b>Infos CISCAR</b></font></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aCategorie->SQL_SEARCH ( 'Informatique' );
		$aff .= '	<td><img src="include/images/kit/PuceGrise_petite.jpg"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Informatique</font></a></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aCategorie->SQL_SEARCH ( 'Merchandising & Aménagement' );
		$aff .= '	<td><img src="include/images/kit/PuceGrise_petite.jpg"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Merchandising & Am&eacute;nagement</font></a></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aCategorie->SQL_SEARCH ( 'Matériel de garage' );
		$aff .= '	<td><img src="include/images/kit/PuceGrise_petite.jpg"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Mat&eacute;riel de garage</font></a></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aCategorie->SQL_SEARCH ( 'Accords Cadre' );
		$aff .= '	<td><img src="include/images/kit/PuceGrise_petite.jpg"/> <a style="text-decoration:none;" href="?action=theme&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Accords Cadre</font></a></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aCategorie->SQL_SEARCH ( 'En Bref' );
		$aff .= '	<td><img src="include/images/kit/PuceGrise_petite.jpg"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">En Bref</font></a></td>';
		$aff .= '</tr>';
		// $aff .= '<tr>';
		// $aff .= ' <td><img src="include/images/kit/PuceGrise_petite.jpg"/> <a style="text-decoration:none;" href="?action=doc&id=634349E799117947C12575E1004E7242"><font face="Arial" size="2" color="#000000">Cabinet BESSE</font></a></td>';
		// $aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		// ###
		$aff .= '<tr>';
		$aff .= '	<td><font face="Arial" size="2" color="#000000"><b>DOCS UTILES</b></font></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aCategorie->SQL_SEARCH ( 'Téléchargement' );
		$aff .= '	<td>- <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Bon de commande/font></a></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aCategorie->SQL_SEARCH ( 'Nos catalogues' );
		$aff .= '	<td>- <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Nos catalogues</font></a></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		return $aff;
	}
	public function render2HTML() {
		$aCategorie = new Categorie ();
		$aff = '';
		
		// Site
		$aff .= '<div class="menuModule2" id="ModuleSite" style="cursor:pointer;"><span style="margin-left:10px;">SITES (acces direct)</span></div>';
		$aff .= '<div class="menuLink" id="LinkSite"' . (isset ( $_GET ['action'] ) ? '  style="display:none;"' : '') . '>';
		// $aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="?action=doc&id=5703" target="_BLANK"><font face="Arial" size="2" color="#000000">Achats en ligne</font></a><br/>';
		$aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="/modules/AutoLogin/?type=ecommerce" target="_BLANK"><font face="Arial" size="2" color="#000000">Achats en ligne</font></a><br/>';
		$aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="/modules/AutoLogin/?type=carterie" target="_BLANK"><font face="Arial" size="2" color="#000000">Papeterie</font></a><br/>';
		$aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="/modules/AutoLogin/?type=ciscom" target="_BLANK"><font face="Arial" size="2" color="#000000">Mailing</font></a><br/>';
		$aff .= '</div><br/>';
		
		// Infos ciscar
		$aff .= '<div class="menuModule2" id="ModuleInfosCISCAR" style="cursor:pointer;"><span style="margin-left:10px;">Infos CISCAR</span></div>';
		$aff .= '<div class="menuLink" id="LinkInfosCISCAR" style="display:none;">';
		$aCategorie->SQL_SEARCH ( 'Informatique' );
		$aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Informatique</font></a><br/>';
		$aCategorie->SQL_SEARCH ( 'Merchandising & Aménagement' );
		$aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Merchandising & Am&eacute;nagement</font></a><br/>';
		$aCategorie->SQL_SEARCH ( 'Matériel de garage' );
		$aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Mat&eacute;riel de garage</font></a><br/>';
		$aCategorie->SQL_SEARCH ( 'Accords Cadre' );
		$aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="?action=theme&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Accords Cadre</font></a><br/>';
		$aCategorie->SQL_SEARCH ( 'Actualité' );
		$aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Actualit&eacute;</font></a><br/>';
		// $aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="?action=doc&id=634349E799117947C12575E1004E7242"><font face="Arial" size="2" color="#000000">Cabinet BESSE</font></a><br/>';
		$aff .= '</div><br/>';
		
		// Docs utiles
		$aff .= '<div class="menuModule2" id="ModuleDocsUtiles" style="cursor:pointer;"><span style="margin-left:10px;">DOCS UTILES</span></div>';
		$aff .= '<div class="menuLink" id="LinkDocsUtiles" style="display:none;">';
		$aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="?action=docStatic&id=102"><font face="Arial" size="2" color="#000000">Pr&eacute;sentation</font></a><br/>';
		$aCategorie->SQL_SEARCH ( 'Téléchargement' );
		$aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">T&eacute;l&eacute;chargement</font></a><br/>';
		$aCategorie->SQL_SEARCH ( 'Nos catalogues' );
		$aff .= '<img src="include/images/kit/PuceGrise_petite.png"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Nos catalogues</font></a><br/>';
		$aff .= '</div><br/>';
		
		return $aff;
	}
}
?>