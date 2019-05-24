<?php
/**
 *  @author Florent DESPIERRES
 * @package site-administration
 * @subpackage commun
 * @version 1.0.4
 */
class CommunFunction {
	public static function getDateFR($DateEN) {
		$tab = preg_split ( "/-+/", $DateEN, 3 );
		return $tab [2] . '/' . $tab [1] . '/' . $tab [0];
	}
	public static function getDateUS($DateFR) {
		$tab = preg_split ( "/[-\.\/ ]/", $DateFR, 3 );
		return $tab [2] . '-' . $tab [1] . '-' . $tab [0];
	}
	public static function goToURL($URL) {
		$aff = '<script type="text/javascript">';
		$aff .= '	document.location.href="' . $URL . '";';
		$aff .= '</script>';
		return $aff;
	}
	public static function displayAlert($Message) {
		$aff = '<script type="text/javascript">';
		$aff .= '	alert("' . $Message . '");';
		$aff .= '</script>';
		return $aff;
	}
	public static function displayConfirm($Message, $URL) {
		$aff = '<script type="text/javascript">';
		$aff .= '	if(confirm("' . $Message . '"))';
		$aff .= '	{';
		$aff .= '		location.href="' . $URL . '"';
		$aff .= '	}';
		$aff .= '</script>';
		return $aff;
	}
}
?>