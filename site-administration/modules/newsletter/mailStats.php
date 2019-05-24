<?php
/**
 * @author Philippe GERMAIN
 * @package site-administration
 * @subpackage app-export
 * @version 2.0.1
 */
header ( "Content-Type: text/plain" );

// session_start();

// fonction pour convertir format date en timestamp
function dateToTimestamp($ma_date) {
	$annee = substr ( $ma_date, 0, 4 );
	$mois = substr ( $ma_date, 5, 2 );
	$jour = substr ( $ma_date, 8, 2 );
	return mktime ( 0, 0, 0, $mois, $jour, $annee );
}

// fonction inverse qui convertit le timestamp en date
function timestampToDate($mon_timestamp) {
	return date ( 'Ymd', $mon_timestamp );
}

// fonction qui calcul un nouveau timestamp en fonction d'un timestamp et d'un decalage
// 3600 * 24 = nombre de seconde par jour
// $decalage = nombre de jour (positif ou negatif)
function getNewDate($ma_date, $decalage) {
	return $ma_date + ($decalage * 3600 * 24);
}

// if(!isset($_SESSION['ADMIN']))
// {
// $_SESSION['ADMIN']['USER']['FULLNAME'] = 'Visitor';
// $_SESSION['ADMIN']['USER']['SiteName'] = '';
// $_SESSION['ADMIN']['USER']['CONNECTED'] = false;
// $_SESSION['ADMIN']['USER']['AnnuaireID'] = 0;
// }

$baseURLModule = '../../modules/';
require ('../../modules/mvc_inc.php');

// Connexion BDD
include ('../../../config/configuration.php');
require ('../../include/DbConnexion.php');

$aNewsletterHistoriqueManager = new NewsletterHistoriqueManager ();
$aListEnvois = $aNewsletterHistoriqueManager->getStatsNews ();

$aNewsletterHistorique = new NewsletterHistorique ();
$aNewsletterEnvoisDetailsManager = new NewsletterEnvoisDetailsManager ();

$newsArray = array ();

foreach ( $aListEnvois as $aNewsletterHistorique ) {
	$timestamp = dateToTimestamp ( $aNewsletterHistorique->getDateCreation () );
	$dateDeb = timestampToDate ( $timestamp );

	if ($aNewsletterHistorique->getJ () == '1') {
		$timestamp = dateToTimestamp ( $aNewsletterHistorique->getDateCreation () );
		$dateFin = timestampToDate ( $timestamp );
	}
	if ($aNewsletterHistorique->getJ () == '7') {
		$timestamp = dateToTimestamp ( $aNewsletterHistorique->getDateCreation () );
		$dateFin = timestampToDate ( getNewDate ( $timestamp, 7 ) );
	}
	if ($aNewsletterHistorique->getJ () == '21') {
		$timestamp = dateToTimestamp ( $aNewsletterHistorique->getDateCreation () );
		$dateFin = timestampToDate ( getNewDate ( $timestamp, 21 ) );
	}

	$SQLRqt = $aNewsletterEnvoisDetailsManager->getSqlEnvoisStats ( $aNewsletterHistorique->getNewsletterID (), $aNewsletterHistorique->getEnvoiID (), $aNewsletterHistorique->getJ (), $dateDeb, $dateFin );

	
	
	$resQuery = mysqli_query ($_SESSION['LINK'], $SQLRqt ) or die ( mysqli_error ($_SESSION['LINK']) . '<br/>' . $SQLRqt );
	if (mysqli_num_rows ( $resQuery ) > 0) {
		// On met à jour l'historique des envois par période
		$line = mysqli_fetch_array  ( $resQuery );
		$aNewsletterHistoriqueEnvoisStats = new NewsletterHistorique ();
		$aNewsletterHistoriqueEnvoisStats->setNewsletterID ( ( int ) $aNewsletterHistorique->getNewsletterID () );
		$aNewsletterHistoriqueEnvoisStats->setDescription ( $line [1] );
		$aNewsletterHistoriqueEnvoisStats->setEnvoiID ( ( int ) $line [2] );
		$aNewsletterHistoriqueEnvoisStats->setNbTot ( $line [3] );
		$aNewsletterHistoriqueEnvoisStats->setJ ( $line [4] );
		$aNewsletterHistoriqueEnvoisStats->setDateCreation ( $line [5] );
		$aNewsletterHistoriqueEnvoisStats->setListeDiffusion ( $line [6] );
		$aNewsletterHistoriqueEnvoisStats->setListeArticles ( $line [7] );
		$aNewsletterHistoriqueEnvoisStats->setNbClicks ( $line [8] );
		$aNewsletterHistoriqueEnvoisStats->setNbLecteurs ( $line [9] );
		$aNewsletterHistoriqueEnvoisStats->setNbOuv ( $line [10] );

		$aNewsletterHistoriqueEnvoisStatsManager = new NewsletterEnvoiManager ();
		if ($aNewsletterHistoriqueEnvoisStatsManager->selectEnvoiStats ( $aNewsletterHistorique->getNewsletterID (), $aNewsletterHistorique->getEnvoiID (), $aNewsletterHistorique->getJ () ))
			$aNewsletterHistoriqueEnvoisStatsManager->deleteEnvoiStats ( $aNewsletterHistorique->getNewsletterID (), $aNewsletterHistorique->getEnvoiID (), $aNewsletterHistorique->getJ () );
		$aNewsletterHistoriqueEnvoisStatsManager->addEnvoiStats ( $aNewsletterHistoriqueEnvoisStats );

		// on memorise la liste des newsletter modifiées
		$newsArray [$aNewsletterHistorique->getNewsletterID ()] = $aNewsletterHistorique->getDescription ();
	}
}

