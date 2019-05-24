<?php
class ExportRequestCollectionView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=2">Admin</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">Export</a>' . "\n";
		$aff .= '</div><br/><br/>' . "\n";

		$aff .= '<input type="button" onclick="document.location.href=\'?action=new\'" value="Nouveau">';

		$aff .= '<table id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td>Nom</td>';
		$aff .= '<td width="150" colspan="3">Action</td>';
		$aff .= '</tr>';

		foreach ( $this->myList as $aExportRequest ) {
			$aff .= '<tr>';
			$aff .= '<td>' . $aExportRequest->getName () . '</td>';
			$aff .= '<td width="50" align="center"><a href="view.php?id=' . $aExportRequest->getID () . '"><img src="../../include/images/apercu.jpg" border=0/></a></td>';
			$aff .= '<td width="50" align="center"><a href="?action=update&id=' . $aExportRequest->getID () . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
			$aff .= '<td width="50" align="center"><a href="#" onclick="confirmDelete(' . $aExportRequest->getID () . ')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table>';
		echo $aff;
	}
}
?>