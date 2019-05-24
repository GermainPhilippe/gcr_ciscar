<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class SageEtablissementView implements DefaultListView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}

	// ###
	public function renderHTML() {
		echo 'ID;RaisonSociale;LoginSage;PasswordSage<br/>';
		foreach ( $this->myList as $aRow ) {
			echo $aRow [0] . ';' . $aRow [1] . ';' . $aRow [2] . ';' . $aRow [3] . '<br/>';
		}
	}
}
?>