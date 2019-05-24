<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class IndividuTabView {
	private $myIndividu;
	public function __construct(Individu $aIndividu) {
		$this->myIndividu = $aIndividu;
	}

	// ###
	public function renderHTML($mod) {
		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;<a href="?">Individu</a>&nbsp;>&nbsp;';

		switch ($mod) {
			case 'new' :
				$aff .= 'Création';
				$aff .= '</div><br/>';
				$aff .= '<form method="POST" action="?action=new&id=' . $_GET ['id'] . '" name="IndividuForm" id="IndividuForm" onsubmit="return checkFormIndividu()">';
				break;
			case 'new_sans_role' :
				$aff .= 'Création sans Rôle';
				$aff .= '</div><br/>';
				$aff .= '<form method="POST" action="?action=adduser&id=' . $_GET ['id'] . '" name="IndividuForm" id="IndividuForm" onsubmit="return checkFormIndividuSansRole()">';
				break;
			case 'edit' :
				$aff .= 'Edition';
				$aff .= '</div><br/>';
				$aff .= '<form method="POST" action="?action=u&id=' . $this->myIndividu->getID () . '" name="IndividuForm" id="IndividuForm" onsubmit="return checkFormIndividu()">';
				break;
		}

		if ($mod == 'new' || $mod == 'new_sans_role') {
			$aff .= '<div id="error"></div>';
			$aff .= '<script type="text/javascript">';
			$aff .= '//Check unicite utilisateur
					function checkunique()
					{
						$.ajax({
						   type: "POST",
						   url: "../individu/indexSimple.php?action=checkunique",
						   data: "nom="+$("#pNom").val()+"&prenom="+$("#pPrenom").val()+"&LoginRgpd="+$("#pLoginRgpd").val(),
						   success: function(msg){
								$("#error").html("<span style=\"font-size:14px;color:red;font-weight:bolder;\">"+msg+"</span>");
							}
						});
						var t= setTimeout("checkunique()", 4000);
					}
			
			checkunique();
			';
			$aff .= '</script>';
		}
		$aff .= '<!-- chargement de fancybox -->';
		$aff .= '<script type="text/javascript" src="../../include/js/fancybox/jquery.fancybox.js"></script>';
		$aff .= '<link rel="stylesheet" type="text/css" href="../../include/js/fancybox/jquery.fancybox.css" media="screen" />';
		$aff .= '<script type="text/javascript">';
		$aff .= '$(function() {';
		$aff .= '$(\'.expbtn\').click(function() {
				$.fancybox(
				{
					type : \'iframe\',
					href:\'../../modules/prestashop/index.php?individuID=' . $this->myIndividu->getID () . '\',
					maxWidth : 430,
					maxHeight : 180,
					fitToView : false,
					width : \'50%\',
					height : \'50%\',
					autoSize : false,
					padding : 0,
					closeBtn : true,
							beforeShow: function(){
  							$(".fancybox-skin").css("backgroundColor","#cdcdcd");},				
					helpers : {
     				overlay : {
            		css : {\'background\' : \'rgba(58, 42, 45, 0.95)\'},
					closeClick : false, 
       						  }
       						  }
				})';
		$aff .= '})';
		$aff .= '})';
		$aff .= '</script>';
		$aff .= '<p align="left"><input type="button" value="Notification identifiants" onclick="NotificationMail()"/></p>';
		$aff .= '<input type="hidden" name="action2" id="action2" value=""/>';
		$aff .= '<input type="hidden" value="' . $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '" name="SiteName"/>';
		$aff .= '<table width="100%" border="1" cellspacing="0" cellpadding="5">';
		$aff .= '<tr>';
		$aff .= '<td rowspan="4" width="100" valign="top">';
		$aff .= '	<a href="javascript:displayTab(\'1\')" class="linkTabDocumentCurrent" id="linkTabGeneral">Général</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'4\')" class="linkTabDocument" id="linkTabSage">Sage</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'2\')" class="linkTabDocument" id="linkTabRole">Rôle</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'3\')" class="linkTabDocument" id="linkTabLCA">LCA</a><br/>';
		$aff .= '</td>';
		$aff .= '<td id="tabGeneral" class="tabDocument" valign="top">';
		$aff .= $this->GeneralRenderHTML ( $mod );
		$aff .= '</td></tr>';
		$aff .= '<tr><td id="tabSage" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->SageRenderHTML ( $mod );
		$aff .= '</td></tr>';
		$aff .= '<tr><td id="tabRole" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->RoleRenderHTML ( $mod );
		$aff .= '</td></tr>';
		$aff .= '<tr><td id="tabLCA" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->LCArenderHTML ( $mod );
		$aff .= '</td></tr>';
		$aff .= '</table>';

		// Bouton
		switch ($mod) {
			case 'new' :
			case 'new_sans_role' :
				$aff .= '<p><input type="submit" value="Créer"/></p>';
				$aff .= '</form>';
				break;
			case 'edit' :
				$aff .= '<input type="button" value="Enregistrer" onclick="Form.Individu.btEnregistrer()" /> ';
				$aff .= '<input type="button" value="Enregistrer et Fermer" onclick="Form.Individu.btEnregistrerEtFermer()"/>';
				$aff .= '&nbsp;<input id="expbtn" class="expbtn" type="button" value="Export ciscar.net" />';
				$aff .= '</form>';
				break;
		}

		echo $aff;
	}
	private function GeneralRenderHTML($mod) {
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

		// Obtenir les commissions selectionnÃ©es
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
		$aff = '';
		$aff .= '<table width="800">';

		$aff .= '<tr>';
		$aff .= '<td colspan="2"><b><u>Informations Communes</u></b></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Civilit&eacute;</td>';
		$aff .= '<td>';
		$aff .= '<input type="radio" name="Civilite" value="1"' . ($this->myIndividu->getCivilite () == 1 ? ' Checked' : '') . '/>M.';
		$aff .= '<input type="radio" name="Civilite" value="2"' . ($this->myIndividu->getCivilite () == 2 ? ' Checked' : '') . '/>Mme';
		$aff .= '<input type="radio" name="Civilite" value="3"' . ($this->myIndividu->getCivilite () == 3 ? ' Checked' : '') . '/>Mlle';
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Nom*</td>';
		$aff .= '<td><input type="text" id="pNom" name="Nom" value="' . stripslashes ( $this->myIndividu->getNom () ) . '" size="50" MAXLENGTH="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Pr&eacute;nom*</td>';
		$aff .= '<td><input type="text" id="pPrenom" name="Prenom" value="' . stripslashes ( $this->myIndividu->getPrenom () ) . '" size="50" MAXLENGTH="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>T&eacute;l&eacute;phone</td>';
		$aff .= '<td><input type="text" name="Telephone" value="' . stripslashes ( $this->myIndividu->getTelephone () ) . '" size="50" MAXLENGTH="100"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>T&eacute;l&eacute;phone Portable</td>';
		$aff .= '<td><input type="text" name="TelephonePortable" value="' . stripslashes ( $this->myIndividu->getTelephonePortable () ) . '" size="50" MAXLENGTH="100"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Fax</td>';
		$aff .= '<td><input type="text" name="Fax" value="' . stripslashes ( $this->myIndividu->getFax () ) . '" size="50" MAXLENGTH="100"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>E-Mail*</td>';
		$aff .= '<td><input type="text" id="pMail" name="Mail" value="' . stripslashes ( $this->myIndividu->getMail () ) . '" size="50" MAXLENGTH="250"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>E-Mail 2</td>';
		$aff .= '<td><input type="text" name="Mail2" value="' . stripslashes ( $this->myIndividu->getMail2 () ) . '" size="50" MAXLENGTH="250"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>E-Mail 3</td>';
		$aff .= '<td><input type="text" name="Mail3" value="' . stripslashes ( $this->myIndividu->getMail3 () ) . '" size="50" MAXLENGTH="250"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>E-Mail 4</td>';
		$aff .= '<td><input type="text" name="Mail4" value="' . stripslashes ( $this->myIndividu->getMail4 () ) . '" size="50" MAXLENGTH="250"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Date de cr&eacute;ation :</td>';
		$aff .= '<td>' . $this->myIndividu->getDateCreat () . '</td>';
		$aff .= '</tr>';

		$aff .= '<tr style="display:none;">';
		$aff .= '<td>Import Actif *dev*</td>';
		$aff .= '<td>';
		$aff .= '<input type="radio" name="ImportActif" value="1"' . ($this->myIndividu->getImportActif () == 1 ? ' Checked' : '') . '/>OUI';
		$aff .= '<input type="radio" name="ImportActif" value="0"' . ($this->myIndividu->getImportActif () != 1 ? ' Checked' : '') . '/>NON';
		$aff .= '</td>';
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
			$aff .= '<td colspan="2"><u>Commissions Nationales et Groupes de Travail</u></td>';
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

		$aff .= '</table>';
		return $aff;
	}
	private function SageRenderHTML($mod) {
		$aff = '<table width="800">';
		$aff .= '<tr>';
		$aff .= '<td colspan="2"><b><u>Compte Sage</u></b></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Login</td>';
		$aff .= '<td><input type="text" name="LoginSage"  value="' . stripslashes ( $this->myIndividu->getLoginSage () ) . '" size="50" MAXLENGTH="50"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Nom utilisateur</td>';
		$aff .= '<td><input type="text" name="IdSage" id="IdSage" value="' . stripslashes ( $this->myIndividu->getIdSage () ) . '" size="50" MAXLENGTH="50"/></td>';
		$aff .= '</tr>';

		/*
		 * $aff .= '<tr>';
		 * $aff .= '<td>Password</td>';
		 * $aff .= '<td><input type="text" name="PasswordSage" value="'.$this->myIndividu->getPasswordSage().'" size="50" MAXLENGTH="50"/></td>';
		 * $aff .= '</tr>';
		 */
		$aff .= '</table>';
		return $aff;
	}
	private function mefUrl($action, $username) {
		$clefAutologin = 'ecommerce104';
		$actionMode = 'autoLogin';
		$loginGCR = $username;
		$stamp = date ( 'Y-m-d H:i:s' ); // yyyy-mm-dd hh:mm:ss GMT
		$stampWEB = date ( 'Y-m-d%20H:i:s' );
		// $stampWEB = '2017-03-03%2014:31:46';
		// $stamp = '2017-03-03 14:31:46';
		if ($action == 'geolane') {
			$loginType = '3';
			$signature = MD5 ( $loginType . $this->myIndividu->getLoginSage () . $stamp . $clefAutologin ); // MD5 32 CHARS
			$URL = 'http://ciscar-prod.geolane.fr/extranet/securite/auto-login.html';
		} else {
			$loginType = '2';
			$signature = MD5 ( $this->myIndividu->getLoginSage () . $stamp . $this->myIndividu->getLogin () . $clefAutologin );
			$URL = 'http://papeterie.ciscar.gcr.fr/ciscar/Login.aspx';
		}

		if ($action == 'geolane') {
			$params = '?action=' . $actionMode;
			$params .= '&loginCode=' . $this->myIndividu->getLoginSage ();
			$params .= '&loginType=' . $loginType;
			$params .= '&stamp=' . $stampWEB;
			$params .= '&signature=' . $signature;
			$params .= '&contactCode=' . $this->myIndividu->getLogin ();
			$params .= '&page=acc';
		} else {
			$params = '?action=' . $actionMode;
			$params .= '&loginCode=' . $this->myIndividu->getLoginSage ();
			$params .= '&stamp=' . $stampWEB;
			$params .= '&loginGCR=' . $this->myIndividu->getLogin ();
			$params .= '&signature=' . $signature;
		}

		return $URL . $params;
	}
	private function LCArenderHTML($mod) {
		$ACCES_ACNF = false;
		$ACCES_CISCAR = false;
		$PROFIL_RENAULT = false;
		$PROFIL_HORS_RENAULT = false;
		$PROFIL_INDRA = false;
		$ACCES_GCR = false;
		$ACCES_SITE_EMPLOI = false;
		$ACCES_CISCOM = false;
		$ACCES_CARTERIE = false;
		$ACCES_CISCAR_BELGE = false;
		$ACCES_STVA = false;

		if ($mod == 'new' || $mod == 'new_sans_role') {
			// Valeur par defaut
			$ACCES_CARTERIE = true;

			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( trim ( $_GET ['id'] ) );
			$aLangueListe = new LangueListe ();
			$aLangueListe->select_all_Langue ();

			switch ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID']) {
				case '1' :

					// CISCAR
					$ACCES_ACNF = false;
					$ACCES_CISCAR = true;
					$PROFIL_RENAULT = true;
					$PROFIL_HORS_RENAULT = false;
					$PROFIL_INDRA = false;
					$ACCES_GCR = false;
					$ACCES_SITE_EMPLOI = $aEtablissement->getAccesSiteEmploi () == '1';
					break;
				case '2' :

					// GCR
					$ACCES_ACNF = false;
					$ACCES_CISCAR = true;
					$PROFIL_RENAULT = true;
					$PROFIL_HORS_RENAULT = false;
					$PROFIL_INDRA = false;
					$ACCES_GCR = true;
					$ACCES_SITE_EMPLOI = $aEtablissement->getAccesSiteEmploi () == '1';
					break;
				case '3' :

					// ACNF
					$ACCES_ACNF = true;
					$ACCES_CISCAR = true;
					$PROFIL_RENAULT = true;
					$PROFIL_HORS_RENAULT = false;
					$PROFIL_INDRA = false;
					$ACCES_GCR = false;
					$ACCES_SITE_EMPLOI = $aEtablissement->getAccesSiteEmploi () == '1';
					break;
			}
		} else {
			$aSimple_LCAGroupeMembreList = new Simple_LCAGroupeMembreList ();
			$aSimple_LCAGroupeMembreList->SQL_SELECT_ALL_GROUPE ( $this->myIndividu->getID () );
			$aLangueListe = new LangueListe ();
			$aLangueListe->select_all_Langue ();
			$aLangueListe->select_all_Langue_Individu ( $this->myIndividu->getID () );

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
					case '15' :

						// INDRA
						$PROFIL_INDRA = true;
						break;
					case '11' :

						// GCR - SiteEmploi
						$ACCES_SITE_EMPLOI = true;
						break;
					case '12' :
						$ACCES_CISCOM = true;
						break;
					case '13' :
						$ACCES_CARTERIE = true;
						break;
					case '6' :
						$ACCES_CISCAR_BELGE = true;
						break;
					case '433' : // Base en local
						$ACCES_STVA = true;
						break;
					case '497' : // Base en production
						$ACCES_STVA = true;
						break;
				}
			}
		}

		$aff = '';
		$aff .= '<table width="800">';
		if ($mod == 'edit') {
			$aff .= '<tr>';
			$aff .= '<td colspan="2"><b><u>Compte utilisateur</u></b></td>';
			$aff .= '</tr>';

			// #############

			$aff .= '<tr>';
			$aff .= '<td>Login</td>';
			$aff .= '<td><input type="text" name="Login" value="' . stripslashes ( $this->myIndividu->getLogin () ) . '" size="50" class="disabled" MAXLENGTH="50" readonly/></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Password</td>';
			$aff .= '<td><input type="text" name="Password" value="' . stripslashes ( $this->myIndividu->getPassword () ) . '" size="50" MAXLENGTH="50"/></td>';
			$aff .= '</tr>';
						
			$aff .= '<tr>';
			$aff .= '<td colspan="2">&nbsp;</td>';
			$aff .= '</tr>';
		}
		$aff .= '<tr>';
		$aff .= '	<td width="150">En Sommeil</td>';
		$aff .= '	<td>';
		$aff .= '		<input type="radio" name="EnSommeil" value="1"' . ($this->myIndividu->getEnSommeil () == 1 ? ' Checked' : '') . '/>OUI';
		$aff .= '		<input type="radio" name="EnSommeil" value="0"' . ($this->myIndividu->getEnSommeil () != 1 ? ' Checked' : '') . '/>NON';
		$aff .= '	</td>';
		$aff .= '</tr>';
		$aff .= '			<tr>';
		$aff .= '				<td width="150">Langues</td>';
		$aff .= '				<td><table boder=0><tr>';
		if (count ( $aLangueListe->getLangueListe () ) > 0) {
			foreach ( $aLangueListe->getLangueListe () as $aLangue ) {
				$aff .= '<td><label><input type="checkbox" name="lg_' . $aLangue->getID () . '" value="' . $aLangue->getID () . '"' . ($aLangueListe->Langue_exist ( $aLangue->getID () ) ? ' checked' : '') . '> ' . $aLangue->getCode () . ' - ' . $aLangue->getName () . '</label></td>';
			}
		} else {
			$aff .= '<td><label>Aucune langue de déclarée</label></td>';
		}
		$aff .= '				</tr></table></td>';
		$aff .= '			</tr>';

		$aff .= '<tr>';
		$aff .= '<td colspan="2"><b><u>Données RGPD</u></b></td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '<td>Mail Login*</td>';
		$aff .= '<td><input type="text" id="pLoginRgpd" name="LoginRgpd" value="' . stripslashes ( $this->myIndividu->getLoginRgpd () ) . '" size="50" MAXLENGTH="50" /></td>';
		$aff .= '</tr>';
		
		$aff .= '<tr>';
		$aff .= '<td>Password</td>';
		$aff .= '<td><input type="text" value="'.stripslashes ( $this->myIndividu->getPasswordRgpd () ) .'" size="50" class="disabled" MAXLENGTH="50" readonly/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Statut</td>';
		$aff .= '<td>';
		if ($mod == 'edit')
		{
			$aff .= '<select name="StatutRgpd">';
			$aff .= '<option value="9"' . (9 == ($this->myIndividu->getStatutRgpd () ) ? ' SELECTED=SELECTED' : '') . '>Non actif (9)</option>';
			$aff .= '<option value="0"' . (0 == ($this->myIndividu->getStatutRgpd () ) ? ' SELECTED=SELECTED' : '') . '>En attente(0)</option>';
			$aff .= '<option value="-1"' . (-1 == ($this->myIndividu->getStatutRgpd () ) ? ' SELECTED=SELECTED' : '') .'>En création(-1)</option>';
			$aff .= '<option value="2"' . (2 == ($this->myIndividu->getStatutRgpd () ) ? ' SELECTED=SELECTED' : '') . '>Actif(2)</option>';
			$aff .= '<option value="1"' . (1 == ($this->myIndividu->getStatutRgpd () ) ? ' SELECTED=SELECTED' : '') . '>Confirmation(1)</option>';
			$aff .= '</select>';
		}
		else 
		{
			$aff .= '<select name="StatutRgpd">';
			$aff .= '<option value="-1" SELECTED=SELECTED>En création</option>';
			$aff .= '</select>';
		}
		
		$aff .= '</td>';
		$aff .= '</tr>';
		
		
		// $aff .= '<tr>';
		// $aff .= ' <td width="150">Intêrets :</td>';
		// $aff .= ' <td><table boder=0><tr>';
		// $aff .= ' <td><label><input type="checkbox" name="clientInfo" value="1"' . ($this->myIndividu->getCliInfo () == 1 ? ' Checked' : '') . '/>Informatique</label></td>';
		// $aff .= ' <td><label><input type="checkbox" name="clientMercham" value="1"' . ($this->myIndividu->getCliMercham () == 1 ? ' Checked' : '') . '/>Merchandising</label></td>';
		// $aff .= ' <td><label><input type="checkbox" name="clientGarage" value="1"' . ($this->myIndividu->getCliGarage () == 1 ? ' Checked' : '') . '/>Mat. garage</label></td>';
		// $aff .= ' </td></tr></table>';
		// $aff .= '</tr>';

		$aff .= '</table>';

		$aff .= '<table width="800" id="TableList">';
		$aff .= '			<tr class="title">';
		$aff .= '				<td colspan="2"><b><u>Acces Site</u></b></td>';
		$aff .= '			</tr>';
		// $aff .= ' <tr>';
		// $aff .= ' <td width="150" class="row1">GCNF</td>';
		// $aff .= ' <td class="row1">';
		// $aff .= ' <input type="radio" name="ACCES_ACNF" value="1"'.($ACCES_ACNF?' Checked':'').'/>OUI';
		// $aff .= ' <input type="radio" name="ACCES_ACNF" value="0"'.($ACCES_ACNF?'':' Checked').'/>NON';
		// $aff .= ' </td>';
		// $aff .= ' </tr>';
		// ###
		$aff .= '			<tr>';
		$aff .= '				<td width="150" class="row2">CISCAR</td>';
		$aff .= '				<td class="row2">';
		$aff .= '					<input type="radio" name="ACCES_CISCAR" value="1"' . ($ACCES_CISCAR ? ' Checked' : '') . '/>OUI';
		$aff .= '					<input type="radio" name="ACCES_CISCAR" value="0"' . ($ACCES_CISCAR ? '' : ' Checked') . '/>NON';
		$aff .= '					&nbsp;<a href="http://ciscar.fr/?login=' . $this->myIndividu->getLogin () . '&pwd=' . base64_encode ( $this->myIndividu->getPassword () ) . '" target="_blank"><u>http://www.ciscar.fr</u></a>';
		$aff .= '					&nbsp;<a href="' . $this->mefUrl ( 'carterie', $this->myIndividu->getLogin () ) . '" target="_blank"><u>papeterie</u></a>';
		$aff .= '					&nbsp;<a href="' . $this->mefUrl ( 'geolane', $this->myIndividu->getLogin () ) . '" target="_blank"><u>Personnalisation</u></a>';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		// ###
		// $aff .= ' <tr' . ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] != '1' ? ' style="display:none;"' : '') . '>';
		$aff .= '			<tr style="display:none;">';
		$aff .= '				<td width="150" valign="top" class="row1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i>Affichage</i></td>';
		$aff .= '				<td class="row1">';
		$aff .= '					<input type="radio" name="PROFIL_RENAULT" value="0"' . ($PROFIL_RENAULT ? ' Checked' : '') . '/>Renault<br/>';
		$aff .= '					<input type="radio" name="PROFIL_RENAULT" value="1"' . ($PROFIL_HORS_RENAULT ? ' Checked' : '') . '/>Hors Renault<br/>';
		$aff .= '					<input type="radio" name="PROFIL_RENAULT" value="2"' . ($PROFIL_INDRA ? ' Checked' : '') . '/>INDRA';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		// ###
		$aff .= '			<tr>';
		$aff .= '				<td width="150" class="row2">GCR</td>';
		$aff .= '				<td class="row2">';
		$aff .= '					<input type="radio" name="ACCES_GCR" value="1"' . ($ACCES_GCR ? ' Checked' : '') . '/>OUI';
		$aff .= '					<input type="radio" name="ACCES_GCR" value="0"' . ($ACCES_GCR ? '' : ' Checked') . '/>NON';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		// ###
		$aff .= '			<tr>';
		$aff .= '				<td width="150" class="row1">GCR - Site Emploi</td>';
		$aff .= '				<td class="row1">';
		$aff .= '					<input type="radio" name="ACCES_SITE_EMPLOI" value="1"' . ($ACCES_SITE_EMPLOI ? ' Checked' : '') . '/>OUI';
		$aff .= '					<input type="radio" name="ACCES_SITE_EMPLOI" value="0"' . ($ACCES_SITE_EMPLOI ? '' : ' Checked') . '/>NON';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		// ###
		$aff .= '			<tr>';
		$aff .= '				<td width="150" class="row2">Autologin - CIS-COM</td>';
		$aff .= '				<td class="row2">';
		$aff .= '					<input type="radio" name="ACCES_CISCOM" value="1"' . ($ACCES_CISCOM ? ' Checked' : '') . '/>OUI';
		$aff .= '					<input type="radio" name="ACCES_CISCOM" value="0"' . ($ACCES_CISCOM ? '' : ' Checked') . '/>NON';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		// ###
		$aff .= '			<tr>';
		$aff .= '				<td width="150" class="row1">Autologin - Carterie</td>';
		$aff .= '				<td class="row1">';
		$aff .= '					<input type="radio" name="ACCES_CARTERIE" value="1"' . ($ACCES_CARTERIE ? ' Checked' : '') . '/>OUI';
		$aff .= '					<input type="radio" name="ACCES_CARTERIE" value="0"' . ($ACCES_CARTERIE ? '' : ' Checked') . '/>NON';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		// ###
		$aff .= '			<tr>';
		$aff .= '				<td width="150" class="row1">EXPORT CISCAR.NET</td>';
		$aff .= '				<td class="row1">';
		$aff .= '					<input type="radio" name="ACCES_CISCAR_BELGE" value="1"' . ($ACCES_CISCAR_BELGE ? ' Checked' : '') . '/>OUI';
		$aff .= '					<input type="radio" name="ACCES_CISCAR_BELGE" value="0"' . ($ACCES_CISCAR_BELGE ? '' : ' Checked') . '/>NON';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		// ###
		$aff .= '			<tr>';
		$aff .= '				<td width="150" class="row1">Autologin - STVA</td>';
		$aff .= '				<td class="row1">';
		$aff .= '					<input type="radio" name="ACCES_STVA" value="1"' . ($ACCES_STVA ? ' Checked' : '') . '/>OUI';
		$aff .= '					<input type="radio" name="ACCES_STVA" value="0"' . ($ACCES_STVA ? '' : ' Checked') . '/>NON';
		$aff .= '					&nbsp;<a href="http://' . $_SERVER ['HTTP_HOST'] . '/stva/?acces=true&login=' . $this->myIndividu->getLogin () . '&pwd=' . base64_encode ( $this->myIndividu->getPassword () );
		if ($this->myIndividu->getAnnuaire () != null)
			$aff .= '						&annuaire=' . $this->myIndividu->getAnnuaire ()->getID () . '" target="_blank"><u>acces stva</u></a>';
		else
			$aff .= '						&annuaire=" target="_blank"><u>acces stva</u></a>';
		$aff .= '					&nbsp;<a href="http://' . $_SERVER ['HTTP_HOST'] . '/stva/?login=' . $this->myIndividu->getLogin () . '&pwd=' . base64_encode ( $this->myIndividu->getPassword () );
		if ($this->myIndividu->getAnnuaire () != null)
			$aff .= '						&annuaire=' . $this->myIndividu->getAnnuaire ()->getID () . '" target="_blank"><u>stva box</u></a>';
		else
			$aff .= '						&annuaire=" target="_blank"><u>stva box</u></a>';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		$aff .= '</table>';
		return $aff;
	}
	private function RoleRenderHTML($mod) {
		$aff = '';

		if ($mod == 'new') {
			// etablissement
			$aEtablissement = new Etablissement ();
			$aEtablissement->select_etablissement ( $_GET ['id'] );

			$aff .= '<table width="800">';
			$aff .= '<tr>';
			$aff .= '<td colspan="2"><b><u>Informations Concession</u></b></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Raison Sociale</td>';
			$aff .= '<td><input type="text" value="' . stripslashes ( $aEtablissement->getRaisonSociale () ) . '" class="disabled" size="80" readonly/></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td>Ville</td>';
			$aff .= '<td><input type="text" value="' . stripslashes ( $aEtablissement->getVille () ) . '" class="disabled" size="80" readonly/></td>';
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
			$aff .= '</table>';
		} elseif ($mod == 'new_sans_role') {
			$aff .= '<b>Aucun Rôle ne sera créé pour ce mode de création  !!!</b><br/><br/>';
		} else {
			$aSimple_RoleList = new Simple_RoleList ();
			$aSimple_RoleList->SQL_SELECT_BY_INDIVIDU ( $this->myIndividu->getID () );

			if (count ( $aSimple_RoleList->getList () ) == 0) {
				$aff .= '<font style="color:black;background-color:red;font-size:14px;"><b>Pas de Rôle !!!</b></font><br/><br/>';
			} else {
				$aff .= '<table id="TableList">';
				$aff .= '<tr class="title"><td>Ref. client</td><td>Raison Sociale</td><td>Code postal</td><td>Ville</td><td>Domaine Activité</td><td>Fonction</td><td width="50">Action</td></tr>';

				foreach ( $aSimple_RoleList->getList () as $aRow ) {
					// $aff .= '<tr><td>'.$aRow[1].'</td><td width="50" align="center"><a href="../role/?action=edit&id='.$aRow[0].'"><img src="../../include/images/voir.jpg" border="0" width="16"/></a></td></tr>';
					$aff .= '<tr><td align="center">' . $aRow [8] . '</td><td align="center">' . ($this->myIndividu->getLieuTravail ()->getID () == $aRow [2] ? '<u>' . $aRow [1] . '</u>' : $aRow [1]) . '</td><td align="center">' . $aRow [6] . '</td></td><td align="center">' . $aRow [7] . '</td><td align="center">' . $aRow [3] . '</td><td align="center">' . $aRow [4] . '</td><td width="50" align="center"><a href="../role/?action=edit&id=' . $aRow [0] . '"><img src="../../include/images/voir.jpg" border="0" width="16"/></a></td></tr>';
				}
				$aff .= '</table>';
			}
		}
		return $aff;
	}
}
?>