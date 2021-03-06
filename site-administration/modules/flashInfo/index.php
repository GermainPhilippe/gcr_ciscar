<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage FlashInfo
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
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<?php
	echo HelperHead::includeCSS ( '../../include/css/Commun.css' );
	echo HelperHead::includeCSS ( '../../include/css/CommunLayout.css' );
	echo HelperHead::includeJS ( '../../include/js/CommunScript.js' );
	echo HelperHead::includeJS ( '../../include/js/jquery/jquery-1.4.2.js' );
	echo HelperHead::includeCSS ( '../../include/js/jquery/datepicker/jquery-ui.css' );
	echo HelperHead::includeJS ( '../../include/js/jquery/datepicker/jquery-ui.min.js' );
	echo HelperHead::includeJS ( '../../include/js/jquery/datepicker/ui.datepicker-fr.js' );

	echo HelperHead::includeJS ( '../../include/js/FlashInfo.js' );
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
		$(document).ready(function(){
			$("#DateFin").datepicker();
			$("#DateDebut").datepicker();
		});

		function validateForm()
		{
			var result = true;
			var msg = "";

			if($("#Nom").val()=='')
			{
				result = false;
				msg += "-le champ Nom ne doit pas être vide\n";
			}
			if($("#DateDebut").val()=='')
			{
				result = false;
				msg += "-le champ DateDebut ne doit pas être vide\n";
			}
			if($("#DateFin").val()=='')
			{
				result = false;
				msg += "-le champ DateFin ne doit pas être vide\n";
			}
			
			if($("#DateDebut").val()!='' && $("#DateFin").val()!='')
			{
				if(FRversUS($("#DateDebut").val())>FRversUS($("#DateFin").val()))
				{
					result = false;	
					msg += " - Date Fin doit être supérieur à Date Début\n";
				}
			}

			if(!result)
			{
				alert(msg);
			}
			return result;
		}
		function FRversUS(aDate)
		{
			var str = aDate.split('/',3);
			if(str.lenght<3)
			{
				return aDate;
			}
			else
			{
				return str[1]+'/'+str[0]+'/'+str[2];
			}
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
		$aControler = new FlashInfoControler ();
		$aControler->run ();
	}

	// Afficher les Liste de diffusion
	if (! isset ( $_GET ['action'] )) {
		$aManager = new FlashInfoManager ();
		$aFlashInfoListView = new FlashInfoListView ( $aManager->getList () );
		$aFlashInfoListView->renderHTML ();
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
		<a href="http://www.abakus.fr"><img
			src="../../include/images/Logo_AbaKus.png" width="100" border="0" /></a><br>
		AbaKus &copy; 2009 - 2012
	</div>

</body>
</html>