<?php
class ConventionFormulaireFieldView {
	private $myField;
	public function __construct($conventionFormulaireField) {
		$this->myField = $conventionFormulaireField;
	}
	public function renderHTML() {
		$aff = '';

		switch ($_GET ['type']) {
			case '1' :
				$aff .= '<h3>Champ - Text simple</h3>';
				break;
			case '2' :
				$aff .= '<h3>Champ - Textarea</h3>';
				break;
			case '3' :
				$aff .= '<h3>Champ - Liste déroulante</h3>';
				break;
			case '4' :
				$aff .= '<h3>Champ - Case à cocher</h3>';
				break;
			case '5' :
				$aff .= '<h3>Champ - Bouton radio</h3>';
				break;
			default :
				echo 'error';
				break;
		}

		$aff .= '<form method="post">';
		$aff .= '<table>';
		$aff .= '<tr><td><b>Question</b></td></tr>';
		$aff .= '<tr><td><input type="text" name="question" size="100" value="' . $this->myField->getQuestion () . '"></td></tr>';
		switch ($_GET ['type']) {
			case '1' :
			case '2' :
				break;
			case '3' :
			case '4' :
			case '5' :
				$aff .= '<tr><td><b>Liste de choix</b></td></tr>';
				$aff .= '<tr><td>';
				$aff .= '<table>';
				$aff .= '<tr><td>Choix 1</td><td><input type="text" name="choix1" size="50" value="' . $this->myField->getChoix1 () . '"></td></tr>';
				$aff .= '<tr><td>Choix 2</td><td><input type="text" name="choix2" size="50" value="' . $this->myField->getChoix2 () . '"></td></tr>';
				$aff .= '<tr><td>Choix 3</td><td><input type="text" name="choix3" size="50" value="' . $this->myField->getChoix3 () . '"></td></tr>';
				$aff .= '<tr><td>Choix 4</td><td><input type="text" name="choix4" size="50" value="' . $this->myField->getChoix4 () . '"></td></tr>';
				$aff .= '<tr><td>Choix 5</td><td><input type="text" name="choix5" size="50" value="' . $this->myField->getChoix5 () . '"></td></tr>';
				$aff .= '<tr><td>Choix 6</td><td><input type="text" name="choix6" size="50" value="' . $this->myField->getChoix6 () . '"></td></tr>';
				$aff .= '<tr><td>Choix 7</td><td><input type="text" name="choix7" size="50" value="' . $this->myField->getChoix7 () . '"></td></tr>';
				$aff .= '<tr><td>Choix 8</td><td><input type="text" name="choix8" size="50" value="' . $this->myField->getChoix8 () . '"></td></tr>';
				$aff .= '<tr><td>Choix 9</td><td><input type="text" name="choix9" size="50" value="' . $this->myField->getChoix9 () . '"></td></tr>';
				$aff .= '<tr><td>Choix 10</td><td><input type="text" name="choix10" size="50" value="' . $this->myField->getChoix10 () . '"></td></tr>';
				$aff .= '</table>';
				$aff .= '</td></tr>';
				break;
			default :
				echo 'error';
				break;
		}
		$aff .= '</table>';

		$aff .= '<input type="submit" value="Enregistrer">';
		$aff .= '</form>';
		echo $aff;
	}
}