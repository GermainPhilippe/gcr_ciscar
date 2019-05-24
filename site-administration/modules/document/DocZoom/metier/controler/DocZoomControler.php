<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocZoomControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
				if (isset ( $_POST ['Titre'] )) {
					$aModele = new DocZoom ();
					$aModele->setTitre ( trim ( $_POST ['Titre'] ) );
					$aModele->setAccroche ( trim ( $_POST ['Accroche'] ) );
					$aModele->setImagePortail ( trim ( $_POST ['ImagesURL'] ) );
					$aModele->setDocInfoDynID ( trim ( $_POST ['DocInfoDynID'] ) );
					$aModele->setNumOrdre ( trim ( $_POST ['NumOrdre'] ) );
					$aModele->setPublication ( trim ( $_POST ['Publication'] ) );
					$aModele->setSiteID ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aModele->SQL_create ();

					echo CommunFunction::goToURL ( '?' );
				} else {
					if ($_GET ['id']) {
						$aDocInfoDyn = new DocInfoDyn ();
						$aDocInfoDyn->SQL_select ( $_GET ['id'] );

						$aModele = new DocZoom ();
						$aModele->setTitre ( $aDocInfoDyn->getTitre () );
						$aModele->setAccroche ( $aDocInfoDyn->getAccroche () );
						$aModele->setDocInfoDynID ( trim ( $_GET ['id'] ) );
						$aModele->setPublication ( 1 );
						$aModele->setNumOrdre ( 0 );

						$aView = new DocZoomView ( $aModele );
						$aView->render ( 'new' );
					}
				}
				break;
			case 'edit' :
				if (isset ( $_POST ['Titre'] )) {
					$aModele = new DocZoom ();
					$aModele->setID ( trim ( $_GET ['id'] ) );
					$aModele->setTitre ( trim ( $_POST ['Titre'] ) );
					$aModele->setAccroche ( trim ( $_POST ['Accroche'] ) );
					$aModele->setImagePortail ( trim ( $_POST ['ImagesURL'] ) );
					$aModele->setNumOrdre ( trim ( $_POST ['NumOrdre'] ) );
					$aModele->setPublication ( trim ( $_POST ['Publication'] ) );
					$aModele->SQL_update ();

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aModele = new DocZoom ();
					$aModele->SQL_select ( trim ( $_GET ['id'] ) );
					$aView = new DocZoomView ( $aModele );
					$aView->render ( 'edit' );
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aModele = new DocZoom ();
					$aModele->setID ( $_GET ['id'] );
					$aModele->SQL_delete ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>