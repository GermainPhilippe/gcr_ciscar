<?php
/**
 * Index de la partie statistiques du site-emploi
 * @author Alexandre DIALLO
 * @package app-site-emploi
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

$baseURLModule = '../../../modules/';
require ('../../mvc_inc.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<?php
	echo HelperHead::includeCSS ( '../../../include/css/Commun.css' );
	echo HelperHead::includeCSS ( '../../../include/css/CommunLayout.css' );

	echo HelperHead::includeJS ( '../../../include/js/script.js' );
	echo HelperHead::includeJS ( '../../../include/js/jquery/jquery-1.4.2.js' );
	echo HelperHead::includeCSS ( '../../../include/js/jquery_pagination/pagination.css' );
	echo HelperHead::includeJS ( '../../../include/js/jquery_pagination/jquery.pagination.js' );
	?>
	<script type="text/javascript">
        	function pageselectCallback(page_index, jq){
                $.get("index.php",{page:numpage})
				return false;
            }
        	function confirmDelete(doc_id)
    	    {
    	    	if(confirm("Confirmation de suppression"))
    	    	{
    	    		document.location.href='?action=delete&id='+doc_id;	
    	    	}
    	    }

        	function isset(variable){
        		if(typeof(window[variable])!="undefined"){
        			return true;
        		}
        		else {
        			return false;
        		}
        	}

    	    function ValidationFormulaireRole()
    	    {
				var result = true;

				if(($("#DAFxTable tr").length-2)==0)
				{
					result = false;
					alert("Au moins un Domaine d'activité, Fonction");
				}
				return result;
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
include_once '../../../searchBar_inc.php';

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion BDD
	include ('../../../../config/configuration.php');
	require ('../../../include/DbConnexion.php');

	if (isset ( $_GET ['action'] )) {
		$aControler = new StatControler ();
		$aControler->run ();
	} else {

		$aff = '<div id="FilAriane"><a href="../../../?menu=4">Site Emploi</a>&nbsp;>&nbsp;<a href="#">Statistiques Site Emploi</a></div><br/><br/>';
		$aff .= '<ul>';
		// $aff .= '<li><a href="index.php?action=cv_date" >CV par date de crï¿œation</a></li>';
		$aff .= '<li><a href="index.php?action=cv_region" >Nombre de CV par r&eacute;gion et domaine d\'activit&eacute;</a></li>';
		// $aff .= '<li><a href="index.php?action=offre_date" ">Offres par date de crï¿œation</a></li>';
		$aff .= '<li><a href="index.php?action=offre_region" >Nombre d\'Offres par r&eacute;gion et domaine d\'activit&eacute;</a></li>';
		$aff .= '<li><a href="index.php?action=rep" >Nombre de R&eacute;ponses aux offres par r&eacute;gion et domaine d\'activit&eacute;</a></li>';
		$aff .= '<li><a href="index.php?action=site_emploi" >Nombre de consultation de chaque page</a></li>';
		$aff .= '</ul>';
		echo $aff;
	}
} else {
	echo CommunFunction::goToURL ( '../../../?' );
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