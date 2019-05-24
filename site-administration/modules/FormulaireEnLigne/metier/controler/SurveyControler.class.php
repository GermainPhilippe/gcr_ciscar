<?php
class SurveyControler {
	public function run() {
		switch ($_GET ['action']) {
			// ### GESTION des FORMULAIRES ###
			case 'newSurvey' :
				if (isset ( $_POST ['submitButton'] )) {
					$aSurvey = new Survey ();
					$aSurvey->setName ( $_POST ['pName'] );
					$aSurvey->setEnvoiInvitation ( '0' );
					$aSurvey->setEnvoiRelance ( '0' );
					$aSurvey->setStatus ( Survey::STATUS_DRAFT );
					$aSurveyManager = new SurveyManager ();
					$aSurveyManager->add ( $aSurvey );

					$aSurveyHistoryManager = new SurveyHistoryManager ();
					$aSurveyHistory = new SurveyHistory ();
					$aSurveyHistory->setSurveyID ( ( int ) $aSurvey->getID () );
					$aSurveyHistory->setDescription ( 'Création du Formulaire' );
					$aSurveyHistoryManager->add ( $aSurveyHistory );

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aSurveyView = new SurveyView ( new Survey () );
					$aSurveyView->renderHTML ( 'new' );
				}
				break;
			case 'updateSurvey' :
				if (isset ( $_POST ['submitButton'] )) {
					$aSurveyManager = new SurveyManager ();
					$aSurvey = $aSurveyManager->get ( $_GET ['id'] );
					$aSurvey->setName ( $_POST ['pName'] );
					$aSurveyManager->update ( $aSurvey );

					$aSurveyHistoryManager = new SurveyHistoryManager ();
					$aSurveyHistory = new SurveyHistory ();
					$aSurveyHistory->setSurveyID ( ( int ) $aSurvey->getID () );
					$aSurveyHistory->setDescription ( 'Modification du Formulaire' );
					$aSurveyHistoryManager->add ( $aSurveyHistory );

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aSurveyManager = new SurveyManager ();
					$aSurveyView = new SurveyView ( $aSurveyManager->get ( $_GET ['id'] ) );
					$aSurveyView->renderHTML ( 'update' );
				}
				break;
			case 'deleteSurvey' :
				if (isset ( $_GET ['id'] )) {
					$aSurveyManager = new SurveyManager ();
					$aSurveyManager->delete ( $_GET ['id'] );

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'previewSurvey' :
				if (isset ( $_GET ['id'] )) {
					$aSurveyQuestionManager = new SurveyQuestionManager ();
					$aSurveyPreviewView = new SurveyPreview ( $aSurveyQuestionManager->getList ( $_GET ['id'] ) );
					$aSurveyPreviewView->renderHTML ();
				}
				break;
			case 'switchStatus' :
				if (isset ( $_GET ['id'] ) && isset ( $_GET ['to'] )) {
					$aSurveyManager = new SurveyManager ();
					$aSurvey = $aSurveyManager->get ( $_GET ['id'] );

					switch ($_GET ['to']) {
						case Survey::STATUS_INPROGRESS :
							$aSurvey->setStatus ( Survey::STATUS_INPROGRESS );
							$aSurveyManager->update ( $aSurvey );

							$aSurveyHistoryManager = new SurveyHistoryManager ();
							$aSurveyHistory = new SurveyHistory ();
							$aSurveyHistory->setSurveyID ( ( int ) $aSurvey->getID () );
							$aSurveyHistory->setDescription ( 'Changement du statut \'Brouillon\' &agrave; \'En Cours\'' );
							$aSurveyHistoryManager->add ( $aSurveyHistory );

							// recuperation de la liste personnes contenu dans les Liste de diffusions
							$aSurveyRecipientManager = new SurveyRecipientManager ();
							$aSurveyDraftRecipientManager = new SurveyDraftRecipientManager ();

							foreach ( $aSurveyDraftRecipientManager->getList ( $_GET ['id'] ) as $aDestinataire ) {
								$aListeDiffusionCritere = new ListeDiffusionCritere ();
								$sql = $aListeDiffusionCritere->generateSQL ( $aDestinataire->getListeDiffusionID () );
								$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );

								while ( $line = mysqli_fetch_array  ( $result ) ) {
									$aSurveyRecipient = new SurveyRecipient ();
									$aSurveyRecipient->setSurveyID ( ( int ) $_GET ['id'] );
									$aSurveyRecipient->setUserID ( ( int ) $line [0] );
									$aSurveyRecipient->setARepondu ( '0' );
									$aSurveyRecipientManager->add ( $aSurveyRecipient );
								}
							}

							break;
						case Survey::STATUS_CLOSED :
							$aSurvey->setStatus ( Survey::STATUS_CLOSED );
							$aSurveyManager->update ( $aSurvey );

							$aSurveyHistoryManager = new SurveyHistoryManager ();
							$aSurveyHistory = new SurveyHistory ();
							$aSurveyHistory->setSurveyID ( ( int ) $aSurvey->getID () );
							$aSurveyHistory->setDescription ( 'Changement du statut \'En Cours\' &agrave; \'Clos\'' );
							$aSurveyHistoryManager->add ( $aSurveyHistory );

							break;
					}
				}
				echo CommunFunction::goToURL ( '?' );
				break;
			case 'sendInvitation' :
				if (isset ( $_GET ['id'] )) {
					$aSurveyManager = new SurveyManager ();
					$aSurvey = $aSurveyManager->get ( $_GET ['id'] );

					if ($aSurvey->getEnvoiInvitation () == '0') {
						$aSurveyHistoryManager = new SurveyHistoryManager ();
						$aSurveyHistory = new SurveyHistory ();
						$aSurveyHistory->setSurveyID ( ( int ) $aSurvey->getID () );
						$aSurveyHistory->setDescription ( 'Envoi des Invitations' );
						$aSurveyHistoryManager->add ( $aSurveyHistory );

						// Envoi Invitation
						$aMail = new NotificationMail ();
						$aParam = new Param ();
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_FROM' );
						$aMail->setFrom ( $aParam->getValue () );
						$aMail->setHeaderReplyTo ( $aParam->getValue () );
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_SUBJECT' );
						$aMail->setSubject ( stripslashes ( $aParam->getValue () ) );
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_BODY_1' );

						$msg = '';
						$msg .= stripslashes ( $aParam->getValue () ) . '<br>';
						$msg .= '<a href="http://' . $_SERVER ['HTTP_HOST'] . '/sondage.php?id=' . $_GET ['id'] . '">Merci de vous rendre sur le sondage GCR en cliquant ici</a><br/>';
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_BODY_2' );
						$msg .= stripslashes ( $aParam->getValue () ) . '<br>';
						$msg .= '</body></html>';

						$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
						$aMail->setHeaderContentTransferEncoding ( '8bit' );

						$aSurveyRecipientManager = new SurveyRecipientManager ();
						$aIndividu = new Simple_Individu ();
						foreach ( $aSurveyRecipientManager->getList ( $_GET ['id'] ) as $aRecipient ) {

							$aIndividu->SQL_SELECT ( $aRecipient->getUserID () );
							$aMail->setTo ( $aIndividu->getMail () );

							$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . 'Bonjour ' . $aIndividu->getPrenom () . ' ' . $aIndividu->getNom () . ',<br/>' . $msg );

							if (! $aMail->send ()) {
								$aSurveyHistory->setDescription ( 'Envoi Invitation en erreur ' . $aIndividu->getMail () );
								$aSurveyHistoryManager->add ( $aSurveyHistory );
							}
						}

						$aSurvey->setEnvoiInvitation ( '1' );
						$aSurveyManager->update ( $aSurvey );
					} else {
						// Envoi Relance
						$aSurvey->setEnvoiRelance ( '1' );
						$aSurveyManager->update ( $aSurvey );

						$aSurveyHistoryManager = new SurveyHistoryManager ();
						$aSurveyHistory = new SurveyHistory ();
						$aSurveyHistory->setSurveyID ( ( int ) $aSurvey->getID () );
						$aSurveyHistory->setDescription ( 'Envoi des Relances' );
						$aSurveyHistoryManager->add ( $aSurveyHistory );

						$aMail = new NotificationMail ();
						$aParam = new Param ();
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_RELANCE_FROM' );
						$aMail->setFrom ( $aParam->getValue () );
						$aMail->setHeaderReplyTo ( $aParam->getValue () );
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_RELANCE_SUBJECT' );
						$aMail->setSubject ( stripslashes ( $aParam->getValue () ) );
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_RELANCE_BODY_1' );

						$msg = '';
						$msg .= stripslashes ( $aParam->getValue () ) . '<br>';
						$msg .= '<a href="http://' . $_SERVER ['HTTP_HOST'] . '/sondage.php?id=' . $_GET ['id'] . '">Merci de vous rendre sur le sondage GCR en cliquant ici</a><br/>';
						$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_RELANCE_BODY_2' );
						$msg .= stripslashes ( $aParam->getValue () ) . '<br>';
						$msg .= '</body></html>';

						$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
						$aMail->setHeaderContentTransferEncoding ( '8bit' );

						$aSurveyRecipientManager = new SurveyRecipientManager ();
						$aIndividu = new Simple_Individu ();
						foreach ( $aSurveyRecipientManager->getListNoRepondu ( $_GET ['id'] ) as $aRecipient ) {
							$aIndividu->SQL_SELECT ( $aRecipient->getUserID () );
							$aMail->setTo ( $aIndividu->getMail () );

							$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . 'Bonjour ' . $aIndividu->getPrenom () . ' ' . $aIndividu->getNom () . ',<br/>' . $msg );

							if (! $aMail->send ()) {
								$aSurveyHistory->setDescription ( 'Envoi Relance en erreur ' . $aIndividu->getMail () );
								$aSurveyHistoryManager->add ( $aSurveyHistory );
							}
						}
					}
					echo CommunFunction::goToURL ( '?' );
				}
				break;

