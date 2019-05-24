<?php
class SurveyDraftRecipientCollectionView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">Formulaire en ligne</a>&nbsp;>&nbsp;Destinaires';
		$aff .= '</div><br/>';
		if ($_GET ['action'] == 'listRecipient') {
			$aff .= '<input type="button" value="Ajouter Destinataire" onclick="javascript:location.href=\'?action=addRecipient&id=' . $_GET ['id'] . '\'" /><br/><br/>';
		}
		$aff .= '<table style="width:100%;">';
		$aff .= '<tr id="root" style="height:30px;font-size:11px;font-weight:bold;text-align:center;background-color:#D4D4D4;background-image: url(\'../../include/images/bt/ligne.jpg\');">';
		$aff .= '	<td width="50">#</td>';
		$aff .= '	<td>Nom</td>';
		$aff .= '	<td width="50">Actions</td>';
		$aff .= '</tr>';

		$row1 = ' style="background-color:#F4F4F4;height:30px;font-size:11px;"';
		$row2 = ' style="background-color:#E8E8E8;height:30px;font-size:11px;"';
		$i = 0;
		if (count ( $this->myList ) > 0) {
			$aListeDiffusionManager = new ListeDiffusionManager ();

			foreach ( $this->myList as $aSurveyRecipient ) {

				$aListeDiffusion = $aListeDiffusionManager->get ( $aSurveyRecipient->getListeDiffusionID () );
				$aff .= '<tr' . ($i == 0 ? $row1 : $row2) . '>';
				$aff .= '	<td width="50" align="center">' . $aListeDiffusion->getID () . '</td>';
				$aff .= '	<td>' . stripcslashes ( $aListeDiffusion->getNom () ) . '</td>';
				if ($_GET ['action'] == 'listRecipient') {
					$aff .= '	<td width="50" align="center"><a style="cursor:pointer;" onclick="confirmDelete(\'?action=deleteRecipient&sid=' . $_GET ['id'] . '&uid=' . $aListeDiffusion->getID () . '\')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
				} else {
					$aff .= '	<td width="50" align="center"><a href="?action=addRecipient&sid=' . $_GET ['id'] . '&uid=' . $aListeDiffusion->getID () . '"><img src="../../include/images/add.png" border=0/></a></td>';
				}
				$aff .= '</tr>';

				$i = $i == 0 ? 1 : 0;
			}
		}
		$aff .= '</table>';
		echo $aff;
	}
}
?>