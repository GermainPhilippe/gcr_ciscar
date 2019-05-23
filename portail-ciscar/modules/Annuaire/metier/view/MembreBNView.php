<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage annuaire
 * @version 1.0.4
 */
class MembreBNView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		$aff = '<img src="include/images/LeBN.jpg"/><br/><br/>';
		
		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '	<td colspan="2"><img src="include/images/t_mem1.gif"/></td>';
		$aff .= '</tr>';
		
		foreach ( $this->myList as $aIndividu ) {
			$aff .= '<tr>';
			$aff .= '	<td><a href="?action=individu&id=' . $aIndividu [0] . '"><font face="Arial" size="2" style="color:#930511">' . $aIndividu [1] . ' ' . $aIndividu [2] . '</font></a></td>';
			$aff .= '	<td><font face="Arial" size="2" style="color:#000000">' . $aIndividu [5] . '</font></td>';
			$aff .= '</tr>';
			
			$aff .= '<tr>';
			$aff .= '	<td>Tel : ' . $aIndividu [4] . '</td>';
			$aff .= '	<td>&nbsp;</td>';
			$aff .= '</tr>';
			
			$aff .= '<tr>';
			$aff .= '	<td><a href="mailto://' . $aIndividu [3] . '">' . $aIndividu [3] . '</a></td>';
			$aff .= '	<td>&nbsp;</td>';
			$aff .= '</tr>';
			
			$aff .= '<tr>';
			$aff .= '	<td>&nbsp;</td>';
			$aff .= '	<td>&nbsp;</td>';
			$aff .= '</tr>';
		}
		
		$aff .= '</table>';
		
		$aff .= '<p align="center">';
		// $aff .= '<a href="javascript:history.back()"><img src="include/images/BtRevenir.gif" border="0"/></a>';
		// $aff .= '<a href="?"><img src="include/images/RetourUne.gif" border="0"/></a>';
		$aff .= '<a href="javascript:window.print()"><img src="include/images/kit/bout_imprimer.jpg" border="0"/></a>';
		$aff .= '</p>';
		
		return $aff;
	}
}
?>