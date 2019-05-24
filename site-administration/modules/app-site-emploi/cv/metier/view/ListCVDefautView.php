<?php
/**
 *Vue des CV du site emploi
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage cv
 * @version 1.0.4
 */
class ListCVDefautView {
	private $myList;
	private $nbrEntre;
	public function __construct($aList, $count) {
		$this->myList = $aList;
		$this->nbrEntre = $count;
	}
	/**
	 *
	 * Rendu du style de la vue
	 *
	 * @return string
	 */
	public function renderstyle() {
		$aff = '<style>';
		$aff .= 'td.center {text-align:center;}';
		$aff .= '</style>';

		return $aff;
	}
	/**
	 * Construction de la vue (tableau)
	 */
	public function renderHTML() {
		$tri = "";
		$sens = "";
		$ordre = "";
		$recherche_precedente = "";
		// paramètre de tri colonne
		if (isset ( $_GET ['tri'] )) {
			$tri = "&tri=" . $_GET ['tri'];
		}
		// paramètre de tri ordre
		if (isset ( $_GET ['ordre'] )) {
			$ordre = '&ordre=' . $_GET ['ordre'];
			if ($_GET ['ordre'] == 'd') {
				$sens = 'a';
			} else {
				$sens = 'd';
			}
		}
		// paramètre de recherche
		if (isset ( $_POST ['Recherche'] )) {
			$rech = "&Recherche=" . $_POST ['Recherche'];
			$recherche_precedente = $_POST ['Recherche'];
		} elseif (isset ( $_GET ['Recherche'] )) {
			$rech = "&Recherche=" . $_GET ['Recherche'];
			$recherche_precedente = $_GET ['Recherche'];
		} else {
			$rech = "";
		}

		// Fil d'ariane
		$aff = $this->renderstyle ();
		$aff .= '<div id="FilAriane"><a href="../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;CV\'s</div>';

		// Filtre
		$aff .= '<br/><br /><form action="?action=cv" method="POST">';
		$aff .= '<table style="width:100%"><tr><td><div id="Pagination" class="pagination" ></div></td><td align="right"><b>Filtre</b><input type="text" name="Recherche" value="' . $recherche_precedente . '" style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  /><input type="button" onclick="javascript:location.href=\'?action=cv&list\'" style="background:url(\'../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></td></tr></table></form>';
		// Création du tableau
		$aff .= '<table  width="100%" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '	<td class="center" width="50"><a href="?action=cv&tri=1&ordre=' . $sens . $rech . '" ><b>#</b></a></td>';
		$aff .= '	<td class="center"><a href="?action=cv&tri=3&ordre=' . $sens . $rech . '" ><b>Fonction recherchée par le candidat</b></a></td>';
		$aff .= '	<td  width="100" class="center"><a href="?action=cv&tri=2&ordre=' . $sens . $rech . '" ><b>Date</b></a></td>';

		$aff .= '	<td width="200" class="center"><a href="?action=cv&tri=4&ordre=' . $sens . $rech . '" ><b>Mail du candidat</b></a></td>';
		$aff .= '   <td width="50" class="center"><a href="?action=cv&tri=5&ordre=' . $sens . $rech . '" ><b>Publié</b></a></td>';

		$aff .= '	<td width="100" class="center" colspan="2"><b>Action</b></td>';
		$aff .= '</tr>';
		$row = 1;
		foreach ( $this->myList->getList () as $aVerif ) {
			$aff .= '<tr>';
			$aff .= '	<td align="center" width="50" class="' . ($row == 1 ? 'row1' : 'row2') . '" >' . $aVerif->getnumcv () . '</td>';
			$aff .= '	<td  align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aVerif->getFonction () ) . '</td>';
			$aff .= '	<td align="center" width="100" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . CommunFunction::getDateFr ( $aVerif->getdatecand () ) . '</td>';

			$aff .= '   <td align="center" width="200" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aVerif->getmail () . '</td>';

			if (is_null ( $aVerif->getpub () )) {
				$aff .= '	<td align="center" width="50" class="' . ($row == 1 ? 'row1' : 'row2') . '">-</td>';
			} elseif ($aVerif->getpub () == 1) {
				$aff .= '	<td align="center" width="50" class="' . ($row == 1 ? 'row1' : 'row2') . '"><img src="../../include/images/icone_oui.png"></td>';
			} else {
				$aff .= '	<td align="center" width="50" class="' . ($row == 1 ? 'row1' : 'row2') . '"><img src="../../include/images/icone_non.png"></td>';
			}

			$aff .= '	<td align="center" width="50" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="?action=editcv&id=' . $aVerif->getnumcv () . '"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
			$aff .= '	<td align="center" width="50" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="#" onclick="confirmDeleteCV(' . $aVerif->getnumcv () . ')"><img src="../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		if (count ( $this->myList->getList () ) == 0) {
			$aff .= '<tr>';
			$aff .= '<td colspan="7"><i>Aucun r&eacute;sultat</i></td>';
		}
		$aff .= '</table>';
		// Script de pagination et pop-up de confirmation
		$aff .= '<script>
        
        		function confirmDelete(doc_id)
        		{
					if(confirm("Confirmation de suppression"))
					{
						document.location.href=\'?action=delete&id=\'+doc_id;	
					}
				}
        		
				var num_entries = ' . ($this->nbrEntre) . ';

                // Create pagination element
                $("#Pagination").pagination(num_entries, {
                    num_edge_entries: 1,
                    num_display_entries: 10,

					current_page:' . (isset ( $_GET ['page'] ) ? $_GET ['page'] : 0) . ',
					link_to:\'?action=cv&page=__id__' . $tri . $ordre . $rech . '\',
					callback: pageselectCallback,
		            items_per_page:50,
                    next_text: "SUIV",
                    prev_text:"PREC"
                });
		         </script>';

		echo $aff;
	}
}
?>