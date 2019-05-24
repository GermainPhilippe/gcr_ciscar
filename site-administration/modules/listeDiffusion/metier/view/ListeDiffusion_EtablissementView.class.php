<?php
class ListeDiffusion_EtablissementView {
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
			$rech = "&Recherche=" . $_GET ['Recherche'];
			$recherche_precedente = $_GET ['Recherche'];
		} else {
			$rech = "";
		}

		$aff = '<div id="FilAriane">' . "\n";
		$aff .= 'Crit&egrave;re Etablissement';
		$aff .= '</div><br/><br/>' . "\n";

		$aff .= '<form action="?" method="POST"><table style="width:100%"><tr><td><div id="Pagination" class="pagination"></div>	</td><td align="right">
					<b>Filtre</b>&nbsp;<input type="text" name="Recherche" value="' . $recherche_precedente . '"style="padding-top:0px;height:25px;"/>&nbsp;<input value="" type="submit" style="background:url(\'../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  />&nbsp;<input type="button" onclick="javascript:location.href=\'?\'" style="background:url(\'../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></td>
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
			<table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center" width="50"><a href="?tri=1&ordre=' . $sens . $rech . '" ><b>#</b></a></td>';
		$aff .= '<td align="center"><a href="?tri=2&ordre=' . $sens . $rech . '" ><b>Concession de</b></a></td>';
		$aff .= '<td align="center"><a href="?tri=3&ordre=' . $sens . $rech . '" ><b>Nom</b></a></td>';
		$aff .= '<td align="center"><a href="?tri=4&ordre=' . $sens . $rech . '" ><b>CP / Bureau</b></a></td>';
		$aff .= '<td align="center"><a href="?tri=5&ordre=' . $sens . $rech . '" ><b>Ville</b></a></td>';
		$aff .= '<td align="center" width="50"><b>Action</b></a></td>';
		$aff .= '</tr>';
		echo $aff;

		$row = 1;
		foreach ( $this->myList->getList () as $aEtablissement ) {
			$aff = '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aEtablissement->getID () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aEtablissement->getVille () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aEtablissement->getRaisonSociale () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aEtablissement->getCodePostal () . ' / ' . $aEtablissement->getBureauDistributeur () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aEtablissement->getVille () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a style="cursor:pointer;" onclick="javascript:addRule(\'' . $aEtablissement->getID () . '\',\'' . addslashes ( $aEtablissement->getRaisonSociale () ) . '\')"><img src="../../include/images/add.png" border="0"/></a></td>';
			$aff .= '</tr>';
			echo $aff;
			$row = ($row == 1 ? 2 : 1);
		}

		if (count ( $this->myList->getList () ) == 0) {
			echo '<tr>';
			echo '<td colspan="7"><i>Aucun Etablissement trouv&eacute;</i></td>';
			echo '</tr>';
		}

		echo '</table></div>';
	}
}
?>
