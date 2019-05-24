<?php
class FlashInfoView {
	private $myFlashInfo;
	public function __construct(FlashInfo $aFlashInfo) {
		$this->myFlashInfo = $aFlashInfo;
	}
	public function renderHTML($mod) {
		include_once ("../../include/js/fckeditor/fckeditor.php");

		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">Flash Info</a>' . "\n";
		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Cr&eacute;ation';
				break;
			case 'update' :
				$aff .= '&nbsp;>&nbsp;Edition';
				break;
		}
		$aff .= '</div><br/><br/>' . "\n";

		switch ($mod) {
			case 'new' :
				$aff .= '<form method="post" action="?action=new" onsubmit="return validateForm()">';
				break;
			case 'update' :
				$aff .= '<form method="post" action="?action=update&id=' . $this->myFlashInfo->getID () . '" onsubmit="return validateForm()">';
				break;
		}
		$aff .= '<img src="../../include/images/1.png"/> Informations<br/>';
		$aff .= '<table width="100%">';
		$aff .= '<tr>';
		$aff .= '<td width="150">Nom*</td>';
		$aff .= '<td><input type="text" name="Nom" id="Nom" value="' . $this->myFlashInfo->getNom () . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Date Debut*</td>';
		$aff .= '<td><input type="text" name="DateDebut" id="DateDebut" value="' . ($this->myFlashInfo->getDateDebut () == '' ? '' : CommunFunction::getDateFR ( $this->myFlashInfo->getDateDebut () )) . '"></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Date Fin*</td>';
		$aff .= '<td><input type="text" name="DateFin" id="DateFin" value="' . ($this->myFlashInfo->getDateFin () == '' ? '' : CommunFunction::getDateFR ( $this->myFlashInfo->getDateFin () )) . '"></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150" valign="top">Information*</td>';
		$aff .= '<td>';
		$oFCKeditor = new FCKeditor ( 'Information' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myFlashInfo->getInformation () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '100';
		$oFCKeditor->ToolbarSet = "Basic";
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '<td width="150">DocInfoDyn</td>';
		$aDocInfoDyn = new DocInfoDyn ();
		if ($mod == 'update') {
			$aDocInfoDyn->SQL_select ( $this->myFlashInfo->getDocInfoDynID () );
		}
		$aff .= '<td><input type="hidden" name="pElmentID" id="pElmentID" value="' . $aDocInfoDyn->getID () . '">
					<input type="text" name="pElmentIDDisplay" id="pElmentIDDisplay" value="' . $aDocInfoDyn->getTitre () . '" size="60"><input type="button" value="Selectionner un document" onclick="openWindowSelectionDocument()"></td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		$aff .= '<br/><img src="../../include/images/1.png"/> Domaine d\'activit&eacute;<br/><br/>';
		$aff .= '<input type="button" value="Ajouter Domaine activit&eacute;" onclick="javascript:OpenWindowSelection()"/><br/>';
		$aArray = array ();
		if ($mod == 'update') {
			$aManager = new FlashInfoDomaineActiviteManager ();
			$aDomaineActivite = new DomaineActivite ();
			$aArray = $aManager->getList ( $this->myFlashInfo->getID () );
		}
		$aff .= '<input type="hidden" name="Counter" id="Counter" value="' . count ( $aArray ) . '">';
		$aff .= '<table id="TableList" class="DestinataireTable">';
		$aff .= '<tr class="title">';
		$aff .= '<td>Nom</td>';
		$aff .= '<td width="50">Action</td>';
		$aff .= '</tr>';
		if ($mod == 'update') {
			$i = 1;
			foreach ( $aArray as $aFlashInfoDomaineActivite ) {
				$aDomaineActivite->select_domaineactivite ( $aFlashInfoDomaineActivite->getDomaineActiviteID () );
				$aff .= '<tr id="trDA-' . $aFlashInfoDomaineActivite->getDomaineActiviteID () . '">';
				$aff .= '<td><input type="hidden" name="DA' . $i . '" value="' . $aFlashInfoDomaineActivite->getDomaineActiviteID () . '"/>' . $aDomaineActivite->getName () . '</td>';
				$aff .= '<td width="50" align="center"><a href="#" onclick="removeTrDA(' . $aFlashInfoDomaineActivite->getDomaineActiviteID () . ')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
				$aff .= '</tr>';
				$i ++;
			}
		}
		$aff .= '</table><br/><br/>';

		switch ($mod) {
			case 'new' :
				$aff .= '<input type="submit" value="Cr&eacute;er"/></form>';
				break;
			case 'update' :
				$aff .= '<input type="submit" value="Modifier"/></form>';
				break;
		}

		echo $aff;
	}
}
?>