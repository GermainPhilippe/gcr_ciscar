<?php
/**
 * Index de l'application m�tier Site Emploi
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @version 1.0.4
 */
session_start ();
// $DEBUG_MODE = False;

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}
include_once ("../../include/js/fckeditor/fckeditor.php");
$baseURLModule = '../../modules/';
require ('../mvc_inc.php');
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
echo HelperHead::includeCSS ( '../../include/css/Commun.css' );
echo HelperHead::includeCSS ( '../../include/css/CommunLayout.css' );

echo HelperHead::includeJS ( '../../include/js/script.js' );
echo HelperHead::includeJS ( '../../include/js/jquery/jquery-1.4.2.js' );

echo HelperHead::includeJS ( '../../include/js/jquery/datepicker/jquery-ui.min.js' );
echo HelperHead::includeJS ( '../../include/js/jquery/datepicker/ui.datepicker-fr.js' );
echo HelperHead::includeCSS ( '../../include/js/jquery/datepicker/jquery-ui.css' );

echo HelperHead::includeCSS ( '../../include/js/jquery_pagination/pagination.css' );
echo HelperHead::includeJS ( '../../include/js/jquery_pagination/jquery.pagination.js' );

echo HelperHead::includeJS ( '../../include/js/formulaire_v3.js' );

?>
	
	<script type="text/javascript">
        	function pageselectCallback(page_index, jq){
                $.get("index.php",{page:numpage});
				return false;
            }
        	function confirmDeleteCV(doc_id)
    	    {
    	    	if(confirm("Confirmation de suppression"))
    	    	{
    	    		document.location.href='?action=deletecv&id='+doc_id;	
    	    	}
    	    }
        	function confirmDeletepage(doc_id)
    	    {
    	    	if(confirm("Confirmation de suppression"))
    	    	{
    	    		document.location.href='?action=deletepage&id='+doc_id;	
    	    	}
    	    }
        	function confirmDeleteOffre(doc_id)
    	    {
    	    	if(confirm("Confirmation de suppression"))
    	    	{
    	    		document.location.href='?action=deleteoffre&id='+doc_id;	
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

    	    function ok(id,titre) 
    		{
    			var oEditor = window.opener.FCKeditorAPI.GetInstance('contenu') ;
    			oEditor.InsertHtml('<a href="?action=cand&id='+id+'">'+titre+'</a>');
    			window.close();
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
		$aControler = new ParamMailControler ();
		$aControler->run ();
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