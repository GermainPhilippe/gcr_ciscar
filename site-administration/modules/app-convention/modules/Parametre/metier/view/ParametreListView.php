<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Parametre
 * @version 1.0.4
 */
class ParametreListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		$aff = '<b><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;Parametres</b><br/><br/>';
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=new\'"/><br/><br/>';

		$aff .= '<table border="1" width="100%">';
		$aff .= '<tr>';
		$aff .= '	<td align="center" width="50"><b>#</b></td>';
		$aff .= '	<td align="center"><b>Nom</b></td>';
		$aff .= '	<td width="100" align="center" colspan="2"><b>Action</b></td>';
		$aff .= '</tr>';

		foreach ( $this->myList->getList () as $aParametre ) {
			$aff .= '<tr>';
			$aff .= '	<td align="center" width="50">' . $aParametre->getID () . '</td>';
			$aff .= '	<td>' . $aParametre->getNom () . '</td>';
			$aff .= '	<td width="50" align="center"><a href="?action=edit&id=' . $aParametre->getID () . '"><img src="../../../../include/images/document_edit.png" border="0"/></a></td>';
			$aff .= '	<td width="50" align="center"><a href="?action=delete&id=' . $aParametre->getID () . '"><img src="../../../../include/images/garbage_empty.png" border="0"/></a></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table>';

		echo $aff;
	}
}
?>