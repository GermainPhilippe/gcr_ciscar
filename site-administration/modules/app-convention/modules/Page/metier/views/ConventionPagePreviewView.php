<?php
class ConventionPagePreviewView {
	private $conventionPage;
	public function __construct($conventionPage) {
		$this->conventionPage = $conventionPage;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane"><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;<a href="?">Page</a>&nbsp;>&nbsp;Preview</div><br/><br/>';
		$aff .= $this->conventionPage->getHtmlContent ();
		echo $aff;
	}
}