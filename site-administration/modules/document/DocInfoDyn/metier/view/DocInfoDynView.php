<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynView {
	private $myDocInfoDyn;
	private $myDocInfoDynCatList;
	private $myDocInfoDynLCA;
	public function __construct($aDocInfoDyn) {
		$this->myDocInfoDyn = $aDocInfoDyn;
		$this->myDocInfoDynCatList = NULL;
		$this->myDocInfoDynLCA = NULL;
	}
	public function setDocInfoDynCatList($newValue) {
		$this->myDocInfoDynCatList = $newValue;
	}
	public function setDocInfoDynLCAList($newValue) {
		$this->myDocInfoDynLCA = $newValue;
	}
	public function render($mod) {
		$aff = '<script  type="text/javascript" > 
				function valider()
				{		
				var i = 0;
				var COCHE = false;		
				for (i=0;i< document.getElementsByName("CatUne").length;i++)
				{
						if(document.getElementsByName("CatUne").item(i).checked)
					{
						COCHE = true;
						break;
					}
				}	
				if(COCHE){
					return true;
					}
				else
				{
					alert("Vous devez sélectionner au moins une Catégorie Principale pour votre document");
					return false;
				}
			}
	
			</script>';

		// Navigation Bar
		$aff .= '<div id="FilAriane"><a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">DocInfoDyn</a>';
		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Creation</div><br/>';
				$aff .= '<form method="POST" onsubmit="return valider(this);" action="?action=new">';
				$aff .= '	<input type="submit" value="Créer">';
				break;
			case 'edit' :
				$aff .= '&nbsp;>&nbsp;Edition</div><br/>';
				$aff .= '<form method="POST" onsubmit=" return valider(this);" action="?action=edit&id=' . $this->myDocInfoDyn->getID () . '">';

				$aDocZoomList = new DocZoomList ();
				$aDocZoomList->SQL_SELECT_BY_DOCINFODYN ( $this->myDocInfoDyn->getID () );

				$aff .= '	<input type="button" value="Publier au Zoom (' . count ( $aDocZoomList->getList () ) . ')" onclick="javascript:location.href=\'../DocZoom/?action=new&id=' . $_GET ['id'] . '\'" />';
				$aff .= '	<input type="submit" onsubmit="valider(this);" value="Mettre à jour">';
				break;
		}
		$aff .= '<br/><br/>';

		$aCategorieList = new CategorieDocInfoDynList ();
		$aCategorieList->SQL_select_all_type ();

		$aff .= '<table width ="100%" class="list" id="myTableCategorie">';
		$aff .= '<tr class="title">';
		$aff .= '	<td width="30%">Type</td><td width="30%">Theme</td><td width="30%" >Metier</td><td>Action</td><td>Cat&eacute;gorie principale</td>';
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

		$aff .= '<table border="0" width="100%">';

		$aff .= '<tr><td colspan="2"><hr width="80%"></td></tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Titre</td>';
		$aff .= '	<td><input type="text" name="Titre" size="100" value="' . stripslashes ( $this->myDocInfoDyn->getTitre () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Accroche</td>';
		$aff .= '	<td><textarea name="Accroche" cols="100"/>' . stripslashes ( $this->myDocInfoDyn->getAccroche () ) . '</textarea></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Vignette Accroche</td>';
		$aff .= '	<td><input type="text" id="ImagesURL" name="ImagesURL" value="' . $this->myDocInfoDyn->getVignetteAccroche () . '"/>';
		$aff .= '	<input type="button" value="Parcourir le serveur" onclick="OpenServerBrowser(\'../../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/></td>';
		$aff .= '</tr>';

		if ($mod != 'new' && $this->myDocInfoDyn->getVignetteAccroche () != '') {
			$aff .= '<tr>';
			$aff .= '	<td>Apercu Vignette Accroche</td>';
			$aff .= '	<td><img src="' . $this->myDocInfoDyn->getVignetteAccroche () . '"/>';
			$aff .= '</tr>';
		}

		$aff .= '<tr>';
		$aff .= '	<td colspan="2">';
		echo $aff;
		include_once ("../../../include/js/fckeditor/fckeditor.php");

		$oFCKeditor = new FCKeditor ( 'FCKeditor1' );
		$oFCKeditor->BasePath = '../../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myDocInfoDyn->getContenuRichText () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '512';
		$oFCKeditor->ToolbarSet = 'WCM';
		$oFCKeditor->Create ();

		$aff = '</td></tr>';

		// #####################################
		// #####################################
		// #####################################

		$aff .= '<tr>';
		$aff .= '	<td>Banniere</td>';
		$aff .= '	<td><select name="BanniereID">';
		$aff .= '		<option value="0" style="font-style:italic"' . (is_null ( $this->myDocInfoDyn->getBanniereID () ) ? ' SELECTED="SELECTED"' : '') . '>[Bannière par Defaut]</option>';

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

		// #####################################
		// #####################################
		// #####################################

		$aff .= '<tr><td colspan="2"><hr width="80%"></td></tr>';

		$aff .= '<tr><td colspan="2"><h3>Visibilité du document</h3></td></tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Publication</td>';
		$aff .= '	<td><input type="checkbox" value="1" name="PublicationALaUne"' . ($this->myDocInfoDyn->getPublicationALaUne () == '1' ? ' checked' : '') . '/>Publié(A La Une)</td>';
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

		// GESTION du public visé

		$aff .= '<tr>';
		$aff .= '	<td>Public Authentifié</td>';
		$aff .= '	<td><input type="radio" name="LCAPublic" value="0" id="LCAPublic1"' . (($mod == 'new' || count ( $this->myDocInfoDynLCA->getList () ) <= 1) ? ' CHECKED' : '') . '/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>Public LCA</td>';
		$aff .= '	<td><input type="radio" name="LCAPublic" value="1" id="LCAPublic2"' . (($mod != 'new' && count ( $this->myDocInfoDynLCA->getList () ) > 1) ? ' CHECKED' : '') . '/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td colspan="2" id="LCATable"' . (($mod == 'new' || count ( $this->myDocInfoDynLCA->getList () ) <= 1) ? ' style="display:none;"' : '') . '>LCA : <a href="#" class="jqModal">Gérer</a><br/>';
		if ($mod == 'new') {
			$aff .= '<input type="hidden" name="counterLCA" id="counterLCA" value="1"/>';
		} else {
			$aff .= '<input type="hidden" name="counterLCA" id="counterLCA" value="' . ($this->myDocInfoDynLCA != NULL && $this->myDocInfoDynLCA->getNbElement () == 0 ? '1' : $this->myDocInfoDynLCA->getNbElement ()) . '"/>';
		}

		$aff .= '<table width="100%" class="list" id="myTable">';
		$aff .= '		<tr class="title"><td>#</td><td>Nom</td></tr>';

		if ($mod != 'new') {
			$i = 1;
			foreach ( $this->myDocInfoDynLCA->getList () as $aLCA ) {
				$tmpGroupe = new Groupe ();
				$tmpGroupe->SQL_select ( $aLCA->getLCAGroupeID () );

				$aff .= '<tr><td><input type="hidden" name="LCARow' . $i ++ . '" value="' . $tmpGroupe->getID () . '"/>' . $tmpGroupe->getID () . '</td><td>' . $tmpGroupe->getName () . '</td></tr>';
			}
		}
		$aff .= '	</table>';
		$aff .= '	</td>';
		$aff .= '</tr>';

		switch ($mod) {
			case 'new' :
				$aff .= '<tr><td colspan="2"><input type="submit" onsubmit="valider(this);" value="Créer"></td></tr>';
				break;
			case 'edit' :
				$aff .= '<tr><td colspan="2"><input type="submit" onsubmit="valider(this);" value="Mettre à jour"></td></tr>';
				break;
		}
		$aff .= '</table>';
		$aff .= '<div class="jqmWindow" id="dialog">';
		$aff .= '<b>Admin&nbsp;>&nbsp;Liste des Groupes LCA</b><br/><br/>';
		$aff .= '<iframe src="ManageLCA.php?' . (isset ( $_GET ['id'] ) ? 'id=' . $_GET ['id'] : '') . '" width="100%" height="300" style="border:0" name="myiframe" id="myiframe"></iframe>';
		$aff .= '<p align="right"><a href="#" id="applyLCAGroupe" class="jqmClose">Appliquer</a>&nbsp;&nbsp;&nbsp;<a href="#" class="jqmClose">Fermer</a></p>';
		$aff .= '</div>';
		$aff .= '</form>';

		echo $aff;
	}
}
?>