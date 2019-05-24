<?php
class MenuModuleView {
	private $myRules;
	private $myMenuID;
	public function __construct($aRules, $menuID) {
		$this->myRules = $aRules;
		$this->myMenuID = $menuID;
	}
	public function renderHTML() {
		switch ($this->myMenuID) {
			case '1' :
				echo '<div><table border="1"><tr>';
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['General'] ['Paramètres'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['General'] ['Paramètres'] )) {
					echo $this->renderTabGeneralParametres ();
				}
				if ($_SESSION ['SITE'] ['ID'] != 7) {
					if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['General'] ['LCA'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['General'] ['LCA'] )) {
						echo $this->renderTabGeneralLCA ();
					}
				}
				if ($_SESSION ['SITE'] ['ID'] != 7) {
					if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['General'] ['Export'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['General'] ['Export'] )) {
						echo $this->renderTabGeneralExport ();
					}
				}
				echo $this->renderTabListOutlook ();
				echo '</tr><tr>';
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['General'] ['Anomalie'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['General'] ['Anomalie'] )) {
					echo $this->renderTabGeneralAnomalie ();
				}

				echo $this->renderTabBiblioMedia ();
				echo $this->renderTabGeneralImport ();
				echo '</tr></table></div>';
				break;
			case '2' :
				echo '<div><table border="1"><tr>';
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Site'] ['Individu'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Site'] ['Individu'] )) {
					echo $this->renderTabSiteIndividu ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Site'] ['Role'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Site'] ['Role'] )) {
					echo $this->renderTabSiteRole ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Site'] ['Etablissement'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Site'] ['Etablissement'] )) {
					echo $this->renderTabSiteEtablissement ();
				}
				echo '</tr><tr>';
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Site'] ['Liste de Valeurs'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Site'] ['Liste de Valeurs'] )) {
					echo $this->renderTabSiteListeDeValeurs ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Site'] ['Mail'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Site'] ['Mail'] )) {
					echo $this->renderTabSiteMail ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Site'] ['Autologin'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Site'] ['Autologin'] )) {
					echo $this->renderTabSiteAutologin ();
				}
				echo '</tr><tr>';
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Site'] ['Liste diffusion'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Site'] ['Liste diffusion'] )) {
					echo $this->renderTabSiteListeDiffusion ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Site'] ['Newsletter'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Site'] ['Newsletter'] )) {
					echo $this->renderTabSiteNewsletter ();
				}
				// if(in_array($_SESSION['ADMIN']['USER']['ISADMINISTRATEURS'], $this->myRules['Site']['Newsletter']) || in_array($_SESSION['ADMIN']['USER']['ISGESTIONNAIRES'], $this->myRules['Site']['Newsletter']))
				// {
				// echo $this->renderTabSiteArticles();
				// }
				echo '</tr></table></div>';
				break;
			case '3' :
				echo '<div><table border="1"><tr>';
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['WebContent'] ['Catégorie'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['WebContent'] ['Catégorie'] )) {
					echo $this->renderTabWebContentCategorie ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['WebContent'] ['Bannière'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['WebContent'] ['Bannière'] )) {
					echo $this->renderTabWebContentBanniere ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['WebContent'] ['Partenaires'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['WebContent'] ['Partenaires'] )) {
					echo $this->renderTabWebContentPartenaire ();
				}
				echo '</tr><tr>';
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['WebContent'] ['DocInfoDyn'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['WebContent'] ['DocInfoDyn'] )) {
					echo $this->renderTabWebContentDocInfoDyn ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['WebContent'] ['DocZoom'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['WebContent'] ['DocZoom'] )) {
					echo $this->renderTabWebContentDocZoom ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['WebContent'] ['DocStatic'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['WebContent'] ['DocStatic'] )) {
					echo $this->renderTabWebContentDocStatic ();
				}
				if ($_SESSION ['SITE'] ['ID'] == 2) {
					echo '</tr><tr>';
					if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['WebContent'] ['Menu Dynamique'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['WebContent'] ['Menu Dynamique'] )) {
						echo $this->renderTabWebContentMenuDynamique ();
					}
					if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['WebContent'] ['Flash Info'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['WebContent'] ['Flash Info'] )) {
						echo $this->renderTabWebContentFlashInfo ();
					}
					if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['WebContent'] ['Formulaire en ligne'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['WebContent'] ['Formulaire en ligne'] )) {
						echo $this->renderTabWebContentFormulaireEnLigne ();
					}
					echo '</tr><tr>';
					if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['WebContent'] ['Formulaire en ligne'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['WebContent'] ['Formulaire en ligne'] )) {
						echo $this->renderTabWebContentEnqueteEnLigne ();
					}
				}
				echo '</tr></table></div>';
				break;
			case '4' :
				echo '<div><table border="1"><tr>';
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['SiteEmploi'] ['Mail'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['SiteEmploi'] ['Mail'] )) {
					echo $this->renderTabSiteEmploiMail ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['SiteEmploi'] ['Accueil'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['SiteEmploi'] ['Accueil'] )) {
					echo $this->renderTabSiteEmploiAccueil ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['SiteEmploi'] ['Balises'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['SiteEmploi'] ['Balises'] )) {
					echo $this->renderTabSiteEmploiBalises ();
				}
				echo '</tr><tr>';
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['SiteEmploi'] ['CVs'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['SiteEmploi'] ['CVs'] )) {
					echo $this->renderTabSiteEmploiCVs ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['SiteEmploi'] ['Offres'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['SiteEmploi'] ['Offres'] )) {
					echo $this->renderTabSiteEmploiOffres ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['SiteEmploi'] ['Réponses'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['SiteEmploi'] ['Réponses'] )) {
					echo $this->renderTabSiteEmploiReponses ();
				}
				echo '</tr><tr>';
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['SiteEmploi'] ['Page Infos'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['SiteEmploi'] ['Page Infos'] )) {
					echo $this->renderTabSiteEmploiPageInfos ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['SiteEmploi'] ['Statistiques'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['SiteEmploi'] ['Statistiques'] )) {
					echo $this->renderTabSiteEmploiStatistiques ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['SiteEmploi'] ['Regions'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['SiteEmploi'] ['Regions'] )) {
					echo $this->renderTabSiteEmploiRegions ();
				}
				echo '</tr></table></div>';
				break;
			case '5' :
				echo '<div><table border="1"><tr>';
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Convention'] ['Conventions'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Convention'] ['Conventions'] )) {
					echo $this->renderTabConventionConventions ();
					echo $this->renderTabConventionPage ();
				}
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Convention'] ['Paramètres'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Convention'] ['Paramètres'] )) {
					echo $this->renderTabConventionParametres ();
				}
				echo '</tr></table></div>';
				break;
			case '6' :
				echo '<div><table border="0"><tr>';
				// if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Statistique'] ['CISCAR'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Statistique'] ['CISCAR'] )) {
				// echo $this->renderTabStatistiquesCISCAR ();
				// }
				// if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Statistique'] ['GCNF'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Statistique'] ['GCNF'] )) {
				// echo $this->renderTabStatistiquesGCNF ();
				// }
				// echo '</tr><tr>';
				if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Statistique'] ['GCR'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Statistique'] ['GCR'] )) {
					echo $this->renderTabStatistiquesGCR ();
				}
				// if (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $this->myRules ['Statistique'] ['GCRE'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $this->myRules ['Statistique'] ['GCRE'] )) {
				// echo $this->renderTabStatistiquesGCRE ();
				// }
				echo '</tr></table></div>';
				break;
		}
	}

	// ### TAB ###
	private function renderTabGeneralParametres() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/parametre/" style="text-decoration:none;color:#000000;"><img src="include/images/icon/console_network.png" border="0"/><br/>';
		$aff .= '<b>Param&egrave;tres</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabGeneralLCA() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/lca/" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Securite.jpg" border="0"/><br/>';
		$aff .= '<b>LCA</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabGeneralExport() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/export/" style="text-decoration:none;color:#000000;"><img src="include/images/icon/export.png" width="32" height="32" border="0"/><br/>';
		$aff .= '<b>Export</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabGeneralImport() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/mod-import/" style="text-decoration:none;color:#000000;"><img src="include/images/icon/import.png" width="32" height="32" border="0"/><br/>';
		$aff .= '<b>Import</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabGeneralAnomalie() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="http://193.240.22.32/abakus/mantis/" target="_BLANK"><img src="include/images/icon/mantis_logo.png" border="0"/></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabBiblioMedia() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/biblio-media/" style="text-decoration:none;color:#000000;"><img src="include/images/icon/1340374771_library.png" border="0"/><br/>';
		$aff .= '<b>Médiathèque</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabListOutlook() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/liste-outlook/" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Logo_Outlook_180x60.png" border="0"/><br/>';
		$aff .= '<b></b></a>';
		$aff .= '</td>';
		return $aff;
	}

	// ###
	private function renderTabSiteIndividu() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/individu/" style="text-decoration:none;color:#000000;"><img src="include/images/icon/businessman2.png" border="0"/><br/>';
		$aff .= '<b>Individu</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteRole() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/role" style="text-decoration:none;color:#000000;"><img src="include/images/icon/console_network.png" border="0"/><br/>';
		$aff .= '<b>R&ocirc;le</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteEtablissement() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/etablissement" style="text-decoration:none;color:#000000;"><img src="include/images/icon/application.png" border="0"/><br/>';
		$aff .= '<b>Etablissement</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteListeDeValeurs() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/lva/" style="text-decoration:none;color:#000000;"><img src="include/images/icon/console_network.png" border="0"/><br/>';
		$aff .= '<b>Liste de Valeurs</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteMail() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/parametre/?action=param" style="text-decoration:none;color:#000000;"><img src="include/images/icon/images.jpeg" border="0"/><br/>';
		$aff .= '<b>Mail</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteAutologin() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/autologin/" style="text-decoration:none;color:#000000;"><img src="include/images/single_sign_on.png" border="0"/><br/>';
		$aff .= '<b>Auto-Login</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteListeDiffusion() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/listeDiffusion/" style="text-decoration:none;color:#000000;"><img src="include/images/icon/maling-list.gif" border="0"/><br/>';
		$aff .= '<b>Liste diffusion</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteNewsletter() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/newsletter/" style="text-decoration:none;color:#000000;"><img src="include/images/icon/maling-list.gif" border="0"/><br/>';
		$aff .= '<b>Newsletter</b></a>';
		$aff .= '</td>';
		return $aff;
	}

	// private function renderTabSiteArticles()
	// {
	// $aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
	// $aff .= '<a href="modules/articles/" style="text-decoration:none;color:#000000;"><img src="include/images/icon/item.png" border="0"/><br/>';
	// $aff .= '<b>Articles</b></a>';
	// $aff .= '</td>';
	// return $aff;
	// }
	// ###
	private function renderTabWebContentCategorie() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/categorie/?" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Categorie.jpg" border="0"/><br/>';
		$aff .= '<b>Cat&eacute;gorie</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabWebContentBanniere() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/banniere/?" style="text-decoration:none;color:#000000;"><img src="include/images/icon/banniere.jpg" border="0"/><br/>';
		$aff .= '<b>Banni&egrave;re</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabWebContentPartenaire() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/document/DocPartenaire/?" style="text-decoration:none;color:#000000;"><img src="include/images/icon/partenaire.jpg" height="48" border="0"/><br/>';
		$aff .= '<b>Partenaires</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabWebContentDocInfoDyn() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/document/DocInfoDyn/?" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Document.jpg" border="0"/><br/>';
		$aff .= '<b>DocInfoDyn</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabWebContentDocZoom() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/document/DocZoom/?" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Document.jpg" border="0"/><br/>';
		$aff .= '<b>DocZoom</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabWebContentDocStatic() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/document/DocStatic/?" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Document.jpg" border="0"/><br/>';
		$aff .= '<b>DocStatic</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabWebContentMenuDynamique() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/menuDynamique/?" style="text-decoration:none;color:#000000;"><img src="include/images/icon/kmenuedit.png" border="0"/><br/>';
		$aff .= '<b>Menu Dynamique</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabWebContentFlashInfo() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/flashInfo/?" style="text-decoration:none;color:#000000;"><img src="include/images/icon/info_blue.png" border="0"/><br/>';
		$aff .= '<b>Flash Info</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabWebContentFormulaireEnLigne() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/FormulaireEnLigne/?" style="text-decoration:none;color:#000000;"><img src="include/images/1299074470_survey.png" border="0"/><br/>';
		$aff .= '<b>Formulaire en ligne</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabWebContentEnqueteEnLigne() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/EnqueteEnLigne/Formulaire/?" style="text-decoration:none;color:#000000;"><img src="include/images/1299074470_survey.png" border="0"/><br/>';
		$aff .= '<b>Enquete en ligne</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	// ###
	private function renderTabSiteEmploiMail() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/app-site-emploi/?action=mail" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Categorie.jpg" border="0"/><br/>';
		$aff .= '<b>Mail</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteEmploiAccueil() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/app-site-emploi/?action=accueil" style="text-decoration:none;color:#000000;"><img src="include/images/icon/banniere.jpg" border="0"/><br/>';
		$aff .= '<b>Accueil</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteEmploiBalises() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/app-site-emploi/?action=balise" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Document.jpg" border="0"/><br/>';
		$aff .= '<b>Balises</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteEmploiCVs() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/app-site-emploi/?action=cv" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Document.jpg" border="0"/><br/>';
		$aff .= '<b>CV\'s</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteEmploiOffres() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/app-site-emploi/?action=offres" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Document.jpg" border="0"/><br/>';
		$aff .= '<b>Offres</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteEmploiReponses() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/app-site-emploi/?action=reponse" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Document.jpg" border="0"/><br/>';
		$aff .= '<b>R&eacute;ponses</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteEmploiPageInfos() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/app-site-emploi/?action=infos" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Document.jpg" border="0"/><br/>';
		$aff .= '<b>Pages infos</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteEmploiStatistiques() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/app-site-emploi/statistiques" style="text-decoration:none;color:#000000;"><img src="include/images/icon/stats.jpg" border="0"/><br/>';
		$aff .= '<b>Statistiques</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabSiteEmploiRegions() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/lva/region?annu=6" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Document.jpg" border="0"/><br/>';
		$aff .= '<b>R&eacute;gions</b></a>';
		$aff .= '</td>';
		return $aff;
	}

	// ###
	private function renderTabConventionConventions() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/app-convention/modules/Convention/?" style="text-decoration:none;color:#000000;"><img src="include/images/icon/Categorie.jpg" border="0"/><br/>';
		$aff .= '<b>Conventions</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabConventionPage() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/app-convention/modules/Page/?" style="text-decoration:none;color:#000000;"><img src="include/images/icon/icon_page.png" border="0"/><br/>';
		$aff .= '<b>Pages</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabConventionParametres() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/app-convention/modules/Parametre/?action=mail" style="text-decoration:none;color:#000000;"><img src="include/images/icon/console_network.png" border="0"/><br/>';
		$aff .= '<b>Param&egrave;tres</b></a>';
		$aff .= '</td>';
		return $aff;
	}

	// ###
	private function renderTabStatistiquesGCR() {
		$aff = '<td width="200" height="100" align="center" >';
		$aff .= '<a href="modules/statistiques/?site=2" style="text-decoration:none;color:#000000;"><img src="include/images/icon/LogoGcrBandeau.jpg" border="1" style="border-color:#0003;"/><br/>';
		// $aff .= '<b>GCR</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabStatistiquesGCRE() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/statistiques/?site=7" style="text-decoration:none;color:#000000;"><img src="include/images/icon/gcre.png" border="0"/><br/>';
		$aff .= '<b>GCRE</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabStatistiquesGCNF() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/statistiques/?site=3" style="text-decoration:none;color:#000000;"><img height="65" src="include/images/bandeau3.jpg" border="0"/><br/>';
		$aff .= '<b>GCNF</b></a>';
		$aff .= '</td>';
		return $aff;
	}
	private function renderTabStatistiquesCISCAR() {
		$aff = '<td width="200" height="100" align="center" style="background-color: #E8E8E8;border: 1px solid #666666;">';
		$aff .= '<a href="modules/statistiques/?site=1" style="text-decoration:none;color:#000000;"><img height="65"  width="100" src="include/images/icon/ciscar.png" border="0"/><br/>';
		$aff .= '<b>CISCAR</b></a>';
		$aff .= '</td>';
		return $aff;
	}
}
?>