// On envoi un mail pour les newsletter pour lesquelles les stats ont été mises à jour
foreach ( $newsArray as $cle => $element ) {
	$SQLRqt = $aNewsletterEnvoisDetailsManager->getSqlNewsEnvoisStats ( $cle );


	$resQuery = mysqli_query ($_SESSION['LINK'], $SQLRqt ) or die ( mysqli_error ($_SESSION['LINK']) . '<br/>' . $SQLRqt );
	$fileArray = array ();
	$row = 0;
	if (mysqli_num_rows ( $resQuery ) > 0) {
		$aMail = new NotificationMail ();
		$aMail->setFrom ( 'p.germain@ciscar.fr' );
		// $aMail->setTo('p.germain@gcrfrance.com');
		$setTo = 'p.germain@gcrfrance.com;f.chazarenc@ciscar.fr;h.trunet@ciscar.fr;';

		$aMail->setTo ( $setTo );
		$aMail->setHeaderReplyTo ( 'p.germain@gcrfrance.com' );
		$passage_ligne = '<br>';

		// titre des colonnes
		$fields = mysqli_num_fields ( $resQuery );
		$i = 0;
		while ( $i < $fields ) {
			$fileArray [$row] [$i] = str_replace ( 'DateEnvoi', $element, mysqli_fetch_field_direct($resQuery, $i)->name );
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

		$filename = 'Statistiques_' . $cle . '_' . str_replace ( ' ', '-', $element ) . '.csv';
		$chemin = '../../file/stats/';
		// $chemin = 'C:\Users\pgermain\Desktop';
		$delimiteur = ';';

		// pour corriger les problèmes d'affichage des caractères internationaux (les accents par exemple)
		// fprintf($fichier_csv, chr(0xEF).chr(0xBB).chr(0xBF));

		// Ouverture du fichier csv
		$fichier_csv = fopen ( $chemin . $filename, 'w+' );

		$dateEnvoi = '';
		$dateEnvoi_prec = '';
		$precLecteurs = 0;
		$totLecteurs = 0;
		$precOuvertures = 0;
		$totOuvertures = 0;
		$precClicks = 0;
		$totClicks = 0;
		$row = 0;

		echo $element;
		// Boucle foreach sur chaque ligne du tableau
		foreach ( $fileArray as $ligne ) {
			
			// chaque ligne en cours de lecture est insérée dans le fichier
			// les valeurs présentes dans chaque ligne seront séparées par $delimiteur

			// on teste s'il y a une rupture sur la date d'envoi
			if ($row > 0)
				$dateEnvoi = $ligne [0];
			if ($dateEnvoi != $dateEnvoi_prec && $dateEnvoi_prec != '') {
				$ligneTot = $ligne;
				$ligneTot [0] = "";
				$ligneTot [1] = "";
				$ligneTot [2] = "TOTAL";
				$ligneTot [3] = $totLecteurs;
				$ligneTot [4] = $totOuvertures;
				$ligneTot [5] = $totClicks;
				$ligneTot [6] = "";
				$ligneTot [7] = "";
				fputcsv ( $fichier_csv, $ligneTot, $delimiteur );
				$ligneTot [1] = "";
				$ligneTot [2] = "";
				$ligneTot [3] = "";
				$ligneTot [4] = "";
				$ligneTot [5] = "";
				fputcsv ( $fichier_csv, $ligneTot, $delimiteur );
				$totLecteurs = 0;
				$precOuvertures = 0;
				$precClicks = 0;
				$precLecteurs = 0;
				$totOuvertures = 0;
				$totClicks = 0;
				$totCibles = "";
				$totArticles = "";
			}
			// Ecriture dans le fichier csv
			if ($dateEnvoi != $dateEnvoi_prec && $row > 0) {
				$ligne [0] = 'Envoi du ' . $ligne [0];
			} else {
				if ($row > 0)
					$ligne [0] = '';
				if ($row > 0)
					$ligne [1] = '';
			}

			$dateEnvoi_prec = $dateEnvoi;
			if ($row > 0) {
				$ligne [3] = $ligne [3] - $precLecteurs;
				$ligne [4] = $ligne [4] - $precOuvertures;
				$ligne [5] = $ligne [5] - $precClicks;
				$totLecteurs += $ligne [3];
				$totOuvertures += $ligne [4];
				$totClicks += $ligne [5];
				$ligne [6] = str_replace ( '|||', '|', $ligne [6] );
				$ligne [6] = str_replace ( '||', '|', $ligne [6] );
				$tabLigne6 = explode ( "|", $ligne [6] );
				$ligne [6] = implode ( "|", array_unique ( $tabLigne6 ) );
				$ligne [7] = str_replace ( '|||', '|', $ligne [7] );
				$ligne [7] = str_replace ( '||', '|', $ligne [7] );
				$tabLigne7 = explode ( "|", $ligne [7] );
				$ligne [7] = implode ( "|", array_unique ( $tabLigne7 ) );

				$precLecteurs = $precLecteurs + $ligne [3];
				$precOuvertures = $precOuvertures + $ligne [4];
				$precClicks = $precClicks + $ligne [5];
			}
			
			fputcsv ( $fichier_csv, $ligne, $delimiteur );
			$row += 1;
		}

		// ecriture de la dernière ligne TOTAL
		$ligneTot = $ligne;
		$ligneTot [0] = "";
		$ligneTot [1] = "";
		$ligneTot [2] = "TOTAL";
		$ligneTot [3] = $totLecteurs;
		$ligneTot [4] = $totOuvertures;
		$ligneTot [5] = $totClicks;
		$ligneTot [6] = "";
		$ligneTot [7] = "";
		fputcsv ( $fichier_csv, $ligneTot, $delimiteur );
		// fermeture du fichier csv
		fclose ( $fichier_csv );

		// ENVOI DU MAIL
		$aMail->setSubject ( 'STATISTIQUES Newsletter : ' . $element );
		$msg = '<html><head></head><body style="font-family:Arial;font-size:x-small;color:#000000;">';
		$msg .= '<p>Bonjour,</p>';
		$msg .= '<p>Veuillez trouver en pièce es statistiques sur la Newsletter ';
		$msg .= '<b>' . $element . '</b>' . $passage_ligne . $passage_ligne;
		$msg .= '</p>';
		$msg .= '<p>Cordialement.</p>';

		$msg .= '</body></html>';

		$aMail->setMessage ( $msg );
		$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
		$aMail->setHeaderContentTransferEncoding ( '8bit' );

		// mettre le fichier csv en pièce jointe
		$aMail->addAttachmentDATA ( 'text/csv', $filename, base64_encode ( file_get_contents ( $chemin . $filename ) ) );

		// print_r($aMail);
		$aMail->send ();
	}
}

// Deconnexion BDD
require ('../../include/DbDeconnexion.php');
?>