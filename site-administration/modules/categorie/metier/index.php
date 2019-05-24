<?php
/**
 * Cette page permet d'empecher l'utilisateur web d'acceder a l'arborescence du repertoire
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage securite-web
 * @version 1.0.4
 */
header ( 'HTTP/1.1 403 Forbidden' );
print 'ERROR 403 : Forbidden';
?>