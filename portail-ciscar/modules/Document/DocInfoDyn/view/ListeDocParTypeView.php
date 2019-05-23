<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage document
 * @version 1.0.4
 */
class ListeDocParTypeView {
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
		
		if (count ( $this->myList ) == 0) {
			$aff .= '<p>Aucune publication ne correspond &agrave; votre s&eacute;lection.</p>';
		} else {
			foreach ( $this->myList as $aDoc ) {
				$aff .= '<table width="95%">';
				$aff .= '<tr><td colspan="2"><a href="?action=doc&id=' . $aDoc->getID () . '" style="color:#000;font-weight:bold;text-decoration:none;">' . stripslashes ( $aDoc->getTitre () ) . '</a></td></tr>';
				$aff .= '<tr><td colspan="2" style="color:#000;font-size:12;">' . stripslashes ( $aDoc->getAccroche () ) . '</td></tr>';
				$aff .= '<tr><td style="color:#000;font-size:12;">(' . $aDoc->getDateFR ( $aDoc->getDateCreation () ) . ')</td>';
				$aff .= '<td align="right"><a href="?action=doc&id=' . $aDoc->getID () . '" style="color:#000;"><img src="include/images/kit/btn_detail.jpg"/></a></td></tr>';
				$aff .= '</table><br/>';
				$aff .= '<hr size="1" style="color:#CCCCCC;">';
			}
		}
		
		return $aff;
	}
}
?>