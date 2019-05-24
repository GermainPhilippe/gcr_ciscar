<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class LCAGroupeView {
	private $myLCAGroupe;
	public function __construct($aLCAGroupe) {
		$this->myLCAGroupe = $aLCAGroupe;
	}

	// ###
	public function renderHTML($mod) {
		$aff = '<div id="FilAriane"><a href="../../index.php?menu=1">Général</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">LCA</a>';

		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Cr&eacute;ation</div><br/><br/>';
				$aff .= '<form method="POST" action="?action=new">';
				break;
			case 'edit' :
				$aff .= '&nbsp;>&nbsp;Edition</div><br/><br/>';
				$aff .= '<form method="POST" action="?action=edit&id=' . $this->myLCAGroupe->getID () . '">';
				break;
		}

		$aff .= '<table>';
		$aff .= '<tr><td>Nom du groupe</td><td><input type="text" name="Nom" value="' . $this->myLCAGroupe->getLibelle () . '"/></td></tr>';
		$aff .= '</table>';

		switch ($mod) {
			case 'new' :
				$aff .= '<input type="submit" value="Cr&eacute;er"/>';
				$aff .= '</form>';
				break;
			case 'edit' :
				$aff .= '<input type="submit" value="Mettre &agrave; jour"/>';
				$aff .= '</form>';
				break;
		}

		echo $aff;
	}
}
?>