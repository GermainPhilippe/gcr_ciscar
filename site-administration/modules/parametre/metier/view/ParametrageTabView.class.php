<?php
class ParametrageTabView {
	public function __construct() {
	}
	public function renderHTML() {
		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;Mail';
		$aff .= '</div><br/><br/>';

		$aff .= '<form action="?action=param" method="post" name="formParamMail">';

		$aff .= '<table width="100%" border="1" cellspacing="0" cellpadding="5">';
		$aff .= '<tr>';
		$aff .= '<td rowspan="4" width="100" valign="top">';
		$aff .= '	<a href="javascript:displayTab(\'1\')" class="linkTabDocumentCurrent" id="linkTabAnnuaire">Annuaire</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'2\')" class="linkTabDocument" id="linkTabCommentaire">Commentaire</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'3\')" class="linkTabDocument" id="linkTabSondage"' . ($_SESSION ['SITE'] ['ID'] != 2 ? ' style="display:none;"' : '') . '>Formulaire en ligne</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'4\')" class="linkTabDocument" id="linkTabDeals"' . ($_SESSION ['SITE'] ['ID'] != 1 ? ' style="display:none;"' : '') . '>Deals</a><br/>';
		$aff .= '</td>';
		$aff .= '<td id="tabAnnuaire" class="tabDocument" valign="top">';
		$aff .= $this->renderAnnuaireHTML ();
		$aff .= '</td></tr>';

		$aff .= '<tr><td id="tabCommentaire" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->renderCommentaireHTML ();
		$aff .= '</td></tr>';

		$aff .= '<tr><td id="tabSondage" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->renderSondageHTML ();
		$aff .= '</td></tr>';

		$aff .= '<tr><td id="tabDeals" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->renderDealsHTML ();
		$aff .= '</td></tr>';

		$aff .= '</table>';
		$aff .= '<br/><br/>';

		$aff .= '<input type="button" value="Enregistrer" onclick="Form.ParametreMail.btEnregistrer()" /> ';
		$aff .= '<input type="button" value="Enregistrer et Fermer" onclick="Form.ParametreMail.btEnregistrerEtFermer()"/>';

		$aff .= '</form>';

		echo $aff;
	}
	private function renderAnnuaireHTML() {
		include_once ("../../include/js/fckeditor/fckeditor.php");
		$aff = '';

		$aff .= '<img src="../../include/images/1.png"> Notification Identifiants Individu<br/>';
		$aff .= '<table width="100%">';
		$aff .= '<tr>';
		$aff .= '<td width="150">Expéditeur</td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_LOGIN_FROM' );
		$aff .= '<td><input type="text" id="MAIL_LOGIN_FROM" name="MAIL_LOGIN_FROM" size="50" value="' . stripslashes ( $aParam->getValue () ) . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Objet</td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_LOGIN_SUBJECT' );
		$aff .= '<td><input type="text" id="MAIL_LOGIN_SUBJECT" name="MAIL_LOGIN_SUBJECT" size="50" value="' . stripslashes ( $aParam->getValue () ) . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Message</td>';
		$aff .= '<td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_LOGIN_BODY_1' );
		$oFCKeditor = new FCKeditor ( 'MAIL_LOGIN_BODY_1' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Signature</td>';
		$aff .= '<td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_LOGIN_BODY_2' );
		$oFCKeditor = new FCKeditor ( 'MAIL_LOGIN_BODY_2' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		$aff .= '<br/><br/>';
		// ###

		$aff .= '<img src="../../include/images/1.png"> Notification Création Individu<br/>';
		$aff .= '<table width="100%">';
		$aff .= '<tr>';
		$aff .= '<td width="150">Expéditeur</td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_ACCOUNT_FROM' );
		$aff .= '<td><input type="text" id="MAIL_ACCOUNT_FROM" name="MAIL_ACCOUNT_FROM" size="50" value="' . stripslashes ( $aParam->getValue () ) . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Objet</td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_ACCOUNT_SUBJECT' );
		$aff .= '<td><input type="text" id="MAIL_ACCOUNT_SUBJECT" name="MAIL_ACCOUNT_SUBJECT" size="50" value="' . stripslashes ( $aParam->getValue () ) . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Message</td>';
		$aff .= '<td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_ACCOUNT_BODY_1' );
		$oFCKeditor = new FCKeditor ( 'MAIL_ACCOUNT_BODY_1' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Signature</td>';
		$aff .= '<td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_ACCOUNT_BODY_2' );
		$oFCKeditor = new FCKeditor ( 'MAIL_ACCOUNT_BODY_2' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		$aff .= '<br/><br/>';
		// ###

		return $aff;
	}
	private function renderCommentaireHTML() {
		$aff = '<img src="../../include/images/1.png"> Notification Commentaire<br/>';
		$aff .= '<table width="100%">';
		$aff .= '<tr>';
		$aff .= '<td width="150">Expéditeur</td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_COMMENT_FROM' );
		$aff .= '<td><input type="text" id="MAIL_COMMENT_FROM" name="MAIL_COMMENT_FROM" size="50" value="' . stripslashes ( $aParam->getValue () ) . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Objet</td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_COMMENT_SUBJECT' );
		$aff .= '<td><input type="text" id="MAIL_COMMENT_SUBJECT" name="MAIL_COMMENT_SUBJECT" size="50" value="' . stripslashes ( $aParam->getValue () ) . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Message</td>';
		$aff .= '<td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_COMMENT_BODY_1' );
		$oFCKeditor = new FCKeditor ( 'MAIL_COMMENT_BODY_1' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Signature</td>';
		$aff .= '<td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_COMMENT_BODY_2' );
		$oFCKeditor = new FCKeditor ( 'MAIL_COMMENT_BODY_2' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		return $aff;
	}
	private function renderSondageHTML() {
		$aff = '<img src="../../include/images/1.png"> Notification Formulaire En Ligne<br/>';
		$aff .= '<table width="100%">';
		$aff .= '<tr>';
		$aff .= '<td width="150">Expéditeur</td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_FROM' );
		$aff .= '<td><input type="text" id="MAIL_SURVEY_FROM" name="MAIL_SURVEY_FROM" size="50" value="' . stripslashes ( $aParam->getValue () ) . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Objet</td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_SUBJECT' );
		$aff .= '<td><input type="text" id="MAIL_SURVEY_SUBJECT" name="MAIL_SURVEY_SUBJECT" size="50" value="' . stripslashes ( $aParam->getValue () ) . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Message</td>';
		$aff .= '<td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_BODY_1' );
		$oFCKeditor = new FCKeditor ( 'MAIL_SURVEY_BODY_1' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Signature</td>';
		$aff .= '<td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_BODY_2' );
		$oFCKeditor = new FCKeditor ( 'MAIL_SURVEY_BODY_2' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		$aff .= '<img src="../../include/images/1.png"> Relance Formulaire En Ligne<br/>';
		$aff .= '<table width="100%">';
		$aff .= '<tr>';
		$aff .= '<td width="150">Expéditeur</td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_RELANCE_FROM' );
		$aff .= '<td><input type="text" id="MAIL_SURVEY_RELANCE_FROM" name="MAIL_SURVEY_RELANCE_FROM" size="50" value="' . stripslashes ( $aParam->getValue () ) . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Objet</td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_RELANCE_SUBJECT' );
		$aff .= '<td><input type="text" id="MAIL_SURVEY_RELANCE_SUBJECT" name="MAIL_SURVEY_RELANCE_SUBJECT" size="50" value="' . stripslashes ( $aParam->getValue () ) . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Message</td>';
		$aff .= '<td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_RELANCE_BODY_1' );
		$oFCKeditor = new FCKeditor ( 'MAIL_SURVEY_RELANCE_BODY_1' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Signature</td>';
		$aff .= '<td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_SURVEY_RELANCE_BODY_2' );
		$oFCKeditor = new FCKeditor ( 'MAIL_SURVEY_RELANCE_BODY_2' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		return $aff;
	}
	private function renderDealsHTML() {
		$aff = '<img src="../../include/images/1.png"> Notification Commande<br/>';
		$aff .= '<table width="100%">';
		$aff .= '<tr>';
		$aff .= '<td width="150">Expéditeur</td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_DEAL_CMD_FROM' );
		$aff .= '<td><input type="text" id="MAIL_DEAL_CMD_FROM" name="MAIL_DEAL_CMD_FROM" size="50" value="' . stripslashes ( $aParam->getValue () ) . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Objet</td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_DEAL_CMD_SUBJECT' );
		$aff .= '<td><input type="text" id="MAIL_DEAL_CMD_SUBJECT" name="MAIL_DEAL_CMD_SUBJECT" size="50" value="' . stripslashes ( $aParam->getValue () ) . '"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Message</td>';
		$aff .= '<td>';
		$aParam = new Param ();
		$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . '_MAIL_DEAL_CMD_BODY' );
		$oFCKeditor = new FCKeditor ( 'MAIL_DEAL_CMD_BODY' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $aParam->getValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '800';
		$oFCKeditor->ToolbarSet = "WCM";
		$oFCKeditor->BaseHref = 'http://' . $_SERVER ['HTTP_HOST'];
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		return $aff;
	}
}
?>