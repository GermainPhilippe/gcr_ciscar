<?php
class NewsletterControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'det' :
				if (isset ( $_GET ['news'] )) {
					$aNewsletterHistoriqueManager = new NewsletterHistoriqueManager ();
					$aNewsletterHistoriqueView = new NewsletterHistoriqueView ( $aNewsletterHistoriqueManager->getListEnvois ( $_GET ['news'] ) );
					$aNewsletterHistoriqueView->renderEnvoiHTML ();
				}
				break;
			case 'detenv' :
				if (isset ( $_GET ['envid'] )) {
					$aNewsletterEnvoisDetailsManager = new NewsletterEnvoisDetailsManager ();
					$aNewsletterEnvoisDetailsView = new NewsletterEnvoisDetailsView ( $aNewsletterEnvoisDetailsManager->getListeEnvoisDetails ( $_GET ['envid'] ) );
					$aNewsletterEnvoisDetailsView->renderHTML ();
				}
				break;
			case 'new' :
				if (isset ( $_POST ['Nom'] )) {
					$aNewsletter = new Newsletter ();
					$aNewsletter->setName ( $_POST ['Nom'] );
					$aNewsletter->setNewsBloquee ( $_POST ['newsBloquee'] );
					$aNewsletter->setFrom ( $_POST ['From'] );
					$aNewsletter->setReplyTo ( $_POST ['ReplyTo'] );
					$aNewsletter->setSubject ( $_POST ['Sujet'] );
					$aNewsletter->setRichContentValue ( $_POST ['FCKeditor1'] );
					$aNewsletter->setCssHeader ( $_POST ['pCssHeader'] );
					$aNewsletterManager = new NewsletterManager ();
					$aNewsletterManager->add ( $aNewsletter );

					// historique
					$aNewsletterHistorique = new NewsletterHistorique ();
					$aNewsletterHistorique->setNewsletterID ( ( int ) $aNewsletter->getID () );
					$aNewsletterHistorique->setDescription ( 'Création Newsletter' );
					$aNewsletterHistoriqueManager = new NewsletterHistoriqueManager ();
					$aNewsletterHistoriqueManager->add ( $aNewsletterHistorique );

					// Destinataire
					$aNewsletterDestinataireManager = new NewsletterDestinataireManager ();
					for($i = 1; $i <= $_POST ['Counter']; $i ++) {
						if (isset ( $_POST ['ListeDiffusion' . $i] )) {
							$aNewsletterDestinataire = new NewsletterDestinataire ();
							$aNewsletterDestinataire->setNewsletterID ( ( int ) $aNewsletter->getID () );
							$aNewsletterDestinataire->setListeDiffusionID ( ( int ) $_POST ['ListeDiffusion' . $i] );
							$aNewsletterDestinataireManager->add ( $aNewsletterDestinataire );
						}
					}

					// Creation des fichiers joints

					if (! in_array ( $_FILES ['pAttachment1'] ['error'], array (
							1,
							2,
							3
					) ) && $_FILES ['pAttachment1'] ['size'] > 0) {
						$this->addAttachment ( $_FILES ['pAttachment1'], ( int ) $aNewsletter->getID () );
					}

					if (! in_array ( $_FILES ['pAttachment2'] ['error'], array (
							1,
							2,
							3
					) ) && $_FILES ['pAttachment2'] ['size'] > 0) {
						$this->addAttachment ( $_FILES ['pAttachment2'], ( int ) $aNewsletter->getID () );
					}

					if (! in_array ( $_FILES ['pAttachment3'] ['error'], array (
							1,
							2,
							3
					) ) && $_FILES ['pAttachment3'] ['size'] > 0) {
						$this->addAttachment ( $_FILES ['pAttachment3'], ( int ) $aNewsletter->getID () );
					}

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aNewsletter = new Newsletter ();
					$aNewsletterView = new NewsletterTabView ( $aNewsletter );
					$aNewsletterView->renderHTML ( 'new' );
				}
				break;
			case 'update' :
				if (isset ( $_POST ['Nom'] )) {
					$aNewsletter = new Newsletter ();
					$aNewsletter->setID ( ( int ) $_GET ['id'] );
					$aNewsletter->setName ( $_POST ['Nom'] );
					$aNewsletter->setNewsBloquee ( $_POST ['newsBloquee'] );
					$aNewsletter->setFrom ( $_POST ['From'] );
					$aNewsletter->setReplyTo ( $_POST ['ReplyTo'] );
					$aNewsletter->setSubject ( $_POST ['Sujet'] );
					$aNewsletter->setRichContentValue ( $_POST ['FCKeditor1'] );
					$aNewsletter->setCssHeader ( $_POST ['pCssHeader'] );
					$aNewsletterManager = new NewsletterManager ();
					$aNewsletterManager->save ( $aNewsletter );

					$aNewsletterHistorique = new NewsletterHistorique ();
					$aNewsletterHistorique->setNewsletterID ( ( int ) $aNewsletter->getID () );
					$aNewsletterHistorique->setDescription ( 'Modification Newsletter' );
					$aNewsletterHistoriqueManager = new NewsletterHistoriqueManager ();
					$aNewsletterHistoriqueManager->add ( $aNewsletterHistorique );

					$aNewsletterDestinataireManager = new NewsletterDestinataireManager ();
					$aNewsletterDestinataireManager->deleteAll ( ( int ) $aNewsletter->getID () );
					for($i = 1; $i <= $_POST ['Counter']; $i ++) {
						if (isset ( $_POST ['ListeDiffusion' . $i] )) {
							$aNewsletterDestinataire = new NewsletterDestinataire ();
							$aNewsletterDestinataire->setNewsletterID ( ( int ) $aNewsletter->getID () );
							$aNewsletterDestinataire->setListeDiffusionID ( ( int ) $_POST ['ListeDiffusion' . $i] );
							$aNewsletterDestinataireManager->add ( $aNewsletterDestinataire );
						}
					}

					// Gestion des fichiers joints

					if (isset ( $_FILES ['pAttachment1'] ) && ! in_array ( $_FILES ['pAttachment1'] ['error'], array (
							1,
							2,
							3
					) ) && $_FILES ['pAttachment1'] ['size'] > 0) {
						$this->addAttachment ( $_FILES ['pAttachment1'], ( int ) $aNewsletter->getID () );
					}

					if (isset ( $_FILES ['pAttachment2'] ) && ! in_array ( $_FILES ['pAttachment2'] ['error'], array (
							1,
							2,
							3
					) ) && $_FILES ['pAttachment2'] ['size'] > 0) {
						$this->addAttachment ( $_FILES ['pAttachment2'], ( int ) $aNewsletter->getID () );
					}

					if (isset ( $_FILES ['pAttachment3'] ) && ! in_array ( $_FILES ['pAttachment3'] ['error'], array (
							1,
							2,
							3
					) ) && $_FILES ['pAttachment3'] ['size'] > 0) {
						$this->addAttachment ( $_FILES ['pAttachment3'], ( int ) $aNewsletter->getID () );
					}

					echo CommunFunction::goToURL ( '?' );
				} else {
					if (isset ( $_GET ['id'] )) {
						$aNewsletterManager = new NewsletterManager ();
						$aNewsletter = $aNewsletterManager->get ( $_GET ['id'] );

						$aNewsletterAttachmentManager = new NewsletterAttachmentManager ();
						$attachments = $aNewsletterAttachmentManager->getListByNewsletter ( $_GET ['id'] );

						switch (count ( $attachments )) {
							case 1 :
								$aNewsletterView = new NewsletterTabView ( $aNewsletter, $attachments [0], NULL, NULL );
								break;
							case 2 :
								$aNewsletterView = new NewsletterTabView ( $aNewsletter, $attachments [0], $attachments [1], NULL );
								break;
							case 3 :
								$aNewsletterView = new NewsletterTabView ( $aNewsletter, $attachments [0], $attachments [1], $attachments [2] );
								break;
							default :
								$aNewsletterView = new NewsletterTabView ( $aNewsletter );
								break;
						}

						$aNewsletterView->renderHTML ( 'update' );
					}
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aNewsletterManager = new NewsletterManager ();
					$aNewsletterManager->delete ( $_GET ['id'] );

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'deleteAttachment' :

				// Appel Ajax
				if (isset ( $_GET ['id'] )) {
					$aNewsletterAttachmentManager = new NewsletterAttachmentManager ();
					$aNewsletterAttachmentManager->delete ( $_GET ['id'] );
					echo true;
				}
				break;
			case 'getAttachment' :
				if (isset ( $_GET ['id'] )) {
					$aNewsletterAttachmentManager = new NewsletterAttachmentManager ();
					$aNewsletterAttachment = $aNewsletterAttachmentManager->get ( $_GET ['id'] );
					header ( 'HTTP/1.1 200 OK' );
					header ( 'Content-type: ' . $aNewsletterAttachment->getMime () );
					header ( 'Content-Length: ' . $aNewsletterAttachment->getSize () );
					header ( 'Content-Disposition: attachment; filename="' . $aNewsletterAttachment->getName () . '"' );
					echo $aNewsletterAttachment->getData ();
				}
				break;
			case 'view' :
				if (isset ( $_GET ['id'] )) {
					$aNewsletterManager = new NewsletterManager ();
					$aNewsletter = $aNewsletterManager->get ( $_GET ['id'] );
					$aNewsletterView = new NewsletterTabView ( $aNewsletter );
					$aNewsletterView->renderPreviewHTML ();
				}
				break;
			case 'send' :
				if (isset ( $_GET ['id'] )) {
					$aNewsletterManager = new NewsletterManager ();
					$aNewsletterDestinataireManager = new NewsletterDestinataireManager ();
					if (count ( $aNewsletterDestinataireManager->getList ( $_GET ['id'] ) ) > 0) {
						$aNewsletterManager->sendNewsletter ( $aNewsletterManager->get ( $_GET ['id'] ) );
						echo CommunFunction::goToURL ( '?' );
					} else {
						echo CommunFunction::displayAlert ( 'Aucun Destinataire sélectionné !' );
						echo CommunFunction::goToURL ( '?action=update&id=' . $_GET ['id'] );
					}
				}
				break;
			case 'addDestinataire' :
				$aListeDiffusionManager = new ListeDiffusionManager ();
				$aNewsletterAddDestinataireView = new NewsletterAddDestinataireView ( $aListeDiffusionManager->getList () );
				$aNewsletterAddDestinataireView->renderHTML ();
				break;
			case 'viewHistorique' :
				if (isset ( $_GET ['id'] )) {
					$aNewsletterHistoriqueManager = new NewsletterHistoriqueManager ();
					$aNewsletterHistoriqueView = new NewsletterHistoriqueView ( $aNewsletterHistoriqueManager->getList ( $_GET ['id'] ) );
					$aNewsletterHistoriqueView->renderHTML ();
				}
				break;
			case 'duplicate' :
				if (isset ( $_GET ['id'] )) {
					$aNewsletterManager = new NewsletterManager ();
					$aNewsletterManager->duplicate ( $_GET ['id'] );

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
	private function addAttachment($file, $newsletterID) {
		$newsletterAttachment = new NewsletterAttachment ();
		$newsletterAttachment->setNewsletterID ( $newsletterID );

		$newsletterAttachment->setName ( $file ['name'] );
		$newsletterAttachment->setSize ( $file ['size'] );
		$myFile = pathinfo ( $file ['name'] );
		switch ($myFile ['extension']) {
			case 'doc' :
				$newsletterAttachment->setMime ( 'application/msword' );
				break;
			case 'docx' :
				$newsletterAttachment->setMime ( 'vnd.openxmlformats-officedocument.wordprocessingml.document' );
				break;
			case 'pdf' :
				$newsletterAttachment->setMime ( 'application/pdf' );
				break;
			default :
				$newsletterAttachment->setMime ( $file ['type'] );
				break;
		}
		$newsletterAttachment->setData ( file_get_contents ( $file ['tmp_name'] ) );

		$aNewsletterAttachmentManager = new NewsletterAttachmentManager ();
		$aNewsletterAttachmentManager->add ( $newsletterAttachment );
	}
}
?>