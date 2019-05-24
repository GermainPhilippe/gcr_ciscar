<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class TypeCelluleListeView {
	private $myTypeCelluleListe;

	function __construct($aTypeCelluleListe)
	{
		$this->myTypeCelluleListe = $aTypeCelluleListe;
	}
	function TypeCelluleListeView($aTypeCelluleListe) {
		self::__construct($aTypeCelluleListe);
	}
	
	function render_option($i) {
		$aff = '<select name="TypeCelluleID">';

		foreach ( $this->myTypeCelluleListe->getTypeCelluleListe () as $aMarque ) {
			$aff .= '<option value="' . $aMarque->getID () . '"' . ($i == ($aMarque->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aMarque->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty($i) {
		$aff = '<select name="TypeCelluleID"><option value="0" SELECTED=SELECTED></option>';

		foreach ( $this->myTypeCelluleListe->getTypeCelluleListe () as $aMarque ) {
			$aff .= '<option value="' . $aMarque->getID () . '"' . ($i == ($aMarque->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aMarque->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}
?>