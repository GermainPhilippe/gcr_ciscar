<?php
class ConventionPageListView {
	private $listPage;
	public function __construct($list) {
		$this->listPage = $list;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane"><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;Page</div><br/><br/>';

		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=new\'"/><br><br>';
		$aff .= '<table width="100%" id="TableList">';
		$aff .= '<tr class="title" bgcolor="#CCCCCC" style="background-image:url(\'../../include/images/ligne.jpg\');" height="25">';
		$aff .= '<td align="center"><b>Titre</b></td>';
		$aff .= '<td align="center" colspan="3" width="150"><b>Actions</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->listPage as $page ) {
			$aff .= '<tr>';
			$aff .= '<td class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $page->getTitle () ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a href="/convention/?p=' . $page->getId () . '" target="_BLANK"><img src="../../../../include/images/1299158947_preview_16x16.gif" border="0"></a></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a href="?action=edit&id=' . $page->getId () . '"><img src="../../../../include/images/document_edit.png" border="0"></a></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a href="?action=delete&id=' . $page->getId () . '"><img src="../../../../include/images/garbage_empty.png" border="0"></a></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table>';

		echo $aff;
	}
}