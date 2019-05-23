<?php
header ( "Content-Type: text/plain" );

include ('config/configuration.php');
$BaseURL = './';
include ('include/mvc_inc.php');
include ('../config/configuration.php');
include ('include/DbConnexion.php');

// Export Individu
$sql = "SELECT i.civilite,i.Nom, i.Prenom, i.Login, i.LoginSage, i.Mail FROM annuaire_individu i, annuaire_role r, annuaire_role_domainactivite rda, annuaire_lva_domainactivite da";
$sql .= " WHERE i.AnnuaireID IN (1,2) AND da.Libelle NOT IN ('Constructeur','GCRE','Partenaire') AND r.RoleID = rda.RoleID AND rda.DomainActiviteID = da.DomainActiviteID	AND r.IndividuID = i.IndividuID GROUP BY i.Nom, i.Prenom, i.Login, i.LoginSage, i.Mail;";
$result = mysqli_query ( $_SESSION['LINK'] ,$sql ) or die ( mysqli_error ($_SESSION['LINK']) );
echo 'Civilite;Nom;Prénom;Login;Rattachement;Profil;LoginFaF;Email' . "\n";
while ( $line = mysqli_fetch_array ( $result ) ) {
	echo $line [0] . ';' . $line [1] . ';' . $line [2] . ';' . $line [3] . ';' . $line [4] . ';;' . $line [3] . ';' . $line [5] . "\n";
}

// Export Etablissement
$sql = "select e.RaisonSociale, e.Adresse1, e.Adresse2, e.BureauDistributeur, e.CodePostal, e.Mail, e.LoginSage, (SELECT r.Libelle FROM annuaire_lva_region r WHERE r.RegionID = e.RegionID ), e.AnnuaireID, (SELECT n.Libelle FROM annuaire_lva_nature n WHERE n.NatureID=e.NatureID), (SELECT t.Libelle FROM annuaire_lva_typologie t WHERE t.TypologieID=e.TypologieID), (SELECT m.Libelle FROM annuaire_lva_marque m WHERE m.MarqueID = e.Marque1_ID),(SELECT m.Libelle FROM annuaire_lva_marque m WHERE m.MarqueID = e.Marque2_ID), (SELECT m.Libelle FROM annuaire_lva_marque m WHERE m.MarqueID = e.Marque3_ID), (SELECT m.Libelle FROM annuaire_lva_marque m WHERE m.MarqueID = e.Marque4_ID), (SELECT m.Libelle FROM annuaire_lva_marque m WHERE m.MarqueID = e.Marque5_ID), e.EnSommeil,e.telephone,e.NumRRF FROM annuaire_etablissement e WHERE e.AnnuaireID IN (1) GROUP BY e.LoginSage";
// $sql = "select e.RaisonSociale, e.Adresse1, e.Adresse2, e.BureauDistributeur, e.CodePostal, e.Mail, e.LoginSage, r.Libelle, e.AnnuaireID from (annuaire_etablissement e join annuaire_lva_region r on((e.RegionID = r.RegionID))) WHERE e.AnnuaireID IN (1,2) GROUP BY e.RaisonSociale";
$result = mysqli_query ( $_SESSION['LINK'] ,$sql ) or die ( mysqli_error ($_SESSION['LINK']) );
echo 'Libellé secteur;Secteur de livraison défaut;Secteur de facturation défaut;Rattachement;Code client Ciscar;Région;Email;Addresse1;Code postal;Ville;Destinataire1;Nature;Type;Marque1;Marque2;Marque3;Marque4;Marque5;EnSommeil;telephone;RRF' . "\n";
while ( $line = mysqli_fetch_array ( $result ) ) {
	// echo $line[0].';;;;'.$line[6].';'.$line[7].';'.$line[5].';'.$line[1].' '.$line[2].';'.$line[4].';'.$line[3]."\n";
	echo $line [0] . ';;;;' . $line [6] . ';'  . $line [7] . ';' . $line [5] . ';' . $line [1] . ' ' . $line [2] . ';' . $line [4] . ';' . $line [3] . ';;' . $line [9] . ';' . $line [10] . ';' . $line [11] . ';' . $line [12] . ';' . $line [13] . ';' . $line [14] . ';' . $line [15] . ';' . $line [16] . ';' . $line [17] . ';'. $line [18] .   "\n";
}

// Export Roles
//$sql = "SELECT i.Login, ae.LoginSage, i.Password FROM annuaire_individu i, annuaire_role r, annuaire_role_domainactivite rda, annuaire_lva_domainactivite da, annuaire_etablissement ae WHERE i.AnnuaireID = 1 AND da.Libelle NOT IN ('Constructeur','GCRE','Partenaire') AND r.RoleID = rda.RoleID AND rda.DomainActiviteID = da.DomainActiviteID AND r.EtablissementID = ae.EtablissementID AND r.IndividuID = i.IndividuID GROUP BY i.Login, ae.LoginSage order by i.Login";
$sql = "SELECT i.Login, ae.LoginSage, i.Password , ldf.Libelle as Profile FROM annuaire_individu i, annuaire_role r, annuaire_role_domainactivite rda, annuaire_lva_domainactivite da, annuaire_etablissement ae , annuaire_lva_domainactivite_fonction ldf WHERE i.AnnuaireID = 1 AND da.Libelle NOT IN ('Constructeur','GCRE','Partenaire') AND r.RoleID = rda.RoleID AND rda.DomainActiviteID = da.DomainActiviteID AND r.EtablissementID = ae.EtablissementID AND r.IndividuID = i.IndividuID AND rda.DomainActiviteID = ldf.DomainActiviteID AND rda.FonctionDAID = ldf.FonctionDAID GROUP BY i.Login, ae.LoginSage order by i.Login";
$result = mysqli_query ( $_SESSION['LINK'] ,$sql ) or die ( mysqli_error ($_SESSION['LINK']) );
echo 'LoginSage;Etablissement;MotdePasse;Profile' . "\n";
while ( $line = mysqli_fetch_array ( $result ) ) {
	echo $line [0] . ';' . $line [1] . ';'  .  $line [2] . ";". $line [3] . "\n";
}

include ('include/DbDeconnexion.php');
?>