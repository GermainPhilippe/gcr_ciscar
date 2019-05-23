<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage autologin
 * @version 1.0.4
 */
class ExportAutologinView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	
	// ###
	public function renderHTML() {
		header ( "Content-Type: application/csv-tab-delimited-table" );
		header ( "Content-disposition: filename=CISCAR_Contact_Template.csv" );
		
		foreach ( $this->myList as $aRow ) {
			echo "$aRow[0];";
			echo "$aRow[1];";
			echo "$aRow[2];";
			echo "$aRow[3];";
			echo "$aRow[4];";
			echo "$aRow[5];";
			echo "$aRow[6];";
			echo "$aRow[7];";
			echo "$aRow[8];";
			echo "\n";
		}
	}
}
?>