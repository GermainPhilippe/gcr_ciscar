<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage commun
 * @version 1.0.4
 */
class CommunControler {
	public function __construct() {
	}
	public function run() {
		
		$action = '';
		if (isset ( $_GET ['action'] ))
			$action = $_GET ['action'];
		if (isset ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ACTION'] ) && $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ACTION'] == 'icomV5' && $action == '')
			$action = 'icomV5';

		//si demande de confirmation des identifiants RGPD	
		if (isset ( $_GET ['action']) && stripos($_GET ['action'],'mdp2') !== false && stripos($_GET ['action'],'mdp2') == 0)
		{
			$tabconfirm = array();
			$action = 'mdp2';
			$strconfirm = substr($_GET ['action'],4);
			$strconfirm = base64_decode($strconfirm);
			$tabconfirm = explode("-&-",$strconfirm);
		}

		switch ($action) {
			case 'mdp0' :
				return $this->acces2Action ( $action );
				break;
			case 'mdp1' :
				return $this->ajaxmotdepasseLostAction ( $action );
				break;
			case 'mdp2' :
				return $this->confirmidentifiantsRgpd ($tabconfirm);
				break;
			case 'acces' :
				return $this->acces2Action ( $action );
				break;
			case 'loginIcom' :
				return $this->acces2Action ( $action );
				break;
			case 'loginGeolane' :
				return $this->acces2Action ( $action );
				break;
			case 'validate' :
				return $this->acces2Action ( $action );
				break;
			case 'icomV5' :
				return $this->acces2Action ( $action );
				break;
			case 'geolane' :
				return $this->acces2Action ( $action );
				break;
			case 'docStatic' :
				return $this->docStaticAction ();
				break;
			case 'maintenance' :
				return $this->acces2Maintenance ();
				break;
			case 'motdepasseperdu' :
				return $this->motdepasseperduAction ();
				break;
			case 'ajaxmotdepasseperdu' :
				return $this->ajaxmotdepasseperduAction ();
				break;
			case 'ajaxmotdepasseLostciscom' :
				return $this->ajaxmotdepasseLostAction ($action);
				break;
			case 'ajaxmotdepasseperduciscom' :
				return $this->ajaxmotdepasseperduActionciscom ();
				break;
			case 'ajaxmotdepasseLost' :
				return $this->ajaxmotdepasseLostAction ($action);
				break;
			case 'ajaxmotdepasseRgpdMDP0' :
				return $this->ajaxmotdepasseRgpdActionMDP0 ();
				break;
			case 'ajaxmotdepasseRgpdMDPV' :
				return $this->ajaxmotdepasseRgpdActionMDPV ();
				break;
			case 'quisommesnous' :
				$this->quisommesnous ();
				break;
			case 'attention-redirection' :
				$this->attentionredirection ();
				break;
			case 'merci' :
				$this->merci ();
				break;
			case 'nomerci' :
				$this->nomerci ();
				break;
			case 'catalogue' :
				header ( "Status: 301 Moved Permanently", false, 301 );
				header ( "Location: http://ciscar.fr/?action=quisommesnous" );
				exit ();
				break;
			case 'souscrire' :
				$this->PremiereVisiteAction ();
				break;
			case 'souscrireImprnet' :
				$this->PremiereVisiteAction ();
				break;
			case 'sso' :
				$this->SSOAction ();
				break;
			case 'q' :
				$_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] = false;
				setcookie ( 'LoginAuto', false, - 1 );
				return $this->redirection ( '?' );
				break;
			default :
				$this->defaultAction ();
				break;
		}

	}
	
	/*
	 * ###########################################
	 * METHOD
	 * ###########################################
	 */
	
	private function acces2Maintenance() 
	{
	$aConnectionView = new HomePageMaintenance ();
	return $aConnectionView->renderHTML ();
	}
	
	private function acces2Action($action) {
		$msg = '';
		
		if (isset ( $_POST ['username'] ) || isset ( $_GET ['login'] )) {
			$aSessionSecurite = new SessionSecurite ();
			$aSessionSecurite->setSiteID ( $_SESSION ['SITE'] ['ID'] );
			$aSessionSecurite->setSiteName ( $_SESSION ['SITE'] ['NAME'] );
			
			// si login et mot de passe dans querystring
			if (isset ( $_GET ['login'] )) {
				$username = $_GET ['login'];
				$password = base64_decode ( $_GET ['pwd'] );
			}
			if (isset ( $_POST ['username'] )) {
				$username = $_POST ['username'];
				$password = $_POST ['password'];
			}
			
			$result = $aSessionSecurite->SQL_checkUserInfo ( $username, $password );
			
			// Conformité RGPD
			//si le changement de mail n'est pas encore actif
			if ($result == 0 && $aSessionSecurite->getPwdUserStatut() <= 2 && $action != "mdp0" && $action != "loginIcom")
			{

				if ($aSessionSecurite->getPwdUserStatut() == -1)
				{
					//pour les nouveaux comptes on demande de renseigner les identifiants définitifs
					$msg = 'MDPV&'.$aSessionSecurite->getMailUser().'&'.$username.'&'.$password.'&'.$aSessionSecurite->getUserFullname();;
					$result = '-1';
				}					
				if ($aSessionSecurite->getPwdUserStatut() == 0)
				{
					//Le changement d'identifiants n'a pas été fait	
					$msg = 'MDP0&'.$aSessionSecurite->getMailUser().'&'.$username.'&'.$password.'&'.$aSessionSecurite->getUserFullname();
					$result = '-1';
				}
				if ($aSessionSecurite->getPwdUserStatut() == 2 && $aSessionSecurite->getLoginUser() == $username)
				{
					//La connexions continue à se faire avec les anciens identifiants
					$msg = 'MDPA&'.$aSessionSecurite->getLoginRgpd().'&'.$username.'&'.$aSessionSecurite->getPasswordRgpd().'&'.$aSessionSecurite->getUserFullname();
					$result = '-1';
				}
				if ($aSessionSecurite->getPwdUserStatut() == 1)
				{
					//Le changement d'identifiants n'a pas été confirmé
					//on recherche les identifiants RGPD de l'individu
					$aindividu = new Individu();
					$aindividu->SQL_SELECT($aSessionSecurite->getUserID());
					$msg = 'MDP1&'.$aindividu->getLoginRgpd().'&'.$username.'&'.$password.'&'.$aSessionSecurite->getUserFullname();
					$result = '-1';
				}
			}

			if ($action == "mdp0" || $action == 'loginIcom')
				$action = "icomV5";
				
			switch ($result) {
				case '-1' :
					break;
				case '0' :
					
					// Creation du cookies
					if (isset ( $_POST ['loginAuto'] )) {
						setcookie ( 'LoginAuto', base64_encode ( $username . '&' . $password ), time () + 1296000 ); // 24h
					}
					// acces autologin sur ICOM
					if ($action == 'loginIcom') {
						return $this->redirection ( 'http://' . $_SERVER ['SERVER_NAME'] . '/modules/AutoLogin/?type=ecommerce' );
					}
					
					// acces autologin sur GEOLANE
					if ($action == 'loginGeolane') {
						$action = "geolane";
					}
					
					if (isset ( $_GET ['url_return'] ) && $action != 'icomV5') {
						return $this->redirection ( 'http://' . $_SERVER ['SERVER_NAME'] . base64_decode ( $_GET ['url_return'] ) );
					} else {
						// On verifie que ce n'est pas un utilisateur belge si oui on redirige vers son portail avec autologin par token
						if ($aSessionSecurite->SQL_checkUserBe ( $_SESSION ['CISCAR'] ['USER'] ['ID'] )) {
							// On le dedonnecte de ciscar.fr
							$_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] = false;
							setcookie ( 'LoginAuto', false, - 1 );
							// Creation du token
							$ssotoken = new SSOToken ();
							$ssotoken->setDateCreation ( date ( "Y-m-d H:m:s" ) );
							$ssotoken->setUserID ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ID'] );
							$ssotoken->setSiteSource ( $_SESSION ['SITE'] ['ID'] );
							$ssotoken->setSiteDest ( 1 );
							$ssotoken->setToken ( MD5 ( $ssotoken->getDateCreation () ) );

							$manager = new SSOTokenManager ();
							$manager->add ( $ssotoken );
							
							// On redirige ver ciscar.be														
							//header ( 'Location: http://ciscarbelge.local/fr/index.php?action=sso&token=' . $ssotoken->getToken () );
							header ( 'Location: http://www.ciscar.be/fr/index.php?action=sso&token=' . $ssotoken->getToken () );
						} else {
							// IcomV5
							if ($action == 'icomV5' || $action == 'geolane') {
								$aParam = new Param ();
								$aSessionSecurite->SQL_recupInfosUser ( $aSessionSecurite->getUserID () );
								$aSessionSecurite->SQL_recupRoleUser ( $aSessionSecurite->getUserID () );
								$loginCode = $aSessionSecurite->getLoginCli ();
								$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_E-COMMERCE_CLEF_AUTOLOGIN' );
								
								$clefAutologin = $aParam->getValue ();
								$loginType = '2';
								if ($action == 'geolane')
									$loginType = '3';
								$actionMode = 'autoLogin';
								$loginGCR = $aSessionSecurite->getLoginUser();
								$stamp = date ( 'Y-m-d H:i:s' ); // yyyy-mm-dd hh:mm:ss GMT
								$stampWEB = date ( 'Y-m-d%20H:i:s' );
								$signature = MD5 ( $loginType . $loginCode . $stamp . $clefAutologin ); // MD5 32 CHARS
								
								if ($action == 'geolane')
									$URL = 'http://ciscar-prod.geolane.fr/extranet/securite/auto-login.html';
								else
								{
									if (strpos ($_SERVER["HTTP_REFERER"] , "https") === false)
										$URL = 'https://e-commerce.ciscar.fr/localisation/ciscar/ciscarin.aspx';
									else
										$URL = 'https://e-commerce.ciscar.fr/localisation/ciscar/ciscarin.aspx';
								}
								
									// $URL = 'http://int-cpfrv5-1.i-comsoftware.com/localisation/ciscar/ciscarin.aspx';
									// $URL = 'http://ciscar.channel-portal.com/ciscarIn.asp';
								$params = '?action=' . $actionMode;
								$params .= '&loginCode=' . $loginCode;
								$params .= '&loginType=' . $loginType;
								$params .= '&stamp=' . $stampWEB;
								$params .= '&signature=' . $signature;
								$params .= '&contactCode=' . $loginGCR;
								if ($action == 'geolane') {
									if (isset ( $_GET ['idProduct'] ) && $_GET ['idProduct'] != "")
										$params .= '&idArticle=' . $_GET ['idProduct'];
									else
										$params .= '&page=acc';
								} else {
									if (isset ( $_GET ['idProduct'] ) && $_GET ['idProduct'] != "")
										$params .= '&idProduct=' . $_GET ['idProduct'];
									if (isset ( $_GET ['idCategory'] ) && $_GET ['idCategory'] != "")
										$params .= '&idCategory=' . $_GET ['idCategory'];
									if (isset ( $_GET ['promo'] ) && $_GET ['promo'] == "on")
									{
										if (strpos ($_SERVER["HTTP_REFERER"] , "https") === false)
											$URL = 'http://ecommerce.ciscar.fr/catalogue/catproductlist2.aspx?chkpromo=on';
										else
											$URL = 'https://e-commerce.ciscar.fr//catalogue/catproductlist2.aspx?chkpromo=on';
										$params = str_replace('?', '&', $params);
									}
								}
								
								$_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ACTION'] = 'icomV5';
								$_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['URL'] = $URL . $params;
								
								// if ($action == 'geolane')
								// {
								//print ($URL.$params);
								//die();
								// }

								return $this->redirection ( $URL . $params );
								
							} else {
								unset ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ACTION'] );
								return $this->redirection ( '/index.php' );
							}
						}
					}
					break;
				case '1' :
					
					// Suppression du Cookies
					unset ( $_COOKIE ['LoginAuto'] );
					
					$msg = '<font color="red">Saisie Incorrecte</font>';
					
					// Email Admin
					$mailAdmin = new NotificationMail ();
					
					$aParam = new Param ();
					$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
					$mailAdmin->setFrom ( $aParam->getValue () );
					$mailAdmin->setTo ( $aParam->getValue () );
					$mailAdmin->setSubject ( '[CISCAR] Login NOK' );
					
					$msgMail = "Erreur lors de la connexion au site CISCAR<br>";
					$msgMail .= "=============================================================<br>";
					$msgMail .= "Login : " . $username . '<br>';
					$msgMail .= "Password : " . $password . '<br>';
					$msgMail .= "=============================================================<br>";
					$msgMail .= "The Mail Server<br>";
					$msgMail .= "<a href='www.ciscar.fr'><input type='image' src='http://" . $_SERVER ['SERVER_NAME']."/include/images/logo_ciscar.png' alt='ciscar'></a>";
					
					$mailAdmin->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . $msgMail . '</body></html>' );
					$mailAdmin->setHeaderReplyTo ( $aParam->getValue () );
					$mailAdmin->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
					$mailAdmin->setHeaderContentTransferEncoding ( '8bit' );
					if (! $mailAdmin->send ()) {
						echo 'Message en Erreur';
					}
					
					break;
				case '2' :
					$msg = '<font color="red">Compte d&eacute;sactiv&eacute; ou absence de rôle.</font>';
					break;
			}
		} 
		else
		{
			if (isset ( $_COOKIE ['LoginAuto'] )) {
			$tab = explode ( '&', base64_decode ( $_COOKIE ['LoginAuto'] ), 2 );
			
			$aff = '<form method="post">';
			$aff .= '<input type="hidden" name="username" value="' . $tab [0] . '">';
			$aff .= '<input type="hidden" name="password" value="' . $tab [1] . '">';
			$aff .= '</form>';
			$aff .= '<script>document.forms[0].submit();</script>';
			echo $aff;
			}
		}
		// ####################
		// STATS
		if (! isset ( $_SESSION ['TRACE'] ) ) {
			$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . '/';
			$_SESSION ['TRACE_DESCRIPTION'] = 'Acceuil';
		} else {
			$daoTraceUser = new TraceUserDAO ();
			$traceUser = new TraceUser ();

			if (isset ( $_SESSION ['CISCAR'] ) && $_SESSION ['CISCAR'] ['USER'] ['CONNECTED']) {
				$traceUser->setUserId ( $_SESSION ['CISCAR'] ['USER'] ['ID'] );
			}

			$traceUser->setUrlIn ( $_SESSION ['TRACE'] );
			$traceUser->setDescriptionIn ( $_SESSION ['TRACE_DESCRIPTION'] );
			$traceUser->setUrlOut ( 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'] );
			$traceUser->setDescriptionOut ( 'Formulaire de connexion' );
			$traceUser->setSiteId ( '1' );

			$daoTraceUser->create ( $traceUser );
			
			$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
			$_SESSION ['TRACE_DESCRIPTION'] = 'Formulaire de connexion';
		}
		
		// ####################
		if ($action == 'icomV5') {
			if (isset ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ACTION'] ) && $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ACTION'] == 'icomV5') {
				if (strpos ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['URL'], 'geolane' ) !== false)
					return $this->redirection ( '/index.php?action=q' );
				else
					return $this->redirection ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['URL'] );
			}
		}

		unset ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ACTION'] );
		
		//si appel depuis RENAULT NET pour imprimés RENAULT
		if(isset ( $_GET ['imprnet'] ))
			$aConnectionView = new HomePageNonConnecteImprnetView ();
		else			
			$aConnectionView = new HomePageNonConnecteView ();
		
		if (isset ( $_GET ['url_return'] )) 
		{
			return $aConnectionView->renderHTML ( $msg, "&url_return=" . $_GET ['url_return'] );
		} 
		else 
		{
			if(isset ( $_GET ['ciscom'] ))
				return $aConnectionView->renderHTML ( 'ciscom' );
			else
				return $aConnectionView->renderHTML ( $msg );
		}
	}
	private function docStaticAction() {
		if (isset ( $_GET ['id'] )) {
			$aDocStatic = new DocStatic ();
			$aDocStatic->SQL_select ( $_GET ['id'] );
			
			// ####################
			// STATS
			if (! isset ( $_SESSION ['TRACE'] ) ) {
				$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . '/';
				$_SESSION ['TRACE_DESCRIPTION'] = 'Acceuil';
			} else {
				
				$daoTraceUser = new TraceUserDAO ();
				$traceUser = new TraceUser ();
				
				if (isset ( $_SESSION ['CISCAR'] ) && $_SESSION ['CISCAR'] ['USER'] ['CONNECTED']) {
					$traceUser->setUserId ( $_SESSION ['CISCAR'] ['USER'] ['ID'] );
				}
				$traceUser->setUrlIn ( $_SESSION ['TRACE'] );
				$traceUser->setDescriptionIn ( $_SESSION ['TRACE_DESCRIPTION'] );
				$traceUser->setUrlOut ( 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'] );
				$traceUser->setDescriptionOut ( $aDocStatic->getTitre () );
				$traceUser->setSiteId ( '1' );
				$daoTraceUser->create ( $traceUser );
				
				$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
				$_SESSION ['TRACE_DESCRIPTION'] = $aDocStatic->getTitre ();
			}
			// ####################
			
			$aDocStaticView = new DocStaticView ( $aDocStatic );
			return $aDocStaticView->render ();
		}
	}
	private function motdepasseperduAction() {
		$msg = '';
		
		if (isset ( $_POST ['submitButton'] )) {
			$aIndividu = new Individu ();
			$aIndividu->SQL_SELECT_Individu_MotDePassePerdu ( $_POST ['mail'] );
			if ($aIndividu->getID () != null) {
				// ok
				
				// Email Admin
				$mailAdmin = new NotificationMail ();
				
				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
				$mailAdmin->setFrom ( $aParam->getValue () );
				$mailAdmin->setTo ( $aParam->getValue () );
				$mailAdmin->setSubject ( '[CISCAR] Login NOK' );
				
				$msgMail = "Erreur lors de la connexion au site CISCAR<br>";
				$msgMail .= "=============================================================<br>";
				$msgMail .= 'Nom d\'utilisateur : ' . $aIndividu->getLogin () . '<br/>';
				$msgMail .= 'Mot de passe : ' . $aIndividu->getPassword () . '<br/>';
				$msgMail .= "Mail : " . $_POST ['mail'] . '<br>';
				$msgMail .= "=============================================================<br>";
				$msgMail .= "The Mail Server<br>";
				
				$mailAdmin->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . $msgMail . '</body></html>' );
				$mailAdmin->setHeaderReplyTo ( $aParam->getValue () );
				$mailAdmin->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$mailAdmin->setHeaderContentTransferEncoding ( '8bit' );
				if (! $mailAdmin->send ()) {
					echo 'Message en Erreur';
				}
				
				// Email
				$aMail = new NotificationMail ();
				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
				$aMail->setFrom ( $aParam->getValue () );
				$aMail->setTo ( $aIndividu->getEmail () );
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_SUBJECT' );
				$aMail->setSubject ( $aParam->getValue () );
				
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_BODY_1' );
				$msgMail = $aParam->getValue ();
				$msgMail .= 'Nom d\'utilisateur : ' . $aIndividu->getLogin () . '<br/>';
				$msgMail .= 'Mot de passe : ' . $aIndividu->getPassword () . '<br/>';
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_BODY_2' );
				$msgMail .= $aParam->getValue ();
				
				// Crypter le mot de passe
				$pwd = base64_encode ( $aIndividu->getPassword () );
				
				$msgMail = str_replace ( '{Login_User}', '&nclogin=' . $aIndividu->getLogin () . '&ncpwd=' . $pwd, $msgMail );
				$msgMail = str_replace ( 'loginIcom', 'loginIcom&login=' . $aIndividu->getLogin () . '&pwd=' . $pwd, $msgMail );
				
				$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">Bonjour ' . $aIndividu->getPrenom () . ' ' . $aIndividu->getNom () . ',<br/><br/>' . stripslashes ( $msgMail ) . '</body></html>' );
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
				$aMail->setHeaderReplyTo ( $aParam->getValue () );
				$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$aMail->setHeaderContentTransferEncoding ( '8bit' );
				
				if (! $aMail->send ()) {
					echo 'Message en Erreur';
				}
				$msg = '-1';
			} else {
				// KO
				$msg = 'Il n\'y a pas de compte client correspondant &agrave;<br/> l\'adresse e-mail que vous avez d&eacute;clar&eacute;e';
			}
		}
		
		// ####################
		// STATS
		if (! isset ( $_SESSION ['TRACE'] ) || ! isset ( $_SESSION ['CISCAR'] ['USER'] ['ID'])) {
			$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . '/';
			$_SESSION ['TRACE_DESCRIPTION'] = 'Acceuil';
		} else {
			
			$daoTraceUser = new TraceUserDAO ();
			$traceUser = new TraceUser ();
			
			if (isset ( $_SESSION ['CISCAR'] ) ) {
				$traceUser->setUserId ( $_SESSION ['CISCAR'] ['USER'] ['ID'] );
			}
			$traceUser->setUrlIn ( $_SESSION ['TRACE'] );
			$traceUser->setDescriptionIn ( $_SESSION ['TRACE_DESCRIPTION'] );
			$traceUser->setUrlOut ( 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'] );
			$traceUser->setDescriptionOut ( 'Formulaire mot de passe perdu' );
			$traceUser->setSiteId ( '1' );
			$daoTraceUser->create ( $traceUser );
			
			$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
			$_SESSION ['TRACE_DESCRIPTION'] = 'Formulaire mot de passe perdu';
		}
		// ####################
		
		$aMotDePassePerduView = new MotDePassePerduView ();
		return $aMotDePassePerduView->renderHTML ( $msg );
	}
	
	// ####################
	private function ajaxmotdepasseperduAction() {
		$msg = '';
		
		if (isset ( $_POST ['submitButton'] )) {
			$aIndividu = new Individu ();
			$aIndividu->SQL_SELECT_Individu_MotDePassePerdu ( $_POST ['mail'] );
			if ($aIndividu->getID () != null) {
				// ok
				
				// Email Admin
				$mailAdmin = new NotificationMail ();
				
				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
				$mailAdmin->setFrom ( $aParam->getValue () );
				$mailAdmin->setTo ( $aParam->getValue () );
				$mailAdmin->setSubject ( '[CISCAR] Login NOK' );
				
				$msgMail = "Erreur lors de la connexion au site CISCAR<br>";
				$msgMail .= "=============================================================<br>";
				$msgMail .= 'Nom d\'utilisateur : ' . $aIndividu->getLogin () . '<br/>';
				$msgMail .= 'Mot de passe : ' . $aIndividu->getPassword () . '<br/>';
				$msgMail .= "Mail : " . $_POST ['mail'] . '<br>';
				$msgMail .= "=============================================================<br>";
				$msgMail .= "The Mail Server<br>";
				
				$mailAdmin->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . $msgMail . '</body></html>' );
				$mailAdmin->setHeaderReplyTo ( $aParam->getValue () );
				$mailAdmin->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$mailAdmin->setHeaderContentTransferEncoding ( '8bit' );
				
				if (! $mailAdmin->send ()) {
					$msg .= "false";
				}
				
				// Email
				$aMail = new NotificationMail ();
				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
				$aMail->setFrom ( $aParam->getValue () );
				$aMail->setTo ( $aIndividu->getEmail () );
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_SUBJECT' );
				$aMail->setSubject ( $aParam->getValue () );
				
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_BODY_1' );
				$msgMail = $aParam->getValue ();
				$msgMail .= 'Nom d\'utilisateur : ' . $aIndividu->getLogin () . '<br/>';
				$msgMail .= 'Mot de passe : ' . $aIndividu->getPassword () . '<br/>';
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_BODY_2' );
				$msgMail .= $aParam->getValue ();
				
				// Crypter le mot de passe
				$pwd = base64_encode ( $aIndividu->getPassword () );
				
				$msgMail = str_replace ( '{Login_User}', '&nclogin=' . $aIndividu->getLogin () . '&ncpwd=' . $pwd, $msgMail );
				$msgMail = str_replace ( 'loginIcom', 'loginIcom&login=' . $aIndividu->getLogin () . '&pwd=' . $pwd, $msgMail );
				
				$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">Bonjour ' . $aIndividu->getPrenom () . ' ' . $aIndividu->getNom () . ',<br/><br/>' . stripslashes ( $msgMail ) . '</body></html>' );
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
				$aMail->setHeaderReplyTo ( $aParam->getValue () );
				$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$aMail->setHeaderContentTransferEncoding ( '8bit' );
				
				if (! $aMail->send ()) {
					$msg .= "false";
				}
				$msg .= 'ok';
			} else {
				// KO
				$msg .= 'ko';
			}
		}
		echo $msg;
	}

	private function ajaxmotdepasseperduActionciscom() {
		$msg = '';
		
		if (isset ( $_POST ['submitButton'] )) {
			$aIndividu = new Individu ();
			$aIndividu->SQL_SELECT_Individu_MotDePassePerdu ( $_POST ['mail'] );
			if ($aIndividu->getID () != null) {
				// ok
				
				// Email Admin
				$mailAdmin = new NotificationMail ();
				
				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
				$mailAdmin->setFrom ( $aParam->getValue () );
				$mailAdmin->setTo ( $aParam->getValue () );
				$mailAdmin->setSubject ( '[CISCAR] Login NOK' );
				
				$msgMail = "Demande de codes pour une connexion sur le site MARKETING Cis-Com<br>";
				$msgMail .= "======================================================================================<br>";
				$msgMail .= 'Nom d\'utilisateur : ' . $aIndividu->getLogin () . '<br/>';
				$msgMail .= 'Mot de passe : ' . $aIndividu->getPassword () . '<br/>';
				$msgMail .= "Mail : " . $_POST ['mail'] . '<br>';
				$msgMail .= "======================================================================================<br>";
				$msgMail .= "The Mail Server<br>";
				
				$mailAdmin->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . $msgMail . '</body></html>' );
				$mailAdmin->setHeaderReplyTo ( $aParam->getValue () );
				$mailAdmin->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$mailAdmin->setHeaderContentTransferEncoding ( '8bit' );
				if (! $mailAdmin->send ()) {
					echo 'Message en Erreur';
				}
				
				// Email
				$aMail = new NotificationMail ();
				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
				$aMail->setFrom ( $aParam->getValue () );
				$aMail->setTo ( $aIndividu->getEmail () );
				$aMail->setSubject ( 'Rappel de vos codes de connexion sur MARKETING Cis-Com' );
				
				$msgMail ='<p><strong>Vous trouverez ci-dessous vos codes de connexion sur <a href="http://marketing.cis-com.eu">marketing.cis-com.eu</a></strong></p>';
				$msgMail .='<p><strong>Vos codes de connexion sont :</strong></p>';
				$msgMail .= 'Nom d\'utilisateur : ' . $aIndividu->getLogin () . '<br/>';
				$msgMail .= 'Mot de passe : ' . $aIndividu->getPassword () . '<br/>';
				$msgMail .= '<p><br />
				Compte tenu de la nature des informations diffusées ces codes d\'accès sont strictement personnels et confidentiels.<br/>
				Toute commande vous engage donc personnellement.</p>
				<p>A très bientôt sur <a href="http://marketing.cis-com.eu">marketing.cis-com.eu</a></p>
				<p>----------------------------------------------------------------------------------<br />
				L\'Equipe Ciscar pour Cis-Com<br />
				<span style="font-size: 10pt">77-81 ter Rue Marcel Dassault  92100  Boulogne-Billancourt<br />
				Tél Ciscar : 01 80 05 23 23 - Tél Cis-Com : 05 65 30 04 30</span><br />
				<span style="font-size: 10pt;">Mails : <a href="mailto:infos@ciscar.fr">infos@ciscar.fr</a>&nbsp;/&nbsp;<a href="mailto:infos@feuilleafeuille.org">infos@feuilleafeuille.org</a></span> - <span style="font-size: 10pt;">Sites : <a href="http://www.ciscar.fr"><font color="#800080">www.ciscar.fr</font></a>&nbsp;/&nbsp;<a href="http://www.feuilleafeuille.org"><font color="#800080">www.feuilleafeuille.org</font></a> <br />
				----------------------------------------------------------------------------------</span></p>';
				
				$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">Bonjour ' . $aIndividu->getPrenom () . ' ' . $aIndividu->getNom () . ',<br/><br/>' . stripslashes ( $msgMail ) . '</body></html>' );
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
				$aMail->setHeaderReplyTo ( $aParam->getValue () );
				$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$aMail->setHeaderContentTransferEncoding ( '8bit' );
				
				if (! $aMail->send ()) {
					echo 'Message en Erreur';
				}
				$msg = '-1';
			} else {
				// KO
				$msg = 'Il n\'y a pas de compte client correspondant &agrave;<br/> l\'adresse e-mail que vous avez d&eacute;clar&eacute;e';
			}
		}
		
		// ####################
		// STATS
		if (! isset ( $_SESSION ['TRACE'] ) || ! isset ( $_SESSION ['CISCAR'] ['USER'] ['ID'])) {
			$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . '/';
			$_SESSION ['TRACE_DESCRIPTION'] = 'Acceuil';
		} else {
			
			$daoTraceUser = new TraceUserDAO ();
			$traceUser = new TraceUser ();
			
			if (isset ( $_SESSION ['CISCAR'] ) ) {
				$traceUser->setUserId ( $_SESSION ['CISCAR'] ['USER'] ['ID'] );
			}
			$traceUser->setUrlIn ( $_SESSION ['TRACE'] );
			$traceUser->setDescriptionIn ( $_SESSION ['TRACE_DESCRIPTION'] );
			$traceUser->setUrlOut ( 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'] );
			$traceUser->setDescriptionOut ( 'Formulaire mot de passe perdu' );
			$traceUser->setSiteId ( '1' );
			$daoTraceUser->create ( $traceUser );
			
			$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
			$_SESSION ['TRACE_DESCRIPTION'] = 'Formulaire mot de passe perdu';
		}
		// ####################
		
		$aMotDePassePerduView = new MotDePassePerduView ();
		return $aMotDePassePerduView->renderHTML ( $msg );
	}
	
	// ####################
	private function ajaxmotdepasseRgpdActionMDP0() {
		$msg = '';
		
		if (isset ( $_POST ['button-Validate'] )) {
			$aIndividu = new Individu ();
			$aIndividu->setLoginRgpd( $_POST ['mdp0mail']);
			$aIndividu->setPasswordRgpd( $_POST ['mdp0pwd1']);
			$aIndividu->setLogin( $_POST ['username']);
			$aIndividu->setPassword( $_POST ['password']);
			//On verifie si l'adresse mail utilisée comme Login RGPD existe déjà
			$aIndividu->SQL_SELECT_Valid_MailRgpd();
		
			//si le login RGPD n'existe pas
			if ($aIndividu->getnbLoginRgpd() == 0) {
				// ok
				//on met a jour les identifiants RGPD
				$aIndividu->SQL_UPDATE_individu_Rgpd();
				
				//si login RGPD est passé au statut "validé"
				if ($aIndividu->getPasswordRgpdStatut() == 2)
					$msg = 'ok';
				else
					$msg = 'false';
			}
			else 
			{
				$msg = 'ko';
			}
		}
		else 
		{
			$msg = 'false';
		}

		echo $msg;
	}

	private function ajaxmotdepasseRgpdActionMDPV() {
		$msg = '';
		
		if (isset ( $_POST ['button-Validate'] )) {
			$aIndividu = new Individu ();
			$aIndividu->setLoginRgpd( $_POST ['mdp0mail']);
			$aIndividu->setPasswordRgpd( $_POST ['mdp0pwd1']);
			$aIndividu->setLogin( $_POST ['username']);
			$aIndividu->setPassword( $_POST ['password']);
			//On verifie si l'adresse mail utilisée comme Login RGPD existe déjà
			$aIndividu->SQL_SELECT_Individu_LoginLost();

			//si le login RGPD existe 
			if ($aIndividu->getnbLoginRgpd() >=1 &&  $aIndividu->getnbLoginRgpd() <= 2) {
				// ok
				//on met a jour les identifiants RGPD
				$aIndividu->SQL_UPDATE_individu_Lost(2);
				
				//si login RGPD est passé au statut "validé"
				if ($aIndividu->getPasswordRgpdStatut() == 2)
					$msg = 'ok';
					else
						$msg = 'false';
			}
			else
			{
				$msg = 'ko';
			}
		}
		else
		{
			$msg = 'false';
		}
		
		echo $msg;
	}
	
	private function ajaxmotdepasseLostAction($action) {
		$msg = '';

		if (isset ( $_POST ['button-Validate'] ) || isset ( $_POST ['button-Envoyer'] )) 
		{
			$aIndividu = new Individu ();
			if (isset ( $_POST ['button-Validate']))
			{
				$aIndividu->setLoginRgpd( $_POST ['mdplostmail']);
				$aIndividu->setPasswordRgpd( $_POST ['mdplostpwd1']);
			}
			if (isset ( $_POST ['button-Envoyer']))
			{
				$aIndividu->setLoginRgpd( $_POST ['hidmdp1mail']);
			}
			//On verifie si l'adresse mail utilisée comme Login RGPD existe déjà
			$aIndividu->SQL_SELECT_Individu_LoginLost();
			
			//si le login RGPD n'existe pas 
			if ($aIndividu->getnbLoginRgpd() == 0) 
			{
				$msg = 'ko';
			}
			//si le login RGPD est attribué à plusieurs individus
			if ($aIndividu->getnbLoginRgpd() > 2) 
			{
				$msg = 'ko+';
			}
			else
			{
				if($msg == ''  )
				{
					if( $action == 'ajaxmotdepasseLost' || $action == 'ajaxmotdepasseLostciscom')
					{
						//on met a jour les identifiants RGPD
						$aIndividu->SQL_UPDATE_individu_Lost(1);
						$msg = 'ok';
						if( $action == 'ajaxmotdepasseLost')
							$msg = $this->mailConfirm($aIndividu->getLoginRgpd());
						else
							$msg = $this->mailConfirmciscom($aIndividu->getLoginRgpd());
					}
					else 
					{
						if ($action == 'mdp1')
						{
							$msg = 'ok';
							$msg = $this->mailConfirm($aIndividu->getLoginRgpd());
						}
						else
							$msg = 'ok';
					}
				}
			}
		}
		else
		{
			$msg = 'false';
		}
		
		echo $msg;
	}

	private function confirmidentifiantsRgpd($tabconfirm) {
		$msg = '';

		if (count($tabconfirm) > 1)
		{
			$confirmail = strrev($tabconfirm[0]);
			//on valide la demande de confirmation
			$strconfirm = hash('sha256','£mdp2$'.$confirmail.'$mdp2£');	
			if ($strconfirm == $tabconfirm[1])
			{
				$msg = 'ok';
			}
			else 
				$msg = 'ko';
		}
		else 
			$msg = 'ko';
		
		if ($msg == 'ok')
		{
			$msg = '';
			$aIndividu = new Individu ();
			$aIndividu->setLoginRgpd($confirmail);

			//On verifie si l'adresse mail utilisée comme Login RGPD existe déjà
			$aIndividu->SQL_SELECT_Individu_LoginLost();
			
			//si le login RGPD n'existe pas
			if ($aIndividu->getnbLoginRgpd() == 0)
			{
				$msg = 'ko';
			}
			//si le login RGPD est attribué à plusieurs individus
			if ($aIndividu->getnbLoginRgpd() > 2)
			{
				$msg = 'ko+';
			}
			else
			{
				if($msg == ''  )
				{
					//on met a jour les identifiants RGPD
					$aIndividu->SQL_UPDATE_individu_Confirm();
					$msg = 'ok';
				}
			}
		}
		$aConnectionView = new HomePageNonConnecteView ();
		if(isset($tabconfirm[2]) && $tabconfirm[2] == 'ciscom' && $msg = 'ok')
			$msg = 'okciscom';
		return $aConnectionView->renderHTML ( 'MDP2&'.$msg );
	}
	private function mailConfirm($loginRgpd) {
		$msg = '';
		
				$aIndividu = new Individu ();
				$aIndividu->setLoginRgpd($loginRgpd);
				//on prepare l'url utilisée pour confirmer le changement d'identifiants
				$url = 'http://' . $_SERVER ['SERVER_NAME'].'?action=mdp2'.base64_encode(strrev($aIndividu->getLoginRgpd()).'-&-'.hash('sha256','£mdp2$'.$aIndividu->getLoginRgpd().'$mdp2£'));
				// Email Admin
				$mailAdmin = new NotificationMail ();
				
				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
				$mailAdmin->setFrom ( $aParam->getValue () );
				$mailAdmin->setTo ( $aIndividu->getLoginRgpd() );
				$mailAdmin->setHeaderBcc ( $aParam->getValue () );
				$mailAdmin->setSubject ( '[CISCAR] Merci de confirmer la modification de votre mot de passe' );
				
				$msgMail = "Cher client,<br>";
				$msgMail .= "<br>";
				$msgMail .= 'Vous avez modifié votre mot de passe sur <a href="www.ciscar.fr">www.ciscar.fr</a>.<br/><br/>';
				$msgMail .= 'Vous devez encore <a href="'.$url.'">valider votre nouveau mot de passe</a> pour profiter de tous les services de votre compte CISCAR.<br/><br/>';
				$msgMail .= 'Pour vous connecter, utilisez votre adresse mail et le mot de passe que vous avez renseigné.<br/><br/>';
				$msgMail .= "<i>Si vous n'êtes pas à l'origine de cette demande, veuillez nous en <a href='mailto:p.germain@gcrfrance.com'>informer</a> rapidement et modifier vos codes d'accès sur ciscar.fr</i><br><br>";
				$msgMail .= "Merci de votre confiance.<br><br>";
				$msgMail .= "<a href='www.ciscar.fr'><input type='image' src='HTTP://" . $_SERVER ['SERVER_NAME']."/include/images/logo_ciscar.png' alt='ciscar'></a>";
				
				$mailAdmin->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . $msgMail . '</body></html>' );
				$mailAdmin->setHeaderReplyTo ( $aParam->getValue () );
				$mailAdmin->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$mailAdmin->setHeaderContentTransferEncoding ( '8bit' );
				
				//print $msgMail;
				//die();
				if (! $mailAdmin->send ()) 
					$msg = "false";
				else				
					$msg = 'ok';
		return $msg;
	}

	private function mailConfirmciscom($loginRgpd) {
		$passage_ligne = "\r\n";
		
		$msg = '';
		
		$aIndividu = new Individu ();
		$aIndividu->setLoginRgpd($loginRgpd);
		//on prepare l'url utilisée pour confirmer le changement d'identifiants
		$url = 'http://' . $_SERVER ['SERVER_NAME'].'?action=mdp2'.base64_encode(strrev($aIndividu->getLoginRgpd()).'-&-'.hash('sha256','£mdp2$'.$aIndividu->getLoginRgpd().'$mdp2£').'-&-ciscom');
		// Email Admin
		$mailAdmin = new NotificationMail ();
		
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
		$mailAdmin->setFrom ( $aParam->getValue () );
		$mailAdmin->setTo ( $aIndividu->getLoginRgpd() );
		$mailAdmin->setHeaderBcc ( $aParam->getValue () );
		$mailAdmin->setSubject ( '[MARKETING Cis-Com] Merci de confirmer la modification de votre mot de passe' );
		
		$msgMail = "Cher client,<br>";
		$msgMail .= "<br>";
		$msgMail .= 'Vous avez modifié votre mot de passe sur <a href="www.ciscar.fr">www.ciscar.fr</a>.<br/><br/>';
		$msgMail .= 'Vous devez encore <a href="'.$url.'">valider votre nouveau mot de passe</a> pour profiter de tous les services de votre compte.<br/><br/>';
		$msgMail .= 'Pour vous connecter sur <a href="ciscar.fr">ciscar.fr</a> ou <a href="marketing.cis-com.eu">marketing.cis-com.eu</a>, utilisez votre adresse mail et le mot de passe que vous avez renseigné.<br/><br/>';
		$msgMail .= "<i>Si vous n'êtes pas à l'origine de cette demande, veuillez nous en <a href='mailto:p.germain@gcrfrance.com'>informer</a> rapidement et modifier vos codes d'accès sur ciscar.fr</i><br><br>";
		$msgMail .= "Merci de votre confiance.<br><br>".$passage_ligne;
		$msgMail .= "<table><tr><td>";
		$msgMail .= "<a href='www.marketing.cis-com.eu'><input type='image' src='http://" . $_SERVER ['SERVER_NAME']."/include/images/logo_Ciscom_2018.png' alt='ciscom'></a></td></tr></table>";
		
		$mailAdmin->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . $msgMail . '</body></html>' );
		$mailAdmin->setHeaderReplyTo ( $aParam->getValue () );
		$mailAdmin->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
		$mailAdmin->setHeaderContentTransferEncoding ( '8bit' );
		
		//print $msgMail;
		//die();
		if (! $mailAdmin->send ())
			$msg = "false";
		else
			$msg = 'ok';
			return $msg;
	}
	// ####################
	private function quisommesnous() {
		$aDoc_PremiereVisite = new Doc_QuiSommesNous ();
		echo $aDoc_PremiereVisite->render2HTML ();
	}
	// ####################
	private function attentionredirection() {
		$aDoc_PremiereVisite = new Doc_AttentionRedirection ();
		echo $aDoc_PremiereVisite->render2HTML ();
	}
	// ####################
	private function merci() {
		$aConnectionView = new HomePageNonConnecteView ();
		if (isset ( $_GET ['url_return'] )) {
			return $aConnectionView->renderHTML ( 'merci', "&url_return=" . $_GET ['url_return'] );
		} else {
			return $aConnectionView->renderHTML ( 'merci' );
		}
		//$aDoc_PremiereVisite = new Doc_Merci ();
		//echo $aDoc_PremiereVisite->render2HTML ();
	}
	// ####################
	private function nomerci() {
		$aConnectionView = new HomePageNonConnecteView ();
		if (isset ( $_GET ['url_return'] )) {
			return $aConnectionView->renderHTML ( 'nomerci', "&url_return=" . $_GET ['url_return'] );
		} else {
			return $aConnectionView->renderHTML ( 'nomerci' );
		}
		//$aDoc_PremiereVisite = new Doc_Merci ();
		//echo $aDoc_PremiereVisite->render2HTML ();
	}
	
	// ####################
	private function catalogueAction() {
		if (isset ( $_POST ['pNom'] )) {
			$aDocFormCatalogueModel = new DocFormCatalogueModel ();
			$aDocFormCatalogueModel->setNom ( $_POST ['pNom'] );
			$aDocFormCatalogueModel->setPrenom ( $_POST ['pPrenom'] );
			$aDocFormCatalogueModel->setTelephone ( $_POST ['pTelephone'] );
			$aDocFormCatalogueModel->setMail ( $_POST ['pMail'] );
			$aDocFormCatalogueModel->save ();
			
			// Redirection
			echo $this->redirection ( '?' );
		} else {
			// ####################
			// STATS
			if (! isset ( $_SESSION ['TRACE'] ) || ! isset ( $_SESSION ['CISCAR'] ['USER'] ['ID'])) {
				$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . '/';
				$_SESSION ['TRACE_DESCRIPTION'] = 'Acceuil';
			} else {
				
				$daoTraceUser = new TraceUserDAO ();
				$traceUser = new TraceUser ();
				
				if (isset ( $_SESSION ['CISCAR'] ) ) {
					$traceUser->setUserId ( $_SESSION ['CISCAR'] ['USER'] ['ID'] );
				}
				$traceUser->setUrlIn ( $_SESSION ['TRACE'] );
				$traceUser->setDescriptionIn ( $_SESSION ['TRACE_DESCRIPTION'] );
				$traceUser->setUrlOut ( 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'] );
				$traceUser->setDescriptionOut ( 'Catalogue' );
				$traceUser->setSiteId ( '1' );
				$daoTraceUser->create ( $traceUser );
				
				$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
				$_SESSION ['TRACE_DESCRIPTION'] = 'Catalogue';
			}
			// ####################
			
			$aview = new DocFormCatalogue ();
			echo $aview->renderHTML ();
		}
	}
	private function PremiereVisiteAction() {
		if (isset ( $_POST ['submitButton'] )) {
			
			//on verifie que l'adresse mail RGPD renseignée n'exista pas déjà
			$aindividu = new Individu();
			$aindividu->setLoginRgpd($_POST ['pMail']);
			$aindividu->SQL_SELECT_Valid_MailRgpd();
			
			//si le mail  Rgpd n'existe pas, on autorise le demande d'inscription
			if ($aindividu->getnbLoginRgpd() == 0)
			{
				// Sauvegarde en base de données de la demande d'inscription
				$InscriptionSite = new InscriptionSite ();
				$InscriptionSite->setNom ( utf8_decode ( trim ( $_POST ['pNom'] ) ) );
				$InscriptionSite->setPrenom ( utf8_decode ( trim ( $_POST ['pPrenom'] ) ) );
				$InscriptionSite->setAdresse ( utf8_decode ( trim ( $_POST ['pAdresse1'] ) ) );
				if (isset($_POST ['pAdresse2']))
					$InscriptionSite->setComplementAdresse ( utf8_decode ( trim ( $_POST ['pAdresse2'] ) ) );
				else
					$InscriptionSite->setComplementAdresse ('');
				$InscriptionSite->setCodePostal ( trim ( $_POST ['pCodePostal'] ) );
				$InscriptionSite->setVille ( utf8_decode ( trim ( $_POST ['pVille'] ) ) );
				$InscriptionSite->setNumeroTelephone ( trim ( $_POST ['pTelephone'] ) );
				$InscriptionSite->setNumeroMobile ( trim ( $_POST ['pPortable'] ) );
				//if (isset($_POST ['pFax']))
				//	$InscriptionSite->setNumeroFax ( trim ( $_POST ['pFax'] ) );
				//else
				$InscriptionSite->setNumeroFax ('');
				$InscriptionSite->setCodeClientCiscar ( '' );
				if (isset($_POST ['pNumSiret']))
					$InscriptionSite->setNumeroSiret ( trim ( $_POST ['pNumSiret'] ) );
				else
					$InscriptionSite->setNumeroSiret ('');
				$InscriptionSite->setRaisonSociale ( utf8_decode ( trim ( $_POST ['pRaisonSociale'] ) ) );
				if (isset($_POST ['pCategorie']))
					$InscriptionSite->setCategorie ( utf8_decode ( trim ( $_POST ['pCategorie'] ) ) );
				else
					$InscriptionSite->setCategorie ('');
				if (isset($_POST ['pMarque']))
					$InscriptionSite->setVotreMarqueDistribuee ( utf8_decode ( trim ( $_POST ['pMarque'] ) ) );
				else
					$InscriptionSite->setVotreMarqueDistribuee ( '' );
				$InscriptionSite->setAdresseMail ( trim ( $_POST ['pMail'] ) );
				$InscriptionSite->setFonction ( utf8_decode ( trim ( $_POST ['pFonction'] ) ) );
				$InscriptionSite->setGroupe ( '' );
				$InscriptionSite->setDateDemande ( date ( "Y-m-d H:m:s" ) );
				
				$InscriptionSite->SQL_CREATE_OUV ();
				
				// Creation du mail pour l'administrateur
				
				$msgMail = '';
				$msgMail .= '<b>Nom</b> :' . trim ( utf8_decode ( $_POST ['pNom'] ) ) . '<br/>';
				$msgMail .= '<b>Pr&eacute;nom</b> :' . trim ( utf8_decode ( $_POST ['pPrenom'] ) ) . '<br/>';
				$msgMail .= '<b>Adresse Mail</b> :' . trim ( $_POST ['pMail'] ) . '<br/>';
				$msgMail .= '<b>Fonction</b> :' . trim ( utf8_decode ( $_POST ['pFonction'] ) ) . '<br/>';
				if (isset($_POST ['pMarque']))
					$msgMail .= '<b>Marque(s)</b> :' . trim ( utf8_decode ( $_POST ['pMarque'] ) ) . '<br/>';
				if (isset($_POST ['pCategorie']))
					$msgMail .= '<b>Categorie</b> :' . trim ( utf8_decode ( $_POST ['pCategorie'] ) ) . '<br/>';
				$msgMail .= '<b>Raison Sociale</b> :' . trim ( utf8_decode ( $_POST ['pRaisonSociale'] ) ) . '<br/>';
				// $msgMail .= '<b>Groupe</b> :' . trim ( $_POST ['pGroupe'] ) . '<br/>';
				if (isset($_POST ['pNumSiret']))
					$msgMail .= '<b>Num&eacute;ro SIRET</b> :' . trim ( $_POST ['pNumSiret'] ) . '<br/>';
				// $msgMail .= '<b>Code Client CISCAR</b> :' . trim ( $_POST ['pCodeClientCISCAR'] ) . '<br/>';
				$msgMail .= '<b>Adresse</b> :' . trim ( utf8_decode ( $_POST ['pAdresse1'] ) ) . '<br/>';
				if (isset($_POST ['pAdresse2']))
					$msgMail .= '<b>Compl&eacute;ment d\'adresse</b> :' . trim ( utf8_decode ( $_POST ['pAdresse2'] ) ) . '<br/>';
				$msgMail .= '<b>Code postal</b> :' . trim ( $_POST ['pCodePostal'] ) . '<br/>';
				$msgMail .= '<b>Ville</b> :' . trim ( utf8_decode ( $_POST ['pVille'] ) ) . '<br/>';
				$msgMail .= '<b>Num&eacute;ro de t&eacute;l&eacute;phone</b> :' . trim ( $_POST ['pTelephone'] ) . '<br/>';
				$msgMail .= '<b>Num&eacute;ro de mobile</b> :' . trim ( $_POST ['pPortable'] ) . '<br/>';
				//if (isset($_POST ['pFax']))
				//	$msgMail .= '<b>Num&eacute;ro de fax</b> :' . trim ( $_POST ['pFax'] ) . '<br/>';
				
				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_MAIL_LOGIN_FROM' );
				
				$aMail = new NotificationMail ();
				$aMail->setFrom ( $aParam->getValue() );
				$aMail->setHeaderReplyTo ( $aParam->getValue() );
				// si la marque n'est pas présente dans le formulaire, cela indique que la demande d'inscription est une demande IMPRIMES RNET
				if (!isset($_POST ['pMarque']))
					$aMail->setSubject ( 'Demande de connexion au portail CISCAR.FR/IMPRNET' );
				else
					$aMail->setSubject ( 'Demande de connexion au portail CISCAR.FR' );
				$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . $msgMail . '</body></html>' );
				$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$aMail->setHeaderContentTransferEncoding ( '8bit' );
				$aMail->setTo ( $aParam->getValue() );
				//$aMail->setTo ( 'p.germain@ciscar.fr' );
				// Si KBIS renseigner le mettre en pièce jointe du mail
				if (isset ($_FILES['kbis'] ['tmp_name']) && $_FILES['kbis'] ['tmp_name'] != '')
				{
					$aMail->addAttachment($_FILES['kbis'] ['type'], $_FILES['kbis'] ['name'], $_FILES['kbis'] ['tmp_name']);
				}
				// Si RIB renseigner le mettre en pièce jointe du mail
				if (isset ($_FILES['rib'] ['tmp_name']) && $_FILES['rib'] ['tmp_name'] != '')
				{
					$aMail->addAttachment($_FILES['rib'] ['type'], $_FILES['rib'] ['name'], $_FILES['rib'] ['tmp_name']);
				}
	
				$aMail->send ();
				
				// Creation du mail pour le demandeur
				
				$msgMail = 'Madame, Monsieur,<br/><br/>';
				$msgMail .= 'Votre demande d\'acc&egrave;s au Portail CISCAR est prise en compte et sera trait&eacute;e dans les 24 heures.<br/><br/>';
				$msgMail .= "Vous recevrez prochainement à l'adresse <b>".trim ( $_POST ['pMail'] )."</b>, vos codes de connexion temporaires.<br/>";
				$msgMail .= '<br/>';
				$msgMail .= 'Cordialement,<br/>Les Equipes de CISCAR<br>';
				$msgMail .= "<a href='www.ciscar.fr'><input type='image' src='http://" . $_SERVER ['SERVER_NAME']."/include/images/logo_ciscar.png' alt='ciscar'></a>";
				$aMail = new NotificationMail ();
				$aMail->setFrom ( $aParam->getValue() );
				$aMail->setHeaderReplyTo ( $aParam->getValue() );
				$aMail->setSubject ( 'Demande de connexion au portail CISCAR.FR' );
				$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . $msgMail . '</body></html>' );
				$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$aMail->setHeaderContentTransferEncoding ( '8bit' );
				$aMail->setTo ( trim ( $_POST ['pMail'] ) );
				$aMail->send ();
				
				echo $this->redirection ( '?action=merci' );
			}
			else 
			{
				$aConnectionView = new HomePageNonConnecteView ();				
				return $aConnectionView->renderHTML ( 'nomerci' );		
				//echo $this->redirection ( '?action=nomerci' );
			}
		} else {
			// ####################
			// STATS
			if (! isset ( $_SESSION ['TRACE'] )|| ! isset ( $_SESSION ['CISCAR'] ['USER'] ['ID'])) {
				$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . '/';
				$_SESSION ['TRACE_DESCRIPTION'] = 'Acceuil';
			} else {
				
				$daoTraceUser = new TraceUserDAO ();
				$traceUser = new TraceUser ();
				
				if (isset ( $_SESSION ['CISCAR'] )) {
					$traceUser->setUserId ( $_SESSION ['CISCAR'] ['USER'] ['ID'] );
				}
				$traceUser->setUrlIn ( $_SESSION ['TRACE'] );
				$traceUser->setDescriptionIn ( $_SESSION ['TRACE_DESCRIPTION'] );
				$traceUser->setUrlOut ( 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'] );
				$traceUser->setDescriptionOut ( 'Premiere Visite' );
				$traceUser->setSiteId ( '1' );
				$daoTraceUser->create ( $traceUser );
				
				$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
				$_SESSION ['TRACE_DESCRIPTION'] = 'Premiere Visite';
			}
			// ####################
			
			if (isset($_GET['action']) && $_GET['action'] == 'souscrireImprnet' )
			{
				$aDoc_PremiereVisiteImprnet = new Doc_PremiereVisiteImprnet() ;
				echo $aDoc_PremiereVisiteImprnet->render2HTML ();
			}
			else 
			{
				$aDoc_PremiereVisite = new Doc_PremiereVisite ();
				echo $aDoc_PremiereVisite->render2HTML ();
			}
		}
	}
	private function SSOAction() {
		if (isset ( $_GET ['token'] )) {
			$manager = new SSOTokenManager ();
			if ($manager->check ( $_GET ['token'] )) {
				$ssotoken = $manager->get ( $_GET ['token'] );
				$Individu = new Individu ();
				$_SESSION ['SITE'] ['ID'] = $ssotoken->getSiteSource ();
				$Individu->SQL_SELECT ( $ssotoken->getUserID () );
				$_SESSION ['SITE'] ['ID'] = $ssotoken->getSiteDest ();
				
				$aSessionSecurite = new SessionSecurite ();
				$aSessionSecurite->setSiteID ( $_SESSION ['SITE'] ['ID'] );
				$aSessionSecurite->setSiteName ( $_SESSION ['SITE'] ['NAME'] );
				
				$result = $aSessionSecurite->SQL_checkUserInfo ( $Individu->getLogin (), $Individu->getPassword () );
				
				if ($_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED']) {
					$manager->delete ( $ssotoken->getID () );
					echo $this->redirection ( '?login='.$Individu->getLogin ().'&pwd='.base64_encode($Individu->getPassword ()) );
				} else {
					echo $this->redirection ( '?login='.$Individu->getLogin ().'&pwd='.base64_encode($Individu->getPassword ()) );
				}
			} else {
				echo $this->redirection ( '?action=acces' );
			}
		}
	}
	private function defaultAction() {
		if (isset ( $_GET ["login"] )) 
		{
			$request_uri = $_SERVER ['REQUEST_URI'];
			// pour ne pas comptabiliser 2 fois un clik dans les stats de Newsletter ou suppirme de 'uri
			// un des paramètres qui permet d'enregistrer les stats
			$request_uri = str_replace ( '&env', '&noenv', $request_uri );
			
			$pos = strpos ( $request_uri, '?login' );
			if ($pos)
				list ( $uri, $uid ) = explode ( "?login", $request_uri );
			else
				list ( $uri, $uid ) = explode ( "&login", $request_uri );
				
				// recuperation de l'identifiant du produit
			if (isset ( $_GET ["idProduct"] ) && $_GET ["idProduct"] != "") 
			{
				echo $this->redirection ( 'index.php?action=icomV5&login' . $uid . '&idProduct=' . $_GET ["idProduct"] . '&url_return=' . base64_encode ( $uri ) );
			} 
			else 
			{
				if (isset ( $_GET ["idCategory"] ) && $_GET ["idCategory"] != "")
				{
					echo $this->redirection ( 'index.php?action=icomV5&login' . $uid . '&idCategory=' . $_GET ["idCategory"] . '&url_return=' . base64_encode ( $uri ) );
				}
				else 
				{
					if (isset ( $_GET ["promo"] ) && $_GET ["promo"] == "on")
					{
						echo $this->redirection ( 'index.php?action=icomV5&login' . $uid . '&promo=on&url_return=' . base64_encode ( $uri ) );
					}
					else
					{
						echo $this->redirection ( 'index.php?action=icomV5&login' . $uid . '&url_return=' . base64_encode ( $uri ) );
					}
				}
			}
		} 
		else 
		{
			echo $this->redirection ( 'index.php?action=acces&url_return=' . base64_encode ( $_SERVER ['REQUEST_URI'] ) );
		}
	}
	public function message($msg) {
		$aff = '<script type="text/javascript">';
		$aff .= 'alert(\'' . $msg . '\');';
		$aff .= '</script>';
		echo $aff;
	}
	public function openWindows($url) {
		$aff = '<script type="text/javascript">';
		$aff .= 'window.open("' . $url . '" ,"fenetre","scrollbars=yes,scrolling=yes,location=no,toolbar=no");';
		$aff .= '</script>';
		echo $aff;
	}
	public function redirection($url) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href="' . $url . '";';
		$aff .= '</script>';
		echo $aff;
	}
}
?>