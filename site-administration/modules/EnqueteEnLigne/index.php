<?php
/**
 * @author Yoann Reversat
 * @package site-administration
 * @subpackage FormulaireEnLigne
 * @version 2.0.1
 */
session_start ();
if (isset ( $_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] )) {
	if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
		// Connexion BDD
		$baseURLModule = '../../modules/';
		require ('../mvc_inc.php');
		include ('../../../config/configuration.php');
		include ('../../include/DbConnexion.php');
	}
} else {
	// Formulaire de connexion
	$aff = '<script type="text/javascript">';
	$aff .= 'document.location.href="../../index.php";';
	$aff .= '</script>';
	echo $aff;
}

?>

<!doctype html>
<html>
<head>
<title>Enquête du GCR</title>
<meta charset="iso-8859-1">
<meta name="viewport" content="width=device-width,initial-scale=1">

<!-- Framework CSS -->
<link rel="stylesheet" href="../../include/css/blueprint/screen.css"
	type="text/css" media="screen, projection">
<link rel="stylesheet" href="../../include/css/blueprint/print.css"
	type="text/css" media="print">
<!--[if lt IE 8]><link rel="stylesheet" href="web/css/blueprint/ie.css" type="text/css" media="screen, projection"><![endif]-->

<script type="text/javascript"
	src="../../include/js/jquery/jquery-3.0.0.js"></script>
	
<link rel="stylesheet" href="../../include/bootstrap/css/bootstrap.css">
<script src="../../include/bootstrap/js/bootstrap.js"></script>
<link href="https://fonts.googleapis.com/css?family=Fjalla+One"
	rel="stylesheet">
<?php
if (isset ( $_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] )) {
	$paramCSS = new ParametreEnquete ();
	
	//Style par défaut
	//$paramCSS->search_param ( 'PAGE_CSS_STYLE' );
	
	//Style pour enquete Satisfaction
	//$paramCSS->search_param ( 'PAGE_ENQUETE_CSS_STYLE' );
	
	//Style pour Tour De France
	$paramCSS->SQL_select_by_name ( 'PAGE_TDF_CSS_STYLE' );

	echo '<style type="text/css">' . stripslashes ( $paramCSS->getValeur () ) . '</style>';
}
?>
</head>
<body>
	<div class="row" style="margin-right:0px;margin-left:0px;">
		<div class="col-lg-3 col-md-2 hidden-sm hidden-xs"></div>
		<div class="col-lg-6 col-md-8 col-sm-12 col-xs-12 container">
<!--<div class="container"> -->
		<form method="post" id="formId">

<?php

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {

	// Traitement des actions
	if (isset ( $_GET ['form-preview'] )) {
		$daoComposition = new EnqueteFormulaireCompositionDAO ();
		$list = $daoComposition->findAll ( $_GET ['form-preview'] );
		$view = new FormulaireView ( $list );
		$view->renderHTML ();
	}

	// Deconnexion BDD
	require ('../../include/DbDeconnexion.php');
} else {
	// Formulaire de connexion
	$aff = '<script type="text/javascript">';
	$aff .= 'document.location.href="../../index.php";';
	$aff .= '</script>';
	echo $aff;
}
?>
</form>
	
</div>
<div class="col-lg-3 col-md-2 hidden-sm hidden-xs"></div>
</div>


</body>
</html>
