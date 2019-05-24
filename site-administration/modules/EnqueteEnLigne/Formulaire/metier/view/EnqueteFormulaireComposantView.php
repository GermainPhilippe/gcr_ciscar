<?php
class EnqueteFormulaireComposantView {
	private $composant;
	public function __construct($composant) {
		$this->composant = $composant;
	}
	public function renderHTML() {
		$aff = '';
		switch ($_GET ['type']) {
			case '9' :
				$aff .= '<h3>Composant - Formulaire Individu Inscription</h3>';
				break;
			case '10' :
				$aff .= '<h3>Composant - Formulaire Individu Satisfaction</h3>';
				break;
			case '11' :
				$aff .= '<h3>Composant - Formulaire Invite</h3>';
				break;
			case '12' :
				$aff .= '<h3>Composant - Bouton Soumettre</h3>';
				break;
		}
		$aff .= '<form method="post">';
		$aff .= '<b>Nom</b><br>';
		$aff .= '<input type="text" name="nom" size="50" value="' . $this->composant->getNom () . '"><br><br>';

		$aff .= '<input type="submit" value="Enregistrer">';
		$aff .= '</form>';
		echo $aff;
	}
}