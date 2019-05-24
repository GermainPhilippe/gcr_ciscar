<?php
class ConventionFormulaireListView {
	private $myList;
	public function __construct($list) {
		$this->myList = $list;
	}

	// ###
	public function renderHTML() {
		$aff = '<div id="FilAriane"><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;Formulaires</div><br/><br/>';

		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=new\'"/><br/><br/>';

		$aff .= '<table width="100%" id="TableList">';
		$aff .= '<tr class="title" bgcolor="#CCCCCC" style="background-image:url(\'../../include/images/ligne.jpg\');" height="25">';
		$aff .= '	<td align="center"><b>Nom</b></td>';
		$aff .= '	<td align="center" width="100"><b>Export Réponses</b></td>';
		$aff .= '	<td width="200" align="center" colspan="4"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myList as $formulaire ) {
			$aff .= '<tr>';
			$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $formulaire->getNom () ) . '</td>';
			$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="100"><a href="ReponseCSV.php?id=' . $formulaire->getID () . '"><img border="0" src="../../../../include/images/1299158886_page_white_excel.png"></a></td>';
			$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50" align="center"><a href="/convention/?form-preview=' . $formulaire->getID () . '" target="_BLANK"><img border="0" src="../../../../include/images/1299158947_preview_16x16.gif"></a></td>';
			$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=edit&id=' . $formulaire->getID () . '"><img border="0" src="../../../../include/images/document_edit.png"></a></td>';
			$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50" align="center"><a onclick="callDelete(' . $formulaire->getID () . ')"><img border="0" src="../../../../include/images/garbage_empty.png"></a></td>';
			$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=cloner&id=' . $formulaire->getID () . '"><img border="0" src="../../include/images/action_dupliquer.png"></a></td>';
			$aff .= '</tr>';
			$row = ($row == 1 ? 2 : 1);
		}
		$aff .= '</table>';

		$aff .= '<script type="text/javascript">';
		$aff .= 'function callDelete(id){';
		$aff .= '	if(confirm("Etes vous sûr de vouloir supprimer ce formulaire?")){document.location.href=\'?action=delete&id=\'+id;}';
		$aff .= '}';
		$aff .= '</script>';

		echo $aff;
	}
}
?>