<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class RegionView {
	private $myRegion;

	function __construct($aRegion)
	{
		$this->myRegion = $aRegion;
	}
	function RegionView($aRegion) {
		self::__construct($aRegion);
	}
	
	// ###############
	function render($mod, $annu) {

		// Navigation bar
		if ($annu == 0) {
			$aff = '<div id="FilAriane">';
			$aff .= '	<a href="../../../index.php?menu=2">Site</a>&nbsp;>&nbsp;';
			$aff .= '	<a href="../index.php">Liste Valeurs Annuaire</a>&nbsp;>&nbsp;';
			$aff .= '	<a href="index.php">R&eacute;gion</a>&nbsp;>&nbsp;';
		} else {
			$aff = '<div id="FilAriane">';
			$aff .= '	<a href="../../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;';
			$aff .= '	<a href="index.php?annu=' . $annu . '">R&eacute;gion</a>&nbsp;>&nbsp;';
		}

		// Formualire
		if ($mod == 'c') {
			$aff .= 'Création</div><br/><br/>';
			$aff .= '<form method="POST" action="?action=c&annu=' . $annu . '">';
		} else if ($mod == 'u') {
			$aff .= 'Edition</div><br/><br/>';
			$aff .= '<form method="POST" action="?action=u&annu=' . $annu . '&id=' . $this->myRegion->getID () . '">';
		}

		$aff .= '<table width="800">';

		if ($mod == 'u') {
			$aff .= '<tr>';
			$aff .= '<td>#</td>';
			$aff .= '<td><input type="text" name="RegionID" value="' . $this->myRegion->getID () . '" readonly/></td>';
			$aff .= '</tr>';
		}

		$aff .= '<tr>';
		$aff .= '<td>Nom</td>';
		$aff .= '<td><input type="text" name="Nom" value="' . $this->myRegion->getName () . '" maxlength="100" size="100" /></td>';
		$aff .= '</tr>';

		// Annuaire
		$aDepartementListe = new DepartementListe ();
		$aDepartementListe->select_all_departement ();

		if ($mod == 'u') {
			$aDepartementListeSelected = new DepartementListe ();
			$aDepartementListeSelected->select_all_selected_departement ( $this->myRegion->getID () );
		}

		$aff .= '<tr>';
		$aff .= '<td>Liste D&eacute;partement*</td>';
		$aff .= '<table style="font-size:10;"><tr>';

		$i = 0;
		foreach ( $aDepartementListe->getDepartementListe () as $aDepartement ) {
			if ($i == 0) {
				$aff .= '<td>';
			}

			if ($mod == 'u') {
				$aff .= '<label><input type="checkbox" name="dep_' . $aDepartement->getID () . '" value="' . $aDepartement->getID () . '"' . ($aDepartementListeSelected->departement_exist ( $aDepartement->getID () ) ? ' checked' : '') . '> ' . $aDepartement->getCode () . ' - ' . $aDepartement->getName () . '</label><br>';
			} else {
				$aff .= '<label><input type="checkbox" name="dep_' . $aDepartement->getID () . '" value="' . $aDepartement->getID () . '"> ' . $aDepartement->getCode () . ' - ' . $aDepartement->getName () . '</label><br>';
			}
			$i ++;
			if ($i == 20) {
				$aff .= '</td>';
				$i = 0;
			}
		}
		$aff .= '</tr></table></tr>';

		$aff .= '<tr>';
		if ($mod == 'c') {
			$aff .= '<td colspan="2"><input type="submit" value="Cr&eacute;er"></td>';
		} else if ($mod == 'u') {
			$aff .= '<td colspan="2"><input type="submit" value="Mettre &agrave; Jour"></td>';
		}
		$aff .= '</tr>';

		$aff .= '</table></form>';
		echo $aff;
	}
}
?>