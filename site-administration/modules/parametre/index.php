<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage parametre
 * @version 1.0.4
 */
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

$baseURLModule = '../../modules/';
require ('../mvc_inc.php');

header ("content-type: text/html; charset=ISO-8859-15");

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<?php
	echo HelperHead::includeCSS ( '../../include/css/Commun.css' );
	echo HelperHead::includeCSS ( '../../include/css/CommunLayout.css' );
	echo HelperHead::includeJS ( '../../include/js/CommunScript.js' );
	echo HelperHead::includeJS ( '../../include/js/jquery/jquery-1.4.2.js' );
	echo HelperHead::includeJS ( '../../include/js/formulaire_v3.js' );
	echo HelperHead::includeJS ( '../../include/js/fckeditor.js' );
	?>
	<title><?php echo $_SESSION['SITE']['NAME'];?> : Admin</title>
<script type="text/javascript">
		
	function displayTab(num)
	{
		//hide all tab
		$(".tabDocument").hide();
		$(".linkTabDocumentCurrent").removeClass();
		$("#linkTabAnnuaire").addClass("linkTabDocument");
		$("#linkTabCommentaire").addClass("linkTabDocument");
		$("#linkTabSondage").addClass("linkTabDocument");
		$("#linkTabDeals").addClass("linkTabDeals");
						
		switch(num)
		{
			case '1':
				$("#tabAnnuaire").show();
				$("#linkTabAnnuaire").addClass("linkTabDocumentCurrent");
				break;
			case '2':
				$("#tabCommentaire").show();
				$("#linkTabCommentaire").addClass("linkTabDocumentCurrent");
				break;
			case '3':
				$("#tabSondage").show();
				$("#linkTabSondage").addClass("linkTabDocumentCurrent");
				break;
			case '4':
				$("#tabDeals").show();
				$("#linkDeals").addClass("linkTabDocumentCurrent");
				break;
}
	}	
	</script>
<style type="text/css">
.linkTabDocument {
	display: block;
	width: 100px;
	background-color: #CCC;
	color: #000;
	border: solid 1px #000;
	line-height: 1em;
	text-align: center;
	text-decoration: none;
	padding: 4px 0;
}

.linkTabDocument:hover {
	background-color: #EEE;
}

.linkTabDocumentCurrent {
	display: block;
	width: 100px;
	background-color: #EEE;
	color: #000;
	border: solid 1px #000;
	line-height: 1em;
	text-align: center;
	text-decoration: none;
	padding: 4px 0;
}

.linkTabDocumentCurrent:hover {
	background-color: #CCC;
}
</style>
<!-- Plugin JQUERY Tools Tab -->
<script type="text/javascript"
	src="/admin/include/js/jquery/Tools_Tabs/tools.tabs-1.0.4.js"></script>
<link href="/admin/include/js/jquery/Tools_Tabs/css/tabs.css"
	rel="stylesheet" type="text/css" />
<style>
a:active {
	outline: none;
}

:focus {
	-moz-outline-style: none;
}

/* tab pane styling */
div.panes div {
	padding: 15px 10px;
	border: 1px solid #999;
	border-top: 0;
	font-size: 14px;
	background-color: #fff;
}
</style>
</head>
<body>

<?php
include_once '../../searchBar_inc.php';

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion BDD
	include ('../../../config/configuration.php');
	require ('../../include/DbConnexion.php');

	// Traitement des actions
	if (isset ( $_GET ['action'] )) {
		$aParamControler = new ParamControler ();
		$aParamControler->run ();
	}

	// Afficher la Liste des User
	if (! isset ( $_GET ['action'] )) {

		$aListeParam = new ListeParam ();
		$aListeParam->select_all_param ();
		// $aListeParamView = new ListeParamView($aListeParam);
		// $aListeParamView->render();
		$aParametrageGeneralView = new ParametrageGeneralView ( $aListeParam );
		$aParametrageGeneralView->renderHTML ();
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
</div>

	<div class="footerContainer">
		<a href="http://www.abakus.fr"> <img
			src="../../include/images/Logo_AbaKus.png" width="100" border="0" /></a><br>
		AbaKus &copy; 2009 - 2012
	</div>
</body>
</html>