<?php
/**
 * @author Florent DESPIERRES
 * @package portail-Ciscar
 * @subpackage commun
 * @version 1.0.4
 */
class HomePageNonConnecteView {
	public function __construct() {
	}
	public function renderHTML($msg = Null, $urlReturn = Null) {
		$mdpmail = '';
		$mdpuser = '';
		$mdppwd = '';
		$mdpfullname = '';
		
		if (strpos($msg,"MDP0") !== false || strpos($msg,"MDP1") !== false || strpos($msg,"MDP2") !== false || strpos($msg,"MDPV") !== false || strpos($msg,"MDPA") !== false)
		{
			$tabmsg = explode("&",$msg);
			if (array_count_values($tabmsg) > 0)
			{
				$msg = $tabmsg[0];
				if ($msg != 'MDP2')
				{
					$mdpmail = $tabmsg[1];
					$mdpuser = $tabmsg[2];
					$mdppwd = $tabmsg[3];
					$mdpfullname = $tabmsg[4];
				}
				else 
				{
					$mdp2msg = $tabmsg[1];
				}
			}
		}
		
		$aParam = new Param ();
		$aParam->search_param ( 'CISCAR_PUB_HOMEPAGE_IMAGE' );
		$aParam2 = new Param ();
		$aParam2->search_param ( 'CISCAR_PUB_HOMEPAGE_URL' );

		$aff = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">';
		$aff .= '<html>';
		$aff .= '<head>';
		$aff .= '<meta name="description" content="CISCAR, Centrale d\'Achats des réseaux automobiles." />';
		$aff .= '<meta name="robots" content="index, follow" />';
		$aff .= '<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">';
		$aff .= '<meta name="viewport" content="width=device-width,initial-scale=1">';
		$aff .= '<meta name="description" content="CISCAR, Centrale d\'Achats des réseaux automobiles" />';
		$aff .= '<title>CISCAR : Connectez-vous à votre centrale d\'achat</title>';
		$aff .= '<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">';
		$aff .= '<link href="https://fonts.googleapis.com/css?family=Arimo" rel="stylesheet">';
		$aff .= '<link href="https://fonts.googleapis.com/css?family=Fjalla+One" rel="stylesheet">';		
		
		//jquery
		$aff .= '<script src="include/js/jquery-3.0.0.js"></script>';
		$aff .= '<script src="include/js/jquery-ui.js"></script>';
		$aff .= '<link href="include/css/jquery-ui.css" rel="stylesheet">';
		
		//bootstrap 
		$aff .= '<link href="include/bootstrap/css/bootstrap.css" rel="stylesheet">';
		$aff .= '<link href="include/bootstrap/css/bootstrap-theme.css" rel="stylesheet">';
		$aff .= '<script src="include/bootstrap/js/bootstrap.js"></script>';

		$aff .= '<link rel="stylesheet" type="text/css" media="screen" href="include/css/CommunLayout.css" />';
		$aff .= '<link rel="stylesheet" type="text/css" media="screen" href="include/css/styles.css" />';
		
		//password meters
		$aff .= '<link rel="stylesheet" type="text/css" media="screen" href="include/css/password.css" />';
		$aff .= '<script src="include/js/password-meter.js"></script>';
		
		// Confirm
		$aff .= '<link rel="stylesheet" href="include/css/jquery-confirm.css">';
		$aff .= '<script src="include/js/jquery-confirm.js"></script>';
		
		//Slick SlideShow
		$aff .= '<link rel="stylesheet" type="text/css" href="include/slick/slick.css"/>';
		// Add the new slick-theme.css if you want the default styling
		$aff .= '<link rel="stylesheet" type="text/css" href="include/slick/slick-theme.css"/>';
		
		$aff .= '<style>';
		$aff .= '* {margin:0px; padding:0px;}';
		$aff .= 'body{background:#eeeeee;font-family:Fjalla One,helvetica,arial;}';
		
		$aff .= '.container #header{margin:15px auto;}';
		$aff .= '.container #menu{background:transparent url(\'include/images/kit/hp/filigrane_large.jpg\') no-repeat center top;text-align:center;padding-top:60px;border:0px solid #000000;}';
		$aff .= '.container #fondmenu{display:inline-table;background-color:rgba(0,70,130,0.3);border-radius:5px;margin-bottom:10px;}';
		$aff .= '.container #mgauche{background:transparent;}';
		$aff .= '.container #menugauche{background:transparent url(\'include/images/kit/hp/filigrane_large.jpg\') no-repeat center top;display:table-cell;float:left;padding-top:35px;padding-bottom:20px;padding-left:20px;text-align:left;font-size:17pt;font-family: \'Fjalla One\', helvetica,arial;color:#fff;text-shadow: 2px 2px 2px black;}';
		$aff .= '.container #menucentre{display:table-cell;float:left;margin-top:20px;margin-bottom:20px;border-width:0 0 0 0px;border-color:white;border-style:solid;}';
		$aff .= '.container #menudroite{display:table-cell;float:left;padding-top:0px;padding-bottom:10px;text-align:left;font-size:10pt;font-family: \'helvetica,arial\';color:#fff;}';
		// $aff .='#wrapper #menudroite{display:table-cell;width:50%;padding-top:20px;padding-bottom:20px;padding-left:20px;text-align:left;}';
		$aff .= '.container #footer{float:left;width:100%;padding-top:10px;padding-bottom:10px;background:transparent;text-align:center;border:0px solid #000000;font-size:9pt;color:blue;font-weight:bold;margin:10px auto;}';
		$aff .= '.container #subfooter{padding-top:00px;padding-bottom:20px;background:#ededed;text-align:center;border:0px solid #000000;font-size:10pt;font-family: helvetica,arial;color:grey;font-weight:normal;}';
				
		$aff .= '#inputfield {
			background-color: transparent;
			border: 2px solid #fff;
			border-radius: 5px;
			font-family:Fjalla One,helvetica,arial;
			float: left;
			height: 45px;
			outline: medium none;
			padding: 0px 0px 0px 10px;
			transition: border-color 0.3s ease 0s;
			color:#fff;
			font-size:11pt;
			margin-top:10px;
			width: 100%;}';

