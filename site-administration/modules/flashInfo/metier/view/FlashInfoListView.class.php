<?php
class FlashInfoListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;Flash Info' . "\n";
		$aff .= '</div><br/><br/>' . "\n";

		// Liste de boutons
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=new\';"/><br/><br/>' . "\n";

		$aff .= '<table id="TableList">' . "\n";
		$aff .= '<tr class="title">';
		$aff .= '<td width="50">#</td>';
		$aff .= '<td>Nom</td>';
		$aff .= '<td width="100">Date Debut</td>';
		$aff .= '<td width="100">Date Fin</td>';
		$aff .= '<td width="100" colspan="2">Actions</td>';
		$aff .= '</tr>' . "\n";

		foreach ( $this->myList as $aFlashInfo ) {
			$aff .= '<tr>';
			$aff .= '<td align="center">' . $aFlashInfo->getID () . '</td>';
			$aff .= '<td>' . $aFlashInfo->getNom () . '</td>';
			$aff .= '<td align="center">' . CommunFunction::getDateFR ( $aFlashInfo->getDateDebut () ) . '</td>';
			$aff .= '<td align="center">' . CommunFunction::getDateFR ( $aFlashInfo->getDateFin () ) . '</td>';
			$aff .= '<td width="50" align="center"><a href="?action=update&id=' . $aFlashInfo->getID () . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
			$aff .= '<td width="50" align="center"><a href="#" onclick="confirmDelete(' . $aFlashInfo->getID () . ')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>' . "\n";
		}

		$aff .= '</table>' . "\n";
		echo $aff;
	}
}
?>