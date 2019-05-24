<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage autologin
 * @version 1.0.4
 */
class AutologinControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'edit' :

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_CARTERIE_PAGE_CONNEXION" );
				$aParam->setValue ( trim ( $_POST ['CARTERIE_PAGE_CONNEXION'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_CARTERIE_MESSAGE_ERREUR" );
				$aParam->setValue ( trim ( $_POST ['CARTERIE_MESSAGE_ERREUR'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_CARTERIE_MESSAGE_ERREUR_LOGIN" );
				$aParam->setValue ( trim ( $_POST ['CARTERIE_MESSAGE_ERREUR_LOGIN'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_CARTERIE_CLEF_AUTOLOGIN" );
				$aParam->setValue ( trim ( $_POST ['CARTERIE_CLEF_AUTOLOGIN'] ) );
				$aParam->update_param ();

				// ###

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_CIS-COM_PAGE_CONNEXION" );
				$aParam->setValue ( trim ( $_POST ['CIS-COM_PAGE_CONNEXION'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_CIS-COM_MESSAGE_ERREUR" );
				$aParam->setValue ( trim ( $_POST ['CIS-COM_MESSAGE_ERREUR'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_CIS-COM_MESSAGE_ERREUR_LOGIN" );
				$aParam->setValue ( trim ( $_POST ['CIS-COM_MESSAGE_ERREUR_LOGIN'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_CIS-COM_CLEF_AUTOLOGIN" );
				$aParam->setValue ( trim ( $_POST ['CIS-COM_CLEF_AUTOLOGIN'] ) );
				$aParam->update_param ();

				// ###

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_E-COMMERCE_PAGE_CONNEXION" );
				$aParam->setValue ( trim ( $_POST ['E-COMMERCE_PAGE_CONNEXION'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_E-COMMERCE_MESSAGE_ERREUR" );
				$aParam->setValue ( trim ( $_POST ['E-COMMERCE_MESSAGE_ERREUR'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_E-COMMERCE_MESSAGE_ERREUR_LOGIN" );
				$aParam->setValue ( trim ( $_POST ['E-COMMERCE_MESSAGE_ERREUR_LOGIN'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_E-COMMERCE_CLEF_AUTOLOGIN" );
				$aParam->setValue ( trim ( $_POST ['E-COMMERCE_CLEF_AUTOLOGIN'] ) );
				$aParam->update_param ();

				echo CommunFunction::goToURL ( '../../?menu=2' );
				break;
		}
	}
}
?>