			// ### GESTION des QUESTIONS ###

			case 'newQuestion' :
				if (isset ( $_POST ['submitButton'] )) {
					$aSurveyQuestion = new SurveyQuestion ();
					$aSurveyQuestion->setDescription ( $_POST ['pDescription'] );
					$aSurveyQuestion->setType ( $_POST ['pType'] );
					$aSurveyQuestion->setSurveyID ( ( int ) $_GET ['id'] );
					if ($_POST ['pType'] == SurveyQuestion::TYPE_CHECKBOX || $_POST ['pType'] == SurveyQuestion::TYPE_RADIO || $_POST ['pType'] == SurveyQuestion::TYPE_LIST) {
						$aSurveyQuestion->setChoix1 ( $_POST ['pChoix1'] );
						$aSurveyQuestion->setChoix2 ( $_POST ['pChoix2'] );
						$aSurveyQuestion->setChoix3 ( $_POST ['pChoix3'] );
						$aSurveyQuestion->setChoix4 ( $_POST ['pChoix4'] );
						$aSurveyQuestion->setChoix5 ( $_POST ['pChoix5'] );
						$aSurveyQuestion->setChoix6 ( $_POST ['pChoix6'] );
					}
					$aSurveyQuestionManager = new SurveyQuestionManager ();
					$aSurveyQuestionManager->add ( $aSurveyQuestion );

					echo CommunFunction::goToURL ( '?action=listQuestion&id=' . $_GET ['id'] );
				} else {
					$aSurveyQuestionView = new SurveyQuestionView ( new SurveyQuestion () );
					$aSurveyQuestionView->renderHTML ( 'new' );
				}
				break;
			case 'updateQuestion' :
				if (isset ( $_POST ['submitButton'] )) {
					$aSurveyQuestionManager = new SurveyQuestionManager ();
					$aSurveyQuestion = $aSurveyQuestionManager->get ( $_GET ['id'] );
					$aSurveyQuestion->setDescription ( $_POST ['pDescription'] );
					$aSurveyQuestion->setType ( $_POST ['pType'] );
					if ($_POST ['pType'] == SurveyQuestion::TYPE_CHECKBOX || $_POST ['pType'] == SurveyQuestion::TYPE_RADIO || $_POST ['pType'] == SurveyQuestion::TYPE_LIST) {
						$aSurveyQuestion->setChoix1 ( $_POST ['pChoix1'] );
						$aSurveyQuestion->setChoix2 ( $_POST ['pChoix2'] );
						$aSurveyQuestion->setChoix3 ( $_POST ['pChoix3'] );
						$aSurveyQuestion->setChoix4 ( $_POST ['pChoix4'] );
						$aSurveyQuestion->setChoix5 ( $_POST ['pChoix5'] );
						$aSurveyQuestion->setChoix6 ( $_POST ['pChoix6'] );
					}
					$aSurveyQuestionManager->update ( $aSurveyQuestion );

					echo CommunFunction::goToURL ( '?action=listQuestion&id=' . $aSurveyQuestion->getSurveyID () );
				} else {
					$aSurveyQuestionManager = new SurveyQuestionManager ();
					$aSurveyQuestionView = new SurveyQuestionView ( $aSurveyQuestionManager->get ( $_GET ['id'] ) );
					$aSurveyQuestionView->renderHTML ( 'update' );
				}
				break;
			case 'deleteQuestion' :
				if (isset ( $_GET ['id'] )) {
					$aSurveyQuestionManager = new SurveyQuestionManager ();
					$aSurveyQuestion = $aSurveyQuestionManager->get ( $_GET ['id'] );
					$aSurveyQuestionManager->delete ( $_GET ['id'] );

					echo CommunFunction::goToURL ( '?action=listQuestion&id=' . $aSurveyQuestion->getSurveyID () );
				}
				break;
			case 'listQuestion' :
				if (isset ( $_GET ['id'] )) {
					$aSurveyQuestionManager = new SurveyQuestionManager ();
					$aSurveyQuestionCollectionView = new SurveyQuestionCollectionView ( $aSurveyQuestionManager->getList ( $_GET ['id'] ) );
					$aSurveyQuestionCollectionView->renderHTML ();
				}
				break;

