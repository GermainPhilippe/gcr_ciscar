<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage Newsletter
 * @version 2.0.1
 */
$baseURLModule = '../../modules/';
require ('../mvc_inc.php');
include ('mail.php');

// session_start();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0," />
	<?php
	echo HelperHead::includeCSS ( '../../include/css/Commun.css' );
	echo HelperHead::includeCSS ( '../../include/css/CommunLayout.css' );
	echo HelperHead::includeCSS ( '../../include/css/Individu.css' );
	echo HelperHead::includeJS ( '../../include/js/CommunScript.js' );
	echo HelperHead::includeJS ( '../../include/js/jquery/jquery-1.4.2.js' );
	echo HelperHead::includeJS ( '../../include/js/newsletter.js' );
	echo HelperHead::includeJS ( '../../include/js/formulaire_v3.js' );
	echo HelperHead::includeJS ( '../document/DocInfoDyn/include/jquery.tablesorter.min.js' );
	?>
	<title><?php echo $_SESSION['SITE']['NAME'];?> : Admin</title>
<script type="text/javascript">
		$(document).ready(function() 
    	{ 
        	$(".sortable").tablesorter(); 
    	});
		function confirmDelete(doc_id)
		{
			if(confirm("Confirmation de suppression"))
			{
				document.location.href='?action=delete&id='+doc_id;	
			}
		}
		
	    function showdiv(newsid)
	    {	    	
		     var elems = ''

	     	 // Mozilla Chrome
		     if (document.getElementsByClassName)
		     	elems = document.getElementsByClassName('newsdiv');
		     else
			 //I.E
			    elems = document.querySelectorAll('div.newsdiv');
					
			     	
			 var div = '';
		     var old_divID = '';
		     len = elems.length;
		     var frame = '';
		     //alert (len);
		     for (var i = 0;  i < len; i++)
		     {
		            var div = elems[i];
		            while (div.firstChild) {
		            	div.removeChild(div.firstChild);
		            	}
		            if (div.style.display == 'block') old_divID = div.id ;
		   	     	//On rend la div visible si son id est le même que celui passé en paramètre de la fonction, sinon on la masque
		            div.style.display = 'none';
		     }
		     
			div = document.getElementById('div-'+ newsid);
			if (div.id != old_divID)
			{
	            div.style.display = 'block';
				frame = document.createElement('iframe');
				frame.id = 'frame-'+ newsid;
				frame.name = 'frame-'+ newsid;
				frame.frameBorder = 0;
				frame.style.height = 'auto'; 
				frame.style.width = '60%'; 
				frame.allowfullscreen = 'true'; 
				frame.src = '../newsletter/indexSimple.php?action=det&news='+newsid;
				div.appendChild(frame);
}
	    }
		</script>


<!-- Plugin JQUERY Tools Tab -->
<script type="text/javascript"
	src="/admin/include/js/jquery/Tools_Tabs/tools.tabs-1.0.4.js"></script>
<!-- Show - Hide in same time -->

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
if (isset($_GET ['action']) && $_GET ['action'] == "addDestinataire")
	echo '<div class="page">';
else 
	include_once '../../searchBar_inc.php';
	
if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion BDD
	include ('../../../config/configuration.php');
	require ('../../include/DbConnexion.php');
	
	// Traitement des actions
	if (isset ( $_GET ['action'] )) {
		if ($_GET ['action'] == 'arch') {
			$aManager = new NewsletterManager ();
			$aCollectionView = new NewsletterCollectionView ( $aManager->getList ( 1 ) );
			$aCollectionView->renderHTML ( 1 );
		} else {
			if ($_GET ['action'] == 'masq') {
				$aManager = new NewsletterManager ();
				$aCollectionView = new NewsletterCollectionView ( $aManager->getList ( 0 ) );
				$aCollectionView->renderHTML ( 0 );
			} else {
				$aControler = new NewsletterControler ();
				$aControler->run ();
			}
		}
	} else {
		$aManager = new NewsletterManager ();
		$aCollectionView = new NewsletterCollectionView ( $aManager->getList ( 0 ) );
		$aCollectionView->renderHTML ( 0 );
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