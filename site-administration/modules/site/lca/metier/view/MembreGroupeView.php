<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class MembreSiteGroupeLCAView {
	private $myMembreListe;

	function __construct($aMembreListe)
	{
		$this->myMembreListe = $aMembreListe;
	}
	function MembreSiteGroupeLCAView($aMembreListe) {
		self::__construct($aMembreListe);
	}
	
	function render() {
		// Navigation bar
		$aff = '<b><a href="../../../index.php">Admin</a>&nbsp;>&nbsp;';
		$aff .= '<a href="index.php">LCA Individu</a>&nbsp;>&nbsp;';

		$aGroupe = new SiteGroupeLCA ();
		$aGroupe->select_groupelca ( $_GET ['id'] );

		$aff .= 'Liste des Membres(' . $aGroupe->getName () . ')</b><br/><br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" class="liste">';
		$aff .= '<tr class="titre">';
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
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="../../../modules/individu/?action=u&id=' . $aMembre->getID () . '"><img src="../../../include/images/document_edit.png" width="16" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		if ($this->myMembreListe->getNbMembre () == 0) {
			$aff .= '<tr>';
			$aff .= '<td colspan="7"><i>Aucun Membre trouv&eacute;</i></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table></div>';
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