<?php
/**
 *Vue non utilisée
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage cv
 * @version 1.0.4
 */
class ListCVDateView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function renderstyle() {
		$aff = '<style>';
		$aff .= 'td.center {text-align:center;}';
		$aff .= '</style>';

		return $aff;
	}
	/**
	 *
	 * @deprecated
	 *
	 */
	public function renderHTML() {
		$recherche_precedente = "";

		// paramètre de recherche
		if (isset ( $_POST ['Recherche'] )) {
			$recherche_precedente = $_POST ['Recherche'];
		} elseif (isset ( $_GET ['Recherche'] )) {
			$recherche_precedente = $_GET ['Recherche'];
		} else {
			$recherche_precedente = "";
		}

		$aff = $this->renderstyle ();
		$aff .= '<b><a href="../../index.php?menu=4">Admin</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?action=cv&list">CV\'s</a>&nbsp;>&nbsp;';
		$aff .= 'Liste des CV\'s triés par date<br /><br /></b>';
		// Button Bar
		// $aff .= '<input type="button" value="Retour" onclick="javascript:history.back()" /><br/><br/>';
		$aff .= '<form  method="POST"><table style="width:100%"><tr><td align="right"><b>Filtre</b><input type="text" name="recherche" value="' . $recherche_precedente . '" style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  /><input type="button" onclick="javascript:location.href=\'?action=cv&list=date\'" style="background:url(\'../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></td></tr></table></form>';
		$aff .= '<table border="1" width="100%">';
		$aff .= '<tr>';
		$aff .= '	<td class="center" width="50"><b>Date</b></td>';
		$aff .= '	<td class="center"><b>Fonction recherchée par le candidat</b></td>';
		$aff .= '	<td class="center"><b>Adresse E-mail</b></td>';
		$aff .= '   <td class="center"><b>Validé</b></td>';
		$aff .= '	<td class="center"><b>Publié</b></td>';
		$aff .= '	<td width="100" class="center" colspan="2"><b>Action</b></td>';
		$aff .= '</tr>';

		foreach ( $this->myList->getList () as $aVerif ) {
			$aff .= '<tr>';
			$aff .= '	<td class="center" width="50">' . CommunFunction::getDateFR ( $aVerif->getdatecand () ) . '</td>';
			$aff .= '	<td class="center">' . $aVerif->getfonction () . '</td>';
			$aff .= '	<td class="center">' . $aVerif->getmail () . '</td>';
			if ($aVerif->getvalid () == 1) {
				$aff .= '	<td class="center"><img src="../../include/images/icone_oui.png"></td>';
			} else {
				$aff .= '	<td class="center"><img src="../../include/images/icone_non.png"></td>';
			}
			if ($aVerif->getpub () == 1) {
				$aff .= '	<td class="center"><img src="../../include/images/icone_oui.png"></td>';
			} else {
				$aff .= '	<td class="center"><img src="../../include/images/icone_non.png"></td>';
			}

			$aff .= '	<td width="50" class="center"><a href="?action=editcv&id=' . $aVerif->getnumcv () . '"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
			$aff .= '	<td width="50" class="center"><a href="?action=deletecv&id=' . $aVerif->getnumcv () . '"><img src="../../include/images/garbage_empty.png" border="0"/></a></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table>';

		echo $aff;
	}
}
?>