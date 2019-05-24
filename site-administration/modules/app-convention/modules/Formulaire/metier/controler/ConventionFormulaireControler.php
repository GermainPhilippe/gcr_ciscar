<?php
class ConventionFormulaireControler {
	public function run() {
		$action = isset ( $_GET ['action'] ) ? $_GET ['action'] : '';

		switch ($action) {
			case 'new' :
				$this->newAction ();
				break;
			case 'edit' :
				$this->editAction ();
				break;
			case 'cloner' :
				$this->clonerAction ();
				break;
			case 'delete' :
				$this->deleteAction ();
				break;
			default :
				$dao = new ConventionFormulaireDAO ();
				$view = new ConventionFormulaireListView ( $dao->findAll () );
				$view->renderHTML ();
				break;
		}
	}
	private function newAction() {
		if (isset ( $_POST ['Nom'] )) {
			$aModele = new ConventionFormulaire ();
			$aModele->setNom ( $_POST ['Nom'] );

			$dao = new ConventionFormulaireDAO ();
			$id = $dao->create ( $aModele );

			// redirection
			$this->redirection ( '?action=edit&id=' . $id );
		} else {
			$instance = new ConventionFormulaire ();
			$view = new ConventionFormulaireView ( $instance );
			$view->renderHTML ();
		}
	}
	private function editAction() {
		if (isset ( $_POST ['Nom'] )) {
			$aModele = new ConventionFormulaire ();
			$aModele->setID ( $_GET ['id'] );
			$aModele->setNom ( $_POST ['Nom'] );
			$dao = new ConventionFormulaireDAO ();
			$dao->update ( $aModele );

			// redirection
			$this->redirection ( '?' );
		} else {
			$dao = new ConventionFormulaireDAO ();
			$instance = $dao->find ( $_GET ['id'] );

			$view = new ConventionFormulaireView ( $instance );
			$view->renderHTML ();
		}
	}
	private function deleteAction() {
		if (isset ( $_GET ['id'] )) {
			$dao = new ConventionFormulaireDAO ();
			$dao->delete ( $_GET ['id'] );

			// redirection
			$this->redirection ( '?' );
		}
	}
	private function clonerAction() {
		$daoFormulaire = new ConventionFormulaireDAO ();
		$daoComposition = new ConventionFormulaireCompositionDAO ();
		$daoComposant = new ConventionFormulaireComposantDAO ();
		$daoField = new ConventionFormulaireFieldDAO ();

		$formulaire = $daoFormulaire->find ( $_GET ['id'] );
		$formulaire->setNom ( 'Copie - ' . $formulaire->getNom () );
		$daoFormulaire->create ( $formulaire );
		$formulaire->setID ( mysqli_insert_id ($_SESSION['LINK']) );

		$listComposites = $daoComposition->findAll ( $_GET ['id'] );
		if (count ( $listComposites ) > 0) {
			foreach ( $listComposites as $composite ) {
				$oldIDComposition = $composite->getId ();

				$composite->setFormulaireId ( $formulaire->getID () );
				$daoComposition->create ( $composite );
				$composite->setId ( mysqli_insert_id ($_SESSION['LINK']) );

				if ($composite->getType () == ConventionFormulaireComposition::TYPE_FIELD) {
					$field = $daoField->find ( $oldIDComposition );
					$field->setId ( $composite->getId () );
					$daoField->create ( $field );
				} else {
					$composant = $daoComposant->find ( $oldIDComposition );
					$composant->setId ( $composite->getId () );
					$daoComposant->create ( $composant );
				}
			}
		}

		$this->redirection ( '?' );
	}

	// Tools //
	private function message($msg) {
		$aff = '<script type="text/javascript">';
		$aff .= 'alert(\'' . $msg . '\');';
		$aff .= '</script>';
		echo $aff;
	}
	private function redirection($URL) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href=\'' . $URL . '\';';
		$aff .= '</script>';
		echo $aff;
	}
}
