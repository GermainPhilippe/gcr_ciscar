<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @version 1.0.4
 */
include ($baseURLModule . 'core-shortcode/ShortcodeManager.php');
include ($baseURLModule . 'core-shortcode/NewsletterSC.php');

include ($baseURLModule . 'mod-import/controller/ImportIndividuController.php');
include ($baseURLModule . 'mod-import/view/ImportIndividuView.php');

include ($baseURLModule . 'biblio-media/models/BiblioMedia.php');
include ($baseURLModule . 'biblio-media/models/BiblioMediaDAO.php');
include ($baseURLModule . 'biblio-media/controller/BiblioMediaController.php');
include ($baseURLModule . 'biblio-media/views/BiblioView.php');
include ($baseURLModule . 'biblio-media/views/BiblioListView.php');
include ($baseURLModule . 'biblio-media/views/BiblioListFckeditorView.php');

include ($baseURLModule . 'liste-outlook/metier/modele/ListeOutlookManager.class.php');
include ($baseURLModule . 'liste-outlook/metier/view/ListeOutlookView.class.php');

// ######################################
// # CORE
// ######################################

include ($baseURLModule . 'commun/metier/modele/DefaultModele.php');
include ($baseURLModule . 'commun/metier/modele/DefaultModeleList.php');
include ($baseURLModule . 'commun/metier/view/DefaultView.php');
include ($baseURLModule . 'commun/metier/view/DefaultListView.php');
include ($baseURLModule . 'commun/metier/view/MenuModuleView.class.php');
include ($baseURLModule . 'commun/metier/controler/DefaultControler.php');


// ######################################
// # FUNCTION
// ######################################

include ($baseURLModule . 'commun/function/FunctionCommun.class.php');
include ($baseURLModule . 'commun/function/FunctionDate.class.php');

// ######################################
// # HELPER
// ######################################

include ($baseURLModule . 'commun/helper/HelperHead.class.php');

// ############################################################################
// ############################################################################
// ############################################################################
// ############################################################################

// ######################################
// # MODULE Commun
// ######################################

include ($baseURLModule . 'commun/metier/modele/NotificationMail.class.php');

// ######################################
// # Liste Diffusion
// ######################################

include ($baseURLModule . 'listeDiffusion/metier/modele/ListeDiffusion.class.php');
include ($baseURLModule . 'listeDiffusion/metier/modele/ListeDiffusionManager.class.php');
include ($baseURLModule . 'listeDiffusion/metier/modele/ListeDiffusionCritere.class.php');
include ($baseURLModule . 'listeDiffusion/metier/modele/ListeDiffusionCritereManager.class.php');
include ($baseURLModule . 'listeDiffusion/metier/modele/ListeDiffusionCsv.class.php');

include ($baseURLModule . 'listeDiffusion/metier/controler/listeDiffusionControler.class.php');

include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusionCollectionView.class.php');
include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusionView.class.php');

include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusion_IndividuView.class.php');
include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusion_EtablissementView.class.php');
include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusion_DomaineActiviteView.class.php');
include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusion_FonctionDAView.class.php');
include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusion_RegionView.class.php');
include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusion_FonctionRegionView.class.php');
include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusion_CommissionView.class.php');
include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusion_BureauNationalView.class.php');
include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusion_GroupeLCAView.class.php');
include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusion_CsvView.class.php');
include ($baseURLModule . 'listeDiffusion/metier/view/ListeDiffusionRequeteView.php');

// ####################################
// # Module Newsletter #
// ####################################

include ($baseURLModule . 'newsletter/metier/modele/Newsletter.class.php');
include ($baseURLModule . 'newsletter/metier/modele/NewsletterAttachment.php');
include ($baseURLModule . 'newsletter/metier/modele/NewsletterAttachmentManager.php');
include ($baseURLModule . 'newsletter/metier/modele/NewsletterManager.class.php');
include ($baseURLModule . 'newsletter/metier/modele/NewsletterDestinataire.class.php');
include ($baseURLModule . 'newsletter/metier/modele/NewsletterDestinataireManager.class.php');
include ($baseURLModule . 'newsletter/metier/modele/NewsletterHistorique.class.php');
include ($baseURLModule . 'newsletter/metier/modele/NewsletterHistoriqueManager.class.php');
include ($baseURLModule . 'newsletter/metier/modele/NewsletterEnvoi.class.php');
include ($baseURLModule . 'newsletter/metier/modele/NewsletterEnvoiManager.class.php');
include ($baseURLModule . 'newsletter/metier/modele/NewsletterEnvoisDetails.class.php');
include ($baseURLModule . 'newsletter/metier/modele/NewsletterEnvoisDetailsManager.class.php');

