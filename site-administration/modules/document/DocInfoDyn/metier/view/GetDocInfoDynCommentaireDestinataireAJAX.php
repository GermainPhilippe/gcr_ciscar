<?php
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion db

	include ('../../../../../../config/configuration.php');
	include ('../../../../../include/DbConnexion.php');

	$baseURLModule = '../../../../../modules/';
	require ('../../../../mvc_inc.php');

	$aff = '<table width="100%" id="TableList">';
	$aff .= '<tr class="title">';
	$aff .= '	<td>Nom Prenom</td>';
	$aff .= '	<td>Mail</td>';
	$aff .= '	<td width="50">Action</td>';
	$aff .= '</tr>';

	$aDestinataireManager = new DocInfoDynCommentaireDestinataireManager ();
	$anArray = $aDestinataireManager->getList ( $_GET ['id'] );

	foreach ( $anArray as $aDestinataire ) {
		$aIndividu = new Simple_Individu ();
		$aIndividu->SQL_SELECT ( $aDestinataire->getIndividuID () );

		$aff .= '<tr>';
		$aff .= '	<td align="center">' . htmlentities ( $aIndividu->getNom (), ENT_QUOTES ) . ' ' . htmlentities ( $aIndividu->getPrenom (), ENT_QUOTES ) . '</td>';
		$aff .= '	<td align="center">' . $aIndividu->getMail () . '</td>';
		$aff .= '	<td width="50" align="center"><a href="javascript:confirmBeforeGoTo(\'Confirmation de suppression\',\'?action=deleteDestinataire&id=' . $_GET ['id'] . '&id2=' . $aDestinataire->getIndividuID () . '\')"><img src="../../../include/images/garbage_empty.png" border=0/></a></td>';
		$aff .= '</tr>';
	}

	$aff .= '</table>';

	// Deconnexion BD
	include ('../../../../../include/DbDeconnexion.php');
	echo $aff;
}