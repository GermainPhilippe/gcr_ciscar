<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynTabView {
	private $myDocInfoDyn;
	private $myDocInfoDynLCA;
	public function __construct($aDocInfoDyn) {
		$this->myDocInfoDyn = $aDocInfoDyn;
	}
	public function setDocInfoDynCatList($newValue) {
		$this->myDocInfoDynCatList = $newValue;
	}

	// ###
	public function renderHTML($mod) {
		$aff = HelperHead::includeJS ( 'include/DocumentTabView.js' );

		// Fil D'ariane
		$aff .= '<div id="FilAriane">';
		$aff .= '<a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">DocInfoDyn</a>';
		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Création';
				break;
			case 'edit' :

				$aCategorieList = new CategorieDocInfoDynList ();
				$aCategorieList->SQL_select_all_type ();
				$list = $this->myDocInfoDynCatList->getList ();
				$aCat = $list [0];

				$tmpCatType = new CategorieDocInfoDyn ();
				$tmpCatType->SQL_select ( $aCat->getCatTypeID () );

				$tmpCatTheme = new CategorieDocInfoDyn ();
				$tmpCatTheme->SQL_select ( $aCat->getCatThemeID () );

				$aff .= '&nbsp;>&nbsp;<a href="?cat=' . $tmpCatType->getID () . '">' . $tmpCatType->getDescription () . '</a>';
				$aff .= '&nbsp;>&nbsp;<a href="?cat=' . $tmpCatTheme->getID () . '">' . $tmpCatTheme->getDescription () . '</a>';
				$aff .= '&nbsp;>&nbsp;' . $this->myDocInfoDyn->getTitre ();
				break;
		}
		$aff .= '</div>';

		// Bouton
		switch ($mod) {
			case 'new' :
				$aff .= '<form method="POST" name="formDocInfoDyn" onsubmit="return valider()" action="?action=new">';
				$aff .= '<p></p>';
				break;
			case 'edit' :
				$aff .= '<form method="POST" name="formDocInfoDyn" onsubmit="return valider()" action="?action=edit&id=' . $this->myDocInfoDyn->getID () . '">';
				$aff .= '<p></p>';
				break;
		}

		$aff .= '<table width="100%" border="1" cellspacing="0" cellpadding="5">';
		$aff .= '<tr>';
		$aff .= '<td rowspan="6" width="100" valign="top">';
		$aff .= '	<a href="javascript:displayTab(\'1\')" class="linkTabDocumentCurrent" id="linkTabGeneral">Général</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'2\')" class="linkTabDocument" id="linkTabCategorie">Catégorie</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'3\')" class="linkTabDocument" id="linkTabContenuRiche">Contenu Riche</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'4\')" class="linkTabDocument" id="linkTabPublication">Publication</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'5\')" class="linkTabDocument" id="linkTabSecurite">Sécurité</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'6\')" class="linkTabDocument" id="linkTabCommentaire">Commentaire</a><br/>';
		$aff .= '</td>';
		// Tab General
		$aff .= '<td id="tabGeneral" class="tabDocument" valign="top">';
		$aff .= $this->renderTabGeneral ( $mod );
		$aff .= '</td>';
		$aff .= '</tr>';
		// Tab Categorie
		$aff .= '<tr><td id="tabCategorie" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->renderTabCategorie ( $mod );
		$aff .= '</td></tr>';
		// Tab Contenu Riche
		$aff .= '<tr><td id="tabContenuRiche" class="tabDocument" style="display:none;" valign="top">';
		echo $aff;
		$this->renderTabContenuRiche ();
		$aff = '</td></tr>';
		// Tab Publication
		$aff .= '<tr><td id="tabPublication" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->renderTabPublication ( $mod );
		$aff .= '</td></tr>';
		// Tab Sécurité
		$aff .= '<tr><td id="tabSecurite" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->renderTabSecurite ( $mod );
		$aff .= '</td></tr>';
		// Tab Commentaire
		$aff .= '<tr><td id="tabCommentaire" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->renderTabCommentaire ( $mod );
		$aff .= '</td></tr>';
		$aff .= '</table>';

		// Bouton
		switch ($mod) {
			case 'new' :
				$aff .= '<input type="submit" value="Créer" />';
				break;
			case 'edit' :
				$aff .= '<input type="button" value="Enregistrer" onclick="Form.DocInfoDyn.btEnregistrer()" /> ';
				$aff .= '<input type="button" value="Enregistrer et Fermer" onclick="Form.DocInfoDyn.btEnregistrerEtFermer()"/>';
				break;
		}

		$aff .= '</form>';

		echo $aff;
	}

	// ###
	private function renderTabGeneral($mod) {
		$aff = '<table>';

		$aff .= '<tr>';
		$aff .= '	<td>Titre*</td>';
		$aff .= '	<td><input type="text" name="Titre" value="' . $this->myDocInfoDyn->getTitre () . '" size="100"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Accroche</td>';
		$aff .= '	<td><textarea name="Accroche" cols="100">' . $this->myDocInfoDyn->getAccroche () . '</textarea></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Vignette Accroche</td>';
		$aff .= '	<td><input type="text" id="ImagesURL" name="ImagesURL" value="' . $this->myDocInfoDyn->getVignetteAccroche () . '" size="80"/>';
		$aff .= '	<input type="button" value="Parcourir le serveur" onclick="OpenServerBrowser(\'../../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/></td>';
		$aff .= '</tr>';

		if ($mod != 'new' && $this->myDocInfoDyn->getVignetteAccroche () != '') {
			$aff .= '<tr>';
			$aff .= '	<td>Aperçu Vignette Accroche</td>';
			$aff .= '	<td><img src="' . $this->myDocInfoDyn->getVignetteAccroche () . '"/>';
			$aff .= '</tr>';
		}
		if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == '1') {
			$aff .= '<tr>';
			$aff .= '	<td>Bannière</td>';
			$aff .= '	<td><select name="BanniereID">';
			$aff .= '		<option value="0" style="font-style:italic"' . (is_null ( $this->myDocInfoDyn->getBanniereID () ) ? ' SELECTED="SELECTED"' : '') . '>[Bannière par Défaut]</option>';

			$aBanniereList = new BanniereList ();
			$aBanniereList->SQL_SELECT_ALL_PUBLIE ();
			foreach ( $aBanniereList->getList () as $aBanniere ) {
				$aff .= '<option value="' . $aBanniere->getID () . '"' . ($aBanniere->getID () == $this->myDocInfoDyn->getBanniereID () ? ' SELECTED="SELECTED"' : '') . '>' . htmlentities ( $aBanniere->getTitre (), ENT_QUOTES ) . '</option>';
			}
			$aff .= '</select></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '	<td>Auteur</td>';
			$aff .= '	<td><input type="text" value="' . $this->myDocInfoDyn->getAuteurID () . '" name="Auteur" maxlenght="250" size="60"/> <img src="../../../include/images/info.jpg" title="Saisie libre (250 caractères)"/></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table>';
		return $aff;
	}
	private function renderTabCategorie($mod) {
		$aff = '';

		$aCategorieList = new CategorieDocInfoDynList ();
		$aCategorieList->SQL_select_all_type ();

		$aff .= '<table width ="100%" class="list" id="myTableCategorie">';
		$aff .= '<tr class="title">';
		$aff .= '	<td width="30%">Type</td><td width="30%">Thème</td><td width="30%" >Métier</td><td>Action</td><td>Cat&eacute;gorie principale</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		if ($mod == 'new') {
			$aff .= '<td><input  type="hidden" name="counterCategorie" id="counterCategorie" value="1"/><select style="width:100%" name="CatType" id="CatType">';
		} else {
			$aff .= '<td><input  type="hidden" name="counterCategorie" id="counterCategorie" value="' . ($this->myDocInfoDynCatList != NULL && $this->myDocInfoDynCatList->getNbElement () == 0 ? '1' : $this->myDocInfoDynCatList->getNbElement ()) . '"/><select name="CatType" id="CatType">';
		}

		$aff .= '<option value="0" SELECTED="SELECTED"></option>';
		foreach ( $aCategorieList->getList () as $aType ) {
			$aff .= '<option value="' . $aType->getID () . '">' . htmlentities ( $aType->getDescription (), ENT_QUOTES ) . '</option>';
		}
		$aff .= '</select></td><td>';

		$aff .= '	<select style="width:100%" name="CatTheme" id="CatTheme">';
		$aff .= '		<option value="0" SELECTED="SELECTED"></option>';
		$aff .= '	</select></td><td>';

		$aff .= '	<select  style="width:100%" name="CatMetier" id="CatMetier">';
		$aff .= '		<option  value="0" SELECTED="SELECTED"></option>';
		$aff .= '	</select></td>';
		$aff .= '	<td align="center" width="50"><a href="#" class="addCategorie"><img src="../../../include/images/bt/bt_plus_grey.png" border="0"/></a></td>';
		$aff .= '  <td align="center" ></td></tr>';

		if ($mod != 'new') {
			$i = 1;
			foreach ( $this->myDocInfoDynCatList->getList () as $aCat ) {
				$tmpCatType = new CategorieDocInfoDyn ();
				$tmpCatType->SQL_select ( $aCat->getCatTypeID () );

				$tmpCatTheme = new CategorieDocInfoDyn ();
				$tmpCatTheme->SQL_select ( $aCat->getCatThemeID () );

				$tmpCatMetier = new CategorieDocInfoDyn ();
				$tmpCatMetier->SQL_select ( $aCat->getCatMetierID () );

				$tmpCatUne = new CategorieDocInfoDyn ();
				$tmpCatUne->SQL_select ( $aCat->getCatUne () );

				$aff .= '<tr><td><input type="hidden" name="CatRow' . $i ++ . '" value="' . $aCat->getCatTypeID () . '&' . $aCat->getCatThemeID () . '&' . $aCat->getCatMetierID () . '"/>' . $tmpCatType->getDescription () . '</td><td>' . $tmpCatTheme->getDescription () . '</td><td>' . $tmpCatMetier->getDescription () . '</td><td width="50" align="center"><a href="#" onclick="removeRow(this)"><img src="../../../include/images/bt/bt_moins.png" border="0"/></a></td><td align ="center"><input type="radio"';
				if ($aCat->getCatTypeID () == $aCat->getCatUne ()) {
					$aff .= 'checked';
				}
				$aff .= ' value="' . $aCat->getCatTypeID () . '" name="CatUne" /></td></tr>';
			}
		}
		$aff .= '</table>';

		return $aff;
	}
	private function renderTabContenuRiche() {
		include_once ("../../../include/js/fckeditor/fckeditor.php");

		$oFCKeditor = new FCKeditor ( 'FCKeditor1' );
		$oFCKeditor->BasePath = '../../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myDocInfoDyn->getContenuRichText () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '512';
		$oFCKeditor->ToolbarSet = 'WCM';
		$oFCKeditor->Create ();
	}
	private function renderTabPublication($mod) {
		$aff = '<table>';

		$aff .= '<tr>';
		$aff .= '	<td colspan="2"><u>Publication WCM :</u></td>';
		$aff .= '</tr>';

		// On force les dates de début et de fin
		$date_debut = date ( 'Y-m-d' );
		if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == '1') {
			$date_fin = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ) + 3, date ( 'd' ), date ( 'Y' ) ) );
		} else {
			$date_fin = date ( 'Y-m-d', mktime ( 0, 0, 0, date ( 'm' ), date ( 'd' ), date ( 'Y' ) + 3 ) );
		}

		$aff .= '<tr>';
		$aff .= '	<td>Date Début</td>';
		$aff .= '	<td><input type="text" name="DateDebut" id="DateDebut" value="' . ($mod == 'new' ? CommunFunction::getDateFR ( $date_debut ) : ($this->myDocInfoDyn->getDateDebut () != '' ? CommunFunction::getDateFR ( $this->myDocInfoDyn->getDateDebut () ) : '')) . '" >';
		$aff .= '<script type="text/javascript">';
		$aff .= '$(document).ready(function() {';
		$aff .= '			$("#DateDebut").datepicker( { dateFormat: \'dd/mm/yy\' } );';
		$aff .= '		});';
		$aff .= '</script>';
		$aff .= '</td></tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Date Fin</td>';
		$aff .= '	<td><input type="text" name="DateFin" id="DateFin" value="' . ($mod == 'new' ? CommunFunction::getDateFR ( $date_fin ) : ($this->myDocInfoDyn->getDateFin () != '' ? CommunFunction::getDateFR ( $this->myDocInfoDyn->getDateFin () ) : '')) . '" />';
		$aff .= '<script type="text/javascript">';
		$aff .= '$(document).ready(function() {';
		$aff .= '	$("#DateFin").datepicker( { dateFormat: \'dd/mm/yy\' } );';
		$aff .= '});';
		$aff .= '</script>';
		$aff .= '</td></tr>';

		if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == '2') {
			$aff .= '<tr>';
			$aff .= '	<td></td>';
			$aff .= '	<td style="visibility:hidden;"><input type="radio" name="PublicationALaUne" value="1"' . ($this->myDocInfoDyn->getPublicationALaUne () == '1' ? ' checked' : '') . '/> OUI <input type="radio" name="PublicationALaUne" value="0"' . ($this->myDocInfoDyn->getPublicationALaUne () != '1' ? ' checked' : '') . '/>NON</td>';
			$aff .= '</tr>';
		} else {
			$aff .= '<tr>';
			$aff .= '	<td colspan="2">&nbsp;</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '	<td colspan="2"><u>Publication "A La Une" :</u></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '	<td>Visibilité</td>';
			$aff .= '	<td><input type="radio" name="PublicationALaUne" value="1"' . ($this->myDocInfoDyn->getPublicationALaUne () == '1' ? ' checked' : '') . '/> OUI <input type="radio" name="PublicationALaUne" value="0"' . ($this->myDocInfoDyn->getPublicationALaUne () != '1' ? ' checked' : '') . '/>NON</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '	<td colspan="2">&nbsp;</td>';
			$aff .= '</tr>';
		}

		$aff .= '<tr>';
		$aff .= '	<td colspan="2"><u>Publication "Zoom" :</u></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td colspan="2">';
		$aDocZoomList = new DocZoomList ();
		$aDocZoomList->SQL_SELECT_BY_DOCINFODYN ( $this->myDocInfoDyn->getID () );
		$aff .= '<input type="button" value="Publier au Zoom (' . count ( $aDocZoomList->getList () ) . ')" ' . ($mod == 'edit' ? 'onclick="javascript:location.href=\'../DocZoom/?action=new&id=' . $_GET ['id'] . '\'"' : '') . ' ' . ($mod == 'new' ? ' disabled' : '') . '/>';
		$aff .= '	</td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		return $aff;
	}
	private function renderTabSecurite($mod) {
		$aDocInfoDynLCAList = new DocInfoDynLCAList ();
		$LCAGroupe = array ();
		if ($mod == 'edit') {
			$aDocInfoDynLCAList->SQL_SELECT_ALL_GROUPE ( $this->myDocInfoDyn->getID () );
			$LCAGroupe = $aDocInfoDynLCAList->getList ();
		}

		$aff = '';

		$aff .= '<table id="TableList">';
		$aff .= '<tr class="title"><td align="left" colspan="2"><a href="javascript:ExpendLCATab(\'4\')"><img src="../../../include/images/1.png" border="0"/> Groupe LCA</a></td></tr>';
		$aDocInfoDynLCAList->SQL_SELECT_ALL_GroupeLCA ();
		foreach ( $aDocInfoDynLCAList->getList () as $aDomaineActivite ) {
			$aff .= '<tr class="lcaRow4" style="display:none;"><td width="40" align="center"><input type="checkbox" value="1" name="LCAGroupe-' . $aDomaineActivite [0] . '"' . (in_array ( $aDomaineActivite [0], $LCAGroupe ) ? ' CHECKED' : '') . '/></td><td>' . $aDomaineActivite [1] . '</td></tr>';
		}
		$aff .= '</table>';

		$aff .= '<table id="TableList">';
		$aff .= '<tr class="title"><td align="left" colspan="2"><a href="javascript:ExpendLCATab(\'1\')"><img src="../../../include/images/1.png" border="0"/> Domaine d\'Activité</a></td></tr>';
		$aDocInfoDynLCAList->SQL_SELECT_ALL_DA ();
		foreach ( $aDocInfoDynLCAList->getList () as $aDomaineActivite ) {
			$aff .= '<tr class="lcaRow1" style="display:none;"><td width="40" align="center"><input type="checkbox" value="1" name="LCAGroupe-' . $aDomaineActivite [0] . '"' . (in_array ( $aDomaineActivite [0], $LCAGroupe ) ? ' CHECKED' : '') . '/></td><td>' . $aDomaineActivite [1] . '</td></tr>';
		}
		$aff .= '</table>';

		$aff .= '<table id="TableList">';
		$aff .= '<tr class="title"><td align="left" colspan="2"><a href="javascript:ExpendLCATab(\'2\')"><img src="../../../include/images/1.png" border="0"/> Commission / Groupe de Travail</a></td></tr>';
		$aDocInfoDynLCAList->SQL_SELECT_ALL_Commission ();
		foreach ( $aDocInfoDynLCAList->getList () as $aCommission ) {
			$aff .= '<tr class="lcaRow2" style="display:none;"><td width="40" align="center"><input type="checkbox" value="1" name="LCAGroupe-' . $aCommission [0] . '"' . (in_array ( $aCommission [0], $LCAGroupe ) ? ' CHECKED' : '') . '/></td><td>' . $aCommission [1] . '</td></tr>';
		}
		$aff .= '</table>';

		$aff .= '<table id="TableList">';
		$aff .= '<tr class="title"><td align="left" colspan="2"><a href="javascript:ExpendLCATab(\'3\')"><img src="../../../include/images/1.png" border="0"/> Région</a></td></tr>';
		$aDocInfoDynLCAList->SQL_SELECT_ALL_Region ();
		foreach ( $aDocInfoDynLCAList->getList () as $aRegion ) {
			$aff .= '<tr class="lcaRow3" style="display:none;"><td width="40" align="center"><input type="checkbox" value="1" name="LCAGroupe-' . $aRegion [0] . '"' . (in_array ( $aRegion [0], $LCAGroupe ) ? ' CHECKED' : '') . '/></td><td>' . $aRegion [1] . '</td></tr>';
		}
		$aff .= '</table>';

		return $aff;
	}
	private function renderTabCommentaire($mod) {
		$aff = 'Activer les commentaires :';
		$aff .= '<input type="radio" name="CommentaireActif" value="1"' . ($this->myDocInfoDyn->getCommentaireActif () == '1' ? ' CHECKED=CHECKED' : '') . '> OUI';
		$aff .= '<input type="radio" name="CommentaireActif" value="0"' . ($this->myDocInfoDyn->getCommentaireActif () == '0' ? ' CHECKED=CHECKED' : '') . '> NON<br/>';

		$aff .= '<script type="text/javascript">
      				$("input[type=radio][@name=CommentaireActif]").change(function(){
						if($(this).val()==\'1\')
							$("#CommentaireDiv").show();
						else 
							$("#CommentaireDiv").hide();
						
					});
					
					function addDestinataire()
					{
						windowParent = window.open("addDestinataire.php?id=' . $this->myDocInfoDyn->getID () . '","Commentaire");
					}
					
					function refreshDestinataire()
					{
						$.ajax({
						   type: "GET",
						   url: "metier/view/GetDocInfoDynCommentaireDestinataireAJAX.php?id=' . $this->myDocInfoDyn->getID () . '",
						   success: function(msg){
								$("#CommentaireDestinataireContent").html(msg);
							}
						});
						return false;
					}
					</script>';

		$aff .= '<br><div id="CommentaireDiv"' . ($this->myDocInfoDyn->getCommentaireActif () == '0' ? 'style="display:none;"' : '') . '>';
		if ($mod != 'new') {
			$aff .= '<h3>Liste des destinataires</h3>';
			$aff .= '<input type="button" onclick="javascript:addDestinataire()" value="Ajouter Destinataire"/>';

			$aff .= '<div id="CommentaireDestinataireContent">';
			$aff .= '<table width="100%" id="TableList">';
			$aff .= '<tr class="title">';
			$aff .= '	<td>Nom Prénom</td>';
			$aff .= '	<td>Mail</td>';
			$aff .= '	<td width="50">Action</td>';
			$aff .= '</tr>';

			$aDestinataireManager = new DocInfoDynCommentaireDestinataireManager ();
			$anArray = $aDestinataireManager->getList ( $this->myDocInfoDyn->getID () );

			foreach ( $anArray as $aDestinataire ) {
				$aIndividu = new Simple_Individu ();
				$aIndividu->SQL_SELECT ( $aDestinataire->getIndividuID () );

				$aff .= '<tr>';
				$aff .= '	<td align="center">' . $aIndividu->getNom () . ' ' . $aIndividu->getPrenom () . '</td>';
				$aff .= '	<td align="center">' . $aIndividu->getMail () . '</td>';
				$aff .= '	<td width="50" align="center"><a href="javascript:confirmBeforeGoTo(\'Confirmation de suppression\',\'?action=deleteDestinataire&id=' . $this->myDocInfoDyn->getID () . '&id2=' . $aDestinataire->getIndividuID () . '\')"><img src="../../../include/images/garbage_empty.png" border=0/></a></td>';
				$aff .= '</tr>';
			}
			$aff .= '</table></div>';
		} else {
			$aff .= '<i>L\'ajout de destinataires se fera une fois le document enregistré !</i>';
		}
		$aff .= '</div>';

		$aff .= '<br><h3>Liste des commentaires</h3>';
		$aff .= '<table width="100%" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '	<td>Date</td>';
		$aff .= '	<td>Auteur</td>';
		$aff .= '	<td>Commentaire</td>';
		$aff .= '	<td width="100" colspan="2">Action</td>';
		$aff .= '</tr>';

		// Liste des commentaires
		$aDocInfoDynCommentaireManager = new DocInfoDynCommentaireManager ();
		$anArray = array ();
		if ($mod != 'new') {
			$anArray = $aDocInfoDynCommentaireManager->getList ( $this->myDocInfoDyn->getID () );
		}
		foreach ( $anArray as $aCommentaire ) {
			$aIndividu = new Simple_Individu ();
			$aIndividu->SQL_SELECT ( $aCommentaire->getAuthorID () );

			$aff .= '<tr>';
			$aff .= '	<td align="center">' . $aCommentaire->getDateCreation () . '</td>';
			$aff .= '	<td align="center">' . $aIndividu->getNom () . ' ' . $aIndividu->getPrenom () . '</td>';
			$aff .= '	<td>' . substr ( htmlentities ( stripslashes ( $aCommentaire->getRichTextContentValue () ) ), 0, 50 ) . '...</td>';
			$aff .= '	<td width="50" align="center"><a target="_BLANK" href="?action=viewCommentaire&id=' . $this->myDocInfoDyn->getID () . '&id2=' . $aCommentaire->getID () . '"><img src="../../../include/images/apercu.jpg" border=0/></a></td>';
			$aff .= '	<td width="50" align="center"><a href="javascript:confirmBeforeGoTo(\'Confirmation de suppression\',\'?action=deleteCommentaire&id=' . $this->myDocInfoDyn->getID () . '&id2=' . $aCommentaire->getID () . '\')"><img src="../../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>';
		}
		$aff .= '</table>';

		return $aff;
	}
}

?>