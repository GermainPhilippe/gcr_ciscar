<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class MembreGroupeView {
	private $myMembreListe;

	function __construct($aMembreListe)
	{
		$this->myMembreListe = $aMembreListe;
	}
	function MembreGroupeView($aMembreListe) {
		self::__construct($aMembreListe);
	}
	
	function render($mod) {
		// Navigation bar
		$aff = '<div id="FilAriane"><a href="../../index.php">Général</a>&nbsp;>&nbsp;';
		$aff .= '<a href="index.php">LCA</a>&nbsp;>&nbsp;';

		$aGroupe = new GroupeLCA ();
		$aGroupe->select_groupelca ( $_GET ['id'] );

		if ($mod == 'list') {
			$aff .= 'Liste des Membres(' . $aGroupe->getName () . ')</div><br/><br/>';
		} elseif ($mod == 'add') {
			$aff .= 'Ajouter un Membre(' . $aGroupe->getName () . ')</div><br/><br/>';
		}

		// Bouton sous menu
		$aff .= '<input type="button" value="Nouveau" onclick="javascript:location.href=\'?action=add&id=' . $_GET ['id'] . '\'" />';
		$aff .= '<br/><br/>';

		// Tableau
		$aff .= '<table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><b>#</b></td>';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center"><b>Prenom</b></td>';
		$aff .= '<td align="center" width="50"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myMembreListe->getMembreListe () as $aMembre ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aMembre->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aMembre->getNom () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aMembre->getPrenom () . '</td>';

			if ($mod == 'list') {
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=d&id=' . $_GET ['id'] . '&idi=' . $aMembre->getID () . '"><img src="../../include/images/garbage_empty.png" width="16" border="0"/></a></b></td>';
			} else if ($mod == 'add') {
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=add&id=' . $_GET ['id'] . '&idi=' . $aMembre->getID () . '"><img src="../../include/images/ic_icon_exp.gif" width="16" border="0"/></a></b></td>';
			}

			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		if ($this->myMembreListe->getNbMembre () == 0) {
			$aff .= '<tr>';
			$aff .= '<td colspan="7"><i>Aucun Membre trouv&eacute;</i></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table>';
		echo $aff;
	}
	public function redirection($url) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href="' . $url . '";';
		$aff .= '</script>';
		echo $aff;
	}
}

?>