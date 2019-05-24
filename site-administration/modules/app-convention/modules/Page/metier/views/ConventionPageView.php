<?php
class ConventionPageView {
	private $conventionPage;
	public function __construct($conventionPage) {
		$this->conventionPage = $conventionPage;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane"><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;<a href="?">Page</a>&nbsp;>&nbsp;';
		$aff .= (isset ( $_GET ['id'] ) ? 'Edition' : 'Création') . '</div><br/><br/>';

		$aff .= '<form method="post" name="formPageConvention">';
		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '<td><b>Titre</b></td><td><input type="text" id="title" name="title" size="100" value="' . stripslashes ( $this->conventionPage->getTitle () ) . '"></td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		$aff .= '<b>Contenu HTML</b>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'RichTextValue' );
		$oFCKeditor->BasePath = '../../../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->conventionPage->getHtmlContent () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '350';
		$aff .= $oFCKeditor->CreateHtml ();

		$aff .= '<input type="button" value="Enregistrer" onclick="Form.ConventionPage.btEnregistrer()" /> ';
		$aff .= '<input type="button" value="Enregistrer et Fermer" onclick="Form.ConventionPage.btEnregistrerEtFermer()"/>';

		$aff .= '</form>';

		echo $aff;
	}
}