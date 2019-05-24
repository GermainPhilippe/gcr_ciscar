<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class TypeMembreBNListeView {
	private $myTypeMembreBNListe;

	function __construct($aTypeMembreBNListe)
	{
		$this->myTypeMembreBNListe = $aTypeMembreBNListe;
	}
	function TypeMembreBNListeView($aTypeMembreBNListe) {
		self::__construct($aTypeMembreBNListe);
	}
	
	function render_option($i) {
		$aff = '<select name="TypeMembreBNID">';

		foreach ( $this->myTypeMembreBNListe->getTypeMembreBNListe () as $aMarque ) {
			$aff .= '<option value="' . $aMarque->getID () . '"' . ($i == ($aMarque->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aMarque->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty($i) {
		$aff = '<select name="TypeMembreBNID"><option value="0" SELECTED=SELECTED></option>';

		foreach ( $this->myTypeMembreBNListe->getTypeMembreBNListe () as $aMarque ) {
			$aff .= '<option value="' . $aMarque->getID () . '"' . ($i == ($aMarque->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aMarque->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}
?>