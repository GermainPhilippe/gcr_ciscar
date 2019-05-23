<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage annuaire
 * @version 1.0.4
 */
class RechercheView {
	private $myGroupeEtablissementList;
	private $myRegionEtablissementList;
	private $myStatutEtablissementList;
	private $myDepartementList;
	private $myFonctionIndividuList;
	public function __construct() {
	}
	public function setGroupeEtablissementList($aList) {
		$this->myGroupeEtablissementList = $aList;
	}
	public function setRegionEtablissementList($aList) {
		$this->myRegionEtablissementList = $aList;
	}
	public function setStatutEtablissementList($aList) {
		$this->myStatutEtablissementList = $aList;
	}
	public function setDepartementList($aList) {
		$this->myDepartementList = $aList;
	}
	public function setFonctionIndividuList($aList) {
		$this->myFonctionIndividuList = $aList;
	}
	
	// ###
	public function renderHTML() {
		$aff = '<br></br><br><form action="?action=annuaire&typeRecherche=etablissement" method="POST" name="RechercheEtablissement">';
		
		$aff .= '<script type="text/javascript">
					function testKeyCode(e)
					{
						var keynum;
						if(window.event) // IE
						{
						keynum = e.keyCode;
						}
						else if(e.which) // Netscape/Firefox/Opera
						{
						keynum = e.which;
						}
						if(keynum=="13")
						{
							//ok submit
							document.forms[\'RechercheEtablissement\'].submit();
						}
					}
					</script>';
		$aff .= '<table>';
		
		// Partie Etablissement
		$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\');color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">Recherche par établissement</td></tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td style="padding-left:30px;">Ville</td>';
		$aff .= '	<td><input type="text" name="Ville" onkeypress="return testKeyCode(event)"/></td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td style="padding-left:30px;">Raison Sociale</td>';
		$aff .= '	<td><input type="text" name="RaisonSocial" onkeypress="return testKeyCode(event)"/></td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td style="padding-left:30px;">Departement (XX)</td>';
		$aff .= '	<td>';
		$aff .= '<select name="Departement">';
		$aff .= '<option value="0">&nbsp;</option>';
		foreach ( $this->myDepartementList as $aDepartement ) {
			$aff .= '<option value="' . $aDepartement->getID () . '">(' . $aDepartement->getCode () . ') ' . $aDepartement->getLibelle () . '</option>';
		}
		$aff .= '</select>';
		$aff .= '</td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td style="padding-left:30px;">Groupe</td>';
		$aff .= '	<td>';
		// List groupeEtablissement
		$aff .= '<select name="GroupeID">';
		$aff .= '<option value="0">Tous les groupes</option>';
		foreach ( $this->myGroupeEtablissementList as $aGroupeEtablissement ) {
			$aff .= '<option value="' . $aGroupeEtablissement->getID () . '">' . $aGroupeEtablissement->getNom () . '</option>';
		}
		$aff .= '</select>';
		$aff .= '</td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td style="padding-left:30px;">Direction Régionale</td>';
		$aff .= '	<td>';
		// List RegionEtablissement
		$aff .= '<select name="RegionID">';
		$aff .= '<option value="0">&nbsp;</option>';
		foreach ( $this->myRegionEtablissementList as $aRegionEtablissement ) {
			$aff .= '<option value="' . $aRegionEtablissement->getID () . '">' . $aRegionEtablissement->getNom () . '</option>';
		}
		$aff .= '</select>';
		$aff .= '</td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td style="padding-left:30px;">Statut</td>';
		$aff .= '	<td>';
		// List StatutEtablissement
		$aff .= '<select name="StatutID">';
		$aff .= '<option value="0">&nbsp;</option>';
		foreach ( $this->myStatutEtablissementList as $aStatutEtablissement ) {
			$aff .= '<option value="' . $aStatutEtablissement->getID () . '">' . $aStatutEtablissement->getNom () . '</option>';
		}
		$aff .= '</select>';
		$aff .= '</td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td colspan="2" align="right"><a href="#" onclick="javascript:document.forms[\'RechercheEtablissement\'].submit()"><img src="include/images/kit/bout_recherche.jpg" border="0"/></a></td>';
		$aff .= '</tr>';
		
		// #########################################
		
		$aff .= '<tr>';
		$aff .= '	<td colspan="2"></form><form action="?action=annuaire&typeRecherche=individu" method="POST" name="RechercheIndividu"></td>';
		$aff .= '</tr>';
		
		// Partie Individu
		$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\');color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">Recherche par individu</td></tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td style="padding-left:30px;">Nom de la personne</td>';
		$aff .= '	<td><input type="text" name="NomIndividu"/></td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td style="padding-left:30px;">Fonction</td>';
		$aff .= '	<td>';
		// List Fonction Individu
		$aff .= '<select name="FonctionIndividu">';
		$aff .= '<option value="0">&nbsp;</option>';
		foreach ( $this->myFonctionIndividuList as $aFonctionIndividu ) {
			$aff .= '<option value="' . $aFonctionIndividu->getID () . '">' . $aFonctionIndividu->getNom () . '</option>';
		}
		$aff .= '</select>';
		$aff .= '</td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td colspan="2" align="right"><a href="#" onclick="javascript:document.forms[\'RechercheIndividu\'].submit()"><img src="include/images/kit/bout_recherche.jpg" border="0"/></a></form></td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		
		return $aff;
	}
}
?>