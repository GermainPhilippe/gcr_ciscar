<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage securite
 * @version 1.0.4
 */
session_start ();

include ('../../../config/configuration.php');
include ('../../config/configuration.php');
$BaseURL = '../../';
include ('../../include/mvc_inc.php');

$aSessionSecurite = new SessionSecurite ();
$aSessionSecurite->setSiteID ( $_SESSION ['SITE'] ['ID'] );
$aSessionSecurite->setSiteName ( $_SESSION ['SITE'] ['NAME'] );

include ('../../include/DbConnexion.php');
$result = $aSessionSecurite->SQL_checkUserInfo ( $_POST ['u'], $_POST ['p'] );
include ('../../include/DbDeconnexion.php');

echo $result;

?>