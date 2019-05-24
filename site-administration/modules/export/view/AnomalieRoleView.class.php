<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class AnomalieRoleView implements DefaultListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}

	// ###
	public function renderHTML() {
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../?menu=1">Général</a>&nbsp;>&nbsp;<a href="?">Export</a>&nbsp;>&nbsp;Anomalie R&ocirc;le sans Domaine d\'activit&eacute; / Fonction';
		$aff .= '</div><br/><br/>';

		$aff .= '<table cellspacing="1" width="100%" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><b>#</b></td>';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center"><b>Pr&eacute;nom</b></td>';
		$aff .= '<td align="center"><b>Raison Sociale</b></td>';
		$aff .= '<td align="center" width="50"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myList as $aRow ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aRow [0] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aRow [1] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aRow [2] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aRow [3] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="../role/?action=e&id=' . $aRow [0] . '" target="_BLANK"><img src="../../include/images/voir.jpg" width="16" border="0"/></a></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}
		if (count ( $this->myList ) == 0) {
			$aff .= '<tr>';
			$aff .= '<td colspan="5"><i>Pas de r&ocirc;le trouv&eacute;</i></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table></div>';
		echo $aff;
	}
}
?>