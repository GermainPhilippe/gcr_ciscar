<?php
class ListeDiffusionRequeteView {
	private $myList;
	private $myRequest;
	public function __construct($aList, $aRequest, $aListID) {
		$this->myList = $aList;
		$this->myRequest = $aRequest;
		$this->myRequest = $aListID;
	}

	// ###
	public function renderHTML($action) {
		$aManager = new ListeDiffusionManager ();
		$aView = $aManager->get ( ( int ) $_GET ['id'] );

		// Navigation bar
		$aff = '<div id="FilAriane">' . "\n";
		if ($action == 'view')
			$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;<a href="index.php">Liste Diffusion</a>' . "\n";
		if ($action == 'viewOutlook')
			$aff .= '<a href="../../?menu=1">Général</a>&nbsp;>&nbsp;<a href="index.php">Liste Outlook</a>' . "\n";
		$aff .= '&nbsp;>&nbsp;Preview&nbsp;(' . $aView->getNom () . ')';
		$aff .= '</div><br/><br/>' . "\n";
		echo $aff;

		// Tableau
		echo '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList">';
		echo '<tr class="title">';
		echo '<td align="center" width="50"><b>#</b></td>';
		echo '<td align="center"><b>Nom</b></td>';
		echo '<td align="center"><b>Pr&eacute;nom</b></td>';
		// echo '<td align="center"><b>Fonction</b></td>';
		echo '<td align="center"><b>Mail</b></td>';
		echo '<td align="center"><b>EtablissementID</b></td>';
		echo '<td align="center" width="50"><b>Action</b></td>';
		echo '</tr>';

		$row = 1;
		foreach ( $this->myList as $aIndividu ) {
			$aff = '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getNom () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getPrenom () . '</td>';
			// $aff .= '<td align="center" class="'.($row==1?'row1':'row2').'">'.$aIndividu->getFonction().'</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getMail () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getEtablissementID () . '</td>';
			if ($aIndividu->getID () > 0)
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a href="../individu/?action=edit&id=' . $aIndividu->getID () . '"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
			else
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"></td>';

			$aff .= '</tr>';
			echo $aff;
			$row = ($row == 1 ? 2 : 1);
		}

		if (count ( $this->myList ) == 0) {
			echo '<tr>';
			echo '<td colspan="7"><i>Aucun Individu trouv&eacute;</i></td>';
			echo '</tr>';
		}
		echo '</table></div>';
	}
}
?>