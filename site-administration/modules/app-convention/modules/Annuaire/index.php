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
<link href="../../include/css/Formulaire.css" rel="stylesheet"
	type="text/css" />

<script type="text/javascript"
	src="../../../../include/js/jquery/jquery-1.4.2.js"></script>
<script type="text/javascript" src="../../include/js/Annuaire.js"></script>

<script type="text/javascript"
	src="../../../../include/js/jquery_pagination/jquery.pagination.js"></script>
<link rel="stylesheet"
	href="../../../../include/js/jquery_pagination/pagination.css" />
<script type="text/javascript">
        	function pageselectCallback(page_index, jq){
                $.get("index.php",{page:numpage})
				return false;
            }

            function confirmation(msg, url)
            {
				if(confirm(msg))
				{
					window.location.href = url;
				}
            }

            function showFilter()
            {
        		$(".FiltreRow").toggle();
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
<title>Admin : annuaire</title>
</head>
<body>

<?php
include_once '../../../../searchBar_inc.php';

$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 2;

require ('../../mvc_inc.php');
include ('../../../../../config/configuration.php');
include ('../../../../include/DbConnexion.php');

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	if (isset ( $_GET ['action'] )) {
		$aControler = new AnnuaireControler ();
		$aControler->run ();
	} else {
		$aList = new AnnuaireList ();

		// Search Field
		$search = (isset ( $_GET ['search'] ) ? $_GET ['search'] : (isset ( $_POST ['search'] ) ? $_POST ['search'] : ''));

		if (isset ( $_GET ['Filter'] )) {
			$Filter = $_GET ['Filter'];
		} elseif (isset ( $_POST ['Filter'] )) {
			$Filter = "m";
			$Filter .= isset ( $_POST ['FilterModeGCR'] ) ? '0' : '';
			$Filter .= isset ( $_POST ['FilterModeManuel'] ) ? '1' : '';
			$Filter .= isset ( $_POST ['FilterModeInvite'] ) ? '2' : '';
			$Filter .= "r";
			$Filter .= isset ( $_POST ['FilterReponduNON'] ) ? '0' : '';
			$Filter .= isset ( $_POST ['FilterReponduOUI'] ) ? '1' : '';
			$Filter .= "c";
			$Filter .= isset ( $_POST ['FilterPresenceNON'] ) ? '0' : '';
			$Filter .= isset ( $_POST ['FilterPresenceOUI'] ) ? '1' : '';
			$Filter .= "p";
			$Filter .= isset ( $_POST ['FilterRepasNON'] ) ? '0' : '';
			$Filter .= isset ( $_POST ['FilterRepasOUI'] ) ? '1' : '';
			$Filter .= "t";
			$Filter .= isset ( $_POST ['AnnuaireType_1'] ) ? '1' : '';
			$Filter .= isset ( $_POST ['AnnuaireType_2'] ) ? '2' : '';
			$Filter .= isset ( $_POST ['AnnuaireType_3'] ) ? '3' : '';
			$Filter .= isset ( $_POST ['AnnuaireType_4'] ) ? '4' : '';
			$Filter .= isset ( $_POST ['AnnuaireType_5'] ) ? '5' : '';
			$Filter .= isset ( $_POST ['AnnuaireType_6'] ) ? '6' : '';
			$Filter .= isset ( $_POST ['AnnuaireType_7'] ) ? '7' : '';
			$Filter .= isset ( $_POST ['AnnuaireType_8'] ) ? '8' : '';
			$Filter .= isset ( $_POST ['AnnuaireType_9'] ) ? '9' : '';
		} else {
			$Filter = "mrcpt";
		}

		if (isset ( $_GET ['sort'] )) {
			switch ($_GET ['sort']) {
				case '1' :
				case '2' :
				case '3' :
				case '4' :
				case '5' :
					$sort = $_GET ['sort'];
					break;
				default :
					$sort = '1';
					break;
			}
		} else {
			$sort = '5';
		}

		if (isset ( $_GET ['order'] )) {
			switch ($_GET ['order']) {
				case 'az' :
					$order = 'ASC';
					break;
				case 'za' :
					$order = 'DESC';
					break;
				default :
					$order = 'ASC';
					break;
			}
		} else {
			$order = 'DESC';
		}

		if (isset ( $_GET ['id'] )) {
			$aList->SQL_SELECT_PAGE ( $_GET ['id'], (isset ( $_GET ['page'] ) ? $_GET ['page'] + 1 : 1), 100, $Filter, $sort, $order, $search );
		}
		$counter = $aList->SQL_REPORT_COUNTER ( $_GET ['id'] );
		$dr = $aList->SQL_SELECT_ALL_DirectionRegionale ();
		$aView = new AnnuaireListWithFilterView ( $aList, $Filter, $search, $counter, $dr );
		$aView->renderHTML ();
	}
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