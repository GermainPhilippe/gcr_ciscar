<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class AnomalieIndividuView implements DefaultListView {
	private $myList;
	private $nbrEntre;
	public function __construct($aList, $count) {
		$this->myList = $aList;
		$this->nbrEntre = $count;
	}

	// ###
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

		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../?menu=1">Général</a>&nbsp;>&nbsp;<a href="?">Export</a>&nbsp;>&nbsp;Anomalie Individu sans Role';
		$aff .= '</div><br/><br/>';

		$aff .= '<form  method="POST">';
		$aff .= '<table style="width:100%"><tr><td><div id="Pagination" class="pagination" ></div</td><td align="right"><b>Filtre</b><input type="text" name="Recherche" value="' . $recherche_precedente . '" style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  /><input type="button" onclick="javascript:location.href=\'?\'" style="background:url(\'../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></td></tr></table></form>';

		$aff .= '<table  width ="100%" cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><a href="?action=anomalie_individu&tri=1&ordre=' . $sens . $rech . '"><b>#</b></a></td>';
		$aff .= '<td align="center"><a href="?action=anomalie_individu&tri=2&ordre=' . $sens . $rech . '"><b>Nom</b></a></td>';
		$aff .= '<td align="center"><a href="?action=anomalie_individu&tri=3&ordre=' . $sens . $rech . '"><b>Prenom</b></a></td>';
		$aff .= '<td align="center"><a href="?action=anomalie_individu&tri=4&ordre=' . $sens . $rech . '"><b>Mail</b></a></td>';
		$aff .= '<td align="center" width="50"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myList->getList () as $aRow ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aRow [0] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aRow [1] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aRow [2] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aRow [3] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><b><a href="../individu/?action=edit&id=' . $aRow [0] . '" target="_BLANK"><img src="../../include/images/voir.jpg" width="16" border="0"/></a></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table></div>';

		$aff .= '<script>
   
				var num_entries = ' . ($this->nbrEntre) . ';

                // Create pagination element
                $("#Pagination").pagination(num_entries, {
                    num_edge_entries: 1,
                    num_display_entries: 10,

					current_page:' . (isset ( $_GET ['page'] ) ? $_GET ['page'] : 0) . ',
					link_to:\'?action=anomalie_individu&page=__id__' . $tri . $ordre . $rech . '\',
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