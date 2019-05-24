<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage etablissement
 * @version 1.0.4
 */
class EtablissementView {
	private $myEtablissement;

	function __construct($aEtablissement)
	{
		$this->myEtablissement = $aEtablissement;
	}
	function EtablissementView($aEtablissement) {
		self::__construct($aEtablissement);
	}

	// ###########
	function render($mod) {
		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '	<a href="?">Etablissement</a>&nbsp;>&nbsp;';

		// Formualire
		switch ($mod) {
			case 'new' :
			case 'c' :
				$aff .= 'Cr&eacute;ation';
				$aff .= '</div><br/><br/>';
				$aff .= '<form method="POST" action="?action=c" name="EtablissementForm" onsubmit="return checkFormEtablissement()">';
				break;
			case 'edit' :
			case 'u' :
				$aff .= 'Edition';
				$aff .= '</div><br/><br/>';
				$aff .= '<form method="POST" action="?action=u&id=' . $this->myEtablissement->getID () . '" name="EtablissementForm" onsubmit="return checkFormEtablissement()">';
				$aff .= '<input type="button" value="Liste des Individus" onclick="document.location.href=\'?action=m&id=' . $this->myEtablissement->getID () . '\'"/>';
				break;
		}

		$aff .= '<table width="1000">';

		if ($mod != 'c') {
			$aff .= '<tr style="display:none;">';
			$aff .= '<td>#</td>';
			$aff .= '<td colspan="5"><input type="text" name="EtablissementID" value="' . $this->myEtablissement->getID () . '" readonly/></td>';
			$aff .= '</tr>';
		}

		$aff .= '<tr>';
		$aff .= '<td>Raison Sociale*</td>';
		$aff .= '<td colspan="5"><input type="text" name="RaisonSociale" value="' . stripslashes ( $this->myEtablissement->getRaisonSociale () ) . '" size="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Adresse 1*</td>';
		$aff .= '<td colspan="5"><input type="text" name="Adresse1" value="' . stripslashes ( $this->myEtablissement->getAdresse1 () ) . '" size="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Adresse 2</td>';
		$aff .= '<td colspan="5"><input type="text" name="Adresse2" value="' . stripslashes ( $this->myEtablissement->getAdresse2 () ) . '" size="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Bureau Distributeur</td>';
		$aff .= '<td colspan="5"><input type="text" name="BureauDistributeur" value="' . stripslashes ( $this->myEtablissement->getBureauDistributeur () ) . '" size="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Code Postal*</td>';
		$aff .= '<td colspan="5"><input type="text" name="CodePostal" value="' . stripslashes ( $this->myEtablissement->getCodePostal () ) . '" size="5"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Ville*</td>';
		$aff .= '<td colspan="5"><input type="text" name="Ville" value="' . stripslashes ( $this->myEtablissement->getVille () ) . '" size="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Pays</td>';
		$aff .= '<td colspan="5"><input type="text" name="Pays" value="' . stripslashes ( $this->myEtablissement->getPays () ) . '" size="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>T&eacute;l&eacute;phone</td>';
		$aff .= '<td colspan="5"><input type="text" name="Telephone" value="' . stripslashes ( $this->myEtablissement->getTelephone () ) . '" size="10"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Fax</td>';
		$aff .= '<td colspan="5"><input type="text" name="Fax" value="' . stripslashes ( $this->myEtablissement->getFax () ) . '" size="10"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Mail</td>';
		$aff .= '<td colspan="5"><input type="text" name="Mail" value="' . stripslashes ( $this->myEtablissement->getMail () ) . '" size="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Site web</td>';
		$aff .= '<td colspan="5"><input type="text" name="SiteWeb" value="' . stripslashes ( $this->myEtablissement->getSiteWeb () ) . '" size="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr' . ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != 1 ? ' style="display:none;"' : '') . '>';
		$aff .= '<td>Siret</td>';
		$aff .= '<td colspan="5"><input type="text" name="Siret" value="' . stripslashes ( $this->myEtablissement->getSiret () ) . '" size="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Num compte VN</td>';
		$aff .= '<td colspan="5"><input type="text" name="NumCompteVN" value="' . stripslashes ( $this->myEtablissement->getNumCompteVN () ) . '" size="5"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Num compte MPR</td>';
		$aff .= '<td colspan="5"><input type="text" name="NumCompteMPR" value="' . stripslashes ( $this->myEtablissement->getNumCompteMPR () ) . '"/ size="5"></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Identifiant Constructeur</td>';
		$aff .= '<td colspan="5"><input type="text" name="NumRRF" id="NumRRF" value="' . stripslashes ( $this->myEtablissement->getNumRRF () ) . '" size="10"/>';
		$aff .= '<script>function NumRRFFormatter()
		{
			var fieldValueLenght = $("#NumRRF").val().length;
			var fieldNormalLenght = 8;
			if(fieldValueLenght< fieldNormalLenght && fieldValueLenght>0)
			{
				for(i=0;i<(fieldNormalLenght-fieldValueLenght);i++)
				{
					$("#NumRRF").val("0" + $("#NumRRF").val());		
				}
			}
		}
		NumRRFFormatter();
		</script>';
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Contrat VN</td>';
		$aff .= '<td colspan="5"><input type="text" name="ContratVN" value="' . stripslashes ( $this->myEtablissement->getContratVN () ) . '" size="5"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Effectifs</td>';
		$aff .= '<td colspan="5"><input type="text" name="Effectifs" value="' . stripslashes ( $this->myEtablissement->getEffectifs () ) . '" size="5"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Nombre VAR</td>';
		$aff .= '<td colspan="5"><input type="text" name="NombreVAR" value="' . stripslashes ( $this->myEtablissement->getNbVar () ) . '" size="5"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Nombre Agents Total</td>';
		$aff .= '<td colspan="5"><input type="text" name="NombreAgentsTotal" value="' . stripslashes ( $this->myEtablissement->getNbAgentsTotal () ) . '" size="5"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Login Sage</td>';
		$aff .= '<td colspan="5"><input type="text" name="LoginSage" value="' . stripslashes ( $this->myEtablissement->getLoginSage () ) . '" size="5"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>En&nbsp;Sommeil&nbsp;/&nbsp;bloqu&eacute;</td>';
		$aff .= '<td colspan="5">';
		$aff .= '<input type="radio" name="EnSommeil" value="1"' . ($this->myEtablissement->getEnSommeil () == 1 ? ' Checked' : '') . '/>OUI';
		$aff .= '<input type="radio" name="EnSommeil" value="0"' . ($this->myEtablissement->getEnSommeil () != 1 ? ' Checked' : '') . '/>NON';
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '<tr' . ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != 1 ? ' style="display:none;"' : '') . '>';
		$aff .= '<td>Import Actif</td>';
		$aff .= '<td colspan="5">';
		$aff .= '<input type="radio" name="ImportActif" value="1"' . ($this->myEtablissement->getImportActif () == 1 ? ' Checked' : '') . '/>OUI';
		$aff .= '<input type="radio" name="ImportActif" value="0"' . ($this->myEtablissement->getImportActif () != 1 ? ' Checked' : '') . '/>NON';
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Acces Site Emploi</td>';
		$aff .= '<td colspan="5">';
		$aff .= '<input type="radio" name="AccesSiteEmploi" value="1"' . ($this->myEtablissement->getAccesSiteEmploi () == 1 ? ' Checked' : '') . '/>OUI';
		$aff .= '<input type="radio" name="AccesSiteEmploi" value="0"' . ($this->myEtablissement->getAccesSiteEmploi () != 1 ? ' Checked' : '') . '/>NON';
		$aff .= '</td>';
		$aff .= '</tr>';

		// Groupe
		$aGroupeEtablissementListe = new GroupeEtablissementListe ();
		$aGroupeEtablissementListe->select_all_groupeetablissement ();
		$aGroupeEtablissementListeView = new GroupeEtablissementListeView ( $aGroupeEtablissementListe );
		$tmp = $this->myEtablissement->getGroupe ();
		$GroupeEtablissementID = empty ( $tmp ) ? 0 : $tmp->getID ();

		$aff .= '<tr>';
		$aff .= '<td>Groupe</td>';
		$aff .= '<td colspan="5">' . $aGroupeEtablissementListeView->render_option_width_empty ( $GroupeEtablissementID ) . '</td>';
		$aff .= '</tr>';

		// Nature
		$aNatureListe = new NatureListe ();
		$aNatureListe->select_all_nature ();
		$aNatureListeView = new NatureListeView ( $aNatureListe );
		$tmp = $this->myEtablissement->getNature ();
		$NatureID = empty ( $tmp ) ? 0 : $tmp->getID ();

		$aff .= '<tr>';
		$aff .= '<td>Nature</td>';
		$aff .= '<td colspan="5">' . $aNatureListeView->render_option_width_empty ( $NatureID ) . '</td>';
		$aff .= '</tr>';

		// Typologie
		$aTypologieListe = new TypologieListe ();
		$aTypologieListe->select_all_typologie ();
		$aTypologieListeView = new TypologieListeView ( $aTypologieListe );
		$tmp = $this->myEtablissement->getTypologie ();
		$TypologieID = empty ( $tmp ) ? 0 : $tmp->getID ();

		$aff .= '<tr>';
		$aff .= '<td>Type</td>';
		$aff .= '<td colspan="5">' . $aTypologieListeView->render_option_width_empty ( $TypologieID ) . '</td>';
		$aff .= '</tr>';

		// Marque
		$aMarqueListe = new MarqueListe ();
		$aMarqueListe->select_all_marque ();
		$aMarqueListeView = new MarqueListeView ( $aMarqueListe );

		$aff .= '<tr>';
		$aff .= '<td>Marques</td>';
		$tmp = $this->myEtablissement->getMarque1 ();
		$Marque1ID = empty ( $tmp ) ? 0 : $tmp->getID ();
		$aff .= '<td>' . $aMarqueListeView->render_option_width_empty ( $Marque1ID, 1 ) . '</td>';

		$tmp = $this->myEtablissement->getMarque2 ();
		$Marque2ID = empty ( $tmp ) ? 0 : $tmp->getID ();
		$aff .= '<td>' . $aMarqueListeView->render_option_width_empty ( $Marque2ID, 2 ) . '</td>';

		$tmp = $this->myEtablissement->getMarque3 ();
		$Marque3ID = empty ( $tmp ) ? 0 : $tmp->getID ();
		$aff .= '<td>' . $aMarqueListeView->render_option_width_empty ( $Marque3ID, 3 ) . '</td>';

		$tmp = $this->myEtablissement->getMarque4 ();
		$Marque4ID = empty ( $tmp ) ? 0 : $tmp->getID ();
		$aff .= '<td>' . $aMarqueListeView->render_option_width_empty ( $Marque4ID, 4 ) . '</td>';

		$tmp = $this->myEtablissement->getMarque5 ();
		$Marque5ID = empty ( $tmp ) ? 0 : $tmp->getID ();
		$aff .= '<td>' . $aMarqueListeView->render_option_width_empty ( $Marque5ID, 5 ) . '</td>';
		$aff .= '</tr>';

		// Statut
		$aStatutEtablissementListe = new StatutEtablissementListe ();
		$aStatutEtablissementListe->select_all_statutetablissement ();
		$aStatutEtablissementListeView = new StatutEtablissementListeView ( $aStatutEtablissementListe );
		$tmp = $this->myEtablissement->getStatut ();
		$StatutEtablissementID = empty ( $tmp ) ? 0 : $tmp->getID ();

		$aff .= '<tr>';
		$aff .= '<td>Statut</td>';
		$aff .= '<td colspan="5">' . $aStatutEtablissementListeView->render_option_width_empty ( $StatutEtablissementID ) . '</td>';
		$aff .= '</tr>';

		// Region
		$aRegionListe = new RegionListe ();
		$aRegionListe->select_all_region ();
		$aRegionListeView = new RegionListeView ( $aRegionListe );
		$tmp = $this->myEtablissement->getRegion ();
		$RegionID = empty ( $tmp ) ? 0 : $tmp->getID ();

		$aff .= '<tr>';
		$aff .= '<td>R&eacute;gion</td>';
		$aff .= '<td colspan="5">' . $aRegionListeView->render_option_width_empty ( $RegionID ) . '</td>';
		$aff .= '</tr>';

		// ################

		$aff .= '<tr>';
		$aff .= '<td colspan="6">&nbsp;</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td colspan="6"><font style="font-weight:bold;font-size:12px;border-bottom:2px solid #000;">Gestion Adhesions</font></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Adhesion GCR</td>';
		$aff .= '<td colspan="5">';
		$aff .= '<input type="radio" name="Adhesion_GCR" value="1"' . ($this->myEtablissement->getAdhesionGCR () == 1 ? ' Checked' : '') . '/>OUI';
		$aff .= '<input type="radio" name="Adhesion_GCR" value="0"' . ($this->myEtablissement->getAdhesionGCR () != 1 ? ' Checked' : '') . '/>NON';
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Adhesion CISCAR</td>';
		$aff .= '<td colspan="5">';
		$aff .= '<input type="radio" name="Adhesion_CISCAR" value="1"' . ($this->myEtablissement->getAdhesionCISCAR () == 1 ? ' Checked' : '') . '/>OUI';
		$aff .= '<input type="radio" name="Adhesion_CISCAR" value="0"' . ($this->myEtablissement->getAdhesionCISCAR () != 1 ? ' Checked' : '') . '/>NON';
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Adhesion GCR Immo</td>';
		$aff .= '<td colspan="5">';
		$aff .= '<input type="radio" name="Adhesion_GCR_Immo" value="1"' . ($this->myEtablissement->getAdhesionGCRImmo () == 1 ? ' Checked' : '') . '/>OUI';
		$aff .= '<input type="radio" name="Adhesion_GCR_Immo" value="0"' . ($this->myEtablissement->getAdhesionGCRImmo () != 1 ? ' Checked' : '') . '/>NON';
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Adhesion GCR SA</td>';
		$aff .= '<td colspan="5">';
		$aff .= '<input type="radio" name="Adhesion_GCR_SA" value="1"' . ($this->myEtablissement->getAdhesionGCRSA () == 1 ? ' Checked' : '') . '/>OUI';
		$aff .= '<input type="radio" name="Adhesion_GCR_SA" value="0"' . ($this->myEtablissement->getAdhesionGCRSA () != 1 ? ' Checked' : '') . '/>NON';
		$aff .= '</td>';
		$aff .= '</tr>';

		// ################
		$aff .= '<tr>';
		$aff .= '<td colspan="6">&nbsp;</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		switch ($mod) {
			case 'new' :
			case 'c' :
				$aff .= '<td colspan="6"><input type="submit" value="Cr&eacute;er"></td>';
				break;
			case 'edit' :
			case 'u' :
				$aff .= '<td colspan="6"><input type="submit" value="Mettre &agrave; Jour"></td>';
				break;
		}

		$aff .= '</tr>';
		$aff .= '</table></form>';
		echo $aff;
	}
}

?>