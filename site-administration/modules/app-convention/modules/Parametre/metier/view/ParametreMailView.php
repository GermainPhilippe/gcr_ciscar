<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage Parametre
 * @version 1.0.4
 */
class ParametreMailView {
	// Inscription convention(ceux qui sont inscrits au GCR)
	private $myMail_1;
	// Inscription convention(ceux qui sont non-inscrits au GCR)
	private $myMail_2;
	// Relance Inscription
	private $myMail_3;
	// Confirmation de création
	private $myMail_4;
	// Confirmation de modification
	private $myMail_5;
	// Formulaire Statisfaction
	private $myMail_6;
	// Formulaire phase satisfaction - merci
	private $myMail_7;
	// Formulaire Notification invité par Concessionnaire
	private $myMail_8;
	// Formulaire Notification envoyer les identifiants
	private $myMail_9;
	// Formulaire Relance Satisfaction
	private $myMail_10;

	// Les Pages
	private $myPageHome;
	private $myPagePasConvention;
	private $myPageValidation;
	private $myPasswdLength;
	private $myPasswdChars;
	private $myType_1_DomaineList;
	private $myType_2_DomaineList;
	private $myType_3_DomaineList;
	/*
	 * private $myType_4_DomaineList;
	 * private $myType_5_DomaineList;
	 * private $myType_6_DomaineList;
	 */
	private $myListPage;
	private $myCssStyle;
	private $notifConfirmation;
	public function __construct() {
	}

	// ###
	public function setNotifConfirmation($notifConfirmation) {
		$this->notifConfirmation = $notifConfirmation;
	}
	public function setCssStyle($cssstyle) {
		$this->myCssStyle = $cssstyle;
	}
	public function setListPage($listPage) {
		$this->myListPage = $listPage;
	}
	public function setPageHome($newValue) {
		$this->myPageHome = $newValue;
	}
	public function setPagePasConvention($newValue) {
		$this->myPagePasConvention = $newValue;
	}
	public function setPageValidation($newValue) {
		$this->myPageValidation = $newValue;
	}
	public function setType_1_DomaineList($newValue) {
		$this->myType_1_DomaineList = $newValue;
	}
	public function setType_2_DomaineList($newValue) {
		$this->myType_2_DomaineList = $newValue;
	}
	public function setType_3_DomaineList($newValue) {
		$this->myType_3_DomaineList = $newValue;
	}
	public function setMail_1($newValue) {
		$this->myMail_1 = $newValue;
	}
	public function setMail_2($newValue) {
		$this->myMail_2 = $newValue;
	}
	public function setMail_3($newValue) {
		$this->myMail_3 = $newValue;
	}
	public function setMail_4($newValue) {
		$this->myMail_4 = $newValue;
	}
	public function setMail_5($newValue) {
		$this->myMail_5 = $newValue;
	}
	public function setMail_6($newValue) {
		$this->myMail_6 = $newValue;
	}
	public function setMail_7($newValue) {
		$this->myMail_7 = $newValue;
	}
	public function setMail_8($newValue) {
		$this->myMail_8 = $newValue;
	}
	public function setMail_9($newValue) {
		$this->myMail_9 = $newValue;
	}
	public function setMail_10($newValue) {
		$this->myMail_10 = $newValue;
	}
	public function setPasswdLength($newValue) {
		$this->myPasswdLength = $newValue;
	}
	public function setPasswdChars($newValue) {
		$this->myPasswdChars = $newValue;
	}

