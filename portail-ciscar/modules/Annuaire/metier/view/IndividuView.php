<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage annuaire
 * @version 1.0.4
 */
class IndividuView {
	private $myIndividu;
	private $myIndividuDAList;
	public function __construct($aIndividu, $aDAList) {
		$this->myIndividu = $aIndividu;
		$this->myIndividuDAList = $aDAList;
	}
	public function renderHTML() {
		$aff = '<h1 align="center"><b>' . $this->myIndividu->getPrenom () . ' ' . $this->myIndividu->getNom () . '</b></h1>';
		
		$aff .= '<b>' . $this->myIndividu->getRaisonSociale () . '</b><br/>';
		$aff .= $this->myIndividu->getAdresse1 () . '<br/>';
		$aff .= $this->myIndividu->getCodePostal () . ' ' . $this->myIndividu->getVille () . '<br/><br/>';
		
		// Info General
		$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
		$aff .= '<tr>';
		$aff .= '	<td><b>Téléphone :</b></td>';
		$aff .= '	<td>' . $this->myIndividu->getTelephone () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Fax :</b></td>';
		$aff .= '	<td>' . $this->myIndividu->getFax () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>E-Mail :</b></td>';
		$aff .= '	<td><a href="mailto://' . $this->myIndividu->getEmail () . '">' . $this->myIndividu->getEmail () . '</a></td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		
		// Info Adhesion
		if (in_array ( 1, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) || in_array ( 2, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
			$aff .= '<br/>';
			$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
			$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">ADHESION</td></tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>En sommeil :</b></td>';
			$aff .= '	<td></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Membre NISSAN :</b></td>';
			$aff .= '	<td></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Membre CISCAR :</b></td>';
			$aff .= '	<td></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Accès CISCOM :</b></td>';
			$aff .= '	<td></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Accès CARTERIE :</b></td>';
			$aff .= '	<td></td>';
			$aff .= '</tr>';
			$aff .= '</table>';
		}
		
		// Info Activites Professionelles
		$aff .= '<br/>';
		if (count ( $this->myIndividuDAList ) > 0) {
			$aff .= '<table border="0" style="font-size:12px;font-family:arial;" width="100%">';
			$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">ACTIVITES PROFESSIONELLES</td></tr>';
			
			foreach ( $this->myIndividuDAList as $aTab ) {
				$aff .= '<tr>';
				$aff .= '	<td><a href="?action=etablissement&id=' . $aTab [3] . '">' . $aTab [0] . '</a><br/>' . $aTab [1] . '</td>';
				$aff .= '	<td valign="top">' . $aTab [2] . '<br/>' . $aTab [4] . '</td>';
				$aff .= '</tr>';
			}
			$aff .= '</table>';
		}
		
		// Fonction au GCR
		$aArrayCommission = $this->myIndividu->SQL_CommissionsNationales ( $this->myIndividu->getID () );
		$aLineDelegation = $this->myIndividu->SQL_DelegationRegionale ( $this->myIndividu->getID () );
		$aArrayBureauNational = $this->myIndividu->SQL_BureauNational ( $this->myIndividu->getID () );
		if (count ( $aArrayBureauNational ) > 0 || count ( $aArrayCommission ) > 0 || (trim ( $aLineDelegation [1] ) != '' && trim ( $aLineDelegation [3] ) != '')) {
			$aff .= '<br/>';
			$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
			$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">FONCTION AU GCR</td></tr>';
			if (count ( $aArrayBureauNational ) > 0) {
				// Liste des commissions
				$aff .= '<tr>';
				$aff .= '<td colspan="3"><b>Fonction Bureau National</b></td>';
				$aff .= '</tr>';
				
				foreach ( $aArrayBureauNational as $aLine ) {
					$aff .= '<tr>';
					$aff .= '<td width="30"><img src="include/images/0CAKQO14A.gif"/></td>';
					$aff .= '<td colspan="2">' . $aLine [0] . '</td>';
					$aff .= '</tr>';
				}
			}
			
			if (count ( $aArrayCommission ) > 0) {
				// Liste des commissions
				$aff .= '<tr>';
				$aff .= '<td colspan="3"><b>Commissions nationales</b></td>';
				$aff .= '</tr>';
				
				foreach ( $aArrayCommission as $aLine ) {
					$aff .= '<tr>';
					$aff .= '<td width="30"><img src="include/images/0CAKQO14A.gif"/></td>';
					$aff .= '<td><b>Nom</b></td>';
					$aff .= '<td>' . $aLine [1] . '</td>';
					$aff .= '</tr>';
					$aff .= '<tr>';
					$aff .= '<td></td>';
					$aff .= '<td><b>Fonction</b></td>';
					$aff .= '<td>' . $aLine [3] . '</td>';
					$aff .= '</tr>';
				}
			}
			
			if (trim ( $aLineDelegation [1] ) != '' && trim ( $aLineDelegation [3] ) != '') {
				// Delegation Regionnale
				$aff .= '<tr>';
				$aff .= '<td colspan="3"><b>Délégation régionale<b></td>';
				$aff .= '</tr>';
				$aff .= '<tr>';
				$aff .= '<td></td>';
				$aff .= '<td><b>Nom</b></td>';
				$aff .= '<td>' . $aLineDelegation [1] . '</td>';
				$aff .= '</tr>';
				$aff .= '<tr>';
				$aff .= '<td></td>';
				$aff .= '<td><b>Fonction</b></td>';
				$aff .= '<td>' . $aLineDelegation [3] . '</td>';
				$aff .= '</tr>';
			}
			$aff .= '</table>';
		}
		
		// Info Sage
		if (in_array ( 1, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) || in_array ( 2, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
			$aff .= '<br/>';
			$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
			$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">COMPTE UTILISATEUR</td></tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Login :</b></td>';
			$aff .= '	<td>' . $this->myIndividu->getLogin () . '</td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Mot de passe :</b></td>';
			$aff .= '	<td>' . $this->myIndividu->getPassword () . '</td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Login Sage :</b></td>';
			$aff .= '	<td>' . $this->myIndividu->getLoginSage () . '</td>';
			$aff .= '</tr>';
			$aff .= '</table>';
		}
		
		// $aff .= '<br/><a href="?action=annuaire"><img src="include/images/BtNouvRecherche.gif" border="0"></a>';
		$aff .= '<br/><p align="center">';
		// $aff .= '<a href="javascript:history.back()"><img src="include/images/kit/bout_retour.jpg" border="0"/></a>';
		// $aff .= '<a href="?"><img src="include/images/RetourUne.gif" border="0"/></a>';
		$aff .= '<a onclick="window.open(\'indexSimple.php?action=individuPrint&id=' . $this->myIndividu->getID () . '\', \'Impression\', \'Width=800,Height=600,toolbar=yes,scrollbars=yes\')" href="#"><img src="include/images/kit/bout_imprimer.jpg" border="0"/></a>';
		$aff .= '</p>';
		
		return $aff;
	}
	public function renderPrint() {
		$aff = '<h1 align="center"><b>' . $this->myIndividu->getPrenom () . ' ' . $this->myIndividu->getNom () . '</b></h1>';
		
		$aff .= '<b>' . $this->myIndividu->getRaisonSociale () . '</b><br/>';
		$aff .= $this->myIndividu->getAdresse1 () . '<br/>';
		$aff .= $this->myIndividu->getCodePostal () . ' ' . $this->myIndividu->getVille () . '<br/><br/>';
		
		// Info General
		$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
		$aff .= '<tr>';
		$aff .= '	<td><b>Téléphone :</b></td>';
		$aff .= '	<td>' . $this->myIndividu->getTelephone () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>Fax :</b></td>';
		$aff .= '	<td>' . $this->myIndividu->getFax () . '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td><b>E-Mail :</b></td>';
		$aff .= '	<td><a href="mailto://' . $this->myIndividu->getEmail () . '">' . $this->myIndividu->getEmail () . '</a></td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		
		// Info Adhesion
		if (in_array ( 1, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) || in_array ( 2, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
			$aff .= '<br/>';
			$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
			$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">ADHESION</td></tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>En sommeil :</b></td>';
			$aff .= '	<td></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Membre NISSAN :</b></td>';
			$aff .= '	<td></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Membre CISCAR :</b></td>';
			$aff .= '	<td></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Accès CISCOM :</b></td>';
			$aff .= '	<td></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Accès CARTERIE :</b></td>';
			$aff .= '	<td></td>';
			$aff .= '</tr>';
			$aff .= '</table>';
		}
		
		// Info Activites Professionelles
		$aff .= '<br/>';
		if (count ( $this->myIndividuDAList ) > 0) {
			$aff .= '<table border="0" style="font-size:12px;font-family:arial;" width="100%">';
			$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">ACTIVITES PROFESSIONNELLES</td></tr>';
			
			foreach ( $this->myIndividuDAList as $aTab ) {
				$aff .= '<tr>';
				$aff .= '	<td><a href="?action=etablissement&id=' . $aTab [3] . '">' . $aTab [0] . '</a><br/>' . $aTab [1] . '</td>';
				$aff .= '	<td valign="top">' . $aTab [2] . '<br/>' . $aTab [4] . '</td>';
				$aff .= '</tr>';
			}
			$aff .= '</table>';
		}
		
		// Fonction au GCR
		$aArrayCommission = $this->myIndividu->SQL_CommissionsNationales ( $this->myIndividu->getID () );
		$aLineDelegation = $this->myIndividu->SQL_DelegationRegionale ( $this->myIndividu->getID () );
		$aArrayBureauNational = $this->myIndividu->SQL_BureauNational ( $this->myIndividu->getID () );
		if (count ( $aArrayBureauNational ) > 0 || count ( $aArrayCommission ) > 0 || (trim ( $aLineDelegation [1] ) != '' && trim ( $aLineDelegation [3] ) != '')) {
			$aff .= '<br/>';
			$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
			$aff .= '<tr><td colspan="3" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">FONCTION AU GCR</td></tr>';
			
			if (count ( $aArrayBureauNational ) > 0) {
				// Liste des commissions
				$aff .= '<tr>';
				$aff .= '<td colspan="3"><b>Fonction Bureau National</b></td>';
				$aff .= '</tr>';
				
				foreach ( $aArrayBureauNational as $aLine ) {
					$aff .= '<tr>';
					$aff .= '<td width="30"><img src="include/images/0CAKQO14A.gif"/></td>';
					$aff .= '<td colspan="2">' . $aLine [0] . '</td>';
					$aff .= '</tr>';
				}
			}
			
			if (count ( $aArrayCommission ) > 0) {
				// Liste des commissions
				$aff .= '<tr>';
				$aff .= '<td colspan="3"><b>Commissions nationales</b></td>';
				$aff .= '</tr>';
				
				foreach ( $aArrayCommission as $aLine ) {
					$aff .= '<tr>';
					$aff .= '<td width="30"><img src="include/images/0CAKQO14A.gif"/></td>';
					$aff .= '<td><b>Nom</b></td>';
					$aff .= '<td>' . $aLine [1] . '</td>';
					$aff .= '</tr>';
					$aff .= '<tr>';
					$aff .= '<td></td>';
					$aff .= '<td><b>Fonction</b></td>';
					$aff .= '<td>' . $aLine [3] . '</td>';
					$aff .= '</tr>';
				}
			}
			
			if (trim ( $aLineDelegation [1] ) != '' && trim ( $aLineDelegation [3] ) != '') {
				// Delegation Regionnale
				$aff .= '<tr>';
				$aff .= '<td colspan="3"><b>Délégation régionale<b></td>';
				$aff .= '</tr>';
				$aff .= '<tr>';
				$aff .= '<td></td>';
				$aff .= '<td><b>Nom</b></td>';
				$aff .= '<td>' . $aLineDelegation [1] . '</td>';
				$aff .= '</tr>';
				$aff .= '<tr>';
				$aff .= '<td></td>';
				$aff .= '<td><b>Fonction</b></td>';
				$aff .= '<td>' . $aLineDelegation [3] . '</td>';
				$aff .= '</tr>';
			}
			$aff .= '</table>';
		}
		
		// Info Sage
		if (in_array ( 1, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] ) || in_array ( 2, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
			$aff .= '<br/>';
			$aff .= '<table border="0" style="font-size:12px;font-family:arial;">';
			$aff .= '<tr><td colspan="2" style="background:#FFFFFF url(\'../../include/images/kit/fd_titre_annuaire.jpg\') no-repeat;color:#FFFFFF;height:23px;font-weight:bold;padding-left:5px;width:600px;">COMPTE UTILISATEUR</td></tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Login :</b></td>';
			$aff .= '	<td>' . $this->myIndividu->getLogin () . '</td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Mot de passe :</b></td>';
			$aff .= '	<td>' . $this->myIndividu->getPassword () . '</td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td><b>Login Sage :</b></td>';
			$aff .= '	<td>' . $this->myIndividu->getLoginSage () . '</td>';
			$aff .= '</tr>';
			$aff .= '</table>';
		}
		
		$aff .= '<p align="center">';
		$aff .= '<a href="javascript:window.print()"><img src="include/images/kit/bout_imprimer.jpg" border="0"/></a>';
		$aff .= '</p>';
		
		return $aff;
	}
}
?>