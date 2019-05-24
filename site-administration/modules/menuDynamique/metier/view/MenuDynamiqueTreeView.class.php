<?php
class MenuDynamiqueTreeView {
	public function renderHTML() {
		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;MenuDynamique';
		$aff .= '</div>';
		$aff .= '<br/><input type="button" value="Nouveau" onclick="javascript:location.href=\'?action=new\'" /><br/><br/>';

		$aff .= '<table id="tree" style="width:100%;">';
		$aff .= '<tr id="root" style="height:30px;font-size:11px;font-weight:bold;text-align:center;background-color:#D4D4D4;background-image: url(\'../../include/images/bt/ligne.jpg\');">';
		$aff .= '	<td width="50">#</td>';
		$aff .= '	<td>Nom</td>';
		$aff .= '	<td width="100">Num Ordre</td>';
		$aff .= '	<td colspan="2" width="100">Actions</td>';
		$aff .= '</tr>';

		$row1 = ' style="background-color:#F4F4F4;height:30px;font-size:11px;"';
		$row2 = ' style="background-color:#E8E8E8;height:30px;font-size:11px;"';
		$i = 0;

		$aMenuDynamiqueManager = new MenuDynamiqueManager ();
		foreach ( $aMenuDynamiqueManager->getParentMenuList () as $aParentMenuDynamique ) {
			$aff .= '<tr id="MenuDynamique-' . $aParentMenuDynamique->getID () . '" class="child-of-root"' . ($i == 0 ? $row1 : $row2) . '>';
			$aff .= '	<td width="50">' . $aParentMenuDynamique->getID () . '</td>';
			$aff .= '	<td>' . stripcslashes ( $aParentMenuDynamique->getName () ) . '</td>';
			$aff .= '	<td align="center">' . $aParentMenuDynamique->getNumOrdre () . '</td>';
			$aff .= '	<td width="50" align="center"><a href="?action=update&id=' . $aParentMenuDynamique->getID () . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
			$aff .= '	<td width="50" align="center"><a style="cursor:pointer;" onclick="confirmDelete(\'?action=delete&id=' . $aParentMenuDynamique->getID () . '\')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>';

			$i = ($i == 0 ? 1 : 0);

			foreach ( $aMenuDynamiqueManager->getChildMenuList ( $aParentMenuDynamique->getID () ) as $aChildMenuDynamique ) {
				$aff .= '<tr id="MenuDynamique-' . $aChildMenuDynamique->getID () . '" class="child-of-MenuDynamique-' . $aParentMenuDynamique->getID () . '"' . ($i == 0 ? $row1 : $row2) . '>';
				$aff .= '	<td width="50">' . $aChildMenuDynamique->getID () . '</td>';
				$aff .= '	<td>' . stripcslashes ( $aChildMenuDynamique->getName () ) . '</td>';
				$aff .= '	<td align="center">' . $aChildMenuDynamique->getNumOrdre () . '</td>';
				$aff .= '	<td width="50" align="center"><a href="?action=update&id=' . $aChildMenuDynamique->getID () . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
				$aff .= '	<td width="50" align="center"><a style="cursor:pointer;" onclick="confirmDelete(\'?action=delete&id=' . $aChildMenuDynamique->getID () . '\')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
				$aff .= '</tr>';

				$i = ($i == 0 ? 1 : 0);
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