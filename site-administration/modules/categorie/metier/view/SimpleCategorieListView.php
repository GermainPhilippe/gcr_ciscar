<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage categorie
 * @version 1.0.4
 */
/*
 * Cette vue utilise ajax
 */
class SimpleCategorieListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		// Navigation Bar
		$aff = '<div id="FilAriane"><a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">Catégorie</a></div><br/>';

		// Button Bar
		$aff .= '<input type="button" value="Nouveau" onclick="javascript:location.href=\'?action=new\'"/><br/><br/>';

		// List
		$aff .= '<table id="TableList" class="sortable" style="width:100%">';
		$aff .= '<tr class="title">';
		$aff .= '	<td width="100">#</td>';
		$aff .= '	<td>Nom</td>';
		$aff .= '	<td width="50">Nb Document</td>';
		$aff .= '	<td colspan="2" width="100">Action</td>';
		$aff .= '</tr>';

		$i = 0;
		foreach ( $this->myList as $aType ) {
			// Type
			$nbdoc = $aType->getNbDocinfodyn ();

			$aff .= '<tr id="tr' . $aType->getID () . '">';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '"><table style="padding-left:0px;cursor: pointer; cursor: hand"><tr><td><a id="a' . $aType->getID () . '" onclick="expendCat(\'1\',\'' . $aType->getID () . '\')"><img src="../../include/images/1.png" id="ImgType' . $aType->getID () . '" border="0"/></a></td><td>' . $aType->getID () . '</td></tr></table></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center">' . $aType->getDescription () . '</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center">' . $nbdoc . '</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=edit&id=' . $aType->getID () . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="#" onclick="' . ($nbdoc > 0 ? 'NoDelete()' : 'confirmDelete(' . $aType->getID () . ')') . '"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>';
			$i = $i == 0 ? 1 : 0;
		}
		$aff .= '</table>';
		echo $aff;
	}
}
?>