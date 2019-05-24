<?php
/**
 * Class utilisée pour la gestion des mails
 * @author Alexandre DIALLO
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 *
 */
class EnvoiMail {
	// Non publication d'une offre
	private $myMail_1;
	// Non publication d'une candidature
	private $myMail_2;
	// Suppression d'une candidature
	private $myMail_3;
	// Suppression d'une offre
	private $myMail_4;
	private $myParamMailBox;
	private $myParamAdminMail;
	private $myidmail;
	private $myMail;
	public function __construct($aModele) {
		$this->myMail = $aModele;
	}

	// ###

	/**
	 * Insére le mail de non publication d'une offre
	 */
	public function setMail_1($newValue) {
		$this->myMail_1 = $newValue;
	}
	/**
	 * Insére le mail de non publication d'une candidature
	 */
	public function setMail_2($newValue) {
		$this->myMail_2 = $newValue;
	}
	/**
	 * Insére le mail de suppression d'une candidature
	 */
	public function setMail_3($newValue) {
		$this->myMail_3 = $newValue;
	}
	/**
	 * Insére le mail de suppression d'une offre
	 */
	public function setMail_4($newValue) {
		$this->myMail_4 = $newValue;
	}
	public function setParamMailBox($newValue) {
		$this->myParamMailBox = $newValue;
	}
	public function setParamAdminMail($newValue) {
		$this->myParamAdminMail = $newValue;
	}
	public function setidmail($newValue) {
		$this->myidmail = $newValue;
	}

	/**
	 *
	 * Envoi les différents mails..
	 *
	 * @param int $id
	 *        	1.Cas lors d'une NON publication d'une candidature
	 *        	2.Cas lors d'une suppression d'une offre
	 *        	3.Cas lors d'une suppression d'une candidature
	 *        	4.Cas lors d'une NON publication d'une offre
	 */
	public function envoiMail($id) {
		switch ($id) {
			case 1 :

				// *************************************************
				// Cas lors d'une NON publication d'une candidature*
				// *************************************************
				$aff = '<font style="color:#000000;font-size: x-small;font-family:Arial;">Voici un r&eacute;capitulatif de votre candidature</font>';
				$aff .= '<table style="color:#000000;font-size: x-small;font-family:Arial;">';
				// $aff .= '<tr><td>Titre de votre candidature</td>';
				// $aff .= '<td>' . stripslashes ( $this->myMail->gettitrecand () ) . '</td></tr>';
				$aff .= '<tr><td>Fonction recherch&eacute;e</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getfonction () ) . '</td></tr>';
				$aff .= '<tr><td>R&eacute;gion(s) de recherche</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getregionlibelle () ) . '</td></tr>';
				$aff .= '<tr><td>D&eacute;partement(s) de recherche</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getdepartementlibelle () ) . '</td></tr>';
				$aff .= '<tr><td>Domaine d\'activit&eacute;</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getiddomaine () ) . '</td></tr>';
				$aff .= '<tr><br />Vos coordonn&eacute;es:</tr>';
				$aff .= '<tr><td>Civilit&eacute;</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getcivilite () ) . '</td></tr>';
				$aff .= '<tr><td>Nom</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getnom () ) . '</td></tr>';
				$aff .= '<tr><td>Pr&eacute;nom</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getprenom () ) . '</td></tr>';
				$aff .= '<tr><td>Adresse Postale</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getadresse () ) . '</td></tr>';
				$aff .= '<tr><td>Code Postal</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getcp () ) . '</td></tr>';
				$aff .= '<tr><td>Ville</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getville () ) . '</td></tr>';
				$aff .= '<tr><td>Adresse E-mail </td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getmail () ) . '</td></tr>';
				$aff .= '<tr><td>Nom du pays</td>';
				$aff .= '<td>' . $this->myMail->getidpays () . '</td></tr>';
				if ($this->myMail->getidpays () != 'France') {
					$aff .= '<tr><td>Ressortissant</td>';
					if ($this->myMail->getressort () == 1) {
						$aff .= '<td>Non communautaire</td></tr>';
					} else if ($this->myMail->getressort () == 2) {
						$aff .= '<td>Communautaire</td></tr>';
					}
					if ($this->myMail->getressort () == 1) {
						$aff .= '<tr><td>Titre de s&eacute;jour</td>';
						if ($this->myMail->getsejour () == 1) {
							$aff .= '<td>Oui</td></tr>';
						} else {
							$aff .= '<td>Non</td></tr>';
						}
					}
					$aff .= '<tr><td>Disponibilit&eacute;</td>';
					$aff .= '<td>' . $this->myMail->getdispo () . '</td></tr>';
				}
				$aff .= '</table>';

				$aMail = new NotificationMail ();
				$aMail->setFrom ( $this->myParamAdminMail ); // pas d'addresse de renvoi
				$aMail->setTo ( $this->myMail->getmail () ); // Envoi du mail à celui qui a déposé la candidature.
				$aMail->setSubject ( stripslashes ( $this->myMail_2->getMailObjet () ) );
				$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $this->myMail_2->getMailTete () ) . ' <br /> ' . $aff . '<br />' . stripslashes ( $this->myMail_2->getMailPied () ) . '</body></html>' );
				$aMail->setHeaderReplyTo ( $this->myParamAdminMail );
				$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$aMail->setHeaderContentTransferEncoding ( '8bit' );
				$aMail->send ();
				break;
			case 2 :

