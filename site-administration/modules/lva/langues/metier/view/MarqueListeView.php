<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class LangueListeView {
	private $myLangueListe;

	function __construct($aLangueListe)
	{
		$this->myLangueListe = $aLangueListe;
	}
	function LangueListeView($aLangueListe) {
		self::__construct($aLangueListe);
	}
	
	function render() {
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../?">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;Langue';
		$aff .= '</div><br/><br/>';

		// Bouton sous menu
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=c\'"/><br/>';
		$aff .= '<br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><b>#</b></td>';
		$aff .= '<td align="center"><b>Code</b></td>';
		$aff .= '<td align="center"><b>Langue</b></td>';
		$aff .= '<td align="center" colspan="2" width="100"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		if (count ( $this->myLangueListe->getLangueListe () ) > 0) {
			foreach ( $this->myLangueListe->getLangueListe () as $aLangue ) {
				$aff .= '<tr>';
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aLangue->getID () . '</td>';
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aLangue->getCode () . '</td>';
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aLangue->getName () . '</td>';

				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=u&id=' . $aLangue->getID () . '"><img src="../../../include/images/document_edit.png" border="0"/></a></b></td>';
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmBeforeGoTo(\'Confirmation Suppression\',\'?action=d&id=' . $aLangue->getID () . '\')"><img src="../../../include/images/garbage_empty.png" border="0"/></a></b></td>';
				$aff .= '</tr>';

				$row = ($row == 1 ? 2 : 1);
			}
		} else {
			$aff .= '<tr>';
			$aff .= '<td align="center" colspan="5" class="row1">Aucune lange de déclarée</td>';
			$aff .= '</tr>';
		}

		$aff .= '</table></div>';
		echo $aff;
	}
	function render_option($i) {
		$aff = '<select name="LangueID">';

		foreach ( $this->myLangueListe->getLangueListe () as $aLangue ) {
			$aff .= '<option value="' . $aLangue->getID () . '"' . ($i == ($aLangue->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aLangue->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty($i) {
		$aff = '<select name="LangueID"><option value="0" SELECTED=SELECTED></option>';

		foreach ( $this->myLangueListe->getLangueListe () as $aLangue ) {
			$aff .= '<option value="' . $aLangue->getID () . '"' . ($i == ($aLangue->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aLangue->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}

?>