	// ###
	private function renderStyle() {
		$aff = '<style>';
		$aff .= '#search-wrap { width:100%;color:#888; }';
		$aff .= '.btn-slide-general { display:block;width:100%; color:#000; text-decoration:none; }';
		$aff .= '.slide { background-color:#CCC; }';
		$aff .= '</style>';

		return $aff;
	}
	private function renderScript() {
		$aff = '<script type="text/javascript" src="../../include/js/Parametre.js"></script>';
		return $aff;
	}
	private function renderPage() {
		$aff = '<table>';
		$aff .= '<tr><td>Page d\'accueil (Connexion)</td>';
		$aff .= '	<td><select name="PageHome"><option></option>';
		foreach ( $this->myListPage as $page ) {
			$aff .= '<option value="' . $page->getId () . '"' . ($page->getId () == $this->myPageHome ? ' SELECTED=SELECTED' : '') . '>' . stripslashes ( $page->getTitle () ) . '</option>';
		}
		$aff .= '</select></td>';
		$aff .= '</tr>';
		$aff .= '<tr><td>Page pas de convention</td>';
		$aff .= '	<td><select name="PagePasConvention"><option></option>';
		foreach ( $this->myListPage as $page ) {
			$aff .= '<option value="' . $page->getId () . '"' . ($page->getId () == $this->myPagePasConvention ? ' SELECTED=SELECTED' : '') . '>' . stripslashes ( $page->getTitle () ) . '</option>';
		}
		$aff .= '</select></td>';
		$aff .= '</tr>';
		$aff .= '<tr><td>Page validation</td>';
		$aff .= '	<td><select name="PageValidation"><option></option>';
		foreach ( $this->myListPage as $page ) {
			$aff .= '<option value="' . $page->getId () . '"' . ($page->getId () == $this->myPageValidation ? ' SELECTED=SELECTED' : '') . '>' . stripslashes ( $page->getTitle () ) . '</option>';
		}
		$aff .= '</select></td>';
		$aff .= '</tr>';

		$aff .= '<tr><td valign="top">Feuille de Style</td>';
		$aff .= '<td><textarea name="PageCSSStyle" rows="10" cols="80">' . stripslashes ( $this->myCssStyle ) . '</textarea>';
		$aff .= ' </td>';
		$aff .= '</tr>';

		$aff .= '</table>';
		return $aff;
	}
	private function renderDomaineActivite_HTML() {
		$aff = '<div id="search-wrap">';

		$aff .= '<div class="slide">';
		$aff .= '<img src="../../include/images/1.png" border="0"/> <a class="btn-slide-domaine" href="#">Domaines d\'activités</a>';
		$aff .= '</div>';

		$aff .= '<div id="domaine-panel" style="display: none;">';

		$aff .= '	<table width="100%" border="1">';

		$aff .= '		<tr>';
		$aff .= '			<td width="15%" valign="top">1. Concessionnaire / Directeur Général</td>';
		$aff .= '			<td width="15%">';

		$aList = new DomaineActiviteList ();
		$aList->SQL_SELECT_ALL ();
		$aView = new DomaineActiviteListView ( $aList );
		$aff .= $aView->renderOptionHTML ( $this->myType_1_DomaineList, 'DomaineActivite_1[]', 'DomaineActivite_1' );

		$aff .= '			</td>';
		$aff .= '			<td width="15%" valign="top">2. Directeur de concession</td>';
		$aff .= '			<td width="15%">';
		$aff .= $aView->renderOptionHTML ( $this->myType_2_DomaineList, 'DomaineActivite_2[]', 'DomaineActivite_2' );
		$aff .= '			</td>';

		$aff .= '			<td width="15%" valign="top">3. RRG</td>';
		$aff .= '			<td width="15%">';
		$aff .= $aView->renderOptionHTML ( $this->myType_3_DomaineList, 'DomaineActivite_3[]', 'DomaineActivite_3' );
		$aff .= '			</td>';
		$aff .= '		</tr>';
		$aff .= '	</table>';
		$aff .= '</div>';
		$aff .= '</div>';

		return $aff;
	}
	private function renderPasswd_HTML($mod) {
		$aff = '<div id="search-wrap">';

		$aff .= '<div class="slide">';
		$aff .= '<img src="../../include/images/1.png" border="0"/> <a class="btn-slide-passwd" href="#">Mots de passe automatiques</a>';
		$aff .= '</div>';

		$aff .= '<div id="passwd-panel" style="display: none;">';

		$aff .= '	<table width="100%" border="1">';
		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Longueur du mot de passe</td>';
		$aff .= '			<td><input type="text" name="PasswdLength" value="' . $this->myPasswdLength . '" style="width: 100%"/></td>';
		$aff .= '		</tr>';
		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Caractères autorisés</td>';
		$aff .= '			<td><input type="text" name="PasswdChars" style="width: 100%" value="' . $this->myPasswdChars . '"/></td>';
		$aff .= '		</tr>';
		$aff .= '	</table>';

		$aff .= '</div>';
		$aff .= '</div>';
		return $aff;
	}
	private function renderMAIL_1_HTML($mod) {
		$aff = '<div id="search-wrap">';

		$aff .= '<div class="slide">';
		$aff .= '<img src="../../include/images/1.png" border="0"/> <a class="btn-slide-mail-1" href="#">Phase inscription (pour les inscrits au GCR)</a>';
		$aff .= '</div>';

		$aff .= '<div id="mail-1-panel" style="display: none;">';
		$aff .= '	<table width="100%" border="1">';
		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Adresse emetteur</td>';
		$aff .= '			<td><input type="text" style="width: 100%" name="MailFrom_1" value="' . stripslashes ( $this->myMail_1->getMailFrom () ) . '"/></td>';
		$aff .= '		</tr>';
		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Sujet / Objet</td>';
		$aff .= '			<td><input type="text" style="width: 100%"  name="MailSubject_1" value="' . stripslashes ( $this->myMail_1->getMailSubject () ) . '" /></td>';
		$aff .= '		</tr>';
		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Entete</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailHeader_1' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_1->getMailHeader () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '		</tr>';
		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Pied</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailFooter_1' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_1->getMailFooter () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '		</tr>';
		$aff .= '	</table>';

		$aff .= '</div>';
		$aff .= '</div>';
		return $aff;
	}
	private function renderMAIL_2_HTML($mod) {
		$aff = '<div id="search-wrap">';

		$aff .= '<div class="slide">';
		$aff .= '<img src="../../include/images/1.png" border="0"/> <a class="btn-slide-mail-2" href="#">Phase inscription (pour les non-inscrits au GCR)</a>';
		$aff .= '</div>';

		$aff .= '<div id="mail-2-panel" style="display: none;">';

		$aff .= '	<table width="100%" border="1">';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Adresse emetteur</td>';
		$aff .= '			<td><input type="text" style="width: 100%" name="MailFrom_2" value="' . stripslashes ( $this->myMail_2->getMailFrom () ) . '"/></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Sujet / Objet</td>';
		$aff .= '			<td><input type="text" style="width: 100%"  name="MailSubject_2" value="' . stripslashes ( $this->myMail_2->getMailSubject () ) . '" /></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Entete</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailHeader_2' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_2->getMailHeader () );
		$aff .= $oFCKeditor->CreateHtml ();

