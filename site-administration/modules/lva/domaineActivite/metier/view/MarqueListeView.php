<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class DomaineActiviteListeView {
	private $myDomaineActiviteListe;

	function __construct($aDomaineActiviteListe)
	{
		$this->myDomaineActiviteListe = $aDomaineActiviteListe;
	}
	function DomaineActiviteListeView($aDomaineActiviteListe) {
		self::__construct($aDomaineActiviteListe);
	}
	
	function render() {
		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;Domaine Activit&eacute;';
		$aff .= '</div><br/><br/>';

		// Bouton sous menu
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=c\'"/>';
		// Button Bar
		$aff .= '<br/><br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title" id="ex2-node-root">';
		$aff .= '<td align="center" width="100"><b>NumOrdre</b></td>';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center" colspan="3" width="150"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myDomaineActiviteListe->getDomaineActiviteListe () as $aMarque ) {
			$aff .= '<tr id="ex2-node-' . $aMarque->getID () . '" class="child-of-ex2-node-root">';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="100">' . $aMarque->getNumOrdre () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aMarque->getName () ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="../FonctionDA/?action=new&DAID=' . $aMarque->getID () . '"><img src="../../../include/images/add.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=u&id=' . $aMarque->getID () . '"><img src="../../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="' . ($aMarque->getNbRole () > 0 ? 'NoDelete()' : 'confirmBeforeGoTo(\'Confirmation Suppression\',\'?action=d&id=' . $aMarque->getID () . '\')') . '"><img src="../../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);

			$aFonctionDAList = new FonctionDAList ();
			$aFonctionDAList->SQL_SELECT_ALL ( $aMarque->getID () );

			foreach ( $aFonctionDAList->getList () as $aFonctionDA ) {
				$aff .= '<tr id="ex2-node-' . $aMarque->getID () . '-' . $aFonctionDA->getID () . '" class="child-of-ex2-node-' . $aMarque->getID () . '">';
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="100">' . $aFonctionDA->getNumOrdre () . '</td>';
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" colspan="2">' . stripslashes ( $aFonctionDA->getLibelle () ) . '</td>';
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="../FonctionDA/?action=edit&id=' . $aFonctionDA->getID () . '"><img src="../../../include/images/document_edit.png" border="0"/></a></b></td>';
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmBeforeGoTo(\'Confirmation Suppression\',\'../FonctionDA/?action=delete&id=' . $aFonctionDA->getID () . '\')"><img src="../../../include/images/garbage_empty.png" border="0"/></a></b></td>';
				$aff .= '</tr>';

				$row = ($row == 1 ? 2 : 1);
			}
		}

		$aff .= '</table></div>';

		$aff .= '<script type="text/javascript">
  					$(document).ready(function()  {
  						$("#TableList").treeTable();
  						
  						$("#ex2-node-root").expand();
  						
					});
				</script>';

		echo $aff;
	}
	function render_option($i) {
		$aff = '<select name="DomaineActiviteID">';

		foreach ( $this->myDomaineActiviteListe->getDomaineActiviteListe () as $aMarque ) {
			$aff .= '<option value="' . $aMarque->getID () . '"' . ($i == ($aMarque->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aMarque->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty($i) {
		$aff = '<select name="DomaineActiviteID"><option value="0" SELECTED=SELECTED></option>';

		foreach ( $this->myDomaineActiviteListe->getDomaineActiviteListe () as $aMarque ) {
			$aff .= '<option value="' . $aMarque->getID () . '"' . ($i == ($aMarque->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . htmlentities ( $aMarque->getName (), ENT_QUOTES, 'UTF-8', true ) . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty_named($arrayI, $Nom) {
		$aff = '<select name="' . $Nom . '"><option value="0" SELECTED=SELECTED></option>';

		foreach ( $this->myDomaineActiviteListe->getDomaineActiviteListe () as $aMarque ) {
			$aff .= '<option value="' . $aMarque->getID () . '"' . (in_array ( $aMarque->getID (), $arrayI ) ? ' SELECTED=SELECTED' : '') . '>' . htmlentities ( $aMarque->getName (), ENT_QUOTES, 'UTF-8', true ) . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}

?>