<?php
session_start ();
require ('../../mvc_inc.php');
include ('../../../../../config/configuration.php');
include ('../../../../include/DbConnexion.php');
function getFieldValeur($field, $valeur) {
	switch ($valeur) {
		case '1' :
			return stripslashes ( $field->getChoix1 () );
			break;
		case '2' :
			return stripslashes ( $field->getChoix2 () );
			break;
		case '3' :
			return stripslashes ( $field->getChoix3 () );
			break;
		case '4' :
			return stripslashes ( $field->getChoix4 () );
			break;
		case '5' :
			return stripslashes ( $field->getChoix5 () );
			break;
		case '6' :
			return stripslashes ( $field->getChoix6 () );
			break;
		case '7' :
			return stripslashes ( $field->getChoix7 () );
			break;
		case '8' :
			return stripslashes ( $field->getChoix8 () );
			break;
		case '9' :
			return stripslashes ( $field->getChoix9 () );
			break;
		case '10' :
			return stripslashes ( $field->getChoix10 () );
			break;
	}
}

if (isset ( $_GET ['id'] )) {
	// Write content of the CVS File

	header ( "Content-Type: application/csv-tab-delimited-table" );
	header ( "Content-disposition: filename=cube_reponses.csv" );

	$daoComposition = new ConventionFormulaireCompositionDAO ();
	$daoField = new ConventionFormulaireFieldDAO ();
	$daoReponse = new ConventionFormulaireFieldResponseDAO ();

	$listComposition = $daoComposition->findAllField ( $_GET ['id'] );

	$title = array ();
	$title [] = 'Nom';
	$title [] = 'Prénom';
	$title [] = 'Société';
	$title [] = 'Type';
	$title [] = 'ModeAjout';
	$title [] = 'Present';
	$title [] = 'Repas';
	// $title[] = 'Taxi';
	$title [] = 'Parking';
	$title [] = 'Diner';

	$listField = array ();
	if (count ( $listComposition ) > 0) {
		foreach ( $listComposition as $composition ) {
			$field = $daoField->find ( $composition->getId () );
			$listField [] = $field;
			$title [] = $field->getQuestion ();
		}
	}

	// Write Title
	foreach ( $title as $t ) {
		echo '"' . $t . '";';
	}
	echo "\n";

	// ###################################################

	// SELECTION Utilisateur
	$sql = "SELECT DISTINCT(userid), a.Nom, a.Prenom, a.Societe, (CASE a.AnnuaireTypeID WHEN '1' THEN '1. Concessionnaire / Directeur Général'
			WHEN '2' THEN '2. Directeur de concession'
			WHEN '3' THEN '3. REAGROUP'
			WHEN '4' THEN '4. Constructeur'
			WHEN '5' THEN '5. Partenaires'
			ELSE '6. Nos autres invités' END) as AnnuaireTypeID,
		(CASE a.TypeInscription
			WHEN '0' THEN 'Import GCR'
			WHEN '1' THEN 'Manuel'
			ELSE 'Invite' END) as ModeAjout,
		(CASE a.Presence WHEN '1' THEN 'OUI' ELSE 'NON' END) as Presence,
		(CASE a.Repas WHEN '1' THEN 'OUI' ELSE 'NON' END) as Repas,
		(CASE a.Taxi WHEN '1' THEN 'OUI' WHEN '0' THEN 'NON' ELSE '' END) as Taxi,
		(CASE a.Diner WHEN '1' THEN 'OUI' WHEN '0' THEN 'NON' ELSE '' END) as Diner
			FROM conv_formulaire_response r, conv_annuaire a
		WHERE a.AnnuaireID = r.userid AND r.fieldid IN (SELECT id FROM `conv_formulaire_composition` WHERE  type='field' AND formulaireid='%s')";
	$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_GET ['id'] ) );
	$resQueryUser = mysqli_query ($_SESSION['LINK'], $query );
	while ( $line = mysqli_fetch_array  ( $resQueryUser ) ) {
		echo '"' . stripslashes ( $line [1] ) . '";'; // Nom
		echo '"' . stripslashes ( $line [2] ) . '";'; // Prenom
		echo '"' . stripslashes ( $line [3] ) . '";'; // Societe
		echo '"' . stripslashes ( $line [4] ) . '";'; // Type
		echo '"' . stripslashes ( $line [5] ) . '";'; // ModeAjout
		echo '"' . stripslashes ( $line [6] ) . '";'; // Presence
		echo '"' . stripslashes ( $line [7] ) . '";'; // Repas
		echo '"' . stripslashes ( $line [8] ) . '";'; // Taxi / Parking
		echo '"' . stripslashes ( $line [9] ) . '";'; // Diner

		foreach ( $listField as $field ) {
			$responses = $daoReponse->findAll ( $field->getId (), $line [0] );

			switch ($field->getType ()) {
				case '1' : // Text Simple
				case '2' : // Text Large
					$responses = $responses [0];
					echo '"' . stripslashes ( $responses->getValeur () ) . '";';
					break;
				case '3' : // Liste deroulante
				case '5' : // Bouton radio
					$responses = $responses [0];
					echo '"' . getFieldValeur ( $field, $responses->getValeur () ) . '";';
					break;
				case '4' : // Case a cocher
					$valeur = array ();

					foreach ( $responses as $response ) {
						$valeur [] = getFieldValeur ( $field, $response->getValeur () );
					}

					echo '"' . implode ( "\n", $valeur ) . '";';
					break;
			}
		}
		echo "\n";
	}
}
include ('../../../../include/DbDeconnexion.php');
?>