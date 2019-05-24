<?php
class ImportIndividuController {
	public function run() {
		$action = isset ( $_GET ['action'] ) ? $_GET ['action'] : '';
		switch ($action) {
			case 'import' :
				if (isset ( $_FILES ['URLFile'] ['name'] ) && $_FILES ['URLFile'] ['name'] != '') {

					$IndividuNonImporte = array ();

					if (is_readable ( $_FILES ["URLFile"] ["tmp_name"] )) {
						if (($handle = fopen ( $_FILES ["URLFile"] ["tmp_name"], "r" )) !== FALSE) {

							while ( ($data = fgetcsv ( $handle, 1000, ";" )) !== FALSE ) {
								if (count ( $data ) == 8) {
									$aIndividu = new Individu ();
									$aIndividu->setCivilite ( $data [0] == 'M' ? '1' : ($data [0] == 'Mme' ? '2' : ($data [0] == 'Mlle' ? '3' : '1')) );
									$aIndividu->setNom ( strtoupper ( $data [1] ) );
									$aIndividu->setPrenom ( str_replace ( '- ', '-', ucwords ( str_replace ( '-', '- ', strtolower ( $data [2] ) ) ) ) );
									$aIndividu->setMail ( $data [3] );
									$aIndividu->setTelephone ( $data [4] );
									$aIndividu->setFax ( $data [5] );
									$aIndividu->setLoginSage ( $data [6] );

									// récupération de la liste des ID langue
									$LangueListe = explode ( "/", $data [7] );
									$ListeCodes = "(";
									foreach ( $LangueListe as $val ) {
										$ListeCodes = $ListeCodes . "'" . str_replace ( " ", "", $val ) . "',";
									}
									$ListeCodes = $ListeCodes . "'')";
									$aLangueListe = new LangueListe ();
									$aLangueListe->select_all_Langue_By_Code ( $ListeCodes );
									$aIndividu->setLangueListe ( $aLangueListe );

									$aIndividu->setLogin ( trim ( createUsername ( $data [1] ) ) );
									$aIndividu->setPassword ( trim ( createPassword () ) );

									$aEtablissement = new Simple_Etablissement ();
									$aEtablissement->SQL_SELECT_BY_LOGINSAGE ( $data [6] );
									$aIndividu->setLieuTravail ( $aEtablissement );

									$aAnnuaire = new Annuaire ();
									$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
									$aIndividu->setAnnuaire ( $aAnnuaire );

									// Check Unique //
									if (Individu::SQL_CHECK_UNIQUE ( $aIndividu->getPrenom (), $aIndividu->getNom () ) != NULL) {
										$IndividuNonImporte [] = array (
												'Nom' => $aIndividu->getNom (),
												'Prenom' => $aIndividu->getPrenom (),
												'Mail' => $aIndividu->getMail ()
										);
									} else {
										$aIndividu->create_individu ();
										$IID = $aIndividu->getID ();
										// $IID = mysql_insert_id();
										$aIndividu->find_id ();

										// Role
										$aRole = new Role ();
										$aRole->setIndividu ( $aIndividu );
										$aRole->setEtablissement ( $aEtablissement );
										$aRole->setAnnuaire ( $aAnnuaire );
										$aRole->create_role ();

										// Role Domaine Activite Fonction
										$aDomaineActiviteFonction = new DomaineActiviteFonction ();
										$aDomaineActiviteFonction->setRoleID ( mysqli_insert_id ($_SESSION['LINK']) );
										$aDomaineActiviteFonction->setDomaineActiviteID ( $_POST ['DomainActiviteID'] );
										$aDomaineActiviteFonction->setFonctionDAID ( $_POST ['FonctionDAID'] );
										$aDomaineActiviteFonction->SQL_CREATE ();

										// AUTOCREATION FICHE INDIVIDU

										$aIndividu2 = new Individu ();
										$aIndividu2->setCivilite ( $data [0] == 'M' ? '1' : ($data [0] == 'Mme' ? '2' : '3') );
										$aIndividu2->setNom ( strtoupper ( $data [1] ) );
										$aIndividu2->setPrenom ( str_replace ( '- ', '-', ucwords ( str_replace ( '-', '- ', strtolower ( $data [2] ) ) ) ) );
										$aIndividu2->setMail ( $data [3] );
										$aIndividu2->setTelephone ( $data [4] );
										$aIndividu2->setFax ( $data [5] );

										$aIndividu2->setLogin ( trim ( $aIndividu->getLogin () ) );
										$aIndividu2->setPassword ( trim ( $aIndividu->getPassword () ) );
										$aIndividu2->setLieuTravail ( $aEtablissement );
										$aIndividu2->setLoginSage ( $aIndividu->getLoginSage () );

										// Utilisateur CISCAR
										if ($_POST ['pLCACISCAR'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '1') {
											$aAnnuaire = new Annuaire ();
											$aAnnuaire->select_annuaire ( '1' );
											$aIndividu2->setAnnuaire ( $aAnnuaire );
											$aIndividu2->setLangueListe ( $aLangueListe );

											$aIndividu2->create_individu ();
										}
										// Utilisateur GCR
										if ($_POST ['pLCAGCR'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '2') {
											$aAnnuaire = new Annuaire ();
											$aAnnuaire->select_annuaire ( '2' );
											$aIndividu2->setAnnuaire ( $aAnnuaire );
											$aIndividu2->setLangueListe ( $aLangueListe );

											$aIndividu2->create_individu ();
										}
										// Utilisateur ACNF
										if ($_POST ['pLCAGCNF'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '3') {
											$aAnnuaire = new Annuaire ();
											$aAnnuaire->select_annuaire ( '3' );
											$aIndividu2->setAnnuaire ( $aAnnuaire );
											$aIndividu2->setLangueListe ( $aLangueListe );

											$aIndividu2->create_individu ();
										}
										// Utilisateur CISCAR BELGE
										if ($_POST ['pLCACISCARBELGE'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '1') {
											$aAnnuaire = new Annuaire ();
											$aAnnuaire->select_annuaire ( '1' );
											$aIndividu2->setAnnuaire ( $aAnnuaire );
											$aIndividu2->setLangueListe ( $aLangueListe );

											$aIndividu2->create_individu ();
										}

										// ######################
										// GESTION DE LA LCA
										// ######################

										$aSimple_LCAGroupeMembre = new Simple_LCAGroupeMembre ();
										$tabIndividuId = $aSimple_LCAGroupeMembre->SQL_SELECT_IndividuID ( $aIndividu->getLogin () );

										foreach ( $tabIndividuId as $aIndividuID ) {
											// if ($_POST ['pLCAGCNF'] == '1') {
											// $aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 5, $aIndividuID );

											// // Securite pour les doubles
											// if ($_POST ['pLCAGCNF'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '3') {
											// $aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 5, $aIndividuID2 );
											// }
											// }

											if ($_POST ['pLCAGCR'] == '1') {
												$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 4, $aIndividuID );
											}

											if ($_POST ['pLCACISCAR'] == '1') {
												$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 3, $aIndividuID );

												// Affichage CISCAR
												switch ($_POST ['PROFIL_RENAULT']) {
													case '0' :

														// Renault
														$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 8, $aIndividuID );
														break;
													case '2' :

														// INDRA
														$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 15, $aIndividuID );
														break;
													default :

														// Hors Renault
														$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 9, $aIndividuID );
														break;
												}
											}

											// Securite Module

											if ($_POST ['pLCASiteEmploi'] == '1') {
												$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 11, $aIndividuID );
											}

											// Securite AUTOLOGIN

											if ($_POST ['pLCACiscom'] == '1') {
												$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 12, $aIndividuID );
											}
											if ($_POST ['pLCACarterie'] == '1') {
												$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 13, $aIndividuID );
											}
											if ($_POST ['pLCACISCARBELGE'] == '1') {
												$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 6, $aIndividuID );
											}
											if ($_POST ['pLCASTVA'] == '1') {
												if ($_SERVER ['HTTP_HOST'] == 'gcrfrance.local' || $_SERVER ['HTTP_HOST'] == 'ciscar.local') {
													// Base local
													$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 433, $aIndividuID );
												} else {
													// Base de production
													$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 497, $aIndividuID );
												}
											}
										}
									}
								}
							}
							fclose ( $handle );
						}
					}
					$aff = '<script type="text/javascript">';
					$aff .= 'alert("Import Terminé");';
					$aff .= '</script>';
					echo $aff;

					if (count ( $IndividuNonImporte ) > 0) {
						echo '<h3>Individu non importé</h3>';
						echo '<table border="1">';
						foreach ( $IndividuNonImporte as $individu ) {
							echo '<tr><td>' . $individu ['Nom'] . '</td><td>' . $individu ['Prenom'] . '</td><td>' . $individu ['Mail'] . '</td></tr>';
						}
						echo '</table>';
					} else {
						echo CommunFunction::goToURL ( '?' );
					}
				}
				break;
			default :
				$view = new ImportIndividuView ();
				$view->renderHTML ();
				break;
		}
	}

	// Methods //
}