				// ***************************************
				// Cas lors d'une suppression d'une offre*
				// ***************************************
				$aff = '<font style="color:#000000;font-size: x-small;font-family:Arial;">Voici un r&eacute;capitulatif de votre offre d\'emploi</font>';
				$aff .= '<table style="color:#000000;font-size: x-small;font-family:Arial;">';
				$aff .= '<tr><td>Num&eacute;ro de l\'offre</td>';
				$aff .= '<td>' . $this->myMail->getnumoffre () . '</td></tr>';
				$aff .= '<tr><td>Titre de votre offre</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->gettitreoffre () ) . '</td></tr>';
				$aff .= '<tr><td>R&eacute;gion de recherche</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getregionlibelle () ) . '</td></tr>';
				$aff .= '<tr><td>D&eacute;partement de recherche</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getdepartementlibelle () ) . '</td></tr>';
				$aff .= '<tr><td>Ville de recherche</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getville () ) . '</td></tr>';
				// $aff .= '<tr><td>Domaine d\'activit&eacute;</td>';
				// $aff .= '<td>' . $this->myMail->getiddomaine () . '</td></tr>';
				$aff .= '<tr><td>M&eacute;tier de l\'offre</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getnomcatmetier () . '&nbsp;/&nbsp;' . $this->myMail->getnommetier () ) . '</td></tr>';
				// $aff .= '<tr><td>Fonction </td>';
				// $aff .= '<td>' . stripslashes ( $this->myMail->getfonction () ) . '</td></tr>';
				$aff .= '<tr><td>Commentaires</td>';
				$aff .= '<td>' . stripslashes ( nl2br ( $this->myMail->getcommentaire () ) ) . '</td></tr>';
				$aff .= '<tr><td>Date de prise de poste</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getdatedebpost () ) . '</td></tr>';
				$aff .= '<tr><td>Personne &agrave; contacter</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getcontact () ) . '</td></tr>';
				$aff .= '<tr><td>Adresse E-mail </td>';
				$aff .= '<td>' . $this->myMail->getmail () . '</td></tr>';
				$aff .= '<tr><td>Date de cr&eacute;ation</td>';
				$aff .= '<td>' . $this->myMail->getdateoffre () . '</td></tr>';
				$aff .= '</table>';

