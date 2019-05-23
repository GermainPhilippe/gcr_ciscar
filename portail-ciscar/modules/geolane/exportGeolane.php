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
		// Export Individu
		$sql = "SELECT 
				i.IndividuID,
				i.civilite,
				i.Nom, 
				i.Prenom,
				i.Telephone,
				i.TelephonePortable,
				i.Fax,
				i.Mail, 
				i.Login, 
				(select GROUP_CONCAT(LoginSage SEPARATOR '|') from annuaire_etablissement ae, annuaire_role ar where ae.EtablissementID = ar.EtablissementID and ar.IndividuID = i.IndividuID) as Liste_Roles,
				i.EnSommeil 
				FROM annuaire_individu i 
				WHERE 
				i.AnnuaireID IN (1) 
				and i.Login <> 'evrard-10820'
				and i.Login <> 'marin-10993'
				and i.Login <> 'oblin-11352'
				and i.Login <> 'doutriaux-9739'
				and i.Login <> 'legrand-8675'
				and i.Login <> 'luce-8626'
				and i.Login <> 'martin-11257'
				and i.Login <> 'mounes-5711'
				and i.Login <> 'sahut-11342'
				and i.Login <> 'wagner-7442'
				GROUP BY i.Nom, i.Prenom, i.Login, i.LoginSage, i.Mail;";
		$result = mysqli_query ( $_SESSION['LINK'] ,$sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		echo utf8_encode ( 'Ctc_ID;Ctc_Civilite;Ctc_Nom;Ctc_Prenom;Ctc_Telephone;Ctc_Portable;Ctc_Fax;Ctc_Mail;Ctc_Login;Ctc_Rattachements;Ctc_EnSommeil' . "\n" );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			echo utf8_encode ( $line [0] . ';' . $line [1] . ';' . $line [2] . ';' . $line [3] . ';' . $line [4] . ';' . $line [5] . ';' . $line [6] . ';' . $line [7] . ';' . $line [8] . ';' . $line [9] . ';' . $line [10] . "\n" );
		}
	}
	
	// Export Références clients
	if ($_GET ['flux'] == 'cli') {
		// Export Etablissement
		$sql = "
				select 
				e.EtablissementID,
				e.LoginSage, 
				e.RaisonSociale, 
				e.Adresse1, 
				e.Adresse2, 
				e.BureauDistributeur, 
				e.CodePostal,
				e.Ville,
				(case i.PAYS when 'FRANCE' then 'FRA' when 'BELGIQUE' then 'BEL' when 'LUXEMBOURG' then 'LUX' when 'ROUMANIE' then 'RO' when 'SUISSE' then 'CHR' when 'PAYS-BAS' then 'NLD' else 'FRA' end) AS 'CODE_PAYS',
				e.telephone,
				e.Fax, 
				e.Mail, 
        		(SELECT replace(replace(replace(replace(replace(concat_ws('|',i.MARQUE1,i.MARQUE2,i.MARQUE3,i.MARQUE4,i.MARQUE5,'&'),'||||',''),'|||',''),'||',''),'|&',''),'&',''))  AS 'LISTE_MARQUES',
        		(case when (concat_ws('|',i.MARQUE1,i.MARQUE2,i.MARQUE3,i.MARQUE4,i.MARQUE5) like '%RENAULT%') then 'RNT' else (case when (concat_ws('|',i.MARQUE1,i.MARQUE2,i.MARQUE3,i.MARQUE4,i.MARQUE5) like '%DACIA%') then 'RNT' else (case when (concat_ws('|',i.MARQUE1,i.MARQUE2,i.MARQUE3,i.MARQUE4,i.MARQUE5) like '%NISSAN%') then 'NIS' else (case when (concat_ws('|',i.MARQUE1,i.MARQUE2,i.MARQUE3,i.MARQUE4,i.MARQUE5) like '%INDRA%') then 'IND' else 'HRN' end) end) end) end) AS 'CODE_MARQUE',
				(SELECT n.Libelle FROM annuaire_lva_nature n WHERE n.NatureID=e.NatureID) as NATURE, 
				(SELECT t.Libelle FROM annuaire_lva_typologie t WHERE t.TypologieID=e.TypologieID), 
				(SELECT s.Libelle FROM annuaire_lva_statut_etablissement s WHERE s.StatutID=e.StatutID), 
				e.EnSommeil,
				i.GROUPE
				FROM 
				annuaire_etablissement e,  
				import_gescom i 
				WHERE e.LoginSage = i.SECT_LIV
				AND e.AnnuaireID IN (1) 
        		AND (e.LoginSage like 'C%' or e.LoginSage like 'E%' or e.LoginSage like 'T%')
        		GROUP BY e.LoginSage HAVING NATURE <> 'CONSTRUCTEUR'";
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		echo utf8_encode ( 'Cli_ID;Cli_Ref;Cli_RaisonSociale;Cli_Adresse1;Cli_Adresse2;Cli_Bur_Distrib;Cli_Code postal;Cli_Ville;Cli_Pays;Cli_Tel;Cli_Fax;Cli_Mail;Cli_Marques;Cli_Groupe_Marques;Cli_Nature;Cli_Type;Cli_Statut;Cli_EnSommeil;Cli_Groupe' . "\n" );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			echo utf8_encode ( $line [0] . ';' . $line [1] . ';' . $line [2] . ';' . $line [3] . ';' . $line [4] . ';' . $line [5] . ';' . $line [6] . ';' . $line [7] . ';' . $line [8] . ';' . $line [9] . ';' . $line [10] . ';' . $line [11] . ';' . $line [12] . ';' . $line [13] . ';' . $line [14] . ';' . $line [15] . ';' . $line [16] . ';' . $line [17] . ';' . $line [18] . "\n" );
		}
	}
	
	// Export Références fournisseurs
	if ($_GET ['flux'] == 'frn') {
		// Export fournisseurs
		$sql = "
				select
				f.FournisseurID,
				f.LoginSage,
				f.Intitule,
				f.Classement,
				f.Contact,
				f.Adresse1,
				f.Adresse2,
				f.Code_Postal,
				f.Ville,
				f.Pays,
				f.Ape,
				f.Siret,
				f.Mail,
				f.Telephone,
				f.Fax,
				f.Web,
				f.EnSommeil,
				f.Date_Crea,
				f.Date_Maj
				FROM
				annuaire_fournisseurs f
				WHERE
				f.AnnuaireID IN (1)
        		GROUP BY f.LoginSage order by f.FournisseurID";
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		echo utf8_encode ( 'Frn_ID;Frn_Ref;Frn_Intitule;Frn_Classement;Frn_Contact;Frn_Addresse1;Frn_Adresse2;Frn_Code postal;Frn_Ville;Frn_Pays;Frn_Ape;Frn_Siret;Frn_Mail;Frn_Tel;Frn_Fax;Frn_Web;Frn_EnSommeil;Frn_Date_Crea;Frn_Date_Maj' . "\n" );
		while ( $line = mysqli_fetch_array ( $result ) ) {
			echo utf8_encode ( $line [0] . ';' . $line [1] . ';' . $line [2] . ';' . $line [3] . ';' . $line [4] . ';' . $line [5] . ';' . $line [6] . ';' . $line [7] . ';' . $line [8] . ';' . $line [9] . ';' . $line [10] . ';' . $line [11] . ';' . $line [12] . ';' . $line [13] . ';' . $line [14] . ';' . $line [15] . ';' . $line [16] . ';' . $line [17] . ';' . $line [18] . "\n" );
		}
	}
}

include ('../../include/DbDeconnexion.php');
?>