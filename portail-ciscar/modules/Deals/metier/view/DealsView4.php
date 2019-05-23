<?php
/**
 * @author Philippe GERMAIN
 * @package portail-ciscar
 * @subpackage commun
 * @version 1.0.4
 */
class DealsView4 {
	public function __construct() {
	}
	public function renderHTML($msg = Null, $urlReturn = Null) {
		$mail = '';
		$msgref = 'Vous n\'êtes pas référencé chez CISCAR, renseignez vos données personnelles.';
		$identification = true;
		$DealsID = 0;
		$individuID = 0;
		$Dealyearjs = 0;
		$Dealmonthjs = 0;
		$Dealdayjs = 0;
		$login = '';
		$identifiant = '';
		
		$qteCmd = '';
		
		if ($msg != null) {
			if ($msg == 'ko') {
				$msg = 'Erreur d\'identification...';
				$identification = false;
			} else {
				if ($msg == 'ko1') {
					$msg = 'Adresse email déjà enregistrée,<br>veuillez renseigner vos identifiants.';
					$identification = false;
				} else {
					$msg = '';
					$msgref = '';
				}
			}
		}
		
		$aParam = new Param ();
		$aParam->search_param ( 'CISCAR_PUB_HOMEPAGE_IMAGE' );
		$aParam2 = new Param ();
		$aParam2->search_param ( 'CISCAR_PUB_HOMEPAGE_URL' );
		
		if (isset ( $_GET ['action'] ) && $_GET ['action'] == 'cmd')
			$cmd = true;
		else
			$cmd = false;
			
			// Si bouton commander
		if (isset ( $_GET ['action'] )) {
			if ($_GET ['action'] == 'cmd') {
				// on récupère l'identifiant de l'individu connecté
				$individuID = $_POST ['hidIndividuID'];
				
				// si l'individu est inconnu on recupère les infos de facturation
				if ($individuID == 0) {
					$nomFac = $_POST ['nomFac'];
					$prenomFac = $_POST ['prenomFac'];
					$telFac = $_POST ['telFac'];
					$mailFac = $_POST ['hidMailFac'];
					$raisonSocialeFac = $_POST ['raisonsocialeFac'];
					$adresse1Fac = $_POST ['adresse1Fac'];
					$adresse2Fac = $_POST ['adresse2Fac'];
					$codepostalFac = $_POST ['codepostalFac'];
					$villeFac = $_POST ['villeFac'];
				} else {
					$nomFac = '';
					$prenomFac = '';
					$telFac = '';
					$mailFac = $_POST ['hidMailFac'];
					$raisonSocialeFac = '';
					$adresse1Fac = '';
					$adresse2Fac = '';
					$codepostalFac = '';
					$villeFac = '';
				}
				
				// identifiant du deal
				$DealsID = $_POST ['hidDealsID'];
				
				// on récupère les données de livraison
				$raisonSocialeLiv = $_POST ['raisonsocialeLiv'];
				$destinataireLiv = $_POST ['destinataireLiv'];
				$adresse1Liv = $_POST ['adresse1Liv'];
				$adresse2Liv = $_POST ['adresse2Liv'];
				$codepostalLiv = $_POST ['codepostalLiv'];
				$villeLiv = $_POST ['villeLiv'];
				$remarque = $_POST ['remarque'];
				
				// on recupère la quantité commandée
				$nbParam = $_POST ['hidNbParam'] + 1;
				$qte = 0;
				for($i = 1; $i < $nbParam; $i ++) {
					$qte += $_POST ['qtecmd' . $i];
				}
				
				// on enregistre les données saisie sur le formulaire
				$adeals = new Deals ();
				$adeals->setNom ( $nomFac );
				$adeals->setPrenom ( $prenomFac );
				$adeals->setTel ( $telFac );
				$adeals->setMail ( $mailFac );
				$adeals->setRaisonSociale_liv ( $raisonSocialeLiv );
				$adeals->setDestinataire_liv ( $destinataireLiv );
				$adeals->setAdresse1_liv ( $adresse1Liv );
				$adeals->setAdresse2_liv ( $adresse2Liv );
				$adeals->setCodePostal_liv ( $codepostalLiv );
				$adeals->setVille_liv ( $villeLiv );
				$adeals->setRemarque ( $remarque );
				$adeals->setRaisonSociale_fac ( $raisonSocialeFac );
				$adeals->setAdresse1_fac ( $adresse1Fac );
				$adeals->setAdresse2_fac ( $adresse2Fac );
				$adeals->setCodePostal_fac ( $codepostalFac );
				$adeals->setVille_fac ( $villeFac );
				$adeals->setQuantiteCmdIndividu ( $qte );
				
				// Pour eviter d'enregistrer deux fois la commande quand on actualise la page
				if ($_SESSION ['cmd'] == 0) {
					if ($individuID > 0)
						$adeals->SQL_create_Deals ( $DealsID, $individuID, '' );
					else
						$adeals->SQL_create_Deals ( $DealsID, 0, $mailFac );
						
						// on enregistre le détail des quantités commandées
					for($i = 1; $i < $nbParam; $i ++) {
						$qte = $_POST ['qtecmd' . $i];
						$adeals->SQL_create_Deals_Commandes_Param ( $adeals->getDealCmdID (), $i, $qte );
					}
					// empêche l'actiulisation de la page sur action=cmd
					$_SESSION ['cmd'] = 1;
					
					// on envoi un mail de confirmation de commande
					$aDealsController = new DealsController ();
					$aDealsController->MailDealCmd ( $adeals->getDealCmdID () );
					if ($individuID == 0)
						$mail = $adeals->getMail ();
				}
			} else {
				$_SESSION ['cmd'] = 0;
			}
			
			// if($_GET['action'] == 'connexion')
			// {
			if (isset ( $_GET ['deal'] ))
				$DealsID = $_GET ['deal'];
				// }
			if ($_GET ['action'] == 'mailconnexion') {
				// if(isset($_GET['deal'])) $DealsID = $_GET['deal'];
				if (isset ( $_POST ['mailcnx'] ) && $identification)
					$mail = $_POST ['mailcnx'];
			}
		} else {
			if (isset ( $_GET ['deal'] ))
				$DealsID = $_GET ['deal'];
			$_SESSION ['cmd'] = 0;
		}
		
		if ($DealsID > 0) {
			$adeals = new Deals ();
			// Informations générales sur le deal passé en paramètre
			$adeals->SQL_selectDeal ( $DealsID );
			if ($adeals->getDealsID () == null)
				$DealsID = 0;
			// on vérifie si c'est un ancien Deal
			// $adeals->SQL_selectMaxDeal();
			// if ($DealsID < $adeals->getDealsMaxID()) $DealsID = 0;
		}
		
		if ($DealsID > 0) {
			// on décompose la date de début du deal
			list ( $Dealdate, $Dealtime ) = explode ( " ", $adeals->getDateDebut () );
			list ( $Dealyear, $Dealmonth, $Dealday ) = explode ( "-", $Dealdate );
			$DealDateDebut = $Dealday . '-' . $Dealmonth . '-' . $Dealyear;
			$DateDebut = $Dealyear . $Dealmonth . $Dealday;
			
			// On vérifie si le Deal a démarré
			$datenow = date ( "Y" ) . date ( "m" ) . date ( "d" );
			if ($datenow >= $DateDebut)
				$debutDeal = true;
			else
				$debutDeal = false;
				
				// Date du compte à Rebours
			if (! $debutDeal) {
				// pour la compatibilité du compte à rebours on fait -1 sur le mois
				$Dealyearjs = $Dealyear;
				$Dealmonthjs = $Dealmonth - 1;
				$Dealdayjs = $Dealday;
			}
			
			// on décompose la date de fin du deal
			list ( $Dealdate, $Dealtime ) = explode ( " ", $adeals->getDateFin () );
			list ( $Dealyear, $Dealmonth, $Dealday ) = explode ( "-", $Dealdate );
			$DealDateFin = $Dealday . '-' . $Dealmonth . '-' . $Dealyear;
			$DateFin = $Dealyear . $Dealmonth . $Dealday;
			
			// On vérifie si le Deal est terminé
			$datenow = date ( "Y" ) . date ( "m" ) . date ( "d" );
			if ($datenow >= $DateFin)
				$finDeal = true;
			else
				$finDeal = false;
				
				// Date du compte à Rebours
			if ($debutDeal) {
				// pour la compatibilité du compte à rebours on fait -1 sur le mois
				$Dealyearjs = $Dealyear;
				$Dealmonthjs = $Dealmonth - 1;
				$Dealdayjs = $Dealday;
			}
			
			// calcul de la quantité restant à commander
			$QuantiteRestant = $adeals->getQuantiteMin () - $adeals->getQuantiteCmd ();
			if ($adeals->getQuantiteCmd () >= $adeals->getQuantiteMin ())
				$QuantiteRestant = 0;
			$actif = '';
			
			if ($QuantiteRestant == 0)
				$etatDeal = '<h1>DEAL ATTEINT...</h1>';
			else
				$etatDeal = '<h1>DEAL en cours...</h1>';
			
			$suite = 'avant la fin du Deal';
			
			if ($finDeal) {
				$etatDeal = '<h1>DEAL TERMINE...</h1>';
				$actif = 'disabled';
				$suite = '&nbsp;';
			}
			
			if (! $debutDeal) {
				$etatDeal = '<h1>DEAL EN ATTENTE...</h1>';
				$actif = 'disabled';
				$suite = 'avant de début du Deal';
			}
			
			// Recherche des paramètres du deal
			$params = $adeals->SQL_selectParamDeal ( $DealsID );
			
			// Informations sur l'individu passé en paramètre ou dans le formulaire de commande ou dans le formulaire de connexion
			$individuID = 0;
			$index = 0;
			$aSessionSecurite = new SessionSecurite ();
			if (isset ( $_GET ['login'] ) && isset ( $_GET ['pwd'] )) {
				$aUserName = $_GET ['login'];
				$aPassword = base64_decode ( $_GET ['pwd'] );
				
				$aresult = $aSessionSecurite->SQL_checkUser ( $aUserName, $aPassword );
				$individuID = $aSessionSecurite->getUserID ();
				if ($aresult == 0) {
					$aSessionSecurite->SQL_recupInfosUser ( $individuID );
					$aSessionSecurite->SQL_recupRoleUser ( $individuID );
				}
			} else {
				if (isset ( $_POST ['hidIndividuID'] ) && $_POST ['hidIndividuID'] != 0) {
					$individuID = $_POST ['hidIndividuID'];
					$aSessionSecurite->SQL_recupInfosUser ( $individuID );
					$aSessionSecurite->SQL_recupRoleUser ( $individuID );
				} else {
					if (isset ( $_GET ['action'] ) && $_GET ['action'] == 'connexion') {
						if (isset ( $_GET ['individuID'] )) {
							$individuID = $_GET ['individuID'];
							$aSessionSecurite->SQL_recupInfosUser ( $individuID );
							$aSessionSecurite->SQL_recupRoleUser ( $individuID );
						} else {
							if (isset ( $_POST ['logincnx'] ) && isset ( $_POST ['pwdcnx'] )) {
								$aUserName = $_POST ['logincnx'];
								$aPassword = $_POST ['pwdcnx'];
								
								$aresult = $aSessionSecurite->SQL_checkUser ( $aUserName, $aPassword );
								$individuID = $aSessionSecurite->getUserID ();
								if ($aresult == 0) {
									$aSessionSecurite->SQL_recupInfosUser ( $individuID );
									$aSessionSecurite->SQL_recupRoleUser ( $individuID );
								}
							}
						}
					}
				}
			}
			
			// Récupération des informations de l'individu
			if ($individuID > 0 || $mail != '') {
				if ($individuID > 0)
					$adeals->SQL_select_DealIndividu ( $DealsID, $individuID, '' );
				else
					$adeals->SQL_select_DealIndividu ( $DealsID, 0, $mail );
				
				if ($adeals->getDealCmdID () != NULL) {
					if ($mail != '') {
						$Nom_fac = $adeals->getNom ();
						$Prenom_fac = $adeals->getPrenom ();
						$Tel_fac = $adeals->getTel ();
						$Mail_fac = $adeals->getMail ();
						$RaisonSociale_fac = $adeals->getRaisonSociale_fac ();
						$Adresse1_fac = $adeals->getAdresse1_fac ();
						$Adresse2_fac = $adeals->getAdresse2_fac ();
						$CodePostal_fac = $adeals->getCodePostal_fac ();
						$Ville_fac = $adeals->getVille_fac ();
						$identifiant = 'xxxxxx';
						$login = 'xxxxxx';
						$loginCli = '';
						$newLogin = '';
						$newMail = 'Changer de mail ?';
						$msgref = '';
					} else {
						$identifiant = $individuID;
						$login = $aSessionSecurite->getLoginUser ();
						$loginCli = $aSessionSecurite->getLoginCli ();
						$newLogin = 'Changer d\'utilisateur ?';
						$newMail = '';
						$msgref = '';
					}
					$RaisonSociale_liv = $adeals->getRaisonSociale_liv ();
					$Destinataire_liv = $adeals->getDestinataire_liv ();
					$Adresse1_liv = $adeals->getAdresse1_liv ();
					$Adresse2_liv = $adeals->getAdresse2_liv ();
					$CodePostal_liv = $adeals->getCodePostal_liv ();
					$Ville_liv = $adeals->getVille_liv ();
				} else {
					if ($mail != '') {
						$Nom_fac = '';
						$Prenom_fac = '';
						$Tel_fac = '';
						$Mail_fac = $mail;
						$RaisonSociale_fac = '';
						$Adresse1_fac = '';
						$Adresse2_fac = '';
						$CodePostal_fac = '';
						$Ville_fac = '';
						$RaisonSociale_liv = '';
						$Destinataire_liv = '';
						$Adresse1_liv = '';
						$Adresse2_liv = '';
						$CodePostal_liv = '';
						$Ville_liv = '';
						$identifiant = 'xxxxxx';
						$login = 'xxxxxx';
						$loginCli = '';
						$actif = '';
						$newLogin = '';
						$newMail = 'Changer de mail ?';
					} else {
						$RaisonSociale_liv = $aSessionSecurite->getRaisonSocialUser ();
						$Destinataire_liv = '';
						$Adresse1_liv = $aSessionSecurite->getAdresse1User ();
						$Adresse2_liv = $aSessionSecurite->getAdresse2User ();
						$CodePostal_liv = $aSessionSecurite->getCodePostalUser ();
						$Ville_liv = $aSessionSecurite->getVilleUser ();
						$identifiant = $aSessionSecurite->getUserID ();
						$login = $aSessionSecurite->getLoginUser ();
						$loginCli = $aSessionSecurite->getLoginCli ();
						$newLogin = 'Changer d\'utilisateur ?';
						$newMail = '';
					}
				}
			} else			// SI l'individu n'est pas connu
			{
				$Nom_fac = '';
				$Prenom_fac = '';
				$Tel_fac = '';
				$Mail_fac = '';
				$RaisonSociale_fac = '';
				$Adresse1_fac = '';
				$Adresse2_fac = '';
				$CodePostal_fac = '';
				$Ville_fac = '';
				$RaisonSociale_liv = '';
				$Destinataire_liv = '';
				$Adresse1_liv = '';
				$Adresse2_liv = '';
				$CodePostal_liv = '';
				$Ville_liv = '';
				$identifiant = 'xxxxxx';
				$login = 'xxxxxx';
				$loginCli = '';
				$actif = 'disabled';
				$msgref = '';
				$newLogin = 'Déjà client ?';
				$newMail = 'Nouveau client ?';
			}
		}
		// FIN DEALSID Renseigné
		
		// Page HTML
		$aff = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Login_ciscar.dwt" codeOutsideHTMLIsLocked="false" -->
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<META NAME="robots" CONTENT="noindex,nofollow">
				<meta name="description" content="Accédez aux Deals CISCAR et découvrez tous les produits et services adaptés aux métiers de l’automobile : informatique, matériel de garage, Merchandising & Aménagement, papeterie et mailing."/>
				<!-- InstanceBeginEditable name="doctitle" -->
				<title>DEAL CISCAR !</title>';
		
		$aff .= '<!-- Add jQuery library -->
				<script type="text/javascript" src="../../include/js/jquery-latest.min.js"></script>
		
				<!-- Add mousewheel plugin (this is optional) -->
				<script type="text/javascript" src="../../include/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

				<!-- Add fancyBox -->
				<link rel="stylesheet" href="../../include/js/fancybox/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
				<script type="text/javascript" src="../../include/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.4"></script>

				<!-- Optionally add helpers - button, thumbnail and/or media -->
				<link rel="stylesheet" href="../../include/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
				<script type="text/javascript" src="../../include/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
				<script type="text/javascript" src="../../include/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>

				<link rel="stylesheet" href="../../include/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
				<script type="text/javascript" src="../../include/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

				<script type="text/javascript" src="../../include/js/jquery.countdown.js"></script>

				<script type="text/javascript" src="../../include/js/deals.js"></script>
				

				<!-- Calcul de la commande -->
				<script type="text/javascript">
				function round(value, decimals) 
				{
    				return Number(Math.round(value+\'e\'+decimals)+\'e-\'+decimals);
				}
				function somme(PrixPromo)
				{
				
					// Mozilla Chrome
		     		if (document.getElementsByClassName)
		     			elems = document.getElementsByClassName(\'input_deal_short\');
		     		else
			 		//I.E
			    	elems = document.querySelectorAll(\'input_deal_short\');
								     	
		     		len = elems.length;
					var x = 0;
					x = parseInt(x);
					for (var i = 0;  i < len; i++)
		     		{
		            	var input = elems[i].value;
						var ind = \'mtcmdunit\';
						if (input!=\'\')
						{
							input = parseInt(input);
							z = i+1;
							ind = ind + z;
							document.getElementById(ind).innerHTML = \'<b>\' + round(input * PrixPromo,2) + \' €</b>\';
							x = x + input;
						}
						else
						{
							z = i+1;
							ind = ind + z;
							document.getElementById(ind).innerHTML = \'\';
						}
					}		     
				
					//x=document.getElementById(\'qtecmd\').value;
				
					if (x==0)
					{
						y = 0;
					}
					else
					{
						x = parseInt(x);
						y = x * PrixPromo;
						y = round(y,2);
					}
					document.getElementById(\'mtcmd\').innerHTML = \'<b>\' + y + \' €</b>\';
				} 
							
				$(function(){
								// login new => observe link with id "login_new_link"
								$("#login_new_link").fancybox({
											   overlayOpacity:0.8,
											   overlayColor:\'#000000\'
								});
				
				});

				$(function(){
								// mail new => observe link with id "mail_new_link"
								$("#mail_new_link").fancybox({
											   overlayOpacity:0.8,
											   overlayColor:\'#000000\'
								});
				
				});
				
				</script>

				<!-- Compte à rebours -->
				<script type="text/javascript">
				$(function()
				{
						        $(".digits").countdown({
						          image: "../../include/images/digits.png",
								  format: "dd:hh:mm:ss",
								  endTime: new Date(' . $Dealyearjs . ',' . $Dealmonthjs . ',' . $Dealdayjs . ')
								});
								$(".cntDigit").each(function(i,v){$(v).css(\'background-size\',\'27px\')})
				});

				</script>

				<script type="text/javascript">
				$(function(){
								// login lost => observe link with id "login_lost_link"
								$("#login_lost_link").fancybox({
											   overlayOpacity:0.8,
											   overlayColor:\'#000000\'
								});
				});

				</script>

			<script language="javascript">
			function logo_link(DealsId,action){
				var link = \'\';
				link = \'?action=\' + action + \'&deal=\' + DealsId ;
				document.forms[\'FormDeals\'].action = link;
				document.forms[\'FormDeals\'].submit();
			}
			</script>
				
				<!-- InstanceEndEditable -->
				<link rel="stylesheet" type="text/css" href="../../include/css/styles.css" media="screen" />
				<meta name="description" content="CISCAR, Centrale d\'Achats des réseaux automobiles." />
				<meta name="robots" content="index, follow" />
				<link rel="icon" href="../favicon.ico" />
				<!-- InstanceBeginEditable name="head" -->
				<!-- InstanceEndEditable -->
				</head>';
		
		$aff .= '<body style="background-color:#eeeeee;background-image: url(../../include/images/bg_top_bandeau.jpg); background-repeat: repeat-x; color:#383838;">';
		$aff .= '<form method="POST" id="FormDeals" name="FormDeals" action="?action=cmd">';
		$aff .= '<input type="hidden" name="hidIndividuID" id="hidIndividuID" value=' . $individuID . '>';
		$aff .= '<input type="hidden" name="hidDealsID" id="hidDealsID" value=' . $DealsID . '>';
		
		$aff .= '
				<div style="margin-left: auto; margin-right: auto;margin-top: 0px;	padding-bottom: 0px; width:680px;">
				<p style="color: #FFFFFF; font-family:Arial, Helvetica, sans-serif; font-size:13px;">CISCAR, Centrale d’Achats des Réseaux Automobiles</p>
				
				<div style="width: 680px; margin-left: auto; margin-right: auto; border:1px solid #e1e1e1; background-color:#faf9f9;">';
		$link = '';
		if ($individuID > 0) {
			$link .= '
	        		<a href="javascript: logo_link(\'' . $DealsID . '\',\'connexion\')">
	        		<div style="position: absolute;width: 680px; height:231px; margin-left: auto; margin-right: auto; border:1px solid #e1e1e1;">
					</div></a>';
		} else {
			if ($mail != '')
				$link .= '
	        		<a href="javascript: logo_link(\'' . $DealsID . '\',\'mailconnexion\')">
					<div style="position: absolute;width: 680px; height:231px; margin-left: auto; margin-right: auto; border:1px solid #e1e1e1;">
					</div></a>';
			else
				$link .= '
	        		<a href="javascript: logo_link(\'' . $DealsID . '\',\'\')">
					<div style="position: absolute;width: 680px; height:231px; margin-left: auto; margin-right: auto; border:1px solid #e1e1e1;">
					</div></a>';
		}
		
		$aff .= '
				<div style="background-image:url(../../include/images/deal2/img/bg_deal_ciscar.jpg); width:680px; height:231px;">' . $link;
		if ($DealsID > 0)
			$aff .= '
                <div style=" padding-left:330px; padding-top:70px; width:270px;">
				<p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; line-height:20px; text-align:center;">
				Il vous reste</p>
				<div style="padding-left:26px;" class="digits"></div>
				<div style="float: left;padding-left:56px;width:27px;text-align:left;font-size:10px">jours</div>
				<div style="float: left;padding-left:27px;width:32px;text-align:left;;font-size:10px">heures</div>
				<div style="float: left;padding-left:19px;width:38px;text-align:left;;font-size:10px">minutes</div>
				<div style="float: left;padding-left:14px;width:44px;text-align:left;;font-size:10px">secondes</div>
				<p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; line-height:30px; text-align:center;">
				pour en profiter</p>';
		else
			$aff .= '
                <div style=" padding-left:330px; padding-top:120px; width:270px;">
				<p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; line-height:20px; text-align:center;">
				A bientôt !</p>';
		
		$aff .= '
                </div>
				</div>';
		
		$aff .= '
				<div class="clearboth"></div>
				<table cellpadding="10" width="100%" >
				<tr>';
		if ($DealsID > 0)
			if ($cmd) {
				$aff .= '
		                <td bgcolor="#eeeeee" colspan="2"><p style="font-family:Arial, Helvetica, sans-serif; font-size:52px; font-weight:bold; color:#CCC; text-align:center; margin:0px;">MERCI</p>
                        </td>';
			} else {
				if ($QuantiteRestant == 0)
					$aff .= '
			                <td bgcolor="#eeeeee" width="50%">
			                    <p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; color:#999; text-align:center; margin:0px;">VOLUME ATTEINT !</p>
			                </td>';
				else
					$aff .= '
			                <td bgcolor="#eeeeee" width="50%">
			                    <p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; color:#999; text-align:center; margin:0px;">Groupez-vous !</p>
			                </td>';
				$aff .= '
	                <td align="center" bgcolor="#eeeeee"><p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; margin:0px;">&gt;<a href="#about"> Découvrez le fonctionnement du deal</a> &lt;</p>
	                </td>';
			}
		else
			$aff .= '
					<td bgcolor="#eeeeee" colspan="2"><p style="font-family:Arial, Helvetica, sans-serif; font-size:32px; font-weight:bold; color:#999; text-align:center; margin:0px;">
					Professionnels de l\'automobile, <br/>
                    Groupez-vous pour bénéficier d\'avantages avec  CISCAR !</p>
			         </td>';
		$aff .= '</tr>';
		
		if ($DealsID > 0 && ! $cmd) {
			$aff .= '
				<tr><td colspan=2>
 				<p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; text-align:center; color:#383838;">A partir de  <span style="font-size:30px;color:#0157a7;">21</span> commandes*, b&eacute;n&eacute;ficiez du tarif le plus bas !</p>
  				<table style="border:#CCCCCC 1px solid;" cellspacing="5" cellpadding="0" align="center" border="0" width="600">
                <tbody>
 				<tr>
                                                <td align="left" bgcolor="#eeeeee" style="padding-left:10px;" rowspan="2">
                                                <p style="text-align: left;font-family: Helvetica,sans-serif;color: #303030; font-size: 15px;"><strong>Démonte pneu auto 10-24\'\'<br /><br />
                                                </strong><span style="text-align: left;font-family: Helvetica,sans-serif;color: #303030; font-size: 12px;">+ Bras d\'assistance<br />
                                                +  1 trolley Serge Blanco</span></p>
                                                </td>
					                            <td bgcolor="#eeeeee">
                                                <p style="text-align: center;font-family: Helvetica,sans-serif;color: #303030; font-size: 12px;">Prix unitaire<br />
                                                &agrave; partir de<strong><br />
                                                7 machines</strong></p>
                                                </td>
                                                <td bgcolor="#eeeeee">
                                                <p style="text-align: center;font-family: Helvetica,sans-serif;color: #303030; font-size: 12px;">Prix unitaire<br />
                                                &agrave; partir de<strong><br />
                                                14 machines </strong></p>
                                                </td>
                                                <td bgcolor="#eeeeee">
                                                <p style="text-align: center;font-family: Helvetica,sans-serif;color: #303030; font-size: 12px;">Prix unitaire<br />
                                                &agrave; partir de<br />
                                                <strong>21 machines et +</strong></p>
                                                </td>
                                            </tr>
                                            <tr>
                                              <td>
                                                <p style="text-align:center;font-family: Helvetica,sans-serif;color: #303030; font-size: 12px;">2 573,60 &euro;</p>
                                                </td>
                                                <td>
                                                <p style="text-align:center;font-family: Helvetica,sans-serif;color: #303030; font-size: 12px;">2 266,30 &euro;</p>
                                                </td>
                                                <td>
                                                <p style="text-align:center;font-family: Helvetica,sans-serif;color:#0157a7; font-size: 12px;"> <strong>1 922,00 €</strong></p>
                                                </td>
                                            </tr>
 	
                </tbody>
                </table>
				</td></tr>
				<td style="border-right:1px solid #eeeeee;" valign="top" >';
			if (! $finDeal) {
				if ($QuantiteRestant == 0)
					$aff .= '
                      	<p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:40px; text-align:center;margin-top:px;">Vous pouvez <span style="font-size:30px;color:#e88320;">ENCORE</span> profiter du<br/>
                        <span style="font-size:30px;color:#b6222e;">Démonte pneu</span><br/>';
				else {
					$tabQteRest = array_map ( 'intval', str_split ( $QuantiteRestant ) );
					$nbQteRest = count ( $tabQteRest );
					$aff .= '
						<table padding="1px" spacing="1px" width="100%">
							<tr>
								<td align="right">
								<p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:35px; text-align:right;margin-bottom:0px;">
								Plus que </p>
								</td>';
					
					if ($nbQteRest == 1)
						$aff .= '
									<td>
									<p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:35px; text-align:center;margin-bottom:0px;margin-right:-6px;">
									<img src="../../include/images/deal2/img/0.jpg">
									</p>
									</td>';
					
					for($i = 0; $i < $nbQteRest; $i ++) {
						$aff .= '
				 					<td>
				 					<p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:35px; text-align:center;margin-bottom:0px;margin-right:-6px;">
				 					<img src="../../include/images/deal2/img/' . $tabQteRest [$i] . '.jpg">
				 					</p>
				 					</td>';
					}
					$aff .= '
								<td align="left">
								<p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:35px; text-align:left;margin-bottom:0px;margin-left:4px;">
								machines,</p>
								</td>
							</tr>
						</table>';
					
					$aff .= '
					<p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:40px; text-align:center; margin-top:0px;">
					pour bénéficier du<br> <span style="font-size:30px;color:#b6222e;">Démonte pneu</span><br>';
				}
				// $aff .='
				// <p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:40px; text-align:center;">
				// Plus que <span style="font-size:30px;color:#e88320;">'.$QuantiteRestant.'</span> commandes,<br>
				// pour bénéficier du <br> <span style="font-size:30px;color:#e88320;">Lumia 650</span><br>';
			} else {
				$aff .= '
                      	<p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:40px; text-align:center;"> Le Deal est<span style="font-size:30px;color:#e88320;"> TERMIN&Eacute; ! </span><br/>
                        Vous ne pouvez plus commander <br><span style="font-size:30px;color:#b6222e;">le Démonte pneu</span><br/>';
			}
			$aff .= '
                        au prix de<br>
  						<span style="color:#b6222e; font-size:30px;">' . number_format ( $adeals->getPrixPromo (), 2, ',', ' ' ) . ' €<sup>ht</sup></span><br>                        
  						<span style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; text-align:center;">Frais de port OFFERTS !</span></p>';
			
			if (! $finDeal)
				$aff .= '<div style="margin-left:60px;">
    					<a href="#commander" style="text-align:center;color: #47ad76; display: inline-block; background-color:#b6222e;text-decoration: none;padding: 15px 40px;border: 2px solid #F00;-moz-border-radius: 2px;-webkit-border-radius: 2px;border-radius: 2px;margin: 0 20px 10px 0;color: #ffffff;font-family: Helvetica, Arial, sans-serif; font-weight:bold;font-size: 16px;">
						<span>COMMANDER !</span>
						</a></div>';
			
			$aff .= '
                        <p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:left; margin-top:15px;">
						<strong>MONTE-DEMONTE PNEUS AUTOMATIQUE 10"- 24"- 1 VITESSE.</strong><br>GARANTIE 2 ans - 400 V - 1 100 W</br>
            			</br>Démonte pneus automatique spécialement adapté pour le montage et démontage sans effort de tous les pneus VL, utilitaires et 4x4.
						</p>
						<ul style="font-family:Arial, Helvetica, sans-serif; font-size:13px; list-style-type:none;">';
			// <li style="background: url(\'../../include/images/deal2/img/double-sim.jpg\') no-repeat;background-position: 0 9px; line-height: 34px; text-indent: px; "> <span>Double SIM**</span></li>
			// <li style="background: url(\'../../include/images/deal2/img/ecran.png\') no-repeat;background-position: 0 9px; line-height: 34px; text-indent: px; "> <span>Ecran 5" HD - OLED 1280 x 720.</span></li>
			// <li style="background: url(\'../../include/images/deal2/img/sd.png\') no-repeat;background-position: 0 8px; line-height: 28px; text-indent: px;"> Mémoire 16 Go. </li>
			// <li style="background-position: 0 10px; line-height: 2px; text-indent: px;">jusqu\'à 200Go de stockage sur Micro SD. </li>
			// <li style="background: url(\'../../include/images/deal2/img/photo.png\') no-repeat;background-position: 0 16px; line-height: 52px; text-indent: px;"> Appareil photo 8 mégapixels - Flash LED. </li>
			// <li style="line-height: 34px;"><a href="https://www.youtube.com/embed/1I7tJ1PZ8KE?autoplay=1&amp;showinfo=0" target="_blank">&gt; <strong>cliquez ici</strong> pour découvrir le produit en vidéo</a></li>
			$aff .= '
            			<li style="background-position: 0 9px; line-height: 16px; text-indent: -40px; "> <span><strong>+ BRAS D\'ASSISTANCE</strong></span></li>
  						<li style="background-position: 0 8px; line-height: 16px; text-indent: -28px; padding-top:5px;"> <span>Dispositif pousse et lève talon pneumatique avec</span></li>
            			<li style="background-position: 0 8px; line-height: 16px; text-indent: -28px; "> <span>bras pousse-talon articulé.</span></li>
  						<li style="background-position: 0 8px; line-height: 16px; text-indent: -28px; padding-top:5px;"> <span>Réglage du bras rotatif pour s\'adapter au mieux à</span></li>
  						<li style="background-position: 0 8px; line-height: 16px; text-indent: -28px; "> <span>à chaque type de jantes et de pneumatiques.</span></li>
            			<li style="background-position: 0 8px; line-height: 16px; text-indent: -40px; padding-top:10px;"> <span style="color:#b6222e;"><strong>+ EN CADEAU</strong></span><span>&nbsp;1 trolley Serge Blanco !</span></li>';
			$aff .= '
            			</ul>';
			$aff .= '<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify; margin-top:15px;">&gt; <a href="http://www.ciscar.fr/ftp/17/deal4/pdf/20170313_CISCAR_demonte-pneu.pdf" target="_blank">En savoir plus sur les caractéristiques</a><br>            			
 						</p>            			
 						</td>';
			if ($QuantiteRestant == 0)
				$aff .= '
					<td valign="top">
	                    <p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:40px; text-align:center;">Merci aux <span style="font-size:30px;color:#0157a7;">' . $adeals->getQuantiteCmd () . '</span> acheteurs...<br/>
	            		<img src="../../ftp/17/deal4/img/demonte-pneu.jpg" height="520">
                    </td>
				</tr>';
			else {
				$aff .= '
					<td valign="top">
	                    <p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:40px; text-align:center;">';
				if (! $finDeal)
					$aff .= 'Déjà&nbsp;';
				$aff .= '<span style="font-size:30px;color:#0157a7;">' . $adeals->getQuantiteCmd () . '</span> acheteurs...<br/>
	            		<img src="../../ftp/17/deal4/img/demonte-pneu.jpg" height="520">
                    </td>
				</tr>';
			}
			
			// if (!$finDeal)
			// $aff .='
			// <tr>
			// <td colspan="2" align="center" >
			// <a href="#commander" style="color: #47ad76; display: inline-block; background-color:#b6222e;text-decoration: none;padding: 15px 40px;border: 2px solid #F00;-moz-border-radius: 2px;-webkit-border-radius: 2px;border-radius: 2px;margin: 0 20px 10px 0;color: #ffffff;font-family: Helvetica, Arial, sans-serif; font-weight:bold;font-size: 16px;">
			// <span>COMMANDER !</span>
			// </a>
			// </td>
			// </tr>';
		}
		
		if ($DealsID > 0 && ! $finDeal && ! $cmd) {
			$aff .= '<tr>
			<td bgcolor="#192d62" colspan="2" id="commander">
			<p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:22px; font-weight:bold; text-align:center;">';
			if ($individuID == 0 && $mail == '')
				$aff .= 'Identifiez-vous :</p>';
			else
				$aff .= 'Complétez votre commande :</p>';
			$aff .= '
			<table width="100%" cellpadding="5" cellspacing="1" border="0">
			<tr>
			<td bgcolor="#000033" width="50%">
			<p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;"><strong>';
			if ($individuID == 0 && $mail == '')
				$aff .= 'Saisissez vos codes de connexion</strong> :</p>';
			else
				$aff .= 'Vos données personnelles</strong> :</p>';
			$aff .= '
			</td>
			<td bgcolor="#000033" width="50%">
			<p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;"><strong>';
			if ($individuID == 0 && $mail == '')
				$aff .= 'Vous n\'êtes pas client CISCAR ?</strong></p>';
			else
				$aff .= 'Adresse de facturation</strong> :</p>';
			$aff .= '
			</td>
			</tr>';
			
			if ($individuID == 0) {
				if ($mail == '') {
					$aff .= '								
	  						<tr>
	    						<td valign="top">
	          						<p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left; line-height:30px;">
	          						Nom d\'utilisateur :<br/>
	          						<input type="text" value="" id="logincnx" name="logincnx" /><br/>
	          						Mot de passe : <br/>
	          						<input type="password" value="" id="pwdcnx" name="pwdcnx" />
	          						<strong><input type="submit" value="OK" name="submitIDButton" onclick="return ValidationConnexionForm();" formaction="?action=connexion&deal=' . $DealsID . '#commander"/></strong><br/>
								    <!-- LINK THAT OPEN FANCYBOX -->
									<a href="#login_lost" id="login_lost_link" style="color: #FFFFFF;">Mot de passe oublié ?</a><br>
	          						
	          						<span id="formErr" style="font-size: 13px;color: #F00;font-weight: bold;">' . $msg . '</span><br>
	          						</p>
	        					</td>
	        					<td>
									<p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;line-height:20px;">Votre adresse email :<br/>
	          						<input type="text" value="" style="width:250px;" id="mailcnx" name="mailcnx" />
	          						<strong><input type="submit" value="OK" name="submitMailButton" onclick="return ValidationMailForm();" formaction="?action=mailconnexion&deal=' . $DealsID . '#commander"/></strong>
								</td>
	    					</tr>';
				} else {
					$aff .= '
		  					<tr>
						    	<td>
							          <p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;line-height:30px;">
									  NOM* :<br/>
							          <input class="input_deal" name="nomFac" value="' . $Nom_fac . '" ' . $actif . ' ><br/>
							          Prénom : <br/>
							          <input class="input_deal" name="prenomFac" value="' . $Prenom_fac . '" ' . $actif . ' ><br/>
							          Téléphone* : <br/>
							          <input class="input_deal" name="telFac" value="' . $Tel_fac . '" ' . $actif . ' ><br/>
							           <p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;line-height:20px;">					          		
							           Email : <b>' . $Mail_fac . '</b><br>
							           <a href="#mail_new" name="mail_new_link" id="mail_new_link" style="color: #FFFFFF;">Changer d\'adresse email</a>
							           </p>
									  <input type="hidden" name="hidMailFac" id="hidMailFac" value=' . $Mail_fac . '>
							          </p>
						        </td>							
							    <td>
							          <p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;line-height:30px;">
							          Raison sociale* :<br/>
							          <input class="input_deal" name="raisonsocialeFac" value="' . $RaisonSociale_fac . '" ' . $actif . ' ><br/>
							          Adresse* : <br/>
							          <input class="input_deal" name="adresse1Fac" value="' . $Adresse1_fac . '" ' . $actif . ' ><br/>
							          Complément adresse : <br/>
							          <input class="input_deal" name="adresse2Fac" value="' . $Adresse2_fac . '" ' . $actif . ' ><br/>
							          Code postal* :<br/>
							          <input class="input_deal" name="codepostalFac" value="' . $CodePostal_fac . '" ' . $actif . ' ><br/>
							          Ville* : <br/>
							          <input class="input_deal" name="villeFac" value="' . $Ville_fac . '" ' . $actif . ' >
							        </p>							
							    </td>
							</tr>';
				}
			} else {
				$aff .= '								
	  					<tr>
	 						<td>
								<p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;line-height:30px;">' . $aSessionSecurite->getCiviliteUser () . ' ' . utf8_encode ( $aSessionSecurite->getPrenomUser () ) . ' ' . $aSessionSecurite->getNomUser () . '<br/>
								<strong>Mail</strong> : ' . $aSessionSecurite->getMailUser () . '<br/>
								<a href="#login_new" name="login_new_link" id="login_new_link" style="color: #FFFFFF;">Changer d\'utilisateur</a>										
								</p>
								<input type="hidden" name="hidMailFac" id="hidMailFac" value=' . $aSessionSecurite->getMailUser () . '>
							</td>
							<td>
								<p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;line-height:20px;">' . $aSessionSecurite->getRaisonSocialUser () . '<br/>
								CODE CLIENT : ' . $loginCli . '<br/>' . $aSessionSecurite->getAdresse1User () . '<br/>' . $aSessionSecurite->getAdresse2User () . '<br/>' . $aSessionSecurite->getCodePostalUser () . ' ' . $aSessionSecurite->getVilleUser () . '<br/>
								</p>
							</td>
						</tr>';
			}
			
			if ($individuID > 0 || $mail != '') {
				$aff .= '
						<tr>
							<td colspan="2"  bgcolor="#000033">
								<p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;"><strong>Adresse de livraison</strong> : ';
				if ($mail != '')
					$aff .= '
								<span style="font-size: 11px;color: #FFF;vertical-align:middle;">identique à l\'adresse de facturation<input style="vertical-align:middle;margin-bottom:4px" type="checkbox" id="chkadrliv" name="chkadrliv" value="" onclick="RecupAdrLiv()"; /></span> ';
				$aff .= '							
							</p>
							</td>
						</tr>
						<tr>
							<td>
								<p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;line-height:30px;">
								Raison sociale* :<br/>
								<input class="input_deal" name="raisonsocialeLiv" value="' . $RaisonSociale_liv . '" ' . $actif . ' ><br/>
								A l\'attention de* :<br/>
								<input class="input_deal" name="destinataireLiv" value="' . $Destinataire_liv . '" ' . $actif . ' ><br/>
								Adresse* : <br/>
								<input class="input_deal" name="adresse1Liv" value="' . $Adresse1_liv . '" ' . $actif . ' ><br/>
								Complément adresse : <br/>
								<input class="input_deal" name="adresse2Liv" value="' . $Adresse2_liv . '" ' . $actif . ' ><br/>
								</p>
							</td>
							<td valign="top">
								<p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left; line-height:30px;">
								Code postal* :<br/>
								<input class="input_deal" name="codepostalLiv" value="' . $CodePostal_liv . '" ' . $actif . ' ><br/>
								Ville* : <br/>
								<input class="input_deal" name="villeLiv" value="' . $Ville_liv . '" ' . $actif . ' >
								</p>
							</td>
						</tr>';
			}
			
			$aff .= '
			</table>';
		}
		
		if (($individuID > 0 || $mail != '') && $DealsID > 0 && ! $finDeal && ! $cmd) {
			$aff .= '
		<table cellpadding="5" cellspacing="1" border="0" width="100%">
			<tr>
		        <td bgcolor="#000033"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:center; margin:0px;"><strong>Description produit</strong></p>
		        </td>
		        <td bgcolor="#000033" nowrap="nowrap"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:center;margin:0px;"><strong>Prix<br/>unitaire <sup>HT</sup></strong></p>
		        </td>';
			// <td bgcolor="#000033"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:center;margin:0px;"><strong>Couleur</strong></p>
			// </td>
			$aff .= '
				<td bgcolor="#000033"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:center;margin:0px;"><strong>Quantité</strong></p>
		        </td>
		         <td bgcolor="#000033" nowrap="nowrap"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:center;margin:0px;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TOTAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></p>
		        </td>
		    </tr>';
			
			$aff .= '
		    <tr>
		        <td rowspan="1"  style="border-right:#000033 1px solid;border-left:#000033 1px solid;"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;">Démonte pneu auto 10-24\'\'</br>+ Bras d\'assistance</br></br>Réf. : Réf. : OUT.DM1000 + OUT.DM1100</p><span style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;">+ en cadeau 1 trolley Serge Blanco !</span>
		        </td>
		        <td rowspan="1"  style="border-right:#000033 1px solid;"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:center;">' . number_format ( $adeals->getPrixPromo (), 2, ',', ' ' ) . ' €</p>
		        </td>';
			
			foreach ( $params as $DealParam ) {
				$index += 1;
				if ($index > 1)
					$aff .= '</tr><tr>';
					// if($index == 1)
					// $aff .='<td style="border-bottom:#000033 1px solid;border-right:#000033 1px solid;"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:center;">'.$DealParam->getParamLibelle().'</p></td>';
					// else
					// $aff .='<td style="border-right:#000033 1px solid;"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:center;">'.$DealParam->getParamLibelle().'</p></td>';
				if ($index == 1)
					$aff .= '<td style="border-right:#000033 1px solid;"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:center;">';
				else
					$aff .= '<td style="border-right:#000033 1px solid;"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:center;">';
				
				$aff .= '<input autocomplete="off" class="input_deal_short" id="qtecmd' . $index . '" name="qtecmd' . $index . '" value="' . $qteCmd . '" onkeyup="somme(' . $adeals->getPrixPromo () . ')" ' . $actif . ' ></p>
		        	</td>';
				if ($index == 1)
					$aff .= '<td style="border-right:#000033 1px solid;">';
				else
					$aff .= '<td style="border-right:#000033 1px solid;">';
				$aff .= '<div style="float: right;font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:right;" id="mtcmdunit' . $index . '" name="mtcmdunit' . $index . '"></td>';
				$aff .= '</tr>';
			}
			$aff .= '<input type="hidden" name="hidNbParam" id="hidNbParam" value=' . $index . '>';
			
			$aff .= '
		    </tr>
			<tr>
		        <td colspan="3"  style="border-top:#000033 1px solid; border-left:#000033 1px solid;border-right:#000033 1px solid;">
		        
		        <p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:right;"><strong>Frais de port : </strong></p>
		        </td>
		         <td  style="border-top:#000033 1px solid; border-right:#000033 1px solid;"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:center;"><strong>0 €</strong></p>
		        </td>
		    </tr>
		    <tr>
		        <td colspan="3" bgcolor="#000033"><p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:16px;text-align:right;"><strong>TOTAL HT</strong></p>
		        </td>
		         <td nowrap="nowrap" style="border:#47ad76 1px solid;"><strong>
					<div style="float: right;font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:16px;text-align:right;" id="mtcmd" name="mtcmd"></div></strong></p>
		        </td>
		    </tr>
		    <tr>
		    	<td colspan="4" valign="middle">
		        <p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px;text-align:left;"><input type="checkbox" id="chkcp" name="chkcp" value="o" />  
		        J\'ai bien pris connaissance des conditions particulières de l\'offre et je les accepte. <a href="#conditions" style="color:#FFFFFF;">En savoir plus</a> </p>
		        </td>
		    </tr>
		     <tr>
		    	<td colspan="4" align="center">
		        <p style="font-family:Arial, Helvetica, sans-serif; color:#FFFFFF; font-size:13px; margin:0px;"> 
		        Votre commentaire pour cette commande :<br/><textarea id="remarque" name="remarque" rows="3" cols="40"></textarea></p>
		        </td>
		    </tr>
		    <tr>
		    	<td colspan="4" align="center">
				<input align="center" type="submit" value="Je valide ma commande" name="submitButton" onclick="return ValidationDealForm();" class="fr_bouton_cmd_deals">	
		        </td>
		    </tr>
		
		</table>';
		}
		
		$aff .= '
		</td>
		</tr>';
		if (! $cmd)
			$aff .= '
		<tr>
		<td colspan="2" id="about" >  <p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; text-align:left; color:#192d62;">Fonctionnement du Deal CISCAR :</p>
		
		<table align="center" cellpadding="10" width="100%">
		<tr>
		<td><p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; text-align:center; color:#192d62; text-transform:uppercase;"><img src="../../include/images/deal2/img/1-produit.jpg" /></p>
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; text-align:center; color:#192d62; text-transform:uppercase;">1 produit</p>
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:18px; text-align:center; color:#192d62;">sélectionné<br />
		pour ses qualités.</p>
		</td>
		<td><p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; text-align:center; color:#192d62; text-transform:uppercase;"><img src="../../include/images/deal2/img/1-prix.jpg" width="64" height="64" /></p>
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; text-align:center; color:#192d62; text-transform:uppercase;">1 prix</p>
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:18px; text-align:center; color:#192d62;">négocié<br />
		pour un volume donné.</p>
		</td>
		<td><p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; text-align:center; color:#192d62; text-transform:uppercase;"><img src="../../include/images/deal2/img/5-jours.jpg" width="64" height="64" /></p>
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; text-align:center; color:#192d62; text-transform:uppercase;">';
			
			// calcul de la différence entre la date de debut et la date de fin en nombre de jours
		$DateDebut_abs = abs ( strtotime ( $DateDebut ) );
		$DateFin_abs = abs ( strtotime ( $DateFin ) );
		$datediff = $DateFin_abs - $DateDebut_abs;
		$day = floor ( $datediff / (60 * 60 * 24) ) + 1;
		$aff .= $day . ' jours</p>
				
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:18px; text-align:center; color:#192d62;">pour atteindre<br />
		ce volume.</p>
		</td>
		</tr>	
		</table>
		
		<table align="center" cellpadding="10" width="100%">
		<tr>
		<td width="50%" valign="top" style="border-top:1px solid #192d62;"><p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; text-align:center; color:#192d62; text-transform:uppercase;"><img src="../../include/images/deal2/img//non-atteint.jpg" width="64" height="64" /></p>
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; text-align:center; color:#192d62; text-transform:uppercase;">Volume non atteint ?</p>
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:18px; text-align:center; color:#192d62;">le deal est annulé... <br/>
		Votre commande s\'annule<br/>et ne vous sera pas facturée.</p>
		</td>
		<td width="50%" valign="top"  style="border-top:1px solid #192d62;"><p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; text-align:center; color:#192d62; text-transform:uppercase;"><img src="../../include/images/deal2/img//atteint.jpg" width="64" height="64" /></p>
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:20px; font-weight:bold; text-align:center; color:#192d62; text-transform:uppercase;">Volume atteint ?</p>
		<p style="font-family:Arial, Helvetica, sans-serif; font-size:18px; text-align:center; color:#192d62;">le deal est remporté !<br/>
		Votre commande bénéficie automatiquement du tarif et avantages négociés.</p>
		</td>
		</tr>
		</table>';
		
		if ($DealsID > 0 && ! $cmd)
			$aff .= '			
			<tr>
			<td colspan="2" style="border-top:1px solid #e1e1e1; background-color:#eee;" id="conditions">
	 		<p style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; text-align:center;">
	        Conditions particulières de cette offre :</p>
	 		<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; text-align:justify;">Tarifs franco, ht, hors mise en service et contrat de maintenance (disponibles en option), jusqu’au 14 avril 2017.

			</br></br>*&nbsp;Si le volume minimum de 7 démonte-pneus n’est pas atteint, votre commande ne sera pas prise en compte. </br>&nbsp;&nbsp;Si vous désirez conserver votre commande, le tarif habituel sera appliqué.</p>
			</td>
			</tr>';
		else if (! $cmd)
			$aff .= '
				<tr>
				<td align="center" colspan="2" bgcolor="#192d62">
				<p style="font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold; text-align:center; color:#ffffff;">Surveillez votre boîte de réception ;)</p>			
				</td>		
				</tr>';
		else {
			$aff .= '
                 <tr>
	             <td  colspan="2">
	             <p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; text-align:center;">Votre commande a bien été enregistrée !</p>
	             <p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; text-align:center;">Vous allez recevoir un email de confirmation</p>
	             <p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; text-align:center;">à l\'adresse suivante : <b>' . $mailFac . '</b></p>
				 <p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; text-align:center;">Prochainement vous recevrez également un email de suivi du Deal CISCAR<br/>
	             afin de vous informer si celui-ci a été remporté ou non.</p>';
			if ($QuantiteRestant > 0) {
				$tabQteRest = array_map ( 'intval', str_split ( $QuantiteRestant ) );
				$nbQteRest = count ( $tabQteRest );
				$aff .= '
				 		<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal; text-align:center;">
						<table padding="1px" spacing="1px" width="50%" align="center";>
							<tr>
								<td align="right">
								<p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:35px; text-align:right;margin-bottom:0px;">
								Plus que </p>
								</td>';
				
				if ($nbQteRest == 1)
					$aff .= '
								<td>
								<p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:35px; text-align:center;margin-bottom:0px;margin-right:-6px;">
								<img src="../../include/images/deal2/img/0.jpg">
								</p>
								</td>';
				
				for($i = 0; $i < $nbQteRest; $i ++) {
					$aff .= '
	             		<td>
	             			<p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:35px; text-align:center;margin-bottom:0px;margin-right:-6px;">
				 			<img src="../../include/images/deal2/img/' . $tabQteRest [$i] . '.jpg">
				 			</p>
	             		</td>';
				}
				$aff .= '
	             		<td align="left">
	             			<p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; line-height:35px; text-align:left;margin-bottom:0px;margin-left:4px;">
							commandes,</p>
						</td>
	             		</tr>
	             		</table>
						</p>
						<p style="font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold; text-align:center;"><span style="font-size:22px;color:#e88320;">pour remporter le Deal CISCAR</span><br/>';
			} else
				$aff .= '
	             	<p style="font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold; text-align:center;">Le Deal CISCAR a été <span style="font-size:22px;color:#e88320;">REMPORT&Eacute; !</span><br/>';
			
			$aff .= '
	             	... parlez en aux professionnels autour de vous !<br/> </p>
	             </td>
                 </tr>                    
                 <tr>
                 <td valign="top" style="border-right:1px solid #eeeeee;">
	          	<input type="hidden" value="' . $aSessionSecurite->getLoginUser () . '" id="logincnx" name="logincnx" /><br/>
	          	<input type="hidden" value="' . $aSessionSecurite->getPwdUser () . '" id="pwdcnx" name="pwdcnx" />             		
	          	<input type="hidden" value="' . $mail . '" id="mailcnx" name="mailcnx" />             		
	          	</td>
				 </tr>
	             <tr>
	             <td align="center">
	             <a href="http://www.ciscar.fr" style="color: #47ad76; display: inline-block; background-color:#192d62;
					text-decoration: none;
					padding: 15px 40px;
					border: 2px solid #000033;
					-moz-border-radius: 2px;
					-webkit-border-radius: 2px;
					border-radius: 2px;
					margin: 20px 20px 10px 0;             
					color: #ffffff;font-family: Helvetica, Arial, sans-serif; font-weight:bold;
					font-size: 16px;"><span>Aller sur ciscar.fr</span></a>
				</td>
		        <td align="center">';
			if ($mail == '')
				$aff .= '
					<input align="center" type="submit" formaction="?action=connexion&deal=' . $DealsID . '" value="Faire une nouvelle commande" name="submitButton" class="fr_bouton_cmd_deals">';
			else
				$aff .= '
					<input align="center" type="submit" formaction="?action=mailconnexion&deal=' . $DealsID . '" value="Faire une nouvelle commande" name="submitButton" class="fr_bouton_cmd_deals">';
			$aff .= '
	            </td>
	            </tr>';
		}
		$aff .= ' 
 			<tr>
            <td colspan="2">
            <p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; font-weight:bold; text-align:center;"><a href="http://www.ciscar.fr" target="_blank"><img src="../../include/images/deal2/img/logo_ciscar.png" width="235" height="38" border="0" /></a></p>
            <p style="font-family:Arial, Helvetica, sans-serif; font-size:22px; text-align:center;">Pour toute information, nous sommes à votre disposition<br/>au <strong>01 80 05 23 23</strong> ou par mail à <strong><a href="mailto:infos@ciscar.fr">infos@ciscar.fr</a></strong> </p>';
		if ($DealsID > 0 && ! $finDeal && ! $cmd)
			$aff .= '';
			// <p style="font-family:Arial, Helvetica, sans-serif; font-size:11px; text-align:justify; margin-top:40px;">* Désimlocké : permet d\'utiliser une carte SIM de n\'importe quel opérateur.<br>
			// ** Double SIM : permet d\'utiliser 2 numéros via 2 cartes SIM différentes insérées dans le même téléphone.</p>';
		$aff .= '
              </td>
            </tr>				
		</table>
		
		</td>			

		</tr>
		</table>
		</form>
 		</div>
		</div>';
		$aff .= '<!-- LOGIN LOST -->';
		$aff .= '<div style="display:none;"><div id="login_lost">';
		$aff .= '             <h2>Mot de passe oublié ?</h2>';
		$aff .= '              <p>Vous avez perdu ou oublié votre mot de passe ?<br/>Indiquez votre adresse e-mail ci-dessous pour le recevoir à nouveau :</p>';
		$aff .= '              <div><form id="formmotdepasseperdu"  action="?action=motdepasseperdu" method="POST" name="motdepasseperdu" ><input type="text" value="" class="input_login_lost" id="mail" name="mail" /><input type="submit" value="" name="submitButton" class="fr_bouton_envoyer"/></form></div>';
		$aff .= '               <div class="clearboth"></div>';
		$aff .= '              <div id="login_lost_error" class="display_none">Adresse e-mail introuvable ...<br /></div>';
		$aff .= '             <div id="login_lost_success" class="display_none">Nous venons de vous envoyer un e-mail avec votre mot de passe.<br/>Merci de vérifier votre boite de réception (ou courrier indésirable).</div>';
		$aff .= '</div></div>';
		
		$aff .= '<!-- LOGIN NEW -->';
		$aff .= '<div style="display:none;float: left;"><div style="float: left;" id="login_new" name="login_new">';
		$aff .= '             <h2>Connexion</h2>';
		$aff .= '              <p>Renseignez vos identifiants de connexion</p>';
		$aff .= '              <form style="width:236px;" id="formconnexion1"  action="?action=connexion&deal=' . $DealsID . '#commander" method="POST" name="connexion" >
						   Login<br><input type="text" value="" class="input_login_new" id="logincnx" name="logincnx" /></br><br>
						   Mot de passe<br> <input type="password" value="" class="input_login_new" id="pwdcnx" name="pwdcnx" />
						   <input type="submit" value="" name="submitButton" class="fr_bouton_connecte"/></form></br>
							<a href="#login_lost" id="login_lost_link" style="color: #000;">Mot de passe oublié ?</a><br>';
		$aff .= '</div></div>';
		
		$aff .= '<!-- LOGINMAIL NEW -->';
		$aff .= '<div style="display:none;"><div id="mail_new" name="mail_new">';
		
		$aff .= '             <h2>Connexion</h2>';
		$aff .= '              <p>Renseignez la nouvelle adresse</p>';
		$aff .= '              <div><form id="formmail1"  action="?action=mailconnexion&deal=' . $DealsID . '#commander" method="POST" name="mailconnexion" >
							   Mail<br><input type="text" value="" class="input_login_new" id="mailcnx" name="mailcnx" /><br><br>
							   <input type="submit" value="" name="submitButton" class="fr_bouton_connecte"/></form></div>';
		$aff .= '</div></div>';
		// Nouvelle connexion
		$aff .= '<script type="text/javascript">
		$("#formconnexion1").on("submit", function() 
		{
			var logincnx = $("#logincnx").val();
			var pwdcnx = $("#pwdcnx").val();
			if(logincnx == "" || pwdcnx == "" ) 
			{
				alert("Les champs Login et mot de passe doivent êtres renseignés.");
				return false;
			}
			
		});
		</script>';
		// Nouveau mail
		$aff .= '<script type="text/javascript">
		$("#formmail").on("submit", function()
		{
			var mailcnx = $("#mailcnx").val();
			if(mailcnx == "" )
			{
				alert("L\'adresse mail doit être renseignée.");
				return false;
			}
				
		});
		</script>';
		// Mot de passe oublier
		$aff .= '<script type="text/javascript">
		$("#formmotdepasseperdu").on("submit", function() {
			var mail = $("#mail").val();
			if(mail == "") {
				alert("Le champ doit être rempli");
			} else {
				// appel Ajax
				$.ajax({
					url: "/index.php?action=ajaxmotdepasseperdu",
					type: "POST",
					data:"mail="+mail+" & submitButton=ok",
					dataType : "html",
					success: function(code_html, statut){
						if(code_html!="ko"){
							if(code_html=="false" || code_html=="falsefalse" || code_html=="falsefalseok"){
								alert("Erreur");
							}else{
								$("#login_lost_error").hide();
								$("#login_lost_success").show();
							}
						}else{
							$("#login_lost_error").show();
						}
					}
				});
				return false;
			}
			return false;
		});
		$("#mail").click(function() {
			$("#login_lost_error").hide();
		});
		</script>';
		
		// GOOGLE ANALYTICS
		$aff .= '<script type="text/javascript">
		(function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');
		
		ga(\'create\', \'UA-27893097-2\', \'auto\');
		ga(\'send\', \'pageview\');
		
		</script>';
		
		$aff .= '
		</body>
		<!-- InstanceEnd --></html>';
		return $aff;
	}
}
?>