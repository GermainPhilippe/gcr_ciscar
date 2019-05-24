<?php
class MenuDynamiqueControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
				if (isset ( $_POST ['submitButton'] )) {
					$aMenuDynamique = new MenuDynamique ();
					$aMenuDynamique->setName ( $_POST ['pNom'] );
					$aMenuDynamique->setParentID ( $_POST ['pParentMenu'] == '0' ? NULL : ( int ) $_POST ['pParentMenu'] );
					$aMenuDynamique->setIconeDeplie ( $_POST ['ImagesURL'] );
					$aMenuDynamique->setIconePlie ( $_POST ['ImagesURL2'] );
					$aMenuDynamique->setStatutDepart ( $_POST ['pStatutDepart'] );
					$aMenuDynamique->setTypeVueID ( ( int ) $_POST ['pTypeVue'] );
					switch ($_POST ['pTypeVue']) {
						case '8' :
						case '9' :
						case '10' :
							$aMenuDynamique->setElementID ( $_POST ['pElmentIDDisplay'] );
							break;
						default :
							$aMenuDynamique->setElementID ( $_POST ['pElmentID'] );
							break;
					}
					$aMenuDynamique->setNumOrdre ( ( int ) $_POST ['pNumOrdre'] );
					$aMenuDynamiqueManager = new MenuDynamiqueManager ();
					$aMenuDynamiqueManager->add ( $aMenuDynamique );

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aMenuDynamique = new MenuDynamique ();
					$aMenuDynamiqueView = new MenuDynamiqueView ( $aMenuDynamique );
					$aMenuDynamiqueView->renderHTML ( 'new' );
				}
				break;
			case 'update' :
				if (isset ( $_POST ['submitButton'] )) {
					$aMenuDynamique = new MenuDynamique ();
					$aMenuDynamique->setID ( ( int ) $_GET ['id'] );
					$aMenuDynamique->setName ( $_POST ['pNom'] );
					$aMenuDynamique->setParentID ( $_POST ['pParentMenu'] == '0' ? NULL : ( int ) $_POST ['pParentMenu'] );
					$aMenuDynamique->setIconeDeplie ( $_POST ['ImagesURL'] );
					$aMenuDynamique->setIconePlie ( $_POST ['ImagesURL2'] );
					$aMenuDynamique->setStatutDepart ( $_POST ['pStatutDepart'] );
					$aMenuDynamique->setTypeVueID ( ( int ) $_POST ['pTypeVue'] );
					switch ($_POST ['pTypeVue']) {
						case '8' :
						case '9' :
						case '10' :
							$aMenuDynamique->setElementID ( $_POST ['pElmentIDDisplay'] );
							break;
						default :
							$aMenuDynamique->setElementID ( $_POST ['pElmentID'] );
							break;
					}
					$aMenuDynamique->setNumOrdre ( ( int ) $_POST ['pNumOrdre'] );
					$aMenuDynamiqueManager = new MenuDynamiqueManager ();
					$aMenuDynamiqueManager->update ( $aMenuDynamique );

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aMenuDynamiqueManager = new MenuDynamiqueManager ();
					$aMenuDynamiqueView = new MenuDynamiqueView ( $aMenuDynamiqueManager->get ( $_GET ['id'] ) );
					$aMenuDynamiqueView->renderHTML ( 'update' );
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aMenuDynamiqueManager = new MenuDynamiqueManager ();
					$aMenuDynamiqueManager->delete ( $_GET ['id'] );

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'displayCategory' :
				$aMenuDynamique_Category = new MenuDynamique_Category ();
				$aMenuDynamique_Category->renderHTML ( isset ( $_GET ['lvl'] ) ? $_GET ['lvl'] : '1' );
				break;
			case 'displayDocStatic' :
				$aMenuDynamique_DocStatic = new MenuDynamique_DocStatic ();
				$aMenuDynamique_DocStatic->renderHTML ();
				break;
		}
	}
}
?>