include ($baseURLModule . 'newsletter/metier/view/NewsletterView.class.php');
include ($baseURLModule . 'newsletter/metier/view/NewsletterTabView.php');
include ($baseURLModule . 'newsletter/metier/view/NewsletterHistoriqueView.class.php');
include ($baseURLModule . 'newsletter/metier/view/NewsletterEnvoisDetailsView.class.php');
include ($baseURLModule . 'newsletter/metier/view/NewsletterAddDestinataireView.class.php');
include ($baseURLModule . 'newsletter/metier/view/NewsletterCollectionView.class.php');

include ($baseURLModule . 'newsletter/metier/controler/NewsletterControler.class.php');

// ######################################
// # Module Menu Dynamique
// ######################################

include ($baseURLModule . 'menuDynamique/metier/modele/MenuDynamique.class.php');
include ($baseURLModule . 'menuDynamique/metier/modele/MenuDynamiqueManager.class.php');
include ($baseURLModule . 'menuDynamique/metier/modele/MenuDynamiqueVue.class.php');
include ($baseURLModule . 'menuDynamique/metier/modele/MenuDynamiqueVueManager.class.php');
include ($baseURLModule . 'menuDynamique/metier/view/MenuDynamiqueView.class.php');
include ($baseURLModule . 'menuDynamique/metier/view/MenuDynamiqueTreeView.class.php');
include ($baseURLModule . 'menuDynamique/metier/controler/MenuDynamiqueControler.class.php');
include ($baseURLModule . 'menuDynamique/metier/view/MenuDynamique_Category.php');
include ($baseURLModule . 'menuDynamique/metier/view/MenuDynamique_DocStatic.php');

// ######################################
// # Module Flash Info
// ######################################

include ($baseURLModule . 'flashInfo/metier/modele/FlashInfo.class.php');
include ($baseURLModule . 'flashInfo/metier/modele/FlashInfoManager.class.php');
include ($baseURLModule . 'flashInfo/metier/modele/FlashInfoDomaineActivite.class.php');
include ($baseURLModule . 'flashInfo/metier/modele/FlashInfoDomaineActiviteManager.class.php');
include ($baseURLModule . 'flashInfo/metier/controler/FlashInfoControler.class.php');
include ($baseURLModule . 'flashInfo/metier/view/FlashInfoListView.class.php');
include ($baseURLModule . 'flashInfo/metier/view/FlashInfoView.class.php');
include ($baseURLModule . 'flashInfo/metier/view/FlashInfoAddDomaineActiviteView.class.php');

// ######################################
// # Module Commentaire
// ######################################

include ($baseURLModule . 'document/DocInfoDyn/metier/modele/DocInfoDynCommentaire.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/modele/DocInfoDynCommentaireManager.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/modele/DocInfoDynCommentaireDestinataire.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/modele/DocInfoDynCommentaireDestinataireManager.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/view/DocInfoDynCommentaireDestinataireView.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/view/DocInfoDynCommentaireView.php');

// ######################################
// # MODULE export
// ######################################

include ($baseURLModule . 'export/controler/ExportControler.class.php');
include ($baseURLModule . 'export/modele/AnomalieEtablissement.class.php');
include ($baseURLModule . 'export/view/AnomalieEtablissementView.class.php');

include ($baseURLModule . 'export/modele/AnomalieIndividu.class.php');
include ($baseURLModule . 'export/view/AnomalieIndividuView.class.php');

include ($baseURLModule . 'export/modele/AnomalieSageIndividu.class.php');
include ($baseURLModule . 'export/view/AnomalieSageIndividuView.class.php');

include ($baseURLModule . 'export/modele/ExportFaf.class.php');
include ($baseURLModule . 'export/view/ExportFafView.class.php');

include ($baseURLModule . 'export/modele/SageEtablissement.class.php');
include ($baseURLModule . 'export/view/SageEtablissementView.class.php');

include ($baseURLModule . 'export/modele/SageIndividu.class.php');
include ($baseURLModule . 'export/view/SageIndividuView.class.php');

include ($baseURLModule . 'export/modele/ExportAutologin.class.php');
include ($baseURLModule . 'export/view/ExportAutologinView.class.php');

include ($baseURLModule . 'export/modele/AnomalieRole.class.php');
include ($baseURLModule . 'export/view/AnomalieRoleView.class.php');

// ######################################
// # Module Formulaire En Ligne
// ######################################

