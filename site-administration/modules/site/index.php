<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage site
 * @version 1.0.4
 */
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
<link href="../../include/css/style.css" rel="stylesheet"
	type="text/css" />
<link href="../../include/css/site.css" rel="stylesheet" type="text/css" />
<link href="../../include/css/table.css" rel="stylesheet"
	type="text/css" />

<!-- Librairie JQUERY -->
<script type="text/javascript"
	src="../../include/js/jquery/jquery.1.4.2.js"></script>

<script type="text/javascript" src="../../include/js/script.js"></script>

<script type="text/javascript"
	src="../../include/js/jquery_popup/jquery.popup.js"></script>
<link href="../../include/js/jquery_popup/jquery.popup.css"
	rel="stylesheet" type="text/css" />
<title><?php echo $_SESSION['SITE']['NAME'];?> : Admin</title>
</head>
<body>

	<div class="headerContainer">
		<table width="100%">
			<tr>
				<td width="313"><img
					src="../../include/images/LogoAdministration.JPG" /></td>
				<td align="right" valign="bottom">
				
				<?php
				if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
					echo 'Site : <i>' . $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '</i><br/>';
					echo '<a href="../../?action=q"><img src="../../include/images/bt/deconnexion.jpg" border="0" /></a>';
				}
				?>
			</td>
			</tr>
		</table>
	</div>

	<div class="page">
<?php
if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion BDD
	include ('../../../config/configuration.php');
	require ('../../include/DbConnexion.php');

	$baseURLModule = '../../modules/';
	require ('../mvc_inc.php');
	// Traitement des actions
	if (isset ( $_GET ['action'] )) {
		$aSiteControler = new SiteControler ();
		$aSiteControler->run ();
	}

	// Afficher la Liste des User
	if (! isset ( $_GET ['action'] )) {

		$aListeSite = new ListeSite ();
		$aListeSite->select_all_site ();
		$aListeSiteView = new ListeSiteView ( $aListeSite );
		$aListeSiteView->render ();
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