<?php
class ConventionControler {
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
				$this->newAction ();
				break;
			case 'newVide' :
				$this->newVideAction ();
				break;
			case 'cloner' :
				$this->clonerAction ();
				break;
			case 'historique' :
				$this->historiqueAction ();
				break;
			case 'changerStatut' :
				$this->changerStatutAction ();
				break;
			case 'edit' :
				$this->editAction ();
				break;
			case 'delete' :
				$this->deleteAction ();
				break;
		}
	}
	private function newVideAction() {
		$aConvention = new Convention ();
		$aConvention->setStatut ( 1 );
		$aConvention->SQL_create ();
		$aConvention->setID ( mysqli_insert_id ($_SESSION['LINK']) );

		$aConventionHistorique = new ConventionHistorique ();
		$aConventionHistorique->setConventionID ( $aConvention->getID () );
		$aConventionHistorique->setDescription ( 'Création de la Convention avec Annuaire vide' );
		$aConventionHistorique->SQL_CREATE ();

		// Redirection
		$this->redirection ( '?' );
	}
	private function newAction() {
		$aConvention = new Convention ();
		$aConvention->setStatut ( 1 );
		$aConvention->SQL_create ();
		$aConvention->setID ( mysqli_insert_id ($_SESSION['LINK']) );

		$aConventionHistorique = new ConventionHistorique ();
		$aConventionHistorique->setConventionID ( $aConvention->getID () );
		$aConventionHistorique->setDescription ( 'Création de la Convention' );
		$aConventionHistorique->SQL_CREATE ();

		// Import de l'annuaire
		$aModele = new Annuaire ();
		$aModele->SQL_IMPORT_GCR ( $aConvention->getID () );
		$aConventionHistorique->setDescription ( 'Synchronisation Annuaire' );
		$aConventionHistorique->SQL_CREATE ();

		// Redirection
		$this->redirection ( '?' );
	}
	private function editAction() {
		if (isset ( $_POST ['PageClotureSatisfaction'] )) {
			$aModele = new Convention ();
			$aModele->SQL_select ( $_GET ['id'] );
			$aModele->setNom ( $_POST ['Nom'] );
			$aModele->setDateDebutInscription ( $this->getDateUS ( $_POST ['DateDebutInscription'] ) );
			$aModele->setDateFinInscription ( $this->getDateUS ( $_POST ['DateFinInscription'] ) );
			$aModele->setPageClotureInscription ( $_POST ['PageClotureInscription'] );
			$aModele->setDateDebutSatisfaction ( $this->getDateUS ( $_POST ['DateDebutSatisfaction'] ) );
			$aModele->setDateFinSatisfaction ( $this->getDateUS ( $_POST ['DateFinSatisfaction'] ) );
			$aModele->setPageClotureSatisfaction ( $_POST ['PageClotureSatisfaction'] );

			$aModele->setLCA11 ( $_POST ['lca11'] );
			$aModele->setLCA12 ( $_POST ['lca12'] );
			$aModele->setLCA13 ( $_POST ['lca13'] );
			$aModele->setLCA14 ( $_POST ['lca14'] );
			$aModele->setLCA15 ( $_POST ['lca15'] );
			$aModele->setLCA16 ( $_POST ['lca16'] );
			$aModele->setLCA17 ( $_POST ['lca17'] );
			$aModele->setLCA18 ( $_POST ['lca18'] );
			$aModele->setLCA19 ( $_POST ['lca19'] );

			$aModele->setLCA21 ( $_POST ['lca21'] );
			$aModele->setLCA22 ( $_POST ['lca22'] );
			$aModele->setLCA23 ( $_POST ['lca23'] );
			$aModele->setLCA24 ( $_POST ['lca24'] );
			$aModele->setLCA25 ( $_POST ['lca25'] );
			$aModele->setLCA26 ( $_POST ['lca26'] );
			$aModele->setLCA27 ( $_POST ['lca27'] );
			$aModele->setLCA28 ( $_POST ['lca28'] );
			$aModele->setLCA29 ( $_POST ['lca29'] );

			$aModele->SQL_update ();

			$aConventionHistorique = new ConventionHistorique ();
			$aConventionHistorique->setConventionID ( $_GET ['id'] );
			$aConventionHistorique->setDescription ( 'Modification de la Convention' );
			$aConventionHistorique->SQL_CREATE ();

			$this->redirection ( '?' );
		} else {
			if (isset ( $_GET ['id'] )) {

				$dao = new ConventionPageDAO ();
				$listPage = $dao->findAll ();

				$daoFormulaire = new ConventionFormulaireDAO ();

				$aModele = new Convention ();
				$aModele->SQL_select ( $_GET ['id'] );
				$aView = new ConventionView ( $aModele, $listPage, $daoFormulaire->findAll ( $_GET ['id'] ) );
				$aView->renderHTML ();
			}
		}
	}
	private function deleteAction() {
		if (isset ( $_GET ['id'] )) {
			$aModele = new Convention ();
			$aModele->setID ( $_GET ['id'] );
			$aModele->SQL_delete ();

			$this->message ( 'Convention supprimée' );
			$this->redirection ( '?' );
		}
	}
	private function changerStatutAction() {
		if (isset ( $_GET ['id'] )) {
			$aModele = new Convention ();
			$aModele->SQL_select ( $_GET ['id'] );

			$Passer = true;

			// Verification Date
			if ($aModele->getDateDebutInscription () == "" || $aModele->getDateFinInscription () == "" || $aModele->getDateDebutSatisfaction () == "" || $aModele->getDateFinSatisfaction () == "") {
				$this->message ( 'Les dates ne sont pas Correctes !' );
				$Passer = false;
			}

			// Verification Couverture Profile

			if ($aModele->getStatut () == PhaseConvention::$PHASE_EN_CREATION) {
				$lca11 = $aModele->getLCA11 ();
				$lca12 = $aModele->getLCA12 ();
				$lca13 = $aModele->getLCA13 ();
				$lca14 = $aModele->getLCA14 ();
				$lca15 = $aModele->getLCA15 ();
				$lca16 = $aModele->getLCA16 ();
				$lca17 = $aModele->getLCA17 ();
				$lca18 = $aModele->getLCA18 ();
				$lca19 = $aModele->getLCA19 ();

				if (empty ( $lca11 ) || empty ( $lca12 ) || empty ( $lca13 ) || empty ( $lca14 ) || empty ( $lca15 ) || empty ( $lca16 ) || empty ( $lca17 ) || empty ( $lca18 ) || empty ( $lca19 )) {
					$this->message ( 'Tous les Types ne sont pas couverts par un formulaire Inscription !' );
					$Passer = false;
				}
			}

			if ($aModele->getStatut () == PhaseConvention::$PHASE_INSCRIPTION) {
				$lca21 = $aModele->getLCA21 ();
				$lca22 = $aModele->getLCA22 ();
				$lca23 = $aModele->getLCA23 ();
				$lca24 = $aModele->getLCA24 ();
				$lca25 = $aModele->getLCA25 ();
				$lca26 = $aModele->getLCA26 ();
				$lca27 = $aModele->getLCA27 ();
				$lca28 = $aModele->getLCA28 ();
				$lca29 = $aModele->getLCA29 ();

				if (empty ( $lca21 ) || empty ( $lca22 ) || empty ( $lca23 ) || empty ( $lca24 ) || empty ( $lca25 ) || empty ( $lca26 ) || empty ( $lca27 ) || empty ( $lca28 ) || empty ( $lca29 )) {
					$this->message ( 'Tous les Types ne sont pas couverts par un formulaire Satisfaction !' );
					$Passer = false;
				}
			}

			if ($Passer) {

				$aConventionHistorique = new ConventionHistorique ();
				$aConventionHistorique->setConventionID ( $_GET ['id'] );

				switch ($aModele->getStatut ()) {
					case PhaseConvention::$PHASE_EN_CREATION :
						$aConventionHistorique->setDescription ( "Changement de Statut En Création->Inscription" );
						$aModele->setStatut ( '2' );
						break;
					case PhaseConvention::$PHASE_INSCRIPTION :
						$aConventionHistorique->setDescription ( "Changement de Statut Inscription->Satisfaction" );
						$aModele->setStatut ( '3' );
						$aAnnuaireList = new AnnuaireList ();
						$aAnnuaireList->SQL_RESET_REPONDU ( $_GET ['id'] );
						break;
					case PhaseConvention::$PHASE_SATISFACTION :
						$aConventionHistorique->setDescription ( "Changement de Statut Satisfaction->Archivé" );
						$aModele->setStatut ( '4' );
						break;
					default :
						break;
				}
				$aConventionHistorique->SQL_CREATE ();
				$aModele->SQL_update ();
			}
			$this->redirection ( '?' );
		}
	}
	private function historiqueAction() {
		if (isset ( $_GET ['id'] )) {
			$aConventionHistoriqueList = new ConventionHistoriqueList ();
			$aConventionHistoriqueList->SQL_SELECT_ALL ( $_GET ['id'] );
			$aConventionHistoriqueListView = new ConventionHistoriqueListView ( $aConventionHistoriqueList );
			echo $aConventionHistoriqueListView->renderHTML ();
		}
	}
	private function clonerAction() {
		if (isset ( $_GET ['id'] )) {
			$aConvention = new Convention ();
			$aConvention->SQL_select ( $_GET ['id'] );

			// Copie de la convention
			$aConvention2 = new Convention ();
			$aConvention2->setStatut ( 1 );
			$aConvention2->SQL_create ();
			$aConvention2->setID ( mysqli_insert_id ($_SESSION['LINK']) );
			$aConvention2->setNom ( $aConvention->getNom () );
			$aConvention2->setPageClotureInscription ( $aConvention->getPageClotureInscription () );
			$aConvention2->setPageClotureSatisfaction ( $aConvention->getPageClotureSatisfaction () );
			$aConvention2->SQL_update ();

			$aConventionHistorique = new ConventionHistorique ();
			$aConventionHistorique->setConventionID ( $aConvention2->getID () );
			$aConventionHistorique->setDescription ( 'Création de la Convention via Clonage' );
			$aConventionHistorique->SQL_CREATE ();

			// Import de l'annuaire
			$aModele = new Annuaire ();
			$aAnnuaireList = new AnnuaireList ();
			$aAnnuaireList->SQL_SELECT_ALL_GUEST_AND_MANUEL ( $_GET ['id'] );
			foreach ( $aAnnuaireList->getList () as $aAnnuaire ) {
				$aAnnuaire->setConventionID ( $aConvention2->getID () );
				$aAnnuaire->setPresence ( 1 );
				$aAnnuaire->setRepas ( 1 );
				$aAnnuaire->setRepondu ( 0 );
				$aAnnuaire->SQL_create ();
			}

			// Import des formulaire
			// Arret suite evolution Module Convention 2013
			/*
			 * $daoFormulaire = new ConventionFormulaireDAO();
			 * $daoComposition = new ConventionFormulaireCompositionDAO();
			 * $daoComposant = new ConventionFormulaireComposantDAO();
			 * $daoField = new ConventionFormulaireFieldDAO();
			 *
			 * $listFormulaires = $daoFormulaire->findAll($_GET['id']);
			 * if(count($listFormulaires)>0) {
			 * foreach($listFormulaires as $formulaire) {
			 * $oldIDFormulaire = $formulaire->getID();
			 * $formulaire->setNom('Copie - '.$formulaire->getNom());
			 * $formulaire->setConventionID($aConvention2->getID());
			 * $daoFormulaire->create($formulaire);
			 * $formulaire->setID(mysql_insert_id());
			 *
			 * $listComposites = $daoComposition->findAll($oldIDFormulaire);
			 * if(count($listComposites)>0) {
			 * foreach($listComposites as $composite) {
			 * $oldIDComposition = $composite->getId();
			 *
			 * $composite->setFormulaireId($formulaire->getID());
			 * $daoComposition->create($composite);
			 * $composite->setId(mysql_insert_id());
			 *
			 * if($composite->getType()==ConventionFormulaireComposition::TYPE_FIELD) {
			 * $field = $daoField->find($oldIDComposition);
			 * $field->setId($composite->getId());
			 * $daoField->create($field);
			 * } else {
			 * $composant = $daoComposant->find($oldIDComposition);
			 * $composant->setId($composite->getId());
			 * $daoComposant->create($composant);
			 * }
			 * }
			 * }
			 * }
			 * }
			 */

			$aConventionHistorique = new ConventionHistorique ();
			$aConventionHistorique->setConventionID ( $_GET ['id'] );
			$aConventionHistorique->setDescription ( 'Clonage de la Convention' );
			$aConventionHistorique->SQL_CREATE ();

			// Redirection
			$this->redirection ( '?' );
		}
	}

	// Tools //
	public static function getDateUS($DateFR) {
		$tab = preg_split ( "/[-\.\/ ]/", $DateFR, 3 );
		return $tab [2] . '-' . $tab [1] . '-' . $tab [0];
	}
	public static function getDateFR($DateUS) {
		$tab = preg_split ( "/[-\.\/ ]/", $DateUS, 3 );
		if (count ( $tab ) == 3) {
			return $tab [2] . '/' . $tab [1] . '/' . $tab [0];
		} else {
			return '//';
		}
	}
	private function message($msg) {
		$aff = '<script type="text/javascript">';
		$aff .= 'alert(\'' . $msg . '\');';
		$aff .= '</script>';
		echo $aff;
	}
	private function redirection($URL) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href=\'' . $URL . '\';';
		$aff .= '</script>';
		echo $aff;
	}
}
?>