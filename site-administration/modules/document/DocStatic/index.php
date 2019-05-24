<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

$baseURLModule = '../../../modules/';
require ('../../mvc_inc.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<?php
	echo HelperHead::includeCSS ( '../../../include/css/Commun.css' );
	echo HelperHead::includeCSS ( '../../../include/css/CommunLayout.css' );
	echo HelperHead::includeJS ( '../../../include/js/jquery/jquery-1.4.2.js' );
	echo HelperHead::includeJS ( '../DocInfoDyn/include/jquery.tablesorter.min.js' );

	echo HelperHead::includeJS ( '../../../include/js/CommunScript.js' );
	echo HelperHead::includeJS ( '../../../include/js/formulaire_v3.js' );
	?>
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
<title><?php echo $_SESSION['SITE']['NAME'];?> : Admin</title>
</head>
<body style="font-size: 62.5%;">

<?php
include_once '../../../searchBar_inc.php';

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	include ('../../../../config/configuration.php');
	include ('../../../include/DbConnexion.php');

	if (isset ( $_GET ['action'] )) {
		$aControler = new DocStaticControler ();
		$aControler->run ();
	} else {
		$aList = new DocStaticList ();
		$aList->SQL_select_all ();

		$aView = new DocStaticListView ( $aList->getList () );
		$aView->render ();
	}
	// DB Deconnection
	include ('../../../include/DbDeconnexion.php');
} else {
	echo CommunFunction::goToURL ( '../../../index.php' );
}
?>
</div>

	<div class="footerContainer">
		<a href="http://www.abakus.fr"> <img
			src="../../../include/images/Logo_AbaKus.png" width="100" border="0" /></a><br>
		AbaKus &copy; 2009 - 2012
	</div>
</body>
</html>