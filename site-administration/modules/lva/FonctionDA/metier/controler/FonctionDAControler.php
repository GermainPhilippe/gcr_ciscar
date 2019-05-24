<?php
class FonctionDAControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
				if (isset ( $_POST ['Nom'] )) {
					$aModele = new FonctionDA ();
					$aModele->setDomaineActiviteID ( trim ( $_GET ['DAID'] ) );
					$aModele->setLibelle ( trim ( $_POST ['Nom'] ) );
					$aModele->setNumOrdre ( trim ( $_POST ['NumeroOrdre'] ) );
					$aModele->SQL_CREATE ();

					echo CommunFunction::goToURL ( '../domaineActivite/?' );
				} else {
					$aModele = new FonctionDA ();
					if (isset ( $_GET ['DAID'] )) {
						$aModele->setDomaineActiviteID ( trim ( $_GET ['DAID'] ) );
					}
					$aView = new FonctionDAView ( $aModele );
					$aView->renderHTML ( 'new' );
				}
				break;
			case 'edit' :
				if (isset ( $_POST ['Nom'] )) {
					$aModele = new FonctionDA ();
					if (isset ( $_GET ['id'] )) {
						$aModele->SQL_SELECT ( trim ( $_GET ['id'] ) );
					}
					$aModele->setLibelle ( trim ( $_POST ['Nom'] ) );
					$aModele->setNumOrdre ( trim ( $_POST ['NumeroOrdre'] ) );
					$aModele->SQL_UPDATE ();

					echo CommunFunction::goToURL ( '../domaineActivite/?' );
				} else {
					$aModele = new FonctionDA ();
					if (isset ( $_GET ['id'] )) {
						$aModele->SQL_SELECT ( trim ( $_GET ['id'] ) );
					}
					$aView = new FonctionDAView ( $aModele );
					$aView->renderHTML ( 'edit' );
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aModele = new FonctionDA ();
					$aModele->setID ( $_GET ['id'] );
					$aModele->SQL_DELETE ();

					echo CommunFunction::goToURL ( '../domaineActivite/?' );
				}
				break;
			case 'list' :
				$aList = new FonctionDAList ();
				$aList->SQL_SELECT_ALL ( trim ( $_GET ['id'] ) );
				$aView = new FonctionDAListView ( $aList );
				$aView->renderOptionHTML ();
				break;
		}
	}
}
?>