<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage document
 * @version 1.0.4
 */
class DocZoomListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	
	// ###
	public function renderHTML() {
		$aff = '<table width="215" style="font-size:12px;color:#000000;font-family:arial;" cellpadding="0" cellspacing="0">';
		$aff .= '<tr><td style="width:200px;height:40px;background:transparent url(\'../../include/images/kit/Zoom_210.jpg\') no-repeat;color:#FFFFFF;font-weight:bold;text-align:center;">ZOOM</td></tr>';
		
		if (count ( $this->myList )) {
			foreach ( $this->myList as $aDoc ) {
				$aff .= '<tr>';
				$aff .= '<td style="padding:5px;"><a href="?action=doc&id=' . $aDoc->getDocInfoDynID () . '" style="text-decoration:none;color:#000000;"><b>' . stripslashes ( $aDoc->getTitre () ) . '</b></a></td>';
				$aff .= '</tr>';
				$aff .= '<tr><td style="padding:5px;">';
				$aff .= stripslashes ( $aDoc->getAccroche () );
				$aff .= '</td></tr>';
				if ($aDoc->getImagePortail () != '') {
					$aff .= '<tr><td align="center" style="padding:5px;">';
					$aff .= '<a href="?action=doc&id=' . $aDoc->getDocInfoDynID () . '" style="text-decoration:none;"><img src="' . $aDoc->getImagePortail () . '" border="0"/></a>';
					$aff .= '</td></tr>';
				}
				$aff .= '<tr><td><hr size="1" style="color:#CCCCCC;"></td></tr>';
			}
		} else {
			$aff .= '<tr>';
			$aff .= '	<td>';
			$aff .= '		<i>Pas de doc au Zoom</i>';
			$aff .= '	<td>';
			$aff .= '</td>';
		}
		$aff .= '</table>';
		
		return $aff;
	}
	
	/**
	 *
	 * @deprecated Enter description here ...
	 */
	public function renderHTML2() {
		$aff = '<table width="100%">';
		
		$aff .= '<tr>';
		$aff .= '	<td>';
		$aff .= '		<img src="include/images/ciscar/modeConnecte/Zoom.gif"/>';
		$aff .= '	<td>';
		$aff .= '</td>';
		
		if (count ( $this->myList )) {
			foreach ( $this->myList as $aDoc ) {
				
				$aff .= '<tr>';
				$aff .= '	<td class="vType">';
				$aff .= '		<b><a href="?action=doc&id=' . $aDoc->getDocInfoDynID () . '"><font color="#1F007F" size="1" face="Arial">' . stripslashes ( $aDoc->getTitre () ) . '</font></a></b>';
				$aff .= '	<br/>';
				if ($aDoc->getImagePortail () != '') {
					$aff .= '<img src="' . $aDoc->getImagePortail () . '"/>';
				}
				$aff .= '	<br/>';
				$aff .= '<font size="1" face="Arial" color="#000000">' . stripslashes ( $aDoc->getAccroche () ) . '</font>';
				$aff .= '	<hr>';
				$aff .= '	<td>';
				$aff .= '</td>';
			}
		} else {
			$aff .= '<tr>';
			$aff .= '	<td>';
			$aff .= '		<i>Pas de doc au Zoom</i>';
			$aff .= '	<td>';
			$aff .= '</td>';
		}
		$aff .= '</table>';
		
		return $aff;
	}
}
?>