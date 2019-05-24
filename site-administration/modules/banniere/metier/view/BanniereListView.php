<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage banniere
 * @version 1.0.4
 */
class BanniereListView {
	private $myBanniereList;
	public function __construct($aList) {
		$this->myBanniereList = $aList;
	}

	// ###
	public function renderHTML() {
		$this->render ();
	}
	public function render() {
		// Navigation Bar
		$aff = '<div id="FilAriane"><a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;Bannière</div><br/>';

		// Button Bar
		$aff .= '<input type="button" value="Nouveau" onclick="javascript:location.href=\'?action=new\'"/><br/><br/>';

		// List
		$aff .= '<table id="TableList" width="100%">';
		$aff .= '<tr class="title">';
		$aff .= '	<td>Titre</td>';
		$aff .= '	<td>Date Début</td>';
		$aff .= '	<td>Date Fin</td>';
		$aff .= '	<td>Publié</td>';
		// $aff .= ' <td>Par Défaut</td>';
		$aff .= '	<td width="150" colspan="3">Action</td>';
		$aff .= '</tr>';
		$i = 0;
		foreach ( $this->myBanniereList as $aBanniere ) {
			$aff .= '<tr>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' . $aBanniere->getTitre () . '</td>';
			$aff .= '	<td align="center" class="' . ($i == 0 ? 'row1' : 'row2') . '">' . ($aBanniere->getDateDebut () != '' ? CommunFunction::getDateFR ( $aBanniere->getDateDebut () ) : '&nbsp;') . '</td>';
			$aff .= '	<td align="center" class="' . ($i == 0 ? 'row1' : 'row2') . '">' . ($aBanniere->getDateFin () != '' ? CommunFunction::getDateFR ( $aBanniere->getDateFin () ) : '&nbsp;') . '</td>';
			if ($aBanniere->getPublication () == '0') {
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center">-</td>';
			} else {
				$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center"><img src="../../include/images/CheckOK.jpg"/></td>';
			}

			/*
			 * if($aBanniere->getParDefaut()=='0')
			 * {
			 * $aff .= ' <td class="'.($i==0?'row1':'row2').'" align="center">-</td>';
			 * }
			 * else
			 * {
			 * $aff .= ' <td class="'.($i==0?'row1':'row2').'" align="center"><img src="../../include/images/CheckOK.jpg"/></td>';
			 * }
			 */
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="preview.php?id=' . $aBanniere->getID () . '" class="jqModal"><img src="../../include/images/apercu.jpg" border=0/></a></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=edit&id=' . $aBanniere->getID () . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="#" onclick="confirmDelete(' . $aBanniere->getID () . ')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>';

			$i = $i == 0 ? 1 : 0;
		}
		$aff .= '</table>';

		$aff .= '<div class="jqmWindow" id="dialog">';
		$aff .= '</div>';

		echo $aff;
	}
}
?>