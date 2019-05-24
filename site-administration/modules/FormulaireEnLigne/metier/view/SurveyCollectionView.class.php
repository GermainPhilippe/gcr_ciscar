<?php
class SurveyCollectionView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;Formulaire en ligne';
		$aff .= '</div>';
		$aff .= '<br/><input type="button" value="Nouveau" onclick="javascript:location.href=\'?action=newSurvey\'" /><br/><br/>';

		$aff .= '<table style="width:100%;" class="sortable">';
		$aff .= '<thead>';
		$aff .= '<tr id="root" style="height:30px;font-size:11px;font-weight:bold;text-align:center;background-color:#D4D4D4;background-image: url(\'../../include/images/bt/ligne.jpg\');">';
		$aff .= '	<th width="50">#</th>';
		$aff .= '	<th><a style="cursor:pointer;">Nom</a></th>';
		$aff .= '	<th width="100"><a style="cursor:pointer;">Date Création</a></th>';
		$aff .= '	<th width="100"><a style="cursor:pointer;">Statut</a></th>';
		$aff .= '	<th width="100"><a style="cursor:pointer;">Envoi Invitation</a></th>';
		$aff .= '	<th width="100"><a style="cursor:pointer;">Envoi Relance</a></th>';
		$aff .= '	<td colspan="7" width="350">Actions</td>';
		$aff .= '</tr>';
		$aff .= '</thead>';
		$row1 = ' style="background-color:#F4F4F4;height:30px;font-size:11px;"';
		$row2 = ' style="background-color:#E8E8E8;height:30px;font-size:11px;"';
		$i = 0;
		$aff .= '<tbody>';
		foreach ( $this->myList as $aSurvey ) {
			$aff .= '<tr' . ($i == 0 ? $row1 : $row2) . '>';
			$aff .= '	<td width="50">' . $aSurvey->getID () . '</td>';
			$aff .= '	<td>' . stripcslashes ( $aSurvey->getName () ) . '</td>';
			$aff .= '	<td align="center">' . CommunFunction::getDateFR ( $aSurvey->getDateCreation () ) . '</td>';

			switch ($aSurvey->getStatus ()) {
				case Survey::STATUS_DRAFT :
					$aff .= '	<td align="center">Brouillon</td>';
					break;
				case Survey::STATUS_INPROGRESS :
					$aff .= '	<td align="center">En Cours</td>';
					break;
				case Survey::STATUS_CLOSED :
					$aff .= '	<td align="center">Clos</td>';
					break;
			}
			$aff .= '	<td align="center">' . ($aSurvey->getEnvoiInvitation () == '1' ? 'OUI' : '-') . '</td>';
			$aff .= '	<td align="center">' . ($aSurvey->getEnvoiRelance () == '1' ? 'OUI' : '-') . '</td>';

			switch ($aSurvey->getStatus ()) {
				case Survey::STATUS_DRAFT :
					$aff .= '	<td width="50" align="center"><a href="?action=history&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299360620_clock_16.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center">-</td>';
					$aff .= '	<td width="50" align="center"><a href="?action=previewSurvey&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299158947_preview_16x16.gif" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a href="?action=listRecipient&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299151126_user_business.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a href="?action=listQuestion&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299078611_stock_task.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a href="?action=updateSurvey&id=' . $aSurvey->getID () . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a style="cursor:pointer;" onclick="confirmDelete(\'?action=deleteSurvey&id=' . $aSurvey->getID () . '\')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
					break;
				case Survey::STATUS_INPROGRESS :
					$aff .= '	<td width="50" align="center"><a href="?action=history&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299360620_clock_16.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a href="exportReponse.php?action=exportSurvey&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299158886_page_white_excel.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a href="?action=previewSurvey&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299158947_preview_16x16.gif" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a href="?action=listRecipient&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299151126_user_business.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a href="?action=listQuestion&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299078611_stock_task.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a href="?action=updateSurvey&id=' . $aSurvey->getID () . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center">-</td>';
					break;
				case Survey::STATUS_CLOSED :
					$aff .= '	<td width="50" align="center"><a href="?action=history&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299360620_clock_16.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a href="exportReponse.php?action=exportSurvey&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299158886_page_white_excel.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a href="?action=previewSurvey&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299158947_preview_16x16.gif" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a href="?action=listRecipient&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299151126_user_business.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center"><a href="?action=listQuestion&id=' . $aSurvey->getID () . '"><img src="../../include/images/1299078611_stock_task.png" border=0/></a></td>';
					$aff .= '	<td width="50" align="center">-</td>';
					$aff .= '	<td width="50" align="center"><a style="cursor:pointer;" onclick="confirmDelete(\'?action=deleteSurvey&id=' . $aSurvey->getID () . '\')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
					break;
			}

			$aff .= '</tr>';

			$i = $i == 0 ? 1 : 0;
		}
		$aff .= '</tbody>';
		$aff .= '</table>';
		echo $aff;
	}
}
?>