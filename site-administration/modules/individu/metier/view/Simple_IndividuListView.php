<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class Simple_IndividuListView {
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
		// param�tre de tri colonne
		if (isset ( $_GET ['tri'] )) {
			$tri = "&tri=" . $_GET ['tri'];
		}
		// param�tre de tri ordre
		if (isset ( $_GET ['ordre'] )) {
			$ordre = '&ordre=' . $_GET ['ordre'];
			if ($_GET ['ordre'] == 'd') {
				$sens = 'a';
			} else {
				$sens = 'd';
			}
		}
		// param�tre de recherche
		if (isset ( $_POST ['Recherche'] )) {
			$rech = "&Recherche=" . $_POST ['Recherche'];
			$recherche_precedente = $_POST ['Recherche'];
		} elseif (isset ( $_GET ['Recherche'] )) {
			$rech = "&Recherche=" . stripslashes ( $_GET ['Recherche'] );
			$recherche_precedente = stripslashes ( $_GET ['Recherche'] );
		} else {
			$rech = "";
		}

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;Individu';
		$aff .= '</div>';
		echo $aff;

		echo '<br/><br /><form action="?" method="POST"><table style="width:100%"><tr><td><div id="Pagination" class="pagination"></div></td><td align="right"><b>Filtre</b><input type="text" name="Recherche" value="' . $recherche_precedente . '" style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../include/images/Icone_loupe.jpg\');cursor:hand;height:23px;width:23px;"  />
				</td></tr></table></form>
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
		// echo '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" class="liste">';
		echo '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList">';
		echo '<tr class="title">';
		// echo '<tr class="titre">';
		echo '<td align="center" width="50"><a href="?tri=1&ordre=' . $sens . $rech . '" ><b>#</b></a></td>';
		echo '<td align="center"><a href="?tri=2&ordre=' . $sens . $rech . '" ><b>Nom</b></a></td>';
		echo '<td align="center"><a href="?tri=3&ordre=' . $sens . $rech . '" ><b>Pr&eacute;nom</b></a></td>';
		echo '<td align="center"><b>Login Sage</b></td>';
		echo '<td align="center"><b>Domaine d\'activit&eacute;</b></td>';
		echo '<td align="center"><b>Fonction</b></td>';
		echo '<td align="center" width="100" colspan="3"><b>Action</b></td>';
		echo '</tr>';

		$row = 1;
		foreach ( $this->myList->getList () as $aIndividu ) {
			$aff = '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aIndividu->getNom () ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aIndividu->getPrenom () ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aIndividu->getLoginSage () ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->SQL_SELECT_DA () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->SQL_SELECT_FxDA () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=edit&id=' . $aIndividu->getID () . '"><img title="Modifier individu" src="../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmDelete(' . $aIndividu->getID () . ')"><img title="Supprimer de GCR et CISCAR" src="../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == 1)
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmDeleteCISCAR(' . $aIndividu->getID () . ')"><img title="Supprimer de CISCAR uniquement" src="../../include/images/delete.png" border="0"/></a></b></td>';
			if ($_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] == 2)
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmDeleteGCR(' . $aIndividu->getID () . ')"><img title="Supprimer de GCR uniquement" src="../../include/images/delete.png" border="0"/></a></b></td>';
			$aff .= '</tr>';
			echo $aff;
			$row = ($row == 1 ? 2 : 1);
		}

		if (count ( $this->myList->getList () ) == 0) {
			echo '<tr>';
			echo '<td colspan="7"><i>Aucun Individu trouv&eacute;</i></td>';
			echo '</tr>';
		}
		echo '</table></div>';
	}
}
?>