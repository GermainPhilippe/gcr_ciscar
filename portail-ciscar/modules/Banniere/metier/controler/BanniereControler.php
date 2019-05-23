<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage banniere
 * @version 1.0.4
 */
class BanniereControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'doc' :
				if (isset ( $_GET ['id'] )) {
					$aDocInfoDyn = new DocInfoDyn ();
					$aDocInfoDyn->SQL_select ( $_GET ['id'] );
					
					if (is_null ( $aDocInfoDyn->getBanniereID () )) {
						$aParam = new Param ();
						$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_WCM_DEFAULT_BANNER' );
						$aParam2 = new Param ();
						$aParam2->search_param ( $_SESSION ['SITE'] ['NAME'] . '_WCM_DEFAULT_URL_BANNER' );
						if ($aParam->getValue () == '') {
							return '<img src="include/images/banniere/default.gif" Border="0">';
						} else {
							return '<a href="' . $aParam2->getValue () . '" target="_BLANK"><img src="' . $aParam->getValue () . '" Border="0"></a>';
						}
					} else {
						$aBanniere = new Banniere ();
						$aBanniere->SQL_select ( $aDocInfoDyn->getBanniereID () );
						
						if (is_null ( $aBanniere->getID () )) {
							$aParam = new Param ();
							$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_WCM_DEFAULT_BANNER' );
							$aParam2 = new Param ();
							$aParam2->search_param ( $_SESSION ['SITE'] ['NAME'] . '_WCM_DEFAULT_URL_BANNER' );
							if ($aParam->getValue () == '') {
								return '<img src="include/images/banniere/default.gif" Border="0">';
							} else {
								return '<a href="' . $aParam2->getValue () . '" target="_BLANK"><img src="' . $aParam->getValue () . '" Border="0"></a>';
							}
						} else {
							$aBanniereView = new BanniereView ( $aBanniere );
							return $aBanniereView->render ();
						}
					}
				}
				break;
			default :
				$aParam = new Param ();
				$aParam->search_param ( $_SESSION ['SITE'] ['NAME'] . '_WCM_DEFAULT_BANNER' );
				$aParam2 = new Param ();
				$aParam2->search_param ( $_SESSION ['SITE'] ['NAME'] . '_WCM_DEFAULT_URL_BANNER' );
				if ($aParam->getValue () == '') {
					return '<img src="include/images/banniere/default.gif" Border="0">';
				} else {
					return '<a href="' . $aParam2->getValue () . '" target="_BLANK"><img src="' . $aParam->getValue () . '" Border="0"></a>';
				}
				break;
		}
	}
}
?>