include ($baseURLModule . 'FormulaireEnLigne/metier/modele/Survey.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/modele/SurveyManager.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/modele/SurveyDraftRecipient.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/modele/SurveyDraftRecipientManager.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/modele/SurveyHistory.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/modele/SurveyHistoryManager.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/modele/SurveyQuestion.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/modele/SurveyQuestionManager.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/modele/SurveyRecipient.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/modele/SurveyRecipientManager.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/modele/SurveyRecipientResponse.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/modele/SurveyRecipientResponseManager.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/controler/SurveyControler.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/view/SurveyCollectionView.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/view/SurveyView.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/view/SurveyQuestionView.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/view/SurveyQuestionCollectionView.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/view/SurveyPreviewView.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/view/SurveyDraftRecipientCollectionView.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/view/SurveyRecipientCollectionView.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/view/SurveyHistoryView.class.php');
include ($baseURLModule . 'FormulaireEnLigne/metier/view/SurveyResponseView.class.php');

// ######################################
// # Module Enquete En Ligne
// ######################################

include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/modele/EnqueteFormulaireDAO.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/modele/EnqueteFormulaire.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/modele/EnqueteFormulaireCompositionDAO.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/modele/EnqueteFormulaireComposition.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/modele/EnqueteFormulaireFieldDAO.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/modele/EnqueteFormulaireField.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/modele/EnqueteFormulaireFieldResponseDAO.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/modele/EnqueteFormulaireFieldResponse.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/modele/EnqueteFormulaireComposantDAO.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/modele/EnqueteFormulaireComposant.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/modele/ParametreEnquete.php');

include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/controler/EnqueteFormulaireComposantController.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/controler/EnqueteFormulaireFieldController.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/controler/EnqueteFormulaireControler.php');

include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/view/EnqueteFormulaireComposantBandeauView.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/view/EnqueteFormulaireComposantZoneTextView.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/view/EnqueteFormulaireComposantView.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/view/EnqueteFormulaireListView.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/view/FormulaireView.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/view/EnqueteFormulaireView.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/view/EnqueteFormulaireFieldView.php');
include ($baseURLModule . 'EnqueteEnLigne/Formulaire/metier/view/EnqueteResponseView.php');

// ######################################
// # MODULE WCM
// ######################################

// Categorie
// Modele
include ($baseURLModule . 'categorie/metier/modele/Categorie.php');
include ($baseURLModule . 'categorie/metier/modele/CategorieList.php');

// view
include ($baseURLModule . 'categorie/metier/view/SimpleCategorieListView.php');
include ($baseURLModule . 'categorie/metier/view/CategorieView.php');

// Controler
include ($baseURLModule . 'categorie/metier/controler/CategorieControler.php');

// Banniere
// Modele
include ($baseURLModule . 'banniere/metier/modele/Banniere.php');
include ($baseURLModule . 'banniere/metier/modele/BanniereList.php');

// view
include ($baseURLModule . 'banniere/metier/view/BanniereListView.php');
include ($baseURLModule . 'banniere/metier/view/BanniereView.php');
include ($baseURLModule . 'banniere/metier/view/BanniereDisplayView.php');

// Controler
include ($baseURLModule . 'banniere/metier/controler/BanniereControler.php');

// ######################################

// Document

// DocInfoDyn
// Modele
include ($baseURLModule . 'document/DocInfoDyn/metier/modele/DocInfoDyn.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/modele/DocInfoDynList.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/modele/DocInfoDynCategorie.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/modele/DocInfoDynCategorieList.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/modele/DocInfoDynLCA.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/modele/DocInfoDynLCAList.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/modele/Groupe.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/modele/GroupeList.php');

// View
include ($baseURLModule . 'document/DocInfoDyn/metier/view/DocInfoDynListView.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/view/SimpleDocInfoDynListView.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/view/DocInfoDynListViewByCategorie.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/view/DocInfoDynListViewByCategoriePlugin.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/view/DocInfoDynListTableView.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/view/DocInfoDynView.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/view/DocInfoDynTabView.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/view/SplitDocInfoDynListView.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/view/SplitView_Category.php');
include ($baseURLModule . 'document/DocInfoDyn/metier/view/SplitView_DocInfoDyn.php');

// Controler
include ($baseURLModule . 'document/DocInfoDyn/metier/controler/DocInfoDynControler.php');

// DocStatic
// Modele
include ($baseURLModule . 'document/DocStatic/metier/modele/DocStatic.php');
include ($baseURLModule . 'document/DocStatic/metier/modele/DocStaticList.php');

// View
include ($baseURLModule . 'document/DocStatic/metier/view/DocStaticView.php');
include ($baseURLModule . 'document/DocStatic/metier/view/DocStaticListView.php');
include ($baseURLModule . 'document/DocStatic/metier/view/PGDocStaticListView.php');

// Controler
include ($baseURLModule . 'document/DocStatic/metier/controler/DocStaticControler.php');

