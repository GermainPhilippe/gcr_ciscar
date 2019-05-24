<?php
/**
 * Vue de la Fréquentation quotidienne
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 * @version 1.0.4
 */
class FrequentationView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
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
	 * Rendu de la vue des fréquentations
	 */
	public function renderHTML() {
		// Fonction renvoyant le jour en fonction du numéro
		function jour($id) {
			switch ($id) {
				case 0 :
					return 'Dimanche';
					break;
				case 1 :
					return 'Lundi';
					break;
				case 2 :
					return 'Mardi';
					break;
				case 3 :
					return 'Mercredi';
					break;
				case 4 :
					return 'Jeudi';
					break;
				case 5 :
					return 'Vendredi';
					break;
				case 6 :
					return 'Samedi';
					break;
			}
		}
		// On récupère le nom du site sur lequel on est connecté
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
		$aff .= '<div id="FilAriane"><a href="../../?menu=6">Statistiques</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?site=' . $_GET ['site'] . '">' . $site . '</a>&nbsp;>&nbsp;';
		$aff .= 'Fr&eacute;quentation Quotidienne<br /></div><br />';

		$aff .= '<table><tr>';
		$aff .= '<td><img width="15px" height="15px" src="../../include/images/export.jpg" /></td>';
		$aff .= '<td> <a   target="blank" href="metier/getFrequentation.php?export=1&m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '&site=' . $_GET ['site'] . '">  Exporter les données affichées</a></td>';
		$aff .= '</tr></table>';
		// *************************************** Début calendrier ******************************************

		$aff .= '<div align="center" ><form>';
		// Si on a demandé une date
		if (isset ( $_GET ['m'] ) && isset ( $_GET ['a'] )) {
			$aff .= '<a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=frequentation&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] - 1);
			$aff .= '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=frequentation&m=';
			if ($_GET ['m'] == '01') {
				$aff .= '12&a=' . ($_GET ['a'] - 1);
			} else {
				$aff .= ($_GET ['m'] - 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= '<select name="mois"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=frequentation&m=\' + this.form.mois.value + \'&a=' . $_GET ['a'] . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option  value="' . $i . '" ' . ($_GET ['m'] == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $_GET ['a'] . ' <a style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=frequentation&m=';
			if ($_GET ['m'] == '12') {
				$aff .= '01&a=' . ($_GET ['a'] + 1);
			} else {
				$aff .= ($_GET ['m'] + 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=frequentation&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] + 1);
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		} // Sinon on prend le moi et l'année en cours
		else {
			$aff .= '<a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=frequentation&m=' . $mois_actuel . '&a=' . ($annee_actuelle - 1);
			$aff .= '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=frequentation&m=';
			if ($mois_actuel == '01') {
				$aff .= '12&a=' . ($annee_actuelle - 1);
			} else {
				$aff .= ($mois_actuel - 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= ' <select name="mois"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=frequentation&m=\' + this.form.mois.value + \'&a=' . $annee_actuelle . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option  value="' . $i . '" ' . ($mois_actuel == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $annee_actuelle . '<a style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=frequentation&m=';
			if ($mois_actuel == '12') {
				$aff .= '01&a=' . ($annee_actuelle + 1);
			} else {
				$aff .= ($mois_actuel + 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=frequentation&m=' . $mois_actuel . '&a=' . ($annee_actuelle + 1);
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		}
		$aff .= '</div></form><br />';
		// ***************************************** Fin calendrier ******************************************

		// On génère le graphique en appelant la vue avec les paramètres nécessaires
		$m = (isset ( $_GET ['m'] )) ? $_GET ['m'] : date ( 'm', $time );
		$y = (isset ( $_GET ['a'] )) ? $_GET ['a'] : date ( 'Y', $time );
		$aff .= '<div align="center"><img src="metier/view/FrequentationGraphView.php?m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '&site=' . $_GET ['site'] . '"  /></div><br /><br />';

		// Création du tableau
		$aff .= '<table id="TableList"  width="400">';
		$aff .= '<tr class="title">';
		$aff .= '	<td align="center" width="200"><b>Jour</b></td>';
		$aff .= '	<td align="center"  width="200"><b>Nombre de connexions</b></td>';
		$aff .= '</tr>';
		$row = 1;
		if ($this->myList != NULL) {
			foreach ( $this->myList as $aCle => $aVerif ) {
				$aff .= '<tr >';
				$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" style="font-style:italic;" >' . jour ( date ( "w", mktime ( 0, 0, 0, $m, $aCle, $y ) ) ) . '  &nbsp; ' . (($aCle < 10) ? '0' . $aCle : $aCle) . '/' . $m . '/' . $y . '</td>';
				$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200">' . $aVerif . '</td>';
				$aff .= '</tr>';
				$row = ($row == 1 ? 2 : 1);
			}
		} else {
			$aff .= "<tr><td class=\"row1\"> Aucune donnée</td></tr>";
		}

		$aff .= '</table>';
		echo $aff;
	}
}
?>