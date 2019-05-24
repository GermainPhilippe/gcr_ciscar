<?php
class BiblioMediaController {
	public static function run() {
		$action = isset ( $_GET ['action'] ) ? $_GET ['action'] : '';

		switch ($action) {
			case 'new' :
				self::createAction ();
				break;
			case 'update' :
				self::updateAction ();
				break;
			case 'delete' :
				self::deleteAction ();
				break;
			case 'download' :
				self::downloadAction ();
				break;
			case 'findAllByTitre' :
				self::findAllByTitreAction ();
				break;
			case 'fckeditor' :
				self::fckeditorAction ();
				break;
			case 'fckeditornew' :
				self::createFckeditorAction ();
				break;
			default :
				self::findAllAction ();
				break;
		}
	}

	// Methods //
	private static function fckeditorAction() {
		$dao = new BiblioMediaDAO ();

		$searchFile = '';
		if (isset ( $_POST ['searchFile'] )) {
			$list = $dao->findAllByWord ( $_POST ['searchFile'] );
			$searchFile = $_POST ['searchFile'];
		} else {
			$list = $dao->findAll ();
		}

		$view = new BiblioListFckeditorView ( $list, $searchFile );
		$view->renderHTML ();
	}
	private static function createFckeditorAction() {
		if (isset ( $_POST ['titre'] )) {
			$instance = new BiblioMedia ();
			$instance->setTitre ( $_POST ['titre'] );
			$instance->setDescription ( $_POST ['description'] );

			$instance->setFileName ( $_FILES ['fichier'] ['name'] );
			$instance->setFileMime ( $_FILES ['fichier'] ['type'] );
			$instance->setFileSize ( $_FILES ['fichier'] ['size'] );
			$instance->setFileBlob ( file_get_contents ( $_FILES ['fichier'] ['tmp_name'] ) );

			$dao = new BiblioMediaDAO ();
			$dao->create ( $instance );

			// Redirection
			echo CommunFunction::goToURL ( '?action=fckeditor' );
		} else {
			$instance = new BiblioMedia ();
			$view = new BiblioView ( $instance );
			$view->renderHTML ();
		}
	}
	private static function createAction() {

		if (isset ( $_POST ['titre'] )) {
			$instance = new BiblioMedia ();
			$instance->setTitre ( $_POST ['titre'] );
			$instance->setDescription ( $_POST ['description'] );

			$instance->setFileName ( $_FILES ['fichier'] ['name'] );
			$instance->setFileMime ( $_FILES ['fichier'] ['type'] );
			$instance->setFileSize ( $_FILES ['fichier'] ['size'] );

			$instance->setFileBlob ( file_get_contents ( $_FILES ['fichier'] ['tmp_name'] ) );

			$dao = new BiblioMediaDAO ();
			$dao->create ( $instance );

			// Redirection
			echo CommunFunction::goToURL ( '?' );
		} else {
			$instance = new BiblioMedia ();
			$view = new BiblioView ( $instance );
			$view->renderHTML ();
		}
	}
	private static function updateAction() {
		$dao = new BiblioMediaDAO ();
		if (isset ( $_POST ['titre'] )) {
			$instance = new BiblioMedia ();
			$instance->setId ( $_GET ['id'] );
			$instance->setTitre ( $_POST ['titre'] );
			$instance->setDescription ( $_POST ['description'] );

			if (! in_array ( $_FILES ['fichier'] ['error'], array (
					1,
					2,
					3
			) ) && $_FILES ['fichier'] ['size'] > 0) {
				// if(isset($_FILES['fichier']['name'])) {
				$instance->setFileName ( $_FILES ['fichier'] ['name'] );
				$instance->setFileMime ( $_FILES ['fichier'] ['type'] );
				$instance->setFileSize ( $_FILES ['fichier'] ['size'] );
				$instance->setFileBlob ( file_get_contents ( $_FILES ['fichier'] ['tmp_name'] ) );

				$dao->update ( $instance );
			} else {
				$dao->updateWithoutFileBlob ( $instance );
			}

			// Redirection
			echo CommunFunction::goToURL ( '?' );
		} else {
			$view = new BiblioView ( $dao->find ( $_GET ['id'] ) );
			$view->renderHTML ();
		}
	}
	private static function deleteAction() {
		if (isset ( $_GET ['id'] )) {
			$dao = new BiblioMediaDAO ();
			$dao->delete ( $_GET ['id'] );
		}
		// Redirection
		echo CommunFunction::goToURL ( '?' );
	}
	private static function downloadAction() {
		if (isset ( $_GET ['id'] )) {
			$dao = new BiblioMediaDAO ();
			$instance = $dao->find ( $_GET ['id'] );

			header ( 'HTTP/1.1 200 OK' );
			header ( 'Content-type: ' . $instance->getFileMime () );
			header ( 'Content-Length: ' . $instance->getFileSize () );
			header ( 'Content-Disposition: attachment; filename="' . $instance->getFileName () . '"' );
			echo $instance->getFileBlob ();
		}
	}
	private static function findAllAction() {
		$dao = new BiblioMediaDAO ();

		$searchFile = '';
		if (isset ( $_POST ['searchFile'] )) {
			$list = $dao->findAllByWord ( $_POST ['searchFile'] );
			$searchFile = $_POST ['searchFile'];
		} else {
			$list = $dao->findAll ();
		}

		$view = new BiblioListView ( $list, $searchFile );
		$view->renderHTML ();
	}
}