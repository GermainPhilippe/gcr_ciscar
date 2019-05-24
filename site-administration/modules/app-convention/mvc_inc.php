<?php

// Release V3.0 //
include ('modules/Page/metier/controllers/ConventionPageController.php');
include ('modules/Page/metier/models/ConventionPage.php');
include ('modules/Page/metier/models/ConventionPageDAO.php');
include ('modules/Page/metier/views/ConventionPageView.php');
include ('modules/Page/metier/views/ConventionPagePreviewView.php');
include ('modules/Page/metier/views/ConventionPageListView.php');

include ('modules/Annuaire/metier/modele/Annuaire.php');
include ('modules/Annuaire/metier/modele/AnnuaireList.php');
include ('modules/Annuaire/metier/view/AnnuaireListWithFilterView.php');
include ('modules/Annuaire/metier/view/AnnuaireView.php');
include ('modules/Annuaire/metier/view/AnnuaireImportView.php');
include ('modules/Annuaire/metier/controler/AnnuaireControler.php');
include ('modules/Annuaire/metier/modele/UserHistory.php');
include ('modules/Annuaire/metier/modele/UserHistoryDAO.php');

include ('modules/Formulaire/metier/modele/ConventionFormulaire.php');
include ('modules/Formulaire/metier/modele/ConventionFormulaireDAO.php');
include ('modules/Formulaire/metier/view/ConventionFormulaireListView.php');
include ('modules/Formulaire/metier/view/ConventionFormulaireView.php');
include ('modules/Formulaire/metier/view/ConventionFormulaireFieldView.php');
include ('modules/Formulaire/metier/view/ConventionFormulaireComposantView.php');
include ('modules/Formulaire/metier/view/ConventionFormulaireComposantListePageView.php');
include ('modules/Formulaire/metier/view/ConventionFormulaireComposantZoneTextView.php');
include ('modules/Formulaire/metier/view/ConventionFormulaireComposantBandeauView.php');
include ('modules/Formulaire/metier/controler/ConventionFormulaireControler.php');
include ('modules/Formulaire/metier/controler/ConventionFormulaireFieldController.php');
include ('modules/Formulaire/metier/controler/ConventionFormulaireComposantController.php');
include ('modules/Formulaire/metier/modele/ConventionFormulaireComposition.php');
include ('modules/Formulaire/metier/modele/ConventionFormulaireCompositionDAO.php');
include ('modules/Formulaire/metier/modele/ConventionFormulaireField.php');
include ('modules/Formulaire/metier/modele/ConventionFormulaireFieldDAO.php');
include ('modules/Formulaire/metier/modele/ConventionFormulaireComposant.php');
include ('modules/Formulaire/metier/modele/ConventionFormulaireComposantDAO.php');
include ('modules/Formulaire/metier/modele/ConventionFormulaireFieldResponse.php');
include ('modules/Formulaire/metier/modele/ConventionFormulaireFieldResponseDAO.php');
// Release V2.0 //

// ### Parametre ###

include ('modules/Parametre/metier/modele/Parametre.php');
include ('modules/Parametre/metier/modele/ParametreMail.php');
include ('modules/Parametre/metier/modele/ParametreList.php');
include ('modules/Parametre/metier/modele/ParamTypeDomaine.php');
include ('modules/Parametre/metier/view/ParametreView.php');
include ('modules/Parametre/metier/view/ParametreMailView.php');
include ('modules/Parametre/metier/view/ParametreListView.php');
include ('modules/Parametre/metier/controler/ParametreControler.php');
include ('modules/Parametre/metier/modele/DomaineActivite.php');
include ('modules/Parametre/metier/modele/DomaineActiviteList.php');
include ('modules/Parametre/metier/view/DomaineActiviteListView.php');

// ### Convention ###

include ('modules/Convention/metier/modele/Convention.php');
include ('modules/Convention/metier/modele/ConventionList.php');
include ('modules/Convention/metier/modele/ConventionHistorique.php');
include ('modules/Convention/metier/modele/ConventionHistoriqueList.php');
include ('modules/Convention/metier/modele/PhaseConvention.php');
include ('modules/Convention/metier/view/ConventionHistoriqueListView.php');
include ('modules/Convention/metier/view/ConventionView.php');
include ('modules/Convention/metier/view/ConventionListView.php');
include ('modules/Convention/metier/controler/ConventionControler.php');

?>