<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class LCAControler {
	function run() {
		switch ($_GET ['action']) {
			case 'new' :
				if (isset ( $_POST ['Nom'] )) {
					$aSimple_LCAGroupe = new Simple_LCAGroupe ();
					$aSimple_LCAGroupe->setLibelle ( $_POST ['Nom'] );
					$aSimple_LCAGroupe->SQL_INSERT ();

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aSimple_LCAGroupe = new Simple_LCAGroupe ();
					$aLCAGroupeView = new LCAGroupeView ( $aSimple_LCAGroupe );
					$aLCAGroupeView->renderHTML ( 'new' );
				}
				break;
			case 'edit' :
				if (isset ( $_POST ['Nom'] )) {
					$aSimple_LCAGroupe = new Simple_LCAGroupe ();
					$aSimple_LCAGroupe->setLibelle ( $_POST ['Nom'] );
					$aSimple_LCAGroupe->setID ( $_GET ['id'] );
					$aSimple_LCAGroupe->SQL_UPDATE ();

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aSimple_LCAGroupe = new Simple_LCAGroupe ();
					$aSimple_LCAGroupe->SQL_SELECT ( $_GET ['id'] );
					$aLCAGroupeView = new LCAGroupeView ( $aSimple_LCAGroupe );
					$aLCAGroupeView->renderHTML ( 'edit' );
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aSimple_LCAGroupe = new Simple_LCAGroupe ();
					$aSimple_LCAGroupe->setID ( $_GET ['id'] );
					$aSimple_LCAGroupe->SQL_DELETE ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;

			case 'm' :
				if (isset ( $_GET ['id'] )) {
					$NbEntre = 0;
					$aSimple_LCAGroupeMembreList = new Simple_LCAGroupeMembreList ();
					$aSimple_LCAGroupeMembreList->SQL_SELECT_ALL_MEMBRE ( trim ( $_GET ['id'] ) );
					// Element Max
					$NbEntre = $aSimple_LCAGroupeMembreList->SQL_COUNT ( trim ( $_GET ['id'] ) );
					$aSimple_LCAGroupeMembreListView = new Simple_LCAGroupeMembreListView ( $aSimple_LCAGroupeMembreList, $NbEntre );
					$aSimple_LCAGroupeMembreListView->renderHTML ( 'membre' );
				}
				break;
			case 'add' :
				if (isset ( $_GET ['id'] ) && ! isset ( $_GET ['idi'] )) {
					// Avec Recherche
					if (isset ( $_POST ['Recherche'] ) && $_POST ['Recherche'] != NULL) {
						$NbEntre = 0;
						$aSimple_LCAGroupeMembreList = new Simple_LCAGroupeMembreList ();
						$aSimple_LCAGroupeMembreList->SQL_SEARCH ( trim ( $_GET ['id'] ), $_POST ['Recherche'], isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
						// Element Max
						$NbEntre = $aSimple_LCAGroupeMembreList->SQL_SEARCH_COUNT ( trim ( $_GET ['id'] ), $_POST ['Recherche'] );
					} elseif (isset ( $_GET ['Recherche'] ) && $_GET ['Recherche'] != NULL) {
						$NbEntre = 0;
						$aSimple_LCAGroupeMembreList = new Simple_LCAGroupeMembreList ();
						$aSimple_LCAGroupeMembreList->SQL_SEARCH ( trim ( $_GET ['id'] ), $_GET ['Recherche'], isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
						// Element Max
						$NbEntre = $aSimple_LCAGroupeMembreList->SQL_SEARCH_COUNT ( trim ( $_GET ['id'] ), $_GET ['Recherche'] );
					} // Sans Recherche
					else {
						$NbEntre = 0;
						$aSimple_LCAGroupeMembreList = new Simple_LCAGroupeMembreList ();
						$aSimple_LCAGroupeMembreList->SQL_SEARCH ( trim ( $_GET ['id'] ), '', isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'a' );
						// Element Max
						$NbEntre = $aSimple_LCAGroupeMembreList->SQL_COUNT ( trim ( $_GET ['id'] ) );
					}

					$aSimple_LCAGroupeMembreListView = new Simple_LCAGroupeMembreListView ( $aSimple_LCAGroupeMembreList, $NbEntre );
					$aSimple_LCAGroupeMembreListView->renderHTML ( 'add' );
				} else if (isset ( $_GET ['id'] ) && isset ( $_GET ['idi'] )) {
					// Ajout de l'individu au groupe
					$aSimple_LCAGroupeMembre = new Simple_LCAGroupeMembre ();
					$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( trim ( $_GET ['id'] ), trim ( $_GET ['idi'] ) );

					$this->redirection ( '?action=m&id=' . trim ( $_GET ['id'] ) );
				}
				break;
			// Ajouter au groupe utilisateurs sans Concession
			case 'adduser' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Individu ();
					$vue = new IndividuTabView ( $modele );
					$vue->renderHTML ( 'new_sans_role' );
				} else {
					// Creer l'individu
					$aIndividu = new Individu ();
					$aIndividu->setNom ( trim ( $_POST ['Nom'] ) );
					$aIndividu->setPrenom ( trim ( $_POST ['Prenom'] ) );
					$aIndividu->setTelephone ( trim ( $_POST ['Telephone'] ) );
					$aIndividu->setTelephonePortable ( trim ( $_POST ['TelephonePortable'] ) );
					$aIndividu->setFax ( trim ( $_POST ['Fax'] ) );
					$aIndividu->setMail ( trim ( $_POST ['Mail'] ) );
					$aIndividu->setMail2 ( trim ( $_POST ['Mail2'] ) );
					$aIndividu->setMail3 ( trim ( $_POST ['Mail3'] ) );
					$aIndividu->setMail4 ( trim ( $_POST ['Mail4'] ) );
					$aIndividu->setLoginRgpd( trim ( $_POST ['LoginRgpd'] ) );
					
					$aIndividu->setEnSommeil ( trim ( $_POST ['EnSommeil'] ) );

					// Recuperation de la liste des langues sélectionnées
					$aLangueListe = new LangueListe ();
					$aLangueListe->select_all_Langue ();
					$aLangueListeSeleted = new LangueListe ();

					foreach ( $aLangueListe->getLangueListe () as $aLangue ) {
						if (! empty ( $_POST ['lg_' . $aLangue->getID ()] )) {
							$aLangueListeSeleted->addLangue ( $aLangue );
						}
					}
					$aIndividu->setLangueListe ( $aLangueListeSeleted );

					$aIndividu->setImportActif ( trim ( $_POST ['ImportActif'] ) );
					$aIndividu->setLogin ( trim ( createUsername ( $_POST ['Nom'] ) ) );
					$aIndividu->setPassword ( trim ( createPassword () ) );
					$aIndividu->setCivilite ( trim ( $_POST ['Civilite'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aIndividu->setAnnuaire ( $aAnnuaire );

					$aIndividu->create_individu ();
					$IID = $aIndividu->getID ();

					// Creation des fonction bn
					$aIndividuFonctionBN = new IndividuFonctionBN ();
					$aIndividuFonctionBN->setIndividuID ( $IID );

					if (isset($_POST ['FonctionBNID']))
					{
						foreach ( $_POST ['FonctionBNID'] as $aFonctionBNID ) {
							if ($aFonctionBNID != 0) {
								$aIndividuFonctionBN->setFonctionBNID ( $aFonctionBNID );
								$aIndividuFonctionBN->SQL_CREATE ();
							}
						}
					}

					// Créer la jointure avec les commissions et groupes de travail
					for($i = 1; $i <= 4; $i ++) {
						if(isset($_POST ['CommissionID_' . $i]))
						{
							if ($_POST ['CommissionID_' . $i] != '0') {
								$aCommissionIndividu = new CommissionIndividu ();
								$aCommission = new Commission ();
								$aCommission->select_commission ( trim ( $_POST ['CommissionID_' . $i] ) );
								$aCommissionIndividu->setCommission ( $aCommission );
	
								$aCommissionIndividu->setIndividu ( $aIndividu );
	
								$aFonctionCommission = new FonctionCommission ();
								$aFonctionCommission->select_fonctioncommission ( trim ( $_POST ['FonctionCommissionID_' . $i] ) );
								$aCommissionIndividu->setFonctionCommission ( $aFonctionCommission );
	
								$aCommissionIndividu->create_commissionindividu ();
							}
						}
					}

					// Delegation
					if (isset($_POST ['RegionID']))
					{
						if ($_POST ['RegionID'] != '0') {
							$aDelegationRegionnale = new DelegationRegionnale ();
							$aDelegationRegionnale->setIndividu ( $aIndividu );
	
							$aRegion = new Region ();
							$aRegion->select_region ( trim ( $_POST ['RegionID'] ) );
							$aDelegationRegionnale->setRegion ( $aRegion );
	
							$aFonctionDelegation = new FonctionDelegation ();
							$aFonctionDelegation->select_fonctiondelegation ( trim ( $_POST ['FonctionDelegationID'] ) );
							$aDelegationRegionnale->setFonctionDelegation ( $aFonctionDelegation );
	
							$aDelegationRegionnale->create_delegationregionnale ();
						}
					}

					// ###################################
					// ###################################
					// ###################################

					// AUTOCREATION FICHE INDIVIDU

					$aIndividu2 = new Individu ();
					$aIndividu2->setNom ( trim ( $_POST ['Nom'] ) );
					$aIndividu2->setPrenom ( trim ( $_POST ['Prenom'] ) );
					$aIndividu2->setTelephone ( trim ( $_POST ['Telephone'] ) );
					$aIndividu2->setTelephonePortable ( trim ( $_POST ['TelephonePortable'] ) );
					$aIndividu2->setFax ( trim ( $_POST ['Fax'] ) );
					$aIndividu2->setMail ( trim ( $_POST ['Mail'] ) );
					$aIndividu2->setMail2 ( trim ( $_POST ['Mail2'] ) );
					$aIndividu2->setMail3 ( trim ( $_POST ['Mail3'] ) );
					$aIndividu2->setMail4 ( trim ( $_POST ['Mail4'] ) );
					$aIndividu2->setEnSommeil ( trim ( $_POST ['EnSommeil'] ) );
					$aIndividu2->setImportActif ( trim ( $_POST ['ImportActif'] ) );
					$aIndividu2->setLogin ( trim ( $aIndividu->getLogin () ) );
					$aIndividu2->setPassword ( trim ( $aIndividu->getPassword () ) );
					$aIndividu2->setCivilite ( trim ( $_POST ['Civilite'] ) );
					$aIndividu2->setLoginSage ( $aIndividu->getLoginSage () );
					$aIndividu2->setLoginRgpd( trim ( $_POST ['LoginRgpd'] ) );
					
					// Utilisateur CISCAR
					if ($_POST ['ACCES_CISCAR'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '1') {
						$aAnnuaire = new Annuaire ();
						$aAnnuaire->select_annuaire ( '1' );
						$aIndividu2->setAnnuaire ( $aAnnuaire );
						$aIndividu2->setLangueListe ( $aLangueListeSeleted );
						$aIndividu2->create_individu ();
					}
					// Utilisateur GCR
					if ($_POST ['ACCES_GCR'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '2') {
						$aAnnuaire = new Annuaire ();
						$aAnnuaire->select_annuaire ( '2' );
						$aIndividu2->setAnnuaire ( $aAnnuaire );
						$aIndividu2->setLangueListe ( $aLangueListeSeleted );
						$aIndividu2->create_individu ();
					}
					// Utilisateur ACNF
					// if ($_POST ['ACCES_ACNF'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '3') {
					// $aAnnuaire = new Annuaire ();
					// $aAnnuaire->select_annuaire ( '3' );
					// $aIndividu2->setAnnuaire ( $aAnnuaire );
					// $aIndividu2->setLangueListe ( $aLangueListeSeleted );
					// $aIndividu2->create_individu ();
					// }

					// ######################
					// GESTION DE LA LCA
					// ######################

					$aSimple_LCAGroupeMembre = new Simple_LCAGroupeMembre ();
					$tabIndividuId = $aSimple_LCAGroupeMembre->SQL_SELECT_IndividuID ( $aIndividu->getLogin () );
					$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 14, $aIndividu->getID () );

					foreach ( $tabIndividuId as $aIndividuID ) {
						// if ($_POST ['ACCES_ACNF'] == '1') {
						// $aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 5, $aIndividuID );
						// }
						if ($_POST ['ACCES_CISCAR'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 3, $aIndividuID );
						}
						if ($_POST ['PROFIL_RENAULT'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 8, $aIndividuID );
						} else {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 9, $aIndividuID );
						}

						if ($_POST ['ACCES_GCR'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 4, $aIndividuID );
						}
						if ($_POST ['ACCES_SITE_EMPLOI'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 11, $aIndividuID );
						}
						if ($_POST ['ACCES_CISCOM'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 12, $aIndividuID );
						}
						if ($_POST ['ACCES_CARTERIE'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 13, $aIndividuID );
						}
						if ($_POST ['ACCES_STVA'] == '1') {
							if ($_SERVER ['HTTP_HOST'] == 'gcrfrance.local' || $_SERVER ['HTTP_HOST'] == 'ciscar.local') {
								// Base local
								$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 433, $aIndividuID );
							} else {
								// Base de production
								$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 497, $aIndividuID );
							}
						}
					}
					$this->redirection ( '?action=m&id=14' );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] ) && isset ( $_GET ['idi'] )) {
					// Suppression du membre au groupe
					$aSimple_LCAGroupeMembre = new Simple_LCAGroupeMembre ();
					$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( trim ( $_GET ['id'] ), trim ( $_GET ['idi'] ) );

					$this->redirection ( '?action=m&id=' . trim ( $_GET ['id'] ) );
				}
				break;
		}
	}
	public function redirection($url) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href="' . $url . '";';
		$aff .= '</script>';
		echo $aff;
	}
}
?>