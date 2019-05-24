<?php
/**
 *Vue non utilisée
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage offre
 * @version 1.0.4
 */
class TriOffreView {
	public function __construct() {
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function render() {
		$aff = '<b><a href="../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;Offres<br /><br /></b>';

		$aff .= '<table>';
		$aff .= '<tr><td><a href="?action=offres&list=num">Liste des offres triées par numéro</a></td></tr>';
		$aff .= '<tr><td><a href="?action=offres&list=date">Liste des offres triées par date</a></td></tr>';
		$aff .= '<tr><td><a href="?action=offres&list=pub">Liste des offres non plubliées</a></td></tr>';
		$aff .= '</table>';
		$aff .= '<tr><td></td></tr>';
		$aff .= '<tr><td></td></tr>';
		$aff .= '<tr><td></td></tr>';
		$aff .= '<tr><td></td></tr>';

		echo $aff;
	}
}

?>