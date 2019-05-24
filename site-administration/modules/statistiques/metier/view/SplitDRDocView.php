<?php
/**
 * Vue utilisée dans la répartition par DR affichant le nombre de consultations par domaine pour un DR donné par mois/année
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 * @version 1.0.4
 */
class SplitDRDocView {
	private $myList;
	private $myTotal;
	private $myRegion;
	public function __construct($aList, $aTotal, $aRegion) {
		$this->myList = $aList;
		$this->myTotal = $aTotal;
		$this->myRegion = $aRegion;
	}
	/**
	 * Création du tableau pour une région donnée
	 */
	public function renderdomaine() {
		$aff = '';
		foreach ( $this->myList as $aCle => $aVerif ) {
			// Création du tableau
			$aConsult = new DomaineActivite ();
			$aConsult->select_name ( $aCle );
			$aff .= '<tr style="background-color:#F4F4F4;font-size:11px;height:30px;" class="DR-' . $this->myRegion . '" id="DOM-' . $this->myRegion . '-' . ($aCle != NULL ? $aCle : 'NULL') . '">';
			$aff .= '	<td " width="200"></td><td   class="row1" align="left" style="font-weight:bold;background-color:#F4F4F4;font-size:11px;height:30px;" ><img class="ImgDR-' . $this->myRegion . '" id="ImgDOM-' . $this->myRegion . '-' . ($aCle != NULL ? $aCle : 'NULL') . '" src="../../include/images/1.png"><a style="cursor:pointer" onclick="extend_da(\'' . $this->myRegion . '-' . ($aCle != NULL ? $aCle : 'NULL') . '\')">' . ($aCle != NULL ? utf8_encode ( $aConsult->getName () ) : 'Ind&eacute;fini') . '</a></b></td>';
			$aff .= '	<td  style="background-color:#F4F4F4;font-size:11px;height:30px;"></td><td    align="center" width="100" style="background-color:#F4F4F4;font-size:11px;height:30px;">' . $aVerif . '</td>';
			$aff .= '	<td    align="center" width="100" style="background-color:#F4F4F4;font-size:11px;height:30px;">';
			$aff .= round ( ($aVerif / $this->myTotal) * 100 );
			$aff .= '%</td>';
			$aff .= '</tr>';
		}

		echo $aff;
	}
}
?>