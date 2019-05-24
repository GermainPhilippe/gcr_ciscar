<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Formulaire
 * @version 1.0.4
 */
class ConventionFormulaireView {
	private $myFormulaire;
	public function __construct($aFormulaire) {
		$this->myFormulaire = $aFormulaire;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane"><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;<a href="?">Formulaire</a>';
		$aff .= '&nbsp;>&nbsp;' . (isset ( $_GET ['id'] ) ? 'Edition' : 'Création') . '</div><br/><br/>';

		$aff .= '<script src="../../../../include/js/app-convention.js"></script>';

		$aff .= '<form method="post">';

		$aff .= '<table>';
		$aff .= '<tr><td>Nom</td><td><input type="text" name="Nom" value="' . $this->myFormulaire->getNom () . '" size="50"></td><td><input type="submit" value="' . (isset ( $_GET ['id'] ) ? 'Mettre à  jour' : 'Créer') . '"></td></tr>';
		$aff .= '</table>';

		$aff .= '';

		if (isset ( $_GET ['id'] )) {
			$aff .= '<br><br>';
			$aff .= '<hr><h3><b>Composition du formulaire</b></h3>';
			$aff .= '<select id="fieldSelection" name="fieldSelection"><option></option>';
			$aff .= '<option value="1">Champ - Text Simple</option>';
			$aff .= '<option value="2">Champ - Text Large</option>';
			$aff .= '<option value="3">Champ - Liste déroulante</option>';
			$aff .= '<option value="4">Champ - Case à cocher</option>';
			$aff .= '<option value="5">Champ - Bouton radio</option>';
			$aff .= '<option value="6">Composant - Liste page</option>';
			$aff .= '<option value="7">Composant - Bandeau</option>';
			$aff .= '<option value="8">Composant - Zone de texte</option>';
			$aff .= '<option value="9">Composant - Formulaire Individu Inscription</option>';
			$aff .= '<option value="10">Composant - Formulaire Individu Satisfaction</option>';
			$aff .= '<option value="11">Composant - Formulaire Invite</option>';
			$aff .= '<option value="12">Composant - Bouton Soumettre</option>';
			$aff .= '<option value="13">Composant - Invitation à Diner</option>';

			$aff .= '</select>';
			$aff .= '<input type="button" value="Nouveau" onclick="Convention.Formulaire.btNouveauChamp()">';

			$daoComposition = new ConventionFormulaireCompositionDAO ();
			$daoField = new ConventionFormulaireFieldDAO ();
			$daoComposant = new ConventionFormulaireComposantDAO ();

			$compositionList = $daoComposition->findAll ( $_GET ['id'] );

			$aff .= '<table width="100%" id="TableList">';
			$aff .= '<tr class="title" bgcolor="#CCCCCC" style="background-image:url(\'../../include/images/ligne.jpg\');" height="25">';
			$aff .= '<td align="center"><b>Type</b></td>';
			$aff .= '<td align="center"><b>Question</b></td>';
			$aff .= '<td align="center" colspan="3" width="150"><b>Action</b></td></tr>';

			if (count ( $compositionList ) > 0) {
				$row = 1;
				$first = true;
				$last = 0;
				$i = 0;
				foreach ( $compositionList as $composition ) {
					$i ++;
					$nextcompo = isset ( $compositionList [$i] ) ? $compositionList [$i] : null;

					$aff .= '<tr>';
					$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $composition->getType () . '</td>';

					$instance = null;
					if ($composition->getType () == ConventionFormulaireComposition::TYPE_FIELD) {
						$instance = $daoField->find ( $composition->getId () );
						$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $instance->getQuestion () ) . '</td>';
						$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50">';
						if ($first == false) {
							$aff .= '<a href="formulaireChamp.php?action=switchUp&id=' . $_GET ['id'] . '&compoid=' . $composition->getId () . '&compoid2=' . $last . '"><img border="0" src="../../../../include/images/arrow_state_up.png"></a> ';
						} else {
							$first = false;
						}

						if (! is_null ( $nextcompo )) {
							$aff .= '<a href="formulaireChamp.php?action=switchUp&id=' . $_GET ['id'] . '&compoid=' . $nextcompo->getId () . '&compoid2=' . $composition->getId () . '"><img border="0" src="../../../../include/images/arrow_state_down.png"></a> ';
						}

						$aff .= '</td>';
						$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a style="cursor:pointer;" onclick="Convention.Formulaire.btEditField(\'' . $instance->getType () . '\', \'' . $composition->getId () . '\')"><img border="0" src="../../../../include/images/document_edit.png"></a></td>';
						$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a href="formulaireChamp.php?action=delete&id=' . $_GET ['id'] . '&compoid=' . $composition->getId () . '"><img border="0" src="../../../../include/images/garbage_empty.png"></a></td></tr>';
					} else {

						$instance = $daoComposant->find ( $composition->getId () );
						$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . stripslashes ( $instance->getNom () ) . '</td>';
						$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50">';
						if ($first == false) {
							$aff .= '<a href="formulaireChamp.php?action=switchUp&id=' . $_GET ['id'] . '&compoid=' . $composition->getId () . '&compoid2=' . $last . '"><img border="0" src="../../../../include/images/arrow_state_up.png"></a> ';
						} else {
							$first = false;
						}
						if (! is_null ( $nextcompo )) {
							$aff .= '<a href="formulaireChamp.php?action=switchUp&id=' . $_GET ['id'] . '&compoid=' . $nextcompo->getId () . '&compoid2=' . $composition->getId () . '"><img border="0" src="../../../../include/images/arrow_state_down.png"></a> ';
						}

						$aff .= '</td>';
						$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a style="cursor:pointer;" onclick="Convention.Formulaire.btEditComposant(\'' . $instance->getType () . '\', \'' . $composition->getId () . '\')"><img border="0" src="../../../../include/images/document_edit.png"></a></td>';
						$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><a href="formulaireComposant.php?action=delete&id=' . $_GET ['id'] . '&compoid=' . $composition->getId () . '"><img border="0" src="../../../../include/images/garbage_empty.png"></a></td></tr>';
					}

					$row = ($row == 1 ? 2 : 1);
					$last = $composition->getId ();
				}
			}

			$aff .= '</table>';
		}

		$aff .= '<input type="hidden" name="cid" id="cid" value="">';
		$aff .= '<input type="hidden" name="id" id="id" value="' . (isset ( $_GET ['id'] ) ? $_GET ['id'] : '') . '">';
		$aff .= '</form>';
		echo $aff;
	}
}
?>