// DocZoom
// Modele
include ($baseURLModule . 'document/DocZoom/metier/modele/DocZoom.php');
include ($baseURLModule . 'document/DocZoom/metier/modele/DocZoomList.php');

// View
include ($baseURLModule . 'document/DocZoom/metier/view/DocZoomView.php');
include ($baseURLModule . 'document/DocZoom/metier/view/DocZoomListView.php');

// Controler
include ($baseURLModule . 'document/DocZoom/metier/controler/DocZoomControler.php');

// DocPartenaire
// Modele
include ($baseURLModule . 'document/DocPartenaire/metier/modele/DocPartenaire.php');
include ($baseURLModule . 'document/DocPartenaire/metier/modele/DocPartenaireList.php');

// View
include ($baseURLModule . 'document/DocPartenaire/metier/view/DocPartenaireView.php');
include ($baseURLModule . 'document/DocPartenaire/metier/view/DocPartenaireListView.php');

// Controler
include ($baseURLModule . 'document/DocPartenaire/metier/controler/DocPartenaireControler.php');

// DocPartenairePage
// Modele
include ($baseURLModule . 'document/DocPartenairePage/metier/modele/DocPartenairePage.php');
include ($baseURLModule . 'document/DocPartenairePage/metier/modele/DocPartenairePageList.php');

// View
include ($baseURLModule . 'document/DocPartenairePage/metier/view/DocPartenairePageView.php');
include ($baseURLModule . 'document/DocPartenairePage/metier/view/DocPartenairePageListView.php');

// Controler
include ($baseURLModule . 'document/DocPartenairePage/metier/controler/DocPartenairePageControler.php');

// ######################################
// # MODULE Annuaire
// ######################################

// Module LCA Site
// Controler
include ($baseURLModule . 'site/lca/metier/controler/SiteGroupeLCAControler.php');
// Modele
include ($baseURLModule . 'site/lca/metier/modele/SiteGroupeLCA.php');
include ($baseURLModule . 'site/lca/metier/modele/MembreListe.php');
include ($baseURLModule . 'site/lca/metier/modele/SiteGroupeLCAListe.php');
// View
include ($baseURLModule . 'site/lca/metier/view/ListeSiteGroupeLCAView.php');
include ($baseURLModule . 'site/lca/metier/view/MembreGroupeView.php');

// Module LCA
// Modele
include ($baseURLModule . 'lca/metier/modele/Groupe.php');
include ($baseURLModule . 'lca/metier/modele/GroupeListe.php');
include ($baseURLModule . 'lca/metier/modele/TypeGroupe.php');
include ($baseURLModule . 'lca/metier/modele/TypeGroupeListe.php');
include ($baseURLModule . 'lca/metier/modele/MembreListe.php');
// View
include ($baseURLModule . 'lca/metier/view/GroupeLCAListeView.php');
include ($baseURLModule . 'lca/metier/view/TypeGroupeListeView.php');
include ($baseURLModule . 'lca/metier/view/MembreGroupeView.php');
// Controler
include ($baseURLModule . 'lca/metier/controler/LCAControler.php');

// Optimise
include ($baseURLModule . 'lca/metier/modele/Simple_LCAGroupe.php');
include ($baseURLModule . 'lca/metier/modele/Simple_LCAGroupeList.php');
include ($baseURLModule . 'lca/metier/modele/Simple_LCAGroupeMembre.php');
include ($baseURLModule . 'lca/metier/modele/Simple_LCAGroupeMembreList.php');
include ($baseURLModule . 'lca/metier/view/Simple_LCAGroupeListView.php');
include ($baseURLModule . 'lca/metier/view/Simple_LCAGroupeMembreListView.php');
include ($baseURLModule . 'lca/metier/view/LCAGroupeListView.php');
include ($baseURLModule . 'lca/metier/view/LCAGroupeView.php');

// Module SITE
// Modele
include ($baseURLModule . 'site/metier/modele/Site.php');
include ($baseURLModule . 'site/metier/modele/ListeSite.php');
// View
include ($baseURLModule . 'site/metier/view/SiteView.php');
include ($baseURLModule . 'site/metier/view/ListeSiteView.php');
// Controler
include ($baseURLModule . 'site/metier/controler/SiteControler.php');

// #########################

