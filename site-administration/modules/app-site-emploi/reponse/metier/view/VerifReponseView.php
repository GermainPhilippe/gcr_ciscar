<?php
/**
 *Vue de l'édition d'une réponse
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage reponse
 * @version 1.0.4
 */
class VerifReponseView {
	private $objet;
	public function __construct($aObjet) {
		$this->objet = $aObjet;
	}
	/**
	 * Rendu de la vue
	 */
	public function renderHTML() {
		$aff = '<div id="FilAriane" ><b><a href="../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?action=reponse&list">R&eacute;ponses</a>&nbsp;>&nbsp;Visualisation de la réponse</div><br /></b>';

		$aff .= '<br/>';
		$aff .= '<table>';
		$aff .= '<tr><td width="10%"><font size=2 color="000080" face="Arial">Numéro de la réponse</td>';
		$aff .= '<td>' . $this->objet->getnumrep () . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Numéro de l\'offre</td>';
		$aff .= '<td>' . $this->objet->getnumoffre () . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Titre de l\'offre</td>';
		$aff .= '<td>' . stripslashes ( $this->objet->gettitreoffre () ) . '</td></tr>';
		// $aff .= '<tr><td><font size=2 color="000080" face="Arial">Domaine de l\'offre</td>';
		// $aff .= '<td>' . $this->objet->getdomaineoffre () . '</td></tr>';
		// $aff .= '<tr><td><font size=2 color="000080" face="Arial">Fonction de l\'offre</td>';
		// $aff .= '<td>' . stripslashes ( $this->objet->getfonctionoffre () ) . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Type de métier de l\'offre</td>';
		$aff .= '<td>' . $this->objet->getnomcatmetieroffre () . '&nbsp;/&nbsp;' . $this->objet->getnommetieroffre () . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Ville de l\'offre</td>';
		$aff .= '<td>' . stripslashes ( $this->objet->getvilleoffre () ) . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Commentaire de l\'offre</td>';
		$aff .= '<td>' . stripslashes ( nl2br ( $this->objet->getcommentaireoffre () ) ) . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Date prise de poste</td>';
		$aff .= '<td>' . $this->objet->getdatepriseposte () . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Contact de l\'offre</td>';
		$aff .= '<td>' . stripslashes ( $this->objet->getcontactoffre () ) . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Addresse E-mail du contact</td>';
		$aff .= '<td>' . $this->objet->getmailoffre () . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial" style="font-weight:bold;">CANDIDAT</td>';
		$aff .= '<td></td></tr>';
		// $aff .= '<tr><td><font size=2 color="000080" face="Arial">Titre de la candidature</td>';
		// $aff .= '<td>' . stripslashes ( $this->objet->gettitrecand () ) . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Fonction recherchée par le candidat</td>';
		$aff .= '<td>' . stripslashes ( $this->objet->getfonctioncand () ) . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Civilité du candidat</td>';
		$aff .= '<td>' . $this->objet->getcivilitecand () . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Nom du candidat</td>';
		$aff .= '<td>' . $this->objet->getnomcand () . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Prenom du candidat</td>';
		$aff .= '<td>' . $this->objet->getprenomcand () . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Région(s) du candidat</td>';
		$aff .= '<td>' . $this->objet->getregionlibelle () . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Département(s) du candidat</td>';
		$aff .= '<td>' . str_replace ( "00", "Tous", $this->objet->getdepartementlibelle () ) . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Domaine du candidat</td>';

		$aDomaineTMP = new Domaine ();
		$aDomaineTMP->setiddomaine ( $this->objet->getdomainecand () );
		$aDomaineTMP->sql_select_domaine ();

		$aff .= '<td>' . $aDomaineTMP->getnomdomaine () . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Adresse du candidat</td>';
		$aff .= '<td>' . stripslashes ( $this->objet->getadressecand () ) . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Code postal du candidat</td>';
		$aff .= '<td>' . stripslashes ( $this->objet->getcpcand () ) . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Ville du candidat</td>';
		$aff .= '<td>' . stripslashes ( $this->objet->getvillecand () ) . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Adresse E-mail du candidat</td>';
		$aff .= '<td>' . $this->objet->getmailcand () . '</td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Nom du pays</td>';
		$aff .= '<td>' . $this->objet->getpayscand () . '</td></tr>';
		if ($this->objet->getpayscand () != 'France') {
			$aff .= '<tr><td><font size=2 color="000080" face="Arial">Ressortissant</td>';
			if ($this->objet->getressort () == 1) {
				$aff .= '<td>Non communautaire</td></tr>';
			} else if ($this->objet->getressort () == 2) {
				$aff .= '<td>Communautaire</td></tr>';
			}

			if ($this->objet->getressort () == 1) {
				$aff .= '<tr><td><font size=2 color="000080" face="Arial">Titre de séjour</td>';
				if ($this->objet->getsejour () == 1) {
					$aff .= '<td>Oui</td></tr>';
				} else {
					$aff .= '<td>Non</td></tr>';
				}
			}
			$aff .= '<tr><td><font size=2 color="000080" face="Arial">Disponibilité</td>';
			$aff .= '<td>' . $this->objet->getdispo () . '</td></tr>';
		}
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">CV du candidat</td>';
		$aff .= '<td><a style="color:blue;text-decoration:underline;" href="mail/metier/getReponseCV.php?id=' . $this->objet->getnumrep () . '" target="_BLANK">' . $this->objet->getcvcand () . '</a></td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Lettre de motivation du candidat</td>';
		$aff .= '<td><a style="color:blue;text-decoration:underline;" href="mail/metier/getReponseLM.php?id=' . $this->objet->getnumrep () . '" target="_BLANK">' . $this->objet->getlettrecand () . '</a></td></tr>';
		$aff .= '<tr><td><font size=2 color="000080" face="Arial">Date de la réponse</td>';
		$aff .= '<td>' . $this->objet->getdatecand () . '</td></tr>';

		$aff .= '</table><br />';

		echo $aff;
	}
}