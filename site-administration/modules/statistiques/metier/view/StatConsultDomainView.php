<?php
/**
 * Vue de la répartition par domaine
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 * @version 1.0.4
 */
class StatConsultDomainView {
	private $myList;
	private $myTotal;
	private $myDomaine;
	public function __construct($aList, $aTotal, $aDomaine) {
		$this->myList = $aList;
		$this->myTotal = $aTotal;
		$this->myDomaine = $aDomaine;
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
		// On récupère le site sur lequel on est connecté
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
		$aff .= 'Répartition par Domaine<br /></div><br />';

		$aff .= '<table><tr>';
		$aff .= '<td><img width="15px" height="15px" src="../../include/images/export.jpg" /></td>';
		$aff .= '<td> <a   target="blank" href="metier/getDomaine.php?export=1&m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '&site=' . $_GET ['site'] . '">  Exporter les données affichées</a></td>';
		$aff .= '</tr></table>';

		// *************************************** Début calendrier ******************************************
		// Choix de la catégorie du document
		// Si on a demandé une date, on a une catégorie de sélectionné
		if (isset ( $_GET ['m'] ) && isset ( $_GET ['a'] )) {

			$aff .= '<div align="center"><form>Type de Documents<select name="type"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=domaine&type=\' + this.form.type.value + \'&m=' . $_GET ['m'] . '&a=' . $_GET ['a'] . '\'">';
			$aff .= '<option  value="3" ' . (isset ( $_GET ['type'] ) && $_GET ['type'] == '3' ? 'selected' : '') . '>Tous</option>';
			$aff .= '<option  value="0" ' . (isset ( $_GET ['type'] ) && $_GET ['type'] == '0' ? 'selected' : '') . '>DocInfoDyn</option>';
			$aff .= '<option value="1" ' . (isset ( $_GET ['type'] ) && $_GET ['type'] == '1' ? 'selected' : '') . '>DocStatic</option>';
			$aff .= '<option  value="2" ' . (isset ( $_GET ['type'] ) && $_GET ['type'] == '2' ? 'selected' : '') . '>DocPartenaire</option>';

			$aff .= '</select> </form></div><br />';
		} // Sinon la vue "Tous" est chargée
		else {

			$aff .= '<div align="center"><form>Type de Documents<select name="type"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=domaine&type=\' + this.form.type.value + \'&m=' . $mois_actuel . '&a=' . $annee_actuelle . '\'">';
			$aff .= '<option value="3" >Tous</option>';
			$aff .= '<option  value="0" >DocInfoDyn</option>';
			$aff .= '<option  value="1" >DocStatic</option>';
			$aff .= '<option  value="2" >DocPartenaire</option>';
			$aff .= '</select></form> </div><br />';
		}

		$aff .= '<div align="center" ><form>';
		// Si on a demandé une date
		if (isset ( $_GET ['m'] ) && isset ( $_GET ['a'] )) {
			$aff .= '<a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=domaine&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] - 1);
			$aff .= '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=domaine&m=';
			if ($_GET ['m'] == '01') {
				$aff .= '12&a=' . ($_GET ['a'] - 1);
			} else {
				$aff .= ($_GET ['m'] - 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= '<select name="mois"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=domaine&m=\' + this.form.mois.value + \'&a=' . $_GET ['a'] . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option  value="' . $i . '" ' . ($_GET ['m'] == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $_GET ['a'] . ' <a style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=domaine&m=';
			if ($_GET ['m'] == '12') {
				$aff .= '01&a=' . ($_GET ['a'] + 1);
			} else {
				$aff .= ($_GET ['m'] + 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=domaine&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] + 1);
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		} // Sinon on prend le moi et l'année actuels
		else {
			$aff .= '<a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=domaine&m=' . $mois_actuel . '&a=' . ($annee_actuelle - 1);
			$aff .= '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=domaine&m=';
			if ($mois_actuel == '01') {
				$aff .= '12&a=' . ($annee_actuelle - 1);
			} else {
				$aff .= ($mois_actuel - 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= ' <select name="mois"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=domaine&m=\' + this.form.mois.value + \'&a=' . $annee_actuelle . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option  value="' . $i . '" ' . ($mois_actuel == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $annee_actuelle . '<a style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=domaine&m=';
			if ($mois_actuel == '12') {
				$aff .= '01&a=' . ($annee_actuelle + 1);
			} else {
				$aff .= ($mois_actuel + 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=domaine&m=' . $mois_actuel . '&a=' . ($annee_actuelle + 1);
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		}
		$aff .= '</div></form><br />';
		// *************************************** Fin calendrier ******************************************

		// On génère le graphique en appelant la vue avec les paramètres nécessaires
		$aff .= '<div align="center"><img src="metier/view/DomainGraphView.php?m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '&site=' . $_GET ['site'] . '"  /></div><br /><br />';
		$aff .= ' <br /><br />';
		// Création du tableau
		$aff .= '<table id="TableList"  width="100%">';
		$aff .= '<tr class="title">';
		$aff .= '	<td align="center"><b>Domaine</b></td>';
		$aff .= '	<td align="center"colspan="2">  <b>Nombre de consultations</b></td>';
		$aff .= '</tr>';
		$aff .= '<tr >';
		$aff .= '	<td class="row2" align="center" style="font-weight:bold;" ><b>Total</b></td>';
		$aff .= '	<td class="row2" align="center" style="font-weight:bold;"  width="200"><b>' . $this->myTotal . '</b></td>';
		$aff .= '	<td class="row2" align="center" style="font-weight:bold;"  width="200"><b>100%</b></td>';
		$aff .= '</tr>';
		$row = 1;

		foreach ( $this->myList as $aCle => $aVerif ) {
			if ($aCle == NULL) {
				$aConsult = new DomaineActivite ();
				$aConsult->select_name ( $aCle );
				$aff .= '<tr >';
				$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" style="font-weight:bold;" >Indéfini</b></td>';
				$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200">' . $aVerif . '</td>';
				$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200">';
				$aff .= round ( ($aVerif / $this->myTotal) * 100 );
				$aff .= '%</td>';
				$aff .= '</tr>';
				$row = ($row == 1 ? 2 : 1);
			} else {
				$aConsult = new DomaineActivite ();
				$aConsult->select_name ( $aCle );
				$aff .= '<tr >';
				$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" style="font-weight:bold;" >' . $aConsult->getName () . '</b></td>';
				$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200">' . $aVerif . '</td>';
				$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200">';
				$aff .= round ( ($aVerif / $this->myTotal) * 100 );
				$aff .= '%</td>';
				$aff .= '</tr>';
				$row = ($row == 1 ? 2 : 1);
			}
		}
		$aff .= '</table>';
		echo $aff;
	}
}
?>