// Module Parametres Systeme
// Modele
include ($baseURLModule . 'parametre/metier/modele/Param.php');
include ($baseURLModule . 'parametre/metier/modele/ListeParam.php');
// View
include ($baseURLModule . 'parametre/metier/view/ParamView.php');
include ($baseURLModule . 'parametre/metier/view/ParametrageTabView.class.php');
include ($baseURLModule . 'parametre/metier/view/ParametrageGeneralView.class.php');
include ($baseURLModule . 'parametre/metier/view/ListeParamView.php');
// Controler
include ($baseURLModule . 'parametre/metier/controler/ParamControler.php');
// #########################
// Module Mail
// include($baseURLModule.'mail/metier/view/MailView.php');
// include($baseURLModule.'mail/metier/controler/MailControler.php');
// #########################
// Module Autologin
include ($baseURLModule . 'autologin/view/AutologinView.php');
include ($baseURLModule . 'autologin/controler/AutologinControler.php');

// #########################

// Module Connexion
// Modele
include ($baseURLModule . 'connexion/metier/modele/User.php');
// View
include ($baseURLModule . 'connexion/metier/view/UserView.php');
// Controler
include ($baseURLModule . 'connexion/metier/controler/UserControler.php');

// #########################

// Module Etablissement
// Modele
include ($baseURLModule . 'etablissement/metier/modele/Etablissement.php');
include ($baseURLModule . 'etablissement/metier/modele/EtablissementListe.php');
// View
include ($baseURLModule . 'etablissement/metier/view/EtablissementView.php');
// Controler
include ($baseURLModule . 'etablissement/metier/controler/EtablissementControler.php');

// Optimisation
include ($baseURLModule . 'etablissement/metier/modele/Simple_Etablissement.php');
include ($baseURLModule . 'etablissement/metier/modele/Simple_EtablissementList.php');
include ($baseURLModule . 'etablissement/metier/view/Simple_EtablissementListView.php');

// #########################

// Module Individu
// Modele
include ($baseURLModule . 'individu/metier/modele/individu.php');
include ($baseURLModule . 'individu/metier/modele/IndividuListe.php');
include ($baseURLModule . 'individu/metier/modele/IndividuFonctionBN.php');
include ($baseURLModule . 'individu/metier/modele/IndividuFonctionBNList.php');
include ($baseURLModule . 'individu/metier/modele/TypeCellule.php');
include ($baseURLModule . 'individu/metier/modele/TypeCelluleListe.php');
include ($baseURLModule . 'individu/metier/modele/TypeMembreBN.php');
include ($baseURLModule . 'individu/metier/modele/TypeMembreBNListe.php');
include ($baseURLModule . 'individu/metier/modele/CommissionIndividu.php');
include ($baseURLModule . 'individu/metier/modele/CommissionIndividuListe.php');
include ($baseURLModule . 'individu/metier/modele/DelegationRegionnale.php');
// View
include ($baseURLModule . 'individu/metier/view/IndividuListeViewEtablissement.php');
include ($baseURLModule . 'individu/metier/view/IndividuListeViewEtablissement2.php');
include ($baseURLModule . 'individu/metier/view/IndividuView.php');
include ($baseURLModule . 'individu/metier/view/IndividuTabView.php');
include ($baseURLModule . 'individu/metier/view/TypeCelluleListeView.php');
include ($baseURLModule . 'individu/metier/view/TypeMembreBNListeView.php');
// Controler
include ($baseURLModule . 'individu/metier/controler/IndividuControler.php');

// Optimisation
include ($baseURLModule . 'individu/metier/modele/Simple_Individu.php');
include ($baseURLModule . 'individu/metier/modele/Simple_IndividuList.php');
include ($baseURLModule . 'individu/metier/view/Simple_IndividuListView.php');

// #########################

// Module LVA
// Annuaire
// Modele
include ($baseURLModule . 'lva/metier/modele/Annuaire.php');
include ($baseURLModule . 'lva/metier/modele/AnnuaireListe.php');
// View
include ($baseURLModule . 'lva/metier/view/AnnuaireView.php');
include ($baseURLModule . 'lva/metier/view/AnnuaireListeView.php');
// Controler
include ($baseURLModule . 'lva/metier/controler/AnnuaireControler.php');
// Commission
// Modele
include ($baseURLModule . 'lva/commission/metier/modele/Commission.php');
include ($baseURLModule . 'lva/commission/metier/modele/CommissionListe.php');
include ($baseURLModule . 'lva/commission/metier/modele/TypeCommission.php');
include ($baseURLModule . 'lva/commission/metier/modele/TypeCommissionListe.php');
// View
include ($baseURLModule . 'lva/commission/metier/view/CommissionView.php');
include ($baseURLModule . 'lva/commission/metier/view/CommissionListeView.php');
include ($baseURLModule . 'lva/commission/metier/view/TypeCommissionListeView.php');
// Controler
include ($baseURLModule . 'lva/commission/metier/controler/CommissionControler.php');
// Domaine Activite
// Modele
include ($baseURLModule . 'lva/domaineActivite/metier/modele/Marque.php');
include ($baseURLModule . 'lva/domaineActivite/metier/modele/MarqueListe.php');
// View
include ($baseURLModule . 'lva/domaineActivite/metier/view/MarqueView.php');
include ($baseURLModule . 'lva/domaineActivite/metier/view/MarqueListeView.php');
// Controler
include ($baseURLModule . 'lva/domaineActivite/metier/controler/MarqueControler.php');
// Fonction DA
// Modele
include ($baseURLModule . 'lva/FonctionDA/metier/modele/FonctionDA.php');
include ($baseURLModule . 'lva/FonctionDA/metier/modele/FonctionDAList.php');
// View
include ($baseURLModule . 'lva/FonctionDA/metier/view/FonctionDAView.php');
include ($baseURLModule . 'lva/FonctionDA/metier/view/FonctionDAListView.php');
// Controler
include ($baseURLModule . 'lva/FonctionDA/metier/controler/FonctionDAControler.php');

