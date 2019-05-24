<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class IndividuListeViewEtablissement {
	private $myIndividuListe;

	function __construct($aIndividuListe)
	{
		$this->myIndividuListe = $aIndividuListe;
	}
	function IndividuListeViewEtablissement($aIndividuListe) {
		self::__construct($aIndividuListe);
	}
	
	function render() {
		$tri = "";
		$sens = "";
		$ordre = "";
		$rech = "";

		if (isset ( $_GET ['tri'] )) {
			$tri = "&tri=" . $_GET ['tri'];
		}
		// parametre de tri ordre
		if (isset ( $_GET ['ordre'] )) {
			$ordre = '&ordre=' . $_GET ['ordre'];
			if ($_GET ['ordre'] == 'd') {
				$sens = 'a';
			} else {
				$sens = 'd';
			}
		} else
			$sens = 'a';

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../?">Général</a>&nbsp;>&nbsp;<a href="?">Etablissement</a>&nbsp;>&nbsp;Liste des Individus';
		$aff .= '</div><br/><br/>';

		$aIndividuListe = new IndividuListe ();
		$aIndividuListe->select_all_individu_etablissement ( $_GET ['id'] );

		if ($aIndividuListe->getNbIndividu () > 50) {
			$aff .= '
			<div id="Pagination" class="pagination">
        </div><br/><br/>
		<script>
			var num_entries = ' . $aIndividuListe->getNbIndividu () . ';
                // Create pagination element
                $("#Pagination").pagination(num_entries, {
                    num_edge_entries: 0,
                    num_display_entries: 10,
					current_page:' . (isset ( $_GET ['page'] ) ? $_GET ['page'] : 0) . ',
					link_to:\'?' . (isset ( $_GET ['action'] ) && $_GET ['action'] == 'm' ? 'action=m&id=' . $_GET ['id'] . '&' : '') . 'page=__id__' . $tri . $ordre . '\',
					callback: pageselectCallback,
                    items_per_page:50,
                    prev_text:"PREC",
                    next_text:"SUIV"
                });
		</script>
		';
		}

		// Bouton sous menu
		$aff .= '<input type="button" value="Nouveau" onclick="javascript:location.href=\'../individu/index.php?action=new&id=' . $_GET ['id'] . '\'">&nbsp;&nbsp;';
		$aff .= '<input type="button" value="Ajouter un individu existant" onclick="javascript:location.href=\'../individu/index.php?action=m&id=' . $_GET ['id'] . '\'">';

		$aff .= '<br/><br/>';

		// resumer
		$aEtablissement = new Etablissement ();
		$aEtablissement->select_etablissement ( $_GET ['id'] );
		$aff .= '<fieldset><legend>Resume Etablissement</legend>';
		$aff .= 'Raison Sociale : ' . $aEtablissement->getRaisonSociale () . ' (' . $aEtablissement->getLoginSage () . ')' . '<br/>';
		$aff .= 'Ville : ' . $aEtablissement->getVille () . '<br/>';
		$aff .= '</fieldset><br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="5" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center"><a href="?action=m&id=' . $_GET ['id'] . '&tri=1&ordre=' . $sens . '" ><b>#</b></a></td>';
		$aff .= '<td align="center"><a href="?action=m&id=' . $_GET ['id'] . '&tri=2&ordre=' . $sens . '" ><b>Nom</b></a></td>';
		$aff .= '<td align="center"><a href="?action=m&id=' . $_GET ['id'] . '&tri=3&ordre=' . $sens . '" ><b>Pr&eacute;nom</b></a></td>';
		$aff .= '<td align="center"><b>Mail</b></td>';
		$aff .= '<td align="center"><b>Domaine Activité</b></td>';
		$aff .= '<td align="center"><b>Fonction</b></td>';
		$aff .= '<td align="center" width="50"><b>Action Individu</b></td>';
		$aff .= '<td align="center" width="50"><b>Action R&ocirc;le</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myIndividuListe->getIndividuListe () as $aIndividu ) {
			$aSimpleIndividu = new Simple_Individu ();
			$aSimpleIndividu->setID ( $aIndividu->getID () );
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getID () . '</td>';
			$aff .= '<td align="left" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getNom () . '</td>';
			$aff .= '<td align="left" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getPrenom () . '</td>';
			$aff .= '<td align="left" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aIndividu->getMail () . '</td>';
			$aff .= '<td align="left" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aSimpleIndividu->SQL_SELECT_DA () . '</td>';
			$aff .= '<td align="left" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aSimpleIndividu->SQL_SELECT_FxDA () . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="../individu/?action=edit&id=' . $aIndividu->getID () . '"><img src="../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmMSGDelete(\'../role/?action=delete&roleid=' . $aIndividu->getIndividuRole () . '&id=' . $aIndividu->getID () . '&ide=' . $_GET ['id'] . '\',\'Confirmation Suppression\')"><img src="../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		if ($this->myIndividuListe->getNbIndividu () == 0) {
			$aff .= '<tr>';
			$aff .= '<td colspan="5"><i>Aucun Individu trouv&eacute;</i></td>';
			$aff .= '</tr>';
		}

		$aff .= '</table></div>';
		echo $aff;
	}
}
?>