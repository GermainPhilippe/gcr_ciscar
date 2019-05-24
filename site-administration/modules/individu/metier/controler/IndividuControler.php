<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
function createPassword() {
	$varString = 'ABCDEF0123456789';
	$result = '';
	for($i = 0; $i < 6; $i ++) {
		$result .= substr ( $varString, rand ( 0, (strlen ( $varString ) - 1) ), 1 );
	}
	return $result;
}
function createUsername($nomForm) {
	$nomForm = str_replace ( "'", '-', $nomForm );
	$nomForm = str_replace ( " ", '-', $nomForm );

	$nom = explode ( ' ', strtolower ( $nomForm ) );
	$aParam = new Param ();
	$aParam->search_param ( "PASSWD_COUNTER" );

	$int = ($aParam->getValue () < 1000 ? '0' . $aParam->getValue () : $aParam->getValue ());
	$int = ($aParam->getValue () < 100 ? '0' . $int : $int);
	$int = ($aParam->getValue () < 10 ? '0' . $int : $int);
	$result = $nom [0] . '-' . $int;
	$aParam->setValue ( $aParam->getValue () + 1 );
	$aParam->update_param ();
	return $result;
}

// Fonction ajouter par yoann Reversat pour enlever le bug 751
// Fonction qui transforme les caractére spéciaux é en e
function filterAccent($in) {
	$search = array (
			'@(é|è|ê|ë|Ê|Ë)@',
			'@(á|ã|à|â|ä|Â|Ä)@i',
			'@(ì|í|i|i|î|ï|Î|Ï)@i',
			'@(ú|û|ù|ü|Û|Ü)@i',
			'@(ò|ó|õ|ô|ö|Ô|Ö)@i',
			'@(ñ|Ñ)@i',
			'@(ý|ÿ|Ý)@i',
			'@(ç)@i',
			'@( )@i',
			'@(^a-zA-Z0-9_)@'
	);
	$replace = array (
			'e',
			'a',
			'i',
			'u',
			'o',
			'n',
			'y',
			'c',
			' ',
			''
	);
	return preg_replace ( $search, $replace, $in );
}
function filterAccentLogin($in) {
	$search = array (
			'@(é|è|ê|ë|Ê|Ë)@',
			'@(á|ã|à|â|ä|Â|Ä)@i',
			'@(ì|í|i|i|î|ï|Î|Ï)@i',
			'@(ú|û|ù|ü|Û|Ü)@i',
			'@(ò|ó|õ|ô|ö|Ô|Ö)@i',
			'@(ñ|Ñ)@i',
			'@(ý|ÿ|Ý)@i',
			'@(ç)@i',
			'@(\')@i',
			'@( )@i',
			'@(^a-zA-Z0-9_)@'
	);
	$replace = array (
			'e',
			'a',
			'i',
			'u',
			'o',
			'n',
			'y',
			'c',
			'_',
			' ',
			''
	);
	return preg_replace ( $search, $replace, $in );
}
class IndividuControler {
	function run() {

		switch ($_GET ['action']) {
			case 'checkunique' :
				if (isset ( $_POST ['nom'] ) && isset ( $_POST ['prenom'] ) && isset ( $_POST ['LoginRgpd'] )) {
					$Msg = array ();
					$Value = "";
					$MsgValue = "";
					$Msg = Individu::SQL_CHECK_NOT_UNIQUE ( trim ( ($_POST ['prenom']) ), trim ( $_POST ['nom'] ), trim ( $_POST ['LoginRgpd'] ) );
					// if(Individu::SQL_CHECK_UNIQUE(trim(($_POST['prenom'])), trim($_POST['nom'])) != NULL)

					if ($Msg != null) {
						foreach ( $Msg as $Value ) {
							$MsgValue = $MsgValue . $Value . "<br>";
						}
						// print $MsgValue;
						if ($MsgValue != "") {
							// echo(true);
							echo ($MsgValue);
						} else {
							// echo(false);
							echo ("");
						}
					} else {
						echo ("");
					}
				} else {
					echo ("");
				}
				break;

			case 'new' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Individu ();
					$vue = new IndividuTabView ( $modele );
					$vue->renderHTML ( 'new' );
				} else {
					// Creer l'individu
					$aIndividu = new Individu ();
					$aIndividu->setNom ( strtoupper ( filterAccent ( trim ( $_POST ['Nom'] ) ) ) );
					$aIndividu->setPrenom ( str_replace ( '- ', '-', ucwords ( str_replace ( '-', '- ', strtolower ( trim ( $_POST ['Prenom'] ) ) ) ) ) );
					$aIndividu->setTelephone ( trim ( $_POST ['Telephone'] ) );
					$aIndividu->setTelephonePortable ( trim ( $_POST ['TelephonePortable'] ) );
					$aIndividu->setFax ( trim ( $_POST ['Fax'] ) );
					$aIndividu->setMail ( trim ( $_POST ['Mail'] ) );
					$aIndividu->setMail2 ( trim ( $_POST ['Mail2'] ) );
					$aIndividu->setMail3 ( trim ( $_POST ['Mail3'] ) );
					$aIndividu->setMail4 ( trim ( $_POST ['Mail4'] ) );
					$aIndividu->setLoginRgpd( trim ( $_POST ['LoginRgpd'] ) );
					$aIndividu->setStatutdRgpd( trim ( $_POST ['StatutRgpd'] ) );
					
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
					$aIndividu->setLogin ( trim ( createUsername ( filterAccentLogin ( str_replace ( "\'", "", $_POST ['Nom'] ) ) ) ) );
					$aIndividu->setPassword ( trim ( createPassword () ) );
					$aIndividu->setCivilite ( trim ( $_POST ['Civilite'] ) );

					$aEtablissement = new Etablissement ();
					$aEtablissement->select_etablissement ( trim ( $_GET ['id'] ) );
					$aIndividu->setLieuTravail ( $aEtablissement );
					$aIndividu->setLoginSage ( $aEtablissement->getLoginSage () );
					$aIndividu->setIdSage ( trim ( $_POST ['IdSage'] ) );
					// $aIndividu->setPasswordSage($aEtablissement->getPasswordSage());

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aIndividu->setAnnuaire ( $aAnnuaire );

					$aIndividu->create_individu ();
					$IID = $aIndividu->getID ();
					// $IID = mysql_insert_id();
					$aIndividu->find_id ();

					// ##############
					// GCR UNIQUEMENT
					// ##############
					if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == 2) {
						// Creation des fonction bn
						$aIndividuFonctionBN = new IndividuFonctionBN ();
						$aIndividuFonctionBN->setIndividuID ( $IID );

						foreach ( $_POST ['FonctionBNID'] as $aFonctionBNID ) {
							if ($aFonctionBNID != 0) {
								$aIndividuFonctionBN->setFonctionBNID ( $aFonctionBNID );
								$aIndividuFonctionBN->SQL_CREATE ();
							}
						}
					}

					// Créer la jointure avec les commissions et groupes de travail
					// ##############
					// GCR UNIQUEMENT
					// ##############
					if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == 2) {
						for($i = 1; $i <= 4; $i ++) {
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
					// ##############
					// GCR UNIQUEMENT
					// ##############
					if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == 2) {
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

					// Role
					$aRole = new Role ();
					$aRole->setIndividu ( $aIndividu );
					$aRole->setEtablissement ( $aEtablissement );
					$aRole->setAnnuaire ( $aAnnuaire );
					$aRole->create_role ();
					$roleID = mysqli_insert_id ($_SESSION['LINK']);

					// Role Domaine Activite Fonction
					$aDomaineActiviteFonction = new DomaineActiviteFonction ();
					$aDomaineActiviteFonction->setRoleID ( $roleID );
					$aDomaineActiviteFonction->setDomaineActiviteID ( trim ( $_POST ['DomainActiviteID'] ) );
					$aDomaineActiviteFonction->setFonctionDAID ( trim ( $_POST ['FonctionDAID'] ) );
					$aDomaineActiviteFonction->SQL_CREATE ();

					$aIndividu->select_individu ( $IID );

					// on verifie si l'individu a un role principale valide
					$aRole->select_verif_rolePrincipal ( $aIndividu->getLieuTravailID (), $_GET ['id'] );
					$rolePrincipal = $aRole->getLieuTravailID ();

					// si l'individu n'a pas de lieu de travail principal on renseigne le nouveau rôle comme lieu de travail
					if ($rolePrincipal == 0) {
						$aRole->select_rolePrincipal ( $roleID );
						$rolePrincipal = $aRole->getLieuTravailID ();
						if ($rolePrincipal == 0) {
							$LoginSage = $aEtablissement->getLoginSage ();
							// on met à jour le role principal de l'individu
							$aIndividu->defineWorkingPlace ( $IID, $_GET ['id'], $LoginSage );
						}
					}

					// ###################################
					// ###################################
					// ###################################

					// AUTOCREATION FICHE INDIVIDU

					$aIndividu2 = new Individu ();
					$aIndividu2->setNom ( strtoupper ( trim ( $_POST ['Nom'] ) ) );
					$aIndividu2->setPrenom ( str_replace ( '- ', '-', ucwords ( str_replace ( '-', '- ', strtolower ( trim ( $_POST ['Prenom'] ) ) ) ) ) );
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
					$aIndividu2->setLieuTravail ( $aEtablissement );
					$aIndividu2->setLoginSage ( $aIndividu->getLoginSage () );
					$aIndividu2->setIdSage ( $aIndividu->getIdSage () );
					$aIndividu2->setLoginRgpd( trim ( $_POST ['LoginRgpd'] ) );
					$aIndividu2->setStatutdRgpd( trim ( $_POST ['StatutRgpd'] ) );
					// $aIndividu2->setPasswordSage($aIndividu->getPasswordSage());

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
					// Utilisateur CISCAR BELGE
					if ($_POST ['ACCES_CISCAR_BELGE'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '1') {
						$aAnnuaire = new Annuaire ();
						$aAnnuaire->select_annuaire ( '1' );
						$aIndividu2->setAnnuaire ( $aAnnuaire );
						$aIndividu2->setLangueListe ( $aLangueListeSeleted );
						$aIndividu2->create_individu ();
					}

					// ######################
					// GESTION DE LA LCA
					// ######################

					$aSimple_LCAGroupeMembre = new Simple_LCAGroupeMembre ();
					$tabIndividuId = $aSimple_LCAGroupeMembre->SQL_SELECT_IndividuID ( $aIndividu->getLogin () );

					foreach ( $tabIndividuId as $aIndividuID ) {
						// if ($_POST ['ACCES_ACNF'] == '1') {
						// $aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 5, $aIndividuID );

						// // Securite pour les doubles
						// if ($_POST ['ACCES_ACNF'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '3') {
						// $aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 5, $aIndividuID );
						// }
						// }

						if ($_POST ['ACCES_GCR'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 4, $aIndividuID );
						}

						if ($_POST ['ACCES_CISCAR'] == '1') {
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

						if ($_POST ['ACCES_SITE_EMPLOI'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 11, $aIndividuID );
						}

						// Securite AUTOLOGIN

						if ($_POST ['ACCES_CISCOM'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 12, $aIndividuID );
						}
						if ($_POST ['ACCES_CARTERIE'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 13, $aIndividuID );
						}
						if ($_POST ['ACCES_CISCAR_BELGE'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 6, $aIndividuID );
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

					// Notification Account

					if (! $_POST ['ACCES_CISCAR_BELGE'] == '1') {

						$aMail = new NotificationMail ();
						$aParam = new Param ();
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_ACCOUNT_FROM' );
						$aMail->setFrom ( $aParam->getValue () );
						$aMail->setTo ( $aIndividu->getMail () );
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_ACCOUNT_SUBJECT' );
						$aMail->setSubject ( stripslashes ( $aParam->getValue () ) );

						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_ACCOUNT_BODY_1' );
						$msg = $aParam->getValue ();
						$msg .= 'Nom d\'utilisateur : ' . $aIndividu->getLogin () . '<br/>';
						$msg .= 'Mot de passe : ' . $aIndividu->getPassword () . '<br/>';
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_ACCOUNT_BODY_2' );
						$msg .= $aParam->getValue ();

						// Crypter le mot de passe
						$pwd = base64_encode ( $aIndividu->getPassword () );

						$msg = str_replace ( '{Login_validate}', '&action=validate&login=' . $aIndividu->getLogin () . '&pwd=' . $pwd, $msg );
						$msg = str_replace ( '{Login_User}', '&nclogin=' . $aIndividu->getLogin () . '&ncpwd=' . $pwd, $msg );
						$msg = str_replace ( 'loginIcom', 'loginIcom&login=' . $aIndividu->getLogin () . '&pwd=' . $pwd, $msg );

						$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . ($_POST ['Civilite'] == '1' ? 'M.' : ($_POST ['Civilite'] == '2' ? 'Mme' : 'Mlle')) . ' ' . ucwords ( trim ( $_POST ['Prenom'] ) ) . ' ' . strtoupper ( trim ( $_POST ['Nom'] ) ) . ',<br/><br/>' . stripslashes ( $msg ) . '</body></html>' );
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_ACCOUNT_FROM' );
						$aMail->setHeaderReplyTo ( $aParam->getValue () );
						$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
						$aMail->setHeaderContentTransferEncoding ( '8bit' );

						if (! $aMail->send ()) {
							echo CommunFunction::displayAlert ( 'Message en Erreur 1' );
						}

						echo CommunFunction::goToURL ( '../etablissement/index.php?action=m&id=' . $aEtablissement->getID () );
					} else {

						// Notification Account Pour LCA BELGE SUR OUI
						$aMail = new NotificationMail ();
						$aParam = new Param ();
						$aParam->search_param ( 'CISCARBELGE_MAIL_LOGIN_NOTIFICATION_FROM' );
						$aMail->setFrom ( $aParam->getValue () );
						$aMail->setTo ( $aIndividu->getMail () );
						$aParam->search_param ( 'CISCARBELGE_MAIL_LOGIN_NOTIFICATION_SUBJECT' );
						$aMail->setSubject ( stripslashes ( $aParam->getValue () ) );

						$aParam->search_param ( 'CISCARBELGE_MAIL_LOGIN_NOTIFICATION_BODY_1' );
						$msg = $aParam->getValue ();
						$msg .= 'Nom d\'utilisateur / Gebruikersnaam :  ' . $aIndividu->getLogin () . '<br/>';
						$msg .= 'Mot de passe / Paswoord : ' . $aIndividu->getPassword () . '<br/>';
						$aParam->search_param ( 'CISCARBELGE_MAIL_LOGIN_NOTIFICATION_BODY_2' );
						$msg .= $aParam->getValue ();

						// Crypter le mot de passe
						$pwd = base64_encode ( $aIndividu->getPassword () );

						$msg = str_replace ( '{Login_validate}', '&action=validate&login=' . $aIndividu->getLogin () . '&pwd=' . $pwd, $msg );
						$msg = str_replace ( '{Login_User}', '&nclogin=' . $aIndividu->getLogin () . '&ncpwd=' . $pwd, $msg );
						$msg = str_replace ( 'loginIcom', 'loginIcom&login=' . $aIndividu->getLogin () . '&pwd=' . $pwd, $msg );

						$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . trim ( $_POST ['Prenom'] ) . ' ' . trim ( $_POST ['Nom'] ) . ',<br/><br/>' . stripslashes ( $msg ) . '</body></html>' );
						$aParam->search_param ( 'CISCARBELGE_MAIL_LOGIN_NOTIFICATION_FROM' );
						$aMail->setHeaderReplyTo ( $aParam->getValue () );
						$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
						$aMail->setHeaderContentTransferEncoding ( '8bit' );

						if (! $aMail->send ()) {
							echo CommunFunction::displayAlert ( 'Message en Erreur 2' );
						}

						echo CommunFunction::goToURL ( '../etablissement/index.php?action=m&id=' . $aEtablissement->getID () );
					}
				}
				break;
			case 'edit' :
			case 'u' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Individu ();
					$modele->select_individu ( $_GET ['id'] );
					$vue = new IndividuTabView ( $modele );
					$vue->renderHTML ( 'edit' );
				} else {
					$aIndividu = new Individu ();
					$aIndividu->setID ( trim ( $_GET ['id'] ) );
					$aIndividu->setNom ( strtoupper ( trim ( $_POST ['Nom'] ) ) );
					$aIndividu->setPrenom ( str_replace ( '- ', '-', ucwords ( str_replace ( '-', '- ', strtolower ( trim ( $_POST ['Prenom'] ) ) ) ) ) );
					$aIndividu->setTelephone ( trim ( $_POST ['Telephone'] ) );
					$aIndividu->setTelephonePortable ( trim ( $_POST ['TelephonePortable'] ) );
					$aIndividu->setFax ( trim ( $_POST ['Fax'] ) );
					$aIndividu->setMail ( trim ( $_POST ['Mail'] ) );
					$aIndividu->setMail2 ( trim ( $_POST ['Mail2'] ) );
					$aIndividu->setMail3 ( trim ( $_POST ['Mail3'] ) );
					$aIndividu->setMail4 ( trim ( $_POST ['Mail4'] ) );
					$aIndividu->setLoginRgpd( trim ( $_POST ['LoginRgpd'] ) );
					$aIndividu->setStatutdRgpd( trim ( $_POST ['StatutRgpd'] ) );
					
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
					$aIndividu->setLogin ( trim ( $_POST ['Login'] ) );
					$aIndividu->setPassword ( trim ( $_POST ['Password'] ) );
					$aIndividu->setCivilite ( trim ( $_POST ['Civilite'] ) );
					$aIndividu->setLoginSage ( $_POST ['LoginSage'] );
					$aIndividu->setIdSage ( $_POST ['IdSage'] );

					// Creation des fonction bn

					$aIndividuFonctionBN = new IndividuFonctionBN ();
					$aIndividuFonctionBN->setIndividuID ( $aIndividu->getID () );
					$aIndividuFonctionBN->SQL_REMOVE_ALL ();

					// ##############
					// GCR UNIQUEMENT
					// ##############
					if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == 2) {
						foreach ( $_POST ['FonctionBNID'] as $aFonctionBNID ) {
							if ($aFonctionBNID != 0 && ! empty ( $aFonctionBNID )) {
								$aIndividuFonctionBN->setFonctionBNID ( $aFonctionBNID );
								$aIndividuFonctionBN->SQL_CREATE ();
							}
						}
					}
					// $aIndividu->update_individu();

					// EVOLUTION
					switch ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID']) {
						case '1' :
						case '2' :
							$aIndividu->update_individu_by_site ( 1 );
							$aIndividu->update_individu_by_site ( 2 );
							break;
						case '3' :
							$aIndividu->update_individu_by_site ( 3 );
							break;
					}

					// ##############
					// GCR UNIQUEMENT
					// ##############
					if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == 2) {
						// CrÃ©er la jointure avec les commissions et groupes de travail
						$aCommissionIndividu = new CommissionIndividu ();
						$aCommissionIndividu->setIndividu ( $aIndividu );
						$aCommissionIndividu->remove_commissionindividu ();
						for($i = 1; $i <= 4; $i ++) {
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
					// ##############
					// GCR UNIQUEMENT
					// ##############
					if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == 2) {

						$aDelegationRegionnale = new DelegationRegionnale ();
						$aDelegationRegionnale->setIndividu ( $aIndividu );
						$aDelegationRegionnale->remove_delegationregionnale ();

						if ($_POST ['RegionID'] != '0') {
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
					$aSimple_LCAGroupeMembreList = new Simple_LCAGroupeMembreList ();
					$SiteIndividu = $aSimple_LCAGroupeMembreList->SQL_SELECT_ALL_SITE ( $aIndividu->getID () );

					$aIndividu2 = new Individu ();
					$aIndividu2->setNom ( strtoupper ( trim ( $_POST ['Nom'] ) ) );
					$aIndividu2->setPrenom ( str_replace ( '- ', '-', ucwords ( str_replace ( '-', '- ', strtolower ( trim ( $_POST ['Prenom'] ) ) ) ) ) );
					$aIndividu2->setTelephone ( trim ( $_POST ['Telephone'] ) );
					$aIndividu2->setTelephonePortable ( trim ( $_POST ['TelephonePortable'] ) );
					$aIndividu2->setFax ( trim ( $_POST ['Fax'] ) );
					$aIndividu2->setMail ( trim ( $_POST ['Mail'] ) );
					$aIndividu2->setMail2 ( trim ( $_POST ['Mail2'] ) );
					$aIndividu2->setMail3 ( trim ( $_POST ['Mail3'] ) );
					$aIndividu2->setMail4 ( trim ( $_POST ['Mail4'] ) );
					$aIndividu2->setEnSommeil ( trim ( $_POST ['EnSommeil'] ) );
					$aIndividu2->setImportActif ( trim ( $_POST ['ImportActif'] ) );
					$aIndividu2->setLogin ( $aIndividu->getLogin () );
					$aIndividu2->setPassword ( $aIndividu->getPassword () );
					$aIndividu2->setCivilite ( trim ( $_POST ['Civilite'] ) );
					$aIndividu2->setLoginSage ( $aIndividu->getLoginSage () );
					$aIndividu2->setIdSage ( $aIndividu->getIdSage () );
					$aIndividu2->setLoginRgpd( trim ( $_POST ['LoginRgpd'] ) );
					$aIndividu2->setStatutdRgpd( trim ( $_POST ['StatutRgpd'] ) );
					// $aIndividu2->setPasswordSage($aIndividu->getPasswordSage());

					// CISCAR
					if (! in_array ( '1', $SiteIndividu ) && $_POST ['ACCES_CISCAR'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '1') {
						$aAnnuaire = new Annuaire ();
						$aAnnuaire->select_annuaire ( '1' );
						$aIndividu2->setAnnuaire ( $aAnnuaire );
						$aIndividu2->setLangueListe ( $aLangueListeSeleted );
						$aIndividu2->create_individu ();
					}
					// GCR
					if (! in_array ( '2', $SiteIndividu ) && $_POST ['ACCES_GCR'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '2') {
						$aAnnuaire = new Annuaire ();
						$aAnnuaire->select_annuaire ( '2' );
						$aIndividu2->setAnnuaire ( $aAnnuaire );
						$aIndividu2->setLangueListe ( $aLangueListeSeleted );
						$aIndividu2->create_individu ();
					}
					// ACNF
					// if (! in_array ( '3', $SiteIndividu ) && $_POST ['ACCES_ACNF'] == '1' && $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '3') {
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

					foreach ( $tabIndividuId as $aIndividuID ) {
						// Supression LCA pour mise a jours
						$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 5, $aIndividuID );
						$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 3, $aIndividuID );

						$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 8, $aIndividuID );
						$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 9, $aIndividuID );
						$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 15, $aIndividuID );

						$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 4, $aIndividuID );
						$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 11, $aIndividuID );
						$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 12, $aIndividuID );
						$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 13, $aIndividuID );
						$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 6, $aIndividuID );
						// Ajout acces STVA
						if ($_SERVER ['HTTP_HOST'] == 'gcrfrance.local' || $_SERVER ['HTTP_HOST'] == 'ciscar.local') {
							// Base local
							$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 433, $aIndividuID );
						} else {
							// Base de production
							$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 497, $aIndividuID );
						}

						// if ($_POST ['ACCES_ACNF'] == '1') {
						// $aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 5, $aIndividuID );
						// }
						if ($_POST ['ACCES_CISCAR'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 3, $aIndividuID );
						}

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

						if ($_POST ['ACCES_CISCAR_BELGE'] == '1') {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_ADD_MEMBER ( 6, $aIndividuID );
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

					if (isset ( $_POST ['action2'] ) && ! empty ( $_POST ['action2'] )) {
						switch ($_POST ['action2']) {
							case 'NotificationIdentifiant' :
								echo CommunFunction::goToURL ( '?action=NotificationIdentifiant&id=' . $_GET ['id'] );
								break;
						}
					} else {
						echo CommunFunction::goToURL ( '?' );
					}
				}

				break;
			case 'd' :
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					// La Suppression se fait sur tout les utilisateurs

					$aIndividu = new Individu ();
					$aIndividu->select_individu ( $_GET ['id'] );
					$aIndividu->remove_individu ();

					$aIndividu = new Individu ();
					$aIndividu->groupe_remove_all_acces ( $_GET ['id'] );
					if (isset ( $_GET ['ide'] )) {
						echo CommunFunction::goToURL ( '../etablissement/?action=m&id=' . $_GET ['ide'] );
					} else {
						echo CommunFunction::goToURL ( ! isset ( $_GET ['url_return'] ) ? '?' : $_GET ['url_return'] );
					}
				}
				break;
			case 'deleteCISCAR' :
			case 'deleteGCR' :
				if (isset ( $_GET ['id'] )) {
					// La Suppression de l'individu dans un des annuaires

					$aIndividu = new Individu ();
					$aIndividu->select_individu ( $_GET ['id'] );
					$aIndividu->remove_individu_annuaire ( $_GET ['id'] );

					if ($_GET ['action'] == 'deleteGCR') {
						$aSimple_LCAGroupeMembre = new Simple_LCAGroupeMembre ();
						$tabIndividuId = $aSimple_LCAGroupeMembre->SQL_SELECT_IndividuID ( $aIndividu->getLogin () );
						foreach ( $tabIndividuId as $aIndividuID ) {
							$aSimple_LCAGroupeMembre->SQL_GROUPE_REMOVE_MEMBER ( 4, $aIndividuID );
						}
					}

					$aIndividu = new Individu ();
					$aIndividu->groupe_remove_all_acces ( $_GET ['id'] );
					if (isset ( $_GET ['ide'] )) {
						echo CommunFunction::goToURL ( '../etablissement/?action=m&id=' . $_GET ['ide'] );
					} else {
						echo CommunFunction::goToURL ( ! isset ( $_GET ['url_return'] ) ? '?' : $_GET ['url_return'] );
					}
				}
				break;
			case 'm' :
				if (isset ( $_GET ['id'] )) {
					if (! isset ( $_GET ['idi'] )) {
						// Avec Recherche
						if (isset ( $_POST ['Recherche'] ) && $_POST ['Recherche'] != NULL) {
							$NbEntre = 0;
							$aModeleList = new IndividuListe ();
							$aModeleList->SQL_SEARCH ( trim ( $_GET ['id'] ), isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, $_POST ['Recherche'], isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
							// Element Max
							$NbEntre = $aModeleList->SQL_SEARCH_COUNT ( trim ( $_GET ['id'] ), $_POST ['Recherche'] );
						} elseif (isset ( $_GET ['Recherche'] ) && $_GET ['Recherche'] != NULL) {
							$NbEntre = 0;
							$aModeleList = new IndividuListe ();
							$aModeleList->SQL_SEARCH ( trim ( $_GET ['id'] ), isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, $_GET ['Recherche'], isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
							// Element Max
							$NbEntre = $aModeleList->SQL_SEARCH_COUNT ( trim ( $_GET ['id'] ), $_GET ['Recherche'] );
						} // Sans Recherche
						else {
							$NbEntre = 0;
							$aModeleList = new IndividuListe ();
							$aModeleList->SQL_SEARCH ( trim ( $_GET ['id'] ), isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, '', isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
							// Element Max
							$NbEntre = $aModeleList->SQL_COUNT ( trim ( $_GET ['id'] ) );
						}
						$aIndividutListeView = new IndividuListeViewEtablissement2 ( $aModeleList, $NbEntre );
						$aIndividutListeView->render ();
						unset ( $aModeleList );
						unset ( $aIndividutListeView );
					}
				}
				break;
			case 'NotificationIdentifiant' :
				if (isset ( $_GET ['id'] )) {
					$aIndividu = new Individu ();
					$aIndividu->select_individu ( $_GET ['id'] );

					$memberList = new MembreListe ();
					// on verifie si il a pas accés aux Site site CISCAR BELGE
					if (! $memberList->is_member ( '6', $_GET ['id'] )) {

						$aMail = new NotificationMail ();
						$aParam = new Param ();
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_LOGIN_FROM' );
						$aMail->setFrom ( $aParam->getValue () );
						$aMail->setTo ( $aIndividu->getLoginRgpd() );
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_LOGIN_SUBJECT' );
						$aMail->setSubject ( $aParam->getValue () );

						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_LOGIN_BODY_1' );
						$msg = $aParam->getValue ();
						$msg .= 'Nom d\'utilisateur : ' . $aIndividu->getLogin () . '<br/>';
						$msg .= 'Mot de passe : ' . $aIndividu->getPassword () . '<br/>';
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_LOGIN_BODY_2' );
						$msg .= $aParam->getValue ();

						// Crypter le mot de passe
						$pwd = base64_encode ( $aIndividu->getPassword () );

						$msg = str_replace ( '{Login_validate}', '&action=validate&login=' . $aIndividu->getLogin () . '&pwd=' . $pwd, $msg );
						$msg = str_replace ( '{Login_User}', '&nclogin=' . $aIndividu->getLogin () . '&ncpwd=' . $pwd, $msg );
						$msg = str_replace ( 'loginIcom', 'loginIcom&login=' . $aIndividu->getLogin () . '&pwd=' . $pwd, $msg );

						// $aMail->setMessage('<html><body style="color:#000000;font-size: x-small;font-family:Arial;">Bonjour '.$aIndividu->getPrenom().' '.$aIndividu->getNom().',<br/><br/>'.stripslashes($msg).'</body></html>');
						$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . ($aIndividu->getCivilite () == '1' ? 'M.' : ($aIndividu->getCivilite () == '2' ? 'Mme' : 'Mlle')) . ' ' . trim ( $aIndividu->getPrenom () ) . ' ' . trim ( $aIndividu->getNom () ) . ',<br/><br/>' . stripslashes ( $msg ) . '</body></html>' );
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_LOGIN_FROM' );
						$aMail->setHeaderReplyTo ( $aParam->getValue () );
						$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
						$aMail->setHeaderContentTransferEncoding ( '8bit' );

						if (! $aMail->send ()) {
							echo CommunFunction::displayAlert ( 'Message en Erreur 3' );
						}
						echo CommunFunction::goToURL ( '../individu/?action=edit&id=' . $_GET ['id'] );
					} else {

						$aMail = new NotificationMail ();
						$aParam = new Param ();
						$aParam->search_param ( 'CISCARBELGE_MAIL_LOGIN_NOTIFICATION_FROM' );
						$aMail->setFrom ( $aParam->getValue () );
						$aMail->setTo ( $aIndividu->getLoginRgpd() );
						$aParam->search_param ( 'CISCARBELGE_MAIL_LOGIN_NOTIFICATION_SUBJECT' );
						$aMail->setSubject ( $aParam->getValue () );

						$aParam->search_param ( 'CISCARBELGE_MAIL_LOGIN_NOTIFICATION_BODY_1' );
						$msg = $aParam->getValue ();
						$msg .= 'Nom d\'utilisateur / Gebruikersnaam :  ' . $aIndividu->getLogin () . '<br/>';
						$msg .= 'Mot de passe / Paswoord : ' . $aIndividu->getPassword () . '<br/>';
						$aParam->search_param ( 'CISCARBELGE_MAIL_LOGIN_NOTIFICATION_BODY_2' );
						$msg .= $aParam->getValue ();

						// Crypter le mot de passe
						$pwd = base64_encode ( $aIndividu->getPassword () );

						$msg = str_replace ( '{Login_validate}', '&action=validate&login=' . $aIndividu->getLogin () . '&pwd=' . $pwd, $msg );
						$msg = str_replace ( '{Login_User}', '&nclogin=' . $aIndividu->getLogin () . '&ncpwd=' . $pwd, $msg );
						$msg = str_replace ( 'loginIcom', 'loginIcom&login=' . $aIndividu->getLogin () . '&pwd=' . $pwd, $msg );

						// $aMail->setMessage('<html><body style="color:#000000;font-size: x-small;font-family:Arial;">Bonjour '.$aIndividu->getPrenom().' '.$aIndividu->getNom().',<br/><br/>'.stripslashes($msg).'</body></html>');
						$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . trim ( $aIndividu->getPrenom () ) . ' ' . trim ( $aIndividu->getNom () ) . ',<br/><br/>' . stripslashes ( $msg ) . '</body></html>' );
						$aParam->search_param ( 'CISCARBELGE_MAIL_LOGIN_NOTIFICATION_FROM' );
						$aMail->setHeaderReplyTo ( $aParam->getValue () );
						$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
						$aMail->setHeaderContentTransferEncoding ( '8bit' );

						if (! $aMail->send ()) {
							echo CommunFunction::displayAlert ( 'Message en Erreur 4' );
						}
						echo CommunFunction::goToURL ( '../individu/?action=edit&id=' . $_GET ['id'] );
					}
				}
				break;
		}
	}
}
?>