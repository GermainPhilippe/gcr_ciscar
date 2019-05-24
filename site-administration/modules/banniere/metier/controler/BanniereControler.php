<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage banniere
 * @version 1.0.4
 */
class BanniereControler {
	public function __construct() {
	}

	// ###
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
				if (isset ( $_POST ['Titre'] )) {
					$aModele = new Banniere ();
					$aModele->setTitre ( trim ( $_POST ['Titre'] ) );
					$aModele->setURL ( trim ( $_POST ['URL'] ) );
					$aModele->setURLImage ( trim ( $_POST ['ImagesURL'] ) );
					$aModele->setDateDebut ( ! empty ( $_POST ['DateDebut'] ) ? CommunFunction::getDateUS ( trim ( $_POST ['DateDebut'] ) ) : NULL );
					$aModele->setDateFin ( ! empty ( $_POST ['DateFin'] ) ? CommunFunction::getDateUS ( trim ( $_POST ['DateFin'] ) ) : NULL );
					$aModele->setPublication ( trim ( $_POST ['Publication'] ) );
					$aModele->setSiteID ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aModele->SQL_create ();

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aView = new BanniereView ( new Banniere () );
					$aView->render ( 'new' );
				}
				break;
			case 'edit' :
				if (isset ( $_POST ['Titre'] )) {
					$aModele = new Banniere ();
					$aModele->setID ( trim ( $_GET ['id'] ) );
					$aModele->setTitre ( trim ( $_POST ['Titre'] ) );
					$aModele->setURL ( trim ( $_POST ['URL'] ) );
					$aModele->setURLImage ( trim ( $_POST ['ImagesURL'] ) );
					$aModele->setDateDebut ( trim ( $_POST ['DateDebut'] ) != '' ? CommunFunction::getDateUS ( trim ( $_POST ['DateDebut'] ) ) : NULL );
					$aModele->setDateFin ( trim ( $_POST ['DateFin'] ) != '' ? CommunFunction::getDateUS ( trim ( $_POST ['DateFin'] ) ) : NULL );
					$aModele->setPublication ( trim ( $_POST ['Publication'] ) );
					$aModele->SQL_update ();

					echo CommunFunction::goToURL ( '?' );
				} else {
					if (isset ( $_GET ['id'] )) {
						$aModele = new Banniere ();
						$aModele->SQL_select ( trim ( $_GET ['id'] ) );
						$aView = new BanniereView ( $aModele );
						$aView->render ( 'edit' );
					}
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aModele = new Banniere ();
					$aModele->setID ( $_GET ['id'] );
					$aModele->SQL_delete ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'view' :
				if (isset ( $_GET ['id'] )) {
					$aModele = new Banniere ();
					$aModele->SQL_select ( $_GET ['id'] );
					$aView = new BanniereDisplayView ( $aModele );
					$aView->render ();
				}
				break;
			case 'viewDefault' :
				$aModele = new Banniere ();
				$aModele->SQL_select_default ();
				$aView = new BanniereDisplayView ( $aModele );
				$aView->render ();
				break;
		}
	}
}
?>