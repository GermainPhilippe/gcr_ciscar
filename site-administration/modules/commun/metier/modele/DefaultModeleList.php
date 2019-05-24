<?php
/**
 *  @author Florent DESPIERRES
 * @package site-administration
 * @subpackage commun
 * @version 1.0.4
 */
interface DefaultModeleList {
	/* METHOD */

	/**
	 *
	 * @return array
	 */
	public function getList();

	/**
	 *
	 * @param array $newValue
	 */
	public function setList($newValue);

	/* METHOD SQL */
	public function SQL_SELECT_ALL();
	public function SQL_SELECT_BY_SITE($aID);
}
?>