<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class TypeGroupeListeView {
	private $myTypeGroupeListe;

	function __construct($aTypeGroupeListe)
	{
		$this->myTypeGroupeListe = $aTypeGroupeListe;
	}
	function TypeGroupeListeView($aTypeGroupeListe) {
		self::__construct($aTypeGroupeListe);
	}
	
	function render_option($i) {
		$aff = '<select name="TypeGroupeID">';

		foreach ( $this->myTypeGroupeListe->getTypeGroupeListe () as $aMarque ) {
			$aff .= '<option value="' . $aMarque->getID () . '"' . ($i == ($aMarque->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aMarque->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}

?>