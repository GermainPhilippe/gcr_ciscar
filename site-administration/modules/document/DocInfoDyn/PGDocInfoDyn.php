<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
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
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<?php
	echo HelperHead::includeCSS ( '../../../include/css/Commun.css' );
	echo HelperHead::includeCSS ( '../../../include/css/CommunLayout.css' );

	echo HelperHead::includeJS ( '../../../include/js/jquery/jquery-1.4.2.js' );
	echo HelperHead::includeJS ( '../../../include/js/CommunScript.js' );

	echo HelperHead::includeJS ( '../../../include/js/fckeditor.js' );

	echo HelperHead::includeJS ( 'include/jquery.tablesorter.min.js' );

	echo HelperHead::includeJS ( '../../../include/js/jquery/datepicker/jquery-ui.min.js' );
	echo HelperHead::includeCSS ( '../../../include/js/jquery/datepicker/jquery-ui.css' );

	echo HelperHead::includeJS ( '../../../include/js/jquery/treeTable/treeTable.js' );
	echo HelperHead::includeCSS ( '../../../include/js/jquery/treeTable/treeTable.css' );

	echo HelperHead::includeJS ( '../../../include/js/jquery/jqModal/jqModal.js' );
	echo HelperHead::includeCSS ( '../../../include/js/jquery/jqModal/jqModal.css' );
	?>
	 	
 	<script src="include/Document.js"></script>
<script language="javascript">

	function ok(id,titre) 
	{
		var oEditor = window.opener.FCKeditorAPI.GetInstance('FCKeditor1') ;
		oEditor.InsertHtml('<a href="index.php?action=doc&id='+id+'">'+titre+'</a>');
		window.close();
	}
	function addElement(id,value)
	{
		//Inc counter
		window.opener.jQuery("#pElmentID").val(id);
		window.opener.jQuery("#pElmentIDDisplay").val(value);
		self.close();
	}
</script>
<title><?php echo $_SESSION['SITE']['NAME'];?> : Admin</title>
</head>
<body style="font-size: 62.5%;">
	<div class="page">
<?php
if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// DB Connection
	include ('../../../../config/configuration.php');
	include ('../../../include/DbConnexion.php');

	if (isset ( $_GET ['action'] )) {
		$aControler = new DocInfoDynControler ();
		$aControler->run ();
	} else {
		$aView = new SplitDocInfoDynListView ( '' );
		$aView->renderHTML ();
	}

	// DB Deconnection
	include ('../../../include/DbDeconnexion.php');
} else {
	echo 'ERREUR 404';
}
?>
</div>