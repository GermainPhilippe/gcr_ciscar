<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage annuaire
 * @version 1.0.4
 */
class DelegationView {
	public function __construct() {
	}
	public function renderHomeHTML() {
		$aff = '<img src="include/images/DelegationsRegionales.jpg"/><br/><br/>';
		
		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '	<td><img src="include/images/Puce.gif"/></td>';
		$aff .= '	<td><a href="?action=FonctionDelegation"><font face="Arial" size="2" style="color:#930511">Présidents et Vice-Présidents des Délégations Régionales</font></a></td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td><img src="include/images/Puce.gif"/></td>';
		$aff .= '	<td>Délégations Régionales</td>';
		$aff .= '</tr>';
		
		$aRegionEtablissement = new RegionEtablissement ();
		foreach ( $aRegionEtablissement->SQL_SELECT_ALL () as $aRegion ) {
			$aff .= '<tr>';
			$aff .= '	<td>&nbsp;</td>';
			$aff .= '	<td><a href="?action=DelegationRegionnale&id=' . $aRegion->getID () . '">' . $aRegion->getNom () . '</a></td>';
			$aff .= '</tr>';
		}
		
		$aff .= '</table>';
		return $aff;
	}
	public function rendreParDelegationHTML($aList) {
		$aff = '<img src="include/images/DelegationsRegionales.jpg"/><br/><br/>';
		
		$aff .= '<table>';
		
		foreach ( $aList as $aIndividu ) {
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