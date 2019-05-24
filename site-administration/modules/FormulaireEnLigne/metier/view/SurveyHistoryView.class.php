<?php
class SurveyHistoryView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">Formulaire en ligne</a>&nbsp;>&nbsp;Historique';
		$aff .= '</div><br/><br/>';

		$aff .= '<table style="width:100%;">';
		$aff .= '<tr id="root" style="height:30px;font-size:11px;font-weight:bold;text-align:center;background-color:#D4D4D4;background-image: url(\'../../include/images/bt/ligne.jpg\');">';
		$aff .= '	<td width="200">Date</td>';
		$aff .= '	<td>Description</td>';
		$aff .= '</tr>';

		$row1 = ' style="background-color:#F4F4F4;height:30px;font-size:11px;"';
		$row2 = ' style="background-color:#E8E8E8;height:30px;font-size:11px;"';
		$i = 0;
		if (count ( $this->myList ) > 0) {
			foreach ( $this->myList as $aSurveyHistory ) {
				$aff .= '<tr' . ($i == 0 ? $row1 : $row2) . '>';
				$aff .= '	<td align="center">' . $aSurveyHistory->getDateCreation () . '</td>';
				$aff .= '	<td>' . $aSurveyHistory->getDescription () . '</td>';
				$aff .= '</tr>';

				$i = $i == 0 ? 1 : 0;
			}
		}
		$aff .= '</table>';
		echo $aff;
	}
}
?>