<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage parametre
 * @version 1.0.4
 */
class ParamControler {
	function run() {
		switch ($_GET ['action']) {
			case 'new' :
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$vue = new ParamView ( new Param () );
					$vue->renderHTML ( 'c' );
				} else {
					$aParam = new Param ();
					$aParam->setName ( trim ( $_POST ['Nom'] ) );
					$aParam->setValue ( trim ( $_POST ['Valeur'] ) );
					$aSite = new Site ();
					$aSite->select_site_by_name ();
					$aParam->setSiteID ( trim ( $_POST ['partager'] ) == '1' ? NULL : $aSite->getID () );
					$aParam->create_param ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'edit' :
			case 'u' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Param ();
					$modele->select_param ( trim ( $_GET ['id'] ) );
					$vue = new ParamView ( $modele );
					$vue->renderHTML ( 'u' );
				} else {
					$aParam = new Param ();
					$aParam->setID ( trim ( $_GET ['id'] ) );
					$aParam->setName ( trim ( $_POST ['Nom'] ) );
					$aParam->setValue ( trim ( $_POST ['Valeur'] ) );

					$aSite = new Site ();
					$aSite->select_site_by_name ();
					$aParam->setSiteID ( trim ( $_POST ['partager'] ) == '1' ? NULL : $aSite->getID () );
					$aParam->update_param ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'delete' :
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aParam = new Param ();
					$aParam->setID ( trim ( $_GET ['id'] ) );
					$aParam->remove_param ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'general' :
				$this->generalAction ();
				break;
			case 'param' :
				$this->paramAction ();
				break;
		}
	}
	private function generalAction() {
		if (isset ( $_POST ['PasswordCounter'] )) {
			$aParam = new Param ();
			$aParam->search_param ( "PASSWD_COUNTER" );
			$aParam->setValue ( trim ( $_POST ['PasswordCounter'] ) );
			$aParam->update_param ();

			$aParam = new Param ();
			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_WCM_DEFAULT_BANNER" );
			$aParam->setValue ( trim ( $_POST ['ImagesURL'] ) );
			$aParam->update_param ();

			$aParam = new Param ();
			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_WCM_DEFAULT_URL_BANNER" );
			$aParam->setValue ( trim ( $_POST ['BannerURL'] ) );
			$aParam->update_param ();

			$aParam = new Param ();
			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_PUB_MENU_IMAGE" );
			$aParam->setValue ( trim ( $_POST ['ImagesURL2'] ) );
			$aParam->update_param ();

			$aParam = new Param ();
			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_PUB_MENU_URL" );
			$aParam->setValue ( trim ( $_POST ['PubURL'] ) );
			$aParam->update_param ();

			if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'GCR') {
				$aParam = new Param ();
				$aParam->search_param ( "POSTIT_URL" );
				$aParam->setValue ( trim ( $_POST ['PostitURL'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( "POSTIT_TARGET" );
				$aParam->setValue ( trim ( $_POST ['PostitTARGET'] ) );
				$aParam->update_param ();
			}

			if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'CISCAR') {
				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_PUB_HOMEPAGE_IMAGE" );
				$aParam->setValue ( trim ( $_POST ['ImagesURL3'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( "CISCAR_WCM_HORS_RENAULT_BANNER" );
				$aParam->setValue ( trim ( $_POST ['ImagesURL4'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( "CISCAR_WCM_HORS_RENAULT_URL_BANNER" );
				$aParam->setValue ( trim ( $_POST ['BannerHorsRenaultURL'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( "CISCAR_WCM_INDRA_BANNER" );
				$aParam->setValue ( trim ( $_POST ['ImagesURL5'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( "CISCAR_WCM_INDRA_URL_BANNER" );
				$aParam->setValue ( trim ( $_POST ['BannerINDRAURL'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_PUB_HOMEPAGE_URL" );
				$aParam->setValue ( trim ( $_POST ['PubHomepageURL'] ) );
				$aParam->update_param ();

				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_ACTIVATION_QUEST" );
				$aParam->setValue ( trim ( $_POST ['questActivation'] ) );
				$aParam->update_param ();
			}

			echo CommunFunction::goToURL ( '../../?menu=1' );
		}
	}
	private function paramAction() {
		if (isset ( $_POST ['MAIL_LOGIN_FROM'] )) {

			// ### Notification Login ###

			$aParam = new Param ();
			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_LOGIN_FROM" );
			$aParam->setValue ( trim ( $_POST ['MAIL_LOGIN_FROM'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_LOGIN_SUBJECT" );
			$aParam->setValue ( trim ( $_POST ['MAIL_LOGIN_SUBJECT'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_LOGIN_BODY_1" );
			$aParam->setValue ( trim ( $_POST ['MAIL_LOGIN_BODY_1'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_LOGIN_BODY_2" );
			$aParam->setValue ( trim ( $_POST ['MAIL_LOGIN_BODY_2'] ) );
			$aParam->update_param ();

			// ### Notification Creation Compte ###

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_ACCOUNT_FROM" );
			$aParam->setValue ( trim ( $_POST ['MAIL_ACCOUNT_FROM'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_ACCOUNT_SUBJECT" );
			$aParam->setValue ( trim ( $_POST ['MAIL_ACCOUNT_SUBJECT'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_ACCOUNT_BODY_1" );
			$aParam->setValue ( trim ( $_POST ['MAIL_ACCOUNT_BODY_1'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_ACCOUNT_BODY_2" );
			$aParam->setValue ( trim ( $_POST ['MAIL_ACCOUNT_BODY_2'] ) );
			$aParam->update_param ();

			// ### Notification Commentaire ###

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_COMMENT_FROM' );
			$aParam->setValue ( trim ( $_POST ['MAIL_COMMENT_FROM'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_COMMENT_SUBJECT" );
			$aParam->setValue ( trim ( $_POST ['MAIL_COMMENT_SUBJECT'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_COMMENT_BODY_1" );
			$aParam->setValue ( trim ( $_POST ['MAIL_COMMENT_BODY_1'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_COMMENT_BODY_2" );
			$aParam->setValue ( trim ( $_POST ['MAIL_COMMENT_BODY_2'] ) );
			$aParam->update_param ();

			// ### Notification Sondage ###

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_FROM' );
			$aParam->setValue ( trim ( $_POST ['MAIL_SURVEY_FROM'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_SURVEY_SUBJECT" );
			$aParam->setValue ( trim ( $_POST ['MAIL_SURVEY_SUBJECT'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_SURVEY_BODY_1" );
			$aParam->setValue ( trim ( $_POST ['MAIL_SURVEY_BODY_1'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_SURVEY_BODY_2" );
			$aParam->setValue ( trim ( $_POST ['MAIL_SURVEY_BODY_2'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_RELANCE_FROM' );
			$aParam->setValue ( trim ( $_POST ['MAIL_SURVEY_RELANCE_FROM'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_SURVEY_RELANCE_SUBJECT" );
			$aParam->setValue ( trim ( $_POST ['MAIL_SURVEY_RELANCE_SUBJECT'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_SURVEY_RELANCE_BODY_1" );
			$aParam->setValue ( trim ( $_POST ['MAIL_SURVEY_RELANCE_BODY_1'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_SURVEY_RELANCE_BODY_2" );
			$aParam->setValue ( trim ( $_POST ['MAIL_SURVEY_RELANCE_BODY_2'] ) );
			$aParam->update_param ();

			// ### Notification Deals ###

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_DEAL_CMD_FROM' );
			$aParam->setValue ( trim ( $_POST ['MAIL_DEAL_CMD_FROM'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_DEAL_CMD_SUBJECT" );
			$aParam->setValue ( trim ( $_POST ['MAIL_DEAL_CMD_SUBJECT'] ) );
			$aParam->update_param ();

			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_MAIL_DEAL_CMD_BODY" );
			$aParam->setValue ( trim ( $_POST ['MAIL_DEAL_CMD_BODY'] ) );
			$aParam->update_param ();

			echo CommunFunction::goToURL ( '../../?menu=2' );
		} else {
			$aParametrageTabView = new ParametrageTabView ();
			$aParametrageTabView->renderHTML ();
		}
	}
}
?>