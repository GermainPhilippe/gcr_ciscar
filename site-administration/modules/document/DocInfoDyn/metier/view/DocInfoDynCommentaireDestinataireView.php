<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 2.0.1
 */
class DocInfoDynCommentaireDestinataireView {
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

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	Web Content&nbsp;>&nbsp;Ajouter un destinataire';
		$aff .= '</div>';
		echo $aff;

		echo '<br/><br /><form action="?id=' . $_GET ['id'] . '" method="POST"><table style="width:100%"><tr><td><div id="Pagination" class="pagination"></div></td><td align="right"><b>Filtre</b><input type="text" name="Recherche" value="' . $recherche_precedente . '" style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  /><input type="button" onclick="javascript:location.href=\'?' . (isset ( $_GET ['id'] ) ? 'id=' . $_GET ['id'] : '') . '\'" style="background:url(\'../../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></td></tr></table></form>
		<script>
			var num_entries = ' . ($this->nbrEntre) . ';
                // Create pagination element
                $("#Pagination").pagination(num_entries, {
                    num_edge_entries: 1,
                    num_display_entries: 10,
					current_page:' . (isset ( $_GET ['page'] ) ? $_GET ['page'] : 0) . ',
					link_to:\'?id=' . $_GET ['id'] . '&page=__id__' . $tri . $ordre . $rech . '\',
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
		echo '<td align="center" width="50"><a href="?id=' . $_GET ['id'] . 'tri=1&ordre=' . $sens . $rech . '" ><b>#</b></a></td>';
		echo '<td align="center"><a href="?id=' . $_GET ['id'] . 'tri=2&ordre=' . $sens . $rech . '" ><b>Nom</b></a></td>';
		echo '<td align="center"><a href="?id=' . $_GET ['id'] . 'tri=3&ordre=' . $sens . $rech . '" ><b>Pr&eacute;nom</b></a></td>';
		echo '<td align="center" width="50"><b>Action</b></td>';
		echo '</tr>';

		$row = 1;
		foreach ( $this->myList->getList () as $aIndividu ) {
			$aff = '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getNom () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getPrenom () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a href="index.php?action=addDestinataire&id=' . $_GET ['id'] . '&id2=' . $aIndividu->getID () . '"><img src="../../../include/images/add.png" border="0"/></a></td>';
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