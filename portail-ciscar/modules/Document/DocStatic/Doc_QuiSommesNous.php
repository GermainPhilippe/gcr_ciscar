<?php
class Doc_QuiSommesNous {
	public function __construct() {
	}
	public function render2HTML() {
		$aParam = new Param ();
		$aParam->search_param ( 'CISCAR_PUB_HOMEPAGE_IMAGE' );
		$aParam2 = new Param ();
		$aParam2->search_param ( 'CISCAR_PUB_HOMEPAGE_URL' );
		
		$aff = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Login_ciscar.dwt" codeOutsideHTMLIsLocked="false" -->
				<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<meta name="description" content="CISCAR propose des produits et des services adaptés aux métiers de l’automobile. Conseil, réactivité et rapport qualité / prix sont les maîtres mots de la Centrale d’Achats."/>
				<!-- InstanceBeginEditable name="doctitle" -->';
		$aff .= '<title>CISCAR : Découvrez qui nous sommes</title>';
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
							<div class="about_left_content" style="margin-left:20px;margin-right:20px;">
							  <h1>Qui sommes-nous ?</h1>
							  <p>Depuis près de 50 ans, CISCAR propose des produits et des services adaptés aux métiers de l’automobile avec 3 grandes familles de produits :</p>
							  <p>- <strong>Informatique</strong> pour renouveler ou compléter votre équipement (poste vendeur, imprimantes, serveurs, écrans, PC, onduleurs, connectiques, accessoires, etc.).</p>
							  <p>- <strong>Matériel de garage</strong> pour investir dans de l’outillage pérenne et rentable (ponts élévateur, clip diagnostic, géométrie, démonte pneus, extraction, vestiaires, équipement du compagnon, etc.).</p>
							  <p>- <strong>Merchandising & Aménagement </strong> pour développer votre image et votre communication (cartes de visite, porte-clés, OR, factures, papier blanc, PLV, signalétique, mobilier, téléphonie, ballons, etc.).</p>
							  <p>- Papeterie : cartes de visite, papiers à entête, enveloppes, ...</p>
							  <p>- Opérations mailing.</p>
							  <p><strong>Conseil, réactivité et rapport qualité / prix</strong> sont les maîtres mots de CISCAR.</p>
							  <p>Connectez-vous pour voir nos prix et profiter de notre <strong>outil de personnalisation en ligne</strong> pour vos drapeaux, porte-clés, signalétique et bien d’autres objets publicitaires.</p>
				<p>CISCAR – 77-81 ter rue Marcel Dassault – 92100 Boulogne-Billancourt<br/>
							  RCS Nanterre 327 643 797 – TVA CEE : FR 42 327 643 797  – SA au Capital de 375 200 €</p>
							  <p>&nbsp;</p>
							</div>
						   </td>
							<td style="border-left:solid 1px #b4b4b4; width:50%;" valign="top">
							<div class="about_right_content">
							  <h1>Nous contacter</h1>
							  <p>Téléphone : 01 80 05 23 23</p>
							  <p>Fax : 01 80 05 23 45</p>
							  <p>Mail : <a href="mailto:infos@ciscar.fr">infos[@]ciscar.fr</a></p>
							  <p>&nbsp;</p>
				</div>
						   <tr>
						   <td style="text-align:right;">
							   <a href="?action=souscrire"><img src="include/images/fr_bouton_sinscrire.jpg" width="236" height="50" alt="S\'inscrire" border="0" align="right" /></a>							   
							</td>
						   <td style="text-align:left;">
							   <a href="index.php"><img src="include/images/fr_bouton_se_connecter.jpg" width="235" height="50" alt="Se connecter" border="0" align="left" /></a>						
							</td>
							</tr>
							</table>
				
				
							<div class="banniere_pub">';
		// PUB
		if ($aParam->getValue () != '') {
			$aff .= '<a href="' . $aParam2->getValue () . '" ><img src="' . $aParam->getValue () . '" width="728" height="90" alt="Vos cartes en quelques clics !" border="0"></a>';
		}
		$aff .= '</div>
				
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