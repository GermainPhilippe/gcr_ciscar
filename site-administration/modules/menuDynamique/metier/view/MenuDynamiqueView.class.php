<?php
class MenuDynamiqueView {
	private $myMenuDynamique;
	public function __construct(MenuDynamique $aMenuDynamique) {
		$this->myMenuDynamique = $aMenuDynamique;
	}
	public function renderHTML($mod) {
		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">MenuDynamique</a>';
		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Création';
				break;
			case 'update' :
				$aff .= '&nbsp;>&nbsp;Modification';
				break;
		}
		$aff .= '</div><br/><br/>';

		switch ($mod) {
			case 'new' :
				$aff .= '<form method="post" action="?action=new" onsubmit="return validationMenuForm()">';
				break;
			case 'update' :
				$aff .= '<form method="post" action="?action=update&id=' . $this->myMenuDynamique->getID () . '" onsubmit="return validationMenuForm()">';
				break;
		}

		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '<td>Menu Parent</td>';
		$aff .= '<td><select name="pParentMenu" id="pParentMenu">';
		$aff .= '<option value="0"' . (is_null ( $this->myMenuDynamique->getParentID () ) ? ' SELECTED=SELECTED' : '') . '>- Aucun -</option>';
		$aMenuDynamiqueManager = new MenuDynamiqueManager ();
		foreach ( $aMenuDynamiqueManager->getParentMenuList () as $aMenuDynamique ) {
			$aff .= '<option value="' . $aMenuDynamique->getID () . '"' . ($this->myMenuDynamique->getParentID () == $aMenuDynamique->getID () ? ' SELECTED=SELECTED' : '') . '>' . stripcslashes ( $aMenuDynamique->getName () ) . '</option>';
		}
		$aff .= '</select></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td width="150">Nom *</td>';
		$aff .= '<td><input type="text" name="pNom" id="pNom" value="' . stripslashes ( $this->myMenuDynamique->getName () ) . '"></td>';
		$aff .= '</tr>';

		// Niveau 1
		$aff .= '<tr class="trParent"' . ((is_null ( $this->myMenuDynamique->getParentID () ) || $this->myMenuDynamique->getParentID () == 0) ? '' : ' style="display:none;"') . '>';
		$aff .= '<td>Icone dépliée</td>';
		$aff .= '<td><input  type="text"  size="60" id="ImagesURL" name="ImagesURL" value="' . $this->myMenuDynamique->getIconeDeplie () . '">';
		$aff .= '<input type="button" value="Parcourir le serveur" onclick="OpenServerBrowser(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/>';
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '<tr class="trParent"' . ((is_null ( $this->myMenuDynamique->getParentID () ) || $this->myMenuDynamique->getParentID () == 0) ? '' : ' style="display:none;"') . '>';
		$aff .= '<td>Icone pliée</td>';
		$aff .= '<td><input type="text" size="60" id="ImagesURL2" name="ImagesURL2" value="' . $this->myMenuDynamique->getIconePlie () . '">';
		$aff .= '<input type="button" value="Parcourir le serveur" onclick="OpenServerBrowser2(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/>';
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '<tr class="trParent"' . ((is_null ( $this->myMenuDynamique->getParentID () ) || $this->myMenuDynamique->getParentID () == 0) ? '' : ' style="display:none;"') . '>';
		$aff .= '<td>Statut de départ</td>';
		$aff .= '<td><select name="pStatutDepart">';
		$aff .= '<option value="' . MenuDynamique::STATUT_PLIE . '"' . ($this->myMenuDynamique->getStatutDepart () == MenuDynamique::STATUT_PLIE ? ' SELECTED=SELECTED' : '') . '> Plié</option>';
		$aff .= '<option value="' . MenuDynamique::STATUT_DEPLIE . '"' . ($this->myMenuDynamique->getStatutDepart () == MenuDynamique::STATUT_DEPLIE ? ' SELECTED=SELECTED' : '') . '> Déplié</option>';
		$aff .= '<option value="' . MenuDynamique::STATUT_FIXE_PLIE . '"' . ($this->myMenuDynamique->getStatutDepart () == MenuDynamique::STATUT_FIXE_PLIE ? ' SELECTED=SELECTED' : '') . '> Plié fixe</option>';
		$aff .= '<option value="' . MenuDynamique::STATUT_FIXE_DEPLIE . '"' . ($this->myMenuDynamique->getStatutDepart () == MenuDynamique::STATUT_FIXE_DEPLIE ? ' SELECTED=SELECTED' : '') . '> Déplié fixe</option>';
		$aff .= '</select></td>';
		$aff .= '</tr>';

