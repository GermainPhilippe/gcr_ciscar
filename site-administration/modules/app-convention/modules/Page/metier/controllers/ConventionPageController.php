<?php
class ConventionPageController {
	public function run() {
		$action = (isset ( $_GET ['action'] ) ? $_GET ['action'] : '');

		switch ($action) {
			case 'new' :
				$this->newAction ();
				break;
			case 'edit' :
				$this->editAction ();
				break;
			case 'delete' :
				$this->deleteAction ();
				break;
			case 'preview' :
				$this->previewAction ();
				break;
			default :
				$this->defaultAction ();
				break;
		}
	}

	// Methods //
	private function newAction() {
		if (isset ( $_POST ['title'] )) {
			// Creation
			$instance = new ConventionPage ();
			$instance->setTitle ( $_POST ['title'] );
			$instance->setHtmlContent ( $_POST ['RichTextValue'] );

			$dao = new ConventionPageDAO ();
			$dao->create ( $instance );

			// Redirection to the list
			$this->redirection ( '?' );
		} else {
			$instance = new ConventionPage ();

			$view = new ConventionPageView ( $instance );
			$view->renderHTML ();
		}
	}
	private function editAction() {
		if (isset ( $_POST ['title'] )) {
			// Update
			$instance = new ConventionPage ();
			$instance->setId ( $_GET ['id'] );
			$instance->setTitle ( $_POST ['title'] );
			$instance->setHtmlContent ( $_POST ['RichTextValue'] );

			$dao = new ConventionPageDAO ();
			$dao->update ( $instance );

			// Redirection to the list
			$this->redirection ( '?' );
		} else {
			$dao = new ConventionPageDAO ();
			$instance = $dao->find ( $_GET ['id'] );

			$view = new ConventionPageView ( $instance );
			$view->renderHTML ();
		}
	}
	private function deleteAction() {
		// Delete the Page
		if (isset ( $_GET ['id'] )) {
			$dao = new ConventionPageDAO ();
			$dao->delete ( $_GET ['id'] );
		}

		// Redirection to the list
		$this->redirection ( '?' );
	}
	private function previewAction() {
		if (isset ( $_GET ['id'] )) {
			$dao = new ConventionPageDAO ();
			$instance = $dao->find ( $_GET ['id'] );

			$view = new ConventionPagePreviewView ( $instance );
			$view->renderHTML ();
		}
	}
	private function defaultAction() {
		$dao = new ConventionPageDAO ();
		$list = $dao->findAll ();

		$view = new ConventionPageListView ( $list );
		$view->renderHTML ();
	}

	// Tools //
	public function redirection($url) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href="' . $url . '";';
		$aff .= '</script>';
		echo $aff;
	}
}