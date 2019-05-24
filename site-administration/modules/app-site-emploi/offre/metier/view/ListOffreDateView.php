<?php
/**
 *Vue non utilisée
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage offre
 * @version 1.0.4
 */
class ListOffreDateView {
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
	public function renderscript() {
		$aff = '<script type="text/javascript">';
		$aff .= '	function pageselectCallback(page_index, jq){';
		$aff .= '         $.get("index.php",{page:numpage})';
		$aff .= '		return false;';
		$aff .= '     }';
		$aff .= '</script>';

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

		$aff = '<head>';
		$aff .= $this->renderstyle ();
		$aff .= '</head>';

		$aff .= '<b><a href="../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?action=offres&list">Offres</a>&nbsp;>&nbsp;Liste des offres triées par date<br /><br /></b>';

		$aff .= '<form  method="POST"><table style="width:100%"><tr><td align="right"><b>Filtre</b><input type="text" name="recherche" value="' . $recherche_precedente . '" style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  /><input type="button" onclick="javascript:location.href=\'?action=offres&list=date\'" style="background:url(\'../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></td></tr></table></form>';

		$aCount = new ListOffre ();
		$test = $aCount->SQL_COUNT_DAT ();

		$aff .= '<table border="1" width="100%">';
		$aff .= '<tr>';
		$aff .= '	<td class="center"><b>Date de publication</b></td>';
		$aff .= '	<td class="center"><b>Titre de l\'offre</b></td>';
		$aff .= '	<td class="center"><b>Adresse E-mail</b></td>';
		$aff .= '	<td class="center"><b>Publié</b></td>';
		$aff .= '	<td width="100" align="center" colspan="2"><b>Action</b></td>';
		$aff .= '</tr>';

		foreach ( $this->myList->getList () as $aVerif ) {
			$aff .= '<tr>';
			$aff .= '	<td class="center">' . CommunFunction::getDateFr ( $aVerif->getdateoffre () ) . '</td>';
			$aff .= '	<td class="center">' . $aVerif->gettitreoffre () . '</td>';
			$aff .= '	<td class="center">' . $aVerif->getmail () . '</td>';

			if ($aVerif->getpub () == 1) {
				$aff .= '	<td class="center">Oui</td>';
			} else {
				$aff .= '	<td class="center">Non</td>';
			}

			$aff .= '	<td width="50" class="center"><a href="?action=editoffre&id=' . $aVerif->getnumoffre () . '"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
			$aff .= '	<td width="50" class="center"><a href="?action=deleteoffre&id=' . $aVerif->getnumoffre () . '"><img src="../../include/images/garbage_empty.png" border="0"/></a></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table>';

		echo $aff;
	}
}

?>