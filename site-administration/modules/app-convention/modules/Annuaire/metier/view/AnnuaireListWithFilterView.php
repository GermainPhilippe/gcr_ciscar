<?php
class AnnuaireListWithFilterView {
	private $myList;
	private $myFilter;
	private $mySearch;
	private $myCounter;
	private $myDR;
	public function __construct($aList, $aFilter, $search, $counter, $dr) {
		$this->myList = $aList;
		$this->myFilter = $aFilter;
		$this->mySearch = $search;
		$this->myCounter = $counter;
		$this->myDR = $dr;
	}

	// ###
	public function renderHTML() {
		$aConvention = new Convention ();
		$aConvention->SQL_select ( $_GET ['id'] );

		$aff = '<div id="FilAriane"><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;<a href="../Convention/?">Conventions</a>&nbsp;>&nbsp;Annuaire</div><br/><br/>';

		$aff .= '<table width="100%">';
		$aff .= '<tr><td width="65%" valign="top" ><div class="border3">';
		if ($aConvention->getStatut () != '4') {
			$aff .= '<input type="button" value="Nouveau" onclick="window.location.href=\'?action=new&id=' . $_GET ['id'] . '\'"/> ';
			$aff .= '<input type="button" value="Synchronisation" onclick="confirmation(\'Confirmation de Synchronisation?\',\'?action=synchro&id=' . $_GET ['id'] . '\')"/> ';
			$aff .= '<input type="button" value="Import depuis CSV" onclick="window.location.href=\'?action=importManuel&id=' . $_GET ['id'] . '\'"/> ';
		}

		$aff .= '<input type="button" value="Export Annuaire" onclick="window.location.href=\'../../../app-export/view.php?name=ConventionTousAnnuaire&ConventionID=' . $_GET ['id'] . '\'"/> ';

		$aff .= '<input type="button" value="Vider Annuaire" onclick="javascript:callDeleteAll()"/> ';

		if ($aConvention->getStatut () != '1') {
			// $aff .= '<input type="button" value="Export Publipostage" onclick="window.location.href=\'../../../app-export/view.php?name=Publipostage&ConventionID='.$_GET['id'].'\'"/>';
			// $aff .= '<input type="button" value="Export Publipostage Invité" onclick="window.location.href=\'../../../app-export/view.php?name=PublipostageInvite&ConventionID='.$_GET['id'].'\'"/>';
			if ($aConvention->getStatut () == '2') {
				$aff .= '<input type="button" onclick="confirmation(\'Envoyer les inscriptions ?\',\'?action=EnvoiInvitation&id=' . $_GET ['id'] . '\')" value="Envoyer les inscriptions"/> ';
				$aff .= '<input type="button" onclick="confirmation(\'Envoyer les Relances ?\',\'?action=EnvoiRelance&id=' . $_GET ['id'] . '\')"value="Envoyer les Relances"/>';
			} elseif ($aConvention->getStatut () == '3') {
				$aff .= '<input type="button" value="Envoyer Satisfaction" onclick="confirmation(\'Envoyer le Mail de Satisfaction ?\',\'?action=EnvoiSatisfaction&id=' . $_GET ['id'] . '\')" />';
				$aff .= '<input type="button" value="Envoyer relance Satisfaction" onclick="confirmation(\'Envoyer le Mail de relance Satisfaction ?\',\'?action=EnvoiRelanceSatisfaction&id=' . $_GET ['id'] . '\')"/>';
			}
		}
		$aff .= '</div></td><td width="50%" align="right">';

		$aff .= '<table><tr style="background:#CCC;">';
		$aff .= '<td><b>Total Individu</b></td>';
		$aff .= '<td><b>Répondu</b></td>';
		$aff .= '<td><b>Pas Répondu</b></td>';
		$aff .= '<td><b>Présent</b></td>';
		$aff .= '<td><b>Présent au repas</b></td>';
		// $aff .= '<td><b>Souhaite un taxi</b></td>';
		$aff .= '<td><b>Souhaite un parking</b></td>';
		$aff .= '<td><b>Participe au diner</b></td>';

		$aff .= '</tr><tr>';

		$aff .= '<td align="center">' . $this->myCounter [0] . '</td>';
		$aff .= '<td align="center">' . $this->myCounter [1] . '</td>';
		$aff .= '<td align="center">' . $this->myCounter [2] . '</td>';
		$aff .= '<td align="center">' . $this->myCounter [3] . '</td>';
		$aff .= '<td align="center">' . $this->myCounter [4] . '</td>';
		$aff .= '<td align="center">' . $this->myCounter [5] . '</td>';
		$aff .= '<td align="center">' . $this->myCounter [6] . '</td>';
		$aff .= '</tr></table>';
		$aff .= '</tr></table>';

		$aff .= '</td></tr></table>';
		$aff .= '<br/>';

		$atmpList = new AnnuaireList ();
		$RoleCountEntry = $atmpList->SQL_COUNT ( $_GET ['id'], $this->myFilter, $this->mySearch );
		$aff .= '<table width="100%">';
		$aff .= '<tr><td valign="top" align="left">';
		$aff .= '<div id="Pagination" class="pagination"></div><br/><br/>
		<script>
			var num_entries = ' . $RoleCountEntry . ';
                // Create pagination element
                $("#Pagination").pagination(num_entries, {
                    num_edge_entries: 1,
                    num_display_entries: 10,
					current_page:' . (isset ( $_GET ['page'] ) ? $_GET ['page'] : 0) . ',
					link_to:\'?id=' . $_GET ['id'] . '&Filter=' . $this->myFilter . '&page=__id__\',
					callback: pageselectCallback,
                    items_per_page:100
                });
		</script>';
		$aff .= '</td><td align="right">';
		// Filtre
		$filtre1 = substr ( $this->myFilter, 0, strpos ( $this->myFilter, 'r' ) );
		$filtre2 = substr ( $this->myFilter, strpos ( $this->myFilter, 'r' ), strpos ( $this->myFilter, 'c' ) - strpos ( $this->myFilter, 'r' ) );
		$filtre3 = substr ( $this->myFilter, strpos ( $this->myFilter, 'c' ), strpos ( $this->myFilter, 'p' ) - strpos ( $this->myFilter, 'c' ) );
		$filtre4 = substr ( $this->myFilter, strpos ( $this->myFilter, 'p' ), strpos ( $this->myFilter, 't' ) - strpos ( $this->myFilter, 'p' ) );
		$filtre5 = substr ( $this->myFilter, strpos ( $this->myFilter, 't' ), strlen ( $this->myFilter ) - strpos ( $this->myFilter, 't' ) );

		$aff .= '<form method="POST" style="margin:0px;padding:0px;" action="?id=' . $_GET ['id'] . '">';
		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '<td><input type="text" value="' . $this->mySearch . '" name="search"></td>';
		$aff .= '<td colspan="4" style="background-color:#CCC;"><img src="../../include/images/1.png" border="0"/> <a onclick="javascript:showFilter()" style="cursor:pointer;">Filtre Annuaire</a></td>';
		$aff .= '</tr>';
		$aff .= '<tr class="FiltreRow" style="display:none;">';
		$aff .= '	<td><b>Mode d\'ajout :</b></td>';
		$aff .= '	<td><input type="checkbox" name="FilterModeGCR" value="1"' . (strpos ( $filtre1, '0' ) != false ? ' CHECKED' : '') . '/>Import GCR</td>';
		$aff .= '	<td><input type="checkbox" name="FilterModeInvite" value="1"' . (strpos ( $filtre1, '2' ) != false ? ' CHECKED' : '') . '/>Invité</td>';
		$aff .= '	<td><input type="checkbox" name="FilterModeManuel" value="1"' . (strpos ( $filtre1, '1' ) != false ? ' CHECKED' : '') . '/>Manuel</td>';
		$aff .= '</tr>';
		$aff .= '<tr class="FiltreRow" style="display:none;">';
		$aff .= '	<td><b>A Répondu :</b></td>';
		$aff .= '	<td><input type="checkbox" name="FilterReponduOUI" value="1"' . (strpos ( $filtre2, '1' ) != false ? ' CHECKED' : '') . '/>OUI</td>';
		$aff .= '	<td><input type="checkbox" name="FilterReponduNON" value="0"' . (strpos ( $filtre2, '0' ) != false ? ' CHECKED' : '') . '/>NON</td>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		$aff .= '<tr class="FiltreRow" style="display:none;">';
		$aff .= '	<td><b>Présence Convention :</b></td>';
		$aff .= '	<td><input type="checkbox" name="FilterPresenceOUI" value="1"' . (strpos ( $filtre3, '1' ) != false ? ' CHECKED' : '') . '/>OUI</td>';
		$aff .= '	<td><input type="checkbox" name="FilterPresenceNON" value="0"' . (strpos ( $filtre3, '0' ) != false ? ' CHECKED' : '') . '/>NON</td>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		$aff .= '<tr class="FiltreRow" style="display:none;">';
		$aff .= '	<td><b>Présence Repas :</b></td>';
		$aff .= '	<td><input type="checkbox" name="FilterRepasOUI" value="1"' . (strpos ( $filtre4, '1' ) != false ? ' CHECKED' : '') . '/>OUI</td>';
		$aff .= '	<td><input type="checkbox" name="FilterRepasNON" value="0"' . (strpos ( $filtre4, '0' ) != false ? ' CHECKED' : '') . '/>NON</td>';
		$aff .= '	<td>&nbsp;</td>';
		$aff .= '</tr>';
		$aff .= '<tr class="FiltreRow" style="display:none;">';
		$aff .= '	<td valign="top"><b>Type :</b></td>';
		$aff .= '	<td colspan="3">';
		$aff .= '	<input type="checkbox" value="1" name="AnnuaireType_1"' . (strpos ( $filtre5, '1' ) != false ? ' CHECKED' : '') . ' /> 1. Concessionnaire / Directeur Général<br/>';
		$aff .= '	<input type="checkbox" value="1" name="AnnuaireType_2"' . (strpos ( $filtre5, '2' ) != false ? ' CHECKED' : '') . ' /> 2. Directeur de concession<br/>';
		$aff .= '	<input type="checkbox" value="1" name="AnnuaireType_3"' . (strpos ( $filtre5, '3' ) != false ? ' CHECKED' : '') . ' /> 3. RRG<br/>';
		$aff .= '	<input type="checkbox" value="1" name="AnnuaireType_4"' . (strpos ( $filtre5, '4' ) != false ? ' CHECKED' : '') . ' /> 4. Constructeur<br/>';
		$aff .= '	<input type="checkbox" value="1" name="AnnuaireType_5"' . (strpos ( $filtre5, '5' ) != false ? ' CHECKED' : '') . ' /> 5. Partenaires<br/>';
		$aff .= '	<input type="checkbox" value="1" name="AnnuaireType_6"' . (strpos ( $filtre5, '6' ) != false ? ' CHECKED' : '') . ' /> 6. Nos autres invités<br/>';
		$aff .= '	<input type="checkbox" value="1" name="AnnuaireType_7"' . (strpos ( $filtre5, '7' ) != false ? ' CHECKED' : '') . ' /> 7. Invité par Concessionaire<br/>';
		$aff .= '	<input type="checkbox" value="1" name="AnnuaireType_8"' . (strpos ( $filtre5, '8' ) != false ? ' CHECKED' : '') . ' /> 8. GCRE<br/>';
		$aff .= '	<input type="checkbox" value="1" name="AnnuaireType_9"' . (strpos ( $filtre5, '9' ) != false ? ' CHECKED' : '') . ' /> 9. GCR+<br/>';
		$aff .= '	</td>';
		$aff .= '</tr>';

		$aff .= '<td colspan="4" align="right" class="FiltreRow" style="display:none;"><input type="hidden" name="Filter" value="1"/><input type="submit" value="Filtrer"/><input type="button" value="Supprimer Filtrer" onclick="document.location.href=\'?id=' . $_GET ['id'] . '\'"/></td>';
		$aff .= '</table>';
		$aff .= '</form>';

		$aff .= '</td></tr></table>';

		/*
		 * Button d'action pour les check box de l'annuaire
		 *
		 * @author yre
		 */
		$aff .= '<form action="?id=' . $_GET ['id'] . '&action=checkbox" method="POST">';

		// Action commune
		$button_action_checkbox = '<div class="border" ><input type="submit" name="delete" value="Supprimer" >';
		$button_action_checkbox .= '<input type="submit" name="sendId" value="Envoyer identifiant" >';
		switch ($aConvention->getStatut ()) {
			// CREATION
			case 1 :

				break;
			// INSCRIPTION
			case 2 :
				$button_action_checkbox .= '<input type="submit" name="sendRegistration" value="Envoyer inscription" >';
				$button_action_checkbox .= '<input type="submit" name="sendReminderRegistration" value="Envoyer relance inscription" >';
				break;
			// SATISFACTION
			case 3 :
				$button_action_checkbox .= '<input type="submit" name="sendSatisfaction" value="Envoyer satisfaction" >';
				$button_action_checkbox .= '<input type="submit" name="sendRelanceSatisfaction" value="Envoyer relance satisfaction" >';
				break;
			// ARCHIVE
			case 4 :

				break;
		}
		// Action Commune suite
		$button_action_checkbox .= '<select name="selectType" >
													<option value=""></option>
													<option value="1">Concessionnaire / Directeur Général</option>
													<option value="2">Directeur de concession</option>
													<option value="3">RRG</option>
													<option value="4">Constructeur</option>
													<option value="5">Partenaires</option>
													<option value="6">Nos autres invités</option>
													<option value="7">invité par Concessionnaire</option>
													<option value="8">GCRE</option>
													<option value="9">GCR+</option>
												</select>';
		$button_action_checkbox .= '<input type="submit" name="updateType" value="Modifier Type" ></div>';

		$aff .= $button_action_checkbox;
		$aff .= '<table width="100%" id="TableList">';
		$aff .= '<tr class="title" bgcolor="#CCCCCC" style="background-image:url(\'../../include/images/ligne.jpg\');" height="25">';
		if (isset ( $_GET ['select'] )) {
			if ($_GET ['select'] == 'all') {
				$aff .= '	<td align="center"><a href="?id=' . $_GET ['id'] . '">#</a></td>';
			}
		} else {
			$aff .= '<td align="center"><a href="?id=' . $_GET ['id'] . '&select=all">#</a></td>';
		}
		$aff .= '	<td align="center"><b>Mode d\'ajout</b></td>';
		$aff .= '	<td align="center"><b>Civilité</b></td>';
		$aff .= '	<td align="center"><a href="?id=' . $_GET ['id'] . '&sort=1' . (isset ( $_GET ['order'] ) ? ($_GET ['order'] == 'az' ? '&order=za' : '&order=az') : '&order=az') . '"><b>Nom</b></a></td>';
		$aff .= '	<td align="center"><a href="?id=' . $_GET ['id'] . '&sort=2' . (isset ( $_GET ['order'] ) ? ($_GET ['order'] == 'az' ? '&order=za' : '&order=az') : '&order=az') . '"><b>Prénom</b></a></td>';
		$aff .= '	<td align="center"><a href="?id=' . $_GET ['id'] . '&sort=3' . (isset ( $_GET ['order'] ) ? ($_GET ['order'] == 'az' ? '&order=za' : '&order=az') : '&order=az') . '"><b>Société</b></a></td>';
		$aff .= '	<td align="center"><a href="?id=' . $_GET ['id'] . '&sort=4' . (isset ( $_GET ['order'] ) ? ($_GET ['order'] == 'az' ? '&order=za' : '&order=az') : '&order=az') . '"><b>Type</b></a></td>';
		$aff .= '	<td align="center"><b>Direction Régionale</b></td>';
		$aff .= '	<td align="center"><b>A Répondu</b></td>';
		$aff .= '	<td align="center"><b>Présence Convention</b></td>';
		$aff .= '	<td align="center"><b>Présence Repas</b></td>';
		// $aff .= ' <td align="center"><b>Souhaite un Taxi</b></td>';
		$aff .= '	<td align="center"><b>Souhaite un Parking</b></td>';
		$aff .= '	<td align="center"><b>Participe au diner</b></td>';
		$aff .= '	<td align="center"><a href="?id=' . $_GET ['id'] . '&sort=5' . (isset ( $_GET ['order'] ) ? ($_GET ['order'] == 'az' ? '&order=za' : '&order=az') : '&order=az') . '"><b>Dernière Modification</b></a></td>';
		$aff .= '	<td align="center" width="100" colspan="2"><b>Actions</b></td>';
		$aff .= '</tr>';

		if (count ( $this->myList->getList () ) == 0) {
			$aff .= '<tr>';
			$aff .= '	<td colspan="9"><i>Pas d\'individu...</i></td>';
			$aff .= '</tr>';
		} else {
			$row = 1;
			foreach ( $this->myList->getList () as $aAnnuaire ) {
				$aff .= '<tr>';
				if (isset ( $_GET ['select'] )) {
					if ($_GET ['select'] == 'all') {
						$aff .= '<td align="center"  class="' . ($row == 1 ? 'row1' : 'row2') . '" ><input type="checkbox"  id="rows_' . $aAnnuaire->getID () . '" name="case_' . $aAnnuaire->getID () . '" value="' . $aAnnuaire->getID () . '" checked></td>';
					}
				} else {
					$aff .= '<td align="center"  class="' . ($row == 1 ? 'row1' : 'row2') . '" ><input type="checkbox" id="rows_' . $aAnnuaire->getID () . '" name="case_' . $aAnnuaire->getID () . '" value="' . $aAnnuaire->getID () . '"></td>';
				}
				switch ($aAnnuaire->getTypeInscription ()) {
					case 0 :
						$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">GCR</td>';
						break;
					case 1 :
						$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">Manuel</td>';
						break;
					case 2 :
						$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">Invité</td>';
						break;
				}

				switch ($aAnnuaire->getCivilite ()) {
					case '1' :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">M.</td>';
						break;
					case '2' :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">Mme</td>';
						break;
					case '3' :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">Mlle</td>';
						break;
					default :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">-</td>';
						break;
				}
				$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aAnnuaire->getNom () ) . '</td>';
				$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aAnnuaire->getPrenom () ) . '</td>';
				$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $aAnnuaire->getSociete () ) . '</td>';
				switch ($aAnnuaire->getAnnuaireTypeID ()) {
					case '1' :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">Concessionnaire / Directeur Général</td>';
						break;
					case '2' :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">Directeur de concession</td>';
						break;
					case '3' :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">RRG</td>';
						break;
					case '4' :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">Constructeur</td>';
						break;
					case '5' :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">Partenaires</td>';
						break;
					case '6' :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">Nos autres invités</td>';
						break;
					case '7' :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">Invité par Concessionnaire</td>';
						break;
					case '8' :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">GCRE</td>';
						break;
					case '9' :
						$aff .= '	<td class="' . ($row == 1 ? 'row1' : 'row2') . '">GCR+</td>';
						break;
				}

