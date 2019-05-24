<?php
class ListeDiffusion_FonctionRegionView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">Liste Diffusion</a>' . "\n";
		$aff .= '&nbsp;>&nbsp;Crit&egrave;re Fonction R&eacute;gion';
		$aff .= '</div><br/><br/>' . "\n";

		$aff .= '<table id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td>Nom</td>';
		$aff .= '<td width="50">Action</td>';
		$aff .= '</tr>';

		$row1 = ' style="background-color:#F4F4F4;height:30px;font-size:11px;"';
		$row2 = ' style="background-color:#E8E8E8;height:30px;font-size:11px;"';
		$i = 0;

		foreach ( $this->myList as $aFonctionRegion ) {
			$aff .= '<tr' . ($i == 0 ? $row1 : $row2) . '>';
			$aff .= '<td>' . $aFonctionRegion->getName () . '</td>';
			$aff .= '<td width="50" align="center"><a href="#" onclick="javascript:addRule(\'' . $aFonctionRegion->getID () . '\',\'' . addslashes ( $aFonctionRegion->getName () ) . '\')"><img src="../../include/images/add.png" border="0"/></a></td>';
			$aff .= '</tr>';
			$i = ($i == 0 ? 1 : 0);
		}

		$aff .= '</table>';
		echo $aff;
	}
}
?>