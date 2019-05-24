<?php
class EnqueteResponseView {
	private $myQuestionList;
	private $myResponseList;
	public function __construct($aQuestionList, $aResponseList) {
		$this->myQuestionList = $aQuestionList;
		$this->myResponseList = $aResponseList;
	}
	private function getFieldValeur($field, $valeur) {

		switch ($valeur) {
			case '1' :
				return stripslashes ( $field->getChoix1 () );
				break;
			case '2' :
				return stripslashes ( $field->getChoix2 () );
				break;
			case '3' :
				return stripslashes ( $field->getChoix3 () );
				break;
			case '4' :
				return stripslashes ( $field->getChoix4 () );
				break;
			case '5' :
				return stripslashes ( $field->getChoix5 () );
				break;
			case '6' :
				return stripslashes ( $field->getChoix6 () );
				break;
			case '7' :
				return stripslashes ( $field->getChoix7 () );
				break;
			case '8' :
				return stripslashes ( $field->getChoix8 () );
				break;
			case '9' :
				return stripslashes ( $field->getChoix9 () );
				break;
			case '10' :
				return stripslashes ( $field->getChoix10 () );
				break;
		}
	}
	public function renderCSV() {
		header ( "Content-Type: application/csv-tab-delimited-table" );
		header ( "Content-disposition: filename=ExportReponseFormulaire.csv" );

		$startCase = false;

		// HEADERs
		echo '"Date"' . ";";
		echo '"UId"' . ";";
		echo '"UserId"' . ";";
		echo '"UserLogin"' . ";";
		echo '"UserFirstname"' . ";";
		echo '"UserLastname"' . ";";
		echo '"UserEmail"' . ";";
		$i = 0;
		foreach ( $this->myQuestionList as $aQuestion ) {
			echo '"' . $aQuestion->getQuestion () . '"' . ";";
			$i ++;
		}
		echo "\n";
		// echo "-----------------------------<br /><br />";
		// DATAS
		$q = 0;
		$userid_prec = "";
		foreach ( $this->myResponseList as $aReponse ) {

			if ($aReponse->getUserId () != $userid_prec && $userid_prec != "")
			{
				//Si rupture on Ècrit la ligne prÈcÈdente
				$aff .= "\n";
				echo $aff;
				$q = 0;
				$startCase = false;
			}
			if ($q == 0) {
				$userid_prec = $aReponse->getUserId ();
				$tab = explode ( "-", $aReponse->getUserId () );
				$aff = '"' . $tab [0] . '"' . ";";
				$aff .= '"' . $tab [2] . '"' . ";";
				$aff .= '"' . $aReponse->getAnnuaireUserId () . '"' . ";";
				$aff .= '"' .$aReponse->getUserLogin () . '"' . ";";
				$aff .= '"' .$aReponse->getUserFirstname () . '"' . ";";
				$aff .= '"' .$aReponse->getUserLastname () . '"' . ";";
				$aff .= '"' .$aReponse->getUserEmail () . '"' . ";";
			}
			// var_dump($this->myQuestionList[$aReponse->getFieldId()]->getType());

			switch ($this->myQuestionList [$aReponse->getFieldId ()]->getType ()) {
				case '1' : // Text Simple
				case '2' : // Text Large
				case '101' :
					$aff .= '"' . stripslashes ( $aReponse->getValeur () ) . '"' . ";";
					break;
				case '3' : // Liste deroulante
				case '5' : // Bouton radio
					$aff .= '"' . $this->getFieldValeur ( $this->myQuestionList [$aReponse->getFieldId ()], $aReponse->getValeur () ) . '"' . ";";
					break;
				case '4' : // Case a cocher
					$valeur = array ();
					if (! $startCase) {
						$startCase = true;
						$aff .= '"' . $this->getFieldValeur ( $this->myQuestionList [$aReponse->getFieldId ()], $aReponse->getValeur () ) . '"' . ";";
						// echo $aff ."-----normal<br />";
					} else {
						// echo $aff ."-----Avant moins<br />";
						//$q --;
						$aff = substr ( $aff, 0, - 2 );
						// echo $aff ."-----Apr√©s moins<br />";
						$aff .= "," . $this->getFieldValeur ( $this->myQuestionList [$aReponse->getFieldId ()], $aReponse->getValeur () ) . '"' . ";";
					}

					break;
			}

			$q ++;
			// echo "<br />".$q."--".$i."-----".$this->myQuestionList[$aReponse->getFieldId()]->getQuestion();
			//echo "<br />".$aff;
			//die();
		}
		$aff .= "\n";
		echo $aff;
		
	}
}
?>