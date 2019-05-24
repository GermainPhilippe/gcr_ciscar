<?php
class ListeDiffusion_GroupeLCAView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		// $aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;';
		// $aff .= '<a href="?">Liste Diffusion</a>'."\n";
		$aff .= 'Crit&eacute;re Groupe LCA';
		$aff .= '</div><br/><br/>' . "\n";

		$aff .= '<table id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td>Nom</td>';
		$aff .= '<td width="50">Action</td>';
		$aff .= '</tr>';

		$row1 = ' style="background-color:#F4F4F4;height:30px;font-size:11px;"';
		$row2 = ' style="background-color:#E8E8E8;height:30px;font-size:11px;"';
		$i = 0;

		foreach ( $this->myList as $aGroupeLCA ) {
			$aff .= '<tr' . ($i == 0 ? $row1 : $row2) . '>';
			$aff .= '<td>' . $aGroupeLCA->getLibelle () . '</td>';
			$aff .= '<td width="50" align="center"><a onclick="javascript:addRule(\'' . $aGroupeLCA->getID () . '\',\'' . addslashes ( $aGroupeLCA->getLibelle () ) . '\')"><img src="../../include/images/add.png" border="0"/></a></td>';
			$aff .= '</tr>';
			$i = ($i == 0 ? 1 : 0);
		}

		$aff .= '</table>';
		echo $aff;
	}
}
?>