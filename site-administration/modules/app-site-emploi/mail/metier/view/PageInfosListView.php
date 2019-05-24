<?php
/**
 * Vue de la liste des pages infos
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 */
class PageInfosListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	/**
	 *
	 * rendu du style de la vue
	 *
	 * @return string
	 */
	public function renderstyle() {
		$aff = '<style>';
		$aff .= 'td.center {text-align:center;}';
		$aff .= '</style>';

		return $aff;
	}
	/**
	 * rendu de la vue
	 */
	public function renderHTML() {
		$aff = $this->renderstyle ();
		$aff .= '<div id="FilAriane"><a href="../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;Liste des pages d\'informations</div><br /><br />';
		// Button Bar
		// $aff .= '<input type="button" value="Retour" onclick="javascript:history.back()" />';
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=newpage\'" /><br/><br/>';
		$aff .= '<table id="TableList" width="100%">';
		$aff .= '<tr class="title">';
		$aff .= '	<td align="center" width="50"><b>#</b></td>';
		$aff .= '	<td align="center"><b>Titre</b></td>';
		$aff .= '	<td align="center"><b>Espace</b></td>';
		$aff .= '	<td align="center"><b>Affichage</b></td>';
		$aff .= '	<td width="100" align="center" colspan="2"><b>Action</b></td>';
		$aff .= '</tr>';
		$row = 1;
		foreach ( $this->myList->getList () as $aVerif ) {
			$aff .= '<tr>';
			$aff .= '	<td align="center" width="50" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aVerif->getidpageinfo () . '</td>';
			$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aVerif->gettitre () . '</td>';
			$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">';
			if ($aVerif->getespace () == 1) {
				$aff .= '	Concessionnaire</td>';
			} else {
				$aff .= '	Candidat</td>';
			}
			$aff .= ' </td>';
			$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center">';
			if ($aVerif->getaffichage () == 1) {
				$aff .= '	<img src="../../include/images/icone_oui.png" alt="">';
			} else {
				$aff .= '	<img src="../../include/images/icone_non.png" alt="">';
			}
			$aff .= '</td>';

			$aff .= '	<td width="50" class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center"><a href="?action=editpage&id=' . $aVerif->getidpageinfo () . '"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
			$aff .= '	<td width="50" class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center"><a href="#" onclick="confirmDeletepage(' . $aVerif->getidpageinfo () . ')"><img src="../../include/images/garbage_empty.png" border="0"/></td>';
			$aff .= '</tr>';
			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table>';

		echo $aff;
	}
}
?>