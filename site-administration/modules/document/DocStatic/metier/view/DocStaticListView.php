<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocStaticListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		$this->render ();
	}
	public function render() {
		// Navigation bar
		$aff = '<div id="FilAriane"><a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;DocStatic</div><br/><br/>';

		// button bar
		$aff .= '<input type="button" value="Nouveau" onclick="javascript:location.href=\'?action=new\'" /><br/><br/>';

		// List
		$aff .= '<table id="TableList" style="width:100%">';

		$aff .= '<tr class="title">';
		$aff .= '	<td width="50">#</td>';
		$aff .= '	<td>Titre</td>';
		$aff .= '	<td width="100" colspan="2">Action</td>';
		$aff .= '</tr>';

		$i = 0;
		foreach ( $this->myList as $aDocStatic ) {
			// Type
			$aff .= '<tr>';
			$aff .= '	<td align="center" class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50">' . $aDocStatic->getID () . '</td>';
			$aff .= '	<td align="center" class="' . ($i == 0 ? 'row1' : 'row2') . '">' . stripslashes ( $aDocStatic->getTitre () ) . '</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=edit&id=' . $aDocStatic->getID () . '"><img src="../../../include/images/document_edit.png" border=0/></a></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="#" onclick="Form.DocStatic.confirmDelete(' . $aDocStatic->getID () . ')"><img src="../../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>';

			$i = $i == 0 ? 1 : 0;
		}

		$aff .= '</table>';

		echo $aff;
	}
}
?>