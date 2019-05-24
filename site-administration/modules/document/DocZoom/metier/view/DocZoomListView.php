<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocZoomListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function render() {
		// Navigation bar
		$aff = '<div id="FilAriane"><a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;DocZoom</div><br/><br/>';

		// List
		$aff .= '<table id="TableList" style="width:100%">';
		$aff .= '<thead>';
		$aff .= '<tr class="title">';
		$aff .= '	<th><a href="?column=1&order=' . ((isset ( $_GET ['column'] ) && isset ( $_GET ['order'] ) && $_GET ['column'] == '1') ? ($_GET ['order'] == 'a' ? 'z' : 'a') : 'a') . '">Titre</a></th>';
		$aff .= '	<th><a href="?column=2&order=' . ((isset ( $_GET ['column'] ) && isset ( $_GET ['order'] ) && $_GET ['column'] == '2') ? ($_GET ['order'] == 'a' ? 'z' : 'a') : 'a') . '">Num&eacute;ro Ordre</a></th>';
		$aff .= '	<th width="100"><a href="?column=3&order=' . ((isset ( $_GET ['column'] ) && isset ( $_GET ['order'] ) && $_GET ['column'] == '3') ? ($_GET ['order'] == 'a' ? 'z' : 'a') : 'a') . '">Publication</a></th>';
		$aff .= '	<th width="100"><a href="?column=4&order=' . ((isset ( $_GET ['column'] ) && isset ( $_GET ['order'] ) && $_GET ['column'] == '4') ? ($_GET ['order'] == 'a' ? 'z' : 'a') : 'a') . '">Date Cr&eacute;ation</a></th>';
		$aff .= '	<th width="100" colspan="2">Action</th>';
		$aff .= '</tr>';
		$aff .= '</thead>';
		$aff .= '<tbody>';
		$i = 0;
		foreach ( $this->myList as $aDocZoom ) {
			// Type
			$aff .= '<tr>';
			$aff .= '	<td align="left" class="' . ($i == 0 ? 'row1' : 'row2') . '">' . stripslashes ( $aDocZoom->getTitre () ) . '</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center">' . stripslashes ( $aDocZoom->getNumOrdre () ) . '</td>';
			if ($aDocZoom->getPublication () == '0') {
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center">-</td>';
			} else {
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center"><img src="../../../include/images/CheckOK.jpg"/></td>';
			}
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center">' . CommunFunction::getDateFR ( $aDocZoom->getDateCreationDocInfoDyn () ) . '</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=edit&id=' . $aDocZoom->getID () . '"><img src="../../../include/images/document_edit.png" border=0/></a></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="#" onclick="confirmDelete(' . $aDocZoom->getID () . ')"><img src="../../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>';

			$i = $i == 0 ? 1 : 0;
		}
		$aff .= '</tbody>';
		$aff .= '</table>';

		echo $aff;
	}
}
?>