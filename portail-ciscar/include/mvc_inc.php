<?php
// Autologin
// include($BaseURL.'modules/AutoLogin/modele/ExportAutologin.class.php');
// include($BaseURL.'modules/AutoLogin/view/ExportAutologinView.class.php');
include ($BaseURL . 'modules/Biblio-media/metier/modele/BiblioMedia.php');
include ($BaseURL . 'modules/Biblio-media/metier/modele/BiblioMediaDAO.php');

// SSO Module
include ($BaseURL . 'modules/sso/SSOToken.php');
include ($BaseURL . 'modules/sso/SSOTokenManager.php');

// Commun
include ($BaseURL . 'modules/Commun/view/HomePageMaintenance.php');
include ($BaseURL . 'modules/Commun/view/HomePageNonConnecteView.php');
include ($BaseURL . 'modules/Commun/view/HomePageNonConnecteImprnetView.php');
include ($BaseURL . 'modules/Commun/view/HomePageConnecteView.php');
include ($BaseURL . 'modules/Commun/view/MenuModeNonRenaultView.php');
include ($BaseURL . 'modules/Commun/view/MenuModeRenaultView.php');
include ($BaseURL . 'modules/Commun/view/MenuModeINDRAView.php');
include ($BaseURL . 'modules/Commun/modele/InscriptionSite.php');
include ($BaseURL . 'modules/Commun/modele/Param.php');
include ($BaseURL . 'modules/Commun/modele/NotificationMail.class.php');
include ($BaseURL . 'modules/Commun/controler/CommunControler.php');

// Document
include ($BaseURL . 'modules/Document/DocInfoDyn/controler/DocumentControler.php');

include ($BaseURL . 'modules/Document/DocStatic/modele/DocStatic.php');
include ($BaseURL . 'modules/Document/DocStatic/Doc_QuiSommesNous.php');
include ($BaseURL . 'modules/Document/DocStatic/Doc_AttentionRedirection.php');
include ($BaseURL . 'modules/Document/DocStatic/Doc_Merci.php');
include ($BaseURL . 'modules/Document/DocStatic/view/DocStaticView.php');

include ($BaseURL . 'modules/Document/DocZoom/modele/DocZoom.php');
include ($BaseURL . 'modules/Document/DocZoom/modele/DocZoomList.php');
include ($BaseURL . 'modules/Document/DocZoom/view/DocZoomListView.php');

include ($BaseURL . 'modules/Document/DocInfoDyn/modele/DocInfoDyn.php');
include ($BaseURL . 'modules/Document/DocInfoDyn/modele/DocInfoDynParType.php');
include ($BaseURL . 'modules/Document/DocInfoDyn/modele/DocInfoDynALaUneList.php');
include ($BaseURL . 'modules/Document/DocInfoDyn/view/DocInfoDynALaUneView.php');
include ($BaseURL . 'modules/Document/DocInfoDyn/view/DocInfoDynView.php');
include ($BaseURL . 'modules/Document/DocInfoDyn/view/ListeDocParTypeView.php');
include ($BaseURL . 'modules/Document/DocInfoDyn/view/ListeThemePourUnType.php');

include ($BaseURL . 'modules/Document/DocForm/DocForm_BESSE.php');
include ($BaseURL . 'modules/Document/DocForm/Doc_PremiereVisite.php');
include ($BaseURL . 'modules/Document/DocForm/Doc_PremiereVisiteImprnet.php');
include ($BaseURL . 'modules/Document/DocForm/DocFormCatalogue.php');
include ($BaseURL . 'modules/Document/DocForm/DocFormCatalogueModel.class.php');

// Categorie
include ($BaseURL . 'modules/Categorie/modele/Categorie.php');
include ($BaseURL . 'modules/Categorie/modele/CategorieList.php');

// Securite
include ($BaseURL . 'modules/Securite/view/ConnectionView.php');
include ($BaseURL . 'modules/Securite/view/MotDePassePerduView.class.php');
include ($BaseURL . 'modules/Securite/modele/SessionSecurite.php');

// Recherche
include ($BaseURL . 'modules/Recherche/modele/RechercheDocument.php');
include ($BaseURL . 'modules/Recherche/view/DocumentRechercheView.php');

include ($BaseURL . 'modules/Banniere/metier/view/BanniereView.php');
include ($BaseURL . 'modules/Banniere/metier/controler/BanniereControler.php');
include ($BaseURL . 'modules/Banniere/metier/modele/Banniere.php');
include ($BaseURL . 'modules/Banniere/metier/modele/BanniereList.php');

// Statistiques
include ($BaseURL . 'modules/Stat/modele/StatDoc.php');
include ($BaseURL . 'modules/Stat/modele/TraceUser.php');
include ($BaseURL . 'modules/Stat/modele/TraceUserDAO.php');

// Deals
include ($BaseURL . 'modules/Deals/metier/controllers/DealsController.php');
include ($BaseURL . 'modules/Deals/metier/modele/Deals.php');
include ($BaseURL . 'modules/Deals/metier/modele/DealParam.php');
include ($BaseURL . 'modules/Deals/metier/view/DealsView.php');
include ($BaseURL . 'modules/Deals/metier/view/DealsView3.php');
include ($BaseURL . 'modules/Deals/metier/view/DealsView4.php');

include ($BaseURL . 'modules/Annuaire/metier/modele/Individu.php');

// Commentaire Article
include ($BaseURL . 'modules/Document/DocInfoDyn/modele/DocInfoDynCommentaire.php');
include ($BaseURL . 'modules/Document/DocInfoDyn/modele/DocInfoDynCommentaireManager.php');
include ($BaseURL . 'modules/Document/DocInfoDyn/modele/DocInfoDynCommentaireDestinataire.php');
include ($BaseURL . 'modules/Document/DocInfoDyn/modele/DocInfoDynCommentaireDestinataireManager.php');

// Newsletter
include ($BaseURL . 'modules/Newsletter/modele/Newsletter.class.php');
include ($BaseURL . 'modules/Newsletter/modele/NewsletterManager.class.php');

?>