				$aMail = new NotificationMail ();
				$aMail->setFrom ( $this->myParamAdminMail ); // pas d'addresse de renvoi
				$aMail->setTo ( $this->myMail->getmail () ); // Envoi du mail à celui qui a déposé l'offre.
				$aMail->setSubject ( stripslashes ( $this->myMail_4->getMailObjet () ) );
				$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $this->myMail_4->getMailTete () ) . ' <br /> ' . $aff . '<br />' . stripslashes ( $this->myMail_4->getMailPied () ) . '</body></html>' );
				$aMail->setHeaderReplyTo ( $this->myParamAdminMail );
				$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$aMail->setHeaderContentTransferEncoding ( '8bit' );
				$aMail->send ();
				break;

			case 3 :

				// *********************************************
				// Cas lors d'une suppression d'une candidature*
				// *********************************************
				$aff = '<font style="color:#000000;font-size: x-small;font-family:Arial;">Voici un r&eacute;capitulatif de votre candidature</font>';
				$aff .= '<table style="color:#000000;font-size: x-small;font-family:Arial;">';
				// $aff .= '<tr><td>Titre de votre candidature</td>';
				// $aff .= '<td>' . stripslashes ( $this->myMail->gettitrecand () ) . '</td></tr>';
				$aff .= '<tr><td>Fonction recherch&eacute;e</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getfonction () ) . '</td></tr>';
				$aff .= '<tr><td>R&eacute;gion(s) de recherche</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getregionlibelle () ) . '</td></tr>';
				$aff .= '<tr><td>D&eacute;partement(s) de recherche</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getdepartementlibelle () ) . '</td></tr>';
				$aff .= '<tr><td>Domaine d\'activit&eacute;</td>';
				$aff .= '<td>' . $this->myMail->getiddomaine () . '</td></tr>';
				$aff .= '<tr><br />Vos coordonn&eacute;es:</tr>';
				$aff .= '<tr><td>Civilit&eacute;</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getcivilite () ) . '</td></tr>';
				$aff .= '<tr><td>Nom</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getnom () ) . '</td></tr>';
				$aff .= '<tr><td>Pr&eacute;nom</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getprenom () ) . '</td></tr>';
				$aff .= '<tr><td>Adresse Postale</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getadresse () ) . '</td></tr>';
				$aff .= '<tr><td>Code Postal</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getcp () ) . '</td></tr>';
				$aff .= '<tr><td>Ville</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getville () ) . '</td></tr>';
				$aff .= '<tr><td>Adresse E-mail </td>';
				$aff .= '<td>' . $this->myMail->getmail () . '</td></tr>';
				$aff .= '<tr><td>Nom du pays</td>';
				$aff .= '<td>' . $this->myMail->getidpays () . '</td></tr>';
				if ($this->myMail->getidpays () != 'France') {
					$aff .= '<tr><td>Ressortissant</td>';
					if ($this->myMail->getressort () == 1) {
						$aff .= '<td>Non communautaire</td></tr>';
					} else if ($this->myMail->getressort () == 2) {
						$aff .= '<td>Communautaire</td></tr>';
					}
					if ($this->myMail->getressort () == 1) {
						$aff .= '<tr><td>Titre de s&eacute;jour</td>';
						if ($this->myMail->getsejour () == 1) {
							$aff .= '<td>Oui</td></tr>';
						} else {
							$aff .= '<td>Non</td></tr>';
						}
					}
					$aff .= '<tr><td>Disponibilit&eacute;</td>';
					$aff .= '<td>' . $this->myMail->getdispo () . '</td></tr>';
				}
				$aff .= '</table>';

				$aMail = new NotificationMail ();
				$aMail->setFrom ( $this->myParamAdminMail ); // pas d'addresse de renvoi
				$aMail->setTo ( $this->myMail->getmail () ); // Envoi du mail à celui qui a déposé la réponse.
				$aMail->setSubject ( stripslashes ( $this->myMail_3->getMailObjet () ) );
				$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $this->myMail_3->getMailTete () ) . ' <br /> ' . $aff . '<br />' . stripslashes ( $this->myMail_3->getMailPied () ) . '</body></html>' );
				$aMail->setHeaderReplyTo ( $this->myParamAdminMail );
				$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$aMail->setHeaderContentTransferEncoding ( '8bit' );
				$aMail->send ();
				break;
			case 4 :

				// *************************************************
				// Cas lors d'une NON publication d'une offre*
				// *************************************************
				$aff = '<font style="color:#000000;font-size: x-small;font-family:Arial;">Voici un r&eacute;capitulatif de votre offre d\'emploi</font>';
				$aff .= '<table style="color:#000000;font-size: x-small;font-family:Arial;">';
				$aff .= '<tr><td>Num&eacute;ro de l\'offre</td>';
				$aff .= '<td>' . $this->myMail->getnumoffre () . '</td></tr>';
				$aff .= '<tr><td>Titre de votre offre</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->gettitreoffre () ) . '</td></tr>';
				$aff .= '<tr><td>R&eacute;gion de recherche</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getregionlibelle () ) . '</td></tr>';
				$aff .= '<tr><td>D&eacute;partement de recherche</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getdepartementlibelle () ) . '</td></tr>';
				$aff .= '<tr><td>Ville de recherche</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getville () ) . '</td></tr>';
				// $aff .= '<tr><td>Domaine d\'activit&eacute;</td>';
				// $aff .= '<td>' . $this->myMail->getiddomaine () . '</td></tr>';
				$aff .= '<tr><td>M&eacute;tier de l\'offre</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getnomcatmetier () . '&nbsp;/&nbsp;' . $this->myMail->getnommetier () ) . '</td></tr>';
				// $aff .= '<tr><td>Fonction </td>';
				// $aff .= '<td>' . stripslashes ( $this->myMail->getfonction () ) . '</td></tr>';
				$aff .= '<tr><td>Commentaires</td>';
				$aff .= '<td>' . stripslashes ( nl2br ( $this->myMail->getcommentaire () ) ) . '</td></tr>';
				$aff .= '<tr><td>Date de prise de poste</td>';
				$aff .= '<td>' . $this->myMail->getdatedebpost () . '</td></tr>';
				$aff .= '<tr><td>Personne à contacter</td>';
				$aff .= '<td>' . stripslashes ( $this->myMail->getcontact () ) . '</td></tr>';
				$aff .= '<tr><td>Adresse E-mail </td>';
				$aff .= '<td>' . $this->myMail->getmail () . '</td></tr>';
				$aff .= '<tr><td>Date de cr&eacute;ation</td>';
				$aff .= '<td>' . $this->myMail->getdateoffre () . '</td></tr>';
				$aff .= '</table>';

				$aMail = new NotificationMail ();
				$aMail->setFrom ( $this->myParamAdminMail ); // pas d'addresse de renvoi
				$aMail->setTo ( $this->myMail->getmail () ); // Envoi du mail à celui qui a déposé la candidature.
				$aMail->setSubject ( stripslashes ( $this->myMail_1->getMailObjet () ) );
				$aMail->setMessage ( '<html><body style="color:#000000;font-size: x-small;font-family:Arial;">' . stripslashes ( $this->myMail_1->getMailTete () ) . ' <br /> ' . $aff . '<br />' . stripslashes ( $this->myMail_1->getMailPied () ) . '</body></html>' );
				$aMail->setHeaderReplyTo ( $this->myParamAdminMail );
				$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
				$aMail->setHeaderContentTransferEncoding ( '8bit' );

				$aMail->send ();
				break;
		}
	}
}
?>