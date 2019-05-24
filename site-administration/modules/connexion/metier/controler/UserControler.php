<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage connexion
 * @version 1.0.4
 */
class UserControler {
	function run() {
		if (! isset ( $_POST ['Login'] )) {
			// Si accès à parti de SAGE
			if (isset ( $_GET ['IDSage'] )) {
				$aIndividu = new Individu ();
				$aIndividu->userSage_exist ( $_GET ['IDSage'] );
				if ($aIndividu->getLogin () != '') {
					$aUser = new User ();
					$aUser->setLogin ( $aIndividu->getLogin () );
					$aUser->setPassword ( $aIndividu->getPassword () );
					$aUser->check ();

					$aUserView = new UserView ( $aUser );
					if (isset ( $_GET ['CompteT'] )) {
						$aUserView->redirection ( "modules/etablissement/?Recherche=" . $_GET ['CompteT'] );
					} else {
						$aUserView->redirection ( "?" );
					}
				} else {
					$aUser = new User ();
					$aUserView = new UserView ( $aUser );
					$aUserView->render ();
				}
			} else {
				// Si accès à partir du site GCR
				if (isset ( $_GET ['IDGcr'] )) {
					$aIndividu = new Individu ();
					$aIndividu->userSage_exist ( $_GET ['IDGcr'] );
					if ($aIndividu->getLogin () != '') {
						$aUser = new User ();
						$aUser->setLogin ( $aIndividu->getLogin () );
						$aUser->setPassword ( $aIndividu->getPassword () );
						$aUser->check ();

						$aUserView = new UserView ( $aUser );
						if (isset ( $_GET ['RechercheNOM'] )) {
							$aUserView->redirection ( 'modules/individu/index.php?RechercheNOM=' . str_replace ( '+', '%2B', $_GET ['RechercheNOM'] ) . '&count=' . $_GET ['count'] );
						} else {
							$aUserView->redirection ( "?" );
						}
					} else {
						$aUser = new User ();
						$aUserView = new UserView ( $aUser );
						$aUserView->render ();
					}
				} else {
					$aUser = new User ();
					$aUserView = new UserView ( $aUser );
					$aUserView->render ();
				}
			}
		} else {
			$aUser = new User ();
			$aUser->setLogin ( trim ( $_POST ['Login'] ) );
			$aUser->setPassword ( trim ( $_POST ['Password'] ) );
			$aUser->check ();

			$aUserView = new UserView ( $aUser );
			$aUserView->redirection ( "?" );
		}
	}
}
?>