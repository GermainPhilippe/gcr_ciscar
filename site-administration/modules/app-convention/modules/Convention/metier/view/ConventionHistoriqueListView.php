<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Convention
 * @version 1.0.4
 */
class ConventionHistoriqueListView {
	private $myConventionHistoriqueList;
	public function __construct($aConventionHistoriqueList) {
		$this->myConventionHistoriqueList = $aConventionHistoriqueList;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane"><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;<a href="?">Conventions</a>&nbsp;>&nbsp;Historique</div><br/><br/>';

		$aff .= '<table id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '	<td align="center"><b>#</b></td>';
		$aff .= '	<td align="center"><b>Date</b></td>';
		$aff .= '	<td align="center"><b>Description</b></td>';
		$aff .= '</tr>';

		if (count ( $this->myConventionHistoriqueList->getList () ) > 0) {
			$row = 1;
			foreach ( $this->myConventionHistoriqueList->getList () as $ConventionHistorique ) {
				$aff .= '<tr>';
				$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $ConventionHistorique->getID () . '</td>';
				$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $this->getDateFR ( $ConventionHistorique->getDateAction () ) . '</td>';
				$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $ConventionHistorique->getDescription () ) . '</td>';
				$aff .= '</tr>';
				$row = ($row == 1 ? 2 : 1);
			}
		} else {
			$aff .= '<tr><td colspan="3"><i>Pas d\'historique</i></td></tr>';
		}
		$aff .= '</table>';

		echo $aff;
	}
	public function getDateFR($DateEN) {
		$tab = preg_split ( "/-+/", $DateEN, 3 );
		return $tab [2] . '/' . $tab [1] . '/' . $tab [0];
	}
}
?>