<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage app-export
 * @version 2.0.1
 */
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

// Connexion BDD

include ('../../../config/configuration.php');
require ('../../include/DbConnexion.php');

$aNewsletterHistoriqueManager = new NewsletterHistoriqueManager ();
$aListEnvois = $aNewsletterHistoriqueManager->getMailsEnvois ();

$aNewsletterHistorique = new NewsletterHistorique ();
$aNewsletterEnvoisDetailsManager = new NewsletterEnvoisDetailsManager ();

foreach ( $aListEnvois as $aNewsletterHistorique ) {
	$SQLRqt = $aNewsletterEnvoisDetailsManager->getSqlEnvoisDetails ( $aNewsletterHistorique->getEnvoiID () );

	$resQuery = mysqli_query ($_SESSION['LINK'], $SQLRqt ) or die ( mysqli_error ($_SESSION['LINK']) . '<br/>' . $SQLRqt );
	$fileArray = array ();
	$row = 0;
	if (mysqli_num_rows ( $resQuery ) > 0) {
		$aMail = new NotificationMail ();
		$aMail->setFrom ( 'p.germain@ciscar.fr' );
		$setTo = 'p.germain@gcrfrance.com;m.mallet@ciscar.fr;f.chazarenc@ciscar.fr;h.trunet@ciscar.fr;';

		switch ($aNewsletterHistorique->getDescription ()) {
			case strpos ( $aNewsletterHistorique->getDescription (), '_BEL_' ) > 0 :
				$setTo = $setTo . 'c.roche@ciscar.net';
				break;
			case strpos ( $aNewsletterHistorique->getDescription (), '_MAT_' ) > 0 :
				$setTo = $setTo . 'f.hee@ciscar.fr';
				break;
			case strpos ( $aNewsletterHistorique->getDescription (), '_BOU_' ) > 0 :
				$setTo = $setTo . 'p.gibeaud@ciscar.fr';
				break;
			case strpos ( $aNewsletterHistorique->getDescription (), '_MER_' ) > 0 :
				$setTo = $setTo . 'p.gibeaud@ciscar.fr';
				break;
			case strpos ( $aNewsletterHistorique->getDescription (), '_INF_' ) > 0 :
				$setTo = $setTo . '';
				break;
			default :
				$setTo = $setTo . 'f.hee@ciscar.fr;p.gibeaud@ciscar.fr';
				break;
		}

		$aMail->setTo ( $setTo );
		// $aMail->setTo('p.germain@gcrfrance.com');
		$aMail->setHeaderReplyTo ( 'p.germain@gcrfrance.com' );
		$passage_ligne = '<br>';

		// titre des colonnes
		$fields = mysqli_num_fields ( $resQuery );
		$i = 0;
		while ( $i < $fields ) {
			$fileArray [$row] [$i] = mysqli_fetch_field_direct($resQuery, $i)->name;
			$i ++;
		}

		// données de la table
		while ( $arrSelect = mysqli_fetch_array  ( $resQuery, MYSQLI_ASSOC ) ) {
			$row += 1;
			$i = 0;
			foreach ( $arrSelect as $elem ) {
				$fileArray [$row] [$i] = $elem;
				$i ++;
			}
		}

		$filename = 'Suivi_Envoi_' . $aNewsletterHistorique->getEnvoiID () . '.csv';
		$chemin = '../../file/stats/';
		// $chemin = 'C:\Users\pgermain\Desktop';
		$delimiteur = ';';

		// Ouverture du fichier csv
		$fichier_csv = fopen ( $chemin . $filename, 'w+' );

		// pour corriger les problèmes d'affichage des caractères internationaux (les accents par exemple)
		// fprintf($fichier_csv, chr(0xEF).chr(0xBB).chr(0xBF));

		// Boucle foreach sur chaque ligne du tableau
		foreach ( $fileArray as $ligne ) {
			// chaque ligne en cours de lecture est insérée dans le fichier
			// les valeurs présentes dans chaque ligne seront séparées par $delimiteur
			fputcsv ( $fichier_csv, $ligne, $delimiteur );
		}

		// fermeture du fichier csv
		fclose ( $fichier_csv );

		// ENVOI DU MAIL
		$aMail->setSubject ( 'SUIVI Newsletter : ' . $aNewsletterHistorique->getDescription () . ' - Envoi du ' . $aNewsletterHistorique->getDateCreation () );
		$msg = '<html><head></head><body style="font-family:Arial;font-size:x-small;color:#000000;">';
		$msg .= '<p>Bonjour,</p>';
		$msg .= '<p>Veuillez trouver en pièce jointe la liste des destinataires ayant ouvert la Newsletter ';
		$msg .= '<b>' . $aNewsletterHistorique->getDescription () . '</b>' . $passage_ligne . $passage_ligne;
		$msg .= 'envoyée le <b>' . substr ( $aNewsletterHistorique->getDateCreation (), 0, 10 );
		$msg .= '</b> à <b>' . substr ( $aNewsletterHistorique->getDateCreation (), - 8 ) . '</b></p>';
		$msg .= '<p>Cordialement.</p>';

		$msg .= '</body></html>';

		$aMail->setMessage ( $msg );
		$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
		$aMail->setHeaderContentTransferEncoding ( '8bit' );

		// mettre le fichier csv en pièce jointe
		$aMail->addAttachmentDATA ( 'text/csv', $filename, base64_encode ( file_get_contents ( $chemin . $filename ) ) );
		
		// print_r($aMail);
		if ($aMail->send ())			
		{
			$aNewsletterEnvoisDetailsManager->updateEnvoisMails ( $aNewsletterHistorique->getEnvoiID () );
		}
	}
}

// Deconnexion BDD
require ('../../include/DbDeconnexion.php');
?>