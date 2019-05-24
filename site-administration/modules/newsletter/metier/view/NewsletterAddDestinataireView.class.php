<?php
class NewsletterAddDestinataireView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		$aff ='';
		// Navigation Bar
		//$aff .= '<div id="FilAriane">' . "\n";
		//$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;';
		//$aff .= '<a href="?">Newsletter</a>&nbsp;>&nbsp;Ajouter Destinataire';
		//$aff .= '</div><br/><br/>';
		
		$aff .= '<table id="TableList">' . "\n";
		$aff .= '<tr class="title">';
		$aff .= '<td>Nom</td>';
		$aff .= '<td width="50">Actions</td>';
		$aff .= '</tr>' . "\n";
		
		foreach ( $this->myList as $aListeDiffusion ) {
			$aff .= '<tr>';
			$aff .= '<td>' . $aListeDiffusion->getNom () . '</td>';
			$aff .= '<td width="50" align="center"><a style="cursor:pointer;" onclick="javascript:addDestinataire(\'' . $aListeDiffusion->getID () . '\',\'' . $aListeDiffusion->getNom () . '\')"><img id="add-'.$aListeDiffusion->getID ().'" src="../../include/images/add.png" border="0"/></a></td>';
			$aff .= '</tr>' . "\n";
		}
		$aff .= '<tr style="background-color:#c4f9ce;">';
		$aff .= '<td style="font-size:12px;font-weight:bold;padding-right:10px;text-align:right;">RETOUR</td>';
		$aff .= '<td width="50" align="center"><a style="cursor:pointer;" onclick="javascript:validDestinataire()"><img src="../../include/images/redo.png" border="0"/></a></td>';
		$aff .= '</tr>' . "\n";
		
		$aff .= '</table>';
		echo $aff;
	}
}
?>