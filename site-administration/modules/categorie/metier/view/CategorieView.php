<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage categorie
 * @version 1.0.4
 */
class CategorieDocInfoDynView {
	private $myCategorie;
	public function __construct($aCategorie) {
		$this->myCategorie = $aCategorie;
	}
	public function render($mod) {
		$aff = '<div id="FilAriane"><a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">Catégorie</a>';
		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Création</div><br/><br/>';
				$aff .= '<form method="POST" name="formCategorie" action="?action=new" onsubmit="return ValidationFormCategorie()">';
				break;
			case 'edit' :
				$aff .= '&nbsp;>&nbsp;Edition</div><br/><br/>';
				$aff .= '<form method="POST" name="formCategorie" action="?action=edit&id=' . $this->myCategorie->getID () . '" onsubmit="return ValidationFormCategorie()">';
				break;
		}

		// Button
		$aff .= '<table>';

		if ($mod == 'new') {
			$aff .= '	<tr>';
			$aff .= '		<td>Catégorie Type</td>';
			$aff .= '		<td>';
			$aff .= '			<select name="CategorieType" id="CategorieType">';
			if (is_null ( $this->myCategorie->getParentID () ) || $mod == 'new') {
				$aff .= '			<option value="1" SELECTED=SELECTED>Type</option>';
				$aff .= '			<option value="2">Thème</option>';
				$aff .= '			<option value="3">Métier</option>';
			} else {
				$i = $this->myCategorie->getCategorieType ();
				$aff .= '			<option value="1"' . ($i == '1' ? ' SELECTED=SELECTED' : '') . '>Type</option>';
				$aff .= '			<option value="2"' . ($i == '2' ? ' SELECTED=SELECTED' : '') . '>Theme</option>';
				$aff .= '			<option value="3"' . ($i == '3' ? ' SELECTED=SELECTED' : '') . '>Metier</option>';
			}
			$aff .= '			</select>';
			$aff .= '		</td>';
			$aff .= '	</tr>';

			$aCategorieList = new CategorieDocInfoDynList ();
			$aCategorieList->SQL_select_all_type ();

			$aff .= '<tr id="trCatType">';
			$aff .= '	<td>Type</td>';
			$aff .= '	<td>';
			$aff .= '		<select name="CatType" id="CatType">';
			$aff .= '			<option value="0" SELECTED="SELECTED"></option>';
			foreach ( $aCategorieList->getList () as $aType ) {
				$aff .= '<option value="' . $aType->getID () . '">' . htmlentities ( $aType->getDescription (), ENT_QUOTES ) . '</option>';
			}
			$aff .= '		</select>';
			$aff .= '	</td>';
			$aff .= '</tr>';

			$aff .= '<tr id="trCatTheme">';
			$aff .= '	<td>Thème</td>';
			$aff .= '	<td>';
			$aff .= '		<select name="CatTheme" id="CatTheme">';
			$aff .= '			<option value="0" SELECTED="SELECTED"></option>';
			$aff .= '		</select>';
			$aff .= '	</td>';
			$aff .= '</tr>';
		} else {
			switch ($this->myCategorie->getCategorieType ()) {
				case '2' :
					$aff .= '<tr>';
					$aff .= '	<td valign="top">Hiérarchie</td>';
					$aff .= '	<td>';
					$aCategorieDocInfoDyn = new CategorieDocInfoDyn ();
					$aCategorieDocInfoDyn->SQL_select ( $this->myCategorie->getParentID () );
					$aff .= 'Type : ' . $aCategorieDocInfoDyn->getDescription ();
					$aff .= '</td></tr>';
					break;
				case '3' :
					$aff .= '<tr>';
					$aff .= '	<td valign="top">Hiérarchie</td>';
					$aff .= '	<td>';
					$aCategorieDocInfoDyn = new CategorieDocInfoDyn ();
					$aCategorieDocInfoDyn->SQL_select ( $this->myCategorie->getParentID () );

					$aCategorieDocInfoDyn2 = new CategorieDocInfoDyn ();
					$aCategorieDocInfoDyn2->SQL_select ( $aCategorieDocInfoDyn->getParentID () );
					$aff .= 'Type :  ' . $aCategorieDocInfoDyn2->getDescription () . '<br/>';
					$aff .= 'Thème : ' . $aCategorieDocInfoDyn->getDescription () . '<br/>';
					$aff .= '</td></tr>';
					break;
			}
		}
		$aff .= '<tr><td colspan="2">&nbsp;</td></tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Nom*</td>';
		$aff .= '	<td>';
		$aff .= '		<input type="text" size="50" id="Nom" name="Nom" value="' . $this->myCategorie->getDescription () . '"/>';
		$aff .= '</td></tr>';

		if (is_null ( $this->myCategorie->getParentID () )) {

			$aff .= '<tr class="trPicto">';
			$aff .= '	<td>Pictogramme (590*35)</td>';
			$aff .= '	<td><input type="text"  size="60" id="ImagesURL" name="ImagesURL" value="' . $this->myCategorie->getURLImage () . '"/>';
			$aff .= '	<input type="button" value="Parcourir le serveur" onclick="OpenServerBrowser(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/></td>';
			$aff .= '</tr>';

			$aff .= '<tr class="trPicto">';
			$aff .= '	<td>Pictogramme Mini (35*35)</td>';
			$aff .= '	<td><input type="text" size="60" id="ImagesURL2" name="ImagesURL2" value="' . $this->myCategorie->getURLImageSmall () . '"/>';
			$aff .= '	<input type="button" value="Parcourir le serveur" onclick="OpenServerBrowser2(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/></td>';
			$aff .= '</tr>';
		}

		switch ($mod) {
			case 'new' :
				$aff .= '<tr><td colspan="2"><input type="submit" value="Créer"></td></tr>';
				break;
			case 'edit' :
				$aff .= '<tr><td colspan="2"><input type="submit" value="Mettre à jour"></td></tr>';
				break;
		}

		$aff .= '</table>';
		$aff .= '</form>';

		if ($mod == 'new') {
			$aff .= '<script type="text/javascript">';
			$aff .= '$(document).ready(function(){';
			$aff .= '$("#trCatType").hide();';
			$aff .= '$("#trCatTheme").hide();';
			$aff .= '$(".trPicto").show();';
			$aff .= '});';
			$aff .= '</script>';
		}
		echo $aff;
	}
}
?>