<?php
class FormulaireView {
	private $listComposition;
	public function __construct($list) {
		$this->listComposition = $list;
	}
	public function renderHTML() {
		$daoComposant = new EnqueteFormulaireComposantDAO ();
		$daoField = new EnqueteFormulaireFieldDAO ();
		$compoListePage = '';

		$_SESSION ['Enquete'] ['USER'] ['CONNECTED'] = False;

		$aff = '<div class="form">';
		$aff .= '<input type="hidden" name="formHideSubmit">';

		foreach ( $this->listComposition as $composition ) {
			if ($composition->getType () == EnqueteFormulaireComposition::TYPE_FIELD) {
				$field = $daoField->find ( $composition->getId () );

				switch ($field->getType ()) {
					case EnqueteFormulaireField::TYPE_TEXT_LARGE :
						$aff .= $this->fieldTextLarge ( $field );
						break;
					case EnqueteFormulaireField::TYPE_TEXT_SIMPLE_OBLIGATOIRE :
						$aff .= $this->fieldTextSimpleObligatoire ( $field );
						break;
					case EnqueteFormulaireField::TYPE_CASE_A_COCHER :
						$aff .= $this->fieldCaseACocher ( $field );
						break;
					case EnqueteFormulaireField::TYPE_LIST_DEROULANTE :
						$aff .= $this->fieldListeDeroulante ( $field );
						break;
					case EnqueteFormulaireField::TYPE_BOUTON_RADIO :
						$aff .= $this->fieldBoutonRadio ( $field );
						break;
					default :
						$aff .= $this->fieldTextSimple ( $field );
						break;
				}
			} else {
				$composant = $daoComposant->find ( $composition->getId () );

				switch ($composant->getType ()) {
					case EnqueteFormulaireComposant::TYPE_BANDEAU :
						$aff .= $this->compoBandeau ( $composant );
						break;
					case EnqueteFormulaireComposant::TYPE_LISTE_PAGE :
						$compoListePage = $composant;
						$aff .= $this->compoListePage ( $composant, 'haut' );
						break;
					case EnqueteFormulaireComposant::TYPE_FORM_INDIVIDU_INSCRIPTION :
						$aff .= $this->compoFormIndividuInscription ( $composant );
						break;
					case EnqueteFormulaireComposant::TYPE_INVITATION_DINER :
						$aff .= $this->compoFormIndividuInscriptionDiner ( $composant );
						break;
					case EnqueteFormulaireComposant::TYPE_FORM_INDIVIDU_SATISFACTION :
						$aff .= $this->compoFormIndividuSatisfaction ( $composant );
						break;
					case EnqueteFormulaireComposant::TYPE_FORM_INVITE :
						$aff .= $this->compoFormInvite ( $composant );
						break;
					case EnqueteFormulaireComposant::TYPE_BUTTON_SUBMIT :
						$aff .= $this->compoButtonSubmit ( $composant );
						break;
					default :
						$aff .= $this->compoZoneText ( $composant );
						break;
				}
			}
		}
		if ($compoListePage != '') {
			// composant liste page en bas de page pour les petits devices
			$aff .= $this->compoListePage ( $compoListePage, 'bas' );
		}
		$aff .= '</div><!-- End Div Form -->' . PHP_EOL;
		echo $aff;
	}

