<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage etablissement
 * @version 1.0.4
 */
class Simple_EtablissementListView {
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
		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;Etablissement';
		$aff .= '</div><br/>';

		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=c\'"/><br/><br/>';
		$aff .= '<form action="?" method="POST"><table style="width:100%"><tr><td><div id="Pagination" class="pagination"></div>	</td><td align="right">
					<b>Filtre</b><input type="text" name="Recherche" value="' . $recherche_precedente . '"style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  /><input type="button" onclick="javascript:location.href=\'?\'" style="background:url(\'../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></td>
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
					</script>
					';

		// Tableau

		$aff .= '<div style="border:solid 1px #000000;">
			<table cellspacing="1" cellpadding="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center"><a href="?tri=1&ordre=' . $sens . $rech . '" ><b>Raison sociale</b></a></td>';
		$aff .= '<td align="center"><a href="?tri=2&ordre=' . $sens . $rech . '" ><b>Code Postal</b></a></td>';
		$aff .= '<td align="center"><a href="?tri=3&ordre=' . $sens . $rech . '" ><b>Bureau</b></a></td>';
		$aff .= '<td align="center"><a href="?tri=4&ordre=' . $sens . $rech . '" ><b>Concession de</b></a></td>';
		$aff .= '<td align="center"><a href="?tri=5&ordre=' . $sens . $rech . '" ><b>Code Sage</b></a></td>';
		$aff .= '<td align="center"><a href="?tri=6&ordre=' . $sens . $rech . '" ><b>R&eacute;f&eacute;rence Constructeur</b></a></td>';
		$aff .= '<td align="center"><b>Direction R&eacute;gionale</b></td>';
		$aff .= '<td align="center" width="150" colspan="3"><b>Action</b></a></td>';
		$aff .= '</tr>';
		echo $aff;

		$row = 1;
		foreach ( $this->myList->getList () as $aEtablissement ) {
			$aRegion = new Region ();
			$aRegion->select_region ( $aEtablissement->getRegionID () );
			$aff = '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aEtablissement->getRaisonSociale () ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aEtablissement->getCodePostal () ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aEtablissement->getBureauDistributeur () ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aEtablissement->getVille () ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aEtablissement->getLoginSage () ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $this->NumRRFFormatter ( stripslashes ( $aEtablissement->getNumRRF () ) ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aRegion->getName () ) . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=m&id=' . $aEtablissement->getID () . '"><img src="../../include/images/voir.jpg" width="16" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=u&id=' . $aEtablissement->getID () . '"><img src="../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmDelete(' . $aEtablissement->getID () . ')"><img src="../../include/images/garbage_empty.png" border="0"/></a></b></td>';
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
	private function NumRRFFormatter($NumRRF) {
		$fieldValueLenght = strlen ( $NumRRF );
		$fieldNormalLenght = 8;
		$result = $NumRRF;
		if ($fieldValueLenght < $fieldNormalLenght && $fieldValueLenght > 0) {
			for($i = 0; $i < ($fieldNormalLenght - $fieldValueLenght); $i ++) {
				$result = '0' . $result;
			}
		}
		return $result;
	}
}

?>