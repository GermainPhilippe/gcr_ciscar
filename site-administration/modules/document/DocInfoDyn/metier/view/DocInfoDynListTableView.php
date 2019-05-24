<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynListTableView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}

	// ###
	public function render() {
		// Navigation Bar
		echo '<b><a href="../../../?">Wen Content</a>&nbsp;>&nbsp;DocInfoDyn</b><br/><br/>';

		// Button Bar
		echo '<input type="button" value="Nouveau" onclick="javascript:location.href=\'?action=new\'" /><br/><br/>';
		// echo '<a href="?action=new"><img src="../../../include/images/bt/bt_nouveau.jpg" border=0></a><br/><br/>';

		// List
		echo '<table class="list" >';
		echo '<tr class="title">';
		echo '	<td>Titre</td>';
		echo '	<td colspan="2" width="100">Action</td>';
		echo '</tr>';

		$i = 0;
		foreach ( $this->myList->getList () as $aType ) {
			$aff = '<tr>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' . stripslashes ( $aType->getTitre () ) . '</td>';
			$aff .= '	<td  class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=edit&id=' . $aType->getID () . '"><img src="../../../include/images/document_edit.png" border=0/></a></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=delete&id=' . $aType->getID () . '"><img src="../../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>';
			echo $aff;
			$i = $i == 0 ? 1 : 0;
		}
		echo '</table>';
	}
}
?>
