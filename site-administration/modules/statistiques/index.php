<?php
/**
 * Index du menu des statistiques pour le site Choisi
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
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
function site($id) {
	switch ($id) {
		case 3 :
			return 'ACNF';
			break;
		case 1 :
			return 'CISCAR';
			break;
		case 2 :
			return 'GCR';
			break;
		case 7 :
			return 'GCRE';
			break;
	}
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<?php
	echo HelperHead::includeCSS ( '../../include/css/Commun.css' );
	echo HelperHead::includeCSS ( '../../include/css/CommunLayout.css' );

	echo HelperHead::includeJS ( '../../include/js/script.js' );
	echo HelperHead::includeJS ( '../../include/js/jquery/jquery-1.4.2.js' );
	echo HelperHead::includeCSS ( '../../include/js/jquery_pagination/pagination.css' );
	echo HelperHead::includeJS ( '../../include/js/jquery_pagination/jquery.pagination.js' );
	?>
	
    <script type="text/javascript">
		function pageselectCallback(page_index, jq){
			$.get("index.php",{page:numpage})
			return false;
		}

		function confirmDelete(doc_id)
	    {
	    	if(confirm("Confirmation de suppression (ensemble des annuaires)"))
	    	{
	    		document.location.href='?action=delete&id='+doc_id;	
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
<title><?php echo $_SESSION['SITE']['NAME'];?> : Admin</title>
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
		$aStatistiquesControler = new StatistiquesControler ();
		$aStatistiquesControler->run ();
	}

	if (! isset ( $_GET ['action'] )) {

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../?menu=6">Admin</a>&nbsp;>&nbsp;Statistiques ' . site ( $_GET ['site'] );
		$aff .= '</div><br />';
		echo $aff;

		$aff = '<div>
						<table border="1">
							<tr>
								<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">
									<a href="?site=' . $_GET ['site'] . '&action=top" style="text-decoration:none;color:#000000;"><img height ="65" src="../../include/images/icon/podium.png" border="0"/><br/>
									<b>Top 20 des consultations</b></a>
								</td>
								<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">
									<a href="?site=' . $_GET ['site'] . '&action=consult" style="text-decoration:none;color:#000000;"><img src="../../include/images/icon/stats.jpg" border="0"/><br/>
									<b><br />Nombre de consultations par Doc</b></a>
								</td>
								<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">
									<a href="?site=' . $_GET ['site'] . '&action=domaine" style="text-decoration:none;color:#000000;"><img height="65" src="../../include/images/icon/chart.png" border="0"/><br/>
									<b>R&eacute;partition par Domaine d\'activit&eacute;</b></a>
								</td>
							</tr>
							<tr>
								<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">
									<a href="?site=' . $_GET ['site'] . '&action=type" style="text-decoration:none;color:#000000;"><img height="65" src="../../include/images/icon/chart.png" border="0"/><br/>
									<b>R&eacute;partition par Type de publication</b></a>
								</td>
								<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">
									<a href="?site=' . $_GET ['site'] . '&action=dr" style="text-decoration:none;color:#000000;"><img height="65"  src="../../include/images/icon/chart.png" border="0"/><br/>
									<b>R&eacute;partition par DR</b></a>
								</td>
								<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">
									<a href="?site=' . $_GET ['site'] . '&action=frequentation" style="text-decoration:none;color:#000000;"><img width="60"  src="../../include/images/icon/graph.png" border="0"/><br/>
									<b>Fr&eacute;quentation Quotidienne</b></a>
								</td>
							</tr>
							<tr>
								<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">
									<a href="?site=' . $_GET ['site'] . '&action=frequentationIndividu" style="text-decoration:none;color:#000000;"><img width="60"  src="../../include/images/icon/graph.png" border="0"/><br/>
									<b>Fr&eacute;quentation Individu</b></a>
								</td>
								<!--<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">
									<a href="?site=' . $_GET ['site'] . '&action=Listeouverturescomptes" style="text-decoration:none;color:#000000;"><img width="60"  src="../../include/images/icon/preferences-contact-list.png" border="0"/><br/>
									<b>Demandes d\'ouvertures de comptes</b></a>
								</td>-->
							</tr>
						</table>
					</div>';
		echo $aff;
	}
}
?>
</div>

	<div class="footerContainer">
		<a href="http://www.abakus.fr"> <img
			src="../../include/images/Logo_AbaKus.png" width="100" border="0" /></a>&nbsp;&nbsp;<a
			href="http://www.ebrueggeman.com/phpgraphlib"><img border="0"
			src="../../include/images/phpgraphlib_80x15_green.png"
			alt="PHPGraphLib - Click For Official Site" width="80" height="15"
			align="top" style="margin-right: 10px;" /></a><br> AbaKus &copy; 2009
		- 2012
	</div>
</body>
</html>