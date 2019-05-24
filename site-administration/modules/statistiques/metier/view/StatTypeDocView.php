<?php
/**
 * Vue de la répartition par type
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 * @version 1.0.4
 */
class StatTypeDocView {
	private $myList;
	private $myTotal;
	private $myCategorie;
	public function __construct($aList, $aTotal, $aCategorie) {
		$this->myList = $aList;
		$this->myTotal = $aTotal;
		$this->myCategorie = $aCategorie;
	}
	/**
	 * Rendu du style de la page
	 */
	public function renderstyle() {
		$aff = '<style>';
		$aff .= 'td.center {text-align:center;}';
		$aff .= '</style>';

		return $aff;
	}
	/**
	 * Création du tableau
	 */
	public function renderHTML() {
		// On récupère le nom du site
		switch ($_GET ['site']) {
			case 1 :
				$site = 'CISCAR';
				break;
			case 3 :
				$site = 'ACNF';
				break;
			case 2 :
				$site = 'GCR';
				break;
			case 7 :
				$site = 'GCRE';
				break;
		}

		// Mois et année du jour
		$time = time ();
		$mois_actuel = date ( 'm', $time );
		$annee_actuelle = date ( 'Y', $time );
		$aff = $this->renderstyle ();
		$aff .= '<div id="FilAriane"><a href="../../menu=6">Statistiques</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?site=' . $_GET ['site'] . '">' . $site . '</a>&nbsp;>&nbsp;';
		$aff .= 'Répartitions par Type de publication<br /></div><br />';

		$aff .= '<table><tr>';
		$aff .= '<td><img width="15px" height="15px" src="../../include/images/export.jpg" /></td>';
		$aff .= '<td> <a   target="blank" href="metier/getTypeDoc.php?export=1&m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '&site=' . $_GET ['site'] . '">  Exporter les données affichées</a></td>';
		$aff .= '</tr></table>';

		// *************************************** Début calendrier ******************************************

		$aff .= '<div align="center" ><form>';
		// Si on a demandé une date
		if (isset ( $_GET ['m'] ) && isset ( $_GET ['a'] )) {
			$aff .= '<a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=type&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] - 1);
			$aff .= '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=type&m=';
			if ($_GET ['m'] == '01') {
				$aff .= '12&a=' . ($_GET ['a'] - 1);
			} else {
				$aff .= ($_GET ['m'] - 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= '<select name="mois"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=type&m=\' + this.form.mois.value + \'&a=' . $_GET ['a'] . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option value="' . $i . '" ' . ($_GET ['m'] == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $_GET ['a'] . ' <a style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=type&m=';
			if ($_GET ['m'] == '12') {
				$aff .= '01&a=' . ($_GET ['a'] + 1);
			} else {
				$aff .= ($_GET ['m'] + 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=type&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] + 1);
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		} // Sinon on prend le moi et l'année actuels
		else {
			$aff .= '<a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=type&m=' . $mois_actuel . '&a=' . ($annee_actuelle - 1);
			$aff .= '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=type&m=';
			if ($mois_actuel == '01') {
				$aff .= '12&a=' . ($annee_actuelle - 1);
			} else {
				$aff .= ($mois_actuel - 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= ' <select name="mois"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=type&m=\' + this.form.mois.value + \'&a=' . $annee_actuelle . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option  value="' . $i . '" ' . ($mois_actuel == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $annee_actuelle . '<a style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=type&m=';
			if ($mois_actuel == '12') {
				$aff .= '01&a=' . ($annee_actuelle + 1);
			} else {
				$aff .= ($mois_actuel + 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=type&m=' . $mois_actuel . '&a=' . ($annee_actuelle + 1);
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		}
		$aff .= '</div></form><br />';
		// *************************************** Fin calendrier ******************************************

		// On génère le graphique en appelant la vue avec les paramètres nécessaires
		$aff .= '<div align="center"><img src="metier/view/TypeGraphView.php?m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '&site=' . $_GET ['site'] . '"  /></div><br /><br />';

		// création du tableau
		$aff .= '<table id="TableList"  width="100%">';
		$aff .= '<tr class="title">';
		$aff .= '	<td align="center"><b>Type</b></td>';
		$aff .= '	<td align="center"  width="200"><b>Nombre de consultations</b></td><td>%</td>';
		$aff .= '</tr>';
		$aff .= '<tr><td class="row2" align="center" style="font-weight:bold;">Total</td></td><td class="row2" align="center" style="font-weight:bold;">' . $this->myTotal . '</td>';
		$aff .= '<td class="row2" align="center" style="font-weight:bold;">100%<td></tr>';
		$row = 1;
		$aType = '';
		$time = time ();

		foreach ( $this->myList->getList () as $aVerif => $aCle ) {
			$aConsult = new StatConsultType ();
			$aff .= '<tr  >';
			$aff .= '	<td   class="row2" align="center"  style="font-weight:bold;">' . $aConsult->SQL_SELECT_NAME ( $aVerif ) . '</td>';
			$aff .= '	<td   class="row2" align="center" width="200">' . $aCle . '</td>';
			$aff .= '	<td   class="row2" align="center" width="200">';
			$aff .= round ( ($aCle / $this->myTotal) * 100 );
			$aff .= '%</td>';
			$aff .= '</tr>';
			$row = ($row == 1 ? 2 : 1);
		}
		$aff .= '</table>';
		echo $aff;
	}
}
?>