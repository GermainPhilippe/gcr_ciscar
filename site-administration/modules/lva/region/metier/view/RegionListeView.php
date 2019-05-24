<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class RegionListeView {
	private $myRegionListe;

	function __construct($aRegionListe)
	{
		$this->myRegionListe = $aRegionListe;
	}
	function RegionListeView($aRegionListe) {
		self::__construct($aRegionListe);
	}
	
	function render($annu) {
		// Navigation bar
		if ($annu == 0) {
			$aff = '<div id="FilAriane">';
			$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
			$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;R&eacute;gion';
			$aff .= '</div><br/><br/>';
		} else {
			$aff = '<div id="FilAriane">';
			$aff .= '	<a href="../../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;R&eacute;gion';
			$aff .= '</div><br/><br/>';
		}

		// Button Bar
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=c&annu=' . $annu . '\'"/>';
		$aff .= '<br/><br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><b>#</b></td>';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center" colspan="2" width="100"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myRegionListe->getRegionListe () as $aRegion ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aRegion->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aRegion->getName () . '</td>';

			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=u&annu=' . $annu . '&id=' . $aRegion->getID () . '"><img src="../../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmBeforeGoTo(\'Confirmation Suppression\',\'?action=d&annu=' . $annu . '&id=' . $aRegion->getID () . '\')"><img src="../../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table></div>';
		echo $aff;
	}
	function render_option($i) {
		$aff = '<select name="RegionID">';

		foreach ( $this->myRegionListe->getRegionListe () as $aRegion ) {
			$aff .= '<option value="' . $aRegion->getID () . '"' . ($i == ($aRegion->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aRegion->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty($i) {
		$aff = '<select name="RegionID"><option value="0" SELECTED=SELECTED></option>';

		foreach ( $this->myRegionListe->getRegionListe () as $aRegion ) {
			$aff .= '<option value="' . $aRegion->getID () . '"' . ($i == ($aRegion->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aRegion->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}

?>