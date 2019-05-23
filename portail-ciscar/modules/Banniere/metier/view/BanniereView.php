<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage banniere
 * @version 1.0.4
 */
class BanniereView {
	private $myBanniere;
	public function __construct($aBanniere) {
		$this->myBanniere = $aBanniere;
	}
	
	// ###
	public function render() {
		$aff = '<a href="' . ($this->myBanniere->getURL () != '' ? $this->myBanniere->getURL () : '') . '" target="_BLANK"><img src="' . ($this->myBanniere->getURL () != '' ? $this->myBanniere->getURLImage () : '') . '" Border="0" /></a>';
		return $aff;
	}
}
?>