<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage banniere
 * @version 1.0.4
 */
class BanniereDisplayView {
	private $myBanniere;
	public function __construct($aBanniere) {
		$this->myBanniere = $aBanniere;
	}
	public function render() {
		$aff = '<img src="' . $this->myBanniere->getURLImage () . '" />';
		echo $aff;
	}
	public function render2() {
		$aff = '<html>';
		$aff .= '<head>';
		$aff .= '<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />';
		$aff .= '</head>';
		$aff .= '<body>';
		$aff .= '<div id="FilAriane">Aper&ccedil;u banni&egrave;re</div><br/><br/>';
		$aff .= '<img src="' . $this->myBanniere->getURLImage () . '" />';
		$aff .= '<p align="right"><a href="#" class="jqmClose">Fermer</a></p>';
		$aff .= '</body>';
		$aff .= '</html>';
		echo $aff;
	}
}
?>