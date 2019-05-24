<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
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
<script type="text/javascript" src="../../../include/js/script.js"></script>
<link href="../../../include/css/style.css" rel="stylesheet"
	type="text/css" />
<link href="../../../include/css/site.css" rel="stylesheet"
	type="text/css" />
<script type="text/javascript"
	src="../../../include/js/jquery/jquery-1.4.2.js"></script>
<script type="text/javascript"
	src="../../../include/js/jquery_popup/jquery.popup.js"></script>
<link href="../../../include/js/jquery_popup/jquery.popup.css"
	rel="stylesheet" type="text/css" />
<title><?php echo $_SESSION['SITE']['NAME'];?> : Admin</title>
</head>
<body>

	<div class="headerContainer">
		<table width="100%">
			<tr>
				<td width="313"><img
					src="../../../include/images/LogoAdministration.JPG" /></td>
				<td align="right" valign="bottom">
				
				<?php
				if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
					echo 'Site : <i>' . $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '</i><br/>';
					echo '<a href="../../../?action=q"><img src="../../../include/images/bt/deconnexion.jpg" border="0" /></a>';
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
	include ('../../../../config/configuration.php');
	require ('../../../include/DbConnexion.php');

	$baseURLModule = '../../../modules/';
	require ('../../mvc_inc.php');

	// Traitement des actions
	if (isset ( $_GET ['action'] )) {
		$aSiteGroupeLCAControler = new SiteGroupeLCAControler ();
		$aSiteGroupeLCAControler->run ();
	}

	// Afficher la Liste des User
	if (! isset ( $_GET ['action'] )) {

		$query = sprintf ( "SELECT GroupeID FROM annuaire_lca_groupe WHERE SiteID=(SELECT SiteID FROM annuaire_site WHERE Nom='%s' and AnnuaireID='%s') and ParentID IS NULL", mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['SiteName'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line = mysqli_fetch_array  ( $result );

		$aSiteGroupeLCA = new SiteGroupeLCA ();
		$aSiteGroupeLCA->select_groupelca ( $line [0] );

		mysqli_free_result  ( $result );

		$aSiteGroupeLCAListe = new SiteGroupeLCAListe ();
		$aSiteGroupeLCAListe->addSiteGroupeLCA ( $aSiteGroupeLCA );
		$aSiteGroupeLCAListe->select_all_sitegroupelca_fils ( $aSiteGroupeLCA->getID () );

		$aListeSiteGroupeLCAView = new ListeSiteGroupeLCAView ( $aSiteGroupeLCAListe );
		$aListeSiteGroupeLCAView->render ();
	}

	// Deconnexion BDD
	require ('../../../include/DbDeconnexion.php');
} else {
	// Formulaire de connexion
	$aff = '<script type="text/javascript">';
	$aff .= 'document.location.href="../../../index.php";';
	$aff .= '</script>';
	echo $aff;
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