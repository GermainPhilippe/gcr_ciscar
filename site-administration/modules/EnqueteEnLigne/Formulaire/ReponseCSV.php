<?php
session_start ();

$baseURLModule = '../../../modules/';
require ('../../mvc_inc.php');
include ('../../../../config/configuration.php');
include ('../../../include/DbConnexion.php');
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

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	if (isset ( $_GET ['id'] )) {
		$EnqueteFormulaireManager = new EnqueteFormulaireDAO ();
		$EnqueteFormulaire = $EnqueteFormulaireManager->find ( $_GET ['id'] );
		// var_dump($EnqueteFormulaire->getID());

		$EnqueteFormulaireFieldResponseManager = new EnqueteFormulaireFieldResponseDAO ();
		$listResponse = $EnqueteFormulaireFieldResponseManager->findAllByEnquete ( $_GET ['id'] );
		// var_dump($listResponse);

		$EnqueteFormulaireCompositionManager = new EnqueteFormulaireCompositionDAO ();
		$compositionEnquete = $EnqueteFormulaireCompositionManager->findAllField ( $_GET ['id'] );
		// var_dump($compositionEnquete);

		// echo "----------------------------------------------------------------------------------------------------------------<br />";
		$listQuestion = array ();
		foreach ( $compositionEnquete as $field ) {
			$EnqueteFormulaireFieldManager = new EnqueteFormulaireFieldDAO ();
			$question = $EnqueteFormulaireFieldManager->find ( $field->getId () );
			$listQuestion [$field->getId ()] = $question;
		}
		// echo "----------------------------------------------------------------------------------------------------------------<br />";
		// var_dump($listQuestion);

		$EnqueteResponseView = new EnqueteResponseView ( $listQuestion, $listResponse );
		$EnqueteResponseView->renderCSV ();
	}
} else {
	// Formulaire de connexion
	$aff = '<script type="text/javascript">';
	$aff .= 'document.location.href="../../index.php";';
	$aff .= '</script>';
	echo $aff;
}

include ('../../../include/DbDeconnexion.php');
?>