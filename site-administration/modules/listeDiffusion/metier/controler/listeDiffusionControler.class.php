<?php
class listeDiffusionControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
			case 'newOutlook' :
				if (! empty ( $_POST )) {
					$aManager = new ListeDiffusionManager ();
					$aListe = new ListeDiffusion ();
					$aListe->setNom ( $_POST ['Nom'] );
					if ($_GET ['action'] == 'newOutlook' && $aListe->getNom () != '') {
						// Pour les liste Outlook on force à "TYPE_SIMPLE_OU"
						$aListe->setType ( ListeDiffusion::TYPE_SIMPLE_OU );
						$aManager->save ( $aListe, 'Outlook' );
					}

					if ($_GET ['action'] == 'new') {
						if ($_POST ['Type'] == '1') {
							if ($_POST ['TypeListe'] == 'ET') {
								$aListe->setType ( ListeDiffusion::TYPE_SIMPLE_ET );
							} else {
								$aListe->setType ( ListeDiffusion::TYPE_SIMPLE_OU );
							}
						} else {
							if ($_POST ['Type'] == '2') {
								if ($_POST ['TypeListe'] == 'ET') {
									$aListe->setType ( ListeDiffusion::TYPE_SPECIFIQUE_ET );
								} else {
									$aListe->setType ( ListeDiffusion::TYPE_SPECIFIQUE_OU );
								}
							} else // Maj 20150324 germain ajout type CSV
							{
								if ($_POST ['TypeListe'] == 'ET') {
									$aListe->setType ( ListeDiffusion::TYPE_CSV_ET );
								} else {
									$aListe->setType ( ListeDiffusion::TYPE_CSV_OU );
								}
							}
						}
						$aManager->save ( $aListe, 'News' );
					}

					// Creation des criteres
					for($i = 1; $i <= ( int ) $_POST ['Counter']; $i ++) {
						if (isset ( $_POST ['TypeElement' . $i] )) {
							$aListeDiffusionCritere = new ListeDiffusionCritere ();
							$aListeDiffusionCritere->setListeID ( ( int ) $aListe->getID () );
							$aListeDiffusionCritere->setElementID ( ( int ) $_POST ['CritereValue' . $i] );

							switch ($_POST ['TypeContient' . $i]) {
								case '1' :
									$aListeDiffusionCritere->setContient ( ListeDiffusionCritere::CONTIENT_EST );
									break;
								case '2' :
									$aListeDiffusionCritere->setContient ( ListeDiffusionCritere::CONTIENT_NEST );
									break;
							}

							switch ($_POST ['TypeElement' . $i]) {
								case '1' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_INDIVIDU );
									break;
								case '2' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_ETABLISSEMENT );
									break;
								case '3' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_DOMAINE_ACTIVITE );
									break;
								case '4' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_FONCTION_DOMAINE_ACTIVITE );
									break;
								case '5' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_REGION );
									break;
								case '6' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_FONCTION_REGION );
									break;
								case '7' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_COMMISSION );
									break;
								case '8' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_GROUPE_LCA );
									break;
								case '9' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_REGION_ETABLISSEMENT );
									break;
								case '10' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_CSV );
									break;
								case '11' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_BUREAU_NATIONAL );
									break;
							}
							$aListeDiffusionCritereManager = new ListeDiffusionCritereManager ();
							$aListeDiffusionCritereManager->save ( $aListeDiffusionCritere );
						}
					}

					// Redirection
					echo CommunFunction::goToURL ( '?' );
				} else {
					$aModele = new ListeDiffusion ();
					$aView = new ListeDiffusionView ( $aModele );
					if ($_GET ['action'] == 'new')
						$aView->renderHTML ( 'new' );
					if ($_GET ['action'] == 'newOutlook')
						$aView->renderHTML ( 'newOutlook' );
				}
				break;
			case 'updateOutlook' :
			case 'update' :
				if (! empty ( $_POST )) {
					$aManager = new ListeDiffusionManager ();
					$aListe = new ListeDiffusion ();
					$aListe->setID ( ( int ) $_GET ['id'] );
					$aListe->setNom ( $_POST ['Nom'] );
					if ($_GET ['action'] == 'updateOutlook') {
						// Pour les liste Outlook on force à "TYPE_SIMPLE_OU"
						$aListe->setType ( ListeDiffusion::TYPE_SIMPLE_OU );
						$aManager->save ( $aListe, 'Outlook' );
					}

					if ($_GET ['action'] == 'update') {
						if ($_POST ['Type'] == '1') {
							if ($_POST ['TypeListe'] == 'ET') {
								$aListe->setType ( ListeDiffusion::TYPE_SIMPLE_ET );
							} else {
								$aListe->setType ( ListeDiffusion::TYPE_SIMPLE_OU );
							}
						} else {
							if ($_POST ['Type'] == '2') {
								if ($_POST ['TypeListe'] == 'ET') {
									$aListe->setType ( ListeDiffusion::TYPE_SPECIFIQUE_ET );
								} else {
									$aListe->setType ( ListeDiffusion::TYPE_SPECIFIQUE_OU );
								}
							} else // Maj 20150324 germain ajout type CSV
							{
								if ($_POST ['TypeListe'] == 'ET') {
									$aListe->setType ( ListeDiffusion::TYPE_CSV_ET );
								} else {
									$aListe->setType ( ListeDiffusion::TYPE_CSV_OU );
								}
							}
						}
						$aManager->save ( $aListe, 'News' );
					}

					// Creation des criteres
					$aListeDiffusionCritereManager = new ListeDiffusionCritereManager ();
					$aListeDiffusionCritereManager->deleteAll ( $aListe->getID () );

					for($i = 1; $i <= ( int ) $_POST ['Counter']; $i ++) {
						if (isset ( $_POST ['TypeElement' . $i] )) {
							$aListeDiffusionCritere = new ListeDiffusionCritere ();
							$aListeDiffusionCritere->setListeID ( ( int ) $aListe->getID () );
							$aListeDiffusionCritere->setElementID ( ( int ) $_POST ['CritereValue' . $i] );

							switch ($_POST ['TypeContient' . $i]) {
								case '1' :
									$aListeDiffusionCritere->setContient ( ListeDiffusionCritere::CONTIENT_EST );
									break;
								case '2' :
									$aListeDiffusionCritere->setContient ( ListeDiffusionCritere::CONTIENT_NEST );
									break;
							}

							switch ($_POST ['TypeElement' . $i]) {
								case '1' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_INDIVIDU );
									break;
								case '2' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_ETABLISSEMENT );
									break;
								case '3' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_DOMAINE_ACTIVITE );
									break;
								case '4' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_FONCTION_DOMAINE_ACTIVITE );
									break;
								case '5' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_REGION );
									break;
								case '6' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_FONCTION_REGION );
									break;
								case '7' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_COMMISSION );
									break;
								case '8' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_GROUPE_LCA );
									break;
								case '9' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_REGION_ETABLISSEMENT );
									break;
								case '10' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_CSV );
									break;
								case '11' :
									$aListeDiffusionCritere->setType ( ListeDiffusionCritere::TYPE_BUREAU_NATIONAL );
									break;
							}
							$aListeDiffusionCritereManager->save ( $aListeDiffusionCritere );
						}
					}

					// Redirection
					echo CommunFunction::goToURL ( '?' );
				} else {
					if (isset ( $_GET ['id'] )) {
						$aManager = new ListeDiffusionManager ();
						$aView = new ListeDiffusionView ( $aManager->get ( ( int ) $_GET ['id'] ) );
						if ($_GET ['action'] == 'update')
							$aView->renderHTML ( 'update' );
						if ($_GET ['action'] == 'updateOutlook')
							$aView->renderHTML ( 'updateOutlook' );
					}
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aManager = new ListeDiffusionManager ();
					$aManager->delete ( ( int ) $_GET ['id'] );

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'view' :
			case 'viewOutlook' :
				if (isset ( $_GET ['id'] )) {
					$aSimple_IndividuList = new Simple_IndividuList ();
					if ($_GET ['action'] == 'view')
						$rqt = ListeDiffusionCritere::generateSQL ( $_GET ['id'] );
					if ($_GET ['action'] == 'viewOutlook')
						$rqt = ListeDiffusionCritere::generateSQL_For_Mails ( $_GET ['id'] );

					if (! empty ( $rqt )) {
						$aSimple_IndividuList->SQL_SELECT_ALL_WITH_RQT ( $rqt );
						$aListeDiffusionRequeteView = new ListeDiffusionRequeteView ( $aSimple_IndividuList->getList (), $rqt, $_GET ['id'] );
						$aListeDiffusionRequeteView->renderHTML ( $_GET ['action'] );
					} else {
						$aListeDiffusionRequeteView = new ListeDiffusionRequeteView ( array (), $rqt, $_GET ['id'] );
						$aListeDiffusionRequeteView->renderHTML ( $_GET ['action'] );
					}
				}
				break;

			// ### Affichage des vues ###

			case 'viewDomaineActivite' :
				$aDomaineActiviteListe = new DomaineActiviteListe ();
				$aDomaineActiviteListe->select_all_domaineactivite ();
				$aView = new ListeDiffusion_DomaineActiviteView ( $aDomaineActiviteListe->getDomaineActiviteListe () );
				$aView->renderHTML ();
				break;
			case 'viewFonctionDA' :
				$aDomaineActiviteListe = new DomaineActiviteListe ();
				$aDomaineActiviteListe->select_all_domaineactivite ();
				$aView = new ListeDiffusion_FonctionDAView ( $aDomaineActiviteListe->getDomaineActiviteListe () );
				$aView->renderHTML ();
				break;
			case 'viewRegion' :
				$aRegionListe = new RegionListe ();
				$aRegionListe->select_all_region ();
				$aView = new ListeDiffusion_RegionView ( $aRegionListe->getRegionListe () );
				$aView->renderHTML ();
				break;
			case 'viewFonctionRegion' :
				$aFonctionDelegationListe = new FonctionDelegationListe ();
				$aFonctionDelegationListe->select_all_fonctiondelegation ();
				$aView = new ListeDiffusion_FonctionRegionView ( $aFonctionDelegationListe->getFonctionDelegationListe () );
				$aView->renderHTML ();
				break;
			case 'viewCommission' :
				$aCommissionListe = new CommissionListe ();
				$aCommissionListe->select_all_commission ();
				$aView = new ListeDiffusion_CommissionView ( $aCommissionListe->getCommissionListe () );
				$aView->renderHTML ();
				break;
			case 'viewBureauNational' :
				$aFonctionBNListe = new FonctionBNListe ();
				$aFonctionBNListe->select_all_fonctionbn ();
				$aView = new ListeDiffusion_BureauNationalView ( $aFonctionBNListe->getFonctionBNListe () );
				$aView->renderHTML ();
				break;
			case 'viewGroupeLCA' :
				$aSimple_LCAGroupeList = new Simple_LCAGroupeList ();
				$aSimple_LCAGroupeList->SQL_SELECT_ALL_SYSTEM ();
				$aList = $aSimple_LCAGroupeList->getList ();

				$aSimple_LCAGroupe = new Simple_LCAGroupe ();
				$aSimple_LCAGroupe->SQL_SELECT ( 8 );
				$aList [] = $aSimple_LCAGroupe;
				$aSimple_LCAGroupe2 = new Simple_LCAGroupe ();
				$aSimple_LCAGroupe2->SQL_SELECT ( 9 );
				$aList [] = $aSimple_LCAGroupe2;
				$aSimple_LCAGroupe2 = new Simple_LCAGroupe ();
				$aSimple_LCAGroupe2->SQL_SELECT ( 15 );
				$aList [] = $aSimple_LCAGroupe2;

				$aSimple_LCAGroupeList->SQL_SELECT_ALL_PERSO ();

				$aView = new ListeDiffusion_GroupeLCAView ( array_merge ( $aList, $aSimple_LCAGroupeList->getList () ) );
				$aView->renderHTML ();
				break;

			case 'import' :
				if (isset ( $_FILES ['URLFile'] ['name'] ) && $_FILES ['URLFile'] ['name'] != '') {

					$listIdMail = array ();
					set_time_limit ( 700 );
					if (is_readable ( $_FILES ["URLFile"] ["tmp_name"] )) {
						if (($handle = fopen ( $_FILES ["URLFile"] ["tmp_name"], "r" )) !== FALSE) {

							$aIndividu = new Individu ();
							$aListeDiffusionCsv = new ListeDiffusionCsv ();
							$aInd = 0;
							$aNum = 1;
							$aListeDiffusionCsv->create_csv ( $_FILES ["URLFile"] ["name"] );
							$IID = mysqli_insert_id ($_SESSION['LINK']);
							$aViewList = new ListeDiffusion_CsvView ();

							while ( ($data = fgetcsv ( $handle, 1000, ";" )) !== FALSE ) {
								// $aViewList->value['Cpt'] = $aNum;
								// echo "<script language='JavaScript'>alert('".$aNum."')</script>";

								if (count ( $data ) >= 1 && $data [0] != "") {
									// Check mail //
									$listIdMail = Individu::SQL_CHECK_MAIL ( $data [0] );
									if ($listIdMail != NULL && (!isset($data [5]) || (isset($data [5]) && $data [5] ==  ''))) {
										for($i = 0; $i < ( int ) count ( $listIdMail ); $i ++) {
											// on prend en compte l'établissement
											if (isset ( $data [3]) && $data [3] != '')
												$listIdMail [$i] [4] = $data [3];
											else
												$listIdMail [$i] [4] = NULL;

											$aListeDiffusionCsv->setListeCsv ( $data [0], $listIdMail [$i], $aInd );
											$aListeDiffusionCsv->create_csv_detail ( $IID, $data [0], $listIdMail [$i], $aInd );
											$aInd += 1;
										}
									} else {
										// IndividuID
										$listIdMail [0] [0] = null;
										// AnnuaireID
										$listIdMail [0] [1] = null;
										// si Nom renseigné dans fichier csv
										if (isset ( $data [1] ))
											$listIdMail [0] [2] = $data [1];
										else
											$listIdMail [0] [2] = null;
										// si Prénom renseigné dans fichier csv
										if (isset ( $data [2] ))
											$listIdMail [0] [3] = $data [2];
										else
											$listIdMail [0] [3] = null;
										// si Etablissement renseigné dans fichier csv
										if (isset ( $data [3] ))
											$listIdMail [0] [4] = $data [3];
										else
											$listIdMail [0] [4] = null;
										// si Civilite renseignée dans fichier csv
										if (isset ( $data [4] ))
											$listIdMail [0] [5] = $data [4];
										else
											$listIdMail [0] [5] = null;
										// si Liste Etablissement
										if (isset ( $data [5] ))
											$listIdMail [0] [6] = $data [5];
										else
											$listIdMail [0] [6] = null;

										$aListeDiffusionCsv->setListeCsv ( $data [0], $listIdMail [0], $aInd );
										$aListeDiffusionCsv->create_csv_detail ( $IID, $data [0], $listIdMail [0], $aInd );
										$aInd += 1;
									}
								}
								$aNum += 1;
							}
							fclose ( $handle );

							$aListeCsv = $aListeDiffusionCsv->getListeCsv ();
							$aViewList->renderListeCsv ( $IID, $aListeCsv, $_FILES ["URLFile"] ['name'] );
						}
					}
				} else {
					if (isset ( $_POST ['newMail'] ) && $_POST ['newMail'] != '') {
						$aIndividu = new Individu ();
						$aListeDiffusionCsv = new ListeDiffusionCsv ();
						$aInd = 0;
						$aNum = 1;
						$aListeDiffusionCsv->create_csv ( $_POST ['newMail'] );
						$IID = mysqli_insert_id ($_SESSION['LINK']);
						$aViewList = new ListeDiffusion_CsvView ();

						// Check mail //
						$listIdMail = Individu::SQL_CHECK_MAIL ( $_POST ['newMail'] );
						if ($listIdMail != NULL) {
							for($i = 0; $i < ( int ) count ( $listIdMail ); $i ++) {
								// si saisie formulaire, on ne tient pas compte de l'établissement
								$listIdMail [$i] [4] = NULL;
								$aListeDiffusionCsv->setListeCsv ( $_POST ['newMail'], $listIdMail [$i], $aInd );
								$aListeDiffusionCsv->create_csv_detail ( $IID, $_POST ['newMail'], $listIdMail [$i], $aInd );
								$aInd += 1;
							}
						} else {
							// IndividuID
							$listIdMail [0] [0] = null;
							// AnnuaireID
							$listIdMail [0] [1] = null;
							// si Nom renseigné dans formulaire
							if (isset ( $_POST ['newNom'] ))
								$listIdMail [0] [2] = $_POST ['newNom'];
							else
								$listIdMail [0] [2] = null;
							// si Prénom renseigné dans formulaire
							if (isset ( $_POST ['newPrenom'] ))
								$listIdMail [0] [3] = $_POST ['newPrenom'];
							else
								$listIdMail [0] [3] = null;
							// si saisie formulaire, on ne tient pas compte de l'établissement
							$listIdMail [0] [4] = NULL;
							// si civilite renseignée dans formulaire
							if (isset ( $_POST ['newCivilite'] ))
								$listIdMail [0] [5] = $_POST ['newCivilite'];
							else
								$listIdMail [0] [5] = null;
							// si Liste Etablissement
							if (isset ( $data [5] ))
								$listIdMail [0] [6] = $data [5];
							else
								$listIdMail [0] [6] = null;
										
							$aListeDiffusionCsv->setListeCsv ( $_POST ['newMail'], $listIdMail [0], $aInd );
							$aListeDiffusionCsv->create_csv_detail ( $IID, $_POST ['newMail'], $listIdMail [0], $aInd );
							$aInd += 1;
						}

						$aListeCsv = $aListeDiffusionCsv->getListeCsv ();
						$aViewList->renderListeCsv ( $IID, $aListeCsv, $_POST ['newMail'] );
					}
				}
				break;
		}
	}
}
?>