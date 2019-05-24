<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class FonctionDAListView {
	private $myFonctionDAList;
	public function __construct($aFonctionDAList) {
		$this->myFonctionDAList = $aFonctionDAList;
	}
	public function renderOptionHTML() {
		$aff = '<option value="0" SELECTED=SELECTED></option>';
		foreach ( $this->myFonctionDAList->getList () as $aFonctionDA ) {
			$aff .= '<option value="' . $aFonctionDA->getID () . '">' . htmlentities ( $aFonctionDA->getLibelle (), ENT_QUOTES ) . '</option>';
		}
		echo $aff;
	}
}
?>