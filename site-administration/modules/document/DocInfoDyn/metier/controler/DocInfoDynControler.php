<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
				if (isset ( $_POST ['Titre'] )) {
					// Creation du document
					$aDocument = new DocInfoDyn ();
					$aDocument->setTitre ( str_replace('’','&apos;',trim ( $_POST ['Titre'] )) );
					$aDocument->setAccroche ( str_replace('’','&apos;',trim ( $_POST ['Accroche'] ) ));
					$aDocument->setContenuRichText ( trim ( $_POST ['FCKeditor1'] ) );
					if(isset($_POST ['BanniereID']))
						$aDocument->setBanniereID ( $_POST ['BanniereID'] == '0' ? NULL : $_POST ['BanniereID'] );
					$aDocument->setPublicationALaUne ( $_POST ['PublicationALaUne'] );
					$aDocument->setDateDebut ( $_POST ['DateDebut'] == '' ? NULL : CommunFunction::getDateUS ( $_POST ['DateDebut'] ) );
					$aDocument->setDateFin ( $_POST ['DateFin'] == '' ? NULL : CommunFunction::getDateUS ( $_POST ['DateFin'] ) );
					$aDocument->setVignetteAccroche ( trim ( $_POST ['ImagesURL'] ) );
					if(isset($_POST ['Auteur']))
						$aDocument->setAuteurID ( trim ( $_POST ['Auteur'] ) );
					$aDocument->setCommentaireActif ( $_POST ['CommentaireActif'] );
					$aDocument->SQL_create ();

					// Creation des categories
					for($i = 1; $i < $_POST ['counterCategorie']; $i ++) {
						if (isset ( $_POST ['CatRow' . $i] )) {
							$aDocInfoDynCategorie = new DocInfoDynCategorie ();
							list ( $CatTypeID, $CatThemeID, $CatMetierID ) = preg_split ( "/&+/", trim ( $_POST ['CatRow' . $i] ), 3 );

							$aDocInfoDynCategorie->setDocInfoDynID ( $aDocument->getID () );
							$aDocInfoDynCategorie->setCatTypeID ( $CatTypeID );
							$aDocInfoDynCategorie->setCatThemeID ( $CatThemeID );
							$aDocInfoDynCategorie->setCatMetierID ( $CatMetierID );
							$aDocInfoDynCategorie->setCatUne ( $_POST ['CatUne'] );
							$aDocInfoDynCategorie->SQL_create ();
						}
					}
					// ###################
					// ### GESTION LCA ###
					// ###################

					$aDocInfoDynLCA = new DocInfoDynLCA ();
					$aDocInfoDynLCA->setDocInfoDynID ( $aDocument->getID () );

					$LCACounter = 0;

					$aDocInfoDynLCAList = new DocInfoDynLCAList ();
					$aDocInfoDynLCAList->SQL_SELECT_ALL_DA ();
					foreach ( $aDocInfoDynLCAList->getList () as $aDomaineActivite ) {
						if (isset ( $_POST ['LCAGroupe-' . $aDomaineActivite [0]] )) {
							$aDocInfoDynLCA->setLCAGroupeID ( $aDomaineActivite [0] );
							$aDocInfoDynLCA->SQL_create ();
							$LCACounter ++;
						}
					}
					$aDocInfoDynLCAList->SQL_SELECT_ALL_Commission ();
					foreach ( $aDocInfoDynLCAList->getList () as $aCommission ) {
						if (isset ( $_POST ['LCAGroupe-' . $aCommission [0]] )) {
							$aDocInfoDynLCA->setLCAGroupeID ( $aCommission [0] );
							$aDocInfoDynLCA->SQL_create ();
							$LCACounter ++;
						}
					}
					$aDocInfoDynLCAList->SQL_SELECT_ALL_Region ();
					foreach ( $aDocInfoDynLCAList->getList () as $aRegion ) {
						if (isset ( $_POST ['LCAGroupe-' . $aRegion [0]] )) {
							$aDocInfoDynLCA->setLCAGroupeID ( $aRegion [0] );
							$aDocInfoDynLCA->SQL_create ();
							$LCACounter ++;
						}
					}
					$aDocInfoDynLCAList->SQL_SELECT_ALL_GroupeLCA ();
					foreach ( $aDocInfoDynLCAList->getList () as $aGroupeLCA ) {
						if (isset ( $_POST ['LCAGroupe-' . $aGroupeLCA [0]] )) {
							$aDocInfoDynLCA->setLCAGroupeID ( $aGroupeLCA [0] );
							$aDocInfoDynLCA->SQL_create ();
							$LCACounter ++;
						}
					}

					if ($LCACounter > 0) {
						$aDocInfoDynLCA->setLCAGroupeID ( '1' );
						$aDocInfoDynLCA->SQL_create ();
					} else {
						$aDocInfoDynLCA->setLCAGroupeID ( '0' );
						$aDocInfoDynLCA->SQL_create ();
					}

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aModele = new DocInfoDyn ();
					$aView = new DocInfoDynTabView ( $aModele );
					$aView->renderHTML ( 'new' );
				}
				break;
			case 'edit' :
				if (isset ( $_POST ['Titre'] )) {
					// Creation du document
					$aDocument = new DocInfoDyn ();
					$aDocument->setID ( trim ( $_GET ['id'] ) );
					$aDocument->setTitre ( str_replace('’','&apos;',trim ( $_POST ['Titre'] )) );
					$aDocument->setAccroche ( str_replace('’','&apos;',trim ( $_POST ['Accroche'] )) );
					$aDocument->setContenuRichText ( trim ( $_POST ['FCKeditor1'] ) );
					if(isset($_POST ['BanniereID']))
						$aDocument->setBanniereID ( $_POST ['BanniereID'] == '0' ? NULL : $_POST ['BanniereID'] );
					$aDocument->setPublicationALaUne ( $_POST ['PublicationALaUne'] );
					$aDocument->setDateDebut ( $_POST ['DateDebut'] == '' ? NULL : CommunFunction::getDateUS ( $_POST ['DateDebut'] ) );
					$aDocument->setDateFin ( $_POST ['DateFin'] == '' ? NULL : CommunFunction::getDateUS ( $_POST ['DateFin'] ) );
					$aDocument->setVignetteAccroche ( trim ( $_POST ['ImagesURL'] ) );
					if(isset($_POST ['Auteur']))
						$aDocument->setAuteurID ( trim ( $_POST ['Auteur'] ) );
					$aDocument->setCommentaireActif ( $_POST ['CommentaireActif'] );
					$aDocument->SQL_update ();

					// Creation des categories
					$aDocInfoDynCategorieList = new DocInfoDynCategorieList ();
					$aDocInfoDynCategorieList->SQL_delete_all ( $_GET ['id'] );

					for($i = 1; $i < $_POST ['counterCategorie']; $i ++) {
						if (isset ( $_POST ['CatRow' . $i] )) {
							$aDocInfoDynCategorie = new DocInfoDynCategorie ();

							list ( $CatTypeID, $CatThemeID, $CatMetierID ) = preg_split ( "/&+/", trim ( $_POST ['CatRow' . $i] ), 3 );

							$aDocInfoDynCategorie->setDocInfoDynID ( $aDocument->getID () );
							$aDocInfoDynCategorie->setCatTypeID ( $CatTypeID );
							$aDocInfoDynCategorie->setCatThemeID ( $CatThemeID );
							$aDocInfoDynCategorie->setCatMetierID ( $CatMetierID );
							$aDocInfoDynCategorie->setCatUne ( $_POST ['CatUne'] );
							$aDocInfoDynCategorie->SQL_create ();
						}
					}

					// ###################
					// ### GESTION LCA ###
					// ###################

					// Suppression pour MAJ
					$aDocInfoDynLCAList = new DocInfoDynLCAList ();
					$aDocInfoDynLCAList->SQL_delete_all ( trim ( $_GET ['id'] ) );

					$aDocInfoDynLCA = new DocInfoDynLCA ();
					$aDocInfoDynLCA->setDocInfoDynID ( $aDocument->getID () );

					$LCACounter = 0;

					$aDocInfoDynLCAList = new DocInfoDynLCAList ();
					$aDocInfoDynLCAList->SQL_SELECT_ALL_DA ();
					foreach ( $aDocInfoDynLCAList->getList () as $aDomaineActivite ) {
						if (isset ( $_POST ['LCAGroupe-' . $aDomaineActivite [0]] )) {
							$aDocInfoDynLCA->setLCAGroupeID ( $aDomaineActivite [0] );
							$aDocInfoDynLCA->SQL_create ();
							$LCACounter ++;
						}
					}
					$aDocInfoDynLCAList->SQL_SELECT_ALL_Commission ();
					foreach ( $aDocInfoDynLCAList->getList () as $aCommission ) {
						if (isset ( $_POST ['LCAGroupe-' . $aCommission [0]] )) {
							$aDocInfoDynLCA->setLCAGroupeID ( $aCommission [0] );
							$aDocInfoDynLCA->SQL_create ();
							$LCACounter ++;
						}
					}
					$aDocInfoDynLCAList->SQL_SELECT_ALL_Region ();
					foreach ( $aDocInfoDynLCAList->getList () as $aRegion ) {
						if (isset ( $_POST ['LCAGroupe-' . $aRegion [0]] )) {
							$aDocInfoDynLCA->setLCAGroupeID ( $aRegion [0] );
							$aDocInfoDynLCA->SQL_create ();
							$LCACounter ++;
						}
					}
					$aDocInfoDynLCAList->SQL_SELECT_ALL_GroupeLCA ();
					foreach ( $aDocInfoDynLCAList->getList () as $aGroupeLCA ) {
						if (isset ( $_POST ['LCAGroupe-' . $aGroupeLCA [0]] )) {
							$aDocInfoDynLCA->setLCAGroupeID ( $aGroupeLCA [0] );
							$aDocInfoDynLCA->SQL_create ();
							$LCACounter ++;
						}
					}

					if ($LCACounter > 0) {
						$aDocInfoDynLCA->setLCAGroupeID ( '1' );
						$aDocInfoDynLCA->SQL_create ();
					} else {
						$aDocInfoDynLCA->setLCAGroupeID ( '0' );
						$aDocInfoDynLCA->SQL_create ();
					}

					echo CommunFunction::goToURL ( '?' );
				} else {
					if (isset ( $_GET ['id'] )) {
						$aModele = new DocInfoDyn ();
						$aModele->SQL_select ( $_GET ['id'] );
						$aView = new DocInfoDynTabView ( $aModele );

						$aModeleCatList = new DocInfoDynCategorieList ();
						$aModeleCatList->SQL_select_all ( trim ( $_GET ['id'] ) );
						$aView->setDocInfoDynCatList ( $aModeleCatList );

						$aView->renderHTML ( 'edit' );
					}
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aModele = new DocInfoDyn ();
					$aModele->setID ( $_GET ['id'] );
					$aModele->SQL_delete ();

					$aDocInfoDynCategorieList = new DocInfoDynCategorieList ();
					$aDocInfoDynCategorieList->SQL_delete_all ( trim ( $_GET ['id'] ) );

					$aDocInfoDynLCAList = new DocInfoDynLCAList ();
					$aDocInfoDynLCAList->SQL_delete_all ( trim ( $_GET ['id'] ) );

					echo CommunFunction::goToURL ( '?' );
				}
				break;

			// #############################################
			// ### Vue spécial Split
			// #############################################
			case 'splitView_docInfoDyn' :
				$aDocumentList = new DocInfoDynList ();
				if (isset ( $_GET ['id'] ) && $_GET ['id'] != '0') {
					$aDocumentList->SQL_SELECT_BY_CATEGORIE ( isset ( $_GET ['search'] ) ? $_GET ['search'] : '', $_GET ['id'] );
				} else {
					if (isset ( $_GET ['search'] )) {
						$aDocumentList->SQL_SEARCH ( $_GET ['search'] );
					} else {
						$aDocumentList->SQL_select_all ();
					}
				}
				$aSplitView_DocInfoDyn = new SplitView_DocInfoDyn ( $aDocumentList );
				$aSplitView_DocInfoDyn->renderHTML ();
				break;
			case 'splitView_category' :
				$aCategoryList = new CategorieDocInfoDynList ();

				if (isset ( $_GET ['parent_id'] )) {
					$aCategoryList->SQL_select_all_souscat ( $_GET ['parent_id'] );
					$aSplitView_Category = new SplitView_Category ( $aCategoryList );
					echo $aSplitView_Category->renderLvl2HTML ( $_GET ['parent_id'] );
				} else if (isset ( $_GET ['parent_id2'] )) {
					$aCategoryList->SQL_select_all_souscat ( $_GET ['parent_id2'] );
					$aSplitView_Category = new SplitView_Category ( $aCategoryList );
					echo $aSplitView_Category->renderLvl3HTML ( $_GET ['parent_id2'] );
				} else {
					$aCategoryList->SQL_select_all_type ();
					$aSplitView_Category = new SplitView_Category ( $aCategoryList );
					echo $aSplitView_Category->renderLvl1HTML ();
				}
				break;
			// ### GESTION DES COMMENTAIRES ###

			case 'deleteDestinataire' :
				if (isset ( $_GET ['id'] ) && isset ( $_GET ['id2'] )) {
					$aDestinataire = new DocInfoDynCommentaireDestinataire ();
					$aDestinataire->setDocInfoDynID ( ( int ) $_GET ['id'] );
					$aDestinataire->setIndividuID ( ( int ) $_GET ['id2'] );
					$aManager = new DocInfoDynCommentaireDestinataireManager ();
					$aManager->delete ( $aDestinataire );

					echo CommunFunction::goToURL ( '?action=edit&id=' . $_GET ['id'] );
				}
				break;
			case 'addDestinataire' :
				if (isset ( $_GET ['id'] ) && isset ( $_GET ['id2'] )) {
					$aDestinataire = new DocInfoDynCommentaireDestinataire ();
					$aDestinataire->setDocInfoDynID ( ( int ) $_GET ['id'] );
					$aDestinataire->setIndividuID ( ( int ) $_GET ['id2'] );
					$aManager = new DocInfoDynCommentaireDestinataireManager ();
					$aManager->add ( $aDestinataire );

					echo '<script language="JavaScript">
								window.opener.refreshDestinataire();
								self.close();
							</script>';
				}
				break;
			case 'deleteCommentaire' :
				if (isset ( $_GET ['id'] ) && isset ( $_GET ['id2'] )) {
					$aCommentaire = new DocInfoDynCommentaire ();
					$aCommentaire->setID ( ( int ) $_GET ['id2'] );
					$aManager = new DocInfoDynCommentaireManager ();
					$aManager->delete ( $aCommentaire->getID () );

					echo CommunFunction::goToURL ( '?action=edit&id=' . $_GET ['id'] );
				}
				break;
			case 'viewCommentaire' :
				if (isset ( $_GET ['id'] ) && isset ( $_GET ['id2'] )) {
					$aCommentaire = new DocInfoDynCommentaireManager ();
					$aDocInfoDynCommentaireView = new DocInfoDynCommentaireView ( $aCommentaire->get ( ( int ) $_GET ['id2'] ) );
					$aDocInfoDynCommentaireView->renderHTML ();
				}
				break;
		}
	}
}
?>