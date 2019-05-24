<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class AnnuaireView {
	private $myAnnuaire;

	function __construct($aAnnuaire)
	{
		$this->myAnnuaire = $aAnnuaire;
	}
	function AnnuaireView($aAnnuaire) {
		self::__construct($aAnnuaire);
	}
	
	// ###############
	function render($mod) {

		// Navigation bar
		$aff = '<b><a href="../../index.php?menu=2">Site</a>&nbsp;>&nbsp;<a href="index.php">';
		$aff .= '<a href="index.php">Annuaire</a>&nbsp;>&nbsp;';

		// Formualire
		if ($mod == 'c') {
			$aff .= 'Cr&eacute;er un Annuaire</b><br/><br/>';
			$aff .= '<form method="POST" action="?action=c">';
		} else if ($mod == 'u') {
			$aff .= 'Editer un Annuaire</b><br/><br/>';
			$aff .= '<form method="POST" action="?action=u&id=' . $this->myAnnuaire->getID () . '">';
		} else if ($mod == 'd') {
			$aff .= 'Supprimer un Annuaire</b><br/><br/>';
			$aff .= '<form method="POST" action="?action=d&id=' . $this->myAnnuaire->getID () . '">';
		}

		$aff .= '<input type="button" value="Retour" onclick="history.back()"/><br/><br/>';
		$aff .= '<table width="800">';

		if ($mod == 'u' || $mod == 'd') {
			$aff .= '<tr>';
			$aff .= '<td>#</td>';
			$aff .= '<td><input type="text" name="AnnuaireID" value="' . $this->myAnnuaire->getID () . '" readonly/></td>';
			$aff .= '</tr>';
		}

		$aff .= '<tr>';
		$aff .= '<td>Nom</td>';
		$aff .= '<td><input type="text" name="Nom" value="' . $this->myAnnuaire->getName () . '"/></td>';
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