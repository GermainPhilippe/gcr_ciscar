<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class StatutEtablissementListeView {
	private $myStatutEtablissementListe;

	function __construct($aStatutEtablissementListe)
	{
		$this->myStatutEtablissementListe = $aStatutEtablissementListe;
	}
	function StatutEtablissementListeView($aStatutEtablissementListe) {
		self::__construct($aStatutEtablissementListe);
	}
	
	function render() {
		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;Statut Etablissement';
		$aff .= '</div><br/><br/>';

		// Bouton sous menu
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=c\'"/><br/>';
		$aff .= '<br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><b>#</b></td>';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center" colspan="2" width="100"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myStatutEtablissementListe->getStatutEtablissementListe () as $aStatutEtablissement ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aStatutEtablissement->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aStatutEtablissement->getName () . '</td>';

			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=u&id=' . $aStatutEtablissement->getID () . '"><img src="../../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmBeforeGoTo(\'Confirmation Suppression\',\'?action=d&id=' . $aStatutEtablissement->getID () . '\')"><img src="../../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table></div>';
		echo $aff;
	}
	function render_option($i) {
		$aff = '<select name="StatutID">';

		foreach ( $this->myStatutEtablissementListe->getStatutEtablissementListe () as $aStatutEtablissement ) {
			$aff .= '<option value="' . $aStatutEtablissement->getID () . '"' . ($i == ($aStatutEtablissement->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aStatutEtablissement->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty($i) {
		$aff = '<select name="StatutID"><option value="0" SELECTED=SELECTED></option>';

		foreach ( $this->myStatutEtablissementListe->getStatutEtablissementListe () as $aStatutEtablissement ) {
			$aff .= '<option value="' . $aStatutEtablissement->getID () . '"' . ($i == ($aStatutEtablissement->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aStatutEtablissement->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}

?>