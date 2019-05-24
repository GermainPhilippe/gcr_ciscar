<?php
class ConventionView {
	private $myConvention;
	private $myListPage;
	private $myListFormulaire;
	public function __construct($aConvention, $listPage, $listFormulaire) {
		$this->myConvention = $aConvention;
		$this->myListPage = $listPage;
		$this->myListFormulaire = $listFormulaire;
	}

	// ###
	private function phaseInscription() {
		$aff = '<img src="../../include/images/puce.gif"/> <b>Phase Inscription</b><hr>';
		$aff .= '<table width="100%">';
		$aff .= '<tr><td>';

		$aff .= '<table width="100%">';
		$aff .= '<tr>';
		$aff .= '	<td width="100">Date Début*</td>';
		$aff .= '	<td><input type="text" name="DateDebutInscription" id="DateDebutInscription" value="' . ConventionControler::getDateFR ( $this->myConvention->getDateDebutInscription () ) . '" readonly/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td width="100">Date Fin*</td>';
		$aff .= '	<td><input type="text" name="DateFinInscription" id="DateFinInscription" value="' . ConventionControler::getDateFR ( $this->myConvention->getDateFinInscription () ) . '" readonly/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td width="100">Page Clôture</td>';
		$aff .= '	<td><select id="PageClotureInscription" name="PageClotureInscription"><option></option>';
		if (count ( $this->myListPage ) > 0) {
			foreach ( $this->myListPage as $page ) {
				$aff .= '<option value="' . $page->getId () . '"' . ($page->getId () == $this->myConvention->getPageClotureInscription () ? ' SELECTED=SELECTED' : '') . '>' . stripslashes ( $page->getTitle () ) . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editPage(\'PageClotureInscription\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';

		$aff .= '</tr>';
		$aff .= '</table>';

		$aff .= '</td><td>';

		$aff .= '<table width="100%">';

		$aff .= '<tr>';
		$aff .= '<td>1. Concessionnaire / Directeur Général</td>';
		$aff .= '	<td><select name="lca11" id="lca11"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA11 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca11\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '<td>2. Directeur de concession</td>';
		$aff .= '	<td><select name="lca12" id="lca12"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA12 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca12\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>3. RRG</td>';
		$aff .= '	<td><select name="lca13" id="lca13"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA13 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca13\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '<td>4. Constructeur</td>';
		$aff .= '	<td><select name="lca14" id="lca14"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA14 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca14\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>5. Partenaires</td>';
		$aff .= '	<td><select name="lca15" id="lca15"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA15 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca15\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '<td>6. Nos autres invités</td>';
		$aff .= '	<td><select name="lca16" id="lca16"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA16 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca16\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '</tr>';

		// Nouveau Type 7/8/9
		$aff .= '<tr>';
		$aff .= '<td>7. Invité par Concessionnaire</td>';
		$aff .= '	<td><select name="lca17" id="lca17"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA17 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca17\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '<td>8.GCRE</td>';
		$aff .= '	<td><select name="lca18" id="lca18"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA18 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca18\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>9. GCR+</td>';
		$aff .= '	<td><select name="lca19" id="lca19"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA19 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca19\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '<td></td>';
		$aff .= '<td></td>';
		$aff .= '</tr>';

		$aff .= '</table>';

		$aff .= '</td></tr>';
		$aff .= '</table>';

		$aff .= '<script type="text/javascript">';
		$aff .= '$(document).ready(function() {';
		$aff .= '			$("#DateDebutInscription").datepicker();';
		$aff .= '		});';
		$aff .= '$(document).ready(function() {';
		$aff .= '			$("#DateFinInscription").datepicker();';
		$aff .= '		});';
		$aff .= '</script>';

		return $aff;
	}
	private function phaseSatisfaction() {
		$aff = '<img src="../../include/images/puce.gif"/> <b>Phase Satisfaction</b><hr>';

		$aff .= '<table width="100%">';
		$aff .= '<tr><td>';

		$aff .= '<table width="100%">';
		$aff .= '<tr>';
		$aff .= '	<td width="100">Date Début*</td>';
		$aff .= '	<td><input type="text" name="DateDebutSatisfaction" id="DateDebutSatisfaction" value="' . ConventionControler::getDateFR ( $this->myConvention->getDateDebutSatisfaction () ) . '" readonly/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td width="100">Date Fin*</td>';
		$aff .= '	<td><input type="text" name="DateFinSatisfaction" id="DateFinSatisfaction" value="' . ConventionControler::getDateFR ( $this->myConvention->getDateFinSatisfaction () ) . '" readonly/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td width="100">Page Clôture</td>';
		$aff .= '	<td><select name="PageClotureSatisfaction" id="PageClotureSatisfaction"><option></option>';
		if (count ( $this->myListPage ) > 0) {
			foreach ( $this->myListPage as $page ) {
				$aff .= '<option value="' . $page->getId () . '"' . ($page->getId () == $this->myConvention->getPageClotureSatisfaction () ? ' SELECTED=SELECTED' : '') . '>' . stripslashes ( $page->getTitle () ) . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editPage(\'PageClotureSatisfaction\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		$aff .= '</td><td>';

		$aff .= '<table width="100%">';

		$aff .= '<tr>';
		$aff .= '<td>1. Concessionnaire / Directeur Général</td>';
		$aff .= '	<td><select name="lca21" id="lca21"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA21 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca21\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '<td>2. Directeur de concession</td>';
		$aff .= '	<td><select name="lca22" id="lca22"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA22 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca22\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>3. RRG</td>';
		$aff .= '	<td><select name="lca23" id="lca23"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA23 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca23\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '<td>4. Constructeur</td>';
		$aff .= '	<td><select name="lca24" id="lca24"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA24 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca24\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>5. Partenaires</td>';
		$aff .= '	<td><select name="lca25" id="lca25"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA25 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca25\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '<td>6. Nos autres invités</td>';
		$aff .= '	<td><select name="lca26" id="lca26"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA26 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca26\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '</tr>';

		// Nouveau Type 7/8/9
		$aff .= '<tr>';
		$aff .= '<td>7. Invité par Concessionnaire</td>';
		$aff .= '	<td><select name="lca27" id="lca27"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA27 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca27\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '<td>8.GCRE</td>';
		$aff .= '	<td><select name="lca28" id="lca28"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA28 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca28\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>9. GCR+</td>';
		$aff .= '	<td><select name="lca29" id="lca29"><option></option>';
		if (count ( $this->myListFormulaire ) > 0) {
			foreach ( $this->myListFormulaire as $formulaire ) {
				$aff .= '<option value="' . $formulaire->getID () . '"' . ($this->myConvention->getLCA29 () == $formulaire->getID () ? ' SELECTED=SELECTED' : '') . '>' . $formulaire->getNom () . '</option>';
			}
		}
		$aff .= '</select><a style="cursor:pointer;" onclick="editFormulaire(\'lca29\')"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
		$aff .= '<td></td>';
		$aff .= '<td></td>';
		$aff .= '</tr>';

		$aff .= '</table>';

		$aff .= '</td></tr>';

		$aff .= '</table>';

		$aff .= '<script type="text/javascript">';
		$aff .= '$(document).ready(function() {';
		$aff .= '			$("#DateDebutSatisfaction").datepicker();';
		$aff .= '		});';
		$aff .= '$(document).ready(function() {';
		$aff .= '			$("#DateFinSatisfaction").datepicker();';
		$aff .= '		});';
		$aff .= '</script>';
		return $aff;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane"><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;<a href="?">Conventions</a>&nbsp;>&nbsp;Edition</div><br/><br/>';
		if ($this->myConvention->getStatut () != PhaseConvention::$PHASE_ARCHIVE) {
			$aff .= '<form method="POST" name="FormConvention" action="?action=edit&id=' . $this->myConvention->getID () . '" onsubmit="return ValidateConventionForm()">';
		}

		$aff .= '<label style="margin-right:50px;">Nom</label><input type="text" name="Nom" value="' . $this->myConvention->getNom () . '" size="50"><br><br>';

		$aff .= $this->phaseInscription ();
		$aff .= '<br/><br/>';
		$aff .= $this->phaseSatisfaction ();

		if ($this->myConvention->getStatut () != PhaseConvention::$PHASE_ARCHIVE) {
			$aff .= '<p><input type="submit" value="Mise à jour"></p>';
			$aff .= '</form>';
		}

		$aff .= '<script type="text/javascript">';
		$aff .= '
		function editPage(selectId){
			var selectElmt = document.getElementById(selectId);
			var val = selectElmt.options[selectElmt.selectedIndex].value;
			if(val != "") {
			document.location.href=\'../Page/?action=edit&id=\'+val;
			}
		}
		
		function editFormulaire(selectId){
			var selectElmt = document.getElementById(selectId);
			var val = selectElmt.options[selectElmt.selectedIndex].value;
			if(val != "") {
				document.location.href=\'../Formulaire/?action=edit&cid=' . $_GET ['id'] . '&id=\'+val;
			}
		}
		</script>';

		echo $aff;
	}
}