	// Methods //
	private function fieldBoutonRadio($field) {
		$response = new EnqueteFormulaireFieldResponse ();

		if ($_SESSION ['Enquete'] ['USER'] ['CONNECTED']) {
			$daoResponse = new EnqueteFormulaireFieldResponseDAO ();
			$responseList = $daoResponse->findAll ( $field->getId (), $_SESSION ['Enquete'] ['USER'] ['ID'] );
			if (count ( $responseList ) > 0) {
				$response = $responseList [0];
			}
		}

		$aff = '<div class="Field" id="field' . $field->getId () . '">';
		$aff .= '<div class="Question">' . stripslashes ( $field->getQuestion () ) . '</div>';
		$aff .= '<div class="AnswersRdo">';
		$aff .= (strlen ( $field->getChoix1 () ) > 0 ? '<div class="radio"><label style="font-weight:normal;"><input type="radio" name="field' . $field->getId () . '" value="1"' . ($response->getValeur () == '1' ? ' CHECKED' : '') . '> ' . $field->getChoix1 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix2 () ) > 0 ? '<div class="radio"><label style="font-weight:normal;"><input type="radio" name="field' . $field->getId () . '" value="2"' . ($response->getValeur () == '2' ? ' CHECKED' : '') . '> ' . $field->getChoix2 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix3 () ) > 0 ? '<div class="radio"><label style="font-weight:normal;"><input type="radio" name="field' . $field->getId () . '" value="3"' . ($response->getValeur () == '3' ? ' CHECKED' : '') . '> ' . $field->getChoix3 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix4 () ) > 0 ? '<div class="radio"><label style="font-weight:normal;"><input type="radio" name="field' . $field->getId () . '" value="4"' . ($response->getValeur () == '4' ? ' CHECKED' : '') . '> ' . $field->getChoix4 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix5 () ) > 0 ? '<div class="radio"><label style="font-weight:normal;"><input type="radio" name="field' . $field->getId () . '" value="5"' . ($response->getValeur () == '5' ? ' CHECKED' : '') . '> ' . $field->getChoix5 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix6 () ) > 0 ? '<div class="radio"><label style="font-weight:normal;"><input type="radio" name="field' . $field->getId () . '" value="6"' . ($response->getValeur () == '6' ? ' CHECKED' : '') . '> ' . $field->getChoix6 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix7 () ) > 0 ? '<div class="radio"><label style="font-weight:normal;"><input type="radio" name="field' . $field->getId () . '" value="7"' . ($response->getValeur () == '7' ? ' CHECKED' : '') . '> ' . $field->getChoix7 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix8 () ) > 0 ? '<div class="radio"><label style="font-weight:normal;"><input type="radio" name="field' . $field->getId () . '" value="8"' . ($response->getValeur () == '8' ? ' CHECKED' : '') . '> ' . $field->getChoix8 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix9 () ) > 0 ? '<div class="radio"><label style="font-weight:normal;"><input type="radio" name="field' . $field->getId () . '" value="9"' . ($response->getValeur () == '9' ? ' CHECKED' : '') . '> ' . $field->getChoix9 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix10 () ) > 0 ? '<div class="radio"><label style="font-weight:normal;"><input type="radio" name="field' . $field->getId () . '" value="10"' . ($response->getValeur () == '10' ? ' CHECKED' : '') . '> ' . $field->getChoix10 () . '</label></div>' : '');
		$aff .= '</div>';
		$aff .= '</div><!-- End Div Field -->' . PHP_EOL;
		return $aff;
	}
	private function fieldListeDeroulante($field) {
		$response = new EnqueteFormulaireFieldResponse ();

		if ($_SESSION ['Enquete'] ['USER'] ['CONNECTED']) {
			$daoResponse = new EnqueteFormulaireFieldResponseDAO ();
			$responseList = $daoResponse->findAll ( $field->getId (), $_SESSION ['Enquete'] ['USER'] ['ID'] );
			if (count ( $responseList ) > 0) {
				$response = $responseList [0];
			}
		}

		$aff = '<div class="Field" id="field' . $field->getId () . '">';
		$aff .= '<div class="Question">' . stripslashes ( $field->getQuestion () ) . '</div>';
		$aff .= '<div class="Answers"><select name="field' . $field->getId () . '"><option></option>';
		$aff .= (strlen ( $field->getChoix1 () ) > 0 ? '<option value="1"' . ($response->getValeur () == '1' ? ' SELECTED' : '') . '> ' . $field->getChoix1 () . '</option>' : '');
		$aff .= (strlen ( $field->getChoix2 () ) > 0 ? '<option value="2"' . ($response->getValeur () == '2' ? ' SELECTED' : '') . '> ' . $field->getChoix2 () . '</option>' : '');
		$aff .= (strlen ( $field->getChoix3 () ) > 0 ? '<option value="3"' . ($response->getValeur () == '3' ? ' SELECTED' : '') . '> ' . $field->getChoix3 () . '</option>' : '');
		$aff .= (strlen ( $field->getChoix4 () ) > 0 ? '<option value="4"' . ($response->getValeur () == '4' ? ' SELECTED' : '') . '> ' . $field->getChoix4 () . '</option>' : '');
		$aff .= (strlen ( $field->getChoix5 () ) > 0 ? '<option value="5"' . ($response->getValeur () == '5' ? ' SELECTED' : '') . '> ' . $field->getChoix5 () . '</option>' : '');
		$aff .= (strlen ( $field->getChoix6 () ) > 0 ? '<option value="6"' . ($response->getValeur () == '6' ? ' SELECTED' : '') . '> ' . $field->getChoix6 () . '</option>' : '');
		$aff .= (strlen ( $field->getChoix7 () ) > 0 ? '<option value="7"' . ($response->getValeur () == '7' ? ' SELECTED' : '') . '> ' . $field->getChoix7 () . '</option>' : '');
		$aff .= (strlen ( $field->getChoix8 () ) > 0 ? '<option value="8"' . ($response->getValeur () == '8' ? ' SELECTED' : '') . '> ' . $field->getChoix8 () . '</option>' : '');
		$aff .= (strlen ( $field->getChoix9 () ) > 0 ? '<option value="9"' . ($response->getValeur () == '9' ? ' SELECTED' : '') . '> ' . $field->getChoix9 () . '</option>' : '');
		$aff .= (strlen ( $field->getChoix10 () ) > 0 ? '<option value="10"' . ($response->getValeur () == '10' ? ' SELECTED' : '') . '> ' . $field->getChoix10 () . '</option>' : '');
		$aff .= '</select></div>';
		$aff .= '</div><!-- End Div Field -->' . PHP_EOL;
		return $aff;
	}
	private function fieldCaseACocher($field) {
		$response = array ();

		if ($_SESSION ['Enquete'] ['USER'] ['CONNECTED']) {
			$daoResponse = new EnqueteFormulaireFieldResponseDAO ();
			$responseList = $daoResponse->findAll ( $field->getId (), $_SESSION ['Enquete'] ['USER'] ['ID'] );
			if (count ( $responseList ) > 0) {
				foreach ( $responseList as $resp ) {
					$response [] = $resp->getValeur ();
				}
			}
		}

		$aff = '<div class="Field" id="field' . $field->getId () . '">';
		$aff .= '<div class="Question">' . stripslashes ( $field->getQuestion () ) . '</div>';
		$aff .= '<div class="AnswersCheck">';
		$aff .= (strlen ( $field->getChoix1 () ) > 0 ? '<div class="checkbox"><label><input type="checkbox" name="field' . $field->getId () . '-1" value="1"' . (in_array ( '1', $response ) ? ' CHECKED' : '') . '> ' . $field->getChoix1 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix2 () ) > 0 ? '<div class="checkbox"><label><input type="checkbox" name="field' . $field->getId () . '-2" value="2"' . (in_array ( '2', $response ) ? ' CHECKED' : '') . '> ' . $field->getChoix2 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix3 () ) > 0 ? '<div class="checkbox"><label><input type="checkbox" name="field' . $field->getId () . '-3" value="3"' . (in_array ( '3', $response ) ? ' CHECKED' : '') . '> ' . $field->getChoix3 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix4 () ) > 0 ? '<div class="checkbox"><label><input type="checkbox" name="field' . $field->getId () . '-4" value="4"' . (in_array ( '4', $response ) ? ' CHECKED' : '') . '> ' . $field->getChoix4 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix5 () ) > 0 ? '<div class="checkbox"><label><input type="checkbox" name="field' . $field->getId () . '-5" value="5"' . (in_array ( '5', $response ) ? ' CHECKED' : '') . '> ' . $field->getChoix5 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix6 () ) > 0 ? '<div class="checkbox"><label><input type="checkbox" name="field' . $field->getId () . '-6" value="6"' . (in_array ( '6', $response ) ? ' CHECKED' : '') . '> ' . $field->getChoix6 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix7 () ) > 0 ? '<div class="checkbox"><label><input type="checkbox" name="field' . $field->getId () . '-7" value="7"' . (in_array ( '7', $response ) ? ' CHECKED' : '') . '> ' . $field->getChoix7 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix8 () ) > 0 ? '<div class="checkbox"><label><input type="checkbox" name="field' . $field->getId () . '-8" value="8"' . (in_array ( '8', $response ) ? ' CHECKED' : '') . '> ' . $field->getChoix8 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix9 () ) > 0 ? '<div class="checkbox"><label><input type="checkbox" name="field' . $field->getId () . '-9" value="9"' . (in_array ( '9', $response ) ? ' CHECKED' : '') . '> ' . $field->getChoix9 () . '</label></div>' : '');
		$aff .= (strlen ( $field->getChoix10 () ) > 0 ? '<div class="checkbox"><label><input type="checkbox" name="field' . $field->getId () . '-10" value="10"' . (in_array ( '10', $response ) ? ' CHECKED' : '') . '> ' . $field->getChoix10 () . '</label></div>' : '');
		$aff .= '</div>';
		$aff .= '</div><!-- End Div Field -->' . PHP_EOL;
		return $aff;
	}
	private function fieldTextLarge($field) {
		$response = new EnqueteFormulaireFieldResponse ();

		if ($_SESSION ['Enquete'] ['USER'] ['CONNECTED']) {
			$daoResponse = new EnqueteFormulaireFieldResponseDAO ();
			$responseList = $daoResponse->findAll ( $field->getId (), $_SESSION ['Enquete'] ['USER'] ['ID'] );
			if (count ( $responseList ) > 0) {
				$response = $responseList [0];
			}
		}

		$aff = '<div class="Field" id="field' . $field->getId () . '">';
		$aff .= '<div class="Question">' . stripslashes ( $field->getQuestion () ) . '</div>';
		$aff .= '<div class="Answers"><textarea name="field' . $field->getId () . '">' . stripslashes ( $response->getValeur () ) . '</textarea></div>';
		$aff .= '</div><!-- End Div Field -->' . PHP_EOL;
		return $aff;
	}
	private function fieldTextSimple($field) {
		$response = new EnqueteFormulaireFieldResponse ();

		if ($_SESSION ['Enquete'] ['USER'] ['CONNECTED']) {
			$daoResponse = new EnqueteFormulaireFieldResponseDAO ();
			$responseList = $daoResponse->findAll ( $field->getId (), $_SESSION ['Enquete'] ['USER'] ['ID'] );
			if (count ( $responseList ) > 0) {
				$response = $responseList [0];
			}
		}

		$aff = '<div class="Field" id="field' . $field->getId () . '">';
		$aff .= '<div class="Question" style="margin-bottom: 0px;margin-top:10px;">' . stripslashes ( $field->getQuestion () ) . '</div>';
		$aff .= '<div class="Answers"><input type="text" style="width:250px;" name="field' . $field->getId () . '" value="' . stripslashes ( $response->getValeur () ) . '"></div>';
		$aff .= '</div><!-- End Div Field -->' . PHP_EOL;
		return $aff;
	}
	private function fieldTextSimpleObligatoire($field) {
		$response = new EnqueteFormulaireFieldResponse ();

		if ($_SESSION ['Enquete'] ['USER'] ['CONNECTED']) {
			$daoResponse = new EnqueteFormulaireFieldResponseDAO ();
			$responseList = $daoResponse->findAll ( $field->getId (), $_SESSION ['Enquete'] ['USER'] ['ID'] );
			if (count ( $responseList ) > 0) {
				$response = $responseList [0];
			}
		}

		$aff = '<div class="Field" id="field' . $field->getId () . '">';
		$aff .= '<div class="Question" style="margin-bottom: 0px;margin-top:10px;">' . stripslashes ( $field->getQuestion () ) . ' *</div>';
		$aff .= '<div class="Answers"><input type="text" style="width:250px;" required name="field' . $field->getId () . '" value="' . stripslashes ( $response->getValeur () ) . '"></div>';
		$aff .= '</div><!-- End Div Field -->' . PHP_EOL;
		return $aff;
	}
	private function compoBandeau($composant) {
		return '<div class="CompoBandeau" id="' . $composant->getNom () . '"><img class="ImageBandeau" src="' . stripslashes ( $composant->getValeur () ) . '"></div><!-- End Div CompoBandeau -->' . PHP_EOL;
		;
	}
	private function compoButtonSubmit($composant) {
		return '<div  style="text-align:center;" class="CompoButtonSubmit" id="' . $composant->getNom () . '"><input class="button-Validate-Ins" type="submit" value="' . $composant->getNom () . '"></div><!-- End Div CompoButtonSubmit -->' . PHP_EOL;
	}
	private function compoZoneText($composant) {
		return '<div class="CompoZoneText" style="margin-left:-20px; margin-right:-20px;" id="' . $composant->getNom () . '">' . stripslashes ( $composant->getValeur () ) . '</div><!-- End Div CompoZoneText -->' . PHP_EOL;
	}
}