			case 'exportSurvey' :
				if (isset ( $_GET ['id'] )) {
					$aSurveyQuestionManager = new SurveyQuestionManager ();
					$aSurveyRecipientResponseManager = new SurveyRecipientResponseManager ();
					$aSurveyResponseView = new SurveyResponseView ( $aSurveyQuestionManager->getList ( $_GET ['id'] ), $aSurveyRecipientResponseManager->getListUserReponse ( $_GET ['id'] ) );
					$aSurveyResponseView->renderCSV ();
				}
				break;
			// ### GESTION des INVITES ###

			case 'listRecipient' :
				if (isset ( $_GET ['id'] )) {
					$aSurveyManager = new SurveyManager ();
					$aSurvey = $aSurveyManager->get ( $_GET ['id'] );

					switch ($aSurvey->getStatus ()) {
						case Survey::STATUS_DRAFT :
							$aSurveyDraftRecipientManager = new SurveyDraftRecipientManager ();
							$aSurveyDraftRecipientCollectionView = new SurveyDraftRecipientCollectionView ( $aSurveyDraftRecipientManager->getList ( $_GET ['id'] ) );
							$aSurveyDraftRecipientCollectionView->renderHTML ();
							break;
						default :
							$aSurveyRecipientManager = new SurveyRecipientManager ();
							$aSurveyRecipientCollectionView = new SurveyRecipientCollectionView ( $aSurveyRecipientManager->getList ( $_GET ['id'] ) );
							$aSurveyRecipientCollectionView->renderHTML ();
							break;
					}
				}
				break;
			case 'addRecipient' :
				if (isset ( $_GET ['id'] )) {
					$aSurveyDraftRecipientManager = new SurveyDraftRecipientManager ();
					$aSurveyDraftRecipientCollectionView = new SurveyDraftRecipientCollectionView ( $aSurveyDraftRecipientManager->getListNoRecipient ( $_GET ['id'] ) );
					$aSurveyDraftRecipientCollectionView->renderHTML ();
				}