		// Niveau 2
		$aff .= '<tr class="trEnfant"' . ((is_null ( $this->myMenuDynamique->getParentID () ) || $this->myMenuDynamique->getParentID () == 0) ? ' style="display:none;"' : '') . '>';
		$aff .= '<td>Type de vue</td>';
		$aff .= '<td><select name="pTypeVue" id="pTypeVue">';
		$aMenuDynamiqueVueManager = new MenuDynamiqueVueManager ();
		foreach ( $aMenuDynamiqueVueManager->getList () as $aMenuDynamiqueVue ) {
			$aff .= '<option value="' . $aMenuDynamiqueVue->getID () . '"' . ($this->myMenuDynamique->getTypeVueID () == $aMenuDynamiqueVue->getID () ? ' SELECTED=SELECTED' : '') . '>' . $aMenuDynamiqueVue->getName () . '</option>';
		}
		$aff .= '</select></td>';
		$aff .= '</tr>';

		$aff .= '<tr id="ElementSuplementaire" class="trEnfant"' . ((is_null ( $this->myMenuDynamique->getParentID () ) || $this->myMenuDynamique->getParentID () == 0) ? ' style="display:none;"' : '') . '>';
		$aff .= '<td>Information suplémentaire</td>';

		switch ($this->myMenuDynamique->getTypeVueID ()) {
			case '1' :
			case '2' :
			case '3' :
			case '4' :
			case '5' :
				$aCategorieDocInfoDyn = new CategorieDocInfoDyn ();
				$aCategorieDocInfoDyn->SQL_select ( $this->myMenuDynamique->getElementID () );
				$displayValue = $aCategorieDocInfoDyn->getDescription ();
				break;
			case '6' :
				$aDocStatic = new DocStatic ();
				$aDocStatic->SQL_select ( $this->myMenuDynamique->getElementID () );
				$displayValue = $aDocStatic->getTitre ();
				break;
			case '7' :
				$aDocInfoDyn = new DocInfoDyn ();
				$aDocInfoDyn->SQL_select ( $this->myMenuDynamique->getElementID () );
				$displayValue = $aDocInfoDyn->getTitre ();
				break;
			default :
				$displayValue = $this->myMenuDynamique->getElementID ();
				break;
		}
		$aff .= '<td><input type="hidden" id="pElmentID" name="pElmentID" value="' . $this->myMenuDynamique->getElementID () . '"><input type="text" id="pElmentIDDisplay" name="pElmentIDDisplay" size="50" value="' . $displayValue . '"><input type="button" id="bPlus" value="+" onclick="openWindowSelection()"></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Num Ordre</td>';
		$aff .= '<td><input type="text" name="pNumOrdre" value="' . $this->myMenuDynamique->getNumOrdre () . '"></td>';
		$aff .= '</tr>';

		$aff .= '</table>';

		switch ($mod) {
			case 'new' :
				$aff .= '<input type="submit" name="submitButton" value="Créer"/></form>';
				break;
			case 'update' :
				$aff .= '<input type="submit" name="submitButton" value="Mettre à jour"/></form>';
				break;
		}

		echo $aff;
	}
}
?>