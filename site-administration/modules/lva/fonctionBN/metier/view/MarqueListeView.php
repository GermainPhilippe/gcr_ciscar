<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class FonctionBNListeView {
	private $myFonctionBNListe;

	function __construct($aFonctionBNListe)
	{
		$this->myFonctionBNListe = $aFonctionBNListe;
	}
	function FonctionBNListeView($aFonctionBNListe) {
		self::__construct($aFonctionBNListe);
	}
	
	function render() {
		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;Fonction Bureau National';
		$aff .= '</div><br/><br/>';

		// Bouton sous menu
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=c\'"/>';
		// Button Bar
		$aff .= '<br/><br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><b>#</b></td>';
		$aff .= '<td align="center"><a href="?column=1&order=' . ((isset ( $_GET ['column'] ) && isset ( $_GET ['order'] ) && $_GET ['column'] == '1') ? ($_GET ['order'] == 'a' ? 'z' : 'a') : 'a') . '"><b>Nom</b></a></td>';
		$aff .= '<td align="center"><a href="?column=2&order=' . ((isset ( $_GET ['column'] ) && isset ( $_GET ['order'] ) && $_GET ['column'] == '2') ? ($_GET ['order'] == 'a' ? 'z' : 'a') : 'a') . '"><b>Num&eacute;ro Ordre</b></a></td>';
		$aff .= '<td align="center" colspan="2" width="100"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myFonctionBNListe->getFonctionBNListe () as $aFonctionBN ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aFonctionBN->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aFonctionBN->getName () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aFonctionBN->getNumeroOrdre () . '</td>';

			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=u&id=' . $aFonctionBN->getID () . '"><img src="../../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmBeforeGoTo(\'Confirmation Suppression\',\'?action=d&id=' . $aFonctionBN->getID () . '\')"><img src="../../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table></div>';
		echo $aff;
	}
	function render_option($i) {
		$aff = '<select name="FonctionBNID">';

		foreach ( $this->myFonctionBNListe->getFonctionBNListe () as $aFonctionBN ) {
			$aff .= '<option value="' . $aFonctionBN->getID () . '"' . ($i == ($aFonctionBN->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aFonctionBN->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty($i) {
		$aff = '<select name="FonctionBNID"><option value="0" SELECTED=SELECTED></option>';

		foreach ( $this->myFonctionBNListe->getFonctionBNListe () as $aFonctionBN ) {
			$aff .= '<option value="' . $aFonctionBN->getID () . '"' . ($i == ($aFonctionBN->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aFonctionBN->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty_selected($SelectedElement) {
		$aff = '<select name="FonctionBNID[]" size="5" multiple>';
		$aff .= '<option value="0"' . (count ( $SelectedElement->getList () ) == 0 ? ' SELECTED SELECTED' : '') . '></option>';

		foreach ( $this->myFonctionBNListe->getFonctionBNListe () as $aFonctionBN ) {

			$aff .= '<option value="' . $aFonctionBN->getID () . '"' . ($SelectedElement->isIN ( $aFonctionBN->getID () ) ? ' SELECTED=SELECTED' : '') . '>' . $aFonctionBN->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}

?>