<?php
class EnqueteFormulaireComposantController {
	public function run() {
		$action = isset ( $_GET ['action'] ) ? $_GET ['action'] : '';
		switch ($action) {
			case 'edit' :
				$this->editAction ();
				break;
			case 'delete' :
				$this->deleteAction ();
				break;
			default :
				$this->defaultAction ();
				break;
		}
	}

	// Methods //
	private function editAction() {
		if (isset ( $_POST ['nom'] )) {
			$composant = new EnqueteFormulaireComposant ();
			$composantDAO = new EnqueteFormulaireComposantDAO ();

			$composant->setId ( $_GET ['compoid'] );
			$composant->setNom ( $_POST ['nom'] );
			switch ($_GET ['type']) {
				case '6' :
					$valeur = '';

					$dao = new EnquetePageDAO ();
					$list = $dao->findAll ();
					foreach ( $list as $page ) {
						$valeur .= (isset ( $_POST ['page' . $page->getId ()] ) ? $page->getId () . ';' : '');
					}
					$composant->setValeur ( $valeur );
					break;
				case '7' :
					$composant->setValeur ( $_POST ['ImagesURL'] );
					break;
				case '8' :
					$composant->setValeur ( $_POST ['valeur'] );
					break;
				default :

					// Rien a ajouter
					break;
			}
			$composantDAO->update ( $composant );

			// Formulaire de connexion
			$aff = '<script type="text/javascript">';
			$aff .= 'window.opener.location.reload();';
			$aff .= 'window.close();';
			$aff .= '</script>';
			echo $aff;
		} else {
			$composantDAO = new EnqueteFormulaireComposantDAO ();
			$composant = $composantDAO->find ( $_GET ['compoid'] );

			switch ($_GET ['type']) {
				case '6' :
					$view = new EnqueteFormulaireComposantListePageView ( $composant );
					$view->renderHTML ();
					break;
				case '7' :
					$view = new EnqueteFormulaireComposantBandeauView ( $composant );
					$view->renderHTML ();
					break;
				case '8' :
					$view = new EnqueteFormulaireComposantZoneTextView ( $composant );
					$view->renderHTML ();
					break;
				case '9' : // Formulaire Individu inscription
				case '10' : // Formulaire Individu satisfaction
				case '11' : // Formulaire Invite
				case '12' : // Bouton Soumettre
					$view = new EnqueteFormulaireComposantView ( $composant );
					$view->renderHTML ();
					break;
			}
		}
	}
	private function deleteAction() {
		if (isset ( $_GET ['id'] ) && isset ( $_GET ['compoid'] )) {
			$dao = new EnqueteFormulaireCompositionDAO ();
			$dao->delete ( $_GET ['compoid'] );
		}
		$this->redirection ( 'index.php?action=edit&id=' . $_GET ['id'] );
	}
	private function defaultAction() {
		if (isset ( $_POST ['nom'] )) {
			$composition = new EnqueteFormulaireComposition ();
			$compositionDAO = new EnqueteFormulaireCompositionDAO ();

			$composition->setNumOrdre ( 100 );
			$composition->setFormulaireId ( $_GET ['id'] );
			$composition->setType ( EnqueteFormulaireComposition::TYPE_COMPOSANT );
			$compositionDAO->create ( $composition );

			$composant = new EnqueteFormulaireComposant ();
			$composantDAO = new EnqueteFormulaireComposantDAO ();

			$composant->setId ( mysqli_insert_id ($_SESSION['LINK']) );
			$composant->setNom ( $_POST ['nom'] );

			switch ($_GET ['type']) {
				case '6' :
					$valeur = '';

					$dao = new EnquetePageDAO ();
					$list = $dao->findAll ();
					foreach ( $list as $page ) {
						$valeur .= (isset ( $_POST ['page' . $page->getId ()] ) ? $page->getId () . ';' : '');
					}
					$composant->setType ( EnqueteFormulaireComposant::TYPE_LISTE_PAGE );
					$composant->setValeur ( $valeur );
					break;
				case '7' :
					$composant->setType ( EnqueteFormulaireComposant::TYPE_BANDEAU );
					$composant->setValeur ( $_POST ['ImagesURL'] );
					break;
				case '8' :
					$composant->setType ( EnqueteFormulaireComposant::TYPE_ZONE_TEXT );
					$composant->setValeur ( $_POST ['valeur'] );
					break;
				case '9' :
					$composant->setType ( EnqueteFormulaireComposant::TYPE_FORM_INDIVIDU_INSCRIPTION );
					break;
				case '10' :
					$composant->setType ( EnqueteFormulaireComposant::TYPE_FORM_INDIVIDU_SATISFACTION );
					break;
				case '11' :
					$composant->setType ( EnqueteFormulaireComposant::TYPE_FORM_INVITE );
					break;
				case '12' :
					$composant->setType ( EnqueteFormulaireComposant::TYPE_BUTTON_SUBMIT );
					break;
				case '13' :
					$composant->setType ( EnqueteFormulaireComposant::TYPE_INVITATION_DINER );
					break;
			}
			$composantDAO->create ( $composant );

			$composition->setId ( $composant->getId () );
			$composition->setNumOrdre ( 100 + ( int ) $composant->getId () );
			$compositionDAO->update ( $composition );

			// Formulaire de connexion
			$aff = '<script type="text/javascript">';
			$aff .= 'window.opener.location.reload();';
			$aff .= 'window.close();';
			$aff .= '</script>';
			echo $aff;
		} else {
			$composant = new EnqueteFormulaireComposant ();

			switch ($_GET ['type']) {
				case '6' :
					$view = new EnqueteFormulaireComposantListePageView ( $composant );
					$view->renderHTML ();
					break;
				case '7' :
					$view = new EnqueteFormulaireComposantBandeauView ( $composant );
					$view->renderHTML ();
					break;
				case '8' :
					$view = new EnqueteFormulaireComposantZoneTextView ( $composant );
					$view->renderHTML ();
					break;
				case '9' : // Formulaire Individu inscription
				case '10' : // Formulaire Individu satisfaction
				case '11' : // Formulaire Invite
				case '12' : // Bouton Soumettre
					$view = new EnqueteFormulaireComposantView ( $composant );
					$view->renderHTML ();
					break;
			}
		}
	}

	// Tools //
	private function redirection($URL) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href=\'' . $URL . '\';';
		$aff .= '</script>';
		echo $aff;
	}
}