<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Convention
 * @version 1.0.4
 */
class ConventionListView {
	private $myList;
	private $myConventionInscriptionList;
	private $myConventionSatisfactionList;
	private $ConventionPublier;
	private $ConventionActive = false;
	public function __construct($aList) {
		$this->myList = $aList;

		$this->myConventionInscriptionList = new ConventionList ();
		$this->myConventionInscriptionList->SQL_SELECT_BY_STATUT ( PhaseConvention::$PHASE_INSCRIPTION );
		$this->ConventionActive = count ( $this->myConventionInscriptionList->getList () ) > 0;

		$this->myConventionSatisfactionList = new ConventionList ();
		$this->myConventionSatisfactionList->SQL_SELECT_BY_STATUT ( PhaseConvention::$PHASE_SATISFACTION );
		$this->ConventionActive = count ( $this->myConventionSatisfactionList->getList () ) > 0 ? true : $this->ConventionActive;
	}

	// ###
	public function renderHTML() {
		$aff = '<div id="FilAriane"><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;Conventions</div><br/><br/>';

		$aff .= '<table width="100%">';
		$aff .= '<tr><td valign="top">';

		// ### CONVENTION EN CREATION ###
		$aff .= $this->renderConventionCreation_HTML ();

		// ### CONVENTION EN COURS ###
		$aff .= $this->renderConventionEnCours_HTML ();

		// ### CONVENTION ARCHIVEE ###
		$aff .= $this->renderConventionArchivee_HTML ();

		// ### CONVENTION WORKFLOW ###
		$aff .= '</td><td valign="top">';
		$aff .= '<a href="#" onclick="$(\'#ImgConventionWorkflow\').toggle();"><img src="../../include/images/puce.gif" border="0"/></a>';
		$aff .= '<div id="ImgConventionWorkflow"><b>Phases d\'une Convention</b><br/>';
		$aff .= '<p align="center"><img src="../../include/images/doc/app-convention.png"/></p></div>';
		$aff .= '</td></tr></table>';

		// ################

		$aff .= '<script type="text/javascript">';
		$aff .= 'function callDelete(id){';
		$aff .= '	if(confirm("Etes vous sûr de vouloir supprimer cette Convention?")){document.location.href=\'?action=delete&id=\'+id;}';
		$aff .= '}';
		$aff .= '</script>';

		echo $aff;
	}
	private function renderConventionEnCours_HTML() {
		$aff = '<img src="../../include/images/puce.gif"/>&nbsp;<b>Convention en Cours</b><br/><br/>';

		$aff .= '<table width="100%" id="TableList">';
		$aff .= '	<tr class="title" bgcolor="#CCCCCC" style="background-image:url(\'../../include/images/ligne.jpg\');" height="25">';
		$aff .= '		<td align="center" width="100"><b>Date Création</b></td>';
		$aff .= '		<td align="center" width="100"><b>Annuaire</b></b></td>';
		$aff .= '		<td align="center" width="100"><b>Formulaires</b></td>';
		$aff .= '		<td align="center" width="100"><b>Historique</b></td>';
		$aff .= '		<td align="center" width="150"><b>Nom</b></td>';
		$aff .= '		<td colspan="4" width="200" style="text-align:center;"><b>Actions</b></td>';
		$aff .= '	</tr>';

		$this->ConventionPublier = 0;
		$row = 1;
		foreach ( $this->myConventionInscriptionList->getList () as $aConvention ) {
			$aff .= '	<tr>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $this->getDateFR ( $aConvention->getDateCreation () ) . '</td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="../Annuaire/?id=' . $aConvention->getID () . '"><img src="../../include/images/icon_book_open.gif" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="../Formulaire/?"><img src="../../include/images/formulaire.jpg" width="16" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="?action=historique&id=' . $aConvention->getID () . '"><img src="../../include/images/bulleHistoriquePicto.png" width="16" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aConvention->getNom () . '</td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">';
			$aff .= '			<table><tr>
								<td>Inscription</td>
								<td align="center"><a href="#" onclick="confirmation(\'Etes vous sûr ?\',\'?action=changerStatut&id=' . $aConvention->getID () . '\')"><img src="../../include/images/puce_li.png" border="0" width="16"/></a></td>
								<td>Satisfaction</td></tr></table>';
			$aff .= '		</td>';
			$aff .= '		<td width="50" align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="?action=edit&id=' . $aConvention->getID () . '"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50">-</td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50">-</td>';
			$aff .= '	</tr>';
			$this->ConventionPublier = 1;
			$row = ($row == 1 ? 2 : 1);
		}

		$row = 1;
		foreach ( $this->myConventionSatisfactionList->getList () as $aConvention ) {
			$aff .= '	<tr>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $this->getDateFR ( $aConvention->getDateCreation () ) . '</td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="../Annuaire/?id=' . $aConvention->getID () . '"><img src="../../include/images/icon_book_open.gif" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="../Formulaire/?"><img src="../../include/images/formulaire.jpg" width="16" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="?action=historique&id=' . $aConvention->getID () . '"><img src="../../include/images/bulleHistoriquePicto.png" width="16" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aConvention->getNom () . '</td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">';
			$aff .= '			<table><tr>
								<td>Satisfaction</td>
								<td align="center"><a href="#" onclick="confirmation(\'Etes vous sûr ?\',\'?action=changerStatut&id=' . $aConvention->getID () . '\')"><img src="../../include/images/puce_li.png" border="0" width="16"/></a></td>
								<td>Archivage</td></tr></table>';
			$aff .= '		</td>';
			$aff .= '		<td width="50" align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="?action=edit&id=' . $aConvention->getID () . '"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50">-</td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50">-</td>';
			$aff .= '	</tr>';
			$this->ConventionPublier = 1;
			$row = ($row == 1 ? 2 : 1);
		}

		if ($this->ConventionPublier == 0) {
			$aff .= '	<tr>';
			$aff .= '		<td colspan="8" align="center"><i>Pas de Convention en Cours !</i></td>';
			$aff .= '	</tr>';
		}

		$aff .= '</table><br/><hr/>';
		return $aff;
	}
	private function renderConventionCreation_HTML() {
		$aff = '<img src="../../include/images/puce.gif"/>&nbsp;<b>Conventions en Création</b><br/><br/>';
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=newVide\'"/>';
		$aff .= '<input type="button" value="Nouveau avec Import GCR" onclick="location.href=\'?action=new\'"/><br/><br/>';

		$aff .= '<table id="TableList" width="100%">';
		$aff .= '	<tr class="title" bgcolor="#CCCCCC" style="background-image:url(\'../../include/images/ligne.jpg\');" height="25">';
		$aff .= '		<td align="center" width="100"><b>Date Création</b></td>';
		$aff .= '		<td align="center" width="100"><b>Annuaire</b></td>';
		$aff .= '		<td align="center" width="100"><b>Formulaires</b></td>';
		$aff .= '		<td align="center" width="100"><b>Historique</b></td>';
		$aff .= '		<td align="center"><b>Nom</b></td>';
		$aff .= '		<td align="center" width="150" colspan="' . (! $this->ConventionActive ? '4' : '3') . '"><b>Actions</b></td>';
		$aff .= '	</tr>';
		$aConventionList = new ConventionList ();
		$aConventionList->SQL_SELECT_BY_STATUT ( PhaseConvention::$PHASE_EN_CREATION );
		$row = 1;
		foreach ( $aConventionList->getList () as $aConvention ) {
			$aff .= '	<tr>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $this->getDateFR ( $aConvention->getDateCreation () ) . '</td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="../Annuaire/?id=' . $aConvention->getID () . '"><img src="../../include/images/icon_book_open.gif" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="../Formulaire/?"><img src="../../include/images/formulaire.jpg" width="16" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="?action=historique&id=' . $aConvention->getID () . '"><img src="../../include/images/bulleHistoriquePicto.png" width="16" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aConvention->getNom () . '</td>';
			if (! $this->ConventionActive) {

				$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">';
				$aff .= '			<table><tr>
					<td></td>
					<td align="center">' . ($this->ConventionPublier == 0 ? '<a href="#" onclick="confirmation(\'Etes vous sûr ?\',\'?action=changerStatut&id=' . $aConvention->getID () . '\')" ><img src="../../include/images/puce_li.png" border="0" width="16"/></a>' : '-') . '</td>
					<td>Inscription</td></tr></table>';
				$aff .= '		</td>';
			}
			$aff .= '		<td width="50" align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="?action=edit&id=' . $aConvention->getID () . '"><img src="../../include/images/document_edit.png" border="0"/></a></td>';
			$aff .= '		<td width="50" align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="#" onclick="javascript:callDelete(' . $aConvention->getID () . ')"><img src="../../include/images/delete.png" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50">-</td>';
			$aff .= '	</tr>';
			$row = ($row == 1 ? 2 : 1);
		}
		if (count ( $aConventionList->getList () ) == 0) {
			$aff .= '	<tr>';
			$aff .= '		<td colspan="8" align="center"><i>Pas de Convention en Création !</i></td>';
			$aff .= '	</tr>';
		}

		$aff .= '</table><br/><hr/>';
		return $aff;
	}
	private function renderConventionArchivee_HTML() {
		$aConventionList = new ConventionList ();
		$aConventionList->SQL_SELECT_BY_STATUT ( PhaseConvention::$PHASE_ARCHIVE );

		$aff = '<img src="../../include/images/puce.gif"/>&nbsp;<b>Conventions Archivées</b><br/><br/>';
		$aff .= '<table id="TableList" width="100%">';
		$aff .= '	<tr class="title" bgcolor="#CCCCCC" style="background-image:url(\'../../include/images/ligne.jpg\');" height="25">';
		$aff .= '		<td align="center" width="100"><b>Date Création</b></td>';
		$aff .= '		<td align="center" width="100"><b>Annuaire</b></td>';
		$aff .= '		<td align="center" width="100"><b>Formulaires</b></td>';
		$aff .= '		<td align="center" width="100"><b>Historique</b></td>';
		$aff .= '		<td align="center"><b>Nom</b></td>';
		$aff .= '		<td align="center" width="150" colspan="3"><b>Actions</b></td>';
		$aff .= '	</tr>';
		$row = 1;
		foreach ( $aConventionList->getList () as $aConvention ) {
			$aff .= '	<tr>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $this->getDateFR ( $aConvention->getDateCreation () ) . '</td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="../Annuaire/?id=' . $aConvention->getID () . '"><img src="../../include/images/icon_book_open.gif" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="../Formulaire/?"><img src="../../include/images/formulaire.jpg" width="16" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '"><a href="?action=historique&id=' . $aConvention->getID () . '"><img src="../../include/images/bulleHistoriquePicto.png" width="16" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aConvention->getNom () . '</td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a href="?action=edit&id=' . $aConvention->getID () . '"><img src="../../include/images/document_edit.png" width="16" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a href="#" onclick="javascript:callDelete(' . $aConvention->getID () . ')"><img src="../../include/images/delete.png" border="0"/></a></td>';
			$aff .= '		<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a href="#" onclick="confirmation(\'Etes vous sûr ?\',\'?action=cloner&id=' . $aConvention->getID () . '\')"><img src="../../include/images/action_dupliquer.png" width="16" border="0"/></a></td>';
			$aff .= '	</tr>';
			$row = ($row == 1 ? 2 : 1);
		}
		if (count ( $aConventionList->getList () ) == 0) {
			$aff .= '	<tr>';
			$aff .= '		<td colspan="7" align="center"><i>Pas de Convention Archivée !</i></td>';
			$aff .= '	</tr>';
		}

		$aff .= '</table>';
		return $aff;
	}
	public function getDateFR($DateEN) {
		$tab = preg_split ( "/-+/", $DateEN, 3 );
		return $tab [2] . '/' . $tab [1] . '/' . $tab [0];
	}
}
?>