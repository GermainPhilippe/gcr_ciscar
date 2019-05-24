<?php
class ExportRequestView {
	private $myExportRequest;
	public function __construct(ExportRequest $aExportRequest) {
		$this->myExportRequest = $aExportRequest;
	}
	public function renderHTML($mod) {
		switch ($mod) {
			case 'new' :
				$aff = '<form action="?action=new" method="post">';
				break;
			case 'update' :
				$aff = '<form action="?action=update&id=' . $this->myExportRequest->getID () . '" method="post">';
				break;
		}

		// Navigation Bar
		$aff .= '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=2">Admin</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">Export</a>' . "\n";
		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Création';
				break;
			case 'update' :
				$aff .= '&nbsp;>&nbsp;Modification';
				break;
		}
		$aff .= '</div><br/><br/>' . "\n";

		// Description
		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Nom</td>';
		$aff .= '<td><input type="text" name="Name" value="' . $this->myExportRequest->getName () . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">OutputFilename</td>';
		$aff .= '<td><input type="text" name="OutputFilename" size="50" value="' . $this->myExportRequest->getOutputFilename () . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150" valign="top">SQL Request</td>';
		$aff .= '<td><textarea name="RqtSQL" rows="10" cols="80">' . stripslashes ( $this->myExportRequest->getSQLRequest () ) . '</textarea></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150" valign="top">Param Name (separater "|")</td>';
		$aff .= '<td><textarea name="ColumnName">' . $this->myExportRequest->getColumnName () . '</textarea></td>';
		$aff .= '</tr>';
		$aff .= '</table><br/>';

		// Bouton
		switch ($mod) {
			case 'new' :
				$aff .= '<input type="submit" value="Créer"/>';
				break;
			case 'update' :
				$aff .= '<input type="submit" value="Modifier"/>';
				break;
		}

		$aff .= '</form>';
		echo $aff;
	}
}
?>