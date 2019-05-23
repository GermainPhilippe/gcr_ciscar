<?php
class Doc_AttentionRedirection {
	public function __construct() {
	}
	public function render2HTML() {
		$aff = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Login_ciscar.dwt" codeOutsideHTMLIsLocked="false" -->
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<META NAME="robots" CONTENT="noindex,nofollow">
				<!-- InstanceBeginEditable name="doctitle" -->';
		$aff .= '<title>Accès CISCAR : Redirection vers le site E-commerce</title>';
		$aff .= '<!-- InstanceEndEditable -->
				<link rel="stylesheet" type="text/css" href="include/css/styles.css" media="screen" />
				<meta name="description" content="CISCAR, Centrale d\'Achats des réseaux automobiles." />
				<meta name="robots" content="index, follow" />
				<link rel="icon" href="../favicon.ico" />
				<!-- InstanceBeginEditable name="head" -->
				<!-- InstanceEndEditable -->
				</head>';
		
		$aff .= '<body>

				<div id="bandeau">
				  <div style="float:left;">CISCAR, Centrale d’Achats des Réseaux Automobiles</div>
				</div>

				<div class="clearboth"></div>

				<div id="wrapper">
					<div id="container">
						<div id="logo"><a href="index.php"><img src="include/images/logo_CISCAR.jpg" width="293" height="110" alt="CISCAR, votre Centrale d\'Achats" /></a></div>
						
						<div class="clearboth"></div>
					
						<div id="filigrane">

				<!-- InstanceBeginEditable name="region_editable" -->

						<table cellpadding="0" cellspacing="0">
							<tr>
							<td style="border-right:solid 1px #FFFFFF;" valign="top">
							<div class="about_left_content">
							  <h1><img src="include/images/attention-orange.gif" alt="Votre attention" width="68" height="68" align="absmiddle" /> Votre attention</h1>
							  <p>Vous allez être redirigé vers notre site E-commerce <strong><u>SANS</u></strong> affichage des prix.</p>
							  <p>Pour consulter les tarifs et commander en ligne, <a href="index.php">connectez-vous</a> ou <a href="?action=souscrire">inscrivez-vous</a>.</p>
							  <p>&nbsp;</p>
							</div>
						   </td>
							<td>
						  <tr>
						   <td>
							   <div class="about_left_content"><a href="http://ciscar.channel-portal.com/?utm_source=Portail-CISCAR&utm_medium=Bouton_Continuer&utm_campaign=Accès+site+e-commerce+mode+visiteur" target="_blank"><img src="include/images/CISCAR_Bouton_continuer.jpg" width="235" height="50" alt="Continuer border="0" /></a>
							   </div>
							</td>
							<td>&nbsp;</td>
							</tr>
							</table>
							
							
							<div class="banniere_pub">
							</div>
            
					<!-- InstanceEndEditable --></div>
							
											<div id="footer"><a href="index.php">Se connecter</a>  |   <a href="?action=souscrire">S’inscrire</a>  |  <a href="?action=quisommesnous">Qui sommes-nous</a></div>
						</div>

									<img src="include/images/bg_footer.jpg" width="1209" height="145" alt="Footer" border="0" />

					</div>';
		
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
					
					</script>
			</body>
			<!-- InstanceEnd --></html>';
		return $aff;
	}
}
?>