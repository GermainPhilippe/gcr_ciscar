<?php
/**
 *  @author Florent DESPIERRES
 * @package site-administration
 * @subpackage commun
 * @version 1.0.4
 */
class FunctionDate {
	public static function getDateFR($DateEN) {
		$tab = preg_split ( "/-+/", $DateEN, 3 );
		return $tab [2] . '/' . $tab [1] . '/' . $tab [0];
	}
	public static function getDateUS($DateFR) {
		$tab = preg_split ( "/[-\.\/ ]/", $DateFR, 3 );
		return $tab [2] . '-' . $tab [1] . '-' . $tab [0];
	}
	public static function getMois($numero) {
		switch ($numero) {

			case '01' :
				return 'Janvier';
				break;
			case '02' :
				return 'Février';
				break;
			case '03' :
				return 'Mars';
				break;
			case '04' :
				return 'Avril';
				break;
			case '05' :
				return 'Mai';
				break;
			case '06' :
				return 'Juin';
				break;
			case '07' :
				return 'Juillet';
				break;
			case '08' :
				return 'Août';
				break;
			case '09' :
				return 'Septembre';
				break;
			case '10' :
				return 'Octobre';
				break;
			case '11' :
				return 'Novembre';
				break;
			case '12' :
				return 'Décembre';
				break;
		}
	}
}
?>