// Fonction BN
// Modele
include ($baseURLModule . 'lva/fonctionBN/metier/modele/Marque.php');
include ($baseURLModule . 'lva/fonctionBN/metier/modele/MarqueListe.php');
// View
include ($baseURLModule . 'lva/fonctionBN/metier/view/MarqueView.php');
include ($baseURLModule . 'lva/fonctionBN/metier/view/MarqueListeView.php');
// Controler
include ($baseURLModule . 'lva/fonctionBN/metier/controler/MarqueControler.php');
// Fonction Commission
// Modele
include ($baseURLModule . 'lva/fonctionCommission/metier/modele/Marque.php');
include ($baseURLModule . 'lva/fonctionCommission/metier/modele/MarqueListe.php');
// View
include ($baseURLModule . 'lva/fonctionCommission/metier/view/MarqueView.php');
include ($baseURLModule . 'lva/fonctionCommission/metier/view/MarqueListeView.php');
// Controler
include ($baseURLModule . 'lva/fonctionCommission/metier/controler/MarqueControler.php');
// Fonction Delegation
// Modele
include ($baseURLModule . 'lva/fonctionDelegation/metier/modele/Marque.php');
include ($baseURLModule . 'lva/fonctionDelegation/metier/modele/MarqueListe.php');
// View
include ($baseURLModule . 'lva/fonctionDelegation/metier/view/MarqueView.php');
include ($baseURLModule . 'lva/fonctionDelegation/metier/view/MarqueListeView.php');
// Controler
include ($baseURLModule . 'lva/fonctionDelegation/metier/controler/MarqueControler.php');
// Groupe Etablissement
// Modele
include ($baseURLModule . 'lva/groupeEtablissement/metier/modele/Marque.php');
include ($baseURLModule . 'lva/groupeEtablissement/metier/modele/MarqueListe.php');
// View
include ($baseURLModule . 'lva/groupeEtablissement/metier/view/MarqueView.php');
include ($baseURLModule . 'lva/groupeEtablissement/metier/view/MarqueListeView.php');
// Controler
include ($baseURLModule . 'lva/groupeEtablissement/metier/controler/MarqueControler.php');
// Marque
// Modele
include ($baseURLModule . 'lva/marque/metier/modele/Marque.php');
include ($baseURLModule . 'lva/marque/metier/modele/MarqueListe.php');
// View
include ($baseURLModule . 'lva/marque/metier/view/MarqueView.php');
include ($baseURLModule . 'lva/marque/metier/view/MarqueListeView.php');
// Controler
include ($baseURLModule . 'lva/marque/metier/controler/MarqueControler.php');
// Region
// Modele
include ($baseURLModule . 'lva/region/metier/modele/Departement.php');
include ($baseURLModule . 'lva/region/metier/modele/DepartementListe.php');
include ($baseURLModule . 'lva/region/metier/modele/Region.php');
include ($baseURLModule . 'lva/region/metier/modele/RegionListe.php');
// View
include ($baseURLModule . 'lva/region/metier/view/DepartementListeView.php');
include ($baseURLModule . 'lva/region/metier/view/RegionListeView.php');
include ($baseURLModule . 'lva/region/metier/view/RegionView.php');
// Controler
include ($baseURLModule . 'lva/region/metier/controler/RegionControler.php');
// Statut Etablissement
// Modele
include ($baseURLModule . 'lva/statutEtablissement/metier/modele/Marque.php');
include ($baseURLModule . 'lva/statutEtablissement/metier/modele/MarqueListe.php');
// View
include ($baseURLModule . 'lva/statutEtablissement/metier/view/MarqueView.php');
include ($baseURLModule . 'lva/statutEtablissement/metier/view/MarqueListeView.php');
// Controler
include ($baseURLModule . 'lva/statutEtablissement/metier/controler/MarqueControler.php');
// Nature
// Modele
include ($baseURLModule . 'lva/nature/metier/modele/Marque.php');
include ($baseURLModule . 'lva/nature/metier/modele/MarqueListe.php');
// View
include ($baseURLModule . 'lva/nature/metier/view/MarqueView.php');
include ($baseURLModule . 'lva/nature/metier/view/MarqueListeView.php');
// Controler
include ($baseURLModule . 'lva/nature/metier/controler/MarqueControler.php');
// Langue
// Modele
include ($baseURLModule . 'lva/langues/metier/modele/Marque.php');
include ($baseURLModule . 'lva/langues/metier/modele/MarqueListe.php');
// View
include ($baseURLModule . 'lva/langues/metier/view/MarqueView.php');
include ($baseURLModule . 'lva/langues/metier/view/MarqueListeView.php');
// Controler
include ($baseURLModule . 'lva/langues/metier/controler/MarqueControler.php');
// Typologie
// Modele
include ($baseURLModule . 'lva/typologie/metier/modele/Marque.php');
include ($baseURLModule . 'lva/typologie/metier/modele/MarqueListe.php');
// View
include ($baseURLModule . 'lva/typologie/metier/view/MarqueView.php');
include ($baseURLModule . 'lva/typologie/metier/view/MarqueListeView.php');
// Controler
include ($baseURLModule . 'lva/typologie/metier/controler/MarqueControler.php');

