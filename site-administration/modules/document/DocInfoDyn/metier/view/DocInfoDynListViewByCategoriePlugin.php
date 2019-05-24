<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynListViewByCategoriePlugin {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}

	// ###
	public function render() {
		// Navigation Bar

		// List
		$aff = '<table class="list">';
		$aff .= '<tr class="title" id="ex2-node-root">';
		$aff .= '	<td>Type/Theme/Metier</td>';
		$aff .= '	<td>Titre</td>';
		$aff .= '	<td width="50">Action</td>';
		$aff .= '</tr>';

		$i = 0;
		foreach ( $this->myList as $aType ) {
			// Type
			$aff .= '<tr id="ex2-node-' . $aType->getID () . '" class="child-of-ex2-node-root">';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' . stripslashes ( $aType->getDescription () ) . '</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">&nbsp;</td>';
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
						$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="#"  onclick="ok(\'' . $aDoc->getID () . '\',\'' . addslashes ( $aDoc->getTitre () ) . '\')">Ajouter</a></td>';
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
