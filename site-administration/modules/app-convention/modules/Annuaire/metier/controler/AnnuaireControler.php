<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage annuaire
 * @version 1.0.4
 */
class AnnuaireControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			// Action réalisé sur les checkbox de l'annuaire
			// On boucle sur les post de la requete en supprimant le $_POST qui permet d'identifier le type d'action et le select du type
			case 'checkbox' :
				if (isset ( $_GET ['id'] )) {
					// Suppression
					if (isset ( $_POST ['delete'] )) {
						unset ( $_POST ['delete'] );
						unset ( $_POST ['selectType'] );
						$count = 0;
						foreach ( $_POST as $value => $key ) {
							$this->delete ( $key );
							$count += 1;
						}
						$this->message ( $count . ' individu(s) supprimé(s)' );
						$this->redirection ( '?id=' . $_GET ['id'] );
					}
					// Modification du type
					if (isset ( $_POST ['updateType'] )) {
						unset ( $_POST ['updateType'] );
						$idType = $_POST ['selectType'];
						unset ( $_POST ['selectType'] );
						$count = 0;
						$aAnnuaire = new Annuaire ();
						if (! empty ( $idType )) {
							foreach ( $_POST as $value => $key ) {
								$aAnnuaire->SQL_select ( $key );
								$aAnnuaire->setAnnuaireTypeID ( $idType );
								$aAnnuaire->SQL_update ();
								// LOG USER HISTORY
								$daoUserHistory = new UserHistoryDAO ();
								$userLog = new UserHistory ();
								$userLog->setDescription ( 'Modification Fiche Individu' );
								$userLog->setUserId ( $key );
								$userLog->setActionRealiseePar ( 'Gestionnaire' );
								$daoUserHistory->create ( $userLog );
								$count += 1;
							}
							$this->message ( $count . ' individu(s) modifié(s)' );
						} else {
							$this->message ( 'Veuillez sélectionner un type' );
						}

						$this->redirection ( '?id=' . $_GET ['id'] );
					}
					// Envoi inscription
					if (isset ( $_POST ['sendRegistration'] )) {
						unset ( $_POST ['sendRegistration'] );
						unset ( $_POST ['selectType'] );
						$count = 0;
						$error = 0;
						foreach ( $_POST as $value => $key ) {
							if (! $this->sendRegistration ( $key )) {
								$error += 1;
							}
							$count += 1;
						}
						if ($error) {
							$this->message ( 'Attention ' . $error . ' erreurs' );
						} else {
							$this->message ( $count . ' inscription(s) envoyé(s)' );
						}
						$this->redirection ( '?id=' . $_GET ['id'] );
					}
					// Rappel envoi inscription
					if (isset ( $_POST ['sendReminderRegistration'] )) {
						unset ( $_POST ['sendReminderRegistration'] );
						unset ( $_POST ['selectType'] );
						$count = 0;
						$error = 0;
						foreach ( $_POST as $value => $key ) {
							if (! $this->sendReminderRegistration ( $key )) {
								$error += 1;
							}
							$count += 1;
						}
						if ($error) {
							$this->message ( 'Attention ' . $error . ' erreurs' );
						} else {
							$this->message ( $count . ' relance inscription envoyé(s)' );
						}
						$this->redirection ( '?id=' . $_GET ['id'] );
					}
					// Envoi identifiant
					if (isset ( $_POST ['sendId'] )) {
						unset ( $_POST ['sendId'] );
						unset ( $_POST ['selectType'] );
						$count = 0;
						$error = 0;
						foreach ( $_POST as $value => $key ) {
							if (! $this->sendId ( $key )) {
								$error += 1;
							}
							$count += 1;
						}
						if ($error) {
							$this->message ( 'Attention ' . $error . ' erreurs' );
						} else {
							$this->message ( $count . ' identifiant(s) envoyé(s)' );
						}
						$this->redirection ( '?id=' . $_GET ['id'] );
					}
					// Envoi questionnaire satisfaction
					if (isset ( $_POST ['sendSatisfaction'] )) {
						unset ( $_POST ['sendSatisfaction'] );
						unset ( $_POST ['selectType'] );
						$count = 0;
						$error = 0;
						foreach ( $_POST as $value => $key ) {
							if (! $this->sendSatisfaction ( $key )) {
								$error += 1;
							}
							$count += 1;
						}
						if ($error) {
							$this->message ( 'Attention ' . $error . ' erreurs' );
						} else {
							$this->message ( $count . ' questionnaires satisfaction envoyé(s)' );
						}
						$this->redirection ( '?id=' . $_GET ['id'] );
					}
					// Envoi questionnaire Relance satisfaction
					if (isset ( $_POST ['sendRelanceSatisfaction'] )) {
						unset ( $_POST ['sendRelanceSatisfaction'] );
						unset ( $_POST ['selectType'] );
						$count = 0;
						$error = 0;
						foreach ( $_POST as $value => $key ) {
							if (! $this->sendRelanceSatisfaction ( $key )) {
								$error += 1;
							}
							$count += 1;
						}
						if ($error) {
							$this->message ( 'Attention ' . $error . ' erreurs' );
						} else {
							$this->message ( $count . ' questionnaires relance satisfaction envoyé(s)' );
						}
						$this->redirection ( '?id=' . $_GET ['id'] );
					}
				}
				break;
			case 'synchro' :
				if (isset ( $_GET ['id'] )) {
					// Suppression des individus GCR
					$aAnnuaireList = new AnnuaireList ();
					$aAnnuaireList->SQL_DELETE_ALL_GCR ( $_GET ['id'] );
					// Reimportation des individus GCR
					$aModele = new Annuaire ();
					$aModele->SQL_IMPORT_GCR ( $_GET ['id'] );
					// Ajout de l'historique
					$aConventionHistorique = new ConventionHistorique ();
					$aConventionHistorique->setConventionID ( $_GET ['id'] );
					$aConventionHistorique->setDescription ( "Synchronisation Annuaire" );
					$aConventionHistorique->SQL_CREATE ();

					// Redirection
					$this->message ( 'Synchronisation terminée' );
					$this->redirection ( '?id=' . $_GET ['id'] );
				}
				break;
			case 'importManuel' :
				if (isset ( $_FILES ['URLFile'] ['name'] ) && $_FILES ['URLFile'] ['name'] != '') {
					if (is_readable ( $_FILES ["URLFile"] ["tmp_name"] )) {
						if (($handle = fopen ( $_FILES ["URLFile"] ["tmp_name"], "r" )) !== FALSE) {
							$errorHtml = '';
							$error = FALSE;
							$i = 0;
							$e = 0;
							while ( ($data = fgetcsv ( $handle, 1000, ";" )) !== FALSE ) {
								if (count ( $data ) == 10) {
									$intance = new Annuaire ();
									$intance->setConventionID ( $_GET ['id'] );
									if (! empty ( $data [0] )) {
										$intance->setCivilite ( $data [0] );
									}
									$intance->setNom ( $data [1] );
									$intance->setPrenom ( $data [2] );
									if ($intance->SQL_check_email ( $data [3], $_GET ['id'] )) {
										$intance->setMail ( $data [3] );
									} else {
										$errorHtml .= 'Ligne : ' . $i + $e . '  ->' . $data [1] . ' ' . $data [2] . '<strong>(Cet email existe déjà)</strong>.<br />';
										$error = TRUE;
									}

									$intance->setSociete ( $data [4] );
									$intance->setAdresse ( $data [5] );
									$intance->setCodePostal ( $data [6] );
									$intance->setVille ( $data [7] );
									$intance->setTypeInscription ( 1 );

									if (! empty ( $data [9] )) {
										if ($data [9] == 9 || $data [9] == 11 || $data [9] == 12 || $data [9] == 13 || $data [9] == 15 || $data [9] == 23 || $data [9] == 25 || $data [9] == 27 || $data [9] == 28) {
											// if($data[9] >= 9 && $data[9] <= 16){
											$intance->setDirectionRegionale ( $data [9] );
										} else {
											$errorHtml .= 'Ligne : ' . $i + $e . '  ->' . $data [1] . ' ' . $data [2] . '<strong>(Erreur Direction Régionale)</strong>.<br />';
											$error = TRUE;
										}
									}
									if (empty ( $data [8] )) {
										$intance->setAnnuaireTypeID ( 6 );
									} else {
										if ($data [8] >= 1 && $data [8] <= 9) {
											$intance->setAnnuaireTypeID ( $data [8] );
										} else {
											$errorHtml .= 'Ligne : ' . $i + $e . '  ->' . $data [1] . ' ' . $data [2] . '<strong>(Erreur Type)</strong>.<br />';
											$error = TRUE;
										}
									}
									$intance->setLogin ( $intance->loginGenerator () );
									$intance->setPassword ( $intance->passwdGenerator () );
									if (! $error) {
										$i ++;
										$intance->SQL_create ();
									} else {
										$e ++ . $error = FALSE;
									}
								}
							}
							fclose ( $handle );
						}
					}
					if (empty ( $errorHtml )) {
						$this->message ( 'Import terminé \n \n' . $i . ' individu(s) importé(s).' );
						$this->redirection ( '?id=' . $_GET ['id'] );
					} else {
						$this->message ( $e . ' erreur(s)! \n\n' . $i . ' individu(s) importé(s).' );
						echo $errorHtml;
					}
				} else {
					if (isset ( $_GET ['id'] )) {

						$aList = new AnnuaireList ();
						$dr = $aList->SQL_SELECT_ALL_DirectionRegionale ();

						$view = new AnnuaireImportView ( $dr );
						$view->renderHTML ();
					}
				}
				break;
			/*
			 * Notification Mail
			 * A un Individu selectionnï¿½
			 */
			case 'mail-passwd' :
				if (isset ( $_GET ['id'] )) {
					if ($this->sendId ( $_GET ['id'] )) {
						$this->message ( 'Message Envoyé' );
						$this->redirection ( '?action=edit&id=' . $_GET ['id'] );
					} else {
						$this->message ( 'Message en Erreur' );
					}
				} else {
					echo 'erreur';
				}
				break;
			// Envoi d'une invitation
			case 'UEnvoiInvitation' :
				if (isset ( $_GET ['id'] )) {
					if ($this->sendRegistration ( $_GET ['id'] )) {
						$this->message ( 'Message Envoyé' );
						$this->redirection ( '?action=edit&id=' . $_GET ['id'] );
					} else {
						$this->message ( 'Message en Erreur' );
					}
				} else {
					echo 'erreur';
				}
				break;
			// Envoi d'une relance
			case 'UEnvoiRelance' :
				if (isset ( $_GET ['id'] )) {
					if ($this->sendReminderRegistration ( $_GET ['id'] )) {
						$this->message ( 'Message Envoyé' );
						$this->redirection ( '?action=edit&id=' . $_GET ['id'] );
					} else {
						$this->message ( 'Message en Erreur' );
					}
				} else {
					echo 'erreur';
				}
				break;
			// Envoi d'une satisfaction
			case 'UEnvoiRelanceSatisfaction' :
				if (isset ( $_GET ['id'] )) {
					// la fonction sendSatisfaction retoune false si ca se passe mal , si ok elle retourne l'id de l'annuaire
					// comme id est supérieure à 0 , la condition est Ok
					if ($this->sendRelanceSatisfaction ( $_GET ['id'] )) {
						$this->message ( 'Message Envoyé' );
						$this->redirection ( '?action=edit&id=' . $_GET ['id'] );
					} else {
						$this->message ( 'Message en Erreur' );
					}
				} else {
					echo 'erreur';
				}
				break;
			case 'UEnvoiSatisfaction' :
				if (isset ( $_GET ['id'] )) {
					// la fonction sendSatisfaction retoune false si ca se passe mal , si ok elle retourne l'id de l'annuaire
					// comme id est supérieure à 0 , la condition est Ok
					if ($this->sendSatisfaction ( $_GET ['id'] )) {
						$this->message ( 'Message Envoyé' );
						$this->redirection ( '?action=edit&id=' . $_GET ['id'] );
					} else {
						$this->message ( 'Message en Erreur' );
					}
				} else {
					echo 'erreur';
				}
				break;
			case 'UEnvoiConfirmationInvitation' :
				if (isset ( $_GET ['id'] )) {
					include ('../../../commun/metier/modele/NotificationMail.class.php');

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->SQL_select ( $_GET ['id'] );

					$aParamFROM = new Parametre ();
					$aParamFROM->SQL_select_by_name ( "MAIL_4_FROM" );
					$aParamSUBJET = new Parametre ();
					$aParamSUBJET->SQL_select_by_name ( "MAIL_4_SUBJECT" );
					$aParamHEADER = new Parametre ();
					$aParamHEADER->SQL_select_by_name ( "MAIL_4_HEADER" );
					$aParamFOOTER = new Parametre ();
					$aParamFOOTER->SQL_select_by_name ( "MAIL_4_FOOTER" );

					$aMail = new NotificationMail ();
					$aMail->setFrom ( $aParamFROM->getValeur () );
					$aMail->setTo ( $aAnnuaire->getMail () );
					$aMail->setSubject ( stripslashes ( $aParamSUBJET->getValeur () ) );

					$msg = '';
					// $msg = '<img src="http://www.gcrfrance.com/convention/web/images/bandeau_convention_gcr.jpg" border="0"><br><br>';
					// $msg .= 'Bonjour '.$aAnnuaire->getPrenom().' '. $aAnnuaire->getNom().',<br><br>';
					$msg .= stripslashes ( $aParamHEADER->getValeur () );

					$msg .= '<br>';
					// $msg .= 'Présent à la convention : '.($aAnnuaire->getPresence()=='0'?'Non':'Oui').'<br>';
					// $msg .= 'Présent au repas : '.($aAnnuaire->getRepas()=='0'?'Non':'Oui').'<br><br>';
					// $msg .= 'Besoin d\'un taxi : '.($aAnnuaire->getTaxi()=='0'?'Non':'Oui').'<br><br>';

					$msg .= '<br/>';
					$msg .= stripslashes ( $aParamFOOTER->getValeur () );
					$msg = str_replace ( '{Nom}', $aAnnuaire->getNom (), $msg );
					$msg = str_replace ( '{Prenom}', $aAnnuaire->getPrenom (), $msg );
					$msg = str_replace ( '{Login}', $aAnnuaire->getLogin (), $msg );
					$msg = str_replace ( '{Mdp}', $aAnnuaire->getPassword (), $msg );
					$msg = str_replace ( '{Civ}', $aAnnuaire->getStringCivilite (), $msg );
					$msg = str_replace ( '{Cher}', $aAnnuaire->getStringCher (), $msg );
					$msg = str_replace ( '{Pres_Repas}', ($aAnnuaire->getRepas () == '0' ? 'Non' : 'Oui'), $msg );
					$msg = str_replace ( '{Pres_Conv}', ($aAnnuaire->getPresence () == '0' ? 'Non' : 'Oui'), $msg );
					if ($aAnnuaire->getTaxi () == '0')
						$taxi = 'Place de parking : <b>Non</b>';
					else if ($aAnnuaire->getTaxi () == '1')
						$taxi = 'Place de parking : <b>Oui</b>';
					else
						$taxi = '';
					$msg = str_replace ( '{Taxi}', $taxi, $msg );

					if ($aAnnuaire->getDiner () == '0')
						$diner = 'Présence au dîner : <b>Non</b>';
					else if ($aAnnuaire->getDiner () == '1')
						$diner = 'Présence au dîner : <b>Oui</b>';
					else
						$diner = '';
					$msg = str_replace ( '{Diner}', $diner, $msg );

					$msg = str_replace ( '/userfiles/', 'http://www.' . $_SERVER ['HTTP_HOST'] . '/userfiles/', $msg );
					$msg = str_replace ( '{AutoLogin}', '?login=' . utf8_encode ( $aAnnuaire->getLogin () ) . '&pwd=' . utf8_encode ( $aAnnuaire->getPassword () ), $msg );

					// $msg .= '<br><img src="http://www.gcrfrance.com/convention/web/images/logoGCRpetit.gif" border="0"><br>';

					$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $msg ) . '</body></html>' );
					// $aMail->setMessage('<html><body style="font-family:arial;">'.stripslashes($msg).'</body></html>');
					$aMail->setHeaderReplyTo ( $aParamFROM->getValeur () );
					$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
					$aMail->setHeaderContentTransferEncoding ( '8bit' );

					// LOG USER HISTORY
					$daoUserHistory = new UserHistoryDAO ();
					$userLog = new UserHistory ();
					$userLog->setDescription ( 'Notification Confirmation Inscription' );
					$userLog->setUserId ( $_GET ['id'] );
					$userLog->setActionRealiseePar ( 'Gestionnaire' );

					$daoUserHistory->create ( $userLog );

					if ($aMail->send ()) {
						$this->message ( 'Message Envoyé' );
						$this->redirection ( '?action=edit&id=' . $aAnnuaire->getID () );
					} else {
						$this->message ( 'Message en Erreur' );
						$this->redirection ( '?action=edit&id=' . $aAnnuaire->getID () );
					}
				} else {
					echo 'erreur';
				}
				break;

			/*
			 * ##############################################################
			 * ##############################################################
			 */
			case 'new' :
				if (isset ( $_POST ['Nom'] )) {
					$aAnnuaire = new Annuaire ();
					$aAnnuaire->setConventionID ( $_GET ['id'] );
					// $aAnnuaire->setDomainActiviteID($_POST['DomaineActiviteID']);
					$aAnnuaire->setAnnuaireTypeID ( $_POST ['AnnuaireTypeID'] );
					$aAnnuaire->setCivilite ( isset ( $_POST ['Civilite'] ) ? $_POST ['Civilite'] : null );
					$aAnnuaire->setNom ( $_POST ['Nom'] );
					$aAnnuaire->setPrenom ( $_POST ['Prenom'] );
					$aAnnuaire->setSociete ( $_POST ['Societe'] );
					$aAnnuaire->setAdresse ( $_POST ['Adresse'] );
					$aAnnuaire->setCodePostal ( $_POST ['CodePostal'] );
					$aAnnuaire->setVille ( $_POST ['Ville'] );
					$aAnnuaire->setMail ( $_POST ['Mail'] );
					$aAnnuaire->setLogin ( $_POST ['Login'] == '' ? $aAnnuaire->loginGenerator () : $_POST ['Login'] );
					$aAnnuaire->setPassword ( $_POST ['Password'] );
					$aAnnuaire->setDirectionRegionale ( $_POST ['fieldDR'] );
					$aAnnuaire->setTypeInscription ( 1 );

					$aAnnuaire->setRepondu ( $_POST ['fieldRepondu'] );
					$aAnnuaire->setPresence ( $_POST ['fieldPresent'] );
					$aAnnuaire->setRepas ( $_POST ['fieldPresentRepas'] );
					$aAnnuaire->setTaxi ( $_POST ['fieldTaxi'] );
					$aAnnuaire->setDiner ( $_POST ['fieldDiner'] );

					$aAnnuaire->SQL_create ();

					$this->redirection ( '?id=' . $_GET ['id'] );
				} else {
					$aAnnuaire = new Annuaire ();
					$aAnnuaire->setPassword ( $aAnnuaire->passwdGenerator () );

					$aList = new AnnuaireList ();
					$dr = $aList->SQL_SELECT_ALL_DirectionRegionale ();

					$aAnnuaireView = new AnnuaireView ( $aAnnuaire, $dr );
					$aAnnuaireView->renderHTML ( 'new' );
				}
				break;
			case 'edit' :
				if (isset ( $_POST ['Nom'] )) {
					$aAnnuaire = new Annuaire ();
					$aAnnuaire->SQL_select ( $_GET ['id'] );
					$aAnnuaire->setAnnuaireTypeID ( $_POST ['AnnuaireTypeID'] );
					// $aAnnuaire->setDomainActiviteID($_POST['DomaineActiviteID']);
					$aAnnuaire->setCivilite ( isset ( $_POST ['Civilite'] ) ? $_POST ['Civilite'] : null );
					$aAnnuaire->setNom ( $_POST ['Nom'] );
					$aAnnuaire->setPrenom ( $_POST ['Prenom'] );
					$aAnnuaire->setSociete ( $_POST ['Societe'] );
					$aAnnuaire->setAdresse ( $_POST ['Adresse'] );
					$aAnnuaire->setCodePostal ( $_POST ['CodePostal'] );
					$aAnnuaire->setVille ( $_POST ['Ville'] );
					$aAnnuaire->setMail ( $_POST ['Mail'] );
					$aAnnuaire->setLogin ( $_POST ['Login'] );
					$aAnnuaire->setPassword ( $_POST ['Password'] );
					$aAnnuaire->setDirectionRegionale ( $_POST ['fieldDR'] );

					$aAnnuaire->setRepondu ( $_POST ['fieldRepondu'] );
					$aAnnuaire->setPresence ( $_POST ['fieldPresent'] );
					$aAnnuaire->setRepas ( $_POST ['fieldPresentRepas'] );
					$aAnnuaire->setTaxi ( $_POST ['fieldTaxi'] );
					$aAnnuaire->setDiner ( $_POST ['fieldDiner'] );

					$aAnnuaire->SQL_update ();

					// LOG USER HISTORY
					$daoUserHistory = new UserHistoryDAO ();
					$userLog = new UserHistory ();
					$userLog->setDescription ( 'Modification Fiche Individu' );
					$userLog->setUserId ( $_GET ['id'] );
					$userLog->setActionRealiseePar ( 'Gestionnaire' );
					$daoUserHistory->create ( $userLog );

					if (isset ( $_POST ['Save'] )) {
						$this->redirection ( '?action=edit&id=' . $_GET ['id'] );
					}
					if (isset ( $_POST ['SaveAndQuit'] )) {
						$this->redirection ( '?id=' . $aAnnuaire->getConventionID () );
					}
				} else {
					if (isset ( $_GET ['id'] )) {
						$aAnnuaire = new Annuaire ();
						$aAnnuaire->SQL_select ( $_GET ['id'] );

						$aList = new AnnuaireList ();
						$dr = $aList->SQL_SELECT_ALL_DirectionRegionale ();

						$aAnnuaireView = new AnnuaireView ( $aAnnuaire, $dr );
						$aAnnuaireView->renderHTML ( 'edit' );
					}
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$this->redirection ( '?id=' . $this->delete ( $_GET ['id'] ) );
				}
				break;
			case 'deleteAll' :
				if (isset ( $_GET ['id'] )) {
					$aAnnuaire = new Annuaire ();
					$aAnnuaire->SQL_deleteAll ( $_GET ['id'] );
					$this->redirection ( '?id=' . $_GET ['id'] );
				}
				break;

			/*
			 * ##############################################################
			 * ##############################################################
			 */
			// ATTENTION ACTION
			case 'EnvoiInvitation' :
				if (isset ( $_GET ['id'] )) {
					$aAnnuaireList = new AnnuaireList ();
					// $aAnnuaireList->SQL_SELECT_ALL_WITHOUT_GUEST($_GET['id']);
					$aAnnuaireList->SQL_SELECT_ALL ( $_GET ['id'] );

					$aConventionHistorique = new ConventionHistorique ();
					$aConventionHistorique->setConventionID ( $_GET ['id'] );
					$aConventionHistorique->setDescription ( "Envoi des invitations" );
					$aConventionHistorique->SQL_CREATE ();

					if (count ( $aAnnuaireList->getList () ) > 0) {
						include ('../../../commun/metier/modele/NotificationMail.class.php');

						$aParamFROM_1 = new Parametre ();
						$aParamFROM_1->SQL_select_by_name ( "MAIL_1_FROM" );
						$aParamSUBJET_1 = new Parametre ();
						$aParamSUBJET_1->SQL_select_by_name ( "MAIL_1_SUBJECT" );
						$aParamHEADER_1 = new Parametre ();
						$aParamHEADER_1->SQL_select_by_name ( "MAIL_1_HEADER" );
						$aParamFOOTER_1 = new Parametre ();
						$aParamFOOTER_1->SQL_select_by_name ( "MAIL_1_FOOTER" );

						$aParamFROM_2 = new Parametre ();
						$aParamFROM_2->SQL_select_by_name ( "MAIL_2_FROM" );
						$aParamSUBJET_2 = new Parametre ();
						$aParamSUBJET_2->SQL_select_by_name ( "MAIL_2_SUBJECT" );
						$aParamHEADER_2 = new Parametre ();
						$aParamHEADER_2->SQL_select_by_name ( "MAIL_2_HEADER" );
						$aParamFOOTER_2 = new Parametre ();
						$aParamFOOTER_2->SQL_select_by_name ( "MAIL_2_FOOTER" );

						foreach ( $aAnnuaireList->getList () as $aAnnuaire ) {

							$aMail = new NotificationMail ();

							if ($aAnnuaire->getTypeInscription () == 0) {
								$msg = '';
								$aMail->setFrom ( $aParamFROM_1->getValeur () );
								$aMail->setTo ( $aAnnuaire->getMail () );
								$aMail->setSubject ( stripslashes ( $aParamSUBJET_1->getValeur () ) );

								// $msg = '<img src="http://www.gcrfrance.com/convention/web/images/bandeau_convention_gcr.jpg" border="0"><br><br>';
								// $msg .= 'Bonjour '.$aAnnuaire->getPrenom().' '. $aAnnuaire->getNom().',<br><br>';
								$msg .= stripslashes ( $aParamHEADER_1->getValeur () );

								// $msg .= '<b>Nom d\'utilisateur</b> : '.stripslashes($aAnnuaire->getLogin()).'<br>';
								// $msg .= '<b>Mot de passe</b> : '.stripslashes($aAnnuaire->getPassword()).'<br>';
								$msg .= stripslashes ( $aParamFOOTER_1->getValeur () );
								$msg = str_replace ( '{Nom}', $aAnnuaire->getNom (), $msg );
								$msg = str_replace ( '{Prenom}', $aAnnuaire->getPrenom (), $msg );
								$msg = str_replace ( '{Login}', $aAnnuaire->getLogin (), $msg );
								$msg = str_replace ( '{Mdp}', $aAnnuaire->getPassword (), $msg );
								$msg = str_replace ( '{Civ}', $aAnnuaire->getStringCivilite (), $msg );
								$msg = str_replace ( '{Cher}', $aAnnuaire->getStringCher (), $msg );
								$msg = str_replace ( '{Pres_Repas}', ($aAnnuaire->getRepas () == '0' ? 'Non' : 'Oui'), $msg );
								$msg = str_replace ( '{Pres_Conv}', ($aAnnuaire->getPresence () == '0' ? 'Non' : 'Oui'), $msg );
								if ($aAnnuaire->getTaxi () == '0')
									$taxi = 'Place de parking : <b>Non</b>';
								else if ($aAnnuaire->getTaxi () == '1')
									$taxi = 'Place de parking : <b>Oui</b>';
								else
									$taxi = '';
								$msg = str_replace ( '{Taxi}', $taxi, $msg );

								if ($aAnnuaire->getDiner () == '0')
									$diner = 'Présence au dîner : <b>Non</b>';
								else if ($aAnnuaire->getDiner () == '1')
									$diner = 'Présence au dîner : <b>Oui</b>';
								else
									$diner = '';
								$msg = str_replace ( '{Diner}', $diner, $msg );
								$msg = str_replace ( '/userfiles/', 'http://www.' . $_SERVER ['HTTP_HOST'] . '/userfiles/', $msg );
								$msg = str_replace ( '{AutoLogin}', '?login=' . utf8_encode ( $aAnnuaire->getLogin () ) . '&pwd=' . utf8_encode ( $aAnnuaire->getPassword () ), $msg );

								// $msg .= '<br><img src="http://www.gcrfrance.com/convention/web/images/logoGCRpetit.gif" border="0"><br>';

								$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $msg ) . '</body></html>' );
								// $aMail->setMessage('<html><body style="font-family:arial;">'.$msg.'</body></html>');
								$aMail->setHeaderReplyTo ( $aParamFROM_1->getValeur () );
							} else {
								$msg = '';
								$aMail->setFrom ( $aParamFROM_2->getValeur () );
								$aMail->setTo ( $aAnnuaire->getMail () );
								$aMail->setSubject ( stripslashes ( $aParamSUBJET_2->getValeur () ) );

								// $msg = '<img src="http://www.gcrfrance.com/convention/web/images/bandeau_convention_gcr.jpg" border="0"><br><br>';
								// $msg .= 'Bonjour '.$aAnnuaire->getPrenom().' '. $aAnnuaire->getNom().',<br><br>';
								$msg .= stripslashes ( $aParamHEADER_2->getValeur () );

								// $msg .= '<b>Nom d\'utilisateur</b> : '.$aAnnuaire->getLogin().'<br>';
								// $msg .= '<b>Mot de passe</b> : '.$aAnnuaire->getPassword().'<br>';
								$msg .= stripslashes ( $aParamFOOTER_2->getValeur () );
								$msg = str_replace ( '{Nom}', $aAnnuaire->getNom (), $msg );
								$msg = str_replace ( '{Prenom}', $aAnnuaire->getPrenom (), $msg );
								$msg = str_replace ( '{Login}', $aAnnuaire->getLogin (), $msg );
								$msg = str_replace ( '{Mdp}', $aAnnuaire->getPassword (), $msg );
								$msg = str_replace ( '{Civ}', $aAnnuaire->getStringCivilite (), $msg );
								$msg = str_replace ( '{Cher}', $aAnnuaire->getStringCher (), $msg );
								$msg = str_replace ( '{Pres_Repas}', ($aAnnuaire->getRepas () == '0' ? 'Non' : 'Oui'), $msg );
								$msg = str_replace ( '{Pres_Conv}', ($aAnnuaire->getPresence () == '0' ? 'Non' : 'Oui'), $msg );
								if ($aAnnuaire->getTaxi () == '0')
									$taxi = 'Place de parking : <b>Non</b>';
								else if ($aAnnuaire->getTaxi () == '1')
									$taxi = 'Place de parking : <b>Oui</b>';
								else
									$taxi = '';
								$msg = str_replace ( '{Taxi}', $taxi, $msg );

								if ($aAnnuaire->getDiner () == '0')
									$diner = 'Présence au dîner : <b>Non</b>';
								else if ($aAnnuaire->getDiner () == '1')
									$diner = 'Présence au dîner : <b>Oui</b>';
								else
									$diner = '';
								$msg = str_replace ( '{Diner}', $diner, $msg );

								$msg = str_replace ( '/userfiles/', 'http://www.' . $_SERVER ['HTTP_HOST'] . '/userfiles/', $msg );
								$msg = str_replace ( '{AutoLogin}', '?login=' . utf8_encode ( $aAnnuaire->getLogin () ) . '&pwd=' . utf8_encode ( $aAnnuaire->getPassword () ), $msg );

								// $msg .= '<br><img src="http://www.gcrfrance.com/convention/web/images/logoGCRpetit.gif" border="0"><br>';

								$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $msg ) . '</body></html>' );
								// $aMail->setMessage('<html><body style="font-family:arial;">'.stripslashes($msg).'</body></html>');
								$aMail->setHeaderReplyTo ( $aParamFROM_2->getValeur () );
							}
							$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
							$aMail->setHeaderContentTransferEncoding ( '8bit' );

							if (! $aMail->send ()) {
								$this->message ( 'Message en Erreur' );
								// $this->redirection('?id='.$_GET['id']);
							} else {
								// LOG USER HISTORY
								$daoUserHistory = new UserHistoryDAO ();
								$userLog = new UserHistory ();
								$userLog->setDescription ( 'Notification Invitation' );
								$userLog->setUserId ( $aAnnuaire->getID () );
								$userLog->setActionRealiseePar ( 'Gestionnaire' );
								$daoUserHistory->create ( $userLog );
							}
						}
						$this->message ( 'Messages Envoyés' );
					} else {
						$this->message ( 'Annuaire vide !!!' );
					}

					$this->redirection ( '?id=' . $_GET ['id'] );
				} else {
					echo 'erreur';
				}
				break;
			case 'EnvoiRelanceSatisfaction' :
			case 'EnvoiSatisfaction' :
				if (isset ( $_GET ['id'] )) {
					$aAnnuaireList = new AnnuaireList ();
					// $aAnnuaireList->SQL_SELECT_ALL_SATISFACTION_WITHOUT_GUEST($_GET['id']);
					$aAnnuaireList->SQL_SELECT_ALL_SATISFACTION ( $_GET ['id'] );
					// $aAnnuaireList->SQL_SELECT_ALL_REPONDU($_GET['id']);

					$aConventionHistorique = new ConventionHistorique ();
					$aConventionHistorique->setConventionID ( $_GET ['id'] );
					$aConventionHistorique->setDescription ( "Envoi Satisfaction" );
					$aConventionHistorique->SQL_CREATE ();

					if (count ( $aAnnuaireList->getList () ) > 0) {
						include ('../../../commun/metier/modele/NotificationMail.class.php');

						if ($_GET ['action'] == "EnvoiRelanceSatisfaction") {
							$aParamFROM = new Parametre ();
							$aParamFROM->SQL_select_by_name ( "MAIL_10_FROM" );
							$aParamSUBJET = new Parametre ();
							$aParamSUBJET->SQL_select_by_name ( "MAIL_10_SUBJECT" );
							$aParamHEADER = new Parametre ();
							$aParamHEADER->SQL_select_by_name ( "MAIL_10_HEADER" );
							$aParamFOOTER = new Parametre ();
							$aParamFOOTER->SQL_select_by_name ( "MAIL_10_FOOTER" );
						} else {
							$aParamFROM = new Parametre ();
							$aParamFROM->SQL_select_by_name ( "MAIL_6_FROM" );
							$aParamSUBJET = new Parametre ();
							$aParamSUBJET->SQL_select_by_name ( "MAIL_6_SUBJECT" );
							$aParamHEADER = new Parametre ();
							$aParamHEADER->SQL_select_by_name ( "MAIL_6_HEADER" );
							$aParamFOOTER = new Parametre ();
							$aParamFOOTER->SQL_select_by_name ( "MAIL_6_FOOTER" );
						}

						foreach ( $aAnnuaireList->getList () as $aAnnuaire ) {
							$aMail = new NotificationMail ();
							$aMail->setFrom ( $aParamFROM->getValeur () );
							$aMail->setTo ( $aAnnuaire->getMail () );
							$aMail->setSubject ( stripslashes ( $aParamSUBJET->getValeur () ) );

							$msg = '';
							// $msg = '<img src="http://www.gcrfrance.com/convention/web/images/bandeau_convention_gcr.jpg" border="0"><br><br>';
							// $msg .= 'Bonjour '.$aAnnuaire->getPrenom().' '. $aAnnuaire->getNom().',<br><br>';
							$msg .= stripslashes ( $aParamHEADER->getValeur () );

							// $msg .= '<b>Nom d\'utilisateur</b> : '.stripslashes($aAnnuaire->getLogin()).'<br>';
							// $msg .= '<b>Mot de passe</b> : '.stripslashes($aAnnuaire->getPassword()).'<br>';
							$msg .= stripslashes ( $aParamFOOTER->getValeur () );
							$msg = str_replace ( '{Nom}', $aAnnuaire->getNom (), $msg );
							$msg = str_replace ( '{Prenom}', $aAnnuaire->getPrenom (), $msg );
							$msg = str_replace ( '{Login}', $aAnnuaire->getLogin (), $msg );
							$msg = str_replace ( '{Mdp}', $aAnnuaire->getPassword (), $msg );
							$msg = str_replace ( '{Civ}', $aAnnuaire->getStringCivilite (), $msg );
							$msg = str_replace ( '{Cher}', $aAnnuaire->getStringCher (), $msg );
							$msg = str_replace ( '{Pres_Repas}', ($aAnnuaire->getRepas () == '0' ? 'Non' : 'Oui'), $msg );
							$msg = str_replace ( '{Pres_Conv}', ($aAnnuaire->getPresence () == '0' ? 'Non' : 'Oui'), $msg );
							if ($aAnnuaire->getTaxi () == '0')
								$taxi = 'Place de parking : <b>Non</b>';
							else if ($aAnnuaire->getTaxi () == '1')
								$taxi = 'Place de parking : <b>Oui</b>';
							else
								$taxi = '';
							$msg = str_replace ( '{Taxi}', $taxi, $msg );

							if ($aAnnuaire->getDiner () == '0')
								$diner = 'Présence au dîner : <b>Non</b>';
							else if ($aAnnuaire->getDiner () == '1')
								$diner = 'Présence au dîner : <b>Oui</b>';
							else
								$diner = '';
							$msg = str_replace ( '{Diner}', $diner, $msg );

							$msg = str_replace ( '/userfiles/', 'http://www.' . $_SERVER ['HTTP_HOST'] . '/userfiles/', $msg );
							$msg = str_replace ( '{AutoLogin}', '?login=' . utf8_encode ( $aAnnuaire->getLogin () ) . '&pwd=' . utf8_encode ( $aAnnuaire->getPassword () ), $msg );

							// $msg .= '<br><img src="http://www.gcrfrance.com/convention/web/images/logoGCRpetit.gif" border="0"><br>';
							$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $msg ) . '</body></html>' );
							// $aMail->setMessage('<html><body style="font-family:arial;">'.stripslashes($msg).'</body></html>');
							$aMail->setHeaderReplyTo ( $aParamFROM->getValeur () );
							$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
							$aMail->setHeaderContentTransferEncoding ( '8bit' );

							if (! $aMail->send ()) {
								$this->message ( 'Message en Erreur' );
								$this->redirection ( '?id=' . $_GET ['id'] );
							}
						}
						$this->message ( 'Messages Envoyés' );
					} else {
						$this->message ( 'Annuaire vide !!!' );
					}

					$this->redirection ( '?id=' . $_GET ['id'] );
				} else {
					echo 'erreur';
				}
				break;
			case 'EnvoiRelance' :
				if (isset ( $_GET ['id'] )) {
					$aAnnuaireList = new AnnuaireList ();
					// $aAnnuaireList->SQL_SELECT_ALL_RELANCE_WITHOUT_GUEST($_GET['id']);
					$aAnnuaireList->SQL_SELECT_ALL_RELANCE ( $_GET ['id'] );

					$aConventionHistorique = new ConventionHistorique ();
					$aConventionHistorique->setConventionID ( $_GET ['id'] );
					$aConventionHistorique->setDescription ( "Envoi des relances" );
					$aConventionHistorique->SQL_CREATE ();

					if (count ( $aAnnuaireList->getList () ) > 0) {
						include ('../../../commun/metier/modele/NotificationMail.class.php');

						$aParamFROM = new Parametre ();
						$aParamFROM->SQL_select_by_name ( "MAIL_3_FROM" );
						$aParamSUBJET = new Parametre ();
						$aParamSUBJET->SQL_select_by_name ( "MAIL_3_SUBJECT" );
						$aParamHEADER = new Parametre ();
						$aParamHEADER->SQL_select_by_name ( "MAIL_3_HEADER" );
						$aParamFOOTER = new Parametre ();
						$aParamFOOTER->SQL_select_by_name ( "MAIL_3_FOOTER" );

						foreach ( $aAnnuaireList->getList () as $aAnnuaire ) {
							$aMail = new NotificationMail ();
							$aMail->setFrom ( $aParamFROM->getValeur () );
							$aMail->setTo ( $aAnnuaire->getMail () );
							$aMail->setSubject ( stripslashes ( $aParamSUBJET->getValeur () ) );

							$msg = '';
							// $msg = '<img src="http://www.gcrfrance.com/convention/web/images/bandeau_convention_gcr.jpg" border="0"><br><br>';
							// $msg .= 'Bonjour '.$aAnnuaire->getPrenom().' '. $aAnnuaire->getNom().',<br><br>';
							$msg .= stripslashes ( $aParamHEADER->getValeur () );

							// $msg .= '<b>Nom d\'utilisateur</b> : '.stripslashes($aAnnuaire->getLogin()).'<br>';
							// $msg .= '<b>Mot de passe</b> : '.stripslashes($aAnnuaire->getPassword()).'<br>';
							$msg .= stripslashes ( $aParamFOOTER->getValeur () );
							$msg = str_replace ( '{Nom}', $aAnnuaire->getNom (), $msg );
							$msg = str_replace ( '{Prenom}', $aAnnuaire->getPrenom (), $msg );
							$msg = str_replace ( '{Login}', $aAnnuaire->getLogin (), $msg );
							$msg = str_replace ( '{Mdp}', $aAnnuaire->getPassword (), $msg );
							$msg = str_replace ( '{Civ}', $aAnnuaire->getStringCivilite (), $msg );
							$msg = str_replace ( '{Cher}', $aAnnuaire->getStringCher (), $msg );
							$msg = str_replace ( '{Pres_Repas}', ($aAnnuaire->getRepas () == '0' ? 'Non' : 'Oui'), $msg );
							$msg = str_replace ( '{Pres_Conv}', ($aAnnuaire->getPresence () == '0' ? 'Non' : 'Oui'), $msg );
							if ($aAnnuaire->getTaxi () == '0')
								$taxi = 'Place de parking : <b>Non</b>';
							else if ($aAnnuaire->getTaxi () == '1')
								$taxi = 'Place de parking : <b>Oui</b>';
							else
								$taxi = '';
							$msg = str_replace ( '{Taxi}', $taxi, $msg );

							if ($aAnnuaire->getDiner () == '0')
								$diner = 'Présence au dîner : <b>Non</b>';
							else if ($aAnnuaire->getDiner () == '1')
								$diner = 'Présence au dîner : <b>Oui</b>';
							else
								$diner = '';
							$msg = str_replace ( '{Diner}', $diner, $msg );

							$msg = str_replace ( '/userfiles/', 'http://www.' . $_SERVER ['HTTP_HOST'] . '/userfiles/', $msg );
							$msg = str_replace ( '{AutoLogin}', '?login=' . utf8_encode ( $aAnnuaire->getLogin () ) . '&pwd=' . utf8_encode ( $aAnnuaire->getPassword () ), $msg );

							// $msg .= '<br><img src="http://www.gcrfrance.com/convention/web/images/logoGCRpetit.gif" border="0"><br>';

							$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $msg ) . '</body></html>' );
							// $aMail->setMessage('<html><body style="font-family:arial;">'.stripslashes($msg).'</body></html>');
							$aMail->setHeaderReplyTo ( $aParamFROM->getValeur () );
							$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
							$aMail->setHeaderContentTransferEncoding ( '8bit' );

							if (! $aMail->send ()) {
								$this->message ( 'Message en Erreur' );
								$this->redirection ( '?id=' . $_GET ['id'] );
							} else {
								// LOG USER HISTORY
								$daoUserHistory = new UserHistoryDAO ();
								$userLog = new UserHistory ();
								$userLog->setDescription ( 'Notification Relance' );
								$userLog->setUserId ( $aAnnuaire->getID () );
								$userLog->setActionRealiseePar ( 'Gestionnaire' );
								$daoUserHistory->create ( $userLog );
							}
						}
						$this->message ( 'Messages Envoyés' );
					} else {
						$this->message ( 'Annuaire vide !!!' );
					}

					$this->redirection ( '?id=' . $_GET ['id'] );
				} else {
					echo 'erreur';
				}
				break;
		}
	}

	/*
	 * Fonction qui supprime quelqu'un de l'annuaire et retourne id de l'annuaire ou l'on vient de supprimer la personne
	 *
	 */
	private function delete($id) {
		$aAnnuaire = new Annuaire ();
		$aAnnuaire->SQL_select ( $id );
		$i = $aAnnuaire->getConventionID ();
		$aAnnuaire->SQL_delete ();
		return $i;
	}
	private function sendRegistration($id) {
		include_once ('../../../commun/metier/modele/NotificationMail.class.php');

		$aAnnuaire = new Annuaire ();
		$aAnnuaire->SQL_select ( $id );

		if ($aAnnuaire->getTypeInscription () == 0) {
			$aParamFROM = new Parametre ();
			$aParamFROM->SQL_select_by_name ( "MAIL_1_FROM" );
			$aParamSUBJET = new Parametre ();
			$aParamSUBJET->SQL_select_by_name ( "MAIL_1_SUBJECT" );
			$aParamHEADER = new Parametre ();
			$aParamHEADER->SQL_select_by_name ( "MAIL_1_HEADER" );
			$aParamFOOTER = new Parametre ();
			$aParamFOOTER->SQL_select_by_name ( "MAIL_1_FOOTER" );
		} else {
			$aParamFROM = new Parametre ();
			$aParamFROM->SQL_select_by_name ( "MAIL_2_FROM" );
			$aParamSUBJET = new Parametre ();
			$aParamSUBJET->SQL_select_by_name ( "MAIL_2_SUBJECT" );
			$aParamHEADER = new Parametre ();
			$aParamHEADER->SQL_select_by_name ( "MAIL_2_HEADER" );
			$aParamFOOTER = new Parametre ();
			$aParamFOOTER->SQL_select_by_name ( "MAIL_2_FOOTER" );
		}

		$aMail = new NotificationMail ();
		$aMail->setFrom ( $aParamFROM->getValeur () );
		$aMail->setTo ( $aAnnuaire->getMail () );
		$aMail->setSubject ( stripslashes ( $aParamSUBJET->getValeur () ) );

		$msg = '';
		// $msg = '<img src="http://www.gcrfrance.com/convention/web/images/bandeau_convention_gcr.jpg" border="0"><br><br>';
		// $msg .= 'Bonjour '.$aAnnuaire->getPrenom().' '. $aAnnuaire->getNom().',<br><br>';
		$msg .= stripslashes ( $aParamHEADER->getValeur () );
		// $msg .= '<b>Nom d\'utilisateur</b> : '.stripslashes($aAnnuaire->getLogin()).'<br/>';
		// $msg .= '<b>Mot de passe</b> : '.stripslashes($aAnnuaire->getPassword()).'<br/>';
		$msg .= stripslashes ( $aParamFOOTER->getValeur () );
		$msg = str_replace ( '{Nom}', $aAnnuaire->getNom (), $msg );
		$msg = str_replace ( '{Prenom}', $aAnnuaire->getPrenom (), $msg );
		$msg = str_replace ( '{Login}', $aAnnuaire->getLogin (), $msg );
		$msg = str_replace ( '{Mdp}', $aAnnuaire->getPassword (), $msg );
		$msg = str_replace ( '{Civ}', $aAnnuaire->getStringCivilite (), $msg );
		$msg = str_replace ( '{Cher}', $aAnnuaire->getStringCher (), $msg );
		$msg = str_replace ( '{Pres_Repas}', ($aAnnuaire->getRepas () == '0' ? 'Non' : 'Oui'), $msg );
		$msg = str_replace ( '{Pres_Conv}', ($aAnnuaire->getPresence () == '0' ? 'Non' : 'Oui'), $msg );
		if ($aAnnuaire->getTaxi () == '0')
			$taxi = 'Place de parking : <b>Non</b>';
		else if ($aAnnuaire->getTaxi () == '1')
			$taxi = 'Place de parking : <b>Oui</b>';
		else
			$taxi = '';
		$msg = str_replace ( '{Taxi}', $taxi, $msg );

		if ($aAnnuaire->getDiner () == '0')
			$diner = 'Présence au dîner : <b>Non</b>';
		else if ($aAnnuaire->getDiner () == '1')
			$diner = 'Présence au dîner : <b>Oui</b>';
		else
			$diner = '';
		$msg = str_replace ( '{Diner}', $diner, $msg );

		$msg = str_replace ( '/userfiles/', 'http://www.' . $_SERVER ['HTTP_HOST'] . '/userfiles/', $msg );
		$msg = str_replace ( '{AutoLogin}', '?login=' . utf8_encode ( $aAnnuaire->getLogin () ) . '&pwd=' . utf8_encode ( $aAnnuaire->getPassword () ), $msg );

		// $msg .= '<br><img src="http://www.gcrfrance.com/convention/web/images/logoGCRpetit.gif" border="0"><br>';

		$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $msg ) . '</body></html>' );
		// $aMail->setMessage('<html><body style="font-family:arial;">'.stripslashes($msg).'</body></html>');
		$aMail->setHeaderReplyTo ( $aParamFROM->getValeur () );
		$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
		$aMail->setHeaderContentTransferEncoding ( '8bit' );

		$aConventionHistorique = new ConventionHistorique ();
		$aConventionHistorique->setConventionID ( $aAnnuaire->getConventionID () );
		$aConventionHistorique->setDescription ( "Notification Invitation à " . $aAnnuaire->getNom () . " " . $aAnnuaire->getPrenom () );
		$aConventionHistorique->SQL_CREATE ();

		// LOG USER HISTORY
		$daoUserHistory = new UserHistoryDAO ();
		$userLog = new UserHistory ();
		$userLog->setDescription ( 'Notification Invitation' );
		$userLog->setUserId ( $id );
		$userLog->setActionRealiseePar ( 'Gestionnaire' );
		$daoUserHistory->create ( $userLog );

		// Si envoit de mail ok, on retourne id de l'annuaire ,sinon on retourne false
		if ($aMail->send ()) {
			Return $aAnnuaire->getID ();
		} else {
			Return False;
		}
	}
	private function sendReminderRegistration($id) {
		include_once ('../../../commun/metier/modele/NotificationMail.class.php');

		$aAnnuaire = new Annuaire ();
		$aAnnuaire->SQL_select ( $id );

		$aParamFROM = new Parametre ();
		$aParamFROM->SQL_select_by_name ( "MAIL_3_FROM" );
		$aParamSUBJET = new Parametre ();
		$aParamSUBJET->SQL_select_by_name ( "MAIL_3_SUBJECT" );
		$aParamHEADER = new Parametre ();
		$aParamHEADER->SQL_select_by_name ( "MAIL_3_HEADER" );
		$aParamFOOTER = new Parametre ();
		$aParamFOOTER->SQL_select_by_name ( "MAIL_3_FOOTER" );

		$aMail = new NotificationMail ();
		$aMail->setFrom ( $aParamFROM->getValeur () );
		$aMail->setTo ( $aAnnuaire->getMail () );
		$aMail->setSubject ( stripslashes ( $aParamSUBJET->getValeur () ) );

		$msg = '';
		// $msg = '<img src="http://www.gcrfrance.com/convention/web/images/bandeau_convention_gcr.jpg" border="0"><br><br>';
		// $msg .= 'Bonjour '.$aAnnuaire->getPrenom().' '. $aAnnuaire->getNom().',<br><br>';
		$msg .= stripslashes ( $aParamHEADER->getValeur () );
		// $msg .= '<b>Nom d\'utilisateur</b> : '.stripslashes($aAnnuaire->getLogin()).'<br/>';
		// $msg .= '<b>Mot de passe</b> : '.stripslashes($aAnnuaire->getPassword()).'<br/>';
		$msg .= stripslashes ( $aParamFOOTER->getValeur () );
		$msg = str_replace ( '{Nom}', $aAnnuaire->getNom (), $msg );
		$msg = str_replace ( '{Prenom}', $aAnnuaire->getPrenom (), $msg );
		$msg = str_replace ( '{Login}', $aAnnuaire->getLogin (), $msg );
		$msg = str_replace ( '{Mdp}', $aAnnuaire->getPassword (), $msg );
		$msg = str_replace ( '{Civ}', $aAnnuaire->getStringCivilite (), $msg );
		$msg = str_replace ( '{Cher}', $aAnnuaire->getStringCher (), $msg );
		$msg = str_replace ( '{Pres_Repas}', ($aAnnuaire->getRepas () == '0' ? 'Non' : 'Oui'), $msg );
		$msg = str_replace ( '{Pres_Conv}', ($aAnnuaire->getPresence () == '0' ? 'Non' : 'Oui'), $msg );

		if ($aAnnuaire->getTaxi () == '0')
			$taxi = 'Place de parking : <b>Non</b>';
		else if ($aAnnuaire->getTaxi () == '1')
			$taxi = 'Place de parking : <b>Oui</b>';
		else
			$taxi = '';
		$msg = str_replace ( '{Taxi}', $taxi, $msg );

		if ($aAnnuaire->getDiner () == '0')
			$diner = 'Présence au dîner : <b>Non</b>';
		else if ($aAnnuaire->getDiner () == '1')
			$diner = 'Présence au dîner : <b>Oui</b>';
		else
			$diner = '';
		$msg = str_replace ( '{Diner}', $diner, $msg );

		$msg = str_replace ( '/userfiles/', 'http://www.' . $_SERVER ['HTTP_HOST'] . '/userfiles/', $msg );
		$msg = str_replace ( '{AutoLogin}', '?login=' . utf8_encode ( $aAnnuaire->getLogin () ) . '&pwd=' . utf8_encode ( $aAnnuaire->getPassword () ), $msg );

		// $msg .= '<br><img src="http://www.gcrfrance.com/convention/web/images/logoGCRpetit.gif" border="0"><br>';

		$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $msg ) . '</body></html>' );
		// $aMail->setMessage('<html><body style="font-family:arial;">'.stripslashes($msg).'</body></html>');
		$aMail->setHeaderReplyTo ( $aParamFROM->getValeur () );
		$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
		$aMail->setHeaderContentTransferEncoding ( '8bit' );

		$aConventionHistorique = new ConventionHistorique ();
		$aConventionHistorique->setConventionID ( $aAnnuaire->getConventionID () );
		$aConventionHistorique->setDescription ( "Notification Relance à " . $aAnnuaire->getNom () . " " . $aAnnuaire->getPrenom () );
		$aConventionHistorique->SQL_CREATE ();

		// LOG USER HISTORY
		$daoUserHistory = new UserHistoryDAO ();
		$userLog = new UserHistory ();
		$userLog->setDescription ( 'Notification Relance' );
		$userLog->setUserId ( $id );
		$userLog->setActionRealiseePar ( 'Gestionnaire' );
		$daoUserHistory->create ( $userLog );

		// Si envoit de mail ok, on retourne id de l'annuaire ,sinon on retourne false
		if ($aMail->send ()) {
			Return $aAnnuaire->getID ();
		} else {
			Return False;
		}
	}
	private function sendId($id) {
		include_once ('../../../commun/metier/modele/NotificationMail.class.php');
		$aParamFROM = new Parametre ();
		// $aParamFROM->SQL_select_by_name("MAIL_1_FROM");

		$aParamFROM = new Parametre ();
		$aParamFROM->SQL_select_by_name ( "MAIL_9_FROM" );
		$aParamSUBJET = new Parametre ();
		$aParamSUBJET->SQL_select_by_name ( "MAIL_9_SUBJECT" );
		$aParamHEADER = new Parametre ();
		$aParamHEADER->SQL_select_by_name ( "MAIL_9_HEADER" );
		$aParamFOOTER = new Parametre ();
		$aParamFOOTER->SQL_select_by_name ( "MAIL_9_FOOTER" );

		$aAnnuaire = new Annuaire ();
		$aAnnuaire->SQL_select ( $id );

		$aMail = new NotificationMail ();
		$aMail->setFrom ( $aParamFROM->getValeur () );
		$aMail->setTo ( $aAnnuaire->getMail () );
		// $aMail->setSubject('Notification Identifiants');
		$aMail->setSubject ( stripslashes ( $aParamSUBJET->getValeur () ) );

		// $msg = '<html><body style="font-family:arial;">';
		// $msg .= '<img src="http://www.gcrfrance.com/convention/web/images/bandeau_convention_gcr.jpg" border="0"><br><br>';
		// $msg .= 'Bonjour '.$aAnnuaire->getPrenom().' '. $aAnnuaire->getNom().',<br><br>';
		// $msg .= 'Voici vos identifiants pour vous connecter au site Convention du G.C.R. <a href="http://www.gcrfrance.com/convention">http://www.gcrfrance.com/convention</a> :<br><br>';
		// $msg .= '<b>Nom d\'utilisateur</b> : '.stripslashes($aAnnuaire->getLogin()).'<br>';
		// $msg .= '<b>Mot de passe</b> : '.stripslashes($aAnnuaire->getPassword()).'<br><br>';
		// $msg .= '-----------------------------------------------------------------------<br>';
		// $msg .= 'Cordialement<br/>Le Groupement des Concessionnaires Renault<br>';
		// $msg .= '<br><img src="http://www.gcrfrance.com/convention/web/images/logoGCRpetit.gif" border="0"><br>';
		// $msg .= '</body></html>';

		$msg = '';
		// $msg = '<img src="http://www.gcrfrance.com/convention/web/images/bandeau_convention_gcr.jpg" border="0"><br><br>';
		// $msg .= 'Bonjour '.$aAnnuaire->getPrenom().' '. $aAnnuaire->getNom().',<br><br>';
		$msg .= stripslashes ( $aParamHEADER->getValeur () );
		// $msg .= '<b>Nom d\'utilisateur</b> : '.stripslashes($aAnnuaire->getLogin()).'<br/>';
		// $msg .= '<b>Mot de passe</b> : '.stripslashes($aAnnuaire->getPassword()).'<br/>';
		$msg .= stripslashes ( $aParamFOOTER->getValeur () );
		$msg = str_replace ( '{Nom}', $aAnnuaire->getNom (), $msg );
		$msg = str_replace ( '{Prenom}', $aAnnuaire->getPrenom (), $msg );
		$msg = str_replace ( '{Login}', $aAnnuaire->getLogin (), $msg );
		$msg = str_replace ( '{Mdp}', $aAnnuaire->getPassword (), $msg );
		$msg = str_replace ( '{Civ}', $aAnnuaire->getStringCivilite (), $msg );
		$msg = str_replace ( '{Cher}', $aAnnuaire->getStringCher (), $msg );
		$msg = str_replace ( '{Pres_Repas}', ($aAnnuaire->getRepas () == '0' ? 'Non' : 'Oui'), $msg );
		$msg = str_replace ( '{Pres_Conv}', ($aAnnuaire->getPresence () == '0' ? 'Non' : 'Oui'), $msg );
		if ($aAnnuaire->getTaxi () == '0')
			$taxi = 'Place de parking : <b>Non</b>';
		else if ($aAnnuaire->getTaxi () == '1')
			$taxi = 'Place de parking : <b>Oui</b>';
		else
			$taxi = '';
		$msg = str_replace ( '{Taxi}', $taxi, $msg );

		if ($aAnnuaire->getDiner () == '0')
			$diner = 'Présence au dîner : <b>Non</b>';
		else if ($aAnnuaire->getDiner () == '1')
			$diner = 'Présence au dîner : <b>Oui</b>';
		else
			$diner = '';
		$msg = str_replace ( '{Diner}', $diner, $msg );

		$msg = str_replace ( '/userfiles/', 'http://www.' . $_SERVER ['HTTP_HOST'] . '/userfiles/', $msg );
		$msg = str_replace ( '{AutoLogin}', '?login=' . utf8_encode ( $aAnnuaire->getLogin () ) . '&pwd=' . utf8_encode ( $aAnnuaire->getPassword () ), $msg );

		$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $msg ) . '</body></html>' );
		$aMail->setMessage ( stripslashes ( $msg ) );
		$aMail->setHeaderReplyTo ( $aParamFROM->getValeur () );
		$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
		$aMail->setHeaderContentTransferEncoding ( '8bit' );

		// LOG Convention HISTORY
		$aConventionHistorique = new ConventionHistorique ();
		$aConventionHistorique->setConventionID ( $aAnnuaire->getConventionID () );
		$aConventionHistorique->setDescription ( "Notification Indentifiants à " . $aAnnuaire->getNom () . " " . $aAnnuaire->getPrenom () );
		$aConventionHistorique->SQL_CREATE ();

		// LOG USER HISTORY
		$daoUserHistory = new UserHistoryDAO ();
		$userLog = new UserHistory ();
		$userLog->setDescription ( 'Notification Indentifiants' );
		$userLog->setUserId ( $id );
		$userLog->setActionRealiseePar ( 'Gestionnaire' );
		$daoUserHistory->create ( $userLog );

		// Si envoit de mail ok, on retourne id de l'annuaire ,sinon on retourne false
		if ($aMail->send ()) {
			Return $aAnnuaire->getID ();
		} else {
			Return False;
		}
	}
	private function sendSatisfaction($id) {
		include_once ('../../../commun/metier/modele/NotificationMail.class.php');

		$aAnnuaire = new Annuaire ();
		$aAnnuaire->SQL_select ( $id );

		// on ne tient pas compte des types 1 (directeur général) et 2 (directeur de concession)
		if ($aAnnuaire->getAnnuaireTypeID () != 1 && $aAnnuaire->getAnnuaireTypeID () != 2) {
			$aParamFROM = new Parametre ();
			$aParamFROM->SQL_select_by_name ( "MAIL_6_FROM" );
			$aParamSUBJET = new Parametre ();
			$aParamSUBJET->SQL_select_by_name ( "MAIL_6_SUBJECT" );
			$aParamHEADER = new Parametre ();
			$aParamHEADER->SQL_select_by_name ( "MAIL_6_HEADER" );
			$aParamFOOTER = new Parametre ();
			$aParamFOOTER->SQL_select_by_name ( "MAIL_6_FOOTER" );

			$aMail = new NotificationMail ();
			$aMail->setFrom ( $aParamFROM->getValeur () );
			$aMail->setTo ( $aAnnuaire->getMail () );
			$aMail->setSubject ( stripslashes ( $aParamSUBJET->getValeur () ) );

			$msg = '';
			// $msg = '<img src="http://www.gcrfrance.com/convention/web/images/bandeau_convention_gcr.jpg" border="0"><br><br>';
			// $msg .= 'Bonjour '.$aAnnuaire->getPrenom().' '. $aAnnuaire->getNom().',<br><br>';
			$msg .= stripslashes ( $aParamHEADER->getValeur () );
			// $msg .= '<b>Nom d\'utilisateur</b> : '.stripslashes($aAnnuaire->getLogin()).'<br>';
			// $msg .= '<b>Mot de passe</b> : '.stripslashes($aAnnuaire->getPassword()).'<br>';
			$msg .= stripslashes ( $aParamFOOTER->getValeur () );
			$msg = str_replace ( '{Nom}', $aAnnuaire->getNom (), $msg );
			$msg = str_replace ( '{Prenom}', $aAnnuaire->getPrenom (), $msg );
			$msg = str_replace ( '{Login}', $aAnnuaire->getLogin (), $msg );
			$msg = str_replace ( '{Mdp}', $aAnnuaire->getPassword (), $msg );
			$msg = str_replace ( '{Civ}', $aAnnuaire->getStringCivilite (), $msg );
			$msg = str_replace ( '{Cher}', $aAnnuaire->getStringCher (), $msg );
			$msg = str_replace ( '{Pres_Repas}', ($aAnnuaire->getRepas () == '0' ? 'Non' : 'Oui'), $msg );
			$msg = str_replace ( '{Pres_Conv}', ($aAnnuaire->getPresence () == '0' ? 'Non' : 'Oui'), $msg );
			if ($aAnnuaire->getTaxi () == '0')
				$taxi = 'Place de parking : <b>Non</b>';
			else if ($aAnnuaire->getTaxi () == '1')
				$taxi = 'Place de parking : <b>Oui</b>';
			else
				$taxi = '';
			$msg = str_replace ( '{Taxi}', $taxi, $msg );

			if ($aAnnuaire->getDiner () == '0')
				$diner = 'Présence au dîner : <b>Non</b>';
			else if ($aAnnuaire->getDiner () == '1')
				$diner = 'Présence au dîner : <b>Oui</b>';
			else
				$diner = '';
			$msg = str_replace ( '{Diner}', $diner, $msg );

			$msg = str_replace ( '/userfiles/', 'http://www.' . $_SERVER ['HTTP_HOST'] . '/userfiles/', $msg );
			$msg = str_replace ( '{AutoLogin}', '?login=' . utf8_encode ( $aAnnuaire->getLogin () ) . '&pwd=' . utf8_encode ( $aAnnuaire->getPassword () ), $msg );

			// $msg .= '<br><img src="http://www.gcrfrance.com/convention/web/images/logoGCRpetit.gif" border="0"><br>';

			$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $msg ) . '</body></html>' );
			// $aMail->setMessage('<html><body style="font-family:arial;">'.stripslashes($msg).'</body></html>');
			$aMail->setHeaderReplyTo ( $aParamFROM->getValeur () );
			$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
			$aMail->setHeaderContentTransferEncoding ( '8bit' );

			$aConventionHistorique = new ConventionHistorique ();
			$aConventionHistorique->setConventionID ( $aAnnuaire->getConventionID () );
			$aConventionHistorique->setDescription ( "Notification Satisfaction à " . $aAnnuaire->getNom () . " " . $aAnnuaire->getPrenom () );
			$aConventionHistorique->SQL_CREATE ();

			// LOG USER HISTORY
			$daoUserHistory = new UserHistoryDAO ();
			$userLog = new UserHistory ();
			$userLog->setDescription ( 'Notification Satisfaction' );
			$userLog->setUserId ( $id );
			$userLog->setActionRealiseePar ( 'Gestionnaire' );
			$daoUserHistory->create ( $userLog );

			// Si envoit de mail ok, on retourne id de l'annuaire ,sinon on retourne false
			if ($aMail->send ()) {
				Return $aAnnuaire->getID ();
			} else {
				Return False;
			}
		} else {
			return False;
		}
	}
	private function sendRelanceSatisfaction($id) {
		include_once ('../../../commun/metier/modele/NotificationMail.class.php');

		$aAnnuaire = new Annuaire ();
		$aAnnuaire->SQL_select ( $id );

		$aParamFROM = new Parametre ();
		$aParamFROM->SQL_select_by_name ( "MAIL_10_FROM" );
		$aParamSUBJET = new Parametre ();
		$aParamSUBJET->SQL_select_by_name ( "MAIL_10_SUBJECT" );
		$aParamHEADER = new Parametre ();
		$aParamHEADER->SQL_select_by_name ( "MAIL_10_HEADER" );
		$aParamFOOTER = new Parametre ();
		$aParamFOOTER->SQL_select_by_name ( "MAIL_10_FOOTER" );

		$aMail = new NotificationMail ();
		$aMail->setFrom ( $aParamFROM->getValeur () );
		$aMail->setTo ( $aAnnuaire->getMail () );
		$aMail->setSubject ( stripslashes ( $aParamSUBJET->getValeur () ) );

		$msg = '';
		// $msg = '<img src="http://www.gcrfrance.com/convention/web/images/bandeau_convention_gcr.jpg" border="0"><br><br>';
		// $msg .= 'Bonjour '.$aAnnuaire->getPrenom().' '. $aAnnuaire->getNom().',<br><br>';
		$msg .= stripslashes ( $aParamHEADER->getValeur () );
		// $msg .= '<b>Nom d\'utilisateur</b> : '.stripslashes($aAnnuaire->getLogin()).'<br>';
		// $msg .= '<b>Mot de passe</b> : '.stripslashes($aAnnuaire->getPassword()).'<br>';
		$msg .= stripslashes ( $aParamFOOTER->getValeur () );
		$msg = str_replace ( '{Nom}', $aAnnuaire->getNom (), $msg );
		$msg = str_replace ( '{Prenom}', $aAnnuaire->getPrenom (), $msg );
		$msg = str_replace ( '{Login}', $aAnnuaire->getLogin (), $msg );
		$msg = str_replace ( '{Mdp}', $aAnnuaire->getPassword (), $msg );
		$msg = str_replace ( '{Civ}', $aAnnuaire->getStringCivilite (), $msg );
		$msg = str_replace ( '{Cher}', $aAnnuaire->getStringCher (), $msg );
		$msg = str_replace ( '{Pres_Repas}', ($aAnnuaire->getRepas () == '0' ? 'Non' : 'Oui'), $msg );
		$msg = str_replace ( '{Pres_Conv}', ($aAnnuaire->getPresence () == '0' ? 'Non' : 'Oui'), $msg );

		if ($aAnnuaire->getTaxi () == '0')
			$taxi = 'Place de parking : <b>Non</b>';
		else if ($aAnnuaire->getTaxi () == '1')
			$taxi = 'Place de parking : <b>Oui</b>';
		else
			$taxi = '';
		$msg = str_replace ( '{Taxi}', $taxi, $msg );

		if ($aAnnuaire->getDiner () == '0')
			$diner = 'Présence au dîner : <b>Non</b>';
		else if ($aAnnuaire->getDiner () == '1')
			$diner = 'Présence au dîner : <b>Oui</b>';
		else
			$diner = '';
		$msg = str_replace ( '{Diner}', $diner, $msg );

		$msg = str_replace ( '/userfiles/', 'http://www.' . $_SERVER ['HTTP_HOST'] . '/userfiles/', $msg );
		$msg = str_replace ( '{AutoLogin}', '?login=' . utf8_encode ( $aAnnuaire->getLogin () ) . '&pwd=' . utf8_encode ( $aAnnuaire->getPassword () ), $msg );

		// $msg .= '<br><img src="http://www.gcrfrance.com/convention/web/images/logoGCRpetit.gif" border="0"><br>';

		$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $msg ) . '</body></html>' );
		// $aMail->setMessage('<html><body style="font-family:arial;">'.stripslashes($msg).'</body></html>');
		$aMail->setHeaderReplyTo ( $aParamFROM->getValeur () );
		$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
		$aMail->setHeaderContentTransferEncoding ( '8bit' );

		$aConventionHistorique = new ConventionHistorique ();
		$aConventionHistorique->setConventionID ( $aAnnuaire->getConventionID () );
		$aConventionHistorique->setDescription ( "Notification Satisfaction à " . $aAnnuaire->getNom () . " " . $aAnnuaire->getPrenom () );
		$aConventionHistorique->SQL_CREATE ();

		// LOG USER HISTORY
		$daoUserHistory = new UserHistoryDAO ();
		$userLog = new UserHistory ();
		$userLog->setDescription ( 'Notification Satisfaction' );
		$userLog->setUserId ( $id );
		$userLog->setActionRealiseePar ( 'Gestionnaire' );
		$daoUserHistory->create ( $userLog );

		// Si envoit de mail ok, on retourne id de l'annuaire ,sinon on retourne false
		if ($aMail->send ()) {
			Return $aAnnuaire->getID ();
		} else {
			Return False;
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