// #########################

// Module Role
// Modele
include ($baseURLModule . 'role/metier/modele/Role.php');
include ($baseURLModule . 'role/metier/modele/DomaineActiviteFonction.php');
include ($baseURLModule . 'role/metier/modele/DomaineActiviteFonctionList.php');
include ($baseURLModule . 'role/metier/modele/RoleListe.php');
// view
include ($baseURLModule . 'role/metier/view/RoleView.php');
// Controler
include ($baseURLModule . 'role/metier/controler/RoleControler.php');

// Optimisation
include ($baseURLModule . 'role/metier/modele/Simple_Role.php');
include ($baseURLModule . 'role/metier/modele/Simple_RoleList.php');
include ($baseURLModule . 'role/metier/view/Simple_RoleListView.php');

// Module Site Emploi
// Modele
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/ParamMailPubOffre.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/ParamAccueil.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/Parametre.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/ParametreMail.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/ParamBalise.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/EnvoiMail.php');
// include($baseURLModule.'app-site-emploi/mail/metier/modele/VerifCVList.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/VerifCV.php');
// include($baseURLModule.'app-site-emploi/mail/metier/modele/VerifOffreList.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/VerifOffre.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/PageInfos.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/PageInfosList.php');
// View
include ($baseURLModule . 'app-site-emploi/mail/metier/view/ParamMailView.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/view/ParamBaliseView.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/view/ParamAccueilView.php');
// include($baseURLModule.'app-site-emploi/mail/metier/view/VerifCVListView.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/view/VerifCVView.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/view/VerifOffreView.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/view/PageInfosView.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/view/PageInfosListView.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/view/PGPageInfosListView.php');
// Controler
include ($baseURLModule . 'app-site-emploi/mail/metier/controler/ParamMailControler.php');
// include($baseURLModule.'app-site-emploi/mail/metier/getCV.php');

// CV
// Modele
include ($baseURLModule . 'app-site-emploi/cv/metier/modele/ListCV.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/ListDepartement.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/ListDomaine.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/ListMetier.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/ListPays.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/ListExperience.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/ListNiveau.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/ListRegion.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/ListTypeContrat.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/Domaine.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/Metier.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/Pays.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/Niveau.php');

include ($baseURLModule . 'app-site-emploi/mail/metier/modele/Experience.php');
include ($baseURLModule . 'app-site-emploi/mail/metier/modele/TypeContrat.php');

// View
include ($baseURLModule . 'app-site-emploi/cv/metier/view/TriCVView.php');
include ($baseURLModule . 'app-site-emploi/cv/metier/view/ListCVNumView.php');
include ($baseURLModule . 'app-site-emploi/cv/metier/view/ListCVDateView.php');
include ($baseURLModule . 'app-site-emploi/cv/metier/view/ListCVPubView.php');
include ($baseURLModule . 'app-site-emploi/cv/metier/view/ListCVDefautView.php');
// Controler
include ($baseURLModule . 'app-site-emploi/cv/metier/controler/TriCVControler.php');

