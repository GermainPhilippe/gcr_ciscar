<?php
/**
 *  @author Florent DESPIERRES
 * @package site-administration
 * @subpackage commun
 * @version 1.0.4
 */
interface DefaultModele {
	/* METHOD */
	public function getID();
	public function setID($newValue);

	/* METHOD SQL */
	public function SQL_CREATE();
	public function SQL_UPDATE();
	public function SQL_DELETE();
	public function SQL_SELECT($aID);
}
?>