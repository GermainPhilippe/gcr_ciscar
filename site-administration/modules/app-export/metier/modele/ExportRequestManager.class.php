<?php
class ExportRequestManager {
	public function __construct() {
	}
	public function add(ExportRequest $aExportRequest) {
		$sql = "INSERT INTO mod_export (ExportID, Name, OutputFilename, RqtSQL, ColumnName)";
		$sql .= " VALUES(NULL,'%s','%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aExportRequest->getName () ), mysqli_real_escape_string ($_SESSION['LINK'], $aExportRequest->getOutputFilename () ), mysqli_real_escape_string ($_SESSION['LINK'], $aExportRequest->getSQLRequest () ), mysqli_real_escape_string ($_SESSION['LINK'], $aExportRequest->getColumnName () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function update(ExportRequest $aExportRequest) {
		$sql = "UPDATE mod_export SET Name='%s', OutputFilename='%s', RqtSQL='%s', ColumnName='%s' WHERE ExportID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aExportRequest->getName () ), mysqli_real_escape_string ($_SESSION['LINK'], $aExportRequest->getOutputFilename () ), mysqli_real_escape_string ($_SESSION['LINK'], $aExportRequest->getSQLRequest () ), mysqli_real_escape_string ($_SESSION['LINK'], $aExportRequest->getColumnName () ), mysqli_real_escape_string ($_SESSION['LINK'], $aExportRequest->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($aID) {
		$sql = "DELETE FROM mod_export WHERE ExportID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function get($aID) {
		$sql = "SELECT ExportID, Name, OutputFilename, RqtSQL, ColumnName FROM mod_export";
		$sql .= " WHERE ExportID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aExportRequest = new ExportRequest ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$aExportRequest->setID ( ( int ) $line [0] );
			$aExportRequest->setName ( $line [1] );
			$aExportRequest->setOutputFilename ( $line [2] );
			$aExportRequest->setSQLRequest ( $line [3] );
			$aExportRequest->setColumnName ( $line [4] );
		}

		mysqli_free_result  ( $result );

		return $aExportRequest;
	}
	public function getByName($aName) {
		$sql = "SELECT ExportID, Name, OutputFilename, RqtSQL, ColumnName FROM mod_export";
		$sql .= " WHERE Name='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aName ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aExportRequest = new ExportRequest ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$aExportRequest->setID ( ( int ) $line [0] );
			$aExportRequest->setName ( $line [1] );
			$aExportRequest->setOutputFilename ( $line [2] );
			$aExportRequest->setSQLRequest ( $line [3] );
			$aExportRequest->setColumnName ( $line [4] );
		}

		mysqli_free_result  ( $result );

		return $aExportRequest;
	}
	public function getList($debut = -1, $limite = -1) {
		$aArray = array ();
		$sql = "SELECT ExportID, Name, OutputFilename, RqtSQL, ColumnName FROM mod_export";
		if ($debut != - 1 || $limite != - 1) {
			$sql .= ' LIMIT ' . ( int ) $debut . ', ' . ( int ) $limite;
		}

		$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aExportRequest = new ExportRequest ();
			$aExportRequest->setID ( ( int ) $line [0] );
			$aExportRequest->setName ( $line [1] );
			$aExportRequest->setOutputFilename ( $line [2] );
			$aExportRequest->setSQLRequest ( $line [3] );
			$aExportRequest->setColumnName ( $line [4] );
			$aArray [] = $aExportRequest;
		}

		mysqli_free_result  ( $result );

		return $aArray;
	}
	public function save(ExportRequest $aExportRequest) {
		$aExportRequest->isNew () ? $this->add ( $aExportRequest ) : $this->update ( $aExportRequest );
	}
}
?>