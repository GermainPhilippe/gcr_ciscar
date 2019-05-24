<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class SplitView_Category {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}

	// ###
	public function renderLvl1HTML() {
		$aff = '<table width="100%" id="CategoryTable">';
		$aff .= '<tr>';
		$aff .= '	<td colspan="4" style="background-color:#CCC;" align="center"><b><a onclick="loadleftColumn()">Filtre Cat&eacute;gorie</a></b></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td colspan="4" align="center"><a style="cursor:pointer" onclick="filterDoc(0)"><b>Tous</b></a></td>';
		$aff .= '</tr>';

		foreach ( $this->myList->getList () as $aCategory ) {
			$aff .= '<tr id="tr' . $aCategory->getID () . '">';
			$aff .= '	<td width="16"><a onclick="expendLvl1(\'' . $aCategory->getID () . '\')"><img id="img' . $aCategory->getID () . '" src="../../../include/images/1.png" border="0"/></a></td>';
			$aff .= '	<td width="16">&nbsp;</td>';
			$aff .= '	<td width="16">&nbsp;</td>';
			$aff .= '	<td id="td' . $aCategory->getID () . '"><a style="cursor:pointer" onclick="expendLvl1(' . $aCategory->getID () . ')">' . htmlentities ( $aCategory->getDescription (), ENT_QUOTES ) . '</a></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table>';
		return $aff;
	}
	public function renderLvl2HTML($parent_ID) {
		$aff = '';

		foreach ( $this->myList->getList () as $aCategory ) {
			$aff .= '<tr id="tr' . $aCategory->getID () . '" class="parentCategory' . $parent_ID . '">';
			$aff .= '	<td width="16">&nbsp;</td>';
			$aff .= '	<td width="16"><a onclick="expendLvl2(\'' . $aCategory->getID () . '\')"><img id="img' . $aCategory->getID () . '" src="../../../include/images/1.png" border="0"/></a></td>';
			$aff .= '	<td width="16">&nbsp;</td>';
			$aff .= '	<td id="td' . $aCategory->getID () . '"><a style="cursor:pointer" onclick="expendLvl2(' . $aCategory->getID () . ')">' . htmlentities ( $aCategory->getDescription (), ENT_QUOTES ) . '</a></td>';
			$aff .= '</tr>';
		}
		return $aff;
	}
	public function renderLvl3HTML($parent_ID) {
		$aff = '';

		foreach ( $this->myList->getList () as $aCategory ) {
			$aff .= '<tr id="tr' . $aCategory->getID () . '" class="parentCategory' . $parent_ID . '">';
			$aff .= '	<td width="16">&nbsp;</td>';
			$aff .= '	<td width="16">&nbsp;</td>';
			$aff .= '	<td width="16">-</td>';
			$aff .= '	<td id="td' . $aCategory->getID () . '"><a style="cursor:pointer" onclick="filterDoc(' . $aCategory->getID () . ')">' . htmlentities ( $aCategory->getDescription (), ENT_QUOTES ) . '</a></td>';
			$aff .= '</tr>';
		}
		return $aff;
	}
}
?>