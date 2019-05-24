<?php
class EnqueteFormulaireComposantListePageView {
	private $composant;
	public function __construct($composant) {
		$this->composant = $composant;
	}
	public function renderHTML() {
		$aff = '<h3>Composant - Liste page</h3>';
		$aff .= '<form method="post">';
		$aff .= '<b>Nom</b><br>';
		$aff .= '<input type="text" name="nom" size="50" value="' . $this->composant->getNom () . '"><br><br>';
		$aff .= '<table>';

		$tab = explode ( ';', $this->composant->getValeur () );
		$valeurs = array ();
		foreach ( $tab as $val ) {
			if (strlen ( $val ) > 0) {
				$valeurs [$val] = true;
			}
		}

		$dao = new EnquetePageDAO ();
		$list = $dao->findAll ();
		if (count ( $list ) > 0) {
			foreach ( $list as $page ) {
				$aff .= '<tr><td><input type="checkbox" name="page' . $page->getId () . '" value="1"' . (isset ( $valeurs [$page->getId ()] ) ? ' CHECKED=CHECKED' : '') . '></td><td>' . $page->getTitle () . '</td></tr>';
			}
		}
		$aff .= '</table>';
		$aff .= '<input type="submit" value="Enregistrer">';
		$aff .= '</form>';
		echo $aff;
	}
}