		$aff .= '#inputmdp0mail,#inputmdp1mail, #inputmdp0pwd1,#inputmdp0pwd2,#inputmdplostmail, #inputmdplostpwd1,#inputmdplostpwd2 {
			background-color: transparent;
			border: 1px solid #878484;
			border-radius: 5px;
			font-family:arial;
			float: left;
			height: 30px;
			outline: medium none;
			padding: 0px 0px 0px 10px;
			transition: border-color 0.3s ease 0s;
			color:#444;
			font-size:10pt;
			margin-top:10px;
			width:100%}';
		

		$aff .= '#inputsmallfield {
			background-color: transparent;
			border: 2px solid #fff;
			border-radius: 5px;
			font-family:helvetica,arial;
			float: left;
			height: 35px;
			outline: medium none;
			padding: 0px 0px 0px 5px;
			transition: border-color 0.3s ease 0s;
			color:#fff;
			font-size:10pt;
			margin-top:10px;
			width: 100%;}';
		
		$aff .= '#loginAuto {
			background-color: transparent;
			text-align: left;
			margin-top:10px;
			}';
		
		$aff .= '#submitbtn {
			background-color: transparent;
			text-align: left;
			margin-top:10px;
			margin-left:50px;
			}';
		
		
		$aff .= '
			#inputfield::-moz-placeholder {
			color:white;
			opacity: 5;
		}
			#inputfield:-ms-input-placeholder {
			color:white;
			opacity: 5;
		}
			#inputfield::-webkit-input-placeholder {
			color:white;
			opacity: 5;
		}
		';
		$aff .= '
			#inputsmallfield::-moz-placeholder {
			color:white;
			opacity: 5;
		}
			#inputsmallfield:-ms-input-placeholder {
			color:white;
			opacity: 5;
		}
			#inputsmallfield::-webkit-input-placeholder {
			color:white;
			opacity: 5;
		}
		';
		
		$aff .= '.jconfirm-title{
				text-align:left;}';
		$aff .= '
		.form-control-input {
			display: block;
			height: 35px;
			padding: 6px 6px;
			font-size: 12px;
			line-height: 1.42857143;
			color: #555;
			background-color: #fff;
			background-image: none;
			border: 2px solid #133d75;
			border-radius: 4px;
			text-align: left;
			-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
			box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
			-webkit-transition: border-color ease-in-out .15s, -webkit-box-shadow
				ease-in-out .15s;
			-o-transition: border-color ease-in-out .15s, box-shadow ease-in-out
				.15s;
			transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s;
		}				
		.input-file {
			position: relative;
			margin: 0px 0px 0px 0px
		} /* Remove margin, it is just for stackoverflow viewing */
		.input-file .input-group-addon {
			border: 0px;
			padding: 0px;
			border: 1px solid #ccc;
			background-color: #133d75;
			border: 1px solid #133d75;
		}
		
		.input-file .input-group-addon .btn {
			border-radius: 4px 4px 4px 4px;
		}
		
		.input-file .input-group-addon input {
			cursor: pointer;
			position: absolute;
			width: 72px;
			z-index: 2;
			top: 0;
			right: 0;
			filter: alpha(opacity = 0);
			-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
			opacity: 0;
			background-color: transparent;
			color: transparent;
		}
				
		';
		
		$aff .= '
		@media screen and (min-width: 1200px) {
			.container #fondmenu {width:95%;}
	}
		@media screen and (max-width: 1500px) {
			.container #fondmenu {width:95%;}
	}
		@media screen and (max-width: 1024px) {
			.container #fondmenu {width:95%;}
	}
		@media screen and (max-width: 992px) {
			h1 {font-size:28px;}
			.container #fondmenu {width:95%;}
	}
		@media screen and (max-width: 767px) {
			h1 {font-size:22px;}
			.container #fondmenu {width:99%;}
	}			
		@media screen and (max-width: 490px) {
			h1 {font-size:16px;}
	}			
				';
		$aff .= '</style>';
		
		$aff .= '<!--[if IE 7]>';
		$aff .= '<style>';
		$aff .= '#wrapper #menu{margin-left:-10px;}';
		$aff .= '#wrapper #footer{margin-left:-10px;}';
		$aff .= '</style>';
		$aff .= '<![endif]-->';
		$aff .= '
			<script language="javascript">
			function icomV5(urlReturn){
				var link = \'\';
				link = \'index.php?action=icomV5\';
				document.forms[\'FormConnection\'].action = link;
				document.forms[\'FormConnection\'].submit();
			}
			function geolane(urlReturn){
				var link = \'geolane\';
				link = \'index.php?action=geolane\';
				document.forms[\'FormConnection\'].action = link;
				document.forms[\'FormConnection\'].submit();
			}
			function ciscarnl(urlReturn){
				var link = \'ciscarnl\';
				link = \'http://ciscar.nlvm\';
				document.forms[\'FormConnection\'].action = link;
				document.forms[\'FormConnection\'].submit();
			}
			window.onload = function() {
				$(".liendiv0").click(function() {
					$(".attentionredirection").css("display", "none");
					$(".codesdeconnexion").css("display", "none");
					$(".quisommesnous").css("display", "none");
					$(".merci").css("display", "none");
					$(".slideshow").fadeIn(1000);
					$(".formLogin").fadeIn(1000);
				});
				
				$(".liendiv1").click(function() {
					$(".slideshow").css("display", "none");
					$(".formLogin").css("display", "none");
					$(".attentionredirection").css("display", "none");
					$(".codesdeconnexion").css("display", "none");
					$(".merci").css("display", "none");
					$(".quisommesnous").fadeIn(1000);
				});
			
				$(".liendiv2").click(function() {
					$(".slideshow").css("display", "none");
					$(".formLogin").css("display", "none");
					$(".quisommesnous").css("display", "none");
					$(".codesdeconnexion").css("display", "none");
					$(".merci").css("display", "none");
					$(".attentionredirection").fadeIn(1000);
				});
				
				$(".liendiv3").click(function() {
					$(".slideshow").css("display", "none");
					$(".formLogin").css("display", "none");
					$(".quisommesnous").css("display", "none");
					$(".attentionredirection").css("display", "none");
					$(".merci").css("display", "none");
					$(".codesdeconnexion").fadeIn(1000);
				});
				
				$(".lienbtn0").click(function() {
					$(".quisommesnous").css("display", "none");
					$(".codesdeconnexion").fadeIn(1000);
				});
				
				$(".lienbtn1").click(function() {
					$(".quisommesnous").css("display", "none");
					$(".slideshow").fadeIn(4000);
					$(".formLogin").fadeIn(1000);
				});
				
				$(".lienbtn2").click(function() {
					$(".attentionredirection").css("display", "none");
					$(".codesdeconnexion").fadeIn(1000);
				});
				
				$(".lienbtn3").click(function() {
					$(".attentionredirection").css("display", "none");
					$(".slideshow").fadeIn(4000);
					$(".formLogin").fadeIn(1000);
				});';
		
			if ($msg=='nomerci')
				{
					$aff .= '
						$(".slideshow").css("display", "none");								
						$(".formLogin").css("display", "none");
						$(".codesdeconnexion").fadeIn(1000);
					';
				}
			if ($msg=='merci')
				{
					$aff .= '
						$(".codesdeconnexion").css("display", "none");
						$(".merci").fadeIn(1000);
					';
				}
			$aff .= '
			};	
			</script>';
		
		$aff .= '
		<!-- Add fancyBox -->
		<link rel="stylesheet" href="include/js/fancybox/source/jquery.fancybox.css?v=2.1.4" type="text/css" media="screen" />
		<script type="text/javascript" src="include/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.4"></script>

		<link rel="stylesheet" href="include/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
		<script type="text/javascript" src="include/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
		<script type="text/javascript" src="include/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.5"></script>

		<link rel="stylesheet" href="include/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
		<script type="text/javascript" src="include/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
		
		<script type="text/javascript">
		$(function(){
			// login lost => observe link with id "login_lost_link"
			$("#login_lost_link").fancybox({
				overlayOpacity:0.8,
				overlayColor:\'#000000\'
			});
		});	
		</script>
		<script type="text/javascript">
		$(function(){
			// MDP0 => observe link with id ""
			$("#mdp0_link").fancybox({
				overlayOpacity:0.8,
				overlayColor:\'#000000\'
			});
			// MDP1 => observe link with id ""
			$("#mdp1_link").fancybox({
				overlayOpacity:0.8,
				overlayColor:\'#000000\'
			});
			// MDPV => observe link with id ""
			$("#mdpv_link").fancybox({
				overlayOpacity:0.8,
				overlayColor:\'#000000\'
			});
		});
		</script>';
		
		$aff .= '<script>
		$(document).ready(function() {';
		if ($msg == 'ciscom')
		{
			$aff .= '$("#login_lost_link").fancybox().trigger(\'click\'); ';
		}
		$aff .= '})';
		$aff .= '</script>';
		
		$aff .= '</head>';
		$aff .= '<body>';
		
		$aff .= '<div class="container" style="margin-top:0px;">';
		$aff .= '<div class="col-lg-6 col-md-6 hidden-sm hidden-xs header" style="color:#ffffff;margin-left:-15px;padding-bottom:5px;padding-top:10px;float:left;">';
		$aff.='<div id="flag_gb"><a class="flag_link" href="http://ciscar.net?id_lang=4"><img src="include/images/gb.png" title="gb" text="gb"></a></div>';
		$aff.='<div id="flag_de"><a class="flag_link" href="http://ciscar.net?id_lang=5"><img src="include/images/de.png" title="de" text="de"></a></div>';
		$aff.='<div id="flag_nl"><a class="flag_link" href="http://ciscar.net?id_lang=2"><img src="include/images/nl.png" title="nl" text="nl"></a></div>';
		$aff.='<div id="flag_be"><a class="flag_link" href="http://ciscar.net?id_lang=1"><img src="include/images/be.png" title="be" text="be"></a></div>';
		//if ($urlReturn !== Null)
			//$aff .= '<div style="float:right;"><a href="javascript: ciscarnl(\'' . $urlReturn . '\')">ciscarnl</a></div>';
			// $aff .= '<div style="float:right;"><a href="javascript: geolane(\''.$urlReturn.'\')">geolane</a></div>';
		//else
			// $aff .= '<div style="float:right;"><a href="javascript: geolane(\'\')">geolane</a></div>';
			//$aff .= '<div style="float:right;"><a href="javascript: ciscarnl(\'\')">ciscarnl</a></div>';
		$aff .= '</div>';
		
		$aff .= '<div class="col-lg-6 col-md-6 hidden-sm hidden-xs header" style="color:#ffffff;margin-left:15px;padding-bottom:5px;padding-top:15px;text-align:right;"><p>Bienvenue, veuillez vous connecter</p></div>';
		
		$aff .= '<div class="row" style="background: #133d75;" >';			
		$aff .= '<div class="souscontainer">';
		$aff .= '<div class="row" style="background-color:#133d75;"><div class="hidden-md hidden-lg col-sm-12 col-xs-12" style="background-color:#054a8d;padding-bottom:5px;padding-top:5px;"><a href="/index.php"><img class="img-responsive center-block" src="include/images/Logo_blanc_300.png"/></a></div></div>';
		$aff .= '</div>';
		$aff .= '</div>';

		$aff .= '<div class="row"><div class="col-lg-12 col-md-12 hidden-sm hidden-xs"  id="header" ><a href="/index.php"><img class="img-responsive center-block" src="include/images/Logo_400.png"/></a></div></div>';
		
		$aff .= '<div class="row" style="background: #eeeeee;" >';
		$aff .= '<div class="col-lg-12 col-md-12 hidden-sm hidden-xs" style="color:#133d75;font-size:35px;padding-bottom:10px;padding-top:10px;text-align:center;">CISCAR, Centrale d\'Achats des R&eacute;seaux Automobiles</div>';
		$aff .= '<div class="hidden-lg hidden-md col-sm-12 hidden-xs" style="color:#133d75;font-size:25px;padding-bottom:10px;padding-top:10px;text-align:center;">CISCAR, Centrale d\'Achats des R&eacute;seaux Automobiles</div>';
		$aff .= '<div class="hidden-lg hidden-md hidden-sm col-xs-12" style="color:#133d75;font-size:18px;padding-bottom:10px;padding-top:10px;text-align:center;">CISCAR, Centrale d\'Achats des R&eacute;seaux Automobiles</div>';
		$aff .= '</div>';

		$aff .= '<div class="row" style="background: #133d75;" >';
		$aff .= '<div class="souscontainer">';
		$aff .= '<div class="col-lg-6 col-md-6 hidden-sm hidden-xs img-responsive center-block"  id="mgauche">';
		
		//slideShow
		$aff .= '<div class="slideshow">';
		$aff .= '<div><img src="include/images/slideshow/img1.jpg" style="height:100%"></div>';
		$aff .= '<div><img src="include/images/slideshow/img2.jpg" style="height:100%"></div>';
		$aff .= '<div><img src="include/images/slideshow/img3.jpg" style="height:100%"></div>';
		$aff .= '<div><img src="include/images/slideshow/img4.jpg" style="height:100%"></div>';
		$aff .= '</div>';
		
		//qui Sommes nous
		$aff .= '<div class="quisommesnous" style="display:none;color:#fff;text-align:left;font-family:helvetica,arial;">
		<h1 style="color:#ee8b1e;font-family:arial;">Qui sommes-nous ?</h1>
		<p style="text-align:justify;">Depuis près de 50 ans, CISCAR propose des produits et des services adaptés aux métiers de l’automobile avec 3 grandes familles de produits :</p>
		<p style="text-align:justify;">- <strong><font color="#ffc90a">Informatique</font></strong> pour renouveler ou compléter votre équipement (poste vendeur, imprimantes, serveurs, écrans, PC, onduleurs, connectiques, accessoires, etc.).</p>
		<p style="text-align:justify;">- <strong><font color="#ffc90a">Matériel de garage</font></font></strong> pour investir dans de l’outillage pérenne et rentable (ponts élévateur, clip diagnostic, géométrie, démonte pneus, extraction, vestiaires, équipement du compagnon, etc.).</p>
		<p style="text-align:justify;">- <strong><font color="#ffc90a">Merchandising & Aménagement </font></strong> pour développer votre image et votre communication (cartes de visite, porte-clés, OR, factures, papier blanc, PLV, signalétique, mobilier, téléphonie, ballons, etc.).</p>
		<p style="text-align:justify;">- Papeterie : cartes de visite, papiers à entête, enveloppes, ...</p>
		<p style="text-align:justify;">- Opérations mailing.</p>
		<p style="text-align:justify;"><strong>Conseil, réactivité et rapport qualité / prix</strong> sont les maîtres mots de CISCAR.</p>
		<p>&nbsp;</p>
		</div>';
		
		//Attention redirection
		$aff .= '<div class="attentionredirection" style="display:none;color:#fff;text-align:left;font-family:helvetica,arial;">
		<h1><img src="include/images/attention-orange.gif" alt="Votre attention" width="68" height="68" align="absmiddle" /> Votre attention</h1>
		<p style="text-align:justify;">Vous allez être redirigé vers notre site E-commerce <strong><u>SANS</u></strong> affichage des prix.</p>
		<p style="text-align:justify;">Pour consulter les tarifs et commander en ligne, <a href="#" class="lienbtn3" style="color:#ffc90a;">connectez-vous</a> ou <a class="lienbtn2" href="#" style="color:#ffc90a;">inscrivez-vous</a>.</p>
		<p>&nbsp;</p>
		</div>';				
		
		//codes de connexion
		$aff .= '<div class="codesdeconnexion" style="display:none;color:#fff;text-align:left;font-family:helvetica,arial;">
	  	<h1 style="color:#ee8b1e;font-family:helvetica,arial;">Inscrivez-vous</h1>
	  	<p style="text-align:justify;">Complétez le formulaire ci-dessous et faites partie du réseau CISCAR pour bénéficier  :<br/>
		- d\'informations métier, <br/>
	  	- de produits spécifiques à votre activité,<br/>
	  	- de conditions d\'achats privilégiées.</p>
	  	<p style="text-align:justify;">L\'accès au site CISCAR est réservé aux professionnels de l\'automobile: concessionnaires, agents, garages indépendants, centres de formation, etc. </p>
		<p style="text-align:justify;">Vous recevrez, après vérification de vos coordonnées, vos codes d\'accès.<br />
		Attention ces codes sont personnels, CISCAR ne pourra être tenu responsable en cas de transmission (de ces derniers) à une tierce personne.</p>
		<p style="text-align:justify;">Nous vous précisons, que, pour la validation de votre première commande, nous aurons besoin des documents suivants en complément:<br />
		- Extrait KBis<br />
		- Relevé d\'identité bancaire (RIB)</p>
		<p style="text-align:justify;">Nous vous remercions de votre compréhension.<br />
		</p>
		</div>';
		
		$aff .= '</div>';
		$aff .= '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"  id="menudroite">';
		$aff .= '<div class="row" >';
		$aff .= '<div class="hidden-lg hidden-md col-sm-12 col-xs-12 img-responsive center-block"  style="position:absolute;padding-left:0px;padding-right:0px;height:100%;width:100%;">';
		$aff .='<img class="img-responsive center-block" style="height:301px;opacity:0.3;filter: alpha(opacity=30);" src="include/images/slideshow/img2.jpg"/>';
		$aff .= '</div>';
		$aff .= '<div class="hidden-lg hidden-md col-sm-3 hidden-xs"></div>';

		$aff .= '<div class="col-lg-12 col-md-12 col-sm-6 col-xs-12 center-block formLogin" style="';
		if($msg == 'merci')
		{
			$aff .= 'display:none;';
			$msg = '';
		}
		$aff .= 'float:none;margin-top:50px;padding-right:15px;padding-left:15px;max-width:480px;">';
		
		if ($urlReturn !== Null) {
			$aff .= '<form method="POST" name="FormConnection" action="index.php?action=icomV5' . $urlReturn . '">';
		} else {
			$aff .= '<form method="POST" name="FormConnection" action="index.php?action=icomV5">';
		}
			
		$aff .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
		$aff .= '<input id="inputfield" name="username" placeholder="Identifiant" required type="text" ';
		
		if (isset ( $_GET ['nclogin'] ))
			$aff .= ' value=' . $_GET ['nclogin'] . '>';
		else
			$aff .= '>';
		$aff .= '</div>';
		
		$aff .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">';
		$aff .= '<input id="inputfield" name="password" placeholder="Mot de passe" required type="password" ';
		if (isset ( $_GET ['ncpwd'] ))
			$aff .= ' value=' . base64_decode ( $_GET ['ncpwd'] ) . '>';
		else
			$aff .= '>';
		
		$aff .= '<p style="padding-top:2px;margin:0px;">';
		$aff .= '<input id="loginAuto" type="checkbox" value="1" name="loginAuto"' . (isset ( $_COOKIE ['LoginAuto'] ) ? ' CHECKED' : '') . '> ';
		$aff .= '<label style="font-weight:normal;font-size:9pt;font-family:Fjalla One,helvetica,arial;margin:0px;padding-top:7px;vertical-align:top;" for="loginAuto">Se souvenir de moi</label>';
		$aff .= '</p>';
		$aff .= '</div>';
		
		
		$aff .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:10px;">';
		//$aff .= '<input type="submit" style="display:none;" name="submitButton" />';
		//$aff .= '<span id="formErr" style="font-family:arial;">' . $msg . '</span>';
		if ($msg != '' && $msg != 'MDP0' && $msg != 'MDP1' && $msg != 'MDP2' && $msg != 'MDPV' && $msg != 'ciscom')
		{
			if ($msg == 'nomerci')
			{
				$aff .= '<script type="text/javascript">
				$( document ).ready(function() {';
				$aff .= '
				$.confirm({
					title: \'<label style="font-family:arial;color:#444;">Votre demande de codes a échouée.</label>\',
						        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Il se peut que l&apos;adresse mail renseignée soit déjà utilisée sur un autre compte. </label>\',
						        type: \'red\',
						        typeAnimated: true,
								boxWidth: \'20%\',
								useBootstrap: false,
						        buttons: {
						            tryAgain: {
						                text: \'<span style="font-family:arial;text-transform: none;">Fermer</span>\',
						                btnClass: \'btn-red\',
						                action: function(){
						                }
						            }
						        }
					});';
				
				$aff .= '});
				</script>';
			}
			else 
			{
				if ($msg == 'MDPA')
				{
					$aff .= '<script type="text/javascript">
					$( document ).ready(function() {';
					$aff .= '
					$.confirm({
					title: \'<label style="font-family:arial;color:#444;">La connexion a échouée.</label>\',
						        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Nous avons noté que vous avez enregistré de nouveaux identifiants sur ce compte...<br><strong>Identifiant :</strong> '.$mdpmail.'</br><strong>Mot de passe : </strong>'.stripslashes ( substr($mdppwd, 0,2).'******'.$mdppwd[strlen($mdppwd)-1]).'</label>\',
						        type: \'red\',
						        typeAnimated: true,
								boxWidth: \'25%\',
								useBootstrap: false,
						        buttons: {
						            tryAgain: {
						                text: \'<span style="font-family:arial;text-transform: none;">Fermer</span>\',
						                btnClass: \'btn-red\',
						                action: function(){
						                }
						            }
						        }
					});';
					
					$aff .= '});
				</script>';
				}
				else
				{				
					$aff .= '<script type="text/javascript">
					$( document ).ready(function() {';
					$aff .= '
					$.confirm({
						title: \'<label style="font-family:arial;color:#444;">La connexion a échouée.</label>\',
							        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">'.$msg.'.</label>\',
							        type: \'red\',
							        typeAnimated: true,
									boxWidth: \'20%\',
									useBootstrap: false,
							        buttons: {
							            tryAgain: {
							                text: \'<span style="font-family:arial;text-transform: none;">Fermer</span>\',
							                btnClass: \'btn-red\',
							                action: function(){
							                }
							            }
							        }
						});';
								
					$aff .= '});
					</script>';	
				}
			}
		}
		//	$aff .= '<span id="formErr" style="font-family:arial;">' . $msg . '</span>';
		$aff .= '<button id="button-Validate" name="button-Validate" class="btn-warning" type="submit">SE CONNECTER</button>';
		$aff .= '<!-- LINK THAT OPEN FANCYBOX -->
				<a href="#login_lost" id="login_lost_link" style="font-family:Fjalla One,helvetica,arial;font-size:12px;color:white;">Mot de passe perdu...</a>';
		$aff .= '</div>';			
		$aff .= '</form>';

		//<!-- LOGIN LOST -->
		$aff .= '<div id="login_lost" style="text-align:left;font-family:arial;font-size:12px;display:none;">';
		$aff .= '             <h1 style="color:#ee8b1e;">Mot de passe perdu...</h1>';
		$aff .= '              <p>Vous avez perdu votre mot de passe...</br>Veuillez renseigner  votre adresse mail de connexion et votre nouveau mot de passe.</p>';
		$aff .= '              <div>';
		$aff .= '				<form id="formmotdepasseperdu"  action="?action=ajaxmotdepasseLost" method="POST" name="motdepasseperdu" >';
		$aff .= '				<table width="100%">
								<tr>
								<td >
								Adresse mail de connexion
								</td>
								<td >
								<input id="inputmdplostmail" style="margin-bottom:5px;" type="email" required value="" class="input_login_lost" name="mdplostmail" >
								</td>
								</tr>
								<tr>
								<td >
								Nouveau mot de passe
								</td>
								<td>
								<div id="divPasswordlost">
									<div class="password-meter">
										<div class="password-strength"></div>
									</div>
								<input id="inputmdplostpwd1" style="margin-top:0px;" type="password" value="" class="input_login_lost"  name="mdplostpwd1" >
								</div>
								</td>
								</tr>
								<tr>
								<td >
								Confirmez votre mot de passe
								</td>
								<td>
								<input id="inputmdplostpwd2" type="password" value="" class="input_login_lost" name="mdplostpwd2" >
								</td>
								</tr>
								<tr>
								<td>
								&nbsp;
								</td>
								<td>
								<button style="background-color:#419641" id="button-mdplostValidate" name="button-Validate" class="btn-success" >VALIDER</button>
								</td>
								</tr>
								</table>';
		$aff .= '				</form>';
		$aff .= '				</div>';
		$aff .= '              <p>Un mail de validation vous sera envoyé à l&apos;adresse renseignée.
							   Merci de confirmer la mise à jour de votre nouveau mot de passe en cliquant sur le lien présent dans le mail.</p>';
		$aff .= '              <p>Vous pourrez alors vous connecter à l&apos;aide de votre nouveau mot de passe.</p>';		
		$aff .= '</div>';
	
		if ($msg == "MDP0")
		{
		//<!-- MDP0 -->';
		$aff .= '<!-- LINK THAT OPEN FANCYBOX -->
				<a href="#mdp0" id="mdp0_link" style="font-family:Fjalla One,helvetica,arial;font-size:12px;color:white;"></a>';
		$aff .= '<div id="mdp0" style="text-align:left;font-family:arial;font-size:12px;display:none;">';
		$aff .= '             <h1 style="color:#ee8b1e;">Changement d\'identifiants...</h1>';
		$aff .= '              <p><font style="color:#b91509;font-weight:bold;">'.$mdpfullname.'</br>A compter du xx/xx/xxxx vos identifiants ne seront plus actifs.</font><br/>Le Règlement général sur la protection des données (RGPD) nous impose de modifier</br> notre système de déclaration et d\'enregistrement des mots de passe.</br>
								<font style="color:#078cb7;font-weight:bold;">Ceux-ci doivent dorénavant être définis par les utilisateurs.</font></br></br>
								Par la même occasion, nous allons modifier votre identifiant de connexion qui sera remplacé</br>par votre adresse mail.</br>
								Merci de renseigner votre adresse mail et votre nouveau mot de passe:</p>';
		$aff .= '              <div>
								<form id="formmdp0"  action="?action=mdp0" method="POST" name="formmdp0" >
								<table width="100%">
								<tr>
								<td >
								Adresse mail de connexion
								</td>
								<td >
								<input id="inputmdp0mail" style="margin-bottom:5px;" type="email" required value="'.$mdpmail.'" class="input_login_lost" name="mdp0mail" >
								</td>
								</tr>
								<tr>
								<td >
								Mot de passe
								</td>
								<td>
								<div id="divPassword">
	  								<div class="password-meter">
		    							<div class="password-strength"></div>
		  							</div>
								<input id="inputmdp0pwd1" style="margin-top:0px;" type="password" value="" class="input_login_lost"  name="mdp0pwd1" >
	  							</div>
								</td>
								</tr>
								<tr>
								<td >
								Confirmez votre mot de passe
								</td>
								<td>
								<input id="inputmdp0pwd2" type="password" value="" class="input_login_lost" name="mdp0pwd2" >
								</td>
								</tr>
								<tr>
								<td>
								<button style="background-color:#419641" id="button-mdpValidate" name="button-Validate" class="btn-success" >VALIDER</button>
								</td>
								<td>
								<input type="hidden" name="username" id="username" value="'.$mdpuser.'">
								<input type="hidden" name="password" id="password" value="'.$mdppwd.'">
								<input type="hidden" name="origine" id="origine" value="MDP0">
								<button id="button-Validate" name="button-Later" class="btn-warning" type="submit">PLUS TARD</button>
								</td>
								</tr>
								</table>
								</form>
							  </div>';
		$aff .= '</div>';
		}
		
		if ($msg == "MDPV")
		{
		//<!-- MDPV -->';
		$aff .= '<!-- LINK THAT OPEN FANCYBOX -->
				<a href="#mdpv" id="mdpv_link" style="font-family:Fjalla One,helvetica,arial;font-size:12px;color:white;"></a>';
		$aff .= '<div id="mdpv" style="text-align:left;font-family:arial;font-size:12px;display:none;">';
		$aff .= '             <h1 style="color:#ee8b1e;">Renseignez votre mot de passe définitif...</h1>';
		$aff .= '              <p><font style="color:#b91509;font-weight:bold;">'.$mdpfullname.',</br>veuillez renseigner un mot de passe sur 8 caractères minimum.</font>
							   </p>';
		$aff .= '              <div>
								<form id="formmdpv"  action="?action=ajaxmotdepasseRgpdMDPV" method="POST" name="formmdpv" >
								<table width="100%">
								<tr>
								<td >
								Adresse mail de connexion
								</td>
								<td >
								<input id="inputmdp0mail" disabled style="margin-bottom:5px;" type="email" required value="'.$mdpmail.'" class="input_login_lost"  >
								</td>
								</tr>
								<tr>
								<td >
								Votre mot de passe
								</td>
								<td>
								<div id="divPassword">
	  								<div class="password-meter">
		    							<div class="password-strength"></div>
		  							</div>
								<input id="inputmdp0pwd1" style="margin-top:0px;" type="password" value="" class="input_login_lost"  name="mdp0pwd1" >
	  							</div>
								</td>
								</tr>
								<tr>
								<td >
								Confirmez votre mot de passe
								</td>
								<td>
								<input id="inputmdp0pwd2" type="password" value="" class="input_login_lost" name="mdp0pwd2" >
								</td>
								</tr>
								<tr>
								<td>
								&nbsp;
								</td>
								<td>
								<input type="hidden" name="mdp0mail" id="mdp0mail" value="'.$mdpmail.'">
								<input type="hidden" name="username" id="username" value="'.$mdpuser.'">
								<input type="hidden" name="password" id="password" value="'.$mdppwd.'">
								<input type="hidden" name="origine" id="origine" value="MDPV">
								<button style="background-color:#419641" id="button-mdpValidate" name="button-Validate" class="btn-success" >VALIDER</button>
								</td>
								</tr>
								</table>
								</form>
							  </div>';
		$aff .= '</div>';
		}
		
		if ($msg == "MDP1")
		{
		//<!-- MDP1 -->';
		$aff .= '<!-- LINK THAT OPEN FANCYBOX -->
				<a href="#mdp1" id="mdp1_link" style="font-family:Fjalla One,helvetica,arial;font-size:12px;color:white;"></a>';
		$aff .= '<div id="mdp1" style="text-align:left;font-family:arial;font-size:12px;display:none;">';
		$aff .= '             <h1 style="color:#ee8b1e;">Identifiants en attente de validation...</h1>';
		$aff .= '             <p><font style="color:#b91509;font-weight:bold;">'.$mdpfullname.'</br>Vous avez-fait une demande de changement d&apos;identifiants.</font><br/>Afin que ceux-ci soient actifs, il vous faut confirmer ce changement</br> en cliquant sur le lien de confirmation qui vous a été envoyé par mail à</br> l&apos;adresse <b>'.$mdpmail.'</b>.</p>
							  <p><font style="color:#078cb7;font-weight:bold;">Si vous souhaitez recevoir à nouveau le mail de confirmation,</br>veuillez cliquer sur le bouton ENVOYER.</font></p>';
		$aff .= '              <div>
								<form id="formmdp1"  action="?action=mdp1" method="POST" name="formmdp1" >
								<table width="100%">
								<tr>
								<td >
								Adresse mail
								</td>
								<td >
								<input id="inputmdp1mail" disabled style="margin-bottom:5px;" type="email" value="'.$mdpmail.'" class="input_login_lost" name="mdp1mail" >
								</td>
								</tr>
								<tr>
								<td>
								&nbsp;
								</td>
								<td>
								<input id="hidmdp1mail" type="hidden" name="hidmdp1mail" value="'.$mdpmail.'">
								<button id="button-Envoyer" name="button-Envoyer" class="btn-warning" type="submit">ENVOYER</button>
								</td>
								</tr>
								</table>
								</form>
							  </div>';
		$aff .= '</div>';
		}
		
		$aff .= '</div>';

		
		//qui Sommes nous
		$aff .= '<div class="quisommesnous" style="display:none;color:#fff;text-align:left;font-family:helvetica,arial;font-size: 15px;padding-left:30px;">
		<h1>&nbsp;</h1>
		<p style="text-align:justify;">Connectez-vous pour voir nos prix et profiter de notre <strong>outil de personnalisation en ligne</strong> pour vos drapeaux, porte-clés, signalétique et bien d’autres objets publicitaires.</p>
		<p style="text-align:justify;">CISCAR – 77-81 ter rue Marcel Dassault – 92100 Boulogne-Billancourt<br/>
		RCS Nanterre 327 643 797 – TVA CEE : FR 42 327 643 797  – SA au Capital de 375 200 €</p>
		<div class="about_left_content"> <a href="#" class="lienbtn0"><img src="include/images/fr_bouton_sinscrire.png" width="236" height="50" alt="S\'inscrire" border="0" align="left" /></a>
		<a href="#" class="lienbtn1"><img src="include/images/fr_bouton_se_connecter.png" width="235" height="50" alt="Se connecter" border="0" align="right" /></a>
		</div>
		<h1 style="color:#ee8b1e;font-family:arial;">Nous contacter</h1>
	    <p>Téléphone : 01 80 05 23 23
	    </br>Fax : 01 80 05 23 45
	    </br>Mail : <a href="mailto:infos@ciscar.fr" style="color:#ffc90a;">infos@ciscar.fr</a></p>
	    <p>&nbsp;</p>
		</div>';

		//Attention redirection
		$aff .= '<div class="attentionredirection" style="display:none;color:#fff;text-align:center;font-family:helvetica,arial;margin-top:140px">
		<div><a href="http://ciscar.channel-portal.com/?utm_source=Portail-CISCAR&utm_medium=Bouton_Continuer&utm_campaign=Accès+site+e-commerce+mode+visiteur" target="_blank"><img src="include/images/CISCAR_Bouton_continuer.png" width="235" height="50" alt="Continuer border="0" /></a>
		</div>
		</div>';

		//merci
		$aff .= '<div class="merci" style="display:none;color:#fff;text-align:center;font-family:helvetica,arial;margin-top:25px">
		<h1 style="color:#ee8b1e;font-family:arial;text-align:left;"><img src="include/images/check-bleu.gif" alt="Votre attention" width="68" height="68" align="absmiddle" /> Merci !</h1>
		<p style="text-align:justify;">Votre demande a bien été transmise et sera traitée dans les plus brefs délais.</p>
		<p style="text-align:justify;">Dans les <strong><font color="#4bff2d">24 HEURES</font></strong>, après validation de vos identifiants, un mail de confirmation va vous être envoyé pour finaliser votre inscription.</p>
		<p style="text-align:justify;">Dans l\'attente de vos codes d\'accès, nous pouvez d\'ores et déjà vous connecter à notre site E-commerce en mode <strong><font color="#4bff2d">VISITEUR</strong>, sans consultation des tarifs</font>.</p>
		<div>
		<a href="http://ciscar.channel-portal.com/?utm_source=Portail-CISCAR&utm_medium=Bouton_Continuer&utm_campaign=Accès+site+e-commerce+mode+visiteur" target="_blank">
		<button style="background-color:#419641" id="button-mdpValidate" name="button-Validate" class="btn-success" >Visitez le site e-commerce</button>
		</a>
		</div>
		</div>';		
		
		//codes de connexion
		$aff .= '<form enctype="multipart/form-data" method="POST" action="?action=souscrire">';
		$aff .= '<div class="row" style="margin-left:0px;margin-top:20px;">';
		$aff .= '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 codesdeconnexion" style="display:none;color:#fff;text-align:center;font-family:helvetica,arial;">';
		$aff .= '<input id="inputsmallfield" name="pNom" id="pNom" placeholder="Nom *" required type="text" >';
		$aff .= '<input id="inputsmallfield" name="pPrenom" id="pPrenom" placeholder="Pr&eacute;nom *" required type="text" >';
		$aff .= '<input id="inputsmallfield" name="pMail" id="pMail" placeholder="Adresse mail *" required type="text" >';
		$aff .= '<input id="inputsmallfield" name="pTelephone" id="pTelephone" placeholder="Téléphone *" required type="text" >';
		$aff .= '<input id="inputsmallfield" name="pPortable" id="pPortable" placeholder="Portable" type="text" >';
		$aff .= '<input id="inputsmallfield" name="pFonction" id="pFonction" placeholder="Votre Fonction *" required type="text" >';
		$aff .= '<input id="inputsmallfield" name="pMarque" id="pMarque" placeholder="Marques distribuées  *" required type="text" >';
		$aff .= '<input id="inputsmallfield" name="pCategorie" id="pCategorie" placeholder="Agent,  Concession, etc *" required type="text" >';
		$aff .= '</div>';
		$aff .= '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 codesdeconnexion" style="display:none;color:#fff;text-align:center;font-family:helvetica,arial;">';
		$aff .= '<input id="inputsmallfield" name="pRaisonSociale" id="pRaisonSociale" placeholder="Raison Sociale *" required type="text" >';
		$aff .= '<input id="inputsmallfield" name="pAdresse1" id="pAdresse1" placeholder="Adresse *" required type="text" >';
		$aff .= '<input id="inputsmallfield" name="pAdresse2" id="pAdresse2" placeholder="Complément adresse" type="text" >';
		$aff .= '<input id="inputsmallfield" name="pCodePostal" id="pCodePostal" placeholder="Code postal *" required type="text" >';
		$aff .= '<input id="inputsmallfield" name="pVille" id="pVille" placeholder="Ville *" required type="text" >';
		$aff .= '<input style="margin-bottom:10px;" id="inputsmallfield" name="pNumSiret" id="pNumSiret" placeholder="Numéro SIRET *" required type="text" >';

		$aff .= '<div class="input-group input-file">';
		$aff .= '<div class="form-control-input" style="white-space: nowrap;">';
		$aff .= '<a>Votre KBIS</a>';
		$aff .= '</div>';
		$aff .= '<span class="input-group-addon">';
		$aff .= '<a class="btn btn-primary" href="javascript:;">';
		$aff .= 'Parcourir';
		$aff .= '<input type="file" name="kbis" MAXLENGTH="512000" class="champ" onchange="$(this).parent().parent().parent().find(\'.form-control-input\').html($(this).val());">';
		$aff .= '</a>';
		$aff .= '</span>';
		$aff .= '</div>';
		
		$aff .= '<div class="input-group input-file" style="margin-top:10px;">';
		$aff .= '<div class="form-control-input" style="white-space: nowrap;">';
		$aff .= '<a>Votre RIB</a>';
		$aff .= '</div>';
		$aff .= '<span class="input-group-addon">';
		$aff .= '<a class="btn btn-primary" href="javascript:;">';
		$aff .= 'Parcourir';
		$aff .= '<input type="file" name="rib" MAXLENGTH="512000" class="champ" onchange="$(this).parent().parent().parent().find(\'.form-control-input\').html($(this).val());">';
		$aff .= '</a>';
		$aff .= '</span>';
		$aff .= '</div>';
		
		$aff .= '</div>';
		$aff .= '</div>';
		$aff .= '<div class="row">';
		$aff .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 codesdeconnexion" style="display:none;color:#fff;text-align:center;font-family:helvetica,arial;">';
		$aff .= '<input type="submit" name="submitButton" value="" class="fr_button_sinscrire" >';
		$aff .= '</div>';
		$aff .= '</div>';
		$aff .= '</form>';
						
		$aff .= '<div class="hidden-lg hidden-md col-sm-3 hidden-xs"></div>';
		$aff .= '</div>';
		$aff .= '</div>';
		$aff .= '</div>';
		$aff .= '</div>';

		//Liens bas de page
		$aff .= '<div class="row" style="background: #ffffff;margin-top:20px;margin-bottom:20px;" >';
		$aff .= '<div class="souscontainer">';
		$aff .= '<div class="col-lg-2 col-xs-12 liendiv0" style="color:#133d75;text-align:left;">';
		$aff .= '<label style="cursor:pointer;font-weight:normal;">Se connecter</label>';
		$aff .= '</div>';
		$aff .= '<div class="col-lg-3 col-xs-12 liendiv1" style="color:#133d75;text-align:left;">';
		$aff .= '<label style="cursor:pointer;font-weight:normal;">Pr&eacute;sentation de CISCAR</label>';
		$aff .= '</div>';
		$aff .= '<div class="col-lg-4 col-xs-12 liendiv2" style="color:#133d75;text-align:left;">';
		$aff .= '<label style="cursor:pointer;font-weight:normal;">Acc&eacute;der au site en mode "Visiteur"</label>';
		$aff .= '</div>';
		$aff .= '<div class="col-lg-3 col-xs-12 liendiv3" style="color:#133d75;text-align:left;">';
		$aff .= '<label style="cursor:pointer;font-weight:normal;">Demander des Codes de Connexion</label>';
		$aff .= '</div>';
		$aff .= '</div>';
		$aff .= '</div>';

		$aff .= '<div class="row" id="subfooter" style="background: #eeeeee;margin-top:20px;" >';

		// COOKIES
		$aff .= '
		<div id="cookieChoiceInfo" style="padding: 4px; padding-right:7px;margin-left: 0px; width: 100%; text-align: center; bottom: 0px; color: rgb(0, 0, 0);position:relative; z-index: 1000; background-color: rgb(233, 229, 224);font-family:helvetica,arial;">
		<span style="font-size:11px;">Ce site utilise Google Analytics. En continuant à naviguer, vous nous autorisez à déposer des cookies à des fins de mesure d\'audience.</span>
		</div>';
		
		//CONTACT
		$aff .= '<div class="souscontainer" style="margin-top:15px;">';
		$aff .= '<div class="col-lg-4 col-xs-12" style="text-align:center;">';
		$aff .= '<img alt="" src="include/images/if_commerical-building_103266.png" style="margin-left:0px;">';
		$aff .= '77 - 81 ter, rue Marcel Dassault</br>92100 Boulogne-Billancourt<br> ';
		$aff .= '<a href="?action=docStatic&id=172&Menu=0" style="text-decoration:underline;color:#004682;">Voir le plan d\'acc&egrave;s</a>';
		$aff .= '</div>';
		$aff .= '<div class="col-lg-4 col-xs-12" style="text-align:center">';
		$aff .= '<img alt="" src="include/images/icon-phone.png" style="margin-left:0px;">';
		$aff .= '01 80 05 23 23';
		$aff .= '</div>';
		$aff .= '<div class="col-lg-4 col-xs-12" style="text-align:center;">';
		$aff .= '<img alt="" src="include/images/if_008_Mail_183573.png" style="margin-left:0px;">&nbsp;';
		$aff .= '<a href="mailto:infos@ciscar.fr" style="text-decoration:underline;color:grey;">infos@ciscar.fr</a>';
		$aff .= '</div>';
		$aff .= '</div>';
		$aff .= '</div>';		
		
		
		$aff .= '</div>';		

		
		// GOOGLE ANALYTICS
		$aff .= '<script type="text/javascript">
				
				var _gaq = _gaq || [];
				_gaq.push([\'_setAccount\', \'UA-27893097-2\']);
				_gaq.push([\'_trackPageview\']);
				
				(function() {
					var ga = document.createElement(\'script\'); 
					ga.type = \'text/javascript\'; 
					ga.async = true;
					ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
					var s = document.getElementsByTagName(\'script\')[0]; 
					s.parentNode.insertBefore(ga, s);
				})();
				
				</script>';
		
		// SLIDESHOW
		$aff .= '<script type="text/javascript" src="include/slick/slick.min.js"></script>';
		$aff .= '
			<script type="text/javascript">
			jQuery(document).ready(function(){
      			$(".slideshow").slick({
        			slidesToShow: 1,
  					slidesToScroll: 1,
  					autoplay: true,
  					autoplaySpeed: 3000,
					fade: true,
					speed:4000,
					cssEase: \'linear\',
					infinite: true,
					arrows:false
      			});
    		});

				
			</script>';
		
		//Passwor meters
		$aff .= '
			<script type="text/javascript">
			jQuery(document).ready(function(){
				$("#divPassword").PasswordMeter();
				$("#divPasswordlost").PasswordMeter();
			});
			</script>';
		
		//Mot de passe statut
		$aff .= '<script type="text/javascript">
		$( document ).ready(function() {';
		if ($msg == 'MDP0')
			$aff .= '$("#mdp0_link").trigger("click");';
		if ($msg == 'MDP1')
			$aff .= '$("#mdp1_link").trigger("click");';
		if ($msg == 'MDPV')
			$aff .= '$("#mdpv_link").trigger("click");';
		if ($msg == 'MDP2')
		{
			$redirect = '';
			if ($mdp2msg == 'ok' || $mdp2msg == 'okciscom')
			{
			if ($mdp2msg == 'okciscom')
				$redirect = '<a href="http://marketing.cis-com.eu" style="font-weight: bold;font-style: italic;"><b>marketing.cis-com.eu</bB</a>';
			else
				$redirect = '<a href="http://www.ciscar.fr">ciscar.fr</a>';
			$aff .= '					    
			$.confirm({
				title: \'<label style="font-family:arial;color:#444;">La validation de vos identifiants est confirmée.</label>\',
					        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Connectez-vous sans plus attendre sur '.$redirect.'</label>\',
					        type: \'green\',
					        typeAnimated: true,
							boxWidth: \'25%\',
							useBootstrap: false,
					        buttons: {
					            tryAgain: {
					                text: \'<span style="font-family:arial;text-transform: none;">Fermer</span>\',
					                btnClass: \'btn-green\',
					                action: function(){
					                }
					            }
					        }
					    });';		
			}
			else 
			{
			$aff .= '
			$.confirm({
				title: \'<label style="font-family:arial;color:#444;">Validation impossible</label>\',
					        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Problème rencontré lors de la validation de vos identifiants.</label>\',
					        type: \'red\',
					        typeAnimated: true,
							boxWidth: \'25%\',
							useBootstrap: false,
					        buttons: {
					            tryAgain: {
					                text: \'<span style="font-family:arial;text-transform: none;">Fermer</span>\',
					                btnClass: \'btn-red\',
					                action: function(){
					                }
					            }
					        }
					    });';
				}
			}
			$aff .= '});
		   </script>';
			
			$aff .= '<script type="text/javascript">';
			// expression reguliere pour validation email
			$aff .= 'var expressionReguliere = /^(([^<>()[]\.,;:s@]+(.[^<>()[]\.,;:s@]+)*)|(.+))@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}])|(([a-zA-Z-0-9]+.)+[a-zA-Z]{2,}))$/;';

			// validation identifiants oubliés
			$aff .= '$( "#button-mdplostValidate" ).on( "click", function() {
			$("#inputmdplostpwd2").css("border-color", "#878484");
			$("#inputmdplostpwd1").css("border-color", "#878484");
				
			var mdplostmail = $("#inputmdplostmail").val();
			var mdplostpwd1 = $("#inputmdplostpwd1").val();
			var mdplostpwd2 = $("#inputmdplostpwd2").val();
				
			frmlostok ="ok";
			if(mdplostmail == ""){
				$("#inputmdplostmail").css("border-color", "red");
				frmlostok ="ko";
			}
			if(mdplostpwd1 == ""){
				$("#inputmdplostpwd1").css("border-color", "red");
				frmlostok ="ko";
			}
			if(mdplostpwd2 == ""){
				$("#inputmdplostpwd2").css("border-color", "red");
				frmlostok ="ko";
			}
			if(mdplostpwd1 != mdplostpwd2){
				$("#inputmdplostpwd2").css("border-color", "red");
				frmlostok ="ko";
			}

			if (mdplostmail != "" && !expressionReguliere.test(mdplostmail))
			{ 
			    $.confirm({
			        title: \'<label style="font-family:arial;color:#444;">Adresse mail invalide</label>\',
			        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Veuillez saisir une adresse mail valide.</label>\',
			        type: \'red\',
			        typeAnimated: true,
					boxWidth: \'20%\',
					useBootstrap: false,
			        buttons: {
			            tryAgain: {
			                text: \'<span style="font-family:arial;text-transform: none;">Réessayer</span>\',
			                btnClass: \'btn-red\',
			                action: function(){
			                }
			            }
			        }
			    });
				frmlostok = "ko";
			}
				
			if (frmlostok == "ko")
				return false;
			
			if ($("#divPasswordlost .password-strength").width() / $("#divPasswordlost .password-meter").width() * 100 < 54)
			{
		    $.confirm({
		        title: \'<label style="font-family:arial;color:#444;">Erreur sur Mot de passe!</label>\',
		        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">8 caractères minimum. Mélange de majuscules, de chiffres ou de caractères spéciaux.</label>\',
		        type: \'red\',
		        typeAnimated: true,
				boxWidth: \'20%\',
				useBootstrap: false,
		        buttons: {
		            tryAgain: {
		                text: \'<span style="font-family:arial;text-transform: none;">Réessayer</span>\',
		                btnClass: \'btn-red\',
		                action: function(){
		                }
		            }
		        }
		    });
			return false;
			}
				
			$.ajax({';
			if ($msg == 'ciscom')
					$aff .= 'url: "/index.php?action=ajaxmotdepasseLostciscom",';
				else
					$aff .= 'url: "/index.php?action=ajaxmotdepasseLost",';
				$aff .= '
				type: "POST",
				data:"mdplostmail="+mdplostmail+"&mdplostpwd1="+mdplostpwd1+"&button-Validate=ok",
				dataType : "html",
				success: function(code_html, statut){
					if(code_html=="ok")
					{
						parent.$.fancybox.close();
					    $.confirm({
					        title: \'<label style="font-family:arial;color:#444;">Le changement de vos identifiants a été pris en compte.</label>\',
					        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Nous venons de vous envoyer un mail de confirmation.<br/>Merci de vérifier votre boite de réception (ou courrier indésirable).</label>\',
					        type: \'green\',
					        typeAnimated: true,
							boxWidth: \'25%\',
							useBootstrap: false,
					        buttons: {
					            tryAgain: {
					                text: \'<span style="font-family:arial;text-transform: none;">Fermer</span>\',
					                btnClass: \'btn-green\',
					                action: function(){
					                }
					            }
					        }
					    });
					}
					else
					{
						if(code_html=="ko+")
						{
						    $.confirm({
						        title: \'<label style="font-family:arial;color:#444;">Erreur lors de la prise en compte de vos nouveaux identifiants</label>\',
						        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Adresse mail renseignée sur plusieurs comptes.</label>\',
						        type: \'red\',
						        typeAnimated: true,
								boxWidth: \'20%\',
								useBootstrap: false,
						        buttons: {
						            tryAgain: {
						                text: \'<span style="font-family:arial;text-transform: none;">Réessayer</span>\',
						                btnClass: \'btn-red\',
						                action: function(){
						                }
						            }
						        }
						    });
						}
						else
						{
						    $.confirm({
						        title: \'<label style="font-family:arial;color:#444;">Erreur lors de la prise en compte de vos nouveaux identifiants</label>\',
						        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Adresse mail inexistante.</label>\',
						        type: \'red\',
						        typeAnimated: true,
								boxWidth: \'20%\',
								useBootstrap: false,
						        buttons: {
						            tryAgain: {
						                text: \'<span style="font-family:arial;text-transform: none;">Réessayer</span>\',
						                btnClass: \'btn-red\',
						                action: function(){
						                }
						            }
						        }
						    });
						}

					}
				},
				error : function(resultat, statut, erreur){
					    $.confirm({
					        title: \'<label style="font-family:arial;color:#444;">Problème à l&apos;enregistrement de vos nouveaux identifiants.</label>\',
					        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Vos nouveaux identifiants n&apos;ont pu être pris en compte<br>Veuillez réessayer ou nous contacter au 01 80 05 23 53.</label>\',
					        type: \'red\',
					        typeAnimated: true,
							boxWidth: \'20%\',
							useBootstrap: false,
					        buttons: {
					            tryAgain: {
					                text: \'<span style="font-family:arial;text-transform: none;">Réessayer</span>\',
					                btnClass: \'btn-red\',
					                action: function(){
					                }
					            }
					        }
					    });
				}
			});
			return false;
				
			});';

			// validation envoyer confirmation
			$aff .= '$( "#button-Envoyer" ).on( "click", function() {					

			var hidmdp1mail = $("#hidmdp1mail").val();
										
			$.ajax({
				url: "/index.php?action=mdp1",
				type: "POST",
				data:"hidmdp1mail="+hidmdp1mail+"&button-Envoyer=ok",
				dataType : "html",
				success: function(code_html, statut){
					if(code_html=="ok")
					{
						parent.$.fancybox.close();
					    $.confirm({
					        title: \'<label style="font-family:arial;color:#444;">Envoi du mail de confirmation...</label>\',
					        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Nous venons de vous envoyer un mail de confirmation.<br/>Merci de vérifier votre boite de réception (ou courrier indésirable).</label>\',
					        type: \'green\',
					        typeAnimated: true,
							boxWidth: \'25%\',
							useBootstrap: false,
					        buttons: {
					            tryAgain: {
					                text: \'<span style="font-family:arial;text-transform: none;">Fermer</span>\',
					                btnClass: \'btn-green\',
					                action: function(){
					                }
					            }
					        }
					    });
					}
					else
					{
						if(code_html=="ko+")
						{
						    $.confirm({
						        title: \'<label style="font-family:arial;color:#444;">Erreur confirmation.</label>\',
						        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Adresse mail renseignée sur plusieurs comptes.</label>\',
						        type: \'red\',
						        typeAnimated: true,
								boxWidth: \'20%\',
								useBootstrap: false,
						        buttons: {
						            tryAgain: {
						                text: \'<span style="font-family:arial;text-transform: none;">Réessayer</span>\',
						                btnClass: \'btn-red\',
						                action: function(){
						                }
						            }
						        }
						    });
						}
						else
						{
						    $.confirm({
						        title: \'<label style="font-family:arial;color:#444;">Erreur confirmation.</label>\',
						        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Adresse mail inexistante.</label>\',
						        type: \'red\',
						        typeAnimated: true,
								boxWidth: \'20%\',
								useBootstrap: false,
						        buttons: {
						            tryAgain: {
						                text: \'<span style="font-family:arial;text-transform: none;">Réessayer</span>\',
						                btnClass: \'btn-red\',
						                action: function(){
						                }
						            }
						        }
						    });
						}
					
					}
				},
				error : function(resultat, statut, erreur){
					    $.confirm({
					        title: \'<label style="font-family:arial;color:#444;">Problème lors de l&apos;envoi du mail de confirmation.</label>\',
					        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Veuillez réessayer ou nous contacter au 01 80 05 23 53.</label>\',
					        type: \'red\',
					        typeAnimated: true,
							boxWidth: \'20%\',
							useBootstrap: false,
					        buttons: {
					            tryAgain: {
					                text: \'<span style="font-family:arial;text-transform: none;">Réessayer</span>\',
					                btnClass: \'btn-red\',
					                action: function(){
					                }
					            }
					        }
					    });
				}
			});
			return false;
					
			});';
			
			
		// Validation mot de passe RGPD
		//$aff .= '$(function() {
		$aff .= '$( "#button-mdpValidate" ).on( "click", function() {
			$("#inputmdp0pwd2").css("border-color", "#878484");
			$("#inputmdp0pwd1").css("border-color", "#878484");
				
			var mdp0mail = $("#inputmdp0mail").val();
			var mdp0pwd1 = $("#inputmdp0pwd1").val();
			var mdp0pwd2 = $("#inputmdp0pwd2").val();
			var username = $("#username").val();
			var password = $("#password").val();
			var ajaxurl = "";
			if ($("#origine") == "MDP0")
			{
				ajaxurl = "/index.php?action=ajaxmotdepasseRgpdMDP0";
			}
			if ($("#origine") == "MDPV")
			{
				ajaxurl = "/index.php?action=ajaxmotdepasseRgpdMDPV";
			}
			frmok ="ok";
			if(mdp0mail == ""){
				$("#inputmdp0mail").css("border-color", "red");
				frmok ="ko";
			}			
			if(mdp0pwd1 == ""){
				$("#inputmdp0pwd1").css("border-color", "red");
				frmok ="ko";
			}
			if(mdp0pwd2 == ""){
				$("#inputmdp0pwd2").css("border-color", "red");
				frmok ="ko";
			}
			if(mdp0pwd1 != mdp0pwd2){
				$("#inputmdp0pwd2").css("border-color", "red");
				frmok ="ko";
			}

			if (mdp0mail != "" && !expressionReguliere.test(mdp0mail))
			{ 
			    $.confirm({
			        title: \'<label style="font-family:arial;color:#444;">Adresse mail invalide</label>\',
			        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Veuillez saisir une adresse mail valide.</label>\',
			        type: \'red\',
			        typeAnimated: true,
					boxWidth: \'20%\',
					useBootstrap: false,
			        buttons: {
			            tryAgain: {
			                text: \'<span style="font-family:arial;text-transform: none;">Réessayer</span>\',
			                btnClass: \'btn-red\',
			                action: function(){
			                }
			            }
			        }
			    });
				frmok = "ko";
			}

			if (frmok == "ko")
				return false;

			if ($("#divPassword .password-strength").width() / $("#divPassword .password-meter").width() * 100 < 54)
			{
		    $.confirm({
		        title: \'<label style="font-family:arial;color:#444;">Erreur sur Mot de passe!</label>\',
		        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">8 caractères minimum. Mélange de majuscules, de chiffres ou de caractères spéciaux.</label>\',
		        type: \'red\',
		        typeAnimated: true,
				boxWidth: \'20%\',
				useBootstrap: false,
		        buttons: {
		            tryAgain: {
		                text: \'<span style="font-family:arial;text-transform: none;">Réessayer</span>\',
		                btnClass: \'btn-red\',
		                action: function(){
		                }
		            }
		        }
		    });
			return false;
			}

			$.ajax({
				url: ajaxurl,
				type: "POST",
				data:"mdp0mail="+mdp0mail+"&mdp0pwd1="+mdp0pwd1+"&username="+username+"&password="+password+"&button-Validate=ok",
				dataType : "html",
				success: function(code_html, statut){
					if(code_html=="ok")
					{					
						parent.$.fancybox.close();
					    $.confirm({
					        title: \'<label style="font-family:arial;color:#444;">Le changement de vos identifiants a été pris en compte.</label>\',
					        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Vous pouvez désormais vous connecter à l&apos;aide de votre adresse mail et de votre nouveau mot de passe.</label>\',
					        type: \'green\',
					        typeAnimated: true,
							boxWidth: \'20%\',
							useBootstrap: false,
					        buttons: {
					            tryAgain: {
					                text: \'<span style="font-family:arial;text-transform: none;">Fermer</span>\',
					                btnClass: \'btn-green\',
					                action: function(){
					                }
					            }
					        }
					    });
					}
					else
					{
					    $.confirm({
					        title: \'<label style="font-family:arial;color:#444;">Erreur lors de la prise en compte de vos nouveaux identifiants</label>\',
					        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Adresse mail déjà renseignée sur un autre compte.</label>\',
					        type: \'red\',
					        typeAnimated: true,
							boxWidth: \'20%\',
							useBootstrap: false,
					        buttons: {
					            tryAgain: {
					                text: \'<span style="font-family:arial;text-transform: none;">Réessayer</span>\',
					                btnClass: \'btn-red\',
					                action: function(){
					                }
					            }
					        }
					    });
					}
				},
				error : function(resultat, statut, erreur){
					    $.confirm({
					        title: \'<label style="font-family:arial;color:#444;">Problème à l&apos;enregistrement de vos nouveaux identifiants.</label>\',
					        content: \'<label style="font-family:arial;text-align:left;font-weight: normal;color:#444">Vos nouveaux identifiants n&apos;ont pu être pris en compte<br>Veuillez réessayer ou nous contacter au 01 80 05 23 53.</label>\',
					        type: \'red\',
					        typeAnimated: true,
							boxWidth: \'20%\',
							useBootstrap: false,
					        buttons: {
					            tryAgain: {
					                text: \'<span style="font-family:arial;text-transform: none;">Réessayer</span>\',
					                btnClass: \'btn-red\',
					                action: function(){
					                }
					            }
					        }
					    });
				}
			});
			return false;

			});';
		
		$aff .= '</script>';

		
		$aff .= '</body>';
		$aff .= '</html>';
		print $aff;
		die();
		return $aff;
	}
}
?>