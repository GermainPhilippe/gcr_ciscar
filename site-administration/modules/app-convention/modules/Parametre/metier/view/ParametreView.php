<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Parametre
 * @version 1.0.4
 */
class ParametreView {
	private $myParametre;
	public function __construct($aParametre) {
		$this->myParametre = $aParametre;
	}
	public function renderHTML($mod) {
		$aff = '<b><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;Paramétrage</b><br/><br/>';
		$aff .= '<input type="button" value="Retour" onclick="location.href=\'?\'"/><br/><br/>';

		switch ($mod) {
			case 'new' :
				$aff .= '<form method="POST" action="?action=new">';
				break;
			case 'edit' :
				$aff .= '<form method="POST" action="?action=edit&id=' . $this->myParametre->getID () . '">';
				break;
			case 'delete' :
				$aff .= '<form method="POST" action="?action=delete&id=' . $this->myParametre->getID () . '">';
				break;
		}

		$aff .= '<table>';

		$aff .= '<tr>';
		$aff .= '	<td>#</td>';
		$aff .= '	<td>' . $this->myParametre->getID () . '</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Nom</td>';
		$aff .= '	<td><input type="text" name="Nom" value="' . $this->myParametre->getNom () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Valeur</td>';
		$aff .= '	<td><textarea name="Valeur">' . $this->myParametre->getValeur () . '</textarea></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';

		switch ($mod) {
			case 'new' :
				$aff .= '	<td colspan="2"><input type="submit" value="Creer"/></td>';
				break;
			case 'edit' :
				$aff .= '	<td colspan="2"><input type="submit" value="Mise a jour"/></td>';
				break;
			case 'delete' :
				$aff .= '	<td colspan="2"><input type="submit" value="Supprimer"/></td>';
				break;
		}

		$aff .= '</tr>';
		$aff .= '</table>';

		$aff .= '</form>';

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