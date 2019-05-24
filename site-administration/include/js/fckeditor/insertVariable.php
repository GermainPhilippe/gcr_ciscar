<?php
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

$baseURLModule = '../../../modules/';
include ('../../../modules/mvc_inc.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../../include/css/style.css" rel="stylesheet"
	type="text/css" />
<link href="../../../include/css/site.css" rel="stylesheet"
	type="text/css" />
<link href="../../../include/css/table.css" rel="stylesheet"
	type="text/css" />

<!-- Librairie JQUERY -->
<script type="text/javascript"
	src="../../../include/js/jquery/jquery-1.4.2.js"></script>

<link href="../../../include/js/jquery/treeTable/treeTable.css"
	rel="stylesheet" type="text/css" />
<script src="../../../include/js/jquery/treeTable/treeTable.js"></script>

<title>Admin : annuaire</title>
<script language="javascript">

	function ok(id,titre) 
	{
		var oEditor = window.opener.FCKeditorAPI.GetInstance('FCKeditor1') ;
		oEditor.InsertHtml('<a href="?action=doc&id='+id+'">'+titre+'</a>');
		window.close();
	}
</script>

</head>
<body>
	<div class="page">
<?php
if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {

	include ('../../../../config/configuration.php');
	include ('../../DbConnexion.php');

	/*
	 * $aList = new CategorieDocInfoDynList();
	 * $aList->SQL_select_all_type();
	 * $aView = new DocInfoDynListViewByCategoriePlugin($aList->getList());
	 * $aView->render();
	 */

	if (isset ( $_GET ['action'] )) {
		$aControler = new DocInfoDynControler ();
		$aControler->run ();
	} else {
		$aView = new SplitDocInfoDynListView ( isset ( $_GET ['search'] ) ? $_GET ['search'] : '' );
		$aView->renderHTML ();
	}

	include ('../../DbDeconnexion.php');
} else {
	echo 'erreur 404';
}
?>
</div>
</body>
</html>
