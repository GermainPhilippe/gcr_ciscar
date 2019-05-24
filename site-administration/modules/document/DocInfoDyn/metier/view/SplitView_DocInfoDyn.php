<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class SplitView_DocInfoDyn {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}

	// ###
	public function renderHTML() {
		$aff = '<table width="100%" id="TableList" class="sortable">';
		$aff .= '<thead>';
		$aff .= '<tr class="title">';
		$aff .= '	<th><b>Titre</b></th>';
		$aff .= '	<th><b>Date D&eacute;but</b></th>';
		$aff .= '	<th><b>Date Fin</b></th>';
		$aff .= '	<th width="100" colspan="2"><b>Action</b></th>';
		$aff .= '</tr>';
		$aff .= '</thead>';
		$aff .= '<tbody>';
		$aff .= '<tr>';
		$aff .= '	<td colspan="5" align="center"><i>' . count ( $this->myList->getList () ) . ' document(s) trouv&eacute;(s)</i></td>';
		$aff .= '</tr>';
		echo $aff;
		$i = 0;
		foreach ( $this->myList->getList () as $aDocument ) {
			$aff = '<tr>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' .  $aDocument->getTitre ()  . '</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="100" align="center">' . ($aDocument->getDateDebut () == '' ? '&nbsp;' : CommunFunction::getDateFR ( $aDocument->getDateDebut () )) . '</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="100" align="center">' . ($aDocument->getDateFin () == '' ? '&nbsp;' : CommunFunction::getDateFR ( $aDocument->getDateFin () )) . '</td>';
			if (isset ( $_GET ['add'] )) {
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="javascript:ok(' . $aDocument->getID () . ', \'' . htmlentities ( $aDocument->getTitre (), ENT_QUOTES ) . '\')"><img src="../../../include/images/ic_icon_exp.gif" border=0/></a></td>';
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center">&nbsp;</td>';
			} elseif (isset ( $_GET ['add2'] )) {
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="100" colspan="2" align="center"><a href="javascript:addElement(' . $aDocument->getID () . ', \'' . htmlentities ( $aDocument->getTitre (), ENT_QUOTES ) . '\')"><img src="../../../include/images/add.png" border=0/></a></td>';
			} else {
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=edit&id=' . $aDocument->getID () . '"><img src="../../../include/images/document_edit.png" border=0/></a></td>';
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="#" onclick="confirmDelete(' . $aDocument->getID () . ')"><img src="../../../include/images/garbage_empty.png" border=0/></a></td>';
			}
			$aff .= '</tr>';
			echo $aff;
			$i = ($i == 0 ? 1 : 0);
		}
		$aff .= '</tbody>';
		$aff = '</table>';
		echo $aff;

		$aff = '<script type="text/javascript">';
		$aff .= '$(document).ready(function()';
		$aff .= '{ ';
		$aff .= '	$(".sortable").tablesorter();';
		$aff .= '});';
		$aff .= '</script>';
		echo $aff;
	}
}
?>