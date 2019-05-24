<?php
/**
 * Vue du nombre de consultations par document
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 * @version 1.0.4
 */
class StatConsultDocView {
	private $myList;
	private $nbrEntre;
	public function __construct($aList, $aCount) {
		$this->myList = $aList;
		$this->nbrEntre = $aCount;
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
	 * Rendu de la vue du nombre de consultation par document
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
		$aff .= '<div id="FilAriane"><a href="../../?menu=6">Statistiques</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?site=' . $_GET ['site'] . '">' . $site . ' </a>&nbsp;>&nbsp;';
		$aff .= (($_GET ['action'] == 'top') ? 'Top 20 des consultations' : 'Nombre de consultations par Documents') . '<br /></div><br />';

		$aff .= '<table><tr>';
		$aff .= '<td><img width="15px" height="15px" src="../../include/images/export.jpg" /></td>';
		$aff .= '<td> <a   target="blank" href="metier/getConsult.php?export=1&m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '&site=' . $_GET ['site'] . '">  Exporter les données affichées</a></td>';
		$aff .= '</tr></table>';

		// *************************************** Début calendrier ******************************************
		// Choix de la catégorie du document
		// Si on a demandé une date, on a une catégorie de sélectionné
		if (isset ( $_GET ['m'] ) && isset ( $_GET ['a'] )) {

			$aff .= '<div align="center"><form>Type de Documents<select name="type"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=consult&type=\' + this.form.type.value + \'&m=' . $_GET ['m'] . '&a=' . $_GET ['a'] . '\'">';
			$aff .= '<option  value="3" ' . (isset ( $_GET ['type'] ) && $_GET ['type'] == '3' ? 'selected' : '') . '>Tous</option>';
			$aff .= '<option  value="0" ' . (isset ( $_GET ['type'] ) && $_GET ['type'] == '0' ? 'selected' : '') . '>DocInfoDyn</option>';
			$aff .= '<option  value="1" ' . (isset ( $_GET ['type'] ) && $_GET ['type'] == '1' ? 'selected' : '') . '>DocStatic</option>';
			$aff .= '<option value="2" ' . (isset ( $_GET ['type'] ) && $_GET ['type'] == '2' ? 'selected' : '') . '>DocPartenaire</option>';

			$aff .= '</select> </form></div><br />';
		} // Sinon la vue "Tous" est chargée
		else {

			$aff .= '<div align="center"><form>Type de Documents<select name="type"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=consult&type=\' + this.form.type.value + \'&m=' . $mois_actuel . '&a=' . $annee_actuelle . '\'">';
			$aff .= '<option  value="3" >Tous</option>';
			$aff .= '<option  value="0" >DocInfoDyn</option>';
			$aff .= '<option  value="1" >DocStatic</option>';
			$aff .= '<option  value="2" >DocPartenaire</option>';
			$aff .= '</select></form> </div><br />';
		}

		$aff .= '<div align="center" ><form>';
		// Si on a demandé une date
		if (isset ( $_GET ['m'] ) && isset ( $_GET ['a'] )) {
			$aff .= '<a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=consult&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] - 1);
			$aff .= '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=consult&m=';
			if ($_GET ['m'] == '01') {
				$aff .= '12&a=' . ($_GET ['a'] - 1);
			} else {
				$aff .= ($_GET ['m'] - 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= '<select name="mois"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=consult&m=\' + this.form.mois.value + \'&a=' . $_GET ['a'] . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option  value="' . $i . '" ' . ($_GET ['m'] == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $_GET ['a'] . ' <a style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=consult&m=';
			if ($_GET ['m'] == '12') {
				$aff .= '01&a=' . ($_GET ['a'] + 1);
			} else {
				$aff .= ($_GET ['m'] + 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=consult&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] + 1);
			$aff .= '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		} // Sinon on prend le moi et l'année actuels
		else {
			$aff .= '<a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=consult&m=' . $mois_actuel . '&a=' . ($annee_actuelle - 1);
			$aff .= '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=consult&m=';
			if ($mois_actuel == '01') {
				$aff .= '12&a=' . ($annee_actuelle - 1);
			} else {
				$aff .= ($mois_actuel - 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= ' <select name="mois"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=consult&m=\' + this.form.mois.value + \'&a=' . $annee_actuelle . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option  value="' . $i . '" ' . ($mois_actuel == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $annee_actuelle . '<a style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=consult&m=';
			if ($mois_actuel == '12') {
				$aff .= '01&a=' . ($annee_actuelle + 1);
			} else {
				$aff .= ($mois_actuel + 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=consult&m=' . $mois_actuel . '&a=' . ($annee_actuelle + 1);
			$aff .= '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		}
		$aff .= '</div></form><br />';
		// *************************************** Fin calendrier ******************************************
		// Pagination
		$aff .= '<br/><br /><div id="Pagination" class="pagination"></div>
		<script>
			var num_entries = ' . ($this->nbrEntre) . ';
                // Create pagination element
                $("#Pagination").pagination(num_entries, {
                    num_edge_entries: 1,
                    num_display_entries: 10,
					current_page:' . (isset ( $_GET ['page'] ) ? $_GET ['page'] : 0) . ',
					link_to:\'/admin/modules/statistiques/index.php?action=consult&m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '&site=' . $_GET ['site'] . '&page=__id__\',
					callback: pageselectCallback,
                    items_per_page:50,
                    prev_text:"PREC",
                    next_text:"SUIV"
                });
		</script>';
		// Création du tableau
		$aff .= '<table id="TableList"  width="100%">';
		$aff .= '<tr class="title">';
		$aff .= '	<td align="center"><b>Type > Thème > Métier</b></td>';
		$aff .= '	<td align="center"><b>Titre</b></td>';
		$aff .= '	<td align="center"  width="200"><b>Nombre de consultations</b></td>';
		$aff .= '</tr>';
		$row = 1;

		if ($this->myList->getList () != NULL) {
			foreach ( $this->myList->getList () as $aVerif ) {
				$aConsult = new StatConsultDoc ();
				$aff .= '<tr >';
				$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '"  align="left" style="font-style:italic;padding-left:5px;" >' . (($aVerif->gettype () != NULL) ? $aVerif->gettype () . ' > ' : '') . (($aVerif->gettheme () != NULL) ? $aVerif->gettheme () . ' > ' : '') . (($aVerif->getmetier () != NULL) ? $aVerif->getmetier () : '') . '</td>';
				$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '"  align="left" style="font-weight:bold;padding-left:5px;" >' . $aVerif->gettitle () . '</b></td>';
				$aff .= '	<td   class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center" width="200">' . $aVerif->getconsult () . '</td>';
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