<?php
class SurveyPreview {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		$aff = '<style>';
		$aff .= '.Question{border:1px solid #CCC;width:800px;padding:5px;}';
		$aff .= '.Description{border:1px solid #CCC;width:100%;background:lightblue;}';
		$aff .= '.Choix{padding:5px;}';
		$aff .= '</style>';

		$aff .= '<div id="FilAriane">';
		$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">Formulaire en ligne</a>&nbsp;>&nbsp;Apercu';
		$aff .= '</div><br/>';

		foreach ( $this->myList as $aQuestion ) {
			$aff .= '<div class="Question">';
			$aff .= '<div class="Description">' . nl2br ( stripslashes ( $aQuestion->getDescription () ) ) . '</div>';
			switch ($aQuestion->getType ()) {
				case SurveyQuestion::TYPE_SIMPLE :
					$aff .= '<div class="Choix">';
					$aff .= '<input type="text" name="pQuestion-' . $aQuestion->getID () . '" style="width:100%">';
					$aff .= '</div>';
					break;
				case SurveyQuestion::TYPE_TEXTAREA :
					$aff .= '<div class="Choix">';
					$aff .= '<textarea name="pQuestion-' . $aQuestion->getID () . '" style="width:100%"></textarea>';
					$aff .= '</div>';
					break;
				case SurveyQuestion::TYPE_CHECKBOX :
					$aff .= '<div class="Choix">';
					if ($aQuestion->getChoix1 () != '') {
						$aff .= '<input type="checkbox" name="pQuestion-' . $aQuestion->getID () . '" value="1"/> ' . stripslashes ( $aQuestion->getChoix1 () ) . '<br/>';
					}
					if ($aQuestion->getChoix2 () != '') {
						$aff .= '<input type="checkbox" name="pQuestion-' . $aQuestion->getID () . '" value="2"/> ' . stripslashes ( $aQuestion->getChoix2 () ) . '<br/>';
					}
					if ($aQuestion->getChoix3 () != '') {
						$aff .= '<input type="checkbox" name="pQuestion-' . $aQuestion->getID () . '" value="3"/> ' . stripslashes ( $aQuestion->getChoix3 () ) . '<br/>';
					}
					if ($aQuestion->getChoix4 () != '') {
						$aff .= '<input type="checkbox" name="pQuestion-' . $aQuestion->getID () . '" value="4"/> ' . stripslashes ( $aQuestion->getChoix4 () ) . '<br/>';
					}
					if ($aQuestion->getChoix5 () != '') {
						$aff .= '<input type="checkbox" name="pQuestion-' . $aQuestion->getID () . '" value="5"/> ' . stripslashes ( $aQuestion->getChoix5 () ) . '<br/>';
					}
					if ($aQuestion->getChoix6 () != '') {
						$aff .= '<input type="checkbox" name="pQuestion-' . $aQuestion->getID () . '" value="6"/> ' . stripslashes ( $aQuestion->getChoix6 () ) . '<br/>';
					}
					$aff .= '</div>';
					break;
				case SurveyQuestion::TYPE_RADIO :
					$aff .= '<div class="Choix">';
					if ($aQuestion->getChoix1 () != '') {
						$aff .= '<input type="radio" name="pQuestion-' . $aQuestion->getID () . '" value="1"/> ' . stripslashes ( $aQuestion->getChoix1 () ) . '<br/>';
					}
					if ($aQuestion->getChoix2 () != '') {
						$aff .= '<input type="radio" name="pQuestion-' . $aQuestion->getID () . '" value="2"/> ' . stripslashes ( $aQuestion->getChoix2 () ) . '<br/>';
					}
					if ($aQuestion->getChoix3 () != '') {
						$aff .= '<input type="radio" name="pQuestion-' . $aQuestion->getID () . '" value="3"/> ' . stripslashes ( $aQuestion->getChoix3 () ) . '<br/>';
					}
					if ($aQuestion->getChoix4 () != '') {
						$aff .= '<input type="radio" name="pQuestion-' . $aQuestion->getID () . '" value="4"/> ' . stripslashes ( $aQuestion->getChoix4 () ) . '<br/>';
					}
					if ($aQuestion->getChoix5 () != '') {
						$aff .= '<input type="radio" name="pQuestion-' . $aQuestion->getID () . '" value="5"/> ' . $aQuestion->getChoix5 () . '<br/>';
					}
					if ($aQuestion->getChoix6 () != '') {
						$aff .= '<input type="radio" name="pQuestion-' . $aQuestion->getID () . '" value="6"/> ' . stripslashes ( $aQuestion->getChoix6 () ) . '<br/>';
					}
					$aff .= '</div>';
					break;
				case SurveyQuestion::TYPE_LIST :
					$aff .= '<div class="Choix"><select name="pQuestion-' . $aQuestion->getID () . '"><option value=""></option>';
					if ($aQuestion->getChoix1 () != '') {
						$aff .= '<option value="1"/> ' . stripslashes ( $aQuestion->getChoix1 () ) . '</option>';
					}
					if ($aQuestion->getChoix2 () != '') {
						$aff .= '<option value="2"/> ' . stripslashes ( $aQuestion->getChoix2 () ) . '</option>';
					}
					if ($aQuestion->getChoix3 () != '') {
						$aff .= '<option value="3"/> ' . stripslashes ( $aQuestion->getChoix3 () ) . '</option>';
					}
					if ($aQuestion->getChoix4 () != '') {
						$aff .= '<option value="4"/> ' . stripslashes ( $aQuestion->getChoix4 () ) . '</option>';
					}
					if ($aQuestion->getChoix5 () != '') {
						$aff .= '<option value="5"/> ' . $aQuestion->getChoix5 () . '</option>';
					}
					if ($aQuestion->getChoix6 () != '') {
						$aff .= '<option value="6"/> ' . stripslashes ( $aQuestion->getChoix6 () ) . '</option>';
					}
					$aff .= '</select></div>';
					break;
			}
			$aff .= '</div><br/>';
		}

		echo $aff;
	}
}
?>