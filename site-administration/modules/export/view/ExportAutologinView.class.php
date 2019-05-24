<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class ExportAutologinView implements DefaultListView {
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
			echo "$aRow[9];";
			echo "$aRow[10];";
			echo "\n";
		}
	}
}
?>