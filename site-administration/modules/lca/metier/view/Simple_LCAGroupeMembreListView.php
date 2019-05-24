<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lca
 * @version 1.0.4
 */
class Simple_LCAGroupeMembreListView {
	private $myList;
	private $nbrEntre;
	public function __construct($aList, $count) {
		$this->myList = $aList;
		$this->nbrEntre = $count;
	}
	public function renderHTML($mod) {
		$tri = "";
		$sens = "";
		$ordre = "";
		$recherche_precedente = "";
		// paramï¿½tre de tri colonne
		if (isset ( $_GET ['tri'] )) {
			$tri = "&tri=" . $_GET ['tri'];
		}
		// paramï¿½tre de tri ordre
		if (isset ( $_GET ['ordre'] )) {
			$ordre = '&ordre=' . $_GET ['ordre'];
			if ($_GET ['ordre'] == 'd') {
				$sens = 'a';
			} else {
				$sens = 'd';
			}
		}
		// paramï¿½tre de recherche
		if (isset ( $_POST ['Recherche'] )) {
			$rech = "&Recherche=" . $_POST ['Recherche'];
			$recherche_precedente = $_POST ['Recherche'];
		} elseif (isset ( $_GET ['Recherche'] )) {
			$rech = "&Recherche=" . $_GET ['Recherche'];
			$recherche_precedente = $_GET ['Recherche'];
		} else {
			$rech = "";
		}

		// Navigation bar
		$aSimple_LCAGroupe = new Simple_LCAGroupe ();
		$aSimple_LCAGroupe->SQL_SELECT ( $_GET ['id'] );

		$aff = '<div id="FilAriane"><a href="../../index.php">Général</a>&nbsp;>&nbsp;<a href="index.php">LCA</a>';
		if ($mod == 'add') {
			$aff .= '&nbsp;>&nbsp;<a href="?action=m&id=' . $_GET ['id'] . '">' . $aSimple_LCAGroupe->getLibelle () . '</a>';
			$aff .= '&nbsp;>&nbsp;Ajout de membre</div>';
			$aff .= '<br/><br /><form action="?action=add&id=' . $_GET ['id'] . '" method="POST"><table style="width:100%"><tr><td><div id="Pagination" class="pagination"></div></td><td align="right"><b>Filtre</b><input type="text" name="Recherche" value="' . $recherche_precedente . '" style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  /><input type="button" onclick="javascript:location.href=\'?\'" style="background:url(\'../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></td></tr></table></form>';
		} else {
			$aff .= '&nbsp;>&nbsp;' . $aSimple_LCAGroupe->getLibelle ();
			$aff .= '</div>';
		}
		$aff .= '<br/><br/>';

		// Bouton sous menu
		if ($mod != 'add') {
			if ($_GET ['id'] == '14') {
				$aff .= '<input type="button" value="Cr&eacute;er un individu" onclick="javascript:location.href=\'?action=adduser&id=' . $_GET ['id'] . '\'">';
			}

			$aff .= '<input type="button" value="Ajouter un individu" onclick="javascript:location.href=\'?action=add&id=' . $_GET ['id'] . '\'">&nbsp;';
			$aff .= '<input type="button" value="Exporter la liste" onclick="javascript:location.href=\'../app-export/view.php?name=GroupeListe&GroupeID=' . $_GET ['id'] . '&AnnuaireID=' . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . '\'">';
			$aff .= '<br/><br/>';
		}

		// Tableau
		$aff .= '<table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50">' . ($mod == 'add' ? '<a href="?action=add&id=' . $_GET ['id'] . '&tri=1&ordre=' . $sens . $rech . '"><b>#</b></a>' : '<b>#</b>') . '</td>';
		$aff .= '<td align="center">' . ($mod == 'add' ? '<a href="?action=add&id=' . $_GET ['id'] . '&tri=2&ordre=' . $sens . $rech . '" ><b>Nom</b></a>' : '<b>Nom</b>') . '</td>';
		$aff .= '<td align="center">' . ($mod == 'add' ? '<a href="?action=add&id=' . $_GET ['id'] . '&tri=3&ordre=' . $sens . $rech . '" ><b>Pr&eacute;nom</b></a>' : '<b>Pr&eacute;nom</b>') . '</td>';
		$aff .= '<td align="center">' . ($mod == 'add' ? '<a href="?action=add&id=' . $_GET ['id'] . '&tri=4&ordre=' . $sens . $rech . '" ><b>Mail</b></a>' : '<b>Mail</b>') . '</td>';
		$aff .= '<td align="center" width="50"><b>Action Individu</b></td>';
		$aff .= '<td align="center" width="50"><b>Action LCA</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myList->getList () as $aMembre ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aMembre->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aMembre->getNom () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aMembre->getPrenom () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aMembre->getMail () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="../individu/?action=edit&id=' . $aMembre->getID () . '"><img src="../../include/images/document_edit.png" width="16" border="0"/></a></b></td>';
			if ($mod == 'membre') {
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=d&id=' . $_GET ['id'] . '&idi=' . $aMembre->getID () . '"><img src="../../include/images/garbage_empty.png" width="16" border="0"/></a></b></td>';
			} else {
				$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=add&id=' . $_GET ['id'] . '&idi=' . $aMembre->getID () . '"><img src="../../include/images/ic_icon_exp.gif" width="16" border="0"/></a></b></td>';
			}
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		if (count ( $this->myList->getList () ) == 0) {
			$aff .= '<tr>';
			$aff .= '<td colspan="8"><i>Aucun Membre trouv&eacute;</i></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table>';
		$aff .= '<script>
			var num_entries = ' . ($this->nbrEntre) . ';
                // Create pagination element
                $("#Pagination").pagination(num_entries, {
                    num_edge_entries: 1,
                    num_display_entries: 10,
					current_page:' . (isset ( $_GET ['page'] ) ? $_GET ['page'] : 0) . ',
					link_to:\'?action=add&id=' . $_GET ['id'] . '&page=__id__' . $tri . $ordre . $rech . '\',
					callback: pageselectCallback,
                    items_per_page:50,
                    prev_text:"PREC",
                    next_text:"SUIV"
                });
			</script>';
		echo $aff;
	}
}
?>