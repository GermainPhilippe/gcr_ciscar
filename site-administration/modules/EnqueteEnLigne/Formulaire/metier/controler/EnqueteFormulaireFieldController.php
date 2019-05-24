<?php
class EnqueteFormulaireFieldController {
	public function run() {
		$action = isset ( $_GET ['action'] ) ? $_GET ['action'] : '';

		switch ($action) {
			case 'edit' :
				$this->editAction ();
				break;
			case 'switchUp' :
				$this->switchUpAction ();
				break;
			case 'delete' :
				$this->deleteAction ();
				break;
			default :
				$this->defaultAction ();
				break;
		}
	}

	// Methods //
	private function switchUpAction() {
		if (isset ( $_GET ['id'] ) && isset ( $_GET ['compoid'] ) && isset ( $_GET ['compoid2'] )) {
			$dao = new EnqueteFormulaireCompositionDAO ();
			$compo1 = $dao->find ( $_GET ['compoid'] );
			$compo2 = $dao->find ( $_GET ['compoid2'] );

			$up = $compo1->getNumOrdre ();
			$compo1->setNumOrdre ( $compo2->getNumOrdre () );
			$compo2->setNumOrdre ( $up );

			$dao->update ( $compo1 );
			$dao->update ( $compo2 );
		}
		$this->redirection ( 'index.php?action=edit&id=' . $_GET ['id'] );
	}
	private function editAction() {
		if (isset ( $_POST ['question'] )) {
			$field = new EnqueteFormulaireField ();
			$fieldDAO = new EnqueteFormulaireFieldDAO ();

			$field->setId ( $_GET ['compoid'] );
			$field->setQuestion ( $_POST ['question'] );
			$field->setType ( $_GET ['type'] );
			switch ($_GET ['type']) {
				case '1' :
				case '2' :
				case '101' :
					break;
				case '3' :
				case '4' :
				case '5' :
					$field->setChoix1 ( $_POST ['choix1'] );
					$field->setChoix2 ( $_POST ['choix2'] );
					$field->setChoix3 ( $_POST ['choix3'] );
					$field->setChoix4 ( $_POST ['choix4'] );
					$field->setChoix5 ( $_POST ['choix5'] );
					$field->setChoix6 ( $_POST ['choix6'] );
					$field->setChoix7 ( $_POST ['choix7'] );
					$field->setChoix8 ( $_POST ['choix8'] );
					$field->setChoix9 ( $_POST ['choix9'] );
					$field->setChoix10 ( $_POST ['choix10'] );
					break;
			}
			$fieldDAO->update ( $field );

			// Formulaire de connexion
			$aff = '<script type="text/javascript">';
			$aff .= 'window.opener.location.reload();';
			$aff .= 'window.close();';
			$aff .= '</script>';
			echo $aff;
		} else {
			$dao = new EnqueteFormulaireFieldDAO ();
			$view = new EnqueteFormulaireFieldView ( $dao->find ( $_GET ['compoid'] ) );
			$view->renderHTML ();
		}
	}
	private function deleteAction() {
		if (isset ( $_GET ['id'] ) && isset ( $_GET ['compoid'] )) {
			$dao = new EnqueteFormulaireCompositionDAO ();
			$dao->delete ( $_GET ['compoid'] );
		}
		$this->redirection ( 'index.php?action=edit&id=' . $_GET ['id'] );
	}
	private function defaultAction() {
		if (isset ( $_POST ['question'] )) {
			$composition = new EnqueteFormulaireComposition ();
			$compositionDAO = new EnqueteFormulaireCompositionDAO ();

			$field = new EnqueteFormulaireField ();
			$fieldDAO = new EnqueteFormulaireFieldDAO ();

			$composition->setNumOrdre ( 100 );
			$composition->setFormulaireId ( $_GET ['id'] );
			$composition->setType ( EnqueteFormulaireComposition::TYPE_FIELD );
			$compositionDAO->create ( $composition );

			$field->setId ( mysqli_insert_id ($_SESSION['LINK']) );
			$field->setQuestion ( $_POST ['question'] );
			$field->setType ( $_GET ['type'] );
			switch ($_GET ['type']) {
				case '1' :
				case '2' :
				case '101' :
					break;
				case '3' :
				case '4' :
				case '5' :
					$field->setChoix1 ( $_POST ['choix1'] );
					$field->setChoix2 ( $_POST ['choix2'] );
					$field->setChoix3 ( $_POST ['choix3'] );
					$field->setChoix4 ( $_POST ['choix4'] );
					$field->setChoix5 ( $_POST ['choix5'] );
					$field->setChoix6 ( $_POST ['choix6'] );
					$field->setChoix7 ( $_POST ['choix7'] );
					$field->setChoix8 ( $_POST ['choix8'] );
					$field->setChoix9 ( $_POST ['choix9'] );
					$field->setChoix10 ( $_POST ['choix10'] );
					break;
			}
			$fieldDAO->create ( $field );

			$composition->setId ( $field->getId () );
			$composition->setNumOrdre ( 100 + ( int ) $field->getId () );
			$compositionDAO->update ( $composition );

			// Formulaire de connexion
			$aff = '<script type="text/javascript">';
			$aff .= 'window.opener.location.reload();';
			$aff .= 'window.close();';
			$aff .= '</script>';
			echo $aff;
		} else {
			$instance = new EnqueteFormulaireField ();
			$view = new EnqueteFormulaireFieldView ( $instance );
			$view->renderHTML ();
		}
	}

	// Tools //
	private function redirection($URL) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href=\'' . $URL . '\';';
		$aff .= '</script>';
		echo $aff;
	}
}