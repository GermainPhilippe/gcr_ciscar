<?php
class SurveyQuestionCollectionView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">Formulaire en ligne</a>&nbsp;>&nbsp;Questions';
		$aff .= '</div>';
		$aff .= '<br/><input type="button" value="Nouveau" onclick="javascript:location.href=\'?action=newQuestion&id=' . $_GET ['id'] . '\'" /><br/><br/>';

		$aff .= '<table style="width:100%;">';
		$aff .= '<tr id="root" style="height:30px;font-size:11px;font-weight:bold;text-align:center;background-color:#D4D4D4;background-image: url(\'../../include/images/bt/ligne.jpg\');">';
		$aff .= '	<td width="50">#</td>';
		$aff .= '	<td>Nom</td>';
		$aff .= '	<td width="100">Type</td>';
		$aff .= '	<td colspan="2" width="100">Actions</td>';
		$aff .= '</tr>';

		$row1 = ' style="background-color:#F4F4F4;height:30px;font-size:11px;"';
		$row2 = ' style="background-color:#E8E8E8;height:30px;font-size:11px;"';
		$i = 0;
		if (count ( $this->myList ) > 0) {
			foreach ( $this->myList as $aSurveyQuestion ) {
				$aff .= '<tr' . ($i == 0 ? $row1 : $row2) . '>';
				$aff .= '	<td width="50" align="center">' . $aSurveyQuestion->getID () . '</td>';
				$aff .= '	<td>' . (substr ( stripcslashes ( $aSurveyQuestion->getDescription () ), 0, 50 ) . '...') . '</td>';
				$aff .= '	<td align="center">' . $aSurveyQuestion->getType () . '</td>';
				$aff .= '	<td width="50" align="center"><a href="?action=updateQuestion&id=' . $aSurveyQuestion->getID () . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
				$aff .= '	<td width="50" align="center"><a style="cursor:pointer;" onclick="confirmDelete(\'?action=deleteQuestion&id=' . $aSurveyQuestion->getID () . '\')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
				$aff .= '</tr>';

				$i = $i == 0 ? 1 : 0;
			}
		}
		$aff .= '</table>';
		echo $aff;
	}
}
?>