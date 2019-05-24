<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocPartenairePageControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'view' :
				if (isset ( $_GET ['id'] )) {
					$aList = new DocPartenairePageList ();
					$aList->SQL_select_all ( trim ( $_GET ['id'] ) );

					$aView = new DocPartenairePageListView ( $aList->getList () );
					$aView->render ();
				}
				break;
			case 'new' :
				if (isset ( $_POST ['Titre'] )) {
					$aDoc = new DocPartenairePage ();
					$aDoc->setDocPartenaireID ( trim ( $_GET ['id'] ) );
					$aDoc->setTitre ( trim ( $_POST ['Titre'] ) );
					$aDoc->setPictoTitre ( $_POST ['PictoTitre'] );
					$aDoc->setContenuRichText ( trim ( $_POST ['FCKeditor1'] ) );
					$aDoc->setSiteID ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aDoc->SQL_create ();

					echo CommunFunction::goToURL ( '?action=view&id=' . trim ( $_GET ['id'] ) );
				} else {
					if (isset ( $_GET ['id'] )) {
						$aDoc = new DocPartenairePage ();
						$aDoc->setDocPartenaireID ( trim ( $_GET ['id'] ) );
						$aView = new DocPartenairePageView ( $aDoc );
						$aView->render ( 'new' );
					}
				}
				break;
			case 'edit' :
				if (isset ( $_POST ['Titre'] )) {
					$aDoc = new DocPartenairePage ();
					$aDoc->setID ( trim ( $_GET ['id'] ) );
					$aDoc->setTitre ( trim ( $_POST ['Titre'] ) );
					$aDoc->setPictoTitre ( $_POST ['PictoTitre'] );
					$aDoc->setContenuRichText ( trim ( $_POST ['FCKeditor1'] ) );
					$aDoc->SQL_update ();

					echo CommunFunction::goToURL ( '?action=view&id=' . trim ( $_GET ['id2'] ) );
				} else {
					if (isset ( $_GET ['id'] )) {

						$aDoc = new DocPartenairePage ();
						$aDoc->SQL_select ( trim ( $_GET ['id'] ) );
						$aView = new DocPartenairePageView ( $aDoc );
						$aView->render ( 'edit' );
					}
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aDoc = new DocPartenairePage ();
					$aDoc->setID ( trim ( $_GET ['id'] ) );
					$aDoc->SQL_delete ();

					echo CommunFunction::goToURL ( '?action=view&id=' . trim ( $_GET ['id2'] ) );
				}
				break;
		}
	}
}
?>