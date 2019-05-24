<?php
/**
 * Vue des différents mails
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 */
class ParamMailView {

	/*
	 * private $myParamMail;
	 *
	 * public function __construct($aParamMail)
	 * {
	 * $this->myParamMail = $aParamMail;
	 * }
	 */

	// Publication d'une offre
	private $myMail_1;
	// Non publication d'une offre
	private $myMail_2;
	// Publication d'une candidature
	private $myMail_3;
	// Non publication d'une candidature
	private $myMail_4;
	// Suppression d'une offre
	private $myMail_5;
	// Non suppression d'une offre
	private $myMail_6;
	// Notification de réponse à une offre candidat
	private $myMail_7;
	// Notification de réponse à une offre employeur
	private $myMail_8;
	private $myParamMailBox;
	private $myParamAdminMail;
	public function __construct() {
	}

	// ###

	/**
	 * Publication d'une offre
	 */
	public function setMail_1($newValue) {
		$this->myMail_1 = $newValue;
	}
	/**
	 * Non publication d'une offre
	 */
	public function setMail_2($newValue) {
		$this->myMail_2 = $newValue;
	}
	/**
	 * Publication d'une candidature
	 */
	public function setMail_3($newValue) {
		$this->myMail_3 = $newValue;
	}
	/**
	 * Non publication d'une candidature
	 */
	public function setMail_4($newValue) {
		$this->myMail_4 = $newValue;
	}
	/**
	 * Suppression d'une offre
	 */
	public function setMail_5($newValue) {
		$this->myMail_5 = $newValue;
	}
	/**
	 * Non suppression d'une offre
	 */
	public function setMail_6($newValue) {
		$this->myMail_6 = $newValue;
	}
	/**
	 * Notification de réponse à une offre candidat
	 */
	public function setMail_7($newValue) {
		$this->myMail_7 = $newValue;
	}
	/**
	 * Notification de réponse à une offre employeur
	 */
	public function setMail_8($newValue) {
		$this->myMail_8 = $newValue;
	}
	public function setParamAdminMail($newValue) {
		$this->myParamAdminMail = $newValue;
	}
	/**
	 * rendu du style de la vue
	 */
	private function renderStyle() {
		$aff = '<style>';
		$aff .= '#search-wrap { width:100%;color:#888; }';
		$aff .= '.btn-slide-general { display:block;width:100%; color:#000; text-decoration:none; }';
		$aff .= '.slide { background-color:#CCC; }';
		$aff .= 'input.txt { width:380px; }';
		$aff .= 'textaera {width:800px;height:200px;}';
		// $aff .= 'td.titre { width:200px; }';
		$aff .= '</style>';

		return $aff;
	}
	/**
	 *
	 * rendu de l'éditeur
	 *
	 * @return string
	 */
	private function renderScript() {
		$aff = '<div id="FilAriane" ><a href="../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;';
		$aff .= 'Paramétrage des mails </div><br /><br />';
		$aff .= '<script src="../../include/js/jquery/jquery-1.4.2.js"></script>';
		$aff .= '<script>
					$(document).ready(function(){
						$(".btn-slide-passwd").click(function(){
							$("#passwd-panel").slideToggle("slow");
							$(this).toggleClass("active");
							return false;
						});
						
						$(".btn-slide-domaine").click(function(){
							$("#domaine-panel").slideToggle("slow");
							$(this).toggleClass("active");
							return false;
						});
					
						$(".btn-slide-mail-1").click(function(){
							$("#mail-1-panel").slideToggle("slow");
							$(this).toggleClass("active");
							return false;
						});
						
						$(".btn-slide-mail-6").click(function(){
							$("#mail-6-panel").slideToggle("slow");
							$(this).toggleClass("active");
							return false;
						});
						
						$(".btn-slide-mail-2").click(function(){
							$("#mail-2-panel").slideToggle("slow");
							$(this).toggleClass("active");
							return false;
						});
						
						$(".btn-slide-mail-3").click(function(){
							$("#mail-3-panel").slideToggle("slow");
							$(this).toggleClass("active");
							return false;
						});
						
						$(".btn-slide-mail-4").click(function(){
							$("#mail-4-panel").slideToggle("slow");
							$(this).toggleClass("active");
							return false;
						});
						
						$(".btn-slide-mail-5").click(function(){
							$("#mail-5-panel").slideToggle("slow");
							$(this).toggleClass("active");
							return false;
						});
						
						$(".btn-slide-admin").click(function(){
							$("#mail-admin").slideToggle("slow");
							$(this).toggleClass("active");
							return false;
						});
					});
					
					<!--tinyMCE.init({mode : "textareas",theme : "simple"});-->
					</script>';

		return $aff;
	}
	/**
	 * rendu de la vue.
	 */
	public function rendercorp() {
		$aff = $this->renderstyle ();
		$aff .= $this->renderScript ();
		$aff .= '<form method="POST" action="?action=mail">';
		$aff .= '<input type="submit" value="Mettre à jour"> <br /><br />';
		$aff .= '	<div class="slide" ><img src="../../include/images/1.png" /><a align="top" href="#" class="btn-slide-admin">Paramétrage général</a></div>';

		// ###

		$aff .= '	<div id="mail-admin" style="display: none;">';
		$aff .= '		<table width="100%" border="1">';
		$aff .= '			<tr><td class="titre">Mail de l\'Administrateur</td>';
		$aff .= '				<td ><input class="txt" type="texte" value="' . $this->myParamAdminMail . '" name="paramadminmail"></td></tr>';
		$aff .= '		</table>';
		$aff .= '</div>';
		$aff .= '<div class="slide"><img src="../../include/images/1.png" /><a href="#" class="btn-slide-passwd">Paramétrage des mails de publication d\'une offre</a></div>';

		// ###

		$aff .= '	<div id="passwd-panel" style="display: none;">';
		$aff .= '		<table  border="1">';
		$aff .= '			<tr><td width="100px">Objet du mail</td>';
		$aff .= '				<td  width="800px"><input   class="txt" type="texte" value="' . stripslashes ( $this->myMail_1->getMailObjet () ) . '" name="pubannonceobjet"></td></tr>';
		$aff .= '			<tr><td >Tête du mail</td>';
		$aff .= '				<td >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'pubannoncetete' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_1->getMailTete () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();

		$aff = '</td></tr>';
		$aff .= '			<tr><td>Pied du mail</td>';
		$aff .= '				<td  >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'pubannoncepied' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_1->getMailPied () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td></tr>';
		$aff .= '		</table>';
		$aff .= '</div>';

		// ###

		$aff .= '<div class="slide"><img src="../../include/images/1.png" /><a href="#" class="btn-slide-mail-6">Paramétrage des mails de non publication d\'une offre</a></div>';
		$aff .= '	<div id="mail-6-panel" style="display: none;">';
		$aff .= '		<table  border="1">';
		$aff .= '			<tr><td width="100px">Objet du mail</td>';
		$aff .= '				<td width="800px"><input class="txt" type="texte" value="' . stripslashes ( $this->myMail_2->getMailObjet () ) . '" name="nonpubannonceobjet"></td></tr>';
		$aff .= '			<tr><td >Tête du mail</td>';
		$aff .= '				<td >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'nonpubannoncetete' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_2->getMailTete () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();

		$aff = '</td></tr>';
		$aff .= '			<tr><td>Pied du mail</td>';
		$aff .= '				<td  >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'nonpubannoncepied' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_2->getMailPied () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td></tr>';
		$aff .= '</table>';
		$aff .= '</div>';

		// ###

		$aff .= '<div class="slide"><img src="../../include/images/1.png" /><a href="#" class="btn-slide-mail-4">Paramétrage des mails de publication d\'une candidature</a></div>';
		$aff .= '	<div id="mail-4-panel" style="display: none;">';
		$aff .= '		<table  border="1">';
		$aff .= '			<tr><td width="100px">Objet du mail</td>';
		$aff .= '				<td width="800px"><input class="txt" type="texte" value="' . stripslashes ( $this->myMail_3->getMailObjet () ) . '" name="pubcandobjet"></td></tr>';
		$aff .= '			<tr><td>Tête du mail</td>';
		$aff .= '				<td >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'pubcandtete' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_3->getMailTete () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();

		$aff = '</td></tr>';
		$aff .= '			<tr><td>Pied du mail</td>';
		$aff .= '				<td  >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'pubcandpied' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_3->getMailPied () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td></tr>';
		$aff .= '</table>';
		$aff .= '</div>';

		// ###

		$aff .= '<div class="slide"><img src="../../include/images/1.png" /><a href="#" class="btn-slide-domaine">Paramétrage des mails de non publication d\'une candidature </a></div>';
		$aff .= '	<div id="domaine-panel" style="display: none;">';
		$aff .= '		<table  border="1">';
		$aff .= '			<tr><td width="100px">Objet du mail</td>';
		$aff .= '				<td width="800px"><input class="txt" type="texte" value="' . stripslashes ( $this->myMail_4->getMailObjet () ) . '" name="nonpubcandobjet"></td></tr>';
		$aff .= '			<tr><td>Tête du mail</td>';
		$aff .= '				<td >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'nonpubcandtete' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_4->getMailTete () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();

		$aff = '</td></tr>';
		$aff .= '			<tr><td>Pied du mail</td>';
		$aff .= '				<td  >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'nonpubcandpied' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_4->getMailPied () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td></tr>';
		$aff .= '</table>';
		$aff .= '</div>';

		// ###

		$aff .= '<div class="slide"><img src="../../include/images/1.png" /><a href="#" class="btn-slide-mail-1">Paramétrage des mails de suppression d\'une offre </a></div>';
		$aff .= '	<div id="mail-1-panel" style="display: none;">';
		$aff .= '		<table  border="1">';
		$aff .= '			<tr><td width="100px">Objet du mail</td>';
		$aff .= '				<td width="800px"><input class="txt" type="texte" value="' . stripslashes ( $this->myMail_5->getMailObjet () ) . '" name="suppannonceobjet"></td></tr>';
		$aff .= '			<tr><td>Tête du mail</td>';
		$aff .= '				<td >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'suppannoncetete' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_5->getMailTete () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();

		$aff = '</td></tr>';
		$aff .= '			<tr><td>Pied du Mail</td>';
		$aff .= '				<td  >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'suppannoncepied' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_5->getMailPied () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();

		$aff = '</td></tr>';
		$aff .= '</table>';
		$aff .= '</div>';

		// ###

		$aff .= '<div class="slide"><img src="../../include/images/1.png" /><a href="#" class="btn-slide-mail-2">Paramétrage des mails de suppression d\'une candidature </a></div>';
		$aff .= '	<div id="mail-2-panel" style="display: none;">';
		$aff .= '		<table  border="1">';
		$aff .= '			<tr><td width="100px">Objet du mail</td>';
		$aff .= '				<td width="800px"><input class="txt" type="texte" value="' . stripslashes ( $this->myMail_6->getMailObjet () ) . '" name="suppcandobjet"></td></tr>';
		$aff .= '			<tr><td>Tête du mail</td>';
		$aff .= '				<td >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'suppcandtete' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_6->getMailTete () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();

		$aff = '</td></tr>';
		$aff .= '			<tr><td>Pied du mail</td>';
		$aff .= '				<td  >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'suppcandpied' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_6->getMailPied () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();

		$aff = '</td></tr>';
		$aff .= '</table>';
		$aff .= '</div>';

		// ###

		$aff .= '<div class="slide"><img src="../../include/images/1.png" /><a href="#" class="btn-slide-mail-3">Paramétrage des mails de notification d\'une réponse à l\'offre au candidat</a></div>';
		$aff .= '	<div id="mail-3-panel" style="display: none;">';
		$aff .= '		<table border="1">';
		$aff .= '			<tr><td width="100px">Objet du mail</td>';
		$aff .= '				<td width="800px" ><input class="txt" type="texte" value="' . stripslashes ( $this->myMail_7->getMailObjet () ) . '" name="repoffcandobjet"></td></tr>';
		$aff .= '			<tr><td>Tête du mail</td>';
		$aff .= '				<td >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'repoffcandtete' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_7->getMailTete () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();

		$aff = '</td></tr>';
		$aff .= '			<tr><td>Pied du mail</td>';
		$aff .= '				<td  >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'repoffcandpied' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_7->getMailPied () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();

		$aff = '</td></tr>';
		$aff .= '</table>';
		$aff .= '</div>';

		// ###

		$aff .= '<div class="slide"><img src="../../include/images/1.png" /><a href="#" class="btn-slide-mail-5">Paramétrage des mails de notification d\'une réponse à l\'offre à l\'employé</a></div>';
		$aff .= '	<div id="mail-5-panel" style="display: none;">';
		$aff .= '		<table  border="1">';
		$aff .= '			<tr><td width="100px">Objet du mail</td>';
		$aff .= '				<td width="800px"><input class="txt" type="texte" value="' . stripslashes ( $this->myMail_8->getMailObjet () ) . '" name="repoffempobjet"></td></tr>';
		$aff .= '			<tr><td>Tête du mail</td>';
		$aff .= '				<td >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'repoffemptete' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_8->getMailTete () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();

		$aff = '</td></tr>';
		$aff .= '			<tr><td>Pied du mail</td>';
		$aff .= '				<td  >';
		echo $aff;

		$oFCKeditor = new FCKeditor ( 'repoffemppied' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myMail_8->getMailPied () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$oFCKeditor->ToolbarSet = "Basic";
		$oFCKeditor->Create ();
		$aff = '</td></tr>';
		$aff .= '</table>';
		$aff .= '</div>';

		$aff .= '<br /><input type="submit" value="Mettre à jour"> ';
		$aff .= '</form></div>';

		echo $aff;
	}
	public function redirection($url) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href="' . $url . '";';
		$aff .= '</script>';
		echo $aff;
	}
}

?>