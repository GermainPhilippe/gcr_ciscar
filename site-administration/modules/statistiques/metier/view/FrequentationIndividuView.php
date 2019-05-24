<?php
class FrequentationIndividuView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		$time = time ();
		$mois_actuel = date ( 'm', $time );
		$annee_actuelle = date ( 'Y', $time );
		$month = isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time );
		$year = isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time );

		switch ($_GET ['site']) {
			case 1 :
				$site = 'CISCAR';
				break;
			case 3 :
				$site = 'GCNF';
				break;
			case 2 :
				$site = 'GCR';
				break;
			case 7 :
				$site = 'GCRE';
				break;
		}

		$aff = '<style>';
		$aff .= 'td.center {text-align:center;}';
		$aff .= '</style>';

		$aff .= '<div id="FilAriane"><a href="../../?menu=6">Statistiques</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?site=' . $_GET ['site'] . '">' . $site . '</a>&nbsp;>&nbsp;';
		$aff .= 'Fr&eacute;quentation Individu<br /></div><br />';

		$aff .= '<table><tbody><tr>';
		$aff .= '<td><img width="15px" height="15px" src="../../include/images/export.jpg"></td>';
		$aff .= '<td> <a href="metier/getFrequentationIndividu.php?site=' . $_GET ['site'] . '&m=' . $month . '&a=' . $year . '&action=frequentationIndividu' . (isset ( $_GET ['user_id'] ) ? '&user_id=' . $_GET ['user_id'] : '') . '" target="blank">  Exporter les données affichées</a></td>';
		$aff .= '</tr></tbody></table>';

		$aff .= '<div align="center" ><form>';

		$url_last_year = '?site=' . $_GET ['site'] . '&m=' . $month . '&a=' . ($year - 1) . '&action=frequentationIndividu' . (isset ( $_GET ['user_id'] ) ? '&user_id=' . $_GET ['user_id'] : '');
		$url_last_month = '?site=' . $_GET ['site'] . '&m=' . ($month - 1) . '&a=' . $year . '&action=frequentationIndividu' . (isset ( $_GET ['user_id'] ) ? '&user_id=' . $_GET ['user_id'] : '');
		$url_next_year = '?site=' . $_GET ['site'] . '&m=' . $month . '&a=' . ($year + 1) . '&action=frequentationIndividu' . (isset ( $_GET ['user_id'] ) ? '&user_id=' . $_GET ['user_id'] : '');
		$url_next_month = '?site=' . $_GET ['site'] . '&m=' . ($month + 1) . '&a=' . $year . '&action=frequentationIndividu' . (isset ( $_GET ['user_id'] ) ? '&user_id=' . $_GET ['user_id'] : '');

		$aff .= '<a style="background-image:url(\'../../include/images/3.png\');" href="' . $url_last_year . '"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		$aff .= '<a style="background-image:url(\'../../include/images/3.png\');" href="' . $url_last_month . '"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';

		$url_select = '?site=' . $_GET ['site'] . '&m=\' + this.form.mois.value + \'&a=' . $year . '&action=frequentationIndividu' . (isset ( $_GET ['user_id'] ) ? '&user_id=' . $_GET ['user_id'] : '');
		$aff .= '<select name="mois"  onChange="window.location=\'/admin/modules/statistiques/index.php' . $url_select . '">';
		$i = 1;
		while ( $i <= 12 ) {
			$aff .= '<option  value="' . $i . '" ' . ($month == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
			$i ++;
		}
		$aff .= '</select>  ' . $year;

		$aff .= '<a style="background-image:url(\'../../include/images/1.png\');" href="' . $url_next_month . '"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		$aff .= '<a style="background-image:url(\'../../include/images/1.png\');" href="' . $url_next_year . '"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';

		$aff .= '</div></form><br />';

		$aff .= '<table id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td>Utilisateur</td>';
		$aff .= '<td>Date</td>';
		$aff .= '<td>Page d\'Entrée</td>';
		$aff .= '<td>Page de Sortie</td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myList as $line ) {
			$aff .= '<tr>';
			$aff .= '<td class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="?site=' . $_GET ['site'] . '&m=' . $month . '&a=' . $year . '&action=frequentationIndividu&user_id=' . $line [0] . '">' . $line [6] . ' ' . $line [7] . '</a></td>';
			$aff .= '<td class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center">' . $line [1] . '</td>';
			$aff .= '<td class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="' . $line [3] . '" target="_BLANK">' . $line [2] . '</a></td>';
			$aff .= '<td class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="' . $line [5] . '" target="_BLANK">' . $line [4] . '</a></td>';
			$aff .= '</tr>';

			$row = $row == 1 ? 0 : 1;
		}

		$aff .= '</table>';

		echo $aff;
	}
}
?>