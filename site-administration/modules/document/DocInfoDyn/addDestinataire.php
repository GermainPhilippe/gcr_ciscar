<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 2.0.1
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

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<?php
	echo HelperHead::includeCSS ( '../../../include/css/Commun.css' );
	echo HelperHead::includeCSS ( '../../../include/css/CommunLayout.css' );
	echo HelperHead::includeJS ( '../../../include/js/CommunScript.js' );
	echo HelperHead::includeCSS ( '../../../include/css/Individu.css' );
	echo HelperHead::includeJS ( '../../../include/js/Individu.js' );
	// echo HelperHead::includeJS('../../include/js/script.js');
	echo HelperHead::includeJS ( '../../../include/js/jquery/jquery-1.4.2.js' );
	echo HelperHead::includeCSS ( '../../../include/js/jquery_pagination/pagination.css' );
	echo HelperHead::includeJS ( '../../../include/js/jquery_pagination/jquery.pagination.js' );
	?>
	
    <script type="text/javascript">
		function pageselectCallback(page_index, jq){
			$.get("index.php",{page:numpage})
			return false;
		}
	</script>
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

	// Afficher la Liste des User
	if (! isset ( $_GET ['action'] )) {
		// Avec Recherche
		if (isset ( $_POST ['Recherche'] ) && $_POST ['Recherche'] != NULL) {
			$NbEntre = 0;
			$aModeleList = new Simple_IndividuList ();
			$aModeleList->SQL_SEARCH ( isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, $_POST ['Recherche'], isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
			// Element Max
			$NbEntre = $aModeleList->SQL_SEARCH_COUNT ( $_POST ['Recherche'] );
		} elseif (isset ( $_GET ['Recherche'] ) && $_GET ['Recherche'] != NULL) {
			$NbEntre = 0;
			$aModeleList = new Simple_IndividuList ();
			$aModeleList->SQL_SEARCH ( isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, $_GET ['Recherche'], isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
			// Element Max
			$NbEntre = $aModeleList->SQL_SEARCH_COUNT ( $_GET ['Recherche'] );
		} // Sans Recherche
		else {
			$NbEntre = 0;
			$aModeleList = new Simple_IndividuList ();
			$aModeleList->SQL_SELECT_PAGE ( isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '2', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'a' );
			// Element Max
			$NbEntre = $aModeleList->SQL_COUNT ();
		}

		$aViewList = new DocInfoDynCommentaireDestinataireView ( $aModeleList, $NbEntre );
		$aViewList->renderHTML ();

		unset ( $aModeleList );
		unset ( $aViewList );
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