<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage annuaire
 * @version 1.0.4
 */
class ResultatRechercheEtablissement {
	private $myList;
	private $myVille;
	private $myRaisonSocial;
	private $myDepartement;
	private $myGroupeID;
	private $myRegionID;
	private $myStatutID;
	public function __construct($aList, $Ville, $RaisonSocial, $Departement, $GroupeID, $RegionID, $StatutID) {
		$this->myList = $aList;
		$this->myVille = $Ville;
		$this->myRaisonSocial = $RaisonSocial;
		$this->myDepartement = $Departement;
		$this->myGroupeID = $GroupeID;
		$this->myRegionID = $RegionID;
		$this->myStatutID = $StatutID;
	}
	
	// ###
	public function renderHTML() {
		// $aff = '<img src="include/images/ResulatRecherche.jpg"/><br/><br/>';
		$aff = '<br/>';
		$aff .= '<table cellpadding="0">';
		if (count ( $this->myList ) > 0) {
			$i = 0;
			$row1 = ' style="background:#FFFFFF url(\'../../include/images/kit/fd_liste_1.jpg\');"';
			$row2 = ' style="background:#FFFFFF url(\'../../include/images/kit/fd_liste_2.jpg\');"';
			foreach ( $this->myList as $aEtablissement ) {
				$aStatut = new StatutEtablissement ();
				$aStatut->SQL_SELECT ( $aEtablissement->getStatutID () );
				$aff .= '<tr' . ($i == 0 ? $row1 : $row2) . '>';
				$aff .= '	<td width="20"><img src="include/images/kit/puce_menu_sidebar.jpg"/></td>';
				$aff .= '	<td><font face="Arial" size="2" style="color:#930511">' . $aEtablissement->getVille () . '</font></td>';
				$aff .= '	<td><a href="?action=etablissement&id=' . $aEtablissement->getID () . '"><font face="Arial" size="2" style="color:#000000">' . $aEtablissement->getRaisonSociale () . '</font></a></td>';
				$aff .= '	<td><font face="Arial" size="2" style="color:#930511">' . $aStatut->getNom () . '</font></td>';
				$aff .= '</tr>';
				$i = ($i == 0 ? 1 : 0);
			}
		} else {
			$aff .= '<tr>';
			$aff .= '	<td><font face="Arial" size="2" style="color:#930511"><i>0 resultat</i></font></td>';
			$aff .= '</tr>';
		}
		$aff .= '</table>';
		$aff .= '<p align="center"><a href="?action=annuaire"><img src="include/images/kit/bout_retour.jpg" border="0"></a></p>';
		return $aff;
	}
}
?>