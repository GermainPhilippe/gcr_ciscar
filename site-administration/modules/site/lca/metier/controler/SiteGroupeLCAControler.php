<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class SiteGroupeLCAControler {
	function run() {
		switch ($_GET ['action']) {
			case 'm' :
				if (isset ( $_GET ['id'] )) {
					$aMembreListe = new MembreSiteGroupeLCAListe ();
					$aMembreListe->select_all_membre ( trim ( $_GET ['id'] ) );
					$aMembreGroupeView = new MembreSiteGroupeLCAView ( $aMembreListe );
					$aMembreGroupeView->render ();
				}
				break;
		}
	}
}
?>