<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class IndividuListeViewEtablissement2 {
	private $myIndividuListe;
	private $nbrEntre;

	function __construct($aIndividuListe, $count)
	{
		$this->myIndividuListe = $aIndividuListe;
		$this->nbrEntre = $count;
	}
	function IndividuListeViewEtablissement2($aIndividuListe, $count) {
		self::__construct($aIndividuListe, $count);
	}
	
	function render() {
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
			$rech = "&Recherche=" . $_GET ['Recherche'];
			$recherche_precedente = $_GET ['Recherche'];
		} else {
			$rech = "";
		}
		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;<a href="../etablissement/?">Etablissement</a>&nbsp;>&nbsp;Ajouter un Individu';
		$aff .= '</div><br/><br/>';

		$aff .= '<form action="?action=m&id=' . $_GET ['id'] . '" method="POST">';
		$aff .= '<table style="width:100%"><tr><td><div id="Pagination" class="pagination"></div></td><td align="right"><b>Filtre</b><input type="text" name="Recherche" value="' . $recherche_precedente . '" style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  /><input type="button" onclick="javascript:location.href=\'?\'" style="background:url(\'../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></td></tr></table></form>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><a href="?action=m&id=' . $_GET ['id'] . '&tri=1&ordre=' . $sens . $rech . '"><b>#</b></a></td>';
		$aff .= '<td align="center"><a href="?action=m&id=' . $_GET ['id'] . '&tri=2&ordre=' . $sens . $rech . '"><b>Nom</b></a></td>';
		$aff .= '<td align="center"><a href="?action=m&id=' . $_GET ['id'] . '&tri=3&ordre=' . $sens . $rech . '"><b>Pr&eacute;nom</b></a></td>';
		$aff .= '<td align="center" width="50"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myIndividuListe->getIndividuListe () as $aIndividu ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getNom () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getPrenom () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="../role/?action=c&id=' . $_GET ['id'] . '&idi=' . $aIndividu->getID () . '"><img src="../../include/images/ic_icon_exp.gif" border="0"/></a></b></td>';

			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		if ($this->myIndividuListe->getNbIndividu () == 0) {
			$aff .= '<tr>';
			$aff .= '<td colspan="4"><i>Aucun Individu trouv&eacute;</i></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table></div>';

		$aff .= '<script>
			var num_entries = ' . ($this->nbrEntre) . ';
                // Create pagination element
                $("#Pagination").pagination(num_entries, {
                    num_edge_entries: 1,
                    num_display_entries: 10,
					current_page:' . (isset ( $_GET ['page'] ) ? $_GET ['page'] : 0) . ',
					link_to:\'?action=m&id=' . $_GET ['id'] . '&page=__id__' . $tri . $ordre . $rech . '\',
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