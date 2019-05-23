<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage document
 * @version 1.0.4
 */
class ListeThemePourUnType {
	private $myList;
	private $myCatType;
	public function __construct($aList, $CatType) {
		$this->myList = $aList;
		$this->myCatType = $CatType;
	}
	public function getCatType() {
		return $this->myCatType;
	}
	public function setCatType($newValue) {
		$this->myCatType = $newValue;
	}
	
	// ###
	public function render() {
		$aff = '<table width="100%">';
		$aff .= '<tr><td colspan="2" valign="middle" style="padding-left:20px;background:#515153;color:#FFFFFF;font-weight:bold;height:30px;">' . ucfirst ( strtolower ( stripslashes ( $this->myCatType->getDescription () ) ) ) . '</td></tr>';
		$aff .= '</table>';
		$aff .= '<br/>';
		
		$aff .= '<table>';
		foreach ( $this->myList as $aTheme ) {
			$aff .= '<tr>';
			$aff .= '<td width="30"><img src="include/images/kit/PuceGrise.png"/></td>';
			$aff .= '<td><a href="?action=type&id=' . $this->myCatType->getID () . ',' . $aTheme->getID () . '" style="text-decoration:none;color:#000;">' . stripslashes ( $aTheme->getDescription () ) . '</a></td>';
			$aff .= '</tr>';
			$aff .= '<tr><td colspan="2">&nbsp;</td></tr>';
		}
		$aff .= '</table>';
		
		return $aff;
	}
}
?>