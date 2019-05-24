<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocPartenaireListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function render() {

		// Navigation Bar
		$aff = '<div id="FilAriane"><a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;DocPartenaire</div><br/>';

		$aff .= '<input type="button" value="Nouveau" onclick="javascript:location.href=\'?action=new\'" /><br/><br/>';

		// List
		$aff .= '<table id="TableList" style="width:100%">';
		$aff .= '<thead><tr class="title">';
		$aff .= '	<td width="50"><a href="?column=1&order=' . ((isset ( $_GET ['column'] ) && isset ( $_GET ['order'] ) && $_GET ['column'] == '1') ? ($_GET ['order'] == 'a' ? 'z' : 'a') : 'a') . '">#</a></td>';
		$aff .= '	<td><a href="?column=2&order=' . ((isset ( $_GET ['column'] ) && isset ( $_GET ['order'] ) && $_GET ['column'] == '2') ? ($_GET ['order'] == 'a' ? 'z' : 'a') : 'a') . '">Nom</a></td>';
		$aff .= '	<td width="50"><a href="?column=3&order=' . ((isset ( $_GET ['column'] ) && isset ( $_GET ['order'] ) && $_GET ['column'] == '3') ? ($_GET ['order'] == 'a' ? 'z' : 'a') : 'a') . '">Actif</a></td>';
		$aff .= '	<td width="50">Page(s)</td>';
		$aff .= '	<td width="100" colspan="2">Action</td>';
		$aff .= '</tr></thead>';
		$i = 0;
		foreach ( $this->myList as $aPartaire ) {
			$aff .= '<tbody><tr>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center">' . $aPartaire->getID () . '</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center">' . $aPartaire->getNom () . '</td>';
			if ($aPartaire->getPublication () == '0') {
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center">-</td>';
			} else {
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center"><img src="../../../include/images/CheckOK.jpg"/></td>';
			}
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="../DocPartenairePage/?action=view&id=' . $aPartaire->getID () . '"><img src="../../../include/images/voir.jpg" width="16" ALT="Gestion Page" border=0/></a></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=edit&id=' . $aPartaire->getID () . '"><img src="../../../include/images/document_edit.png" ALT="Modification" border=0/></a></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="#" onclick="confirmDelete(' . $aPartaire->getID () . ')"><img src="../../../include/images/garbage_empty.png" ALT="Suppression" border=0/></a></td>';
			$aff .= '</tr></tbody>';

			$i = $i == 0 ? 1 : 0;
		}
		$aff .= '</table>';

		echo $aff;
	}
}
?>