<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage commun
 * @version 1.0.4
 */
class MenuModeRenaultView {
	public function __construct() {
	}
	public function renderHTML() {
		$aCategorie = new Categorie ();
		
		$aff = '';
		
		// SITE
		$aff .= '<div class="menuModule" id="ModuleSite" style="cursor:pointer;"><span style="margin-left:10px;">SITES (acces direct)</span></div>';
		$aff .= '<div class="menuLink" id="LinkSite"' . (isset ( $_GET ['action'] ) ? '  style="display:none;"' : '') . '>';
		$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="/modules/AutoLogin/?type=ecommerce" target="_BLANK"><font face="Arial" size="2" color="#000000">Achats en ligne</font></a><br/>';
		// $aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="?action=doc&id=5703" target="_BLANK"><font face="Arial" size="2" color="#000000">Achats en ligne</font></a><br/>';
		$aParam = new Param ();
		$aParam->search_param ( 'URL_SIGNALETIQUE' );
		$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="' . $aParam->getValue () . '" ><font face="Arial" size="2" color="#000000">Signal&eacute;tique</font></a><br/>';
		$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="/modules/AutoLogin/?type=carterie" target="_BLANK"><font face="Arial" size="2" color="#000000">Papeterie</font></a><br/>';
		$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="/modules/AutoLogin/?type=ciscom" target="_BLANK"><font face="Arial" size="2" color="#000000">Mailing</font></a><br/>';
		$aff .= '</div>';
		
		$aff .= '<br/>';
		
		// Infos CISCAR
		$aff .= '<div class="menuModule" id="ModuleInfosCISCAR" style="cursor:pointer;"><span style="margin-left:10px;">Infos CISCAR</span></div>';
		$aff .= '<div class="menuLink" id="LinkInfosCISCAR" style="display:none;">';
		$aCategorie->SQL_SEARCH ( 'Informatique' );
		$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Informatique</font></a><br/>';
		$aCategorie->SQL_SEARCH ( 'Merchandising & Aménagement' );
		$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Merchandising & Am&eacute;nagement</font></a><br/>';
		$aCategorie->SQL_SEARCH ( 'Matériel de garage' );
		$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Mat&eacute;riel de garage</font></a><br/>';
		
		// $aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;font-weight:bold;color:red;" href="?action=type&id=1347"><font face="Arial" size="2">Offres Equip\' Auto</font></a><br/>';
		$aCategorie->SQL_SEARCH ( 'Accords Cadre' );
		$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="?action=theme&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Accords Cadre</font></a></br/>';
		$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="?action=doc&id=0D490298A65F0AE4C12574830047E364"><font face="Arial" size="2" color="#000000">Mobilier RENAULT</font></a><br/>';
		$aCategorie->SQL_SEARCH ( 'Actualité' );
		$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Actualit&eacute;</font></a><br/>';
		
		$aParam = new Param ();
		$aParam->search_param ( 'CISCAR_ACTIVATION_QUEST' );
		if ($aParam->getValue () == '1') {
			$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/>  <a style="text-decoration:none;" href="?action=doc&id=1126"><font face="Arial" size="2" color="#000000">QUEST</font></a><br/>';
		}
		// $aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="?action=doc&id=634349E799117947C12575E1004E7242"><font face="Arial" size="2" color="#000000">Cabinet BESSE</font></a><br/>';
		$aff .= '</div>';
		
		$aff .= '<br/>';
		
		// Docs utiles
		$aff .= '<div class="menuModule" id="ModuleDocsUtiles" style="cursor:pointer;"><span style="margin-left:10px;">DOCS UTILES</span></div>';
		$aff .= '<div class="menuLink" id="LinkDocsUtiles" style="display:none;">';
		$aCategorie->SQL_SEARCH ( 'Téléchargement' );
		$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Bon de commande</font></a><br/>';
		$aCategorie->SQL_SEARCH ( 'Nos catalogues' );
		$aff .= '<img src="include/images/kit/PuceJaune_petite.jpg"/> <a style="text-decoration:none;" href="?action=type&id=' . $aCategorie->getID () . '"><font face="Arial" size="2" color="#000000">Nos catalogues</font></a><br/>';
		$aff .= '</div><br/>';
		
		return $aff;
	}
}
?>