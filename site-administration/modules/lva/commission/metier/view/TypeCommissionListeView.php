<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class TypeCommissionListeView {
	private $myTypeCommissionListe;

	function __construct($aTypeCommissionListe)
	{
		$this->myTypeCommissionListe = $aTypeCommissionListe;
	}
	function TypeCommissionListeView($aTypeCommissionListe) {
		self::__construct($aTypeCommissionListe);
	}
	
	function render_option($i) {
		$aff = '<select name="TypeCommissionID" onchange="Form.CommissionGroupeTravail.ShowCommissionNational(this.value)">';

		foreach ( $this->myTypeCommissionListe->getTypeCommissionListe () as $aTypeCommission ) {
			$aff .= '<option value="' . $aTypeCommission->getID () . '"' . ($i == ($aTypeCommission->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aTypeCommission->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty($i) {
		$aff = '<select name="TypeCommissionID"><option value="0" SELECTED=SELECTED></option>';

		foreach ( $this->myTypeCommissionListe->getTypeCommissionListe () as $aTypeCommission ) {
			$aff .= '<option value="' . $aTypeCommission->getID () . '"' . ($i == ($aTypeCommission->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aTypeCommission->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}

?>