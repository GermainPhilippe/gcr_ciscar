<?php
/**
 * @author Philippe GERMAIN
 * @package site-administration
 * @subpackage prestashop
 * @version 1.0.4
 */
?>
<?php
session_start ();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr"
	dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
<title>Export ciscar.net</title>
<script type="text/javascript"
	src="../../include/js/jquery/jquery-1.8.2.js">
</script>
<style>
#shop-img {
	margin-bottom: 40px;
	width: 69.5px;
	left: 0;
	right: 0;
	float: left;
}

#main {
	margin: auto;
}

#message {
	margin-left: 70px;
	padding-top: 10px;
}

#fermer {
	clear: both;
	text-align: center;
	width: 100%;
	background-color: #008abd;
	border-color: #23829c;
	font-size: 15px;
	line-height: 1.33;
	border-radius: 3px;
	vertical-align: middle;
}

body {
	font: 400 12px/1.42857 "Open Sans", Helvetica, Arial, sans-serif;
	color: #1d1d1;
}

#btnfermer {
	background-color: transparent;
	width: 100%;
	display: block;
	box-shadow: none;
	text-decoration: none;
	padding-left: 0;
	padding-right: 0;
	cursor: pointer;
	font-size: 19px;
	line-height: 2;
	border: 1px solid transparent;
	color: #fff;
}
</style>
</head>
<body>
<?php

$aff = '
	<script type="text/javascript">
	$(function() {
 
      $(\'.fermer\').click(function(){
          window.parent.jQuery.fancybox.close()             
          });                      
    });
	</script>			
';
echo $aff;

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion BDD
	include ('../../../config/configuration.php');
	include ('config/configuration.php');
	require ('../../include/DbConnexion.php');
	require ('../../include/DbConnexion_PrestaShop.php');

	$baseURLModule = '../../modules/';
	require ('../mvc_inc.php');

	$aControler = new PrestaShopControler ();
	if (isset ( $_GET ['individuID'] ))
		$aControler->run ( $_GET ['individuID'] );
	else
		$aControler->run ( 0 );

	include ('../../include/DbDeconnexion.php');
	include ('../../include/DbDeconnexion_PrestaShop.php');
} else {
	echo 'erreur 404';
}
?>
</body>
</html>