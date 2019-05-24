<?php
class FlashInfoControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
				if (isset ( $_POST ['Nom'] )) {
					$aFlashInfo = new FlashInfo ();
					$aFlashInfo->setNom ( $_POST ['Nom'] );
					$aFlashInfo->setDateDebut ( CommunFunction::getDateUS ( $_POST ['DateDebut'] ) );
					$aFlashInfo->setDateFin ( CommunFunction::getDateUS ( $_POST ['DateFin'] ) );
					$aFlashInfo->setInformation ( $_POST ['Information'] );
					$aFlashInfo->setDocInfoDynID ( $_POST ['pElmentIDDisplay'] != "" ? ( int ) $_POST ['pElmentID'] : NULL );
					$aFlashInfoManager = new FlashInfoManager ();
					$aFlashInfoManager->add ( $aFlashInfo );

					$aFlashInfoDomaineActiviteManager = new FlashInfoDomaineActiviteManager ();
					for($i = 1; $i <= $_POST ['Counter']; $i ++) {
						if (isset ( $_POST ['DA' . $i] )) {
							$aFlashInfoDomaineActivite = new FlashInfoDomaineActivite ();
							$aFlashInfoDomaineActivite->setFlashInfoID ( ( int ) $aFlashInfo->getID () );
							$aFlashInfoDomaineActivite->setDomaineActiviteID ( ( int ) $_POST ['DA' . $i] );
							$aFlashInfoDomaineActiviteManager->add ( $aFlashInfoDomaineActivite );
						}
					}

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aFlashInfoView = new FlashInfoView ( new FlashInfo () );
					$aFlashInfoView->renderHTML ( 'new' );
				}
				break;
			case 'update' :
				if (isset ( $_POST ['Nom'] )) {
					$aFlashInfo = new FlashInfo ();
					$aFlashInfo->setID ( ( int ) $_GET ['id'] );
					$aFlashInfo->setNom ( $_POST ['Nom'] );
					$aFlashInfo->setDateDebut ( CommunFunction::getDateUS ( $_POST ['DateDebut'] ) );
					$aFlashInfo->setDateFin ( CommunFunction::getDateUS ( $_POST ['DateFin'] ) );
					$aFlashInfo->setInformation ( $_POST ['Information'] );
					$aFlashInfo->setDocInfoDynID ( $_POST ['pElmentIDDisplay'] != '' ? ( int ) $_POST ['pElmentID'] : NULL );
					$aFlashInfoManager = new FlashInfoManager ();
					$aFlashInfoManager->update ( $aFlashInfo );

					$aFlashInfoDomaineActiviteManager = new FlashInfoDomaineActiviteManager ();
					$aFlashInfoDomaineActiviteManager->deleteAll ( ( int ) $_GET ['id'] );
					for($i = 1; $i <= $_POST ['Counter']; $i ++) {
						if (isset ( $_POST ['DA' . $i] )) {
							$aFlashInfoDomaineActivite = new FlashInfoDomaineActivite ();
							$aFlashInfoDomaineActivite->setFlashInfoID ( ( int ) $aFlashInfo->getID () );
							$aFlashInfoDomaineActivite->setDomaineActiviteID ( ( int ) $_POST ['DA' . $i] );
							$aFlashInfoDomaineActiviteManager->add ( $aFlashInfoDomaineActivite );
						}
					}

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aFlashInfoManager = new FlashInfoManager ();
					$aFlashInfoView = new FlashInfoView ( $aFlashInfoManager->get ( ( int ) $_GET ['id'] ) );
					$aFlashInfoView->renderHTML ( 'update' );
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aFlashInfoManager = new FlashInfoManager ();
					$aFlashInfoManager->delete ( $_GET ['id'] );

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'addDomaineActivite' :
				$aDomaineActiviteListe = new DomaineActiviteListe ();
				$aDomaineActiviteListe->select_all_domaineactivite ();
				$aFlashInfoAddDomaineActiviteView = new FlashInfoAddDomaineActiviteView ( $aDomaineActiviteListe->getDomaineActiviteListe () );
				$aFlashInfoAddDomaineActiviteView->renderHTML ();
				break;
		}
	}
}
?>