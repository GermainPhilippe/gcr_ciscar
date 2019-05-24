<?php
class SurveyRecipientCollectionView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">Formulaire en ligne</a>&nbsp;>&nbsp;Destinaires';
		$aff .= '</div><br/>';
		$aff .= '<table style="width:100%;">';
		$aff .= '<tr id="root" style="height:30px;font-size:11px;font-weight:bold;text-align:center;background-color:#D4D4D4;background-image: url(\'../../include/images/bt/ligne.jpg\');">';
		$aff .= '	<td width="50">#</td>';
		$aff .= '	<td>Nom</td>';
		$aff .= '	<td>Pr&eacute;nom</td>';
		$aff .= '	<td>Mail</td>';
		$aff .= '	<td width="50">Actions</td>';
		$aff .= '</tr>';

		$row1 = ' style="background-color:#F4F4F4;height:30px;font-size:11px;"';
		$row2 = ' style="background-color:#E8E8E8;height:30px;font-size:11px;"';
		$i = 0;
		if (count ( $this->myList ) > 0) {
			$aIndividu = new Simple_Individu ();
			foreach ( $this->myList as $aRecipient ) {
				$aIndividu->SQL_SELECT ( $aRecipient->getUserID () );

				$aff .= '<tr' . ($i == 0 ? $row1 : $row2) . '>';
				$aff .= '	<td width="50" align="center">' . $aIndividu->getID () . '</td>';
				$aff .= '	<td>' . stripslashes ( $aIndividu->getNom () ) . '</td>';
				$aff .= '	<td>' . stripslashes ( $aIndividu->getPrenom () ) . '</td>';
				$aff .= '	<td>' . stripslashes ( $aIndividu->getMail () ) . '</td>';
				$aff .= '	<td width="50" align="center"><a style="cursor:pointer;" onclick="confirmDelete(\'?action=deleteRecipient&sid=' . $_GET ['id'] . '&uid=' . $aIndividu->getID () . '\')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
				$aff .= '</tr>';

				$i = $i == 0 ? 1 : 0;
			}
		}
		$aff .= '</table>';
		echo $aff;
	}
}
?>