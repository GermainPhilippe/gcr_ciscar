<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class AnnuaireListeView {
	private $myAnnuaireListe;

	function __construct($aAnnuaireListe)
	{
		$this->myAnnuaireListe = $aAnnuaireListe;
	}
	function AnnuaireListeView($aAnnuaireListe) {
		self::__construct($aAnnuaireListe);
	}
	
	function render() {
		// Navigation bar
		$aff = '<b><a href="../../index.php?menu=2">Site</a>&nbsp;>&nbsp;Liste Valeurs Annuaire</b><br/><br/>';

		$aff .= '<div class="menuContainer">';
		$aff .= '<a href="marque/">Marque</a><br/>';
		$aff .= '<a href="nature/">Nature</a><br/>';
		$aff .= '<a href="typologie/">Typologie</a><br/>';
		$aff .= '<a href="groupeEtablissement/">Groupe Etablissement</a><br/>';
		$aff .= '<a href="statutEtablissement/">Statut Etablissement</a><br/>';
		$aff .= '<a href="region/">Region</a><br/>';
		$aff .= '<hr>';
		$aff .= '<a href="fonctionBN/">Fonction Bureau National</a><br/>';
		$aff .= '<a href="fonctionCommission/">Fonction Commission</a><br/>';
		$aff .= '<a href="fonctionDelegation/">Fonction D&eacute;l&eacute;gation</a><br/>';
		$aff .= '<a href="domaineActivite/">Domaine Activit&eacute;</a><br/>';
		$aff .= '<a href="commission/">Commission</a><br/>';
		$aff .= '</div>';

		$aff .= '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
		echo $aff;
	}
	function render_option($i) {
		$aff = '<select name="AnnuaireID">';

		foreach ( $this->myAnnuaireListe->getAnnuaireListe () as $aAnnuaire ) {
			$aff .= '<option value="' . $aAnnuaire->getID () . '"' . ($i == ($aAnnuaire->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aAnnuaire->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty($i) {
		$aff = '<select name="AnnuaireID"><option value="0"' . ($i == ($aAnnuaire->getID ()) ? ' SELECTED=SELECTED' : '') . '></option>';

		foreach ( $this->myAnnuaireListe->getAnnuaireListe () as $aAnnuaire ) {
			$aff .= '<option value="' . $aAnnuaire->getID () . '"' . ($i == ($aAnnuaire->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aAnnuaire->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}

?>