				$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . ($aAnnuaire->getDirectionRegionale () != '0' ? $this->myDR [$aAnnuaire->getDirectionRegionale ()] : '-') . '</td>';
				$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . ($aAnnuaire->getRepondu () == '1' ? '<img src="../../include/images/icone_oui.png"/>' : '-') . '</td>';
				$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . ($aAnnuaire->getPresence () == '1' ? '<img src="../../include/images/icone_oui.png"/>' : '-') . '</td>';
				$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . ($aAnnuaire->getRepas () == '1' ? '<img src="../../include/images/icone_oui.png"/>' : '-') . '</td>';
				$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . ($aAnnuaire->getTaxi () == '1' ? '<img src="../../include/images/icone_oui.png"/>' : '-') . '</td>';
				$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . ($aAnnuaire->getDiner () == '1' ? '<img src="../../include/images/icone_oui.png"/>' : '-') . '</td>';
				$aff .= '	<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aAnnuaire->getMiseAJour () . '</td>';
				if ($aConvention->getStatut () != '4') {
					$aff .= '	<td width="50" align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="?action=edit&id=' . $aAnnuaire->getID () . '"><img src="../../../../include/images/document_edit.png" border="0"/></a></td>';
					$aff .= '	<td width="50" align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="#" onclick="javascript:callDelete(' . $aAnnuaire->getID () . ')"><img src="../../../../include/images/garbage_empty.png" border="0"/></a></td>';
				} else {
					$aff .= '	<td width="50" align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="?action=edit&id=' . $aAnnuaire->getID () . '"><img src="../../../../include/images/document_edit.png" border="0"/></a></td>';
					$aff .= '	<td width="50" align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">-</td>';
				}
				$aff .= '</tr>';
				$row = ($row == 1 ? 2 : 1);
			}
		}

		$aff .= '</table>';
		$aff .= '</form>';

		$aff .= '<script type="text/javascript">';
		$aff .= 'function callDelete(id){';
		$aff .= '	if(confirm("Etes vous sûr de vouloir supprimer cette personne?")){document.location.href=\'?action=delete&id=\'+id;}';
		$aff .= '}';
		$aff .= 'function callDeleteAll(){';
		$aff .= '	if(confirm("Attention, vous êtes sur le point de supprimer tous les individus de l\'annuaire convention.")){ if(confirm("Supprimer tous les individus de l\'annuaire convention.")){document.location.href=\'?action=deleteAll&id=' . $_GET ['id'] . '\';}}';
		$aff .= '}';
		$aff .= '</script>';

		echo $aff;
	}
}
?>