<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class LCAGroupeListView {
	private $myListSysteme;
	private $myListPerso;
	public function __construct($aListSysteme, $aListPerso) {
		$this->myListSysteme = $aListSysteme;
		$this->myListPerso = $aListPerso;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane"><a href="../../index.php?menu=1">Général</a>&nbsp;>&nbsp;LCA</div><br/><br/>';

		// LCA Groupe Systeme
		$aff .= '<table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td colspan="2">Groupe LCA Syst&egrave;me</td>';
		$aff .= '<td align="center" width="50"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myListSysteme->getList () as $aSimple_LCAGroupe ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50">' . $aSimple_LCAGroupe->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aSimple_LCAGroupe->getLibelle () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=m&id=' . $aSimple_LCAGroupe->getID () . '"><img src="../../include/images/voir.jpg" width="16" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table><br/><br/>';

		// LCA Groupe Personnalise
		$aff .= '<p><input type="button" value="Nouveau" onclick="location.href=\'?action=new\'"/></p>';
		$aff .= '<table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td colspan="2">Groupe LCA Personnalis&eacute;</td>';
		$aff .= '<td align="center" width="50" colspan="3"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myListPerso->getList () as $aSimple_LCAGroupe ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50">' . $aSimple_LCAGroupe->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aSimple_LCAGroupe->getLibelle () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=m&id=' . $aSimple_LCAGroupe->getID () . '"><img src="../../include/images/voir.jpg" width="16" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=edit&id=' . $aSimple_LCAGroupe->getID () . '"><img src="../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmDelete(' . $aSimple_LCAGroupe->getID () . ')"><img src="../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}
		$aff .= '</table>';
		echo $aff;
	}
}
?>