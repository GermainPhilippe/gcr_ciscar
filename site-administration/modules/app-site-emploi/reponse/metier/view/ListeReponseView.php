<?php
/**
 *Vue des Reponses du site emploi
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage reponse
 * @version 1.0.4
 */
class ListeReponseView {
	private $myList;
	private $nbrEntre;
	public function __construct($aList, $acount) {
		$this->myList = $aList;
		$this->nbrEntre = $acount;
	}
	/**
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
		if (isset ( $_POST ['recherche'] )) {
			$rech = "&recherche=" . $_POST ['recherche'];
			$recherche_precedente = $_POST ['recherche'];
		} elseif (isset ( $_GET ['recherche'] )) {
			$rech = "&recherche=" . $_GET ['recherche'];
			$recherche_precedente = $_GET ['recherche'];
		} else {
			$rech = "";
		}
		$aff = $this->renderstyle ();
		$aff .= '<div id="FilAriane"><a href="../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;R&eacute;ponses</div> <br /><br />';

		$aff .= '<form  method="POST"><table style="width:100%"><tr><td><div id="Pagination" class="pagination"></div></td><td align="right"><b>Filtre</b><input type="text" name="recherche" value="' . $recherche_precedente . '" style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  /><input type="button" onclick="javascript:location.href=\'?action=reponse&list=date\'" style="background:url(\'../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></td></tr></table></form>';
		// Création du tableau
		$aff .= '<table id="TableList" width="100%">';
		$aff .= '<tr class="title">';
		$aff .= '	<td align="center" width="50"><a href="?action=reponse&list=liste&tri=1&ordre=' . $sens . $rech . '" ><b>#</b></a></td>';
		$aff .= '   <td width="100" align="center" width="100"><a href="?action=reponse&list=liste&tri=2&ordre=' . $sens . $rech . '" ><b>Num&eacute;ro de l\' offre</b></a></td>';
		$aff .= '	<td align="center"><a href="?action=reponse&list=liste&tri=3&ordre=' . $sens . $rech . '" ><b>Titre de l\'offre</b></a></td>';
		$aff .= '	<td align="center"><a href="?action=reponse&list=liste&tri=4&ordre=' . $sens . $rech . '" ><b>Fonction recherch&eacute;e par le candidat</b></a></td>';
		$aff .= '	<td width="100" align="center"><a href="?action=reponse&list=liste&tri=5&ordre=' . $sens . $rech . '" ><b>Date de la réponse</b></a></td>';
		$aff .= '	<td width="100" align="center" colspan="2"><b>Action</b></td>';
		$aff .= '</tr>';
		$row = 1;

		foreach ( $this->myList->getList () as $aVerif ) {
			$aff .= '<tr>';
			$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center">' . $aVerif->getnumrep () . '</td>';
			$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '" width="100" align="center" >' . $aVerif->getnumoffre () . '</td>';
			$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center">' . stripslashes ( $aVerif->gettitreoffre () ) . '</td>';
			$aff .= '	<td  class="' . ($row == 1 ? 'row1' : 'row2') . '" align="center">' . stripslashes ( $aVerif->getfonctioncand () ) . '</td>';
			$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '" width="100" align="center">' . CommunFunction::getDateFr ( $aVerif->getdatecand () ) . '</td>';

			$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=viewreponse&id=' . $aVerif->getnumrep () . '"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
			$aff .= '</tr>';
			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table>';
		// Script pour la pagination et pop-up de confirmation
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
					link_to:\'?action=offres&page=__id__' . $tri . $ordre . $rech . '\',
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