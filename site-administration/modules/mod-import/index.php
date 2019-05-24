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

header ("content-type: text/html; charset=ISO-8859-15");

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
?>
<title><?php echo $_SESSION['SITE']['NAME'];?> : Admin</title>
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

label {
	width: 130px;
	display: inline-block;
}
</style>
<script>

	$(document).ready(function(){
		$("#DomainActiviteID").change(function(){
			$.ajax({
				type: "GET",
				url: "../lva/FonctionDA/indexAJAX.php",
				data: "action=list&id="+$("#DomainActiviteID").val(),
				success: function(msg){
					$("#FonctionDAID").html(msg);
				}
			});
			return false;
		});

		$("#formImportIndividu").submit(function(){
			return ($("#URLFile").val() != "" &&
					$("#DomainActiviteID").val() != "0" &&
					$("#FonctionDAID").val() != "" && $("#FonctionDAID").val() != "0");
		});
	});
	</script>
</head>
<body>

	<?php
	include_once '../../searchBar_inc.php';

	if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
		// Connexion BDD
		include ('../../../config/configuration.php');
		require ('../../include/DbConnexion.php');

		$controller = new ImportIndividuController ();
		$controller->run ();

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
			src="../../include/images/Logo_AbaKus.png" width="100" border="0" />
		</a><br> AbaKus &copy; 2009 - 2012
	</div>

</body>
</html>
