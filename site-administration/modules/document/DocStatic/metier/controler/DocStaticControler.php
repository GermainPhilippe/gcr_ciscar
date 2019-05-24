<?php
class DocStaticControler {
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
				if (isset ( $_POST ['Titre'] )) {
					$aDoc = new DocStatic ();
					$aDoc->setTitre ( trim ( $_POST ['Titre'] ) );
					$aDoc->setContenuRichText ( trim ( $_POST ['FCKeditor1'] ) );
					$aDoc->setSiteID ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aDoc->SQL_create ();

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aView = new DocStaticView ( new DocStatic () );
					$aView->render ( 'new' );
				}
				break;
			case 'edit' :
				if (isset ( $_POST ['Titre'] )) {
					$aDoc = new DocStatic ();
					$aDoc->setID ( trim ( $_GET ['id'] ) );
					$aDoc->setTitre ( trim ( $_POST ['Titre'] ) );
					$aDoc->setContenuRichText ( trim ( $_POST ['FCKeditor1'] ) );
					$aDoc->SQL_update ();

					echo CommunFunction::goToURL ( '?' );
				} else {
					if (isset ( $_GET ['id'] )) {
						$aDoc = new DocStatic ();
						$aDoc->SQL_select ( trim ( $_GET ['id'] ) );
						$aView = new DocStaticView ( $aDoc );
						$aView->render ( 'edit' );
					}
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aDoc = new DocStatic ();
					$aDoc->setID ( $_GET ['id'] );
					$aDoc->SQL_delete ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'pg' :
				$aList = new DocStaticList ();
				$aList->SQL_select_all ();

				$aView = new PGDocStaticListView ( $aList->getList () );
				$aView->render ();
				break;
		}
	}
}
?>