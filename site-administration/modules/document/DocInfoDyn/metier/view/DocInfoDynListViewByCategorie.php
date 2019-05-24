<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynListViewByCategorie {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}

	// ###
	public function render() {
		// Navigation Bar
		$aff = '<b><a href="../../../?">Web Content</a>&nbsp;>&nbsp;DocInfoDyn</b><br/><br/>';

		// Button Bar
		// $aff .= '<a href="?action=new"><img src="../../../include/images/bt/bt_nouveau.jpg" border=0></a><br/><br/>';
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=new\'" /><br/><br/>';

		// List
		$aff .= '<table class="list">';
		$aff .= '<tr class="title" id="ex2-node-root">';
		$aff .= '	<td>Type/Theme/Metier</td>';
		$aff .= '	<td>Titre</td>';
		$aff .= '	<td colspan="2" width="100">Action</td>';
		$aff .= '</tr>';

		$i = 0;
		foreach ( $this->myList as $aType ) {
			// Type
			$aff .= '<tr id="ex2-node-' . $aType->getID () . '" class="child-of-ex2-node-root">';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' . stripslashes ( $aType->getDescription () ) . '</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">&nbsp;</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center">&nbsp;</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center">&nbsp;</td>';
			$aff .= '</tr>';

			$i = $i == 0 ? 1 : 0;
			// Theme
			$aThemeList = new CategorieDocInfoDynList ();
			$aThemeList->SQL_select_all_souscat ( $aType->getID () );

			foreach ( $aThemeList->getList () as $aTheme ) {
				// Theme
				$aff .= '<tr id="ex2-node-' . $aType->getID () . '-' . $aTheme->getID () . '" class="child-of-ex2-node-' . $aType->getID () . '">';
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' . stripslashes ( $aTheme->getDescription () ) . '</td>';
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">&nbsp;</td>';
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center">&nbsp;</td>';
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center">&nbsp;</td>';
				$aff .= '</tr>';

				$i = $i == 0 ? 1 : 0;
				// Metier
				$aMetierList = new CategorieDocInfoDynList ();
				$aMetierList->SQL_select_all_souscat ( $aTheme->getID () );

				foreach ( $aMetierList->getList () as $aMetier ) {
					// Metier
					$aff .= '<tr id="ex2-node-' . $aType->getID () . '-' . $aTheme->getID () . '-' . $aMetier->getID () . '" class="child-of-ex2-node-' . $aType->getID () . '-' . $aTheme->getID () . '">';
					$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' . stripslashes ( $aMetier->getDescription () ) . '</td>';
					$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">&nbsp;</td>';
					$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="80"></td>';
					$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center">&nbsp;</td>';
					$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center">&nbsp;</td>';
					$aff .= '</tr>';

					$i = $i == 0 ? 1 : 0;
					// List des documents
					$aDocumentList = new DocInfoDynList ();
					$aDocumentList->SQL_select_all_by_categorie ( $aType->getID (), $aTheme->getID (), $aMetier->getID () );
					foreach ( $aDocumentList->getList () as $aDoc ) {
						// Doc
						$aff .= '<tr id="ex2-node-' . $aType->getID () . '-' . $aTheme->getID () . '-' . $aMetier->getID () . '-' . $aDoc->getID () . '" class="child-of-ex2-node-' . $aType->getID () . '-' . $aTheme->getID () . '-' . $aMetier->getID () . '">';
						$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">&nbsp;</td>';
						$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' . stripslashes ( $aDoc->getTitre () ) . '</td>';
						$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=edit&id=' . $aDoc->getID () . '"><img src="../../../include/images/document_edit.png" border=0/></a></td>';
						$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=delete&id=' . $aDoc->getID () . '"><img src="../../../include/images/garbage_empty.png" border=0/></a></td>';
						$aff .= '</tr>';

						$i = $i == 0 ? 1 : 0;
					}
				}
			}
		}
		$aff .= '</table>';

		$aff .= '<script type="text/javascript">
  					$(document).ready(function()  {
  						$(".list").treeTable();
  						
  						$("#ex2-node-root").expand();
					});
				</script>';
		echo $aff;
	}
}
?>
