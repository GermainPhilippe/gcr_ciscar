<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @version 1.0.4
 */
session_start ();

// On supprimer l'effet de l'option magic_quotes_gpc
if (function_exists ( 'get_magic_quotes_gpc' ) && get_magic_quotes_gpc ()) {
	// Create lamba style unescaping function (for portability)
	$quotes_sybase = strtolower ( ini_get ( 'magic_quotes_sybase' ) );
	$unescape_function = (empty ( $quotes_sybase ) || $quotes_sybase === 'off') ? 'stripslashes($value)' : 'str_replace("\'\'","\'",$value)';
	$stripslashes_deep = create_function ( '&$value, $fn', '
			if (is_string($value)) {
				$value = ' . $unescape_function . ';
			} else if (is_array($value)) {
				foreach ($value as &$v) $fn($v, $fn);
			}
		' );

	// Unescape data
	$stripslashes_deep ( $_POST, $stripslashes_deep );
	$stripslashes_deep ( $_GET, $stripslashes_deep );
	$stripslashes_deep ( $_COOKIE, $stripslashes_deep );
	$stripslashes_deep ( $_REQUEST, $stripslashes_deep );
}

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

if (isset ( $_GET ['action'] )) {
	if ($_GET ['action'] == 'q') {
		$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	}
}

switch ($_SERVER ['HTTP_HOST']) {
	case 'acnf.local' :
	case 'acnf.dev' :
	case 'www.gcnf.fr' :
	case 'gcnf.fr' :
	case 'test.gcnf.fr' :
		$_SESSION ['SITE'] ['ID'] = 3;
		$_SESSION ['SITE'] ['NAME'] = 'ACNF';
		break;
	case 'ciscar.local' :
	case 'ciscar.dev' :
	case 'ciscar.vm' :
	case 'www.ciscar.fr' :
	case 'test.ciscar.fr' :
	case 'ciscar.fr' :
		$_SESSION ['SITE'] ['ID'] = 1;
		$_SESSION ['SITE'] ['NAME'] = 'CISCAR';
		break;
	case 'gcr.local' :
	case 'gcrfrance.local' :
	case 'gcrfrance.vm' :
	case 'gcr.dev' :
	case 'www.gcrfrance.com' :
	case 'test.gcrfrance.com' :
	case 'gcrfrance.com' :
		$_SESSION ['SITE'] ['ID'] = 2;
		$_SESSION ['SITE'] ['NAME'] = 'GCR';
		break;
	case 'gcre.local' :
	case 'gcre.dev' :
	case 'gcre.gcrfrance.com' :
	case 'www.gcre.gcrfrance.com' :
		$_SESSION ['SITE'] ['ID'] = 7;
		$_SESSION ['SITE'] ['NAME'] = 'GCRE';
		break;
}

$baseURLModule = 'modules/';
require ('modules/mvc_inc.php');

header ("content-type: text/html; charset=ISO-8859-1");

?>
<html>
<head>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /> -->
<META NAME="robots" CONTENT="none">
<link href="include/css/Commun.css" rel="stylesheet" type="text/css" />
<link href="include/css/CommunLayout.css" rel="stylesheet"
	type="text/css" />
<title><?php echo $_SESSION['SITE']['NAME']; ?> : Admin</title>

<!-- Librairie JQUERY -->
<script type="text/javascript" src="include/js/jquery/jquery-1.8.2.js"></script>

<!-- Plugin JQUERY Tools Tab -->
<script type="text/javascript"
	src="include/js/jquery/Tools_Tabs/tools.tabs-1.0.4.js"></script>
<link href="include/js/jquery/Tools_Tabs/css/tabs.css" rel="stylesheet"
	type="text/css" />
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
include_once 'searchBar_inc.php';

if (isset ( $_GET ['IDSage'] ) || isset ( $_GET ['IDGcr'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = FALSE;
}
if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) 
{

	// Gestion des conteneurs
	$aMenuModuleView = new MenuModuleView ( $ROLE_RULES, $menuID );
	$aMenuModuleView->renderHTML ();

	echo '</div>';
} else {
	// Connexion BDD
	include ('../config/configuration.php');
	require ('include/DbConnexion.php');

	// Formulaire de connexion
	$aUserControler = new UserControler ();
	$aUserControler->run ();

	// Deconnexion BDD
	require ('include/DbDeconnexion.php');
}
?>
</div>

	<div class="footerContainer">
		<a href="http://www.abakus.fr"> <img
			src="include/images/Logo_AbaKus.png" width="100" border="0" /></a><br>
		AbaKus &copy; 2009 - 2012
	</div>
</body>
</html>