<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage site
 * @version 1.0.4
 */
class SiteView {
	private $mySite;

	function __construct($aSite)
	{
		$this->mySite = $aSite;
	}
	function SiteView($aSite) {
		self::__construct($aSite);
	}
	
	// ###############
	function render($mod) {
		// Navigation bar
		$aff = '<b><a href="../../index.php">Admin</a>&nbsp;>&nbsp;<a href="index.php">';
		$aff .= '<a href="index.php">Site</a>&nbsp;>&nbsp;';

		// Formualire
		if ($mod == 'c') {
			$aff .= 'Cr&eacute;er un site</b><br/><br/>';
			$aff .= '<form method="POST" action="?action=c" name="siteForm" onsubmit="return checkForm(\'siteForm\',\'Nom\')">';
		} else if ($mod == 'u') {
			$aff .= 'Editer un site</b><br/><br/>';
			$aff .= '<form method="POST" action="?action=u&id=' . $this->mySite->getID () . '" name="siteForm" onsubmit="checkForm(\'siteForm\',\'Nom\')">';
		} else if ($mod == 'd') {
			$aff .= 'Supprimer un site</b><br/><br/>';
			$aff .= '<form method="POST" action="?action=d&id=' . $this->mySite->getID () . '" name="siteForm" onsubmit="checkForm(\'siteForm\',\'Nom\')">';
		}

		$aff .= '<input type="button" value="Retour" onclick="history.back()"/><br/><br/>';
		$aff .= '<table width="800">';

		if ($mod == 'u' || $mod == 'd') {
			$aff .= '<tr>';
			$aff .= '<td>#</td>';
			$aff .= '<td><input type="text" name="siteID" value="' . $this->mySite->getID () . '" readonly/></td>';
			$aff .= '</tr>';
		}

		$aff .= '<tr>';
		$aff .= '<td>Nom</td>';
		$aff .= '<td><input type="text" name="Nom" value="' . $this->mySite->getName () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		if ($mod == 'c') {
			$aff .= '<td colspan="2"><input type="submit" value="Cr&eacute;er"></td>';
		} else if ($mod == 'u') {
			$aff .= '<td colspan="2"><input type="submit" value="Mettre &agrave; Jour"></td>';
		} else if ($mod == 'd') {
			$aff .= '<td colspan="2"><input type="submit" value="Confirmation"></td>';
		}
		$aff .= '</tr>';

		$aff .= '</table></form>';
		echo $aff;
	}
	public function redirection($url) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href="' . $url . '";';
		$aff .= '</script>';
		echo $aff;
	}
}
?>