<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class CommissionView {
	private $myCommission;

	function __construct($aCommission)
	{
		$this->myCommission = $aCommission;
	}
	function CommissionView($aCommission) {
		self::__construct($aCommission);
	}
	
	// ###############
	function render($mod) {
		include_once ("../../../include/js/fckeditor/fckeditor.php");

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../?">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="?">Commission</a>&nbsp;>&nbsp;';

		// Formualire
		if ($mod == 'c') {
			$aff .= 'Création</div><br/><br/>';
			$aff .= '<form method="POST" action="?action=c">';
		} else if ($mod == 'u') {
			$aff .= 'Edition</div><br/><br/>';
			$aff .= '<form method="POST" action="?action=u&id=' . $this->myCommission->getID () . '">';
		}

		$aff .= '<table width="100%">';

		if ($mod == 'u') {
			$aff .= '<tr>';
			$aff .= '<td>#</td>';
			$aff .= '<td><input type="text" name="CommissionID" value="' . $this->myCommission->getID () . '" readonly/></td>';
			$aff .= '</tr>';
		}

		$aff .= '<tr>';
		$aff .= '<td>Nom</td>';
		$aff .= '<td><input type="text" name="Nom" value="' . $this->myCommission->getName () . '" maxlength="100" size="100" /></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Description</td>';
		$aff .= '<td>';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'Description' );
		$oFCKeditor->BasePath = '../../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myCommission->getDescription () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();

		$aff = '</td></tr>';

		$aTypeCommissionListe = new TypeCommissionListe ();
		$aTypeCommissionListe->select_all_typecommission ();
		$aTypeCommissionListeView = new TypeCommissionListeView ( $aTypeCommissionListe );
		$tmp = $this->myCommission->getTypeCommission ();
		$TypeCommissionID = empty ( $tmp ) ? 1 : $tmp->getID ();

		$aff .= '<tr>';
		$aff .= '<td>Type Commission</td>';
		$aff .= '<td>' . $aTypeCommissionListeView->render_option ( $TypeCommissionID ) . '</td>';
		$aff .= '</tr>';

		$aCommissionListe = new CommissionListe ();
		$aCommissionListe->select_all_commission ();
		$aCommissionListeView = new CommissionListeView ( $aCommissionListe );
		$tmp = $this->myCommission->getCommissionParent ();
		$CommissionParentID = empty ( $tmp ) ? 1 : $tmp->getID ();

		$aff .= '<tr id="CommissionNationale" style="visibility:' . ($TypeCommissionID == 2 ? 'visible' : 'hidden') . '">';
		$aff .= '<td>Commission Nationale</td>';
		$aff .= '<td>' . $aCommissionListeView->render_option ( $CommissionParentID ) . '</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		if ($mod == 'c') {
			$aff .= '<td colspan="2"><input type="submit" value="Cr&eacute;er"></td>';
		} else if ($mod == 'u') {
			$aff .= '<td colspan="2"><input type="submit" value="Mettre &agrave; Jour"></td>';
		}
		$aff .= '</tr>';

		$aff .= '</table></form>';
		echo $aff;
	}
}
?>