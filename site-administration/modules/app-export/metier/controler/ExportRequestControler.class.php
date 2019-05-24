<?php
class ExportRequestControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
				if (isset ( $_POST ['Name'] )) {
					$aManager = new ExportRequestManager ();
					$aExportRequest = new ExportRequest ();
					$aExportRequest->setName ( $_POST ['Name'] );
					$aExportRequest->setOutputFilename ( $_POST ['OutputFilename'] );
					$aExportRequest->setSQLRequest ( $_POST ['RqtSQL'] );
					$aExportRequest->setColumnName ( $_POST ['ColumnName'] );
					$aManager->add ( $aExportRequest );

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aExportRequest = new ExportRequest ();
					$aExportRequestView = new ExportRequestView ( $aExportRequest );
					$aExportRequestView->renderHTML ( 'new' );
				}
				break;
			case 'update' :
				if (isset ( $_POST ['Name'] )) {
					$aManager = new ExportRequestManager ();
					$aExportRequest = new ExportRequest ();
					$aExportRequest->setID ( ( int ) $_GET ['id'] );
					$aExportRequest->setName ( $_POST ['Name'] );
					$aExportRequest->setOutputFilename ( $_POST ['OutputFilename'] );
					$aExportRequest->setSQLRequest ( $_POST ['RqtSQL'] );
					$aExportRequest->setColumnName ( $_POST ['ColumnName'] );
					$aManager->update ( $aExportRequest );

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aManager = new ExportRequestManager ();
					$aExportRequest = $aManager->get ( $_GET ['id'] );
					$aExportRequestView = new ExportRequestView ( $aExportRequest );
					$aExportRequestView->renderHTML ( 'update' );
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aManager = new ExportRequestManager ();
					$aManager->delete ( $_GET ['id'] );

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>