		$aff .= '</td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Pied</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailFooter_2' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_2->getMailFooter () );
		$aff .= $oFCKeditor->CreateHtml ();

		$aff .= '</td>';
		$aff .= '		</tr>';

		$aff .= '	</table>';

		$aff .= '</div>';
		$aff .= '</div>';
		return $aff;
	}
	private function renderMAIL_3_HTML($mod) {
		$aff = '<div id="search-wrap">';

		$aff .= '<div class="slide">';
		$aff .= '<img src="../../include/images/1.png" border="0"/> <a class="btn-slide-mail-3" href="#">Phase Inscription - Relances</a>';
		$aff .= '</div>';

		$aff .= '<div id="mail-3-panel" style="display: none;">';

		$aff .= '	<table width="100%" border="1">';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Adresse emetteur</td>';
		$aff .= '			<td><input type="text" style="width: 100%" name="MailFrom_3" value="' . stripslashes ( $this->myMail_3->getMailFrom () ) . '"/></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Sujet / Objet</td>';
		$aff .= '			<td><input type="text" style="width: 100%"  name="MailSubject_3" value="' . stripslashes ( $this->myMail_3->getMailSubject () ) . '" /></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Entete</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailHeader_3' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_3->getMailHeader () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Pied</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailFooter_3' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_3->getMailFooter () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '	</table>';

		$aff .= '</div>';
		$aff .= '</div>';
		return $aff;
	}
	private function renderMAIL_4_HTML($mod) {
		$aff = '<div id="search-wrap">';

		$aff .= '<div class="slide">';
		$aff .= '<img src="../../include/images/1.png" border="0"/> <a class="btn-slide-mail-4" href="#">Phase Inscription - Confirmation de création</a>';
		$aff .= '</div>';

		$aff .= '<div id="mail-4-panel" style="display: none;">';

		$aff .= '	<table width="100%" border="1">';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Adresse emetteur</td>';
		$aff .= '			<td><input type="text" style="width: 100%" name="MailFrom_4" value="' . stripslashes ( $this->myMail_4->getMailFrom () ) . '"/></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Sujet / Objet</td>';
		$aff .= '			<td><input type="text" style="width: 100%"  name="MailSubject_4" value="' . stripslashes ( $this->myMail_4->getMailSubject () ) . '" /></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Entete</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailHeader_4' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_4->getMailHeader () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Pied</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailFooter_4' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_4->getMailFooter () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '	</table>';
		$aff .= '</div>';
		$aff .= '</div>';
		return $aff;
	}
	private function renderMAIL_5_HTML($mod) {
		$aff = '<div id="search-wrap">';

		$aff .= '<div class="slide">';
		$aff .= '<img src="../../include/images/1.png" border="0"/> <a class="btn-slide-mail-5" href="#">Phase Inscription - Confirmation de modification</a>';
		$aff .= '</div>';

		$aff .= '<div id="mail-5-panel" style="display: none;">';

		$aff .= '	<table width="100%" border="1">';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Adresse emetteur</td>';
		$aff .= '			<td><input type="text" style="width: 100%" name="MailFrom_5" value="' . stripslashes ( $this->myMail_5->getMailFrom () ) . '"/></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Sujet / Objet</td>';
		$aff .= '			<td><input type="text" style="width: 100%"  name="MailSubject_5" value="' . stripslashes ( $this->myMail_5->getMailSubject () ) . '" /></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Entete</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailHeader_5' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_5->getMailHeader () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Pied</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailFooter_5' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_5->getMailFooter () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '		</tr>';

		$aff .= '	</table>';

		$aff .= '</div>';
		$aff .= '</div>';
		return $aff;
	}
	private function renderMAIL_6_HTML($mod) {
		$aff = '<div id="search-wrap">';

		$aff .= '<div class="slide">';
		$aff .= '<img src="../../include/images/1.png" border="0"/> <a class="btn-slide-mail-6" href="#">Phase Satisfaction -  Questionnaire</a>';
		$aff .= '</div>';

		$aff .= '<div id="mail-6-panel" style="display: none;">';

		$aff .= '	<table width="100%" border="1">';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Adresse emetteur</td>';
		$aff .= '			<td><input type="text" style="width: 100%" name="MailFrom_6" value="' . stripslashes ( $this->myMail_6->getMailFrom () ) . '"/></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Sujet / Objet</td>';
		$aff .= '			<td><input type="text" style="width: 100%"  name="MailSubject_6" value="' . stripslashes ( $this->myMail_6->getMailSubject () ) . '" /></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Entete</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailHeader_6' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_6->getMailHeader () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Pied</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailFooter_6' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_6->getMailFooter () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '	</table>';

		$aff .= '</div>';
		$aff .= '</div>';
		return $aff;
	}

	/**
	 * Phase satisfaction merci
	 */
	private function renderMAIL_7_HTML($mod) {
		$aff = '<div id="search-wrap">';

		$aff .= '<div class="slide">';
		$aff .= '<img src="../../include/images/1.png" border="0"/> <a class="btn-slide-mail-7" href="#">Phase Satisfaction -  Merci</a>';
		$aff .= '</div>';

		$aff .= '<div id="mail-7-panel" style="display: none;">';

		$aff .= '	<table width="100%" border="1">';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Adresse emetteur</td>';
		$aff .= '			<td><input type="text" style="width: 100%" name="MailFrom_7" value="' . stripslashes ( $this->myMail_7->getMailFrom () ) . '"/></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Sujet / Objet</td>';
		$aff .= '			<td><input type="text" style="width: 100%"  name="MailSubject_7" value="' . stripslashes ( $this->myMail_7->getMailSubject () ) . '" /></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Entete</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailHeader_7' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_7->getMailHeader () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Pied</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailFooter_7' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_7->getMailFooter () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '	</table>';

		$aff .= '</div>';
		$aff .= '</div>';
		return $aff;
	}

	/**
	 * Notification invité par Concessionnaire
	 */
	private function renderMAIL_8_HTML($mod) {
		$aff = '<div id="search-wrap">';

		$aff .= '<div class="slide">';
		$aff .= '<img src="../../include/images/1.png" border="0"/> <a class="btn-slide-mail-8" href="#">Notification invité par Concessionnaire</a>';
		$aff .= '</div>';

		$aff .= '<div id="mail-8-panel" style="display: none;">';

		$aff .= '	<table width="100%" border="1">';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Adresse emetteur</td>';
		$aff .= '			<td><input type="text" style="width: 100%" name="MailFrom_8" value="' . stripslashes ( $this->myMail_8->getMailFrom () ) . '"/></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Sujet / Objet</td>';
		$aff .= '			<td><input type="text" style="width: 100%"  name="MailSubject_8" value="' . stripslashes ( $this->myMail_8->getMailSubject () ) . '" /></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Entete</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailHeader_8' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_8->getMailHeader () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Pied</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailFooter_8' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_8->getMailFooter () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '	</table>';

		$aff .= '</div>';
		$aff .= '</div>';
		return $aff;
	}

	/**
	 * Notification Envoyer les identifiants
	 */
	private function renderMAIL_9_HTML($mod) {
		$aff = '<div id="search-wrap">';

		$aff .= '<div class="slide">';
		$aff .= '<img src="../../include/images/1.png" border="0"/> <a class="btn-slide-mail-9" href="#">Notification Envoyer les identifiants</a>';
		$aff .= '</div>';

		$aff .= '<div id="mail-9-panel" style="display: none;">';

		$aff .= '	<table width="100%" border="1">';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Adresse emetteur</td>';
		$aff .= '			<td><input type="text" style="width: 100%" name="MailFrom_9" value="' . stripslashes ( $this->myMail_9->getMailFrom () ) . '"/></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Sujet / Objet</td>';
		$aff .= '			<td><input type="text" style="width: 100%"  name="MailSubject_9" value="' . stripslashes ( $this->myMail_9->getMailSubject () ) . '" /></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Entete</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailHeader_9' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_9->getMailHeader () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Pied</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailFooter_9' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_9->getMailFooter () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '	</table>';

		$aff .= '</div>';
		$aff .= '</div>';
		return $aff;
	}

	/**
	 * Notification Envoyer Relance Satisfaction
	 */
	private function renderMAIL_10_HTML($mod) {
		$aff = '<div id="search-wrap">';

		$aff .= '<div class="slide">';
		$aff .= '<img src="../../include/images/1.png" border="0"/> <a class="btn-slide-mail-10" href="#">Phase Satisfaction - Relance Questionnaire</a>';
		$aff .= '</div>';

		$aff .= '<div id="mail-10-panel" style="display: none;">';

		$aff .= '	<table width="100%" border="1">';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Adresse emetteur</td>';
		$aff .= '			<td><input type="text" style="width: 100%" name="MailFrom_10" value="' . stripslashes ( $this->myMail_10->getMailFrom () ) . '"/></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Sujet / Objet</td>';
		$aff .= '			<td><input type="text" style="width: 100%"  name="MailSubject_10" value="' . stripslashes ( $this->myMail_10->getMailSubject () ) . '" /></td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Entete</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailHeader_10' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_10->getMailHeader () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '		</tr>';

		$aff .= '		<tr>';
		$aff .= '			<td width="120" valign="top">Pied</td>';
		$aff .= '			<td>';
		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$oFCKeditor = new FCKeditor ( 'MailFooter_10' );
		$oFCKeditor->BasePath = "../../../../include/js/fckeditor/";
		$oFCKeditor->Width = "100%";
		$oFCKeditor->Height = "200";
		// $oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Value = stripslashes ( $this->myMail_10->getMailFooter () );
		$aff .= $oFCKeditor->CreateHtml ();
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '	</table>';

		$aff .= '</div>';
		$aff .= '</div>';
		return $aff;
	}
	public function renderHTML($mod) {
		$aff = '<b><a href="../../../../?menu=5"  style="font-weight:bold" >Convention</a>&nbsp;>&nbsp;Paramètres</b><br/><br/>';

		$aff .= $this->renderStyle ();
		$aff .= $this->renderScript ();

		$aff .= '<form method="POST" action="?action=mail">';
		$aff .= '<font color="#000000"><b>Gestion des pages</b></font><br/><br/>';
		$aff .= $this->renderPage ();

		// $aff .= $this->renderHomePage_HTML();
		// $aff .= $this->renderPasConvention_HTML();
		// $aff .= $this->renderPageValidation_HTML();

		$aff .= '<hr><br/><font color="#000000"><b>Gestion des Domaines d\'activités</b></font><br/><br/>';
		$aff .= $this->renderDomaineActivite_HTML ();

		$aff .= '<hr><br/><font color="#000000"><b>Gestion des Mots de passe</b></font><br/><br/>';
		$aff .= $this->renderPasswd_HTML ( $mod );

		$aff .= '<hr><br/><font color="#000000"><b>Gestion des Notifications</b></font><br/><br/>';
		$aff .= 'Activer Notification Front-end <input type="radio" name="pConventionNotifConfirmation" value="0"' . ($this->notifConfirmation == '0' ? ' CHECKED' : '') . '> OUI <input type="radio" name="pConventionNotifConfirmation" value="1"' . ($this->notifConfirmation == '0' ? '' : ' CHECKED') . '> NON<br>';
		$aff .= $this->renderMAIL_1_HTML ( $mod );
		$aff .= $this->renderMAIL_2_HTML ( $mod );
		$aff .= $this->renderMAIL_3_HTML ( $mod );
		$aff .= $this->renderMAIL_4_HTML ( $mod );
		$aff .= $this->renderMAIL_5_HTML ( $mod );
		$aff .= $this->renderMAIL_6_HTML ( $mod );
		$aff .= $this->renderMAIL_10_HTML ( $mod );
		$aff .= $this->renderMAIL_7_HTML ( $mod );
		$aff .= $this->renderMAIL_8_HTML ( $mod );
		$aff .= $this->renderMAIL_9_HTML ( $mod );

		// ###
		$aff .= '<hr>';
		$aff .= '<input type="submit" value="Enregistrer"/>';
		$aff .= '</form>';

		echo $aff;
		unset ( $aff );
	}
}
?>