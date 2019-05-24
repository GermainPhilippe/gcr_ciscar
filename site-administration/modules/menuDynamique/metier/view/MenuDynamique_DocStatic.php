<?php
class MenuDynamique_DocStatic {
	public function renderHTML() {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">Menu Dynamique</a>&nbsp;>&nbsp;Sélection DocStatic';
		$aff .= '</div><br/><br/>';

		$aff .= '<table id="tree" style="width:100%;">' . "\n";
		$aff .= '<tr id="root" style="height:30px;font-size:11px;font-weight:bold;text-align:center;background-color:#D4D4D4;background-image: url(\'../../include/images/bt/ligne.jpg\');">';
		$aff .= '<td>Nom</td>';
		$aff .= '<td width="50">Actions</td>';
		$aff .= '</tr>' . "\n";

		$aDocStaticList = new DocStaticList ();
		$aDocStaticList->SQL_select_all ();
		$row1 = ' style="background-color:#F4F4F4;height:30px;font-size:11px;border-bottom:1px solid #FFFFFF;"';
		$row2 = ' style="background-color:#E8E8E8;height:30px;font-size:11px;border-bottom:1px solid #FFFFFF;"';
		$i = 0;
		foreach ( $aDocStaticList->getList () as $aDoc ) {
			$aff .= '<tr id="type-' . $aDoc->getID () . '" class="child-of-root">';
			$aff .= '<td' . ($i == 1 ? $row1 : $row2) . '>' . $aDoc->getTitre () . '</td>';
			$aff .= '<td width="50" align="center"' . ($i == 1 ? $row1 : $row2) . '>';
			$aff .= '<a style="cursor:pointer;" onclick="javascript:addElement(\'' . $aDoc->getID () . '\',\'' . $aDoc->getTitre () . '\')"><img src="../../include/images/add.png" border="0"/></a>';
			$aff .= '</td></tr>' . "\n";
			$i = ($i == 1 ? 0 : 1);
		}

		$aff .= '</table>';
		echo $aff;
	}
}
?>