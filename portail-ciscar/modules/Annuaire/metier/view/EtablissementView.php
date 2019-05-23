<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage annuaire
 * @version 1.0.4
 */
class EtablissementView {
	private $myEtablissement;
	private $myEtablissementContactList;
	public function __construct($aEtablissement, $aEtablissementContactList) {
		$this->myEtablissement = $aEtablissement;
		$this->myEtablissementContactList = $aEtablissementContactList;
	}
	public function renderHTML() {
		$aff = '<h1 align="center">' . $this->myEtablissement->getRaisonSociale () . '</h1>';
		
		$aff .= $this->myEtablissement->getAdresse1 () . '<br/>';
		$aff .= $this->myEtablissement->getAdresse2 () . '<br/>';
		$aff .= $this->myEtablissement->getCodePostal () . ' ' . $this->myEtablissement->getVille () . '<br/>';
		
		// info general
		$aff .= '<br/>';
		$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
		$aff .= '<tr>';
		$aff .= '	<td><b>Statut :</b></td>';
		
		$aff .= '	<td>' . $this->myEtablissement->SQL_SELECT_STATUT ( $this->myEtablissement->getStatutID () ) . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Reseau :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->SQL_SELECT_Reseau ( $this->myEtablissement->getTypologieID () ) . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Membre du groupe :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->SQL_SELECT_GROUPE ( $this->myEtablissement->getGroupeID () ) . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Concession de :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getVille () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Region :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->SQL_SELECT_Region ( $this->myEtablissement->getRegionID () ) . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Code Site :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getNumRRF () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Acces site Emploi :</b></td>';
		$aff .= '	<td>' . ($this->myEtablissement->getAccesSiteEmploi () == 0 ? 'Non' : 'Oui') . '</td>';
		$aff .= '</tr>';
		if (in_array ( 1, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) || in_array ( 2, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
			$aff .= '<tr>';
			$aff .= '	<td><b>Login Sage :</b></td>';
			$aff .= '	<td>' . ($this->myEtablissement->getLoginSage ()) . '</td>';
			$aff .= '</tr>';
		}
		$aff .= '</table>';
		
		// Coordonnees
		$aff .= '<br/>';
		$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
		$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">COORDONNEES</td></tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Telephone :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getTelephone () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Fax :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getFax () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>E-Mail :</b></td>';
		$aff .= '	<td><a href="mailto://' . $this->myEtablissement->getMail () . '">' . $this->myEtablissement->getMail () . '</a></td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		
		// Informations diverses
		$aff .= '<br/>';
		$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
		$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">INFORMATIONS DIVERSES</td></tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Contrat V.N. :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getContratVN () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Effectifs :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getEffectifs () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Nb d\'agents total :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getNbAgentsTotal () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Nb de VAR :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getNbVar () . '</td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		
		// Adhesion
		$aff .= '<br/>';
		$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
		$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">ADHESION</td></tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>En Sommeil :</b></td>';
		$aff .= '	<td>' . ($this->myEtablissement->getEnSommeil () == 0 ? 'Non' : 'Oui') . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>NISSAN :</b></td>';
		$aff .= '	<td></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>CISCAR :</b></td>';
		$aff .= '	<td></td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		
		// Contacts
		$aff .= '<br/>';
		$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
		$aff .= '<tr><td colspan="3" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">CONTACTS</td></tr>';
		foreach ( $this->myEtablissementContactList as $aIndividu ) {
			$aff .= '<tr>';
			$aff .= '	<td><a href="?action=individu&id=' . $aIndividu [0] . '">' . $aIndividu [1] . ' ' . $aIndividu [2] . '</a></td>';
			$aff .= '	<td>' . $aIndividu [3] . '</td>';
			$aff .= '</tr>';
		}
		
		$aff .= '</table>';
		
		// $aff .= '<br/><a href="?action=annuaire"><img src="include/images/BtNouvRecherche.gif" border="0"></a>';
		$aff .= '<br/><p align="center">';
		// $aff .= '<a href="javascript:history.back()"><img src="include/images/BtRevenir.gif" border="0"/></a>';
		// $aff .= '<a href="?"><img src="include/images/RetourUne.gif" border="0"/></a>';
		$aff .= '<a onclick="window.open(\'indexSimple.php?action=etablissementPrint&id=' . $this->myEtablissement->getID () . '\', \'Impression\', \'Width=800,Height=600,toolbar=yes,scrollbars=yes\')" href="#"><img src="include/images/kit/bout_imprimer.jpg" border="0"/></a>';
		$aff .= '</p>';
		
		return $aff;
	}
	public function renderPrint() {
		$aff = '<h1 align="center">' . $this->myEtablissement->getRaisonSociale () . '</h1>';
		
		$aff .= $this->myEtablissement->getAdresse1 () . '<br/>';
		$aff .= $this->myEtablissement->getAdresse2 () . '<br/>';
		$aff .= $this->myEtablissement->getCodePostal () . ' ' . $this->myEtablissement->getVille () . '<br/>';
		
		// info general
		$aff .= '<br/>';
		$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
		$aff .= '<tr>';
		$aff .= '	<td><b>Statut :</b></td>';
		
		$aff .= '	<td>' . $this->myEtablissement->SQL_SELECT_STATUT ( $this->myEtablissement->getStatutID () ) . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Reseau :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->SQL_SELECT_Reseau ( $this->myEtablissement->getTypologieID () ) . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Membre du groupe :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->SQL_SELECT_GROUPE ( $this->myEtablissement->getGroupeID () ) . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Concession de :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getVille () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Region :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->SQL_SELECT_Region ( $this->myEtablissement->getRegionID () ) . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Code Site :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getNumRRF () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Acces site Emploi :</b></td>';
		$aff .= '	<td>' . ($this->myEtablissement->getAccesSiteEmploi () == 0 ? 'Non' : 'Oui') . '</td>';
		$aff .= '</tr>';
		if (in_array ( 1, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) || in_array ( 2, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
			$aff .= '<tr>';
			$aff .= '	<td><b>Login Sage :</b></td>';
			$aff .= '	<td>' . ($this->myEtablissement->getLoginSage ()) . '</td>';
			$aff .= '</tr>';
		}
		$aff .= '</table>';
		
		// Coordonnees
		$aff .= '<br/>';
		$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
		$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">COORDONNEES</td></tr>';
		
		$aff .= '<tr>';
		$aff .= '	<td><b>Telephone :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getTelephone () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Fax :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getFax () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>E-Mail :</b></td>';
		$aff .= '	<td><a href="mailto://' . $this->myEtablissement->getMail () . '">' . $this->myEtablissement->getMail () . '</a></td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		
		// Informations diverses
		$aff .= '<br/>';
		$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
		$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">INFORMATIONS DIVERSES</td></tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Contrat V.N. :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getContratVN () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Effectifs :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getEffectifs () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Nb d\'agents total :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getNbAgentsTotal () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Nb de VAR :</b></td>';
		$aff .= '	<td>' . $this->myEtablissement->getNbVar () . '</td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		
		// Adhesion
		$aff .= '<br/>';
		$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
		$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">ADHESION</td></tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>En Sommeil :</b></td>';
		$aff .= '	<td>' . ($this->myEtablissement->getEnSommeil () == 0 ? 'Non' : 'Oui') . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>NISSAN :</b></td>';
		$aff .= '	<td></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>CISCAR :</b></td>';
		$aff .= '	<td></td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		
		// Contacts
		$aff .= '<br/>';
		$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
		$aff .= '<tr><td colspan="3" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">CONTACTS</td></tr>';
		
		foreach ( $this->myEtablissementContactList as $aIndividu ) {
			$aff .= '<tr>';
			$aff .= '	<td><a href="?action=individu&id=' . $aIndividu [0] . '">' . $aIndividu [1] . ' ' . $aIndividu [2] . '</a></td>';
			$aff .= '	<td>' . $aIndividu [3] . '</td>';
			$aff .= '</tr>';
		}
		
		$aff .= '</table>';
		
		$aff .= '<p align="center">';
		$aff .= '<a href="javascript:window.print()"><img src="include/images/kit/bout_imprimer.jpg" border="0"/></a>';
		$aff .= '</p>';
		
		return $aff;
	}
}
?>