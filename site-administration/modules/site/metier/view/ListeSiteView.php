<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage site
 * @version 1.0.4
 */
class ListeSiteView {
	private $myListeSite;

	function __construct($aListeSite)
	{
		$this->myListeSite = $aListeSite;
	}
	function ListeSiteView($aListeSite) {
		self::__construct($aListeSite);
	}

	function render() {
		// Navigation bar
		$aff = '<b><a href="../../index.php">Admin</a>&nbsp;>&nbsp;<a href="index.php">Site</a></b><br/><br/>';

		// Bouton sous menu
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=c\'"/><br/>';
		$aff .= '<br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" class="liste">';
		$aff .= '<tr class="titre">';
		$aff .= '<td align="center" width="50"><b>#</b></td>';
		$aff .= '<td align="center"><b>Nom</b></td>';
		// $aff .= '<td align="center" colspan="2" width="100"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myListeSite->getSiteListe () as $aSite ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aSite->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aSite->getName () . '</td>';

			// $aff .= '<td align="center" class="'.($row==1?'row1':'row2').'" width="50"><b><a href="?action=u&id='.$aSite->getID().'"><img src="../../include/images/document_edit.png" border="0"/></a></b></td>';
			// $aff .= '<td align="center" class="'.($row==1?'row1':'row2').'" width="50"><b><a href="?action=d&id='.$aSite->getID().'"><img src="../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table></div>';
		echo $aff;
	}
	function render_option($i) {
		$aff = '<select name="SiteID">';

		foreach ( $this->myListeSite->getSiteListe () as $aSite ) {
			$aff .= '<option value="' . $aSite->getID () . '"' . ($i == ($aSite->getID ()) ? ' SELECTED=SELECTED' : '') . '>' . $aSite->getName () . '</option>';
		}

		$aff .= '</select>';

		return $aff;
	}
}