<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage categorie
 * @version 1.0.4
 */
class CategorieDocInfoDynControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
				if (isset ( $_POST ['Nom'] )) {
					$aModele = new CategorieDocInfoDyn ();
					$aModele->setSiteID ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aModele->setDescription ( trim ( $_POST ['Nom'] ) );
					switch (trim ( $_POST ['CategorieType'] )) {
						case '1' :
							$aModele->setURLImage ( $_POST ['ImagesURL'] );
							$aModele->setURLImageSmall ( $_POST ['ImagesURL2'] );
							break;
						case '2' :
							$aModele->setParentID ( $_POST ['CatType'] );
							break;
						case '3' :
							$aModele->setParentID ( $_POST ['CatTheme'] );
							break;
					}

					$aModele->SQL_create ();

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aModele = new CategorieDocInfoDyn ();
					$aView = new CategorieDocInfoDynView ( $aModele );
					$aView->render ( 'new' );
				}
				break;
			case 'edit' :
				if (isset ( $_POST ['Nom'] )) {
					$aModele = new CategorieDocInfoDyn ();
					$aModele->SQL_select ( trim ( $_GET ['id'] ) );
					$aModele->setDescription ( trim ( $_POST ['Nom'] ) );
					if (is_null ( $aModele->getParentID () )) {
						$aModele->setURLImage ( trim ( $_POST ['ImagesURL'] ) );
						$aModele->setURLImageSmall ( trim ( $_POST ['ImagesURL2'] ) );
					}
					$aModele->SQL_update ();

					echo CommunFunction::goToURL ( '?' );
				} else {
					if (isset ( $_GET ['id'] )) {
						$aModele = new CategorieDocInfoDyn ();
						$aModele->SQL_select ( trim ( $_GET ['id'] ) );
						$aView = new CategorieDocInfoDynView ( $aModele );
						$aView->render ( 'edit' );
					}
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aModele = new CategorieDocInfoDyn ();
					$aModele->setID ( $_GET ['id'] );
					$aModele->SQL_delete ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>