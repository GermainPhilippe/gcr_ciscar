<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class CommissionListeView {
	private $myCommissionListe;

	function __construct($aCommissionListe)
	{
		$this->myCommissionListe = $aCommissionListe;
	}
	function CommissionListeView($aCommissionListe) {
		self::__construct($aCommissionListe);
	}
	
	function render() {
		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../?">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;Commission';
		$aff .= '</div><br/>';

		// Bouton sous menu
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=c\'"/>';
		// Button Bar
		$aff .= '<br/><br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><b>#</b></td>';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center"><b>Type Commission</b></td>';
		$aff .= '<td align="center" colspan="2" width="100"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myCommissionListe->getCommissionListe () as $aCommission ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aCommission->getID () . '</td>';
			$aff .= '<td class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aCommission->getName () . '</td>';

			$tmp = $aCommission->getTypeCommission ();
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . (empty ( $tmp ) ? '&nbsp;' : $tmp->getName ()) . '</td>';

			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=u&id=' . $aCommission->getID () . '"><img src="../../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmBeforeGoTo(\'Confirmation Suppression\',\'?action=d&id=' . $aCommission->getID () . '\')"><img src="../../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table></div>';
		echo $aff;
	}
	function render_option($i) {
		$aff = '<select name="CommissionParentID">';

		foreach ( $this->myCommissionListe->getCommissionListe () as $aCommission ) {
			$aff .= '<option value="' . $aCommission->getID () . '"' . ($i == ($aCommission->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aCommission->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty($i, $nomChamp) {
		$aff = '<select name="' . $nomChamp . '"><option value="0" SELECTED=SELECTED></option>';

		foreach ( $this->myCommissionListe->getCommissionListe () as $aCommission ) {
			$aff .= '<option value="' . $aCommission->getID () . '"' . ($i == ($aCommission->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aCommission->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}

?>