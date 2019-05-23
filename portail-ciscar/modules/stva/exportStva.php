<?php
header ( "Content-Type: text/plain;charset=utf-8" );

include ('../../config/configuration.php');
$BaseURL = '../../';
include ('../../include/mvc_inc.php');
include ('../../../config/configuration.php');
include ('../../include/DbConnexion.php');

if (isset ( $_GET ['flux'] )) {
	
	// Export Individus
	if ($_GET ['flux'] == 'ctc') {
		$linkli = mysqli_connect ( $CONFIG_MYSQL_HOSTNAME, $CONFIG_MYSQL_USERNAME, $CONFIG_MYSQL_PASSWORD );
		mysqli_select_db($linkli,$CONFIG_MYSQL_BASENAME );
		// Export Individu
		$sql = "call export_ctc_stva('')"; 
			
		$result = mysqli_query($linkli, $sql) or die ( mysqli_error ($linkli) );
		echo utf8_encode ( 'Ctc_ID;Ctc_Civilite;Ctc_Nom;Ctc_Prenom;Ctc_Telephone;Ctc_Portable;Ctc_Mail;Ctc_Role_Princ;Ctc_Rattachements;Ctc_EnSommeil' . "\n" );
		while ( $line = mysqli_fetch_array($result, MYSQLI_NUM)) {
			echo utf8_encode ( $line [0] . ';' . $line [1] . ';' . $line [2] . ';' . $line [3] . ';' . $line [4] . ';' . $line [5] . ';'  . $line [6] .';'  . $line [7] . ';' . $line [8] . ';'  . $line [10] .  "\n" );
		}
		mysqli_free_result($result);
		mysqli_close($linkli);
	}
	
	// Export Références clients
	if ($_GET ['flux'] == 'cli') {
		// Export Etablissement
		$sql = " select * from export_cli_stva_Full;";
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		echo utf8_encode ( 'Cli_ID;Cli_Ref;Cli_RaisonSociale;Cli_Adresse1;Cli_Adresse2;Cli_Bur_Distrib;Cli_Code postal;Cli_Ville;Cli_Pays;Cli_Tel;Cli_Fax;Cli_Mail;Cli_Marques;Cli_Groupe_Marques;Cli_Nature;Cli_Type;Cli_Statut;Cli_EnSommeil;Cli_Groupe' . "\n" );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			echo utf8_encode ( $line [0] . ';' . $line [1] . ';' . $line [2] . ';' . $line [3] . ';' . $line [4] . ';' . $line [5] . ';' . $line [6] . ';' . $line [7] . ';' . $line [8] . ';' . $line [9] . ';' . $line [10] . ';' . $line [11] . ';' . $line [12] . ';' . $line [13] . ';' . $line [14] . ';' . $line [15] . ';' . $line [16] . ';' . $line [17] . ';' . $line [18] . "\n" );
		}
	}
	
}

include ('../../include/DbDeconnexion.php');
?>