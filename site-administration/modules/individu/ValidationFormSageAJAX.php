<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage securite
 * @version 1.0.4
 */
session_start ();

include ('../../../config/configuration.php');
require ('../../include/DbConnexion.php');

$baseURLModule = '../../modules/';
require ('../mvc_inc.php');

include ('../../include/DbConnexion.php');

if (isset ( $_GET ['action'] ) && $_GET ['action'] == 'ValidationFormSageAJAX') {
	$individu = new Individu ();
	$individu->userSage_existDeja ( $_POST ['idSage'] );
	if ($individu->getNom () != '')
		$msg = $individu->getNom () . ' ' . $individu->getPrenom ();
	else
		$msg = '';
}
include ('../../include/DbDeconnexion.php');

echo $msg;

?>