				if (isset ( $_GET ['sid'] ) && isset ( $_GET ['uid'] )) {
					$aSurveyDraftRecipientManager = new SurveyDraftRecipientManager ();
					$aSurveyDraftRecipient = new SurveyDraftRecipient ();
					$aSurveyDraftRecipient->setSurveyID ( ( int ) $_GET ['sid'] );
					$aSurveyDraftRecipient->setListeDiffusionID ( ( int ) $_GET ['uid'] );
					$aSurveyDraftRecipientManager->add ( $aSurveyDraftRecipient );
					echo CommunFunction::goToURL ( '?action=listRecipient&id=' . $_GET ['sid'] );
				}
				break;
			case 'deleteRecipient' :
				if (isset ( $_GET ['sid'] ) && isset ( $_GET ['uid'] )) {
					$aSurveyManager = new SurveyManager ();
					$aSurvey = $aSurveyManager->get ( $_GET ['sid'] );

					switch ($aSurvey->getStatus ()) {
						case Survey::STATUS_DRAFT :
							$aSurveyDraftRecipientManager = new SurveyDraftRecipientManager ();
							$aSurveyDraftRecipient = new SurveyDraftRecipient ();
							$aSurveyDraftRecipient->setSurveyID ( ( int ) $_GET ['sid'] );
							$aSurveyDraftRecipient->setListeDiffusionID ( ( int ) $_GET ['uid'] );
							$aSurveyDraftRecipientManager->delete ( $aSurveyDraftRecipient );
							break;
						default :
							$aSurveyRecipientManager = new SurveyRecipientManager ();
							$aSurveyRecipient = new SurveyRecipient ();
							$aSurveyRecipient->setSurveyID ( ( int ) $_GET ['sid'] );
							$aSurveyRecipient->setUserID ( ( int ) $_GET ['uid'] );
							$aSurveyRecipientManager->delete ( $aSurveyRecipient );
							break;
					}
					echo CommunFunction::goToURL ( '?action=listRecipient&id=' . $_GET ['sid'] );
				}
				break;
			case 'history' :
				if (isset ( $_GET ['id'] )) {
					$aSurveyHistoryManager = new SurveyHistoryManager ();
					$aSurveyHistoryView = new SurveyHistoryView ( $aSurveyHistoryManager->getList ( $_GET ['id'] ) );
					$aSurveyHistoryView->renderHTML ();
				}
				break;
		}
	}
}
?>