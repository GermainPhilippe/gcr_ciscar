<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
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

if (isset ( $_GET ['Recherche'] )) {
	$_SESSION ['SITE'] ['TAB'] = '2';
}

// On supprimer l'effet de l'option magic_quotes_gpc
if (function_exists ( 'get_magic_quotes_gpc' ) && get_magic_quotes_gpc ()) {
	// Create lamba style unescaping function (for portability)
	$quotes_sybase = strtolower ( ini_get ( 'magic_quotes_sybase' ) );
	$unescape_function = (empty ( $quotes_sybase ) || $quotes_sybase === 'off') ? 'stripslashes($value)' : 'str_replace("\'\'","\'",$value)';
	$stripslashes_deep = create_function ( '&$value, $fn', '
			if (is_string($value)) {
				$value = ' . $unescape_function . ';
			} else if (is_array($value)) {
				foreach ($value as &$v) $fn($v, $fn);
			}
		' );

	// Unescape data
	$stripslashes_deep ( $_POST, $stripslashes_deep );
	$stripslashes_deep ( $_GET, $stripslashes_deep );
	$stripslashes_deep ( $_COOKIE, $stripslashes_deep );
	$stripslashes_deep ( $_REQUEST, $stripslashes_deep );
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"
	dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<?php
	echo HelperHead::includeCSS ( '../../include/css/Commun.css' );
	echo HelperHead::includeCSS ( '../../include/css/CommunLayout.css' );
	echo HelperHead::includeJS ( '../../include/js/CommunScript.js' );
	echo HelperHead::includeCSS ( '../../include/css/Individu.css' );
	echo HelperHead::includeJS ( '../../include/js/Individu.js' );

	echo HelperHead::includeJS ( '../../include/js/jquery/jquery-1.8.2.js' );
	echo HelperHead::includeCSS ( '../../include/js/jquery_pagination/pagination.css' );
	echo HelperHead::includeJS ( '../../include/js/jquery_pagination/jquery.pagination.js' );

	echo HelperHead::includeJS ( '../../include/js/formulaire_v3.js' );
	?>
	
    <script type="text/javascript">
		function pageselectCallback(page_index, jq){
			$.get("index.php",{page:numpage})
			return false;
		}

		function confirmDelete(doc_id)
	    {
	    	if(confirm("Confirmez la suppression de l\'ensemble des annuaires"))
	    	{
	    		document.location.href='?action=delete&id='+doc_id;	
	    	}
	    }
		function confirmDeleteCISCAR(doc_id)
	    {
	    	if(confirm("Confirmez la suppression de l\'annuaire CISCAR"))
	    	{
	    		document.location.href='?action=deleteCISCAR&id='+doc_id;	
	    	}
	    }
		function confirmDeleteGCR(doc_id)
	    {
	    	if(confirm("Confirmez la suppression de l\'annuaire GCR"))
	    	{
	    		document.location.href='?action=deleteGCR&id='+doc_id;	
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
		$aIndividuControler = new IndividuControler ();
		$aIndividuControler->run ();
	}

	// Afficher la Liste des User
	if (! isset ( $_GET ['action'] )) {
		// Avec Recherche
		if ((isset ( $_POST ['Recherche'] ) && $_POST ['Recherche'] != NULL)) {
			$NbEntre = 0;
			$aModeleList = new Simple_IndividuList ();
			$aModeleList->SQL_SEARCH ( isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, $_POST ['Recherche'], isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
			// Element Max
			$NbEntre = $aModeleList->SQL_SEARCH_COUNT ( $_POST ['Recherche'] );
		} elseif ((isset ( $_GET ['Recherche'] ) && $_GET ['Recherche'] != NULL) || isset ( $_GET ['RechercheNOM'] )) {
			$NbEntre = 0;
			$aModeleList = new Simple_IndividuList ();
			if (isset ( $_GET ['Recherche'] )) {
				$aModeleList->SQL_SEARCH ( isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, $_GET ['Recherche'], isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
				$NbEntre = $aModeleList->SQL_SEARCH_COUNT ( $_GET ['Recherche'] );
			}

			if (isset ( $_GET ['RechercheNOM'] )) {
				$aModeleList->SQL_SEARCH_NOM_PRENOM_ANNU ( isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, $_GET ['RechercheNOM'], isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
				$NbEntre = $_GET ['count'];
			}
			// Element Max
		} // Sans Recherche
		else {
			$NbEntre = 0;
			$aModeleList = new Simple_IndividuList ();
			$aModeleList->SQL_SELECT_PAGE ( isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1, 50, isset ( $_GET ['tri'] ) ? $_GET ['tri'] : '1', isset ( $_GET ['ordre'] ) ? $_GET ['ordre'] : 'd' );
			// Element Max
			$NbEntre = $aModeleList->SQL_COUNT ();
		}

		$aViewList = new Simple_IndividuListView ( $aModeleList, $NbEntre );
		$aViewList->renderHTML ();

		unset ( $aModeleList );
		unset ( $aViewList );
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