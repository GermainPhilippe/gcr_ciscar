<?php
session_start ();

include ('../../../config/configuration.php');

$BaseURL = '../../';
include ('../../include/mvc_inc.php');

include ('../../config/configuration.php');
include ('../../include/DbConnexion.php');

$aSessionSecurite = new SessionSecurite ();
$aSessionSecurite->setSiteID ( $_SESSION ['SITE'] ['ID'] );
$aSessionSecurite->setSiteName ( $_SESSION ['SITE'] ['NAME'] );

if (! isset ( $_SESSION [$_SESSION ['SITE'] ['NAME']] ) || $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['CONNECTED'] == false) {
	$aff = '<script type="text/javascript">';
	$aff .= 'document.location.href="/index.php?action=acces&url_return=' . base64_encode ( $_SERVER ['REQUEST_URI'] ) . '";';
	$aff .= '</script>';
	echo $aff;
} else {
	if (isset ( $_GET ['id'] )) {
		$dao = new BiblioMediaDAO ();
		$instance = $dao->find ( $_GET ['id'] );
		
		if (is_null ( $instance->getId () )) {
			header ( 'HTTP/1.0 404 Not Found' );
			echo '<h4>ERROR 404</h4>';
			unset ( $instance );
			exit ();
		} else {
			header ( "Pragma: public" ); // required
			header ( "Expires: 0" );
			header ( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
			header ( "Cache-Control: private", false ); // required for certain browsers
			header ( 'Content-type: ' . $instance->getFileMime () );
			header ( 'Content-Length: ' . $instance->getFileSize () );
			header ( 'Content-Disposition: attachment; filename="' . $instance->getFileName () . '"' );
			echo $instance->getFileBlob ();
			unset ( $aModele );
		}
	} else {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href="/index.php?action=acces&url_return=' . $_SERVER ['REQUEST_URI'] . '";';
		$aff .= '</script>';
		echo $aff;
	}
}
include ('../../include/DbDeconnexion.php');
?>