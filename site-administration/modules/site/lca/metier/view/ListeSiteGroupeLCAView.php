<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class ListeSiteGroupeLCAView {
	private $mySiteGroupeLCAListe;
	
	function __construct($aSiteGroupeLCAListe)
	{
		$this->mySiteGroupeLCAListe = $aSiteGroupeLCAListe;
	}
	function ListeSiteGroupeLCAView($aSiteGroupeLCAListe) {
		self::__construct($aSiteGroupeLCAListe);
	}
	function render() {
		// Navigation bar
		$aff = '<b><a href="../../../index.php">Admin</a>&nbsp;>&nbsp;<a href="index.php">LCA Individu</a></b><br/><br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" class="liste">';
		$aff .= '<tr class="titre">';
		$aff .= '<td align="center" width="50"><b>#</b></td>';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center" width="50"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->mySiteGroupeLCAListe->getSiteGroupeLCAListe () as $aSiteGroupeLCA ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aSiteGroupeLCA->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aSiteGroupeLCA->getName () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=m&id=' . $aSiteGroupeLCA->getID () . '"><img src="../../../include/images/voir.jpg" width="16" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table></div>';
		echo $aff;
	}
}