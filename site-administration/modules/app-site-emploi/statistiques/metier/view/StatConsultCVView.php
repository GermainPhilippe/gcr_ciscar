<?php
/**
 * Vue des consultations de la CVthéque
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage statistiques
 * @version 1.0.4
 */
class StatConsultCVView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	/**
	 *
	 * rendu du style de la vue
	 *
	 * @return string
	 */
	public function renderstyle() {
		$aff = '<style>';
		$aff .= 'td.center {text-align:center;}';
		$aff .= '</style>';

		return $aff;
	}
	/**
	 * rendu de la vue
	 */
	public function renderHTML() {

		// Mois et année du jour
		$time = time ();
		$mois_actuel = date ( 'm', $time );
		$annee_actuelle = date ( 'Y', $time );
		$aff = $this->renderstyle ();
		$aff .= '<div id="FilAriane"><a href="../../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">Statistiques Site Emploi</a>&nbsp;>&nbsp;';
		$aff .= 'Accès à la CVthéque<br /></div><br />';

		$aff .= '<table><tr>';
		$aff .= '<td><img width="15px" height="15px" src="../../../include/images/export.jpg" /></td>';
		$aff .= '<td> <a   target="blank" href="../statistiques/metier/getConsultCV.php?export=1&m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '">  Exporter les données affichées</a></td>';
		$aff .= '</tr></table>';

		// *************************************** Début calendrier ******************************************

		$aff .= '<div align="center" ><form>';
		// Si on a demandé une date
		if (isset ( $_GET ['m'] ) && isset ( $_GET ['a'] )) {
			$aff .= '<a  style="background-image:url(\'../../../include/images/3.png\');" href="?action=consult_cv&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] - 1);
			$aff .= '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../../include/images/3.png\');" href="?action=consult_cv&m=';
			if ($_GET ['m'] == '01') {
				$aff .= '12&a=' . ($_GET ['a'] - 1);
			} else {
				$aff .= ($_GET ['m'] - 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= '<select name="mois"  onChange="window.location=\'/admin/modules/app-site-emploi/statistiques/index.php?action=consult_cv&m=\' + this.form.mois.value + \'&a=' . $_GET ['a'] . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option value="' . $i . '" ' . ($_GET ['m'] == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $_GET ['a'] . ' <a style="background-image:url(\'../../../include/images/1.png\');" href="?action=consult_cv&m=';
			if ($_GET ['m'] == '12') {
				$aff .= '01&a=' . ($_GET ['a'] + 1);
			} else {
				$aff .= ($_GET ['m'] + 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../../include/images/1.png\');" href="?action=consult_cv&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] + 1);
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		} // Sinon on prend le mois et l'année actuels
		else {
			$aff .= '<a  style="background-image:url(\'../../../include/images/3.png\');" href="?action=consult_cv&m=' . $mois_actuel . '&a=' . ($annee_actuelle - 1);
			$aff .= '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a style="background-image:url(\'../../../include/images/3.png\');" href="?action=consult_cv&m=';
			if ($mois_actuel == '01') {
				$aff .= '12&a=' . ($annee_actuelle - 1);
			} else {
				$aff .= ($mois_actuel - 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= ' <select name="mois"  onChange="window.location=\'/admin/modules/app-site-emploi/statistiques/index.php?action=consult_cv&m=\' + this.form.mois.value + \'&a=' . $annee_actuelle . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option value="' . $i . '" ' . ($mois_actuel == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $annee_actuelle . '<a style="background-image:url(\'../../../include/images/1.png\');" href="?action=consult_cv&m=';
			if ($mois_actuel == '12') {
				$aff .= '01&a=' . ($annee_actuelle + 1);
			} else {
				$aff .= ($mois_actuel + 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../../include/images/1.png\');" href="?action=consult_cv&m=' . $mois_actuel . '&a=' . ($annee_actuelle + 1);
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		}
		$aff .= '</div></form><br />';
		// *************************************** Fin calendrier ******************************************
		// Création du tableau
		$aff .= '<table id="TableList"  width="100%">';
		$aff .= '<tr class="title">';
		$aff .= '	<td align="center"><b>Date</b></td>';
		$aff .= '	<td align="center"><b>Heure</b></td>';
		$aff .= '	<td align="center"  ><b>Nom</b></td>';
		$aff .= '	<td align="center"  ><b>Prénom</b></td>';
		$aff .= '	<td align="center"  ><b>Domaine d\'activité</b></td>';
		$aff .= '	<td align="center"  ><b>Fonction</b></td>';
		$aff .= '	<td align="center"  ><b>Groupe</b></td>';

		$aff .= '</tr>';
		$row = 1;

		foreach ( $this->myList->getList () as $aVerif ) {
			$date = explode ( ' ', $aVerif->getdate () );
			$fr = FunctionDate::getDateFr ( $date [0] );
			$aff .= '<tr >';
			$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200"> ' . $fr . '</td>';
			$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200"> ' . $date [1] . '</td>';
			$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200">' . $aVerif->getnom () . '</td>';
			$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200">' . $aVerif->getprenom () . '</td>';
			$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200">' . $aVerif->getdomaine () . '</td>';
			$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200">' . $aVerif->getfonction () . '</td>';
			$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200">' . $aVerif->getgroupe () . '</td>';
			$aff .= '</tr>';
			$row = ($row == 1 ? 2 : 1);
		}
		$aff .= '</table>';
		echo $aff;
	}
}
?>