<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage role
 * @version 1.0.4
 */
class Simple_RoleListView {
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
			$recherche_precente = $_GET ['Recherche'];
		} else {
			$rech = "";
		}

		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../index.php?menu=2">Site</a>&nbsp;>&nbsp;R&ocirc;le</div></a><br/><br/>';
		echo $aff;

		$aff = '<form action="?" method="POST"><table style="width:100%"><tr><td><div id="Pagination" class="pagination"></div>	</td><td align="right">
					<b>Filtre</b><input type="text" name="Recherche" value="' . $recherche_precedente . '"style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  /><input type="button" onclick="javascript:location.href=\'?\'" style="background:url(\'../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></td><td align="bottom"></td>
					</tr>
					</table></form>
		<script>
			var num_entries = ' . ($this->nbrEntre) . ';
                // Create pagination element
                $("#Pagination").pagination(num_entries, {
                    num_edge_entries: 1,
                    num_display_entries: 10,
					current_page:' . (isset ( $_GET ['page'] ) ? $_GET ['page'] : 0) . ',
					link_to:\'?page=__id__' . $tri . $ordre . $rech . '\',
					callback: pageselectCallback,
                    items_per_page:50,
                    prev_text:"PREC",
                    next_text:"SUIV"
                });
		</script>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;">
		<table cellspacing="1" cellpadding="0"  id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<th align="center"><a href="?tri=1&ordre=' . $sens . $rech . '" ><b>#</b></a></th>';
		$aff .= '<th align="center"><a href="?tri=2&ordre=' . $sens . $rech . '" ><b>Raison Sociale</b></a></th>';
		$aff .= '<th align="center"><a href="?tri=3&ordre=' . $sens . $rech . '" ><b>Nom</b></a></th>';
		$aff .= '<th align="center"><a href="?tri=4&ordre=' . $sens . $rech . '" ><b>Pr&eacute;nom</b></a></th>';
		$aff .= '<th align="center" colspan="2" width="100"><b>Action</b></th>';
		$aff .= '</tr>';
		echo $aff;

		$row = 1;
		$aEtablissement = new Simple_Etablissement ();
		$aIndividu = new Simple_Individu ();
		foreach ( $this->myList->getList () as $aRole ) {
			$aEtablissement->SQL_SELECT ( $aRole->getEtablissementID () );
			$aIndividu->SQL_SELECT ( $aRole->getIndividuID () );

			$aff = '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b>' . $aRole->getID () . '</b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aEtablissement->getRaisonSociale () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getNom () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getPrenom () . '</td>';

			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=u&id=' . $aRole->getID () . '"><img src="../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmDelete(' . $aRole->getID () . ')"><img src="../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';
			echo $aff;
			$row = ($row == 1 ? 2 : 1);
		}

		if (count ( $this->myList->getList () ) == 0) {
			echo '<tr>';
			echo '<td colspan="7"><i>Aucun Role trouv&eacute;</i></td>';
			echo '</tr>';
		}
		echo '</table></div>';
	}
}

?>