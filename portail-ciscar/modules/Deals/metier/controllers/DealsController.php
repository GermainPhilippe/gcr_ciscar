<?php
class DealsController {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'connexion' :
				return $this->CheckConnexion ();
				break;
			case 'mailconnexion' :
				return $this->CheckMailConnexion ();
				break;
			case 'ajaxmotdepasseperdu' :
				$aCommunController = new CommunControler ();
				return $aCommunController->ajaxmotdepasseperduAction ();
				break;
		}
	}
	public function MailDealCmd($DealCmdID) {
		// Recherche des informations sur le deal
		$adeal = $this->DealCmd ( $DealCmdID );
		// calcul du montant de la commande
		$mtCmd = $adeal->getPrixPromo () * $adeal->getQuantiteCmdIndividu ();
		// calcul de la quantité restant à commander
		$QteRest = $adeal->getQuantiteMin () - $adeal->getQuantiteCmd ();
		if ($QteRest <= 0)
			$QteRest = 0;
			
			// recherche des quantités commandées par paramètre
		$params = $adeal->SQL_selectCmdParamDeal ( $DealCmdID );
		$index = 0;
		foreach ( $params as $DealParam ) {
			if ($DealParam->getParamQteCmd () > 0) {
				$Tabqtecmd [$index] = $DealParam->getParamQteCmd ();
				$Tabmtcmd [$index] = $adeal->getPrixPromo () * $DealParam->getParamQteCmd () . ' €';
			} else {
				$Tabqtecmd [$index] = '';
				$Tabmtcmd [$index] = '';
			}
			
			$index += 1;
		}
		
		// Recherche des informations sur l'individu si connu de ciscar
		if ($adeal->getIndividuID () > 0) {
			$aindividu = $this->DealCmdIndividu ( $adeal->getIndividuID () );
			
			// Crypter le mot de passe
			$pwd = base64_encode ( $aindividu->getPwdUser () );
			
			// Mise en forme du lien ver le Deal
			$lien = $_SERVER ['HTTP_HOST'] . '/modules/Deals/index.php?login=' . $aindividu->getLoginUser () . '&pwd=' . $pwd . '&deal=' . $adeal->getDealsID ();
			$Nom = $aindividu->getNomUser ();
			$Prenom = utf8_encode ( $aindividu->getPrenomUser () );
			$Login = $aindividu->getLoginUser ();
			$LoginCli = 'CODE CLIENT : ' . $aindividu->getLoginCli ();
			$Mdp = $aindividu->getPwdUser ();
			$Civ = $aindividu->getCiviliteUser ();
			$Cher = $aindividu->getCherUser ();
			$Facrs = $aindividu->getRaisonSocialUser ();
			$Facadr1 = $aindividu->getAdresse1User ();
			$Facadr2 = $aindividu->getAdresse2User ();
			$Faccp = $aindividu->getCodePostalUser ();
			$Facvil = $aindividu->getVilleUser ();
		} else {
			$lien = $_SERVER ['HTTP_HOST'] . '/modules/Deals/index.php?deal=' . $adeal->getDealsID ();
			$Nom = $adeal->getNom ();
			$Prenom = $adeal->getPrenom ();
			$Login = '';
			$LoginCli = '';
			$Mdp = '';
			$Civ = '';
			$Cher = '';
			$Facrs = $adeal->getRaisonSociale_fac ();
			$Facadr1 = $adeal->getAdresse1_fac ();
			$Facadr2 = $adeal->getAdresse2_fac ();
			$Faccp = $adeal->getCodePostal_fac ();
			$Facvil = $adeal->getVille_fac ();
		}
		
		// Email Admin et Individu
		$mailCmd = new NotificationMail ();
		
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_DEAL_CMD_FROM' );
		$mailCmd->setFrom ( $aParam->getValue () );
		$mailCmd->setHeaderReplyTo ( $aParam->getValue () );
		$mailCmd->setHeaderBcc ( 'infos@ciscar.fr' );
		// $mailCmd->setHeaderBcc('p.germain@gcrfrance.com;e-commerce@ciscar.fr');
		$mailCmd->setTo ( $adeal->getMail () );
		$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_DEAL_CMD_SUBJECT' );
		$mailCmd->setSubject ( $aParam->getValue () );
		
		$msg = '';
		$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_DEAL_CMD_BODY' );
		$msg .= stripslashes ( $aParam->getValue () );
		$msg = str_replace ( '{Nom}', utf8_decode ( $Nom ), $msg );
		$msg = str_replace ( '{Prenom}', utf8_decode ( $Prenom ), $msg );
		$msg = str_replace ( '{Login}', $Login, $msg );
		if ($LoginCli == '')
			$msg = str_replace ( '{Logincli}', '', $msg );
		else
			$msg = str_replace ( '{Logincli}', $LoginCli . '<br>', $msg );
		$msg = str_replace ( '{Mdp}', $Mdp, $msg );
		$msg = str_replace ( '{Civ}', $Civ, $msg );
		$msg = str_replace ( '{Cher}', $Cher, $msg );
		$msg = str_replace ( '{Tit}', $adeal->getTitre (), $msg );
		$msg = str_replace ( '{Dfin}', $adeal->getDateFin (), $msg );
		$msg = str_replace ( '{Qmin}', $adeal->getQuantiteMin (), $msg );
		$msg = str_replace ( '{Qcmdt}', $adeal->getQuantiteCmd (), $msg );
		$msg = str_replace ( '{Nbcmd}', $QteRest, $msg );
		$msg = str_replace ( '{Qcmdi1}', $Tabqtecmd [0], $msg );
		$msg = str_replace ( '{Qcmdi2}', $Tabqtecmd [1], $msg );
		$msg = str_replace ( '{Mtcmdi1}', $Tabmtcmd [0], $msg );
		$msg = str_replace ( '{Mtcmdi2}', $Tabmtcmd [1], $msg );
		$msg = str_replace ( '{Pxpromo}', $adeal->getPrixPromo (), $msg );
		$msg = str_replace ( '{Description}', $adeal->getDescription (), $msg );
		$msg = str_replace ( '{Mtcmdi}', $mtCmd . ' €', $msg );
		if ($adeal->getRaisonSociale_liv () == '')
			$msg = str_replace ( '{Livrs}', '', $msg );
		else
			$msg = str_replace ( '{Livrs}', utf8_decode ( $adeal->getRaisonSociale_liv () ) . '<br>', $msg );
		if ($adeal->getDestinataire_liv () == '')
			$msg = str_replace ( '{Livdest}', '', $msg );
		else
			$msg = str_replace ( '{Livdest}', utf8_decode ( $adeal->getDestinataire_liv () ) . '<br>', $msg );
		if ($adeal->getAdresse1_liv () == '')
			$msg = str_replace ( '{Livadr1}', '', $msg );
		else
			$msg = str_replace ( '{Livadr1}', utf8_decode ( $adeal->getAdresse1_liv () ) . '<br>', $msg );
		if ($adeal->getAdresse2_liv () == '')
			$msg = str_replace ( '{Livadr2}', '', $msg );
		else
			$msg = str_replace ( '{Livadr2}', utf8_decode ( $adeal->getAdresse2_liv () ) . '<br>', $msg );
		$msg = str_replace ( '{Livcp}', $adeal->getCodePostal_liv (), $msg );
		$msg = str_replace ( '{Livvil}', utf8_decode ( $adeal->getVille_liv () ), $msg );
		$msg = str_replace ( '{Dfin}', $adeal->getDateFin (), $msg );
		if ($Facrs == '')
			$msg = str_replace ( '{Facrs}', '', $msg );
		else
			$msg = str_replace ( '{Facrs}', utf8_decode ( $Facrs ) . '<br>', $msg );
		if ($Facadr1 == '')
			$msg = str_replace ( '{Facadr1}', '', $msg );
		else
			$msg = str_replace ( '{Facadr1}', utf8_decode ( $Facadr1 ) . '<br>', $msg );
		if ($Facadr2 == '')
			$msg = str_replace ( '{Facadr2}', '', $msg );
		else
			$msg = str_replace ( '{Facadr2}', utf8_decode ( $Facadr2 ) . '<br>', $msg );
		$msg = str_replace ( '{Faccp}', $Faccp, $msg );
		$msg = str_replace ( '{Facvil}', utf8_decode ( $Facvil ), $msg );
		$msg = str_replace ( '{Deal}', $lien, $msg );
		$msg = str_replace ( '{Remarque}', utf8_decode ( $adeal->getRemarque () ), $msg );
		
		$msg = str_replace ( '/userfiles/', 'http://' . $_SERVER ['HTTP_HOST'] . '/userfiles/', $msg );
		
		$mailCmd->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $msg ) . '</body></html>' );
		$mailCmd->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
		$mailCmd->setHeaderContentTransferEncoding ( '8bit' );
		
		if (! $mailCmd->send ()) {
			echo 'Mail de confirmation de commande en Erreur';
		}
	} // Fin de MailDealCmd
	private function DealCmd($DealCmdID) {
		$adeals = new Deals ();
		$adeals->SQL_select_DealCmdIDExiste ( $DealCmdID );
		// Informations générales sur le deal passé en paramètre
		$adeals->SQL_selectDeal ( $adeals->getDealsID () );
		// on décompose la date de fin du deal
		list ( $Dealdate, $Dealtime ) = explode ( " ", $adeals->getDateFin () );
		list ( $Dealyear, $Dealmonth, $Dealday ) = explode ( "-", $Dealdate );
		switch ($Dealmonth) {
			case '01' :
				$month = 'janvier';
				break;
			case '02' :
				$month = 'févier';
				break;
			case '03' :
				$month = 'mars';
				break;
			case '04' :
				$month = 'avril';
				break;
			case '05' :
				$month = 'mai';
				break;
			case '06' :
				$month = 'juin';
				break;
			case '07' :
				$month = 'juillet';
				break;
			case '08' :
				$month = 'août';
				break;
			case '09' :
				$month = 'septembre';
				break;
			case '10' :
				$month = 'octobre';
				break;
			case '11' :
				$month = 'novembre';
				break;
			case '12' :
				$month = 'décembre';
				break;
		}
		$DealDateFin = $Dealday . ' ' . $month . ' ' . $Dealyear;
		$adeals->setDateFin ( $DealDateFin );
		return $adeals;
	}
	private function DealCmdIndividu($individuID) {
		// Informations sur l'individu ayant passé commande du deal
		$aSessionSecurite = new SessionSecurite ();
		$aSessionSecurite->SQL_recupInfosUser ( $individuID );
		$aSessionSecurite->SQL_recupRoleUser ( $individuID );
		return $aSessionSecurite;
	}
	private function CheckConnexion() {
		$msg = '';
		
		if (isset ( $_POST ['logincnx'] ) && isset ( $_POST ['pwdcnx'] )) {
			$aUserName = $_POST ['logincnx'];
			$aPassword = $_POST ['pwdcnx'];
			
			$aSessionSecurite = new SessionSecurite ();
			$aresult = $aSessionSecurite->SQL_checkUser ( $aUserName, $aPassword );
			if ($aresult == 0) {
				$msg .= 'ok';
			} else {
				$msg .= 'ko';
			}
		} else {
			$msg .= 'ko';
		}
		
		return $msg;
	}
	private function CheckMailConnexion() {
		$msg = '';
		
		if (isset ( $_POST ['mailcnx'] )) {
			$aMailUser = $_POST ['mailcnx'];
			
			$aSessionSecurite = new SessionSecurite ();
			$userID = $aSessionSecurite->SQL_checkMailUser ( $aMailUser );
		} else
			$userID = 0;
		
		return $userID;
	}
}
?>