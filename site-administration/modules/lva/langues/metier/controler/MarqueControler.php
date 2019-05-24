<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class LangueControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Langue ();
					$vue = new LangueView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aLangue = new Langue ();
					$aLangue->setCode ( trim ( $_POST ['Code'] ) );
					$aLangue->setName ( trim ( $_POST ['Nom'] ) );

					$aLangue->create_Langue ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Langue ();
					$modele->select_Langue ( trim ( $_GET ['id'] ) );
					$vue = new LangueView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aLangue = new Langue ();
					$aLangue->setID ( trim ( $_GET ['id'] ) );
					$aLangue->setName ( trim ( $_POST ['Nom'] ) );
					$aLangue->setCode ( trim ( $_POST ['Code'] ) );

					$aLangue->update_Langue ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aLangue = new Langue ();
					$aLangue->setID ( $_GET ['id'] );
					$aLangue->remove_Langue ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>