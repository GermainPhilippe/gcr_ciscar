<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class MarqueListeView {
	private $myMarqueListe;

	function __construct($aMarqueListe)
	{
		$this->myMarqueListe = $aMarqueListe;
	}
	function MarqueListeView($aMarqueListe) {
		self::__construct($aMarqueListe);
	}
	
	function render() {
		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;Marque';
		$aff .= '</div><br/><br/>';

		// Bouton sous menu
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=c\'"/>';
		// Button Bar
		$aff .= '<br/><br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><b>#</b></td>';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center" colspan="2" width="100"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myMarqueListe->getMarqueListe () as $aMarque ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aMarque->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aMarque->getName () . '</td>';

			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=u&id=' . $aMarque->getID () . '"><img src="../../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmBeforeGoTo(\'Confirmation Suppression\',\'?action=d&id=' . $aMarque->getID () . '\')"><img src="../../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table></div>';
		echo $aff;
	}
	function render_option($i) {
		$aff = '<select name="MarqueID">';

		foreach ( $this->myMarqueListe->getMarqueListe () as $aMarque ) {
			$aff .= '<option value="' . $aMarque->getID () . '"' . ($i == ($aMarque->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aMarque->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
	function render_option_width_empty($i, $no_marque) {
		switch ($no_marque) {
			case 1 :
				$aff = '<select name="Marque1ID"><option value="0" SELECTED=SELECTED></option>';
				break;
			case 2 :
				$aff = '<select name="Marque2ID"><option value="0" SELECTED=SELECTED></option>';
				break;
			case 3 :
				$aff = '<select name="Marque3ID"><option value="0" SELECTED=SELECTED></option>';
				break;
			case 4 :
				$aff = '<select name="Marque4ID"><option value="0" SELECTED=SELECTED></option>';
				break;
			case 5 :
				$aff = '<select name="Marque5ID"><option value="0" SELECTED=SELECTED></option>';
				break;
			default :
				$aff = '<select name="MarqueID"><option value="0" SELECTED=SELECTED></option>';
		}

		foreach ( $this->myMarqueListe->getMarqueListe () as $aMarque ) {
			$aff .= '<option value="' . $aMarque->getID () . '"' . ($i == ($aMarque->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aMarque->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}
?>