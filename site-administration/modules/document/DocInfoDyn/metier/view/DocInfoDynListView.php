<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}

	// ###
	public function render() {

		// Navigation bar
		$aff = '<b><a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;DocInfoDyn</b><br/><br/>';

		// button bar
		// $aff .= '<a href="?action=new"><img src="../../../include/images/bt/bt_nouveau.jpg" border="0"/></a><br/><br/>';
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=new\'" /><br/><br/>';

		// List
		$aff .= '<table border="1" class="list"  >';

		$aff .= '<tr class="title">';
		$aff .= '	<td>#</td>';
		$aff .= '	<td>Titre</td>';
		$aff .= '	<td width="100" colspan="2">Action</td>';
		$aff .= '</tr>';

		$i = 0;
		foreach ( $this->myList as $aType ) {
			// Type
			$aff .= '<tr>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' . $aType->getID () . '</td>';
			$aff .= '	<td  class="' . ($i == 0 ? 'row1' : 'row2') . '">' . stripslashes ( $aType->getTitre () ) . '</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=edit&id=' . $aType->getID () . '"><img src="../../../include/images/document_edit.png" border=0/></a></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=delete&id=' . $aType->getID () . '"><img src="../../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>';

			$i = $i == 0 ? 1 : 0;
		}

		$aff .= '</table>';

		echo $aff;
	}
}
?>