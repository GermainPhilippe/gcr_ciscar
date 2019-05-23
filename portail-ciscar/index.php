<?php

session_cache_limiter ( 'private, must-revalidate' );
session_start ();

include ('config/configuration.php');

$BaseURL = './';
include ('include/mvc_inc.php');
include ('../config/configuration.php');

if ((isset ( $_GET ['login'] ) && isset ( $_GET ['news'] ) && isset ( $_GET ['env'] )) && (! isset ( $_GET ['action'] ) || (isset ( $_GET ['action'] ) && $_GET ['action'] == 'loginIcom'))) {
	if ($_GET ['login'] != '' && $_GET ['news'] != '' && $_GET ['env'] != '')
		include ('stats_visu.php');
}

include ('include/DbConnexion.php');

//site en maintenance	
//$_GET ['action'] = 'maintenance';
//$aCommunControler = new CommunControler ();
//echo $aCommunControler->run ();
//include ('include/DbDeconnexion.php');
//exit;

$aSessionSecurite = new SessionSecurite ();
$aSessionSecurite->setSiteID ( $_SESSION ['SITE'] ['ID'] );
$aSessionSecurite->setSiteName ( $_SESSION ['SITE'] ['NAME'] );
// Redirection pour janna en urence
if ($_SERVER ['REQUEST_URI'] == '/index.php?action=acces&url_return=/modules/Biblio-media/index.php?id=3739&utm_source=NL-CISCAR&utm_medium=Lien%2Bimg%2Bpdt&utm_campaign=20130409_BOU_Catalogue_Mobilier_v3') {
	header ( 'Location: http://www.ciscar.fr/ftp/Catalogue_Mobilier_Accueil_V3.pdf ' );
}

// redirection si la refefrence du lien Bit-ly est dans l'url
if (isset ( $_GET ['bitly'] ) && $_GET ['bitly'] != '') {
	$_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] = false;
	header ( 'Location: http://bit.ly/' . $_GET ['bitly'] );
}

// Traitement des changements d'identifiants RGPD 
if (isset ( $_GET ['action']) && ($_GET ['action'] == "mdp0" || $_GET ['action'] == "mdp1" || $_GET ['action'] == "validate" || 
		stripos($_GET ['action'],'mdp2') !== false  ||  
				$_GET ['action'] == "ajaxmotdepasseRgpdMDP0" || 
				$_GET ['action'] == "ajaxmotdepasseRgpdMDPV" ||
				$_GET ['action'] == "ajaxmotdepasseLost")) {
	$_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] = false;
	$aCommunControler = new CommunControler ();
	echo $aCommunControler->run ();
	include ('include/DbDeconnexion.php');
	die();
}

// Si utilisateur Non-connecte
if (! isset ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ) || $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] == false) {
	if (isset ( $_GET ['action'] )) {
		$aCommunControler = new CommunControler ();
		echo $aCommunControler->run ();
	} else {
		$aCommunControler = new CommunControler ();
		// petit hack pour résoudre le bug 780
		if (isset ( $_GET ['login'] ))
			$_GET ['action'] = 'default';
		else
			$_GET ['action'] = 'acces';
		echo $aCommunControler->run ();
	}
} else {
	// si identifiants dans nouvelle connexion dans querystring on abandonne la session
	if (isset ( $_GET ['nclogin'] )) {
		$_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] = false;
		if (! isset ( $_GET ['action'] ))
			$_GET ['action'] = 'acces';
		$aCommunControler = new CommunControler ();
		echo $aCommunControler->run ();
	}
	
	// si identifiants dans querystring on abandonne la session
	if (isset ( $_GET ['login'] )) {
		$_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] = false;
		if (! isset ( $_GET ['action'] ))
			$_GET ['action'] = 'default';
		$aCommunControler = new CommunControler ();
		echo $aCommunControler->run ();
	}
	
	if (isset ( $_GET ['action'] )) {
		if ($_GET ['action'] == 'loginIcom' || $_GET ['action'] == 'icomV5' || $_GET ['action'] == 'loginGeolane' || $_GET ['action'] == 'q' || $_GET ['action'] == 'sso') {
			// si autologin sur site ICOM à partir d'une newsletter
			if ($_GET ['action'] == 'loginIcom')
				$_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] = false;
				
				// si autologin sur site GEOLANE à partir d'une newsletter
			if ($_GET ['action'] == 'loginGeolane')
				$_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] = false;
			
			$aCommunControler = new CommunControler ();
			echo $aCommunControler->run ();
		} else {
			$aCommunControler = new CommunControler ();
			$_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] = false;
			setcookie ( 'LoginAuto', false, - 1 );
			$aCommunControler->redirection ( '?' );
			// $aHomePageConnecteView = new HomePageConnecteView ();
			// echo $aHomePageConnecteView->render2HTML ();
		}
	} else {
		
		if (isset ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ACTION'] ) && $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ACTION'] == 'icomV5') {
			$aCommunControler = new CommunControler ();
			echo $aCommunControler->run ();
		} else {
			$aCommunControler = new CommunControler ();
			// $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] = false;
			// setcookie ( 'LoginAuto', false, - 1 );
			// $aCommunControler->redirection ( '?' );
			echo $aCommunControler->run ();
			
			// unset($_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['ACTION']);
			// $aHomePageConnecteView = new HomePageConnecteView ();
			// echo $aHomePageConnecteView->render2HTML ();
		}
	}
}

include ('include/DbDeconnexion.php');
?>
