<?php
/**
 * @author Florent DESPIERRES
 * @package portail-Ciscar
 * @subpackage commun
 * @version 1.0.4
 */
class HomePageMaintenance {
	public function __construct() {
	}
	public function renderHTML($msg = Null, $urlReturn = Null) {

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
		
		//bootstrap 
		$aff .= '<link href="include/bootstrap/css/bootstrap.css" rel="stylesheet">';
		$aff .= '<link href="include/bootstrap/css/bootstrap-theme.css" rel="stylesheet">';
		$aff .= '<script src="include/bootstrap/js/bootstrap.js"></script>';

		$aff .= '<link rel="stylesheet" type="text/css" media="screen" href="include/css/CommunLayout.css" />';
		$aff .= '<link rel="stylesheet" type="text/css" media="screen" href="include/css/styles.css" />';
		
		
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
		
			if ($msg=='merci')
				{
					$aff .= '
						$(".codesdeconnexion").css("display", "none");
						$(".merci").fadeIn(1000);
					';
				}
			$aff .= '
			};	
			function extractFilename(path) {
				alert(path.substr(0, 12));
			    var x;
				x = path.substr(0, 12);
				if (x == "C:\\\fakepath\\\")
			        return path.substr(12); 
			    x = path.lastIndexOf(\'/\');
			    if (x >= 0) 
			        return path.substr(x+1);
			    x = path.lastIndexOf("\\\");
			    if (x >= 0) 
			        return path.substr(x+1);
			    return path; 
			}				
			
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
		</script>';
				
		$aff .= '</head>';
		$aff .= '<body>';
		$aff .= '<div class="container" style="margin-top:0px;">';
		$aff .= '<div class="col-lg-6 col-md-6 hidden-sm hidden-xs header" style="color:#ffffff;margin-left:-15px;padding-bottom:5px;padding-top:10px;float:left;">';
		//if ($urlReturn !== Null)
			//$aff .= '<div style="float:right;"><a href="javascript: ciscarnl(\'' . $urlReturn . '\')">ciscarnl</a></div>';
			// $aff .= '<div style="float:right;"><a href="javascript: geolane(\''.$urlReturn.'\')">geolane</a></div>';
		//else
			// $aff .= '<div style="float:right;"><a href="javascript: geolane(\'\')">geolane</a></div>';
			//$aff .= '<div style="float:right;"><a href="javascript: ciscarnl(\'\')">ciscarnl</a></div>';
		$aff .= '</div>';
		
		$aff .= '<div class="col-lg-6 col-md-6 hidden-sm hidden-xs header" style="color:#ffffff;margin-left:15px;padding-bottom:5px;padding-top:15px;text-align:right;"><p>SITE EN MAINTENANCE</p></div>';
		
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
		$aff .= 'float:none;padding-right:15px;padding-left:15px;max-width:480px;">';
		
		// image maintenance
		$aff .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<img class="img-responsive center-block" src="include/images/201901_Site_maintenance_portail.jpg"/>
				</div>';
		
		$aff .= '<!-- LOGIN LOST -->';
		$aff .= '<div style="display:none;"><div id="login_lost" style="text-align:left;font-family:arial;font-size:12px;">';
		$aff .= '             <h1 style="color:#ee8b1e;">Mot de passe oublié ?</h1>';
		$aff .= '              <p>Vous avez perdu ou oublié votre mot de passe ?<br/>Indiquez votre adresse e-mail ci-dessous pour le recevoir à nouveau :</p>';
		$aff .= '              <div><form id="formmotdepasseperdu"  action="?action=motdepasseperdu" method="POST" name="motdepasseperdu" ><input type="text" value="" class="input_login_lost" id="mail" name="mail" /><input type="submit" value="" name="submitButton" class="fr_bouton_envoyer"/></form></div>';
		
		$aff .= '               <div class="clearboth"></div>';
		$aff .= '              <div id="login_lost_error" class="display_none">Adresse e-mail introuvable ...<br /><a href="?action=premierevisite"> Demander mes codes</a></div>';
		$aff .= '             <div id="login_lost_success" class="display_none">Nous venons de vous envoyer un e-mail avec votre mot de passe.<br/>Merci de vérifier votre boite de réception (ou courrier indésirable).</div>';
		$aff .= '</div></div>';
		
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
		$aff .= '<div class="merci" style="display:none;color:#fff;text-align:center;font-family:helvetica,arial;margin-top:50px">
		<h1 style="color:#ee8b1e;font-family:arial;text-align:left;"><img src="include/images/check-bleu.gif" alt="Votre attention" width="68" height="68" align="absmiddle" /> Merci !</h1>
		<p style="text-align:justify;">Votre demande a bien été envoyée et sera traitée dans les plus brefs délais.<br/>
		Dans l\'attente de vos codes d\'accès, nous vous invitons à  visiter notre site E-commerce.</p>
		<div><a href="http://ciscar.channel-portal.com/?utm_source=Portail-CISCAR&utm_medium=Bouton_Continuer&utm_campaign=Accès+site+e-commerce+mode+visiteur" target="_blank"><img src="include/images/CISCAR_Bouton_continuer.png" width="235" height="50" alt="Continuer border="0" /></a>
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


		$aff .= '<div class="row" id="subfooter" style="background: #eeeeee;margin-top:0px;" >';

		// COOKIES
		$aff .= '<div class="row">
		<div id="cookieChoiceInfo" style="padding: 4px; padding-right:7px;margin-left: 0px; width: 100%; text-align: center; bottom: 0px; color: rgb(0, 0, 0);position:relative; z-index: 1000; background-color: rgb(233, 229, 224);font-family:helvetica,arial;">
		<span style="font-size:11px;">Ce site utilise Google Analytics. En continuant à naviguer, vous nous autorisez à déposer des cookies à des fins de mesure d\'audience.</span>
		</div>
		</div>';
		
		//CONTACT
		$aff .= '<div class="souscontainer" style="margin-top:15px;">';
		$aff .= '<div class="col-lg-4 col-xs-12" style="text-align:center;">';
		$aff .= '<img alt="" src="include/images/if_commerical-building_103266.png" style="margin-left:0px;">';
		$aff .= '77 - 81 ter, rue Marcel Dassault</br>92100 Boulogne-Billancourt<br> ';
		$aff .= '<a href="?action=docStatic&id=164&Menu=0" style="text-decoration:underline;color:#004682;">Voir le plan d\'acc&egrave;s</a>';
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
		
		// Mot de passe oublier
		$aff .= '<script type="text/javascript">
		$("#formmotdepasseperdu").on("submit", function() {
			var mail = $("#mail").val();
			if(mail == "") {
				alert("Le champs doit êtres remplis");
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
							$("#login_lost_success").hide();
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

		
		$aff .= '</body>';
		$aff .= '</html>';
		print $aff;
		die();
		return $aff;
	}
}
?>