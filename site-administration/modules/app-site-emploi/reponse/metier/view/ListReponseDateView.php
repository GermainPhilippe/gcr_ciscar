<?php
/**
 *Vue non utilisée
 * @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage reponse
 * @version 1.0.4
 */
class ListReponseDateView {
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
		$aff .= '<b><a href="../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?action=reponse&list">R&eacute;ponses</a>&nbsp;>&nbsp;';
		$aff .= 'Liste des réponses triés par date<br /><br /></b>';
		$aff .= '<form  method="POST"><table style="width:100%"><tr><td align="right"><b>Filtre</b><input type="text" name="recherche" value="' . $recherche_precedente . '" style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  /><input type="button" onclick="javascript:location.href=\'?action=reponse&list=date\'" style="background:url(\'../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></td></tr></table></form>';

		$aff .= '<table border="1" width="100%">';
		$aff .= '<tr>';
		$aff .= '	<td class="center"><b>Titre de l\'offre</b></td>';
		$aff .= '	<td class="center"><b>Date de la réponse</b></td>';
		$aff .= '	<td class="center"><b>Fonction recherchée par le candidat</b></td>';
		$aff .= '	<td width="100" align="center" colspan="2"><b>Action</b></td>';
		$aff .= '</tr>';

		foreach ( $this->myList->getList () as $aVerif ) {
			$aff .= '<tr>';
			$aff .= '	<td class="center">' . $aVerif->gettitreoffre () . '</td>';
			$aff .= '	<td class="center">' . CommunFunction::getDateFr ( $aVerif->getdatecand () ) . '</td>';
			$aff .= '	<td class="center">' . $aVerif->getfonctioncand () . '</td>';

			$aff .= '	<td width="50" class="center"><a href="?action=viewreponse&id=' . $aVerif->getnumrep () . '"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table>';

		echo $aff;
	}
}

?>