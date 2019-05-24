<?php
class MenuDynamique_Category {
	public function __construct() {
	}
	public function renderHTML($lvl) {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;';
		switch ($lvl) {
			case '1' :
				$aff .= '<a href="?">Menu Dynamique</a>&nbsp;>&nbsp;Sélection Type';
				break;
			case '2' :
				$aff .= '<a href="?">Menu Dynamique</a>&nbsp;>&nbsp;Sélection Thème';
				break;
			case '3' :
				$aff .= '<a href="?">Menu Dynamique</a>&nbsp;>&nbsp;Sélection Métier';
				break;
		}
		$aff .= '</div><br/><br/>';

		$aff .= '<table id="tree" style="width:100%;">' . "\n";
		$aff .= '<tr id="root" style="height:30px;font-size:11px;font-weight:bold;text-align:center;background-color:#D4D4D4;background-image: url(\'../../include/images/bt/ligne.jpg\');">';
		$aff .= '<td>Nom</td>';
		$aff .= '<td width="50">Actions</td>';
		$aff .= '</tr>' . "\n";

		$aCategorieDocInfoDynList = new CategorieDocInfoDynList ();
		$aCategorieDocInfoDynList->SQL_select_all_type ();
		$row1 = ' style="background-color:#F4F4F4;height:30px;font-size:11px;border-bottom:1px solid #FFFFFF;"';
		$row2 = ' style="background-color:#E8E8E8;height:30px;font-size:11px;border-bottom:1px solid #FFFFFF;"';
		$i = 0;
		foreach ( $aCategorieDocInfoDynList->getList () as $aCategorie ) {
			$aff .= '<tr id="type-' . $aCategorie->getID () . '" class="child-of-root">';
			$aff .= '<td' . ($i == 1 ? $row1 : $row2) . '>' . $aCategorie->getDescription () . '</td>';
			$aff .= '<td width="50" align="center"' . ($i == 1 ? $row1 : $row2) . '>';
			if ($lvl == '2' || $lvl == '3') {
				$aff .= '&nbsp;';
			} else {
				$aff .= '<a style="cursor:pointer;" onclick="javascript:addElement(\'' . $aCategorie->getID () . '\',\'' . $aCategorie->getDescription () . '\')"><img src="../../include/images/add.png" border="0"/></a>';
			}
			$aff .= '</td></tr>' . "\n";
			$i = ($i == 1 ? 0 : 1);

			if ($lvl == '2' || $lvl == '3') {
				$aCategorieDocInfoDynListTheme = new CategorieDocInfoDynList ();
				$aCategorieDocInfoDynListTheme->SQL_select_all_souscat ( $aCategorie->getID () );

				foreach ( $aCategorieDocInfoDynListTheme->getList () as $aCategorieTheme ) {
					$aff .= '<tr id="theme-' . $aCategorieTheme->getID () . '" class="child-of-type-' . $aCategorie->getID () . '">';
					$aff .= '<td' . ($i == 1 ? $row1 : $row2) . '>' . $aCategorieTheme->getDescription () . '</td>';
					$aff .= '<td width="50" align="center"' . ($i == 1 ? $row1 : $row2) . '>';
					if ($lvl == '3') {
						$aff .= '&nbsp;';
					} else {
						$aff .= '<a style="cursor:pointer;" onclick="javascript:addElement(\'' . $aCategorieTheme->getID () . '\',\'' . $aCategorieTheme->getDescription () . '\')"><img src="../../include/images/add.png" border="0"/></a>';
					}
					$aff .= '</td></tr>' . "\n";
					$i = ($i == 1 ? 0 : 1);

					if ($lvl == '3') {
						$aCategorieDocInfoDynListMetier = new CategorieDocInfoDynList ();
						$aCategorieDocInfoDynListMetier->SQL_select_all_souscat ( $aCategorieTheme->getID () );

						foreach ( $aCategorieDocInfoDynListMetier->getList () as $aCategorieMetier ) {
							$aff .= '<tr class="child-of-theme-' . $aCategorieTheme->getID () . '">';
							$aff .= '<td' . ($i == 1 ? $row1 : $row2) . '>' . $aCategorieMetier->getDescription () . '</td>';
							$aff .= '<td width="50" align="center"' . ($i == 1 ? $row1 : $row2) . '><a style="cursor:pointer;" onclick="javascript:addElement(\'' . $aCategorieMetier->getID () . '\',\'' . $aCategorieMetier->getDescription () . '\')"><img src="../../include/images/add.png" border="0"/></a></td>';
							$aff .= '</tr>' . "\n";
							$i = ($i == 1 ? 0 : 1);
						}
					}
				}
			}
		}

		$aff .= '</table>';

		$aff .= '<script type="text/javascript">
			$(document).ready(function(){ 
				$("#tree").treeTable({
					initialState: "collapsed"
				});
				
				$("#tree #root").expand();
			});
			</script>';
		echo $aff;
	}
}
?>