<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class IndividuView {
	private $myIndividu;

	function __construct($aIndividu)
	{
		$this->myIndividu = $aIndividu;
	}
	function IndividuView($aIndividu) {
		self::__construct($aIndividu);
	}

	// ###########
	public function render($mod) {
		// etablissement
		$aEtablissement = new Etablissement ();
		$aEtablissement->select_etablissement ( $_GET ['id'] );

		// ###############

		// Fonction Delegation
		$aFonctionDelegationListe = new FonctionDelegationListe ();
		$aFonctionDelegationListe->select_all_fonctiondelegation ();
		$aFonctionDelegationListeView = new FonctionDelegationListeView ( $aFonctionDelegationListe );

		$aDelegationRegionnale = new DelegationRegionnale ();
		if ($mod == 'edit') {

			$aDelegationRegionnale->select_delegationregionnale ( $this->myIndividu->getID () );
			$tmp = $aDelegationRegionnale->getFonctionDelegation ();

			$FonctionDelegationID = empty ( $tmp ) ? 0 : $tmp->getID ();
		} else {
			$FonctionDelegationID = 0;
		}

		// Region
		$aRegionListe = new RegionListe ();
		$aRegionListe->select_all_region ();
		$aRegionListeView = new RegionListeView ( $aRegionListe );
		if ($mod == 'edit') {
			$tmp = $aDelegationRegionnale->getRegion ();
			$RegionID = empty ( $tmp ) ? 0 : $tmp->getID ();
		} else {
			$RegionID = 0;
		}

		// Fonction Commission
		$aFonctionCommissionListe = new FonctionCommissionListe ();
		$aFonctionCommissionListe->select_all_fonctioncommission ();
		$aFonctionCommissionListeView = new FonctionCommissionListeView ( $aFonctionCommissionListe );

		// Commission
		$aCommissionListe = new CommissionListe ();
		$aCommissionListe->select_all_commission ();
		$aCommissionListeView = new CommissionListeView ( $aCommissionListe );

		$CommissionID_1 = 0;
		$FonctionCommissionID_1 = 0;

		$CommissionID_2 = 0;
		$FonctionCommissionID_2 = 0;

		$CommissionID_3 = 0;
		$FonctionCommissionID_3 = 0;

		$CommissionID_4 = 0;
		$FonctionCommissionID_4 = 0;

		// Obtenir les commissions selectionnées
		if ($mod == 'edit') {
			$aCommissionIndividuListe = new CommissionIndividuListe ();
			$aCommissionIndividuListe->select_all_commissionindividu ( $this->myIndividu->getID () );

			$i = 1;
			foreach ( $aCommissionIndividuListe->getCommissionIndividuListe () as $aCommissionIndividu ) {
				if ($i == 1) {
					$CommissionID_1 = $aCommissionIndividu->getCommission ()->getID ();
					$FonctionCommissionID_1 = $aCommissionIndividu->getFonctionCommission ()->getID ();
				} else if ($i == 2) {
					$CommissionID_2 = $aCommissionIndividu->getCommission ()->getID ();
					$FonctionCommissionID_2 = $aCommissionIndividu->getFonctionCommission ()->getID ();
				} else if ($i == 3) {
					$CommissionID_3 = $aCommissionIndividu->getCommission ()->getID ();
					$FonctionCommissionID_3 = $aCommissionIndividu->getFonctionCommission ()->getID ();
				} else if ($i == 4) {
					$CommissionID_4 = $aCommissionIndividu->getCommission ()->getID ();
					$FonctionCommissionID_4 = $aCommissionIndividu->getFonctionCommission ()->getID ();
				}
				$i ++;
			}
		}

		// ###########################

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;<a href="?">Individu</a>&nbsp;>&nbsp;';

		switch ($mod) {
			case 'new' :
				$aff .= 'Cr&eacute;ation';
				$aff .= '</div><br/><br/>';
				$aff .= '<form method="POST" action="?action=new&id=' . $aEtablissement->getID () . '" name="IndividuForm" id="IndividuForm" onsubmit="return checkFormIndividu()">';
				break;
			case 'edit' :
				$aff .= 'Edition';
				$aff .= '</div><br/><br/>';
				$aff .= '<form method="POST" action="?action=u&id=' . $this->myIndividu->getID () . '" name="IndividuForm" id="IndividuForm" onsubmit="return checkFormIndividu()">';
				$aff .= '<input type="button" value="Notifier le Mot de passe" onclick="location.href=\'../mail/notification.php?id=' . $this->myIndividu->getID () . '\'"/>';
				break;
		}

		$aff .= '<input type="hidden" value="' . $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '" name="SiteName"/>';

		$aff .= '<br/><br/>';
		$aff .= '<table width="800">';

		$aff .= '<tr>';
		$aff .= '<td colspan="2"><b><u>Informations Communes</u></b></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Civilit&eacute;</td>';
		$aff .= '<td>';
		$aff .= '<input type="radio" name="Civilite" value="1"' . ($this->myIndividu->getCivilite () == 1 ? ' Checked' : '') . '/>Mr.';
		$aff .= '<input type="radio" name="Civilite" value="2"' . ($this->myIndividu->getCivilite () == 2 ? ' Checked' : '') . '/>Mme';
		$aff .= '<input type="radio" name="Civilite" value="3"' . ($this->myIndividu->getCivilite () == 3 ? ' Checked' : '') . '/>Mlle';
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Nom*</td>';
		$aff .= '<td><input type="text" name="Nom" value="' . $this->myIndividu->getNom () . '" size="50" MAXLENGTH="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Pr&eacute;nom*</td>';
		$aff .= '<td><input type="text" name="Prenom" value="' . $this->myIndividu->getPrenom () . '" size="50" MAXLENGTH="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>T&eacute;l&eacute;phone</td>';
		$aff .= '<td><input type="text" name="Telephone" value="' . $this->myIndividu->getTelephone () . '" size="50" MAXLENGTH="100"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>T&eacute;l&eacute;phone Portable</td>';
		$aff .= '<td><input type="text" name="TelephonePortable" value="' . $this->myIndividu->getTelephonePortable () . '" size="50" MAXLENGTH="100"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Fax</td>';
		$aff .= '<td><input type="text" name="Fax" value="' . $this->myIndividu->getFax () . '" size="50" MAXLENGTH="100"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>E-Mail*</td>';
		$aff .= '<td><input type="text" name="Mail" value="' . $this->myIndividu->getMail () . '" size="50" MAXLENGTH="250"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Import Actif *dev*</td>';
		$aff .= '<td>';
		$aff .= '<input type="radio" name="ImportActif" value="1"' . ($this->myIndividu->getImportActif () == 1 ? ' Checked' : '') . '/>OUI';
		$aff .= '<input type="radio" name="ImportActif" value="0"' . ($this->myIndividu->getImportActif () != 1 ? ' Checked' : '') . '/>NON';
		$aff .= '</td>';
		$aff .= '</tr>';

		if ($mod == 'edit') {
			// #############

			$aff .= '<tr>';
			$aff .= '<td colspan="2"><b><u>Compte utilisateur</u></b></td>';
			$aff .= '</tr>';

			// #############

			$aff .= '<tr>';
			$aff .= '<td>Login</td>';
			$aff .= '<td><input type="text" name="Login" value="' . $this->myIndividu->getLogin () . '" size="50" class="disabled" MAXLENGTH="50" readonly/></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Password</td>';
			$aff .= '<td><input type="text" name="Password" value="' . $this->myIndividu->getPassword () . '" size="50" MAXLENGTH="50"/></td>';
			$aff .= '</tr>';
		}
		// #############

		$aff .= '<tr>';
		$aff .= '<td colspan="2"><b><u>Compte Sage</u></b></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Login</td>';
		$aff .= '<td><input type="text" name="LoginSage" value="' . $this->myIndividu->getLoginSage () . '" size="50" MAXLENGTH="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Password</td>';
		$aff .= '<td><input type="text" name="PasswordSage" value="' . $this->myIndividu->getPasswordSage () . '" size="50" MAXLENGTH="50"/></td>';
		$aff .= '</tr>';

		// ##############
		// GCR UNIQUEMENT
		// ##############
		if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == 2) {
			$aff .= '<tr>';
			$aff .= '<td colspan="2"><b><u>Fonction au GCR</u></b></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td colspan="2"><u>Bureau National</u></td>';
			$aff .= '</tr>';

			// Fonction Bn
			$aFonctionBNListe = new FonctionBNListe ();
			$aFonctionBNListe->select_all_fonctionbn ();
			$aFonctionBNListeView = new FonctionBNListeView ( $aFonctionBNListe );

			$aIndividuFonctionBNList = new IndividuFonctionBNList ();
			if ($mod == 'edit') {
				$aIndividuFonctionBNList->SQL_SELECT_ALL ( $this->myIndividu->getID () );
			}

			$aff .= '<tr>';
			$aff .= '<td>Fonction</td>';
			$aff .= '<td>' . $aFonctionBNListeView->render_option_width_empty_selected ( $aIndividuFonctionBNList ) . '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td colspan="2"><u>Commission Nationales et Groupes de travail</u></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Nom</td>';
			$aff .= '<td>' . $aCommissionListeView->render_option_width_empty ( $CommissionID_1, 'CommissionID_1' ) . '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Fonction</td>';
			$aff .= '<td>' . $aFonctionCommissionListeView->render_option_width_empty ( $FonctionCommissionID_1, 'FonctionCommissionID_1' ) . '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Nom</td>';
			$aff .= '<td>' . $aCommissionListeView->render_option_width_empty ( $CommissionID_2, 'CommissionID_2' ) . '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Fonction</td>';
			$aff .= '<td>' . $aFonctionCommissionListeView->render_option_width_empty ( $FonctionCommissionID_2, 'FonctionCommissionID_2' ) . '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Nom</td>';
			$aff .= '<td>' . $aCommissionListeView->render_option_width_empty ( $CommissionID_3, 'CommissionID_3' ) . '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Fonction</td>';
			$aff .= '<td>' . $aFonctionCommissionListeView->render_option_width_empty ( $FonctionCommissionID_3, 'FonctionCommissionID_3' ) . '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Nom</td>';
			$aff .= '<td>' . $aCommissionListeView->render_option_width_empty ( $CommissionID_4, 'CommissionID_4' ) . '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Fonction</td>';
			$aff .= '<td>' . $aFonctionCommissionListeView->render_option_width_empty ( $FonctionCommissionID_4, 'FonctionCommissionID_4' ) . '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td colspan="2"><u>D&eacute;l&eacute;gation R&eacute;gionale</u></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>R&eacute;gion</td>';
			$aff .= '<td>' . $aRegionListeView->render_option_width_empty ( $RegionID ) . '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Fonction</td>';
			$aff .= '<td>' . $aFonctionDelegationListeView->render_option_width_empty ( $FonctionDelegationID ) . '</td>';
			$aff .= '</tr>';
		}
		// #############

		if ($mod == 'new') {
			$aff .= '<tr>';
			$aff .= '<td colspan="2"><b><u>Informations Concession</u></b></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Raison Sociale</td>';
			$aff .= '<td><input type="text" value="' . $aEtablissement->getRaisonSociale () . '" readonly/></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Ville</td>';
			$aff .= '<td><input type="text" value="' . $aEtablissement->getVille () . '" readonly/></td>';
			$aff .= '</tr>';

			// Domaine Activite
			$aDomaineActiviteListe = new DomaineActiviteListe ();
			$aDomaineActiviteListe->select_all_domaineactivite ();

			$aff .= '<tr>';
			$aff .= '<td colspan="2"><b><u>Informations Role</u></b></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Domaine Activit&eacute;*</td>';
			$aff .= '<td><select name="DomainActiviteID" id="DomainActiviteID">';
			$aDomaineActiviteID = NULL;
			foreach ( $aDomaineActiviteListe->getDomaineActiviteListe () as $aDomaineActivite ) {
				$aff .= '<option value="' . $aDomaineActivite->getID () . '">' . stripslashes ( $aDomaineActivite->getName () ) . '</option>';
				if (is_null ( $aDomaineActiviteID )) {
					$aDomaineActiviteID = $aDomaineActivite->getID ();
				}
			}
			$aff .= '</select>';
			$aff .= '<script type="text/javascript">';
			$aff .= '$(document).ready(function(){';
			$aff .= '	$.ajax({
							   type: "GET",
							   url: "../lva/FonctionDA/indexAJAX.php",
							   data: "action=list&id="+' . $aDomaineActiviteID . ',
							   success: function(msg){
									$("#FonctionDAID").html(msg);
								}
							});';
			$aff .= '	$("#DomainActiviteID").change(function(){
							$.ajax({
							   type: "GET",
							   url: "../lva/FonctionDA/indexAJAX.php",
							   data: "action=list&id="+$("#DomainActiviteID").val(),
							   success: function(msg){
									$("#FonctionDAID").html(msg);
								}
							});
							return false;
						});';
			$aff .= '});';
			$aff .= '</script>';
			$aff .= '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Fonction*</td>';
			$aff .= '<td><select name="FonctionDAID" id="FonctionDAID"></select></td>';
			$aff .= '</tr>';
		}

		$aff .= $this->LCArenderHTML ( $mod );
		$aff .= '</table>';
		$aff .= '<br/>';
		$aff .= $this->RoleRenderHTML ( $mod );
		$aff .= '<br/>';

		// Bouton Formulaire
		switch ($mod) {
			case 'new' :
				$aff .= '<input type="submit" value="Cr&eacute;er">';
				break;
			case 'edit' :
				$aff .= '<input type="submit" value="Mettre &agrave; Jour">';
				break;
		}

		$aff .= '</form>';
		echo $aff;
	}
	private function LCArenderHTML($mod) {
		$ACCES_ACNF = false;
		$ACCES_CISCAR = false;
		$PROFIL_RENAULT = false;
		$PROFIL_HORS_RENAULT = false;
		$ACCES_GCR = false;
		$ACCES_SITE_EMPLOI = false;
		if ($mod == 'new') {
			switch ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID']) {
				case '1' :

					// CISCAR
					$ACCES_ACNF = false;
					$ACCES_CISCAR = true;
					$PROFIL_RENAULT = false;
					$PROFIL_HORS_RENAULT = true;
					$ACCES_GCR = false;
					$ACCES_SITE_EMPLOI = false;
					break;
				case '2' :

					// GCR
					$ACCES_ACNF = false;
					$ACCES_CISCAR = true;
					$PROFIL_RENAULT = false;
					$PROFIL_HORS_RENAULT = true;
					$ACCES_GCR = true;
					$ACCES_SITE_EMPLOI = false;
					break;
				case '3' :

					// ACNF
					$ACCES_ACNF = true;
					$ACCES_CISCAR = true;
					$PROFIL_RENAULT = false;
					$PROFIL_HORS_RENAULT = true;
					$ACCES_GCR = false;
					$ACCES_SITE_EMPLOI = false;
					break;
			}
		} else {
			$aSimple_LCAGroupeMembreList = new Simple_LCAGroupeMembreList ();
			$aSimple_LCAGroupeMembreList->SQL_SELECT_ALL_GROUPE ( $this->myIndividu->getID () );
			$aLangueListe = new LangueListe ();

			foreach ( $aSimple_LCAGroupeMembreList->getList () as $aGroupeLCA ) {
				switch ($aGroupeLCA->getID ()) {
					case '3' :

						// CISCAR
						$ACCES_CISCAR = true;
						break;
					case '4' :

						// GCR
						$ACCES_GCR = true;
						break;
					case '5' :

						// ACNF
						$ACCES_ACNF = true;
						break;
					case '8' :

						// Renault
						$PROFIL_RENAULT = true;
						break;
					case '9' :

						// Hors-Renault
						$PROFIL_HORS_RENAULT = true;
						break;
					case '11' :

						// GCR - SiteEmploi
						$ACCES_SITE_EMPLOI = true;
						break;
				}
			}
		}
		$aff = '';
		$aff .= '			<tr>';
		$aff .= '				<td colspan="2"><b><u>Acces Site</u></b></td>';
		$aff .= '			</tr>';
		$aff .= '			<tr>';
		$aff .= '				<td width="150">En Sommeil</td>';
		$aff .= '				<td>';
		$aff .= '					<input type="radio" name="EnSommeil" value="1"' . ($this->myIndividu->getEnSommeil () == 1 ? ' Checked' : '') . '/>OUI';
		$aff .= '					<input type="radio" name="EnSommeil" value="0"' . ($this->myIndividu->getEnSommeil () != 1 ? ' Checked' : '') . '/>NON';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		$aff .= '			<tr>';
		$aff .= '				<td colspan="2"><b>&nbsp;</td>';
		$aff .= '			</tr>';
		$aff .= '			<tr>';
		$aff .= '				<td width="150">Langues</td>';
		$aff .= '				<td><table boder=0><tr>';
		foreach ( $aLangueListe->getLangueListe () as $aLangue ) {
			$aff .= '<td><label><input type="checkbox" name="dep_' . $aLangue->getID () . '" value="checked"' . '> ' . $aLangue->getCode () . ' - ' . $aLangue->getName () . '</label></td>';
		}
		$aff .= '				</tr></table></td>';
		$aff .= '			</tr>';
		$aff .= '			<tr>';
		$aff .= '				<td colspan="2">&nbsp;</td>';
		$aff .= '			</tr>';
		// #############//#############//#############
		// $aff .= ' <tr>';
		// $aff .= ' <td width="150">ACNF</td>';
		// $aff .= ' <td>';
		// $aff .= ' <input type="radio" name="ACCES_ACNF" value="1"' . ($ACCES_ACNF ? ' Checked' : '') . '/>OUI';
		// $aff .= ' <input type="radio" name="ACCES_ACNF" value="0"' . ($ACCES_ACNF ? '' : ' Checked') . '/>NON';
		// $aff .= ' </td>';
		// $aff .= ' </tr>';
		// ###
		$aff .= '			<tr>';
		$aff .= '				<td width="150">CISCAR</td>';
		$aff .= '				<td>';
		$aff .= '					<input type="radio" name="ACCES_CISCAR" value="1"' . ($ACCES_CISCAR ? ' Checked' : '') . '/>OUI';
		$aff .= '					<input type="radio" name="ACCES_CISCAR" value="0"' . ($ACCES_CISCAR ? '' : ' Checked') . '/>NON';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		// ###
		$aff .= '			<tr>';
		$aff .= '				<td width="150" valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Affichage</i></td>';
		$aff .= '				<td>';
		$aff .= '					<input type="radio" name="PROFIL_RENAULT" value="1"' . ($PROFIL_RENAULT ? ' Checked' : '') . '/>Renault<br/>';
		$aff .= '					<input type="radio" name="PROFIL_RENAULT" value="0"' . ($PROFIL_RENAULT ? '' : ' Checked') . '/>Hors Renault';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		// ###
		$aff .= '			<tr>';
		$aff .= '				<td width="150">GCR</td>';
		$aff .= '				<td>';
		$aff .= '					<input type="radio" name="ACCES_GCR" value="1"' . ($ACCES_GCR ? ' Checked' : '') . '/>OUI';
		$aff .= '					<input type="radio" name="ACCES_GCR" value="0"' . ($ACCES_GCR ? '' : ' Checked') . '/>NON';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		// ###
		$aff .= '			<tr>';
		$aff .= '				<td width="150">GCR - Site Emploi</td>';
		$aff .= '				<td>';
		$aff .= '					<input type="radio" name="ACCES_SITE_EMPLOI" value="1"' . ($ACCES_SITE_EMPLOI ? ' Checked' : '') . '/>OUI';
		$aff .= '					<input type="radio" name="ACCES_SITE_EMPLOI" value="0"' . ($ACCES_SITE_EMPLOI ? '' : ' Checked') . '/>NON';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		return $aff;
	}
	private function RoleRenderHTML($mod) {
		$aff = '<img src="../../include/images/1.png"/> <b>Liste des Roles</b><br/>';
		$aSimple_RoleList = new Simple_RoleList ();
		$aSimple_RoleList->SQL_SELECT_BY_INDIVIDU ( $this->myIndividu->getID () );

		if (count ( $aSimple_RoleList->getList () ) == 0) {
			$aff .= '<font style="color:black;background-color:red;font-size:14px;"><b>Pas de Rôle !!!</b></font><br/><br/>';
		} else {
			$aff .= '<table id="TableList">';
			$aff .= '<tr class="title"><td>Raison Sociale</td><td width="50">Action</td></tr>';

			foreach ( $aSimple_RoleList->getList () as $aRow ) {
				$aff .= '<tr><td>' . $aRow [1] . '</td><td width="50" align="center"><a href="../role/?action=edit&id=' . $aRow [0] . '"><img src="../../include/images/voir.jpg" border="0" width="16"/></a></td></tr>';
			}
			$aff .= '</table>';
		}

		return $aff;
	}
}

?>