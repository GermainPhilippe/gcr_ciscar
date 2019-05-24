<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class GroupeLCAListeView {
	private $myGroupeLCAListe;

	function __construct($aGroupeLCAListe)
	{
		$this->myGroupeLCAListe = $aGroupeLCAListe;
	}
	function GroupeLCAListeView($aGroupeLCAListe) {
		self::__construct($aGroupeLCAListe);
	}

	function render() {
		// Navigation bar
		$aff = '<div id="FilAriane"><a href="../../index.php">Général</a>&nbsp;>&nbsp;LCA</div><br/><br/>';

		// Tableau
		$aff .= '<table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><b>#</b></td>';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center" width="50"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myGroupeLCAListe->getGroupeListe () as $aGroupeLCA ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aGroupeLCA->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aGroupeLCA->getName () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=m&id=' . $aGroupeLCA->getID () . '"><img src="../../include/images/voir.jpg" width="16" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table>';
		echo $aff;
	}
}

?>