<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Parametre
 * @version 1.0.4
 */
class DomaineActiviteListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}

	// ###
	public function renderHTML() {
	}
	function renderOption2HTML($FieldName, $SelectedID) {
		$aff = '<select name="' . $FieldName . '">';
		$aff .= '<option value="0"' . ($SelectedID == 0 ? ' SELECTED=SELECTED' : '') . ' ></option>';

		foreach ( $this->myList->getList () as $aDomaineActivite ) {
			$aff .= '<option value="' . $aDomaineActivite->getID () . '"' . ($aDomaineActivite->getID () == $SelectedID ? ' SELECTED=SELECTED' : '') . '>' . stripslashes ( $aDomaineActivite->getLibelle () ) . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function renderOptionHTML($arrayI, $FieldName, $FieldID) {
		$aff = '<select class="DomaineActivite" size="20" name="' . $FieldName . '" id="' . $FieldID . '" multiple>';
		$aff .= '<option value="0"' . (count ( $arrayI ) == 0 || in_array ( 0, $arrayI ) ? ' SELECTED=SELECTED' : '') . ' ></option>';

		foreach ( $this->myList->getList () as $aDomaineActivite ) {
			$aff .= '<option value="' . $aDomaineActivite->getID () . '"' . (in_array ( $aDomaineActivite->getID (), $arrayI ) ? ' SELECTED=SELECTED' : '') . '>' . stripslashes ( $aDomaineActivite->getLibelle () ) . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}
?>