<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Parametre
 * @version 1.0.4
 */
class ParametreControler {
	public function __construct() {
	}

	// ###
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
				if (isset ( $_POST ['Nom'] )) {
					$aModele = new Parametre ();
					$aModele->setNom ( $_POST ['Nom'] );
					$aModele->setValeur ( $_POST ['Valeur'] );
					$aModele->SQL_create ();

					$aView = new ParametreView ( NULL );
					$aView->redirection ( '?' );
				} else {
					$aModele = new Parametre ();
					$aView = new ParametreView ( $aModele );
					$aView->renderHTML ( 'new' );
				}
				break;
			case 'edit' :
				if (isset ( $_POST ['Nom'] )) {
					$aModele = new Parametre ();
					$aModele->setID ( $_GET ['id'] );
					$aModele->setNom ( $_POST ['Nom'] );
					$aModele->setValeur ( $_POST ['Valeur'] );
					$aModele->SQL_update ();

					$aView = new ParametreView ( NULL );
					$aView->redirection ( '?' );
				} else {
					if (isset ( $_GET ['id'] )) {
						$aModele = new Parametre ();
						$aModele->SQL_select ( $_GET ['id'] );
						$aView = new ParametreView ( $aModele );
						$aView->renderHTML ( 'edit' );
					}
				}
				break;
			case 'delete' :
				if (isset ( $_POST ['Nom'] )) {
					$aModele = new Parametre ();
					$aModele->setID ( $_GET ['id'] );
					$aModele->setNom ( $_POST ['Nom'] );
					$aModele->setValeur ( $_POST ['Valeur'] );
					$aModele->SQL_delete ();

					$aView = new ParametreView ( NULL );
					$aView->redirection ( '?' );
				} else {
					if (isset ( $_GET ['id'] )) {
						$aModele = new Parametre ();
						$aModele->SQL_select ( $_GET ['id'] );
						$aView = new ParametreView ( $aModele );
						$aView->renderHTML ( 'delete' );
					}
				}
				break;
			case 'mail' :
				if (isset ( $_POST ['MailFrom_5'] )) {
					$aParam = new Parametre ();
					$aParam->SQL_select_by_name ( "MAIL_1_FROM" );
					$aParam->setValeur ( $_POST ['MailFrom_1'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_1_SUBJECT" );
					$aParam->setValeur ( $_POST ['MailSubject_1'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_1_HEADER" );
					$aParam->setValeur ( $_POST ['MailHeader_1'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_1_FOOTER" );
					$aParam->setValeur ( $_POST ['MailFooter_1'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_2_FROM" );
					$aParam->setValeur ( $_POST ['MailFrom_2'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_2_SUBJECT" );
					$aParam->setValeur ( $_POST ['MailSubject_2'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_2_HEADER" );
					$aParam->setValeur ( $_POST ['MailHeader_2'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_2_FOOTER" );
					$aParam->setValeur ( $_POST ['MailFooter_2'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_3_FROM" );
					$aParam->setValeur ( $_POST ['MailFrom_3'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_3_SUBJECT" );
					$aParam->setValeur ( $_POST ['MailSubject_3'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_3_HEADER" );
					$aParam->setValeur ( $_POST ['MailHeader_3'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_3_FOOTER" );
					$aParam->setValeur ( $_POST ['MailFooter_3'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_4_FROM" );
					$aParam->setValeur ( $_POST ['MailFrom_4'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_4_SUBJECT" );
					$aParam->setValeur ( $_POST ['MailSubject_4'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_4_HEADER" );
					$aParam->setValeur ( $_POST ['MailHeader_4'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_4_FOOTER" );
					$aParam->setValeur ( $_POST ['MailFooter_4'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_5_FROM" );
					$aParam->setValeur ( $_POST ['MailFrom_5'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_5_SUBJECT" );
					$aParam->setValeur ( $_POST ['MailSubject_5'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_5_HEADER" );
					$aParam->setValeur ( $_POST ['MailHeader_5'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_5_FOOTER" );
					$aParam->setValeur ( $_POST ['MailFooter_5'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_6_FROM" );
					$aParam->setValeur ( $_POST ['MailFrom_6'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_6_SUBJECT" );
					$aParam->setValeur ( $_POST ['MailSubject_6'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_6_HEADER" );
					$aParam->setValeur ( $_POST ['MailHeader_6'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_6_FOOTER" );
					$aParam->setValeur ( $_POST ['MailFooter_6'] );
					$aParam->SQL_update ();

					$aParam->SQL_select_by_name ( "MAIL_7_FROM" );
					$aParam->setValeur ( $_POST ['MailFrom_7'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_7_SUBJECT" );
					$aParam->setValeur ( $_POST ['MailSubject_7'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_7_HEADER" );
					$aParam->setValeur ( $_POST ['MailHeader_7'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_7_FOOTER" );
					$aParam->setValeur ( $_POST ['MailFooter_7'] );
					$aParam->SQL_update ();

					$aParam->SQL_select_by_name ( "MAIL_8_FROM" );
					$aParam->setValeur ( $_POST ['MailFrom_8'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_8_SUBJECT" );
					$aParam->setValeur ( $_POST ['MailSubject_8'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_8_HEADER" );
					$aParam->setValeur ( $_POST ['MailHeader_8'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_8_FOOTER" );
					$aParam->setValeur ( $_POST ['MailFooter_8'] );
					$aParam->SQL_update ();

					$aParam->SQL_select_by_name ( "MAIL_9_FROM" );
					$aParam->setValeur ( $_POST ['MailFrom_9'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_9_SUBJECT" );
					$aParam->setValeur ( $_POST ['MailSubject_9'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_9_HEADER" );
					$aParam->setValeur ( $_POST ['MailHeader_9'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_9_FOOTER" );
					$aParam->setValeur ( $_POST ['MailFooter_9'] );
					$aParam->SQL_update ();

					$aParam->SQL_select_by_name ( "MAIL_10_FROM" );
					$aParam->setValeur ( $_POST ['MailFrom_10'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_10_SUBJECT" );
					$aParam->setValeur ( $_POST ['MailSubject_10'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_10_HEADER" );
					$aParam->setValeur ( $_POST ['MailHeader_10'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "MAIL_10_FOOTER" );
					$aParam->setValeur ( $_POST ['MailFooter_10'] );
					$aParam->SQL_update ();

					$aParam->SQL_select_by_name ( "PASSWD_LENGTH" );
					$aParam->setValeur ( $_POST ['PasswdLength'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "PASSWD_CHARS" );
					$aParam->setValeur ( $_POST ['PasswdChars'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "PAGE_HOMEPAGE" );
					$aParam->setValeur ( $_POST ['PageHome'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "PAGE_PASCONVENTION" );
					$aParam->setValeur ( $_POST ['PagePasConvention'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "PAGE_VALIDATION" );
					$aParam->setValeur ( $_POST ['PageValidation'] );
					$aParam->SQL_update ();
					$aParam->SQL_select_by_name ( "PAGE_CSS_STYLE" );
					$aParam->setValeur ( $_POST ['PageCSSStyle'] );
					$aParam->SQL_update ();

					$aParamTypeDomaine = new ParamTypeDomaine ();
					if (in_array ( 0, $_POST ['DomaineActivite_1'] )) {
						unset ( $_POST ['DomaineActivite_1'] [0] );
					}
					$aParamTypeDomaine->setList ( $_POST ['DomaineActivite_1'] );
					$aParamTypeDomaine->SQL_UDPATE ( 1 );
					if (in_array ( 0, $_POST ['DomaineActivite_2'] )) {
						unset ( $_POST ['DomaineActivite_2'] [0] );
					}
					$aParamTypeDomaine->setList ( $_POST ['DomaineActivite_2'] );
					$aParamTypeDomaine->SQL_UDPATE ( 2 );
					if (in_array ( 0, $_POST ['DomaineActivite_3'] )) {
						unset ( $_POST ['DomaineActivite_3'] [0] );
					}
					$aParamTypeDomaine->setList ( $_POST ['DomaineActivite_3'] );
					$aParamTypeDomaine->SQL_UDPATE ( 3 );

					$aParam->SQL_select_by_name ( "CONVENTION_NOTIF_CONFIRMATION" );
					$aParam->setValeur ( $_POST ['pConventionNotifConfirmation'] );
					$aParam->SQL_update ();

					$aView = new ParametreView ( NULL );
					$aView->redirection ( '?action=mail' );
				} else {
					$aParam = new Parametre ();
					$aParamMail_1 = new ParametreMail ();
					$aParamMail_2 = new ParametreMail ();
					$aParamMail_3 = new ParametreMail ();
					$aParamMail_4 = new ParametreMail ();
					$aParamMail_5 = new ParametreMail ();
					$aParamMail_6 = new ParametreMail ();
					$aParamMail_7 = new ParametreMail ();
					$aParamMail_8 = new ParametreMail ();
					$aParamMail_9 = new ParametreMail ();
					$aParamMail_10 = new ParametreMail ();

					$aParam->SQL_select_by_name ( "MAIL_1_FROM" );
					$aParamMail_1->setMailFrom ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_1_SUBJECT" );
					$aParamMail_1->setMailSubject ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_1_HEADER" );
					$aParamMail_1->setMailHeader ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_1_FOOTER" );
					$aParamMail_1->setMailFooter ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "MAIL_2_FROM" );
					$aParamMail_2->setMailFrom ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_2_SUBJECT" );
					$aParamMail_2->setMailSubject ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_2_HEADER" );
					$aParamMail_2->setMailHeader ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_2_FOOTER" );
					$aParamMail_2->setMailFooter ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "MAIL_3_FROM" );
					$aParamMail_3->setMailFrom ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_3_SUBJECT" );
					$aParamMail_3->setMailSubject ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_3_HEADER" );
					$aParamMail_3->setMailHeader ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_3_FOOTER" );
					$aParamMail_3->setMailFooter ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "MAIL_4_FROM" );
					$aParamMail_4->setMailFrom ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_4_SUBJECT" );
					$aParamMail_4->setMailSubject ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_4_HEADER" );
					$aParamMail_4->setMailHeader ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_4_FOOTER" );
					$aParamMail_4->setMailFooter ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "MAIL_5_FROM" );
					$aParamMail_5->setMailFrom ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_5_SUBJECT" );
					$aParamMail_5->setMailSubject ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_5_HEADER" );
					$aParamMail_5->setMailHeader ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_5_FOOTER" );
					$aParamMail_5->setMailFooter ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "MAIL_6_FROM" );
					$aParamMail_6->setMailFrom ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_6_SUBJECT" );
					$aParamMail_6->setMailSubject ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_6_HEADER" );
					$aParamMail_6->setMailHeader ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_6_FOOTER" );
					$aParamMail_6->setMailFooter ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "MAIL_7_FROM" );
					$aParamMail_7->setMailFrom ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_7_SUBJECT" );
					$aParamMail_7->setMailSubject ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_7_HEADER" );
					$aParamMail_7->setMailHeader ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_7_FOOTER" );
					$aParamMail_7->setMailFooter ( $aParam->getValeur () );

					// ###

					$aParam->SQL_select_by_name ( "MAIL_8_FROM" );
					$aParamMail_8->setMailFrom ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_8_SUBJECT" );
					$aParamMail_8->setMailSubject ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_8_HEADER" );
					$aParamMail_8->setMailHeader ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_8_FOOTER" );
					$aParamMail_8->setMailFooter ( $aParam->getValeur () );
					$dao = new ConventionPageDAO ();
					$listPage = $dao->findAll ();

					// ###

					$aParam->SQL_select_by_name ( "MAIL_9_FROM" );
					$aParamMail_9->setMailFrom ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_9_SUBJECT" );
					$aParamMail_9->setMailSubject ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_9_HEADER" );
					$aParamMail_9->setMailHeader ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_9_FOOTER" );
					$aParamMail_9->setMailFooter ( $aParam->getValeur () );
					$dao = new ConventionPageDAO ();
					$listPage = $dao->findAll ();

					// ###

					$aParam->SQL_select_by_name ( "MAIL_10_FROM" );
					$aParamMail_10->setMailFrom ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_10_SUBJECT" );
					$aParamMail_10->setMailSubject ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_10_HEADER" );
					$aParamMail_10->setMailHeader ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "MAIL_10_FOOTER" );
					$aParamMail_10->setMailFooter ( $aParam->getValeur () );
					$dao = new ConventionPageDAO ();
					$listPage = $dao->findAll ();

					// ###

					$aView = new ParametreMailView ();
					$aView->setMail_1 ( $aParamMail_1 );
					$aView->setMail_2 ( $aParamMail_2 );
					$aView->setMail_3 ( $aParamMail_3 );
					$aView->setMail_4 ( $aParamMail_4 );
					$aView->setMail_5 ( $aParamMail_5 );
					$aView->setMail_6 ( $aParamMail_6 );
					$aView->setMail_7 ( $aParamMail_7 );
					$aView->setMail_8 ( $aParamMail_8 );
					$aView->setMail_9 ( $aParamMail_9 );
					$aView->setMail_10 ( $aParamMail_10 );

					$aView->setListPage ( $listPage );

					$aParam->SQL_select_by_name ( "PASSWD_LENGTH" );
					$aView->setPasswdLength ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "PASSWD_CHARS" );
					$aView->setPasswdChars ( $aParam->getValeur () );

					$aParam->SQL_select_by_name ( "PAGE_HOMEPAGE" );
					$aView->setPageHome ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "PAGE_PASCONVENTION" );
					$aView->setPagePasConvention ( $aParam->getValeur () );
					$aParam->SQL_select_by_name ( "PAGE_VALIDATION" );
					$aView->setPageValidation ( $aParam->getValeur () );

					$aParam->SQL_select_by_name ( "PAGE_CSS_STYLE" );
					$aView->setCssStyle ( $aParam->getValeur () );

					$aParam->SQL_select_by_name ( "CONVENTION_NOTIF_CONFIRMATION" );
					$aView->setNotifConfirmation ( $aParam->getValeur () );

					// ###

					$aParamTypeDomaine_1 = new ParamTypeDomaine ();
					$aParamTypeDomaine_1->SQL_SELECT_ALL ( 1 );
					$aView->setType_1_DomaineList ( $aParamTypeDomaine_1->getList () );
					$aParamTypeDomaine_2 = new ParamTypeDomaine ();
					$aParamTypeDomaine_2->SQL_SELECT_ALL ( 2 );
					$aView->setType_2_DomaineList ( $aParamTypeDomaine_2->getList () );
					$aParamTypeDomaine_3 = new ParamTypeDomaine ();
					$aParamTypeDomaine_3->SQL_SELECT_ALL ( 3 );
					$aView->setType_3_DomaineList ( $aParamTypeDomaine_3->getList () );

					$aView->renderHTML ( 'edit' );
				}
				break;
		}
	}
}
?>