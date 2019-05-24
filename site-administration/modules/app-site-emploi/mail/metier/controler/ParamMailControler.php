<?php
/**
 * Controleur permettant l'ï¿½dition des cv,offres,balises,mail et page info"
 *  @author Alexandre Diallo
 *  @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 */
class ParamMailControler {
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
	public function __construct() {
	}
	/**
	 * $_GET['action']=?
	 * mail = edition des mail
	 * accueil = edition de l'accueil
	 * cv = liste des cv
	 * editcv = editer un cv
	 * deletecv = supprimer un cv
	 * offres = liste des offres
	 * editoffre = editer une offre
	 * deleteoffre = supprimer une offre
	 * infos = liste des pages
	 * editpage = editer une page
	 * deletepage = supprimer une page
	 * balise = editer les balises
	 */
	public function run() {
		switch ($_GET ['action']) {
			case 'mail' :
				if (isset ( $_POST ['pubannonceobjet'] )) {
					$aParam = new Parametre ();
					$aParam->SQL_select_by_name ( "ParamAdminMail" );
					$aParam->setValeur ( $_POST ['paramadminmail'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "PubAnnonceObjet" );
					$aParam->setValeur ( $_POST ['pubannonceobjet'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "PubAnnonceTete" );
					$aParam->setValeur ( $_POST ['pubannoncetete'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "PubAnnoncePied" );
					$aParam->setValeur ( $_POST ['pubannoncepied'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "NonPubAnnonceObjet" );
					$aParam->setValeur ( $_POST ['nonpubannonceobjet'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "NonPubAnnoncePied" );
					$aParam->setValeur ( $_POST ['nonpubannoncepied'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "NonPubAnnonceTete" );
					$aParam->setValeur ( $_POST ['nonpubannoncetete'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "PubCandidatObjet" );
					$aParam->setValeur ( $_POST ['pubcandobjet'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "PubCandidatPied" );
					$aParam->setValeur ( $_POST ['pubcandpied'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "PubCandidatTete" );
					$aParam->setValeur ( $_POST ['pubcandtete'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "NonPubCandidatObjet" );
					$aParam->setValeur ( $_POST ['nonpubcandobjet'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "NonPubCandidatPied" );
					$aParam->setValeur ( $_POST ['nonpubcandpied'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "NonPubCandidatTete" );
					$aParam->setValeur ( $_POST ['nonpubcandtete'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "SuppAnnonceObjet" );
					$aParam->setValeur ( $_POST ['suppannonceobjet'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "SuppAnnonceTete" );
					$aParam->setValeur ( $_POST ['suppannoncetete'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "SuppAnnoncePied" );
					$aParam->setValeur ( $_POST ['suppannoncepied'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "SuppCandidatObjet" );
					$aParam->setValeur ( $_POST ['suppcandobjet'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "SuppCandidatTete" );
					$aParam->setValeur ( $_POST ['suppcandtete'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "SuppCandidatPied" );
					$aParam->setValeur ( $_POST ['suppcandpied'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "RepOffCandObjet" );
					$aParam->setValeur ( $_POST ['repoffcandobjet'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "RepOffCandTete" );
					$aParam->setValeur ( $_POST ['repoffcandtete'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "RepOffCandPied" );
					$aParam->setValeur ( $_POST ['repoffcandpied'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "RepOffEmpObjet" );
					$aParam->setValeur ( $_POST ['repoffempobjet'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "RepOffEmpTete" );
					$aParam->setValeur ( $_POST ['repoffemptete'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "RepOffEmpPied" );
					$aParam->setValeur ( $_POST ['repoffemppied'] );
					$aParam->SQL_update ();

					$aView = new ParamMailView ( NULL );
					$aView->redirection ( '../../?menu=4' );
				} else {
					$aParam = new Parametre ();
					$aParamMail_1 = new ParametreMail ();
					$aParamMail_2 = new ParametreMail ();
					$aParamMail_3 = new ParametreMail ();
					$aParamMail_4 = new ParametreMail ();
					$aParamMail_5 = new ParametreMail ();
					$aParamMail_6 = new ParametreMail ();
					$aParamMail_7 = new ParametreMail ();
					$aParamMail_8 = new ParametreMail ();

					$aParam->SQL_select_by_name ( "PubAnnonceObjet" );
					$aParamMail_1->setMailObjet ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "PubAnnoncePied" );
					$aParamMail_1->setMailPied ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "PubAnnonceTete" );
					$aParamMail_1->setMailTete ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "NonPubAnnonceObjet" );
					$aParamMail_2->setMailObjet ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "NonPubAnnoncePied" );
					$aParamMail_2->setMailPied ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "NonPubAnnonceTete" );
					$aParamMail_2->setMailTete ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "PubCandidatObjet" );
					$aParamMail_3->setMailObjet ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "PubCandidatPied" );
					$aParamMail_3->setMailPied ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "PubCandidatTete" );
					$aParamMail_3->setMailTete ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "NonPubCandidatObjet" );
					$aParamMail_4->setMailObjet ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "NonPubCandidatPied" );
					$aParamMail_4->setMailPied ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "NonPubCandidatTete" );
					$aParamMail_4->setMailTete ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "SuppAnnonceObjet" );
					$aParamMail_5->setMailObjet ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "SuppAnnoncePied" );
					$aParamMail_5->setMailPied ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "SuppAnnonceTete" );
					$aParamMail_5->setMailTete ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "SuppCandidatObjet" );
					$aParamMail_6->setMailObjet ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "SuppCandidatPied" );
					$aParamMail_6->setMailPied ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "SuppCandidatTete" );
					$aParamMail_6->setMailTete ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "RepOffCandObjet" );
					$aParamMail_7->setMailObjet ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "RepOffCandPied" );
					$aParamMail_7->setMailPied ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "RepOffCandTete" );
					$aParamMail_7->setMailTete ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "RepOffEmpObjet" );
					$aParamMail_8->setMailObjet ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "RepOffEmpPied" );
					$aParamMail_8->setMailPied ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "RepOffEmpTete" );
					$aParamMail_8->setMailTete ( $aParam->getValeur () );

					// ###

					$aView = new ParamMailView ();
					$aView->setMail_1 ( $aParamMail_1 );
					$aView->setMail_2 ( $aParamMail_2 );
					$aView->setMail_3 ( $aParamMail_3 );
					$aView->setMail_4 ( $aParamMail_4 );
					$aView->setMail_5 ( $aParamMail_5 );
					$aView->setMail_6 ( $aParamMail_6 );
					$aView->setMail_7 ( $aParamMail_7 );
					$aView->setMail_8 ( $aParamMail_8 );

					$aParam->SQL_select_by_name ( "ParamAdminMail" );
					$aView->setParamAdminMail ( $aParam->getValeur () );

					$aView->rendercorp ();
				}
				break;
			case 'accueil' :
				if (isset ( $_POST ['paramemploirenault'] )) {
					$adoc = new ParamAccueil ();
					$adoc->setparamemploirenault ( $_POST ['paramemploirenault'] );

					$adoc->setparampictpartenaireacc ( $_POST ['parampictpartenaireacc'] );
					$adoc->setparampictpartenairecand ( $_POST ['parampictpartenairecand'] );
					$adoc->setparampictpartenaireconcess ( $_POST ['parampictpartenaireconcess'] );

					$adoc->setparamconcess ( $_POST ['paramconcess'] );
					$adoc->setparamcandidat ( $_POST ['paramcandidat'] );
					$adoc->setparamlienconcession ( $_POST ['paramlienconcession'] );

					$adoc->setparamliencandidat ( $_POST ['paramliencandidat'] );
					$adoc->setparamlibelleco1 ( $_POST ['paramlibelleco1'] );
					$adoc->setparamlibelleco2 ( $_POST ['paramlibelleco2'] );

					$adoc->setparamlibelleca1 ( $_POST ['paramlibelleca1'] );
					$adoc->setparamlibelleca2 ( $_POST ['paramlibelleca2'] );
					$adoc->setparamlienpublicite ( $_POST ['paramlienpublicite'] );

					$adoc->setparamaffichecompteur ( $_POST ['paramaffichecompteur'] );
					// $adoc -> setparamhtmlmetakeyacc($_POST['paramhtmlmetakeyacc']);
					// $adoc -> setparamhtmlmetakeyconcess($_POST['paramhtmlmetakeyconcess']);

					// $adoc -> setparamhtmlmetakeycand($_POST['paramhtmlmetakeycand']);

					$adoc->sql_update_accueil ();

					$aView = new ParamAccueilView ( NULL );
					$aView->redirection ( '../../?menu=4' );
				} else {
					$modele = new ParamAccueil ();
					$modele->sql_select_accueil ();
					$aView = new ParamAccueilView ( $modele );
					$aView->render ();
				}
				break;
			case 'balise' :
				if (isset ( $_POST ['paramtitrepage'] )) {
					$adoc = new ParamBalise ();
					$adoc->setparamtitrepage ( $_POST ['paramtitrepage'] );

					$adoc->setparamhtmlmetadescacc ( $_POST ['paramhtmlmetadescacc'] );
					$adoc->setparamhtmlmetarobotacc ( $_POST ['paramhtmlmetarobotacc'] );
					$adoc->setparamhtmlmetakeyacc ( $_POST ['paramhtmlmetakeyacc'] );

					$adoc->setparamhtmlmetakeyconcess ( $_POST ['paramhtmlmetakeyconcess'] );
					$adoc->setparamhtmlmetadescconcess ( $_POST ['paramhtmlmetadescconcess'] );
					$adoc->setparamhtmlmetarobotconcess ( $_POST ['paramhtmlmetarobotconcess'] );

					$adoc->setparamhtmlmetakeycand ( $_POST ['paramhtmlmetakeycand'] );
					$adoc->setparamhtmlmetadesccand ( $_POST ['paramhtmlmetadesccand'] );
					$adoc->setparamhtmlmetarobotcand ( $_POST ['paramhtmlmetarobotcand'] );

					$adoc->setparamh1acc1 ( $_POST ['paramh1acc1'] );
					$adoc->setparamh2acc2 ( $_POST ['paramh2acc2'] );
					$adoc->setnomsite ( $_POST ['nomsite'] );

					$adoc->sql_update_balise ();

					$aView = new ParamBaliseView ( NULL );

					$aView->redirection ( '../../?menu=4' );
				} else {
					$modele = new ParamBalise ();
					$modele->sql_select_balise ();
					$aView = new ParamBaliseView ( $modele );
					$aView->render ();
				}
				break;

			// ### GESTION DES CANDIDATURES (CV) ###

			case 'cv' :
				$aControler = new TriCVControler ();
				$aControler->run ();
				break;
			case 'editcv' :
				if (isset ( $_POST ['numcv'] )) {
					// Controle taille Fichier CV/LM
					if (in_array ( $_FILES ['cv'] ['error'], array (
							1,
							2,
							3
					) ) || in_array ( $_FILES ['lettre'] ['error'], array (
							1,
							2,
							3
					) ) || $_POST ['depselect'] == '') {
						// Reconstruction des donnï¿½es saisies
						$aPays = new ListPays ();
						$aPays->SQL_SELECT_ALL ();
						$aDomaine = new ListDomaine ();
						$aDomaine->SQL_SELECT_ALL ();
						$aDepartement = new ListDepartement ();
						$aDepartement->SQL_SELECT_ALL ();

						$aModele = new VerifCV ();
						$aModele->sql_select_verifcv ( $_POST ['numcv'] );
						// $aModele->settitrecand ( $_POST ['titre'] );
						$aModele->setfonction ( $_POST ['fonction'] );

						$aModele->setdepartementselect ( $_POST ['depselect'] );

						$aDomaineTMP = new Domaine ();
						$aDomaineTMP->setiddomaine ( $_POST ['domaine'] );
						$aDomaineTMP->sql_select_domaine ();
						$aModele->setiddomaine ( $aDomaineTMP->getnomdomaine () );

						$aModele->setcivilite ( $_POST ['civilite'] );
						$aModele->setnom ( $_POST ['nom'] );
						$aModele->setprenom ( $_POST ['prenom'] );
						$aModele->setadresse ( $_POST ['adresse'] );
						$aModele->setcp ( $_POST ['cp'] );
						$aModele->setville ( $_POST ['ville'] );
						$aModele->setmail ( $_POST ['mail'] );

						$aPaysTMP = new Pays ();
						$aPaysTMP->setidpays ( $_POST ['Pays'] );
						$aPaysTMP->sql_select_pays ();
						$aModele->setidpays ( $aPaysTMP->getnompays () );
						if ($aPaysTMP->getidpays () != '69') {
							if (isset ( $_POST ['Ressortissants1'] ) && $_POST ['Ressortissants1'] == 1) {
								$aModele->setressort ( 1 );
								$aModele->setsejour ( $_POST ['TitreSejour'] );
								$aModele->setdispo ( $_POST ['Disponibilite1'] );
							} else {
								if (isset ( $_POST ['Ressortissants2'] ) && $_POST ['Ressortissants2'] == 2) {
									$aModele->setressort ( 2 );
									$aModele->setdispo ( $_POST ['Disponibilite2'] );
								}
							}
						}
						$aModele->setvalid ( isset ( $_POST ['valid'] ) ? $_POST ['valid'] : NULL );
						$aModele->setpub ( isset ( $_POST ['valid'] ) ? $_POST ['valid'] : NULL );
						$aView = new VerifCVView ( $aModele, $aPays, $aDomaine, $aDepartement );
						if ($_POST ['depselect'] == '')
							$aView->setMessageErreur ( 'Le choix d\'un département est obligatoire.' );
						else
							$aView->setMessageErreur ( 'Le fichier fourni pour le CV ou la Lettre de motivation est trop gros (500Ko Max)' );
						$aView->renderHTML ( 'editcv' );
					} else {
						// **************************
						// Edition d'une candidature*
						// **************************

						$aModele = new VerifCV ();
						// $aModele->settitrecand ( $_POST ['titre'] );
						$aModele->setfonction ( $_POST ['fonction'] );
						$aModele->setnumcv ( $_POST ['numcv'] );
						$aModele->setdepartementselect ( $_POST ['depselect'] );
						$aModele->setiddomaine ( $_POST ['domaine'] );
						$aModele->setcivilite ( $_POST ['civilite'] );
						$aModele->setnom ( $_POST ['nom'] );
						$aModele->setprenom ( $_POST ['prenom'] );
						$aModele->setadresse ( $_POST ['adresse'] );
						$aModele->setcp ( $_POST ['cp'] );
						$aModele->setville ( $_POST ['ville'] );
						$aModele->setmail ( $_POST ['mail'] );
						$aModele->setidpays ( $_POST ['Pays'] );
						if ($aModele->getidpays () != '69') {
							if (isset ( $_POST ['Ressortissants1'] ) && $_POST ['Ressortissants1'] == 1) {
								$aModele->setressort ( 1 );
								$aModele->setsejour ( $_POST ['TitreSejour'] );
								$aModele->setdispo ( $_POST ['Disponibilite1'] );
							} else {
								if (isset ( $_POST ['Ressortissants2'] ) && $_POST ['Ressortissants2'] == 2) {
									$aModele->setressort ( 2 );
									$aModele->setdispo ( $_POST ['Disponibilite2'] );
								}
							}
						}

						if (isset ( $_FILES ['cv'] ['name'] ) && $_FILES ['cv'] ['name'] != '') {
							// Attachement du CV
							$aModele->setcv ( $_FILES ['cv'] ['name'] );
							$myFile = pathinfo ( $_FILES ['cv'] ['name'] );
							switch ($myFile ['extension']) {
								case 'doc' :
									$aModele->setmimecv ( 'application/msword' );
									break;
								case 'docx' :
									$aModele->setmimecv ( 'vnd.openxmlformats-officedocument.wordprocessingml.document' );
									break;
								case 'pdf' :
									$aModele->setmimecv ( 'application/pdf' );
									break;
								default :
									$aModele->setmimecv ( $_FILES ['cv'] ['type'] );
									break;
							}
							$aModele->setsizecv ( $_FILES ['cv'] ['size'] );

							$aModele->setblobcv ( file_get_contents ( $_FILES ['cv'] ['tmp_name'] ) );
							$aModele->sql_update_cv ();
						}

						if (isset ( $_FILES ['lettre'] ['name'] ) && $_FILES ['lettre'] ['name'] != '') {
							// Attachement de la lettre de motivation
							$aModele->setlettrem ( $_FILES ['lettre'] ['name'] );
							$aModele->setsizelm ( $_FILES ['lettre'] ['size'] );

							$myFile = pathinfo ( $_FILES ['lettre'] ['name'] );
							switch ($myFile ['extension']) {
								case 'doc' :
									$aModele->setmimelm ( 'application/msword' );
									break;
								case 'docx' :
									$aModele->setmimelm ( 'vnd.openxmlformats-officedocument.wordprocessingml.document' );
									break;
								case 'pdf' :
									$aModele->setmimelm ( 'application/pdf' );
									break;
								default :
									$aModele->setmimelm ( $_FILES ['lettre'] ['type'] );
									break;
							}
							$aModele->setbloblm ( file_get_contents ( $_FILES ['lettre'] ['tmp_name'] ) );
							$aModele->sql_update_lettre ();
						}
						// Modification de VALIDATION/PUBLICATION
						$aModele->setvalid ( isset ( $_POST ['valid'] ) ? $_POST ['valid'] : NULL );
						$aModele->setpub ( isset ( $_POST ['valid'] ) ? $_POST ['valid'] : NULL );

						$aModele->sql_mail ( $_POST ['numcv'] );
						$aModele->sql_update_verifcv ();
						$aModele->sql_select_verifcv ( $_POST ['numcv'] );

						if (isset ( $_POST ['valid'] ) && $_POST ['valid'] == 0) {
							$aMail = new EnvoiMail ( $aModele );

							$aParam = new Parametre ();
							$aParamMail_2 = new ParametreMail ();
							$aParam->SQL_select_by_name ( "NonPubCandidatObjet" );
							$aParamMail_2->setMailObjet ( $aParam->getValeur () );
							$aParam->SQL_select_by_name ( "NonPubCandidatPied" );
							$aParamMail_2->setMailPied ( $aParam->getValeur () );
							$aParam->SQL_select_by_name ( "NonPubCandidatTete" );
							$aParamMail_2->setMailTete ( $aParam->getValeur () );
							$aParam->SQL_select_by_name ( "ParamMailBox" );
							$aMail->setParamMailBox ( $aParam->getValeur () );
							$aParam->SQL_select_by_name ( "ParamAdminMail" );
							$aMail->setParamAdminMail ( $aParam->getValeur () );
							$aParam->SQL_select_by_name ( "IDMail" );
							$aMail->setidmail ( $aParam->getValeur () );

							$aMail->setMail_2 ( $aParamMail_2 );

							$aMail->envoiMail ( 1 );
						}

						$aView = new VerifCVView ( NULL, NULL, NULL, NULL );
						$aView->redirection ( '?action=cv&list' );
					}
				} else {
					if (isset ( $_GET ['id'] )) {
						$aPays = new ListPays ();
						$aPays->SQL_SELECT_ALL ();
						$aDomaine = new ListDomaine ();
						$aDomaine->SQL_SELECT_ALL ();
						$aDepartement = new ListDepartement ();
						$aDepartement->SQL_SELECT_ALL ();
						$aModele = new VerifCV ();
						$aModele->sql_select_verifcv ( $_GET ['id'] );
						$aView = new VerifCVView ( $aModele, $aPays, $aDomaine, $aDepartement );
						$aView->renderHTML ( 'editcv' );
					}
				}
				break;
			case 'deletecv' :

				// ******************************
				// Suppression d'une candidature*
				// ******************************
				$aModele = new VerifCV ();

				$aModele->setnumcv ( $_GET ['id'] );
				$aModele->sql_mail ( $_GET ['id'] );
				$aModele->sql_select_verifcv ( $_GET ['id'] );
				$aMail = new EnvoiMail ( $aModele );

				$aParam = new Parametre ();
				$aParamMail_3 = new ParametreMail ();
				$aParam->SQL_select_by_name ( "SuppCandidatObjet" );
				$aParamMail_3->setMailObjet ( $aParam->getValeur () );
				$aParam->SQL_select_by_name ( "SuppCandidatPied" );
				$aParamMail_3->setMailPied ( $aParam->getValeur () );
				$aParam->SQL_select_by_name ( "SuppCandidatTete" );
				$aParamMail_3->setMailTete ( $aParam->getValeur () );
				$aParam->SQL_select_by_name ( "ParamMailBox" );
				$aMail->setParamMailBox ( $aParam->getValeur () );
				$aParam->SQL_select_by_name ( "ParamAdminMail" );
				$aMail->setParamAdminMail ( $aParam->getValeur () );
				$aParam->SQL_select_by_name ( "IDMail" );
				$aMail->setidmail ( $aParam->getValeur () );

				$aMail->setMail_3 ( $aParamMail_3 );
				$aMail->envoiMail ( 3 );
				$aModele->SQL_delete ();

				$aView = new VerifCVView ();
				$aView->redirection_delete ( '?action=cv&list' );

				break;

			// ### GESTION DES OFFRES ###

			case 'offres' :
				$aControler = new TriOffreControler ();
				$aControler->run ();
				break;
			case 'editoffre' :
				if (isset ( $_POST ['numoffre'] )) {
					if (in_array ( $_FILES ['fichier'] ['error'], array (
							1,
							2,
							3
					) ) || $_POST ['depselect'] == '') {
						$aType = new ListTypeContrat ();
						$aType->SQL_SELECT_ALL ();
						$aExp = new ListExperience ();
						$aExp->SQL_SELECT_ALL ();
						$aNiv = new ListNiveau ();
						$aNiv->SQL_SELECT_ALL ();
						$aDomaine = new ListDomaine ();
						$aDomaine->SQL_SELECT_ALL ();
						$aMetier = new ListMetier ();
						$aMetier->SQL_SELECT_ALL ();
						// $aRegion = new ListRegion ();
						// $aRegion->SQL_SELECT_ALL ();
						$aDepart = new ListDepartement ();
						$aDepart->SQL_SELECT_ALL ();

						$aModele = new VerifOffre ();
						$aModele->sql_select_verifoffre ( $_POST ['numoffre'] );
						$aModele->settitreoffre ( $_POST ['titre'] );
						// $aModele->setfonction ( $_POST ['fonction'] );

						// $aRegionTMP = new Region();
						// $aRegionTMP->select_region($_POST['region']);
						// $aModele->setregionid($aRegionTMP->getName());
						$aModele->setdepartementselect ( $_POST ['depselect'] );

						// $aDomaineTMP = new Domaine ();
						// $aDomaineTMP->setiddomaine ( $_POST ['domaine'] );
						// $aDomaineTMP->sql_select_domaine ();
						// $aModele->setiddomaine ( $aDomaineTMP->getnomdomaine () );

						$aModele->setville ( $_POST ['ville'] );
						$aModele->setidmetier ( $_POST ['metier'] );

						$aTypeContratTMP = new TypeContrat ();
						$aTypeContratTMP->setidtype ( $_POST ['type'] );
						$aTypeContratTMP->sql_select ();
						$aModele->settype ( $aTypeContratTMP->getnomtype () );

						$aNiveauTMP = new Niveau ();
						$aNiveauTMP->setidniveau ( $_POST ['niveau'] );
						$aNiveauTMP->sql_select ();
						$aModele->setniveau ( $aNiveauTMP->getniveau () );

						$aExperienceTMP = new Experience ();
						$aExperienceTMP->setidexp ( $_POST ['exp'] );
						$aExperienceTMP->sql_select ();
						$aModele->setexp ( $aExperienceTMP->getexperience () );

						$aModele->setcommentaire ( $_POST ['commentaire'] );
						$aModele->setcontact ( $_POST ['contact'] );
						$aModele->setdatedebpost ( $_POST ['datDebPost'] );
						$aModele->setmail ( $_POST ['mail'] );

						$aModele->setvalid ( isset ( $_POST ['valid'] ) ? $_POST ['valid'] : NULL );
						$aModele->setpub ( isset ( $_POST ['valid'] ) ? $_POST ['valid'] : NULL );
						$aView = new VerifOffreView ( $aModele, $aDomaine, $aMetier, $aDepart, $aType, $aExp, $aNiv );
						if ($_POST ['depselect'] == '')
							$aView->setMessageErreur ( 'Le choix d\'un département est obligatoire.' );
						else
							$aView->setMessageErreur ( 'Le fichier fourni est trop gros (500Ko Max)' );
						$aView->renderHTML ( 'editoffre' );
					} else {
						// ********************
						// Edition d'une offre*
						// ********************
						$aModele = new VerifOffre ();
						$aModele->setnumoffre ( $_POST ['numoffre'] );
						$aModele->settitreoffre ( $_POST ['titre'] );
						// $aModele->setfonction ( $_POST ['fonction'] );
						// $aModele->setregionid($_POST['region']);
						$aModele->setdepartementselect ( $_POST ['depselect'] );
						// $aModele->setiddomaine ( $_POST ['domaine'] );
						$aModele->setville ( $_POST ['ville'] );
						$aModele->setidmetier ( $_POST ['metier'] );
						$aModele->setcommentaire ( $_POST ['commentaire'] );
						$aModele->setcontact ( $_POST ['contact'] );
						$aModele->setdatedebpost ( $this->getDateUS ( $_POST ['datDebPost'] ) );
						$aModele->setmail ( $_POST ['mail'] );
						$aModele->settype ( $_POST ['type'] );
						$aModele->setexp ( $_POST ['exp'] );
						$aModele->setniveau ( $_POST ['niveau'] );
						if (isset ( $_FILES ['fichier'] ['name'] ) && $_FILES ['fichier'] ['name'] != '') {
							// Attachement du fichier
							$aModele->setfichier ( $_FILES ['fichier'] ['name'] );
							$aModele->setsizefichier ( $_FILES ['fichier'] ['size'] );
							$myFile = pathinfo ( $_FILES ['fichier'] ['name'] );
							switch ($myFile ['extension']) {
								case 'doc' :
									$aModele->setmimefichier ( 'application/msword' );
									break;
								case 'docx' :
									$aModele->setmimefichier ( 'vnd.openxmlformats-officedocument.wordprocessingml.document' );
									break;
								case 'pdf' :
									$aModele->setmimefichier ( 'application/pdf' );
									break;
								default :
									$aModele->setmimefichier ( $_FILES ['fichier'] ['type'] );
									break;
							}
							// $aModele->setmimefichier($_FILES['fichier']['type']);
							$aModele->setblobfichier ( addslashes ( file_get_contents ( $_FILES ['fichier'] ['tmp_name'] ) ) );
							$aModele->sql_update_fichier ();
						}

						$aModele->setvalid ( isset ( $_POST ['valid'] ) ? $_POST ['valid'] : NULL );
						$aModele->setpub ( isset ( $_POST ['valid'] ) ? $_POST ['valid'] : NULL );

						// $aModele->sql_mail($_POST['numoffre']);
						$aModele->sql_update_verifoffre ( $_POST ['numoffre'] );

						$aModele->sql_select_verifoffre ( $_POST ['numoffre'] );

						if (isset ( $_POST ['valid'] ) && $_POST ['valid'] == 0) {
							$aModele->sql_mail ( $_POST ['numoffre'] );
							$aMail = new EnvoiMail ( $aModele );

							$aParam = new Parametre ();
							$aParamMail_1 = new ParametreMail ();
							$aParam->SQL_select_by_name ( "NonPubAnnonceObjet" );
							$aParamMail_1->setMailObjet ( $aParam->getValeur () );
							$aParam->SQL_select_by_name ( "NonPubAnnoncePied" );
							$aParamMail_1->setMailPied ( $aParam->getValeur () );
							$aParam->SQL_select_by_name ( "NonPubAnnonceTete" );
							$aParamMail_1->setMailTete ( $aParam->getValeur () );
							$aParam->SQL_select_by_name ( "ParamMailBox" );
							$aMail->setParamMailBox ( $aParam->getValeur () );
							$aParam->SQL_select_by_name ( "ParamAdminMail" );
							$aMail->setParamAdminMail ( $aParam->getValeur () );
							$aParam->SQL_select_by_name ( "IDMail" );
							$aMail->setidmail ( $aParam->getValeur () );

							$aMail->setMail_1 ( $aParamMail_1 );

							$aMail->envoiMail ( 4 );
						}

						$aView = new VerifOffreView ( NULL, NULL, NULL, NULL, NULL, NULL, NULL );
						$aView->redirection ( '?action=offres&list' );
					}
				} else {
					if (isset ( $_GET ['id'] )) {
						$aType = new ListTypeContrat ();
						$aType->SQL_SELECT_ALL ();
						$aExp = new ListExperience ();
						$aExp->SQL_SELECT_ALL ();
						$aNiv = new ListNiveau ();
						$aNiv->SQL_SELECT_ALL ();
						$aDomaine = new ListDomaine ();
						$aDomaine->SQL_SELECT_ALL ();
						$aMetier = new ListMetier ();
						$aMetier->SQL_SELECT_ALL ();
						$aRegion = new ListRegion ();
						$aRegion->SQL_SELECT_ALL ();
						$aDepart = new ListDepartement ();
						$aDepart->SQL_SELECT_ALL ();
						$aModele = new VerifOffre ();
						$aModele->sql_select_verifoffre ( $_GET ['id'] );
						$aView = new VerifOffreView ( $aModele, $aDomaine, $aMetier, $aDepart, $aType, $aExp, $aNiv );
						$aView->renderHTML ( 'editoffre' );
					}
				}
				break;

			case 'deleteoffre' :

				// ************************
				// Suppression d'une offre*
				// ************************
				$aModele = new VerifOffre ();

				$aModele->setnumoffre ( $_GET ['id'] );

				$aModele->sql_mail ( $_GET ['id'] );
				$aModele->sql_select_verifoffre ( $_GET ['id'] );
				$aMail = new EnvoiMail ( $aModele );
				$aParam = new Parametre ();
				$aParamMail_4 = new ParametreMail ();
				$aParam->SQL_select_by_name ( "SuppAnnonceObjet" );
				$aParamMail_4->setMailObjet ( $aParam->getValeur () );
				$aParam->SQL_select_by_name ( "SuppAnnoncePied" );
				$aParamMail_4->setMailPied ( $aParam->getValeur () );
				$aParam->SQL_select_by_name ( "SuppAnnonceTete" );
				$aParamMail_4->setMailTete ( $aParam->getValeur () );
				$aParam->SQL_select_by_name ( "ParamMailBox" );
				$aMail->setParamMailBox ( $aParam->getValeur () );
				$aParam->SQL_select_by_name ( "ParamAdminMail" );
				$aMail->setParamAdminMail ( $aParam->getValeur () );
				$aParam->SQL_select_by_name ( "IDMail" );
				$aMail->setidmail ( $aParam->getValeur () );

				$aMail->setMail_4 ( $aParamMail_4 );

				$aMail->envoiMail ( 2 );
				$aModele->SQL_delete ();
				$aView = new VerifOffreView ();
				$aView->redirection_delete ( '?action=offres&list' );
				break;

			// ### GESTION DES PAGES INFOS ###

			case 'infos' :
				$aList = new PageInfosList ();
				$aList->SQL_SELECT_ALL ();
				$aView = new PageInfosListView ( $aList );
				$aView->renderHTML ();
				break;
			case 'infospg' :
				$aList = new PageInfosList ();
				$aList->SQL_SELECT_ALL ();
				$aView = new PGPageInfosListView ( $aList );
				$aView->renderHTML ();
				break;
			case 'newpage' :
				if (isset ( $_POST ['espace'] )) {
					$aModele = new PageInfos ();

					$aModele->setespace ( $_POST ['espace'] );
					$aModele->setaffichage ( $_POST ['affichage'] );
					$aModele->settitre ( $_POST ['titre'] );
					$aModele->setmetatag ( $_POST ['metatag'] );
					$aModele->setcontenu ( $_POST ['contenu'] );

					$aModele->sql_insert_page ();

					$aView = new PageInfosView ( 'newpage' );
					$aView->redirection ( '?action=infos' );
				} else {
					$aModele = new PageInfos ();
					$aView = new PageInfosView ( 'newpage' );
					$aView->renderHTML ( 'newpage' );
				}
				break;
			case 'editpage' :
				if (isset ( $_POST ['espace'] )) {
					$aModele = new PageInfos ();
					$aModele->setespace ( $_POST ['espace'] );
					$aModele->setaffichage ( $_POST ['affichage'] );
					$aModele->settitre ( $_POST ['titre'] );
					$aModele->setmetatag ( $_POST ['metatag'] );
					$aModele->setcontenu ( $_POST ['contenu'] );
					$aModele->setidpageinfo ( $_GET ['id'] );

					$aModele->sql_update_page ();

					$aView = new PageInfosView ( NULL );
					$aView->redirection ( '?action=infos' );
				} else {
					if (isset ( $_GET ['id'] )) {
						$aModele = new PageInfos ();
						$aModele->sql_select_page ( $_GET ['id'] );
						$aView = new PageInfosView ( $aModele );
						$aView->renderHTML ( 'editpage' );
					}
				}
				break;
			case 'deletepage' :
				$aModele = new PageInfos ();
				$aModele->setidpageinfo ( $_GET ['id'] );
				$aModele->sql_delete_page ();
				$aView = new PageInfosView ( NULL );
				$aView->redirection ( '?action=infos' );
				break;

			// ### GESTION DES REPONSES ###

			case 'reponse' :
				$aControler = new ListReponseControler ();
				$aControler->run ();
				break;
			case 'viewreponse' :
				if (isset ( $_GET ['id'] )) {
					$aModele = new VerifReponse ();
					$aModele->sql_select ( $_GET ['id'] );

					$aView = new VerifReponseView ( $aModele );
					$aView->renderHTML ();
				}
				break;
		}
	}
}
?>