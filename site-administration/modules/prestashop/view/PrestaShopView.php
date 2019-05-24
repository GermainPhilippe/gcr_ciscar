<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage individu
 * @version 1.0.4
 */
class PrestaShopView {

	function __construct()
	{
	}
	function PrestaShopView() {
		self::__construct();
	}

	public function render($message) {
		$aff = '<div id="main">';
		$aff .= '<div id="shop-img"><img src="../../include/images/preston-login.png" alt="CISCAR"  height="80px" /></div>';
		$aff .= '<div id="message" >' . $message . '</div>';
		$aff .= '</div>';
		$aff .= '<div id="fermer" class="fermer"><button id="btnfermer">Fermer</button></div>';
		echo $aff;
	}
}	