<?php
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 2;
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../../../../include/css/Commun.css" rel="stylesheet"
	type="text/css" />
<link href="../../../../include/css/CommunLayout.css" rel="stylesheet"
	type="text/css" />
<script type="text/javascript"
	src="../../../../include/js/CommunScript.js"></script>
<script type="text/javascript"
	src="../../../../include/js/jquery/jquery-1.4.2.js"></script>
<script type="text/javascript"
	src="../../../../include/js/jquery/datepicker/ui.datepicker-fr.js"></script>

<link href="../../../../include/js/jquery/datepicker/jquery-ui.css"
	rel="stylesheet" type="text/css" />
<script src="../../../../include/js/jquery/datepicker/jquery-ui.min.js"></script>

<script type="text/javascript" src="../../include/js/Convention.js"></script>


<script type="text/javascript">
	var Form = {};
	Form.ConventionPage = {
			_formIsValid : function() {
				return true;
			},
			
			btEnregistrer : function() {
				var oEditor = FCKeditorAPI.GetInstance("RichTextValue") ;
				var content = oEditor.GetHTML() ;

				jQuery.ajax({
					   type: "POST",
					   url: "",
					   data:"title="+ escape($("#title").val()) +
					   		"&RichTextValue=" +escape(content),
					   success: function(msg){
							alert("Sauvegardé");
						}
					});
			},
			btEnregistrerEtFermer : function() {
				if(this._formIsValid()) {
					document.forms['formPageConvention'].submit();
				}
			}
	};

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
<title>Admin : annuaire</title>
</head>
<body>

<?php
include_once '../../../../searchBar_inc.php';

require ('../../mvc_inc.php');
include ('../../../../../config/configuration.php');
include ('../../../../include/DbConnexion.php');
if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	$aControler = new ConventionPageController ();
	$aControler->run ();
}
include ('../../../../include/DbDeconnexion.php');

?>

</div>

	<div class="footerContainer">
		<a href="http://www.abakus.fr"> <img
			src="../../../../include/images/Logo_AbaKus.png" width="100"
			border="0" /></a><br> AbaKus &copy; 2009 - 2010
	</div>
</body>
</html>