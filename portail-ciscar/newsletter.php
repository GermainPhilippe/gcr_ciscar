<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @version 2.0.1
 */
/*
 * session_start();
 *
 * include('config/configuration.php');
 *
 * $BaseURL = './';
 * include('include/mvc_inc.php');
 *
 * include('../config/configuration.php');
 * include('include/DbConnexion.php');
 *
 * $aNewsletterManager = new NewsletterManager();
 * $aNewsletter = $aNewsletterManager->get($_GET['id']);
 * echo '<html><head><meta name="robots" content="noindex"><style>*{font: 11px Arial,Helvetica,sans-serif;}</style>';
 * if($aNewsletter->getCssHeader() != '')
 * {
 * echo '<style type="text/css">'.$aNewsletter->getCssHeader().'</style>';
 * }
 * echo '</head><body>';
 * echo stripslashes($aNewsletter->getRichContentValue());
 * echo '</body></html>';
 *
 * include('include/DbDeconnexion.php');
 */
header ( 'HTTP/1.0 404 Not Found' );
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Ciscar - newsletter</title>
</head>
<body>
	<h1>Page inexistante</h1>
</body>
</html>