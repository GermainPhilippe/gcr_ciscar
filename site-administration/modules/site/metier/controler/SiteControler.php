<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage site
 * @version 1.0.4
 */
class SiteControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Site ();
					$vue = new SiteView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aSite = new Site ();
					$aSite->setName ( trim ( $_POST ['Nom'] ) );

					$aSite->create_site ();

					$vue = new SiteView ( NULL );
					$vue->redirection ( '?' );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['siteID'] )) {
					$modele = new Site ();
					$modele->select_site ( trim ( $_GET ['id'] ) );
					$vue = new SiteView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aSite = new Site ();
					$aSite->setID ( trim ( $_POST ['siteID'] ) );
					$aSite->setName ( trim ( $_POST ['Nom'] ) );

					$aSite->update_site ();

					$vue = new SiteView ( NULL );
					$vue->redirection ( '?' );
				}
				break;
			case 'd' :
				if (! isset ( $_POST ['siteID'] )) {
					$modele = new Site ();
					$modele->select_site ( trim ( $_GET ['id'] ) );
					$vue = new SiteView ( $modele );
					$vue->render ( 'd' );
				} else {
					$aSite = new Site ();
					$aSite->setID ( trim ( $_POST ['siteID'] ) );
					$aSite->remove_site ();

					$vue = new SiteView ( NULL );
					$vue->redirection ( '?' );
				}
				break;
		}
	}
}
?>