// Offre
// Modele
include ($baseURLModule . 'app-site-emploi/offre/metier/modele/ListOffre.php');
// View
include ($baseURLModule . 'app-site-emploi/offre/metier/view/TriOffreView.php');
include ($baseURLModule . 'app-site-emploi/offre/metier/view/ListOffreNumView.php');
include ($baseURLModule . 'app-site-emploi/offre/metier/view/ListOffreDateView.php');
include ($baseURLModule . 'app-site-emploi/offre/metier/view/ListOffrePubView.php');
include ($baseURLModule . 'app-site-emploi/offre/metier/view/ListOffreDefautView.php');
// Controler
include ($baseURLModule . 'app-site-emploi/offre/metier/controler/TriOffreControler.php');

// Reponse
// Modele
include ($baseURLModule . 'app-site-emploi/reponse/metier/modele/ListReponse.php');
include ($baseURLModule . 'app-site-emploi/reponse/metier/modele/VerifReponse.php');
// View
include ($baseURLModule . 'app-site-emploi/reponse/metier/view/TriReponseView.php');
include ($baseURLModule . 'app-site-emploi/reponse/metier/view/ListReponseNumView.php');
include ($baseURLModule . 'app-site-emploi/reponse/metier/view/ListReponseDateView.php');
include ($baseURLModule . 'app-site-emploi/reponse/metier/view/ListeReponseView.php');
include ($baseURLModule . 'app-site-emploi/reponse/metier/view/VerifReponseView.php');
// Controler
include ($baseURLModule . 'app-site-emploi/reponse/metier/controler/ListReponseControler.php');

// Statisques Site Emploi
// Modele
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatCVDate.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/Consult.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatOffreDate.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatCVRegion.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatOffreRegion.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatReponseRegion.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatRegion.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatListRegion.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatDomaine.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatListDomaine.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatDepartement.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatListDepartement.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatConsult.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/modele/StatConsultCV.php');

// View
include ($baseURLModule . 'app-site-emploi/statistiques/metier/view/StatConsultCVView.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/view/StatCVDateView.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/view/StatOffreDateView.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/view/StatCVRegionView.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/view/StatOffreRegionView.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/view/StatReponseRegionView.php');
include ($baseURLModule . 'app-site-emploi/statistiques/metier/view/StatConsultView.php');
// Controler
include ($baseURLModule . 'app-site-emploi/statistiques/metier/controler/StatControler.php');

// Module Statistique
// Controler
include ($baseURLModule . 'statistiques/metier/controler/StatistiquesControler.php');
// Modele
include ($baseURLModule . 'statistiques/metier/modele/StatConsultDoc.php');
include ($baseURLModule . 'statistiques/metier/modele/StatConsultType.php');
include ($baseURLModule . 'statistiques/metier/modele/StatConsultDomaine.php');
include ($baseURLModule . 'statistiques/metier/modele/StatConsultDR.php');
include ($baseURLModule . 'statistiques/metier/modele/ConsultDoc.php');
include ($baseURLModule . 'statistiques/metier/modele/Frequentation.php');
include ($baseURLModule . 'statistiques/metier/modele/FrequentationIndividu.php');
// View
include ($baseURLModule . 'statistiques/metier/view/StatConsultDocView.php');
include ($baseURLModule . 'statistiques/metier/view/StatConsultTopDocView.php');
include ($baseURLModule . 'statistiques/metier/view/StatTypeDocView.php');
include ($baseURLModule . 'statistiques/metier/view/StatConsultDomainView.php');
include ($baseURLModule . 'statistiques/metier/view/FrequentationView.php');
include ($baseURLModule . 'statistiques/metier/view/FrequentationIndividuView.php');
include ($baseURLModule . 'statistiques/metier/view/StatConsultDRView.php');
include ($baseURLModule . 'statistiques/metier/view/SplitDRDocView.php');
include ($baseURLModule . 'statistiques/metier/view/SplitDRDADocView.php');

// ####################################
// # Module app-export #
// ####################################

include ($baseURLModule . 'app-export/metier/modele/ExportRequest.class.php');
include ($baseURLModule . 'app-export/metier/modele/ExportRequestManager.class.php');
include ($baseURLModule . 'app-export/metier/view/ExportRequestView.class.php');
include ($baseURLModule . 'app-export/metier/view/ExportRequestCollectionView.class.php');
include ($baseURLModule . 'app-export/metier/controler/ExportRequestControler.class.php');

// ####################################
// # prestashop #
// ####################################

include ($baseURLModule . 'prestashop/modele/PrestaShopCustomer.class.php');
include ($baseURLModule . 'prestashop/modele/IndividuAnnuaire.class.php');
include ($baseURLModule . 'prestashop/modele/PrestaShopAdresses.class.php');
include ($baseURLModule . 'prestashop/controler/PrestaShopControler.class.php');
include ($baseURLModule . 'prestashop/view/PrestaShopView.php');

?>