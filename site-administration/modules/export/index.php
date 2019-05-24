<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
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
	echo HelperHead::includeJS ( '../../include/js/CommunScript.js' );
	echo HelperHead::includeCSS ( '../../include/css/Commun.css' );
	echo HelperHead::includeCSS ( '../../include/css/CommunLayout.css' );

	echo HelperHead::includeJS ( '../../include/js/jquery/jquery-1.4.2.js' );
	echo HelperHead::includeCSS ( '../../include/js/jquery_pagination/pagination.css' );
	echo HelperHead::includeJS ( '../../include/js/jquery_pagination/jquery.pagination.js' );
	?>
	<script type="text/javascript">
        	function pageselectCallback(page_index, jq){
                $.get("index.php",{page:numpage})
				return false;
            }

        	 $(document).ready(function(){
     			var htmlStr = $("#Pagination").html();	
 			});     
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
<title><?php echo $_SESSION['SITE']['NAME'];?> : Admin</title>
</head>
<body>

<?php
include_once '../../searchBar_inc.php';

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion BDD
	include ('../../../config/configuration.php');
	require ('../../include/DbConnexion.php');

	if (isset ( $_GET ['action'] )) {
		$aControler = new ExportControler ();
		$aControler->run ();
	} else {
		$aff = '<div id="FilAriane"><a href="../../?menu=1">Général</a>&nbsp;>&nbsp;Export</div><br/><br/>';
		$aff .= '<table>';
		$aff .= '<tr style="background:#CCCCCC;">';
		$aff .= '<th>Nom</th>';
		$aff .= '<th colspan="3">Format</th>';
		$aff .= '</tr>' . PHP_EOL;

		$aff .= '<tr style="background:#DDD;">';
		$aff .= '<td>Anomalie Individu sans r&ocirc;le</td>';
		$aff .= '<td><a href="?action=anomalie_individu" style="text-decoration:underline;"><img src="../../include/images/export/html_file.png" /></a></td>';
		$aff .= '<td><a href="../app-export/view.php?name=IndividuSansRole" style="text-decoration:underline;"><img src="../../include/images/export/csv_file.png" /></a></td>';
		$aff .= '<td></td>';
		$aff .= '</tr>' . PHP_EOL;

		$aff .= '<tr>';
		$aff .= '<td>Anomalie Individu sans LoginSage</td>';
		$aff .= '<td></td>';
		$aff .= '<td><a href="../app-export/view.php?name=AnomalieIndividuSansLoginSage" style="text-decoration:underline;"><img src="../../include/images/export/csv_file.png" /></a></td>';
		$aff .= '<td></td>';
		$aff .= '</tr>' . PHP_EOL;

		$aff .= '<tr style="background:#DDD;">';
		$aff .= '<td>Anomalie R&ocirc;le sans Domaine d\'activit&eacute; / Fonction</td>';
		$aff .= '<td><a href="?action=anomalie_role" style="text-decoration:underline;"><img src="../../include/images/export/html_file.png" /></a></td>';
		$aff .= '<td></td>';
		$aff .= '<td></td>';
		$aff .= '</tr>' . PHP_EOL;

		$aff .= '<tr>';
		$aff .= '<td>Anomalie Etablissement sans individu</td>';
		$aff .= '<td><a href="?action=anomalie_etablissement" style="text-decoration:underline;"><img src="../../include/images/export/html_file.png" /></a></td>';
		$aff .= '<td></td>';
		$aff .= '<td></td>';
		$aff .= '</tr>' . PHP_EOL;

		$aff .= '<tr style="background:#DDD;">';
		$aff .= '<td>Export Feuille &agrave; Feuille</td>';
		$aff .= '<td></td>';
		$aff .= '<td></td>';
		$aff .= '<td><a href="indexSimple.php?action=export_faf" target="_BLANK" style="text-decoration:underline;"><img src="../../include/images/export/txt_file.png" /></a></td>';
		$aff .= '</tr>' . PHP_EOL;

		$aff .= '<tr>';
		$aff .= '<td>Export Sage Individu</td>';
		$aff .= '<td></td>';
		$aff .= '<td></td>';
		$aff .= '<td><a href="indexSimple.php?action=sage_individu" target="_BLANK" style="text-decoration:underline;"><img src="../../include/images/export/txt_file.png" /></a></td>';
		$aff .= '</tr>' . PHP_EOL;

		$aff .= '<tr style="background:#DDD;">';
		$aff .= '<td>Export Sage Etablissement</td>';
		$aff .= '<td></td>';
		$aff .= '<td></td>';
		$aff .= '<td><a href="indexSimple.php?action=sage_etablissement" target="_BLANK" style="text-decoration:underline;"><img src="../../include/images/export/txt_file.png" /></a></td>';
		$aff .= '</tr>' . PHP_EOL;

		$aff .= '<tr>';
		$aff .= '<td>Autologin ICOM</td>';
		$aff .= '<td></td>';
		$aff .= '<td><a href="indexSimple.php?action=autologin" target="_BLANK" style="text-decoration:underline;"><img src="../../include/images/export/csv_file.png" /></a></td>';
		$aff .= '<td></td>';
		$aff .= '</tr>' . PHP_EOL;

		if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'CISCAR') {
			$aff .= '<tr style="background:#DDD;">';
			$aff .= '<td>Export Individu Catalogue</td>';
			$aff .= '<td></td>';
			$aff .= '<td><a href="../app-export/view.php?name=ExportCatalogue" style="text-decoration:underline;"><img src="../../include/images/export/csv_file.png" /></a></td>';
			$aff .= '<td></td>';
			$aff .= '</tr>' . PHP_EOL;
		}

		$aff .= '<tr style="background:#DDD;">';
		$aff .= '<td>Export Individu</td>';
		$aff .= '<td></td>';
		$aff .= '<td><a href="../app-export/view.php?name=AnnuaireIndividu" style="text-decoration:underline;"><img src="../../include/images/export/csv_file.png" /></a></td>';
		$aff .= '<td></td>';
		$aff .= '</tr>' . PHP_EOL;

		$aff .= '<tr>';
		$aff .= '<td>Export Individu en sommeil</td>';
		$aff .= '<td></td>';
		$aff .= '<td><a href="../app-export/view.php?name=AnnuaireIndividuEnSommeil" style="text-decoration:underline;"><img src="../../include/images/export/csv_file.png" /></a></td>';
		$aff .= '<td></td>';
		$aff .= '</tr>' . PHP_EOL;

		$aff .= '<tr style="background:#DDD;">';
		$aff .= '<td>Export Etablissement</td>';
		$aff .= '<td></td>';
		$aff .= '<td><a href="../app-export/view.php?name=AnnuaireEtablissement" style="text-decoration:underline;"><img src="../../include/images/export/csv_file.png" /></a></td>';
		$aff .= '<td></td>';
		$aff .= '</tr>' . PHP_EOL;

		$aff .= '<tr>';
		$aff .= '<td>Export Role</td>';
		$aff .= '<td></td>';
		$aff .= '<td><a href="../app-export/view.php?name=AnnuaireRole" style="text-decoration:underline;"><img src="../../include/images/export/csv_file.png" /></a></td>';
		$aff .= '<td></td>';
		$aff .= '</tr>' . PHP_EOL;

		$aff .= '</table>';
		echo $aff;
	}
} else {
	echo CommunFunction::goToURL ( '../../?' );
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