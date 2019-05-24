<?php
class SurveyResponseView {
	private $myQuestionList;
	private $myResponseList;
	public function __construct($aQuestionList, $aResponseList) {
		$this->myQuestionList = $aQuestionList;
		$this->myResponseList = $aResponseList;
	}
	public function renderCSV() {
		header ( "Content-Type: application/csv-tab-delimited-table" );
		header ( "Content-disposition: filename=ExportReponseFormulaire.csv" );

		// HEADERs
		echo '"Nom"' . ";";
		echo '"Prénom"' . ";";
		$i = 0;
		foreach ( $this->myQuestionList as $aQuestion ) {
			echo '"' . $aQuestion->getDescription () . '"' . ";";
			$i ++;
		}
		echo "\n";

		// DATAS
		$q = 0;
		foreach ( $this->myResponseList as $aReponse ) {
			if ($q == 0) {
				echo '"' . $aReponse [0] . '"' . ";";
				echo '"' . $aReponse [1] . '"' . ";";
			}

			echo '"' . $aReponse [2] . '"' . ";";
			$q ++;
			if ($q == $i) {
				$q = 0;
				echo "\n";
			}
		}
	}
}
?>