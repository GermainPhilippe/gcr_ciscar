<?php
class ListeDiffusionView {
	private $myListeDiffusion;
	private $myListeDiffusionCritereCollection;
	public function __construct(ListeDiffusion $aListeDiffusion) {
		$this->myListeDiffusion = $aListeDiffusion;
		$this->myListeDiffusionCritereCollection = array ();
	}
	public function renderHTML($mod) {
		switch ($mod) {
			case 'new' :
				$aff = '<form action="?action=new" method="post">';
				break;
			case 'newOutlook' :
				$aff = '<form action="?action=newOutlook" method="post">';
				break;
			case 'update' :
				$aff = '<form action="?action=update&id=' . $this->myListeDiffusion->getID () . '" method="post">';
				break;
			case 'updateOutlook' :
				$aff = '<form action="?action=updateOutlook&id=' . $this->myListeDiffusion->getID () . '" method="post">';
				break;
		}

		// Navigation Bar
		$aff .= '<div id="FilAriane">' . "\n";
		switch ($mod) {
			case 'update' :
			case 'new' :
				$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;';
				$aff .= '<a href="?">Liste Diffusion</a>' . "\n";
				break;
			case 'updateOutlook' :
			case 'newOutlook' :
				$aff .= '<a href="../../?menu=1">Général</a>&nbsp;>&nbsp;';
				$aff .= '<a href="?">Liste Outlook</a>' . "\n";
				break;
		}

		switch ($mod) {
			case 'newOutlook' :
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Cr&eacute;ation';
				break;
			case 'updateOutlook' :
			case 'update' :
				$aff .= '&nbsp;>&nbsp;Modification';
				break;
		}

		$aff .= '</div><br/><br/>' . "\n";

		if ($mod == 'newOutlook' || $mod == 'updateOutlook')
			$aff .= '<input type="hidden" value="outlook" name="Categorie" id="Categorie"/>';
		if ($mod == 'new' || $mod == 'update')
			$aff .= '<input type="hidden" value="news" name="Categorie" id="Categorie"/>';

		if ($mod == 'new' || $mod == 'update') {
			// Description
			$aff .= '<table>';
			$aff .= '<tr>';
			$aff .= '<td width="150">Nom</td>';
			$aff .= '<td><input type="text" name="Nom" value="' . $this->myListeDiffusion->getNom () . '"/></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '<td width="150">Type</td>';
			$aff .= '<td>';
			$aff .= '<select name="Type" id="Type">';
			$aff .= '<option value="1"' . (in_array ( $this->myListeDiffusion->getType (), array (
					ListeDiffusion::TYPE_SIMPLE_ET,
					ListeDiffusion::TYPE_SIMPLE_OU
			) ) ? ' SELECTED=SELECTED' : '') . '>Simple</option>';
			$aff .= '<option value="2"' . (in_array ( $this->myListeDiffusion->getType (), array (
					ListeDiffusion::TYPE_SPECIFIQUE_ET,
					ListeDiffusion::TYPE_SPECIFIQUE_OU
			) ) ? ' SELECTED=SELECTED' : '') . '>Sp&eacute;cifique</option>';
			$aff .= '<option value="3"' . (in_array ( $this->myListeDiffusion->getType (), array (
					ListeDiffusion::TYPE_CSV_OU,
					ListeDiffusion::TYPE_CSV_ET
			) ) ? ' SELECTED=SELECTED' : '') . '>Csv</option>';
			$aff .= '</select>';
			$aff .= '</td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '<td width="150"></td>';
			$aff .= '<td>';
			$aff .= '<input type="radio" name="TypeListe" value="ET"' . (in_array ( $this->myListeDiffusion->getType (), array (
					ListeDiffusion::TYPE_SIMPLE_ET,
					ListeDiffusion::TYPE_SPECIFIQUE_ET,
					ListeDiffusion::TYPE_CSV_ET
			) ) ? ' CHECKED=CHECKED' : '') . ' /> Valide toutes les conditions (ET)<br/>';
			$aff .= '<input type="radio" name="TypeListe" value="OU"' . (in_array ( $this->myListeDiffusion->getType (), array (
					ListeDiffusion::TYPE_SIMPLE_OU,
					ListeDiffusion::TYPE_SPECIFIQUE_OU,
					ListeDiffusion::TYPE_CSV_OU
			) ) ? ' CHECKED=CHECKED' : '') . '/> Valide au moins une des conditions (OU)<br/>';
			$aff .= '</td>';
			$aff .= '</tr>';
			$aff .= '</table><br/>';
		}

		if ($mod == 'newOutlook' || $mod == 'updateOutlook') {
			// Description
			$aff .= '<table>';
			$aff .= '<tr>';
			$aff .= '<td width="150">Nom de la liste de diffusion Outlook</td>';
			$aff .= '<td><input type="text" style="width:350px;" name="Nom" value="' . $this->myListeDiffusion->getNom () . '"/></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '<td width="150"><input type="hidden" value="1" name="Type" id="Type"/></td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '<td width="150"><input type="hidden" value="OU" name="TypeListe" id="TypeListe"/></td>';
			$aff .= '</tr>';
			$aff .= '</table>';
		}

		// Liste des criteres
		if ($mod == 'update' || $mod == 'updateOutlook') {
			$aManager = new ListeDiffusionCritereManager ();
			$this->myListeDiffusionCritereCollection = $aManager->getList ( $this->myListeDiffusion->getID () );
		}

		$aff .= '<input type="hidden" value="' . count ( $this->myListeDiffusionCritereCollection ) . '" name="Counter" id="Counter"/>';
		$aff .= '<table border="0" id="TableList">';
		$aff .= '<tr class="title">';
		$aff .= '<td>Crit&egrave;re</td>';

		if ($mod == 'new' || $mod == 'update') {
			$aff .= '<td>Contient</td>';
		}

		$aff .= '<td>Element</td>';
		$aff .= '<td width="50">Action</td>';
		$aff .= '</tr>';

		if ($mod == 'new' || $mod == 'update') {
			$lockOption_1 = (in_array ( $this->myListeDiffusion->getType (), array (
					ListeDiffusion::TYPE_CSV_OU,
					ListeDiffusion::TYPE_CSV_ET
			) ) ? ' disabled' : '');
			$lockOption_2 = (in_array ( $this->myListeDiffusion->getType (), array (
					ListeDiffusion::TYPE_SIMPLE_ET,
					ListeDiffusion::TYPE_SIMPLE_OU,
					ListeDiffusion::TYPE_CSV_OU,
					ListeDiffusion::TYPE_CSV_ET
			) ) ? ' disabled' : '');
			$lockOption_3 = (! in_array ( $this->myListeDiffusion->getType (), array (
					ListeDiffusion::TYPE_CSV_OU,
					ListeDiffusion::TYPE_CSV_ET
			) ) ? ' disabled' : '');
		}
		if ($mod == 'newOutlook' || $mod == 'updateOutlook') {
			$lockOption_1 = '';
			$lockOption_2 = '';
			$lockOption_3 = '';
		}
		// Liste d'ajout
		$aff .= '<tr>';
		$aff .= '<td>';
		$aff .= '<select name="TypeElement" id="TypeElement">';
		$aff .= '<option value="1"' . $lockOption_1 . '>Individu</option>';
		$aff .= '<option value="2"' . $lockOption_1 . '>Etablissement</option>';
		$aff .= '<option value="3"' . $lockOption_2 . '>Domaine d\'activite</option>';
		$aff .= '<option value="4"' . $lockOption_2 . '>Fonction Domaine d\'activite</option>';
		// $aff .= '<option value="5"'.$lockOption.'>D&eacute;l&eacute;gation R&eacute;gionale</option>';
		// $aff .= '<option value="6"'.$lockOption.'>Fonction R&eacute;gion</option>';
		$aff .= '<option value="7"' . $lockOption_2 . '>Commission / Groupe travail</option>';
		$aff .= '<option value="8"' . $lockOption_2 . '>Groupe LCA</option>';
		// $aff .= '<option value="9"'.$lockOption_2.'>Direction r&eacute;gionale</option>';
		if ($mod == 'newOutlook' || $mod == 'updateOutlook') {
			$aff .= '<option value="11"' . $lockOption_3 . '>Bureau National</option>';
		}
		$aff .= '<option value="10"' . $lockOption_3 . '>Import Mails</option>';
		$aff .= '</select>';

		if ($mod == 'new' || $mod == 'update') {
			$aff .= '</td>';
			$aff .= '<td align="center" width="100">';
			$aff .= '<select name="TypeContient" id="TypeContient">';
			$aff .= '<option value="1">Est</option>';
			$aff .= '<option value="2">N\'est pas</option>';
			$aff .= '</select>';
			$aff .= '</td>';
			$aff .= '<td><input type="hidden" name="CritereValue" id="CritereValue" readonly/><input type="text" name="CritereValueDisplay" id="CritereValueDisplay" readonly/><input onclick="OpenWindowSelection(\'\')" type="button" value="+"/></td>';
			// $aff .= '<td><input type="hidden" name="CritereValue" id="CritereValue" readonly/><input type="text" name="CritereValueDisplay" id="CritereValueDisplay" readonly/><input onclick="OpenWindowSelection()" type="button" value="+"/></td>';
			$aff .= '<td width="50" align="center"><a style="cursor:pointer;" onclick="javascript:addTrRule()"><img src="../../include/images/bt/bt_plus.png" border="0"/></a></td>';
			$aff .= '</tr>';
		}

		if ($mod == 'newOutlook' || $mod == 'updateOutlook') {
			$aff .= '</td>';
			$aff .= '<input type="hidden" value="1" name="TypeContient" id="TypeContient"/>';
			$aff .= '<td><input type="hidden" name="CritereValue" id="CritereValue" readonly/><input type="text" name="CritereValueDisplay" id="CritereValueDisplay" readonly/><input onclick="OpenWindowSelection(\'/admin/modules/listeDiffusion/\')" type="button" value="+"/></td>';
			// $aff .= '<td><input type="hidden" name="CritereValue" id="CritereValue" readonly/><input type="text" name="CritereValueDisplay" id="CritereValueDisplay" readonly/><input onclick="OpenWindowSelection()" type="button" value="+"/></td>';
			$aff .= '<td width="50" align="center"><a style="cursor:pointer;" onclick="javascript:addTrRuleOutlook()"><img src="../../include/images/bt/bt_plus.png" border="0"/></a></td>';
			$aff .= '</tr>';
		}

		// liste des criteres existant
		if ($mod == 'update' || $mod == 'updateOutlook') {
			$i = 1;
			foreach ( $this->myListeDiffusionCritereCollection as $aCritere ) {
				$aff .= "<tr>";
				$ElementValue = '';
				switch ($aCritere->getType ()) {
					case ListeDiffusionCritere::TYPE_INDIVIDU :
						$aSimple_Individu = new Simple_Individu ();
						$aSimple_Individu->SQL_SELECT ( $aCritere->getElementID () );
						$ElementValue = $aSimple_Individu->getNom () . ' ' . $aSimple_Individu->getPrenom ();
						$aff .= "<td><input type='hidden' name='TypeElement" . $i . "' value='1'/>" . ListeDiffusionCritere::TYPE_INDIVIDU . "</td>";
						break;
					case ListeDiffusionCritere::TYPE_ETABLISSEMENT :
						$aSimple_Etablissement = new Simple_Etablissement ();
						$aSimple_Etablissement->SQL_SELECT ( $aCritere->getElementID () );
						$ElementValue = $aSimple_Etablissement->getRaisonSociale ();
						$aff .= "<td><input type='hidden' name='TypeElement" . $i . "' value='2'/>" . ListeDiffusionCritere::TYPE_ETABLISSEMENT . "</td>";
						break;
					case ListeDiffusionCritere::TYPE_DOMAINE_ACTIVITE :
						$aDomaineActivite = new DomaineActivite ();
						$aDomaineActivite->select_domaineactivite ( $aCritere->getElementID () );
						$ElementValue = $aDomaineActivite->getName ();
						$aff .= "<td><input type='hidden' name='TypeElement" . $i . "' value='3'/>Domaine d\'activite</td>";
						break;
					case ListeDiffusionCritere::TYPE_FONCTION_DOMAINE_ACTIVITE :
						$aFonctionDA = new FonctionDA ();
						$aFonctionDA->SQL_SELECT ( $aCritere->getElementID () );
						$ElementValue = $aFonctionDA->getLibelle ();
						$aff .= "<td><input type='hidden' name='TypeElement" . $i . "' value='4'/>Fonction Domaine d\'activite</td>";
						break;
					case ListeDiffusionCritere::TYPE_REGION :
						$aRegion = new Region ();
						$aRegion->select_region ( $aCritere->getElementID () );
						$ElementValue = $aRegion->getName ();
						$aff .= "<td><input type='hidden' name='TypeElement" . $i . "' value='5'/>D&eacute;l&eacute;gation R&eacute;gionale</td>";
						break;
					case ListeDiffusionCritere::TYPE_FONCTION_REGION :
						$aFonctionDelegation = new FonctionDelegation ();
						$aFonctionDelegation->select_fonctiondelegation ( $aCritere->getElementID () );
						$ElementValue = $aFonctionDelegation->getName ();
						$aff .= "<td><input type='hidden' name='TypeElement" . $i . "' value='6'/>Fonction R&eacute;gion</td>";
						break;
					case ListeDiffusionCritere::TYPE_COMMISSION :
						$aCommission = new Commission ();
						$aCommission->select_commission ( $aCritere->getElementID () );
						$ElementValue = $aCommission->getName ();
						$aff .= "<td><input type='hidden' name='TypeElement" . $i . "' value='7'/>Commission / Groupe travail</td>";
						break;
					case ListeDiffusionCritere::TYPE_GROUPE_LCA :
						$aSimple_LCAGroupe = new Simple_LCAGroupe ();
						$aSimple_LCAGroupe->SQL_SELECT ( $aCritere->getElementID () );
						$ElementValue = $aSimple_LCAGroupe->getLibelle ();
						$aff .= "<td><input type='hidden' name='TypeElement" . $i . "' value='8'/>Groupe LCA</td>";
						break;
					case ListeDiffusionCritere::TYPE_REGION_ETABLISSEMENT :
						$aRegion = new Region ();
						$aRegion->select_region ( $aCritere->getElementID () );
						$ElementValue = $aRegion->getName ();
						$aff .= "<td><input type='hidden' name='TypeElement" . $i . "' value='5'/>Direction r&eacute;gionale</td>";
						break;
					case ListeDiffusionCritere::TYPE_BUREAU_NATIONAL :
						$aFonctionBN = new FonctionBN ();
						$aFonctionBN->select_fonctionbn ( $aCritere->getElementID () );
						$ElementValue = $aFonctionBN->getName ();
						$aff .= "<td><input type='hidden' name='TypeElement" . $i . "' value='11'/>Bureau National</td>";
						break;
					case ListeDiffusionCritere::TYPE_CSV :
						$aListeCsv = new ListeDiffusionCsv ();
						$aListeCsv->select_Csv ( $aCritere->getElementID () );
						$ElementValue = $aListeCsv->getFileName ();
						$aff .= "<td><input type='hidden' name='TypeElement" . $i . "' value='10'/>Import Mails</td>";
						break;
				}

				if ($mod == 'new' || $mod == 'update') {
					switch ($aCritere->getContient ()) {
						case ListeDiffusionCritere::CONTIENT_EST :
							$aff .= "<td align='center'><input type='hidden' name='TypeContient" . $i . "' value='1'/>Est</td>";
							break;
						case ListeDiffusionCritere::CONTIENT_NEST :
							$aff .= "<td align='center'><input type='hidden' name='TypeContient" . $i . "' value='2'/>N'est pas</td>";
							break;
					}
				}

				if ($mod == 'newOutlook' || $mod == 'updateOutlook') {
					switch ($aCritere->getContient ()) {
						case ListeDiffusionCritere::CONTIENT_EST :
							$aff .= "<input type='hidden' name='TypeContient" . $i . "' value='1'/>";
							break;
						case ListeDiffusionCritere::CONTIENT_NEST :
							$aff .= "<input type='hidden' name='TypeContient" . $i . "' value='2'/>";
							break;
					}
				}

				if ($aCritere->getElementID () == - 1) {
					$ElementValue = 'Tous';
				}
				$aff .= "<td><input type='hidden' name='CritereValue" . $i . "' value='" . $aCritere->getElementID () . "'/>" . $ElementValue . "</td>";
				$aff .= "<td width='50' align='center'><a style='cursor:pointer;' onclick='$(this).parent().parent().remove();'><img src='../../include/images/bt/bt_moins.png' border=0/></a></td>";
				$aff .= "</tr>";
				$i ++;
			}
		}

		$aff .= '</table><br/><br/>';

		// Bouton
		switch ($mod) {
			case 'new' :
			case 'newOutlook' :
				$aff .= '<input type="submit" value="Cr&eacute;er"/>';
				break;
			case 'update' :
			case 'updateOutlook' :
				$aff .= '<input type="submit" value="Modifier"/>';
				break;
		}

		$aff .= '</form>';
		if ($mod == 'new' || $mod == 'update')
			$aff .= '<div id="dialog" title="Crit&egrave;re"><iframe id="dialogIFrame" src="#" width="100%" height="100%"></iframe></div>';
		if ($mod == 'newOutlook' || $mod == 'updateOutlook')
			$aff .= '<div id="dialog" title="Crit&egrave;re"><iframe id="dialogIFrame" src="/admin/modules/listeDiffusion/" width="100%" height="100%"></iframe></div>';
		echo $aff;
	}
}

?>