<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class Simple_LCAGroupeListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		// Navigation bar
		$aff = '<div id="FilAriane"><a href="../../index.php?menu=1">Général</a>&nbsp;>&nbsp;LCA</div><br/><br/>';

		// Tableau
		$aff .= '<table cellspacing="1" cellpadding="0" class="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><b>#</b></td>';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center" width="50"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myList->getList () as $aSimple_LCAGroupe ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aSimple_LCAGroupe->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aSimple_LCAGroupe->getLibelle () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=m&id=' . $aSimple_LCAGroupe->getID () . '"><img src="../../include/images/voir.jpg" width="16" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table>';
		echo $aff;
	}
}
?>