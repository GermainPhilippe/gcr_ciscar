<?php
/**
 * Vue non utilisée
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage statistiques
 * @version 1.0.4
 */
class StatOffreDateView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function renderstyle() {
		$aff = '<style>';
		$aff .= 'td.center {text-align:center;}';
		$aff .= '</style>';

		return $aff;
	}

	/**
	 *
	 * @deprecated
	 *
	 */
	public function renderHTML() {
		$aff = $this->renderstyle ();

		$aff .= '<div id="FilAriane"><a href="../../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">Statistiques Site Emploi</a>&nbsp;>&nbsp;Offres par date de création</div><br /><br />';

		// *************************************** Début calendrier ******************************************
		// Mois et année du jour
		$time = time ();
		$mois_actuel = date ( 'm', $time );
		$annee_actuelle = date ( 'Y', $time );
		$aff .= '<div align="center" ><form>';
		// Si on a demandé une date
		if (isset ( $_GET ['m'] ) && isset ( $_GET ['a'] )) {
			$aff .= '<a  style="background-image:url(\'../../../include/images/3.png\');" href="?action=offre_date&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] - 1);
			$aff .= '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../../include/images/3.png\');" href="?action=offre_date&m=';
			if ($_GET ['m'] == '01') {
				$aff .= '12&a=' . ($_GET ['a'] - 1);
			} else {
				$aff .= ($_GET ['m'] - 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= '<select name="mois"  onChange="window.location=\'/admin/modules/app-site-emploi/statistiques/index.php?action=offre_date&m=\' + this.form.mois.value + \'&a=' . $_GET ['a'] . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option value="' . $i . '" ' . ($_GET ['m'] == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $_GET ['a'] . ' <a style="background-image:url(\'../../../include/images/1.png\');" href="?action=offre_date&m=';
			if ($_GET ['m'] == '12') {
				$aff .= '01&a=' . ($_GET ['a'] + 1);
			} else {
				$aff .= ($_GET ['m'] + 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../../include/images/1.png\');" href="?action=offre_date&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] + 1);
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		} // Sinon on prend le moi et l'année actuels
		else {
			$aff .= '<a  style="background-image:url(\'../../../include/images/3.png\');" href="?action=offre_date&m=' . $mois_actuel . '&a=' . ($annee_actuelle - 1);
			$aff .= '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a style="background-image:url(\'../../../include/images/3.png\');" href="?action=offre_date&m=';
			if ($mois_actuel == '01') {
				$aff .= '12&a=' . ($annee_actuelle - 1);
			} else {
				$aff .= ($mois_actuel - 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= ' <select name="mois"  onChange="window.location=\'/admin/modules/app-site-emploi/statistiques/index.php?action=offre_date&m=\' + this.form.mois.value + \'&a=' . $annee_actuelle . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option value="' . $i . '" ' . ($mois_actuel == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $annee_actuelle . '<a style="background-image:url(\'../../../include/images/1.png\');" href="?action=offre_date&m=';
			if ($mois_actuel == '12') {
				$aff .= '01&a=' . ($annee_actuelle + 1);
			} else {
				$aff .= ($mois_actuel + 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../../include/images/1.png\');" href="?action=offre_date&m=' . $mois_actuel . '&a=' . ($annee_actuelle + 1);
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		}
		$aff .= '</div></form><br />';
		// *************************************** Fin calendrier ******************************************

		$aff .= '<table id="TableList" width="100%">';
		$aff .= '<tr class="title">';
		$aff .= '	<td align="center" style="padding-right:5px;" width="100"><b>Date</b></td>';
		$aff .= '	<td align="center"><b>Titre de l\'Offre</b></td>';
		$aff .= '</tr>';

		$row = 1;

		foreach ( $this->myList->getList () as $aVerif ) {

			$aff .= '<tr >';
			$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="right" style="padding-right:5px;" width="100">' . CommunFunction::getDateFR ( $aVerif->getdateoffre () ) . '</td>';
			$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" >' . $aVerif->gettitreoffre () . '</td>';
			$aff .= '</tr>';
			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table><br />';
		$aff .= ' <a  target="blank" href="../statistiques/metier/getOffreDate.php?export=1&m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '"> -> Exporter les données affichées</a>';
		$aff .= '<br /> <a  target="blank" href="../statistiques/metier/getOffreDate.php?export=2"> -> Exporter l\'ensemble des données </a>';

		echo $aff;
	}
}
?>