<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage listeDiffusion
 * @version 2.0.1
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<?php
	echo HelperHead::includeCSS ( '../../include/css/Commun.css' );
	echo HelperHead::includeCSS ( '../../include/css/CommunLayout.css' );
	echo HelperHead::includeJS ( '../../include/js/script.js' );
	echo HelperHead::includeJS ( '../../include/js/jquery/jquery-1.4.2.js' );

	echo HelperHead::includeJS ( '../../include/js/listeDiffusion.js' );
	echo HelperHead::includeCSS ( '../../include/js/jquery/treeTable/treeTable.css' );
	echo HelperHead::includeCSS ( '../../include/js/jquery/treeTable/treeTable.css' );
	echo HelperHead::includeJS ( '../../include/js/jquery/datepicker/jquery-ui.min.js' );
	echo HelperHead::includeCSS ( '../../include/js/jquery/datepicker/jquery-ui.css' );
	?>
	<title><?php echo $_SESSION['SITE']['NAME'];?> : Admin</title>
<script type="text/javascript">
		function confirmDelete(doc_id)
		{
			if(confirm("Confirmation de suppression"))
			{
				document.location.href='?action=delete&id='+doc_id;	
			}
		}
	</script>

<script type="text/javascript">
	    function OpenCloseDiv(listid)
	    {	    	
			div = document.getElementById('div-'+ listid);
			if (div.style.display == 'block')
				div.style.display = 'none';
			else
				div.style.display = 'block';
}
	</script>
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
		$aControler = new listeDiffusionControler ();
		$aControler->run ();
	}

	// Afficher les Liste de diffusion
	if (! isset ( $_GET ['action'] )) {
		$aManager = new ListeDiffusionManager ();
		$aListeDiffusionCollectionView = new ListeDiffusionCollectionView ( $aManager->getList ( - 1, - 1, 'Outlook' ) );
		$aListeDiffusionCollectionView->renderHTML ( 'Outlook' );
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
		<a href="http://www.ciscar.fr/admin"><img
			src="../../include/images/phiphijajacorp.jpg" width="100" border="0" /></a><br>
		&copy; 2015 - 2026
	</div>

</body>
</html>