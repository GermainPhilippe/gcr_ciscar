<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage document
 * @version 1.0.4
 */
class DocumentControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'docForm' :
				if (isset ( $_GET ['id'] )) {
					switch ($_GET ['id']) {
						case 'besse' :
							if (isset ( $_POST ['Besse_Nom'] )) {
								$msg = '<b>Nom</b> : ' . $_POST ['Besse_Nom'] . '<br/>';
								$msg .= '<b>Prénom</b> : ' . $_POST ['Besse_Prenom'] . '<br/>';
								$msg .= '<b>Raison Sociale</b> : ' . $_POST ['Besse_RS'] . '<br/>';
								$msg .= '<b>Adresse</b> : ' . $_POST ['Besse_Adresse'] . '<br/>';
								$msg .= '<b>Code Postal</b> : ' . $_POST ['Besse_CP'] . '<br/>';
								$msg .= '<b>Ville</b> : ' . $_POST ['Besse_Ville'] . '<br/>';
								$msg .= '<b>Telephone</b> : ' . $_POST ['Besse_Telephone'] . '<br/>';
								$msg .= '<b>EMail</b> : ' . $_POST ['Besse_Mail'] . '<br/><hr>';
								$msg .= nl2br ( $_POST ['Besse_Chp_Libre'] ) . '<br/>';
								
								$aMail = new NotificationMail ();
								$aMail->setFrom ( 'infos@ciscar.fr' );
								$aMail->setHeaderReplyTo ( 'infos@ciscar.fr' );
								$aMail->setSubject ( 'Cabinete BESSE' );
								$aMail->setMessage ( $msg );
								$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
								$aMail->setHeaderContentTransferEncoding ( '8bit' );
								$aMail->setTo ( 'Eric.MARAIS@cabinet-besse.fr' );
								$aMail->send ();
								$aMail->setTo ( 'c.lucas@gcrfrance.com' );
								$aMail->send ();
								$aMail->setTo ( 'yves.rio@cabinet-besse.fr' );
								$aMail->send ();
								
								return $this->redirection ( '?' );
							} else {
								// ####################
								// STATS
								if (! isset ( $_SESSION ['TRACE'] )) {
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
									$traceUser->setDescriptionOut ( 'Document BESSE' );
									$traceUser->setSiteId ( '1' );
									$daoTraceUser->create ( $traceUser );
									
									$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
									$_SESSION ['TRACE_DESCRIPTION'] = 'Document BESSE';
								}
								// ####################
								
								$aDocForm_BESSE = new DocForm_BESSE ();
								return $aDocForm_BESSE->renderHTML ();
							}
							break;
					}
				}
				break;
			case 'type' :
				if (isset ( $_GET ['id'] )) {
					$tab = preg_split ( "/[\s,]+/", $_GET ['id'] );
					
					$aList = new DocInfoDynParType ();
					$aCat = new Categorie ();
					
					switch (count ( $tab )) {
						case 1 :
							$aList->SQL_select_all ( $tab [0], NULL );
							$aCat->SQL_select ( $tab [0] );
							break;
						case 2 :
							$aList->SQL_select_all ( $tab [0], $tab [1] );
							$aCat->SQL_select ( $tab [0] );
							break;
						default :
							return 'ERROR : ';
					}
					
					// ####################
					// STATS
					if (! isset ( $_SESSION ['TRACE'] )) {
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
						$traceUser->setDescriptionOut ( 'Liste document par type : ' . $aCat->getDescription () );
						$traceUser->setSiteId ( '1' );
						$daoTraceUser->create ( $traceUser );
						
						$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
						$_SESSION ['TRACE_DESCRIPTION'] = 'Liste document par type : ' . $aCat->getDescription ();
					}
					// ####################
					
					$aView = new ListeDocParTypeView ( $aList->getList (), $aCat );
					return $aView->render ();
				}
				break;
			case 'theme' :
				if (isset ( $_GET ['id'] )) {
					$aList = new CategorieList ();
					$aList->SQL_SELECT_THEME_AVEC_DOC ( $_GET ['id'] );
					$aCat = new Categorie ();
					$aCat->SQL_select ( $_GET ['id'] );
					
					// ####################
					// STATS
					if (! isset ( $_SESSION ['TRACE'] )) {
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
						$traceUser->setDescriptionOut ( 'Liste document par theme : ' . $aCat->getDescription () );
						$traceUser->setSiteId ( '1' );
						$daoTraceUser->create ( $traceUser );
						
						$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
						$_SESSION ['TRACE_DESCRIPTION'] = 'Liste document par theme : ' . $aCat->getDescription ();
					}
					// ####################
					
					$aView = new ListeThemePourUnType ( $aList->getList (), $aCat );
					return $aView->render ();
				}
				break;
			case 'docStatic' :
				if (isset ( $_GET ['id'] )) {
					$aDocStatic = new DocStatic ();
					$aDocStatic->SQL_select ( $_GET ['id'] );
					if (strlen ( $_GET ['id'] ) == 32) {
						$aDocStatic->SQL_select_By_UNID ( $_GET ['id'] );
					} else {
						$aDocStatic->SQL_select ( $_GET ['id'] );
					}
					if (in_array ( "1", $_SESSION ['CISCAR'] ['USER'] ['GROUPS'] ) || in_array ( "50", $_SESSION ['CISCAR'] ['USER'] ['GROUPS'] ) || in_array ( "51", $_SESSION ['CISCAR'] ['USER'] ['GROUPS'] )) {
					} else {
						$aStat = new StatDoc ();
						$aStat->setDocId ( $_GET ['id'] );
						$aStat->setTypeDoc ( '1' );
						$aStat->SQL_INSERT_DOC ();
					}
					// ####################
					// STATS
					if (! isset ( $_SESSION ['TRACE'] )) {
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
				break;
			case 'doc' :
				if (isset ( $_GET ['id'] )) {
					
					$aDoc = new DocInfoDyn ();
					$aDoc->SQL_select ( $_GET ['id'] );
					if (in_array ( "1", $_SESSION ['CISCAR'] ['USER'] ['GROUPS'] ) || in_array ( "50", $_SESSION ['CISCAR'] ['USER'] ['GROUPS'] ) || in_array ( "51", $_SESSION ['CISCAR'] ['USER'] ['GROUPS'] )) {
					} else {
						$aStat = new StatDoc ();
						$aStat->setDocId ( $aDoc->getID () );
						$aStat->setTypeDoc ( '0' );
						$aStat->SQL_INSERT_DOC ();
					}
					
					// ####################
					// STATS
					if (! isset ( $_SESSION ['TRACE'] )) {
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
						$traceUser->setDescriptionOut ( $aDoc->getTitre () );
						$traceUser->setSiteId ( '1' );
						$daoTraceUser->create ( $traceUser );
						
						$_SESSION ['TRACE'] = 'http://' . $_SERVER ['SERVER_NAME'] . $_SERVER ['REQUEST_URI'];
						$_SESSION ['TRACE_DESCRIPTION'] = $aDoc->getTitre ();
					}
					// ####################
					
					$aView = new DocInfoDynView ( $aDoc );
					return $aView->render ();
				}
				break;
			// OK
			case 'recherche' :
				if (isset ( $_POST ['Recherche'] )) {
					$aModele = new RechercheDocument ();
					$aView = new DocumentRechercheView ( $aModele->SQL_SEARCH ( $_POST ['Recherche'] ) );
					return $aView->renderHTML ();
				}
				break;
			case 'acces' :
				if (isset ( $_GET ['url_return'] )) {
					return $this->redirection ( 'http://' . $_SERVER ['SERVER_NAME'] . base64_decode ( $_GET ['url_return'] ) );
				} else {
					return $this->redirection ( '/index.php' );
				}
				break;
			case 'q' :
				$_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] = false;
				setcookie ( 'LoginAuto', false, - 1 );
				return $this->redirection ( '?' );
				break;
			// ### Module Commentaires ###
			case 'addComments' :
				if (isset ( $_GET ['id'] ) && isset ( $_POST ['CommentsContent'] )) {
					$aDocInfoDynCommentaire = new DocInfoDynCommentaire ();
					$aDocInfoDynCommentaire->setAuthorID ( ( int ) $_SESSION ['CISCAR'] ['USER'] ['ID'] );
					$aDocInfoDynCommentaire->setDocInfoDynID ( ( int ) $_GET ['id'] );
					$aDocInfoDynCommentaire->setDateCreation ( date ( "Y-m-d H:m:s" ) );
					$aDocInfoDynCommentaire->setRichTextContentValue ( $_POST ['CommentsContent'] );
					$aDocInfoDynCommentaire->setSiteID ( ( int ) $_SESSION ['SITE'] ['ID'] );
					$aDocInfoDynCommentaireManager = new DocInfoDynCommentaireManager ();
					$aDocInfoDynCommentaireManager->add ( $aDocInfoDynCommentaire );
					
					$aParamFROM = new Param ();
					$aParamFROM->search_param ( "CISCAR_MAIL_COMMENT_FROM" );
					$aParamSUBJECT = new Param ();
					$aParamSUBJECT->search_param ( "CISCAR_MAIL_COMMENT_SUBJECT" );
					$aParamBODY = new Param ();
					$aParamBODY->search_param ( "CISCAR_MAIL_COMMENT_BODY_1" );
					$aParamSIGNATURE = new Param ();
					$aParamSIGNATURE->search_param ( "CISCAR_MAIL_COMMENT_BODY_2" );
					
					// Notification Mail au destinataire
					$aDocInfoDynCommentaireDestinataireManager = new DocInfoDynCommentaireDestinataireManager ();
					foreach ( $aDocInfoDynCommentaireDestinataireManager->getList ( $_GET ['id'] ) as $aDestinataire ) {
						$aIndividu = new Individu ();
						$aIndividu->SQL_SELECT ( $aDestinataire->getIndividuID () );
						
						$aMail = new NotificationMail ();
						$aMail->setFrom ( $aParamFROM->getValue () );
						$aMail->setTo ( $aIndividu->getEmail () );
						$aMail->setSubject ( $aParamSUBJECT->getValue () );
						
						$msg = $aParamBODY->getValue ();
						$msg .= '<br/>';
						$msg .= $aIndividu->getNom () . ' ' . $aIndividu->getPrenom () . '<br/>';
						$msg .= $_POST ['CommentsContent'] . '<br/>';
						$msg .= $aParamSIGNATURE->getValue ();
						
						$aMail->setMessage ( '<html><body>' . stripslashes ( $msg ) . '</body></html>' );
						$aMail->setHeaderReplyTo ( $aParamFROM->getValue () );
						$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
						$aMail->setHeaderContentTransferEncoding ( '8bit' );
						
						if (! $aMail->send ()) {
							echo 'Mail en erreur';
						}
					}
					
					// redirection
					$aff = '<script type="text/javascript">';
					$aff .= 'document.location.href="index.php?action=doc&id=' . $_GET ['id'] . '";';
					$aff .= '</script>';
					echo $aff;
				}
				break;
			case 'viewComments' :
				if (isset ( $_GET ['id'] )) {
					$aDocInfoDynCommentaireManager = new DocInfoDynCommentaireManager ();
					$aCommentaire = $aDocInfoDynCommentaireManager->get ( ( int ) $_GET ['id'] );
					$aIndividu = new Individu ();
					$aIndividu->SQL_SELECT ( $aCommentaire->getAuthorID () );
					$aDoc = new DocInfoDyn ();
					$aDoc->SQL_select ( $aCommentaire->getDocInfoDynID () );
					$aff = '<html><head><title>' . $aDoc->getTitre () . '</title></head><body><h3>' . $aDoc->getTitre () . '</h3><br/>';
					$aff .= '<div style="border:1px solid #CCCCCC; background-color:#FFFFFC;padding:5px;">';
					$aff .= '<p><b>' . $aIndividu->getNom () . ' ' . $aIndividu->getPrenom () . '</b> :<br/>' . nl2br ( $aCommentaire->getRichTextContentValue () ) . '</p>';
					$aff .= '<hr style="border-top : dashed 1px #CCCCCC;color:#FFFFFF;">';
					$aff .= $aCommentaire->getDateCreation ();
					$aff .= '</div><br/>';
					$aff .= '<script type="text/javascript">window.print();</script>';
					$aff .= '</body></html>';
					echo $aff;
				}
				break;
			case 'viewAllComments' :
				if (isset ( $_GET ['id'] )) {
					$aDocInfoDynCommentaireManager = new DocInfoDynCommentaireManager ();
					
					$aff = '';
					
					foreach ( $aDocInfoDynCommentaireManager->getList ( ( int ) $_GET ['id'] ) as $aCommentaire ) {
						$aIndividu = new Individu ();
						$aIndividu->SQL_SELECT ( $aCommentaire->getAuthorID () );
						if ($aff == '') {
							$aDoc = new DocInfoDyn ();
							$aDoc->SQL_select ( $aCommentaire->getDocInfoDynID () );
							$aff = '<html><head><title>' . $aDoc->getTitre () . '</title></head><body><h3>' . $aDoc->getTitre () . '</h3><br/>';
						}
						$aff .= '<div style="border:1px solid #CCCCCC; background-color:#FFFFFC;padding:5px;">';
						$aff .= '<p><b>' . $aIndividu->getNom () . ' ' . $aIndividu->getPrenom () . '</b> :<br/>' . nl2br ( $aCommentaire->getRichTextContentValue () ) . '</p>';
						$aff .= '<hr style="border-top : dashed 1px #CCCCCC;color:#FFFFFF;">';
						$aff .= $aCommentaire->getDateCreation ();
						$aff .= '</div><br/>';
					}
					$aff .= '<script type="text/javascript">window.print();</script></body></html>';
					echo $aff;
				}
				break;
			case 'createsso' :
				$id = isset ( $_GET ['id'] ) ? $_GET ['id'] : $_SESSION ['SITE'] ['ID'];
				
				// Creation du token
				$ssotoken = new SSOToken ();
				$ssotoken->setDateCreation ( date ( "Y-m-d H:m:s" ) );
				$ssotoken->setUserID ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ID'] );
				$ssotoken->setSiteSource ( $_SESSION ['SITE'] ['ID'] );
				$ssotoken->setSiteDest ( $id );
				$ssotoken->setToken ( MD5 ( $ssotoken->getDateCreation () ) );
				
				$manager = new SSOTokenManager ();
				$manager->add ( $ssotoken );
				
				// Redirection
				switch ($id) {
					case 1 :
						header ( 'Location: http://www.ciscar.fr/?action=sso&token=' . $ssotoken->getToken () );
						break;
					case 2 :
						header ( 'Location: http://www.gcrfrance.com/?action=sso&token=' . $ssotoken->getToken () );
						break;
					case 3 :
						header ( 'Location: http://www.gcnf.fr/?action=sso&token=' . $ssotoken->getToken () );
						break;
					case 7 :
						header ( 'Location: http://gcre.gcrfrance.com/?action=sso&token=' . $ssotoken->getToken () );
						break;
				}
				break;
			case 'sso' :
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
							echo $this->redirection ( '?' );
						} else {
							echo $this->redirection ( '?action=acces' );
						}
					} else {
						echo $this->redirection ( '?action=acces' );
					}
				}
				break;
			default :
				echo '404';
				break;
		}
	}
	private function redirection($URL) {
		$aff = '<script type="text/javascript">';
		$aff .= 'window.location.href="' . $URL . '";';
		$aff .= '</script>';
		return $aff;
	}
}
?>