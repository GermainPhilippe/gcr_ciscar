<?php
class FlashInfoAddDomaineActiviteView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">Flash Info</a>&nbsp;>&nbsp;Ajouter Domaine d\'activit&eacute;';
		$aff .= '</div><br/><br/>';

		$aff .= '<table id="TableList">' . "\n";
		$aff .= '<tr class="title">';
		$aff .= '<td>Nom</td>';
		$aff .= '<td width="50">Actions</td>';
		$aff .= '</tr>' . "\n";

		foreach ( $this->myList as $aDomaineActivite ) {
			$aff .= '<tr>';
			$aff .= '<td>' . $aDomaineActivite->getName () . '</td>';
			$aff .= '<td width="50" align="center"><a style="cursor:pointer;" onclick="javascript:addDomaineActivite(\'' . $aDomaineActivite->getID () . '\',\'' . addslashes ( $aDomaineActivite->getName () ) . '\')"><img src="../../include/images/add.png" border="0"/></a></td>';
			$aff .= '</tr>' . "\n";
		}

		$aff .= '</table>';
		echo $aff;
	}
}
?>