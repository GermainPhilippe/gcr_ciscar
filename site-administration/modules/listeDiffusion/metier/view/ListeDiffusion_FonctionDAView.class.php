<?php
class ListeDiffusion_FonctionDAView {
	private $myDomaineActiviteListe;
	public function __construct($aDomaineActiviteListe) {
		$this->myDomaineActiviteListe = $aDomaineActiviteListe;
	}
	function renderHTML() {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		// $aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;';
		// $aff .= '<a href="?">Liste Diffusion</a>'."\n";
		$aff .= 'Crit&egrave;re Fonction Domaine d\'Activite';
		$aff .= '</div>' . "\n";

		// Button Bar
		$aff .= '<br/><br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title" id="ex2-node-root">';
		$aff .= '<td align="center" width="100"><b>NumOrdre</b></td>';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center" width="50" colspan="2"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myDomaineActiviteListe as $aMarque ) {
			$aff .= '<tr id="ex2-node-' . $aMarque->getID () . '" class="child-of-ex2-node-root">';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="100">' . $aMarque->getNumOrdre () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aMarque->getName () ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50">&nbsp;</td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);

			$aFonctionDAList = new FonctionDAList ();
			$aFonctionDAList->SQL_SELECT_ALL ( $aMarque->getID () );

			foreach ( $aFonctionDAList->getList () as $aFonctionDA ) {
				$aff .= '<tr id="ex2-node-' . $aMarque->getID () . '-' . $aFonctionDA->getID () . '" class="child-of-ex2-node-' . $aMarque->getID () . '">';
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="100">' . $aFonctionDA->getNumOrdre () . '</td>';
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" colspan="2">' . stripslashes ( $aFonctionDA->getLibelle () ) . '</td>';
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a onclick="javascript:addRule(\'' . $aFonctionDA->getID () . '\',\'' . addslashes ( $aFonctionDA->getLibelle () ) . '\')"><img src="../../include/images/add.png" border="0"/></a></td>';
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
}
?>