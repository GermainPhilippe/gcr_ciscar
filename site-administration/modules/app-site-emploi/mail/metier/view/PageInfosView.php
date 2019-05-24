<?php
/**
 * Vue d'une page info
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 */
class PageInfosView {
	private $myVerif;
	public function __construct($aVerif) {
		$this->myVerif = $aVerif;
	}
	/**
	 *
	 * rendu du style de la vue
	 *
	 * @return string
	 */
	public function renderstyle() {
		$aff = '<style>';
		$aff .= 'table {width:100%;}';
		$aff .= 'textarea {width:100%;}';
		$aff .= '.contenu {width:100%;height:200px;}';
		$aff .= '.titre {width:100%;}';
		$aff .= '</style>';

		return $aff;
	}
	/**
	 *
	 * rendu de la vue (vision,edition ou suppression
	 *
	 * @param string $mod
	 */
	public function renderHTML($mod) {
		$aff = $this->renderstyle ();

		if ($mod == 'editpage' or $mod == 'deletepage') {

			switch ($mod) {
				case 'editpage' :

					$aff = '<div id="FilAriane" ><b><a href="../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;<a href="index.php">';
					$aff .= '<a href="?action=infos">Liste des pages d\'informations</a>&nbsp;>&nbsp;';
					$aff .= 'Editer une page</b></div><br /><br />';

					$aff .= '<form method="POST" onsubmit="return(verif())" action="?action=editpage&id=' . $this->myVerif->getidpageinfo () . '">';
					$aff .= '<input type="submit"  value="Mettre à jour"><br />';
					break;
				case 'deletepage' :

					$aff = '<b><a href="../../index.php?menu=4">Admin</a>&nbsp;>&nbsp;<a href="index.php">';
					$aff .= '<a href="?action=infos">Liste des pages d\'informations</a>&nbsp;>&nbsp;';
					$aff .= 'Supprimer une page</b><br /><br />';

					$aff .= '<form method="POST" action="?action=deletepage&id=' . $this->myVerif->getidpageinfo () . '">';
					$aff .= '<input type="text" name="idpageinfo" style="display:none" value="' . $this->myVerif->getidpageinfo () . '">';
					$aff .= '<input type="submit" value="Supprimer"><br />';
					break;
			}

			$aff .= '<br /><table width="100%" border="1">';

			$aff .= '<tr>';
			$aff .= '	<td>Espace</td>';
			if ($this->myVerif->getespace () == 1) {
				$aff .= '	<td>Concessionnaire <input type="radio" value="1" checked name="espace">';
				$aff .= '		Candidat <input type="radio" value="0" name="espace"></td>';
			} else {
				$aff .= '	<td>Concessionnaire <input type="radio" value="1" name="espace">';
				$aff .= '		Candidat <input type="radio" value="0" checked name="espace"></td>';
			}
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '	<td>Afficher</td>';
			if ($this->myVerif->getaffichage () == 1) {
				$aff .= '	<td>Oui <input type="radio" value="1" checked name="affichage">';
				$aff .= '		Non <input type="radio" value="0" name="affichage"></td>';
			} else {
				$aff .= '	<td>Oui <input type="radio" value="1" name="affichage">';
				$aff .= '		Non <input type="radio" value="0" checked name="affichage"></td>';
			}
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '	<td>Titre *</td>';
			$aff .= '	<td><input type="texte" id="titre" value="' . $this->myVerif->gettitre () . '" name="titre"></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '	<td>Meta Tags</td>';
			$aff .= '	<td><textarea style="width:600;height:100" name="metatag">' . $this->myVerif->getmetatag () . '</textarea></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '	<td>Contenu</td>';
			$aff .= '	<td>';

			echo $aff;
			include_once ("../../include/js/fckeditor/fckeditor.php");

			$oFCKeditor = new FCKeditor ( 'contenu' );
			$oFCKeditor->BasePath = '../../include/js/fckeditor/';
			$oFCKeditor->Value = stripslashes ( $this->myVerif->getcontenu () );
			$oFCKeditor->Width = '100%';
			$oFCKeditor->Height = '512';
			$oFCKeditor->ToolbarSet = 'Emploi';
			$oFCKeditor->Create ();
			$aff = '</td>';

			$aff .= '</tr>';
			$aff .= '</table><br />';

			switch ($mod) {
				case 'editpage' :
					$aff .= '<tr><td><input type="submit" value="Mettre à jour"></td></tr>';
					break;
				case 'deletepage' :
					$aff .= '<tr><td><input type="submit" value="Supprimer"></td></tr>';
					break;
			}
		} else {
			$aff .= '<div id="FilAriane" ><b><a href="../../index.php?menu=4">Admin</a>&nbsp;>&nbsp;<a href="index.php">';
			$aff .= '<a href="?action=infos">Liste des pages d\'informations</a>&nbsp;>&nbsp;';
			$aff .= '<a href="#">Nouvelle page d\'information</a></b></div><br /><br />';
			// $aff.= '<input type="button" value="Retour" onclick="javascript:history.back()" /><br/><br/>';
			$aff .= '<form method="POST" onsubmit="return(verif())"  action="?action=newpage">';
			$aff .= '<input type="submit" value="Créer"><br />';
			$aff .= '<table width="500px" border="1">';

			$aff .= '<tr>';
			$aff .= '	<td>Espace</td>';
			$aff .= '	<td>Concessionnaire <input type="radio" value="1" checked name="espace">';
			$aff .= '		Candidat <input type="radio" value="0" name="espace"></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '	<td>Affichage</td>';
			$aff .= '	<td>Oui <input type="radio" value="1" checked name="affichage">';
			$aff .= '		Non <input type="radio" value="0" name="affichage"></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '	<td>Titre *</td>';
			$aff .= '	<td><input id="titre" type="texte" name="titre"></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '	<td>Meta Tags</td>';
			$aff .= '	<td><textarea style="width:600;height:100" name="metatag"></textarea></td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '	<td>Contenu</td>';
			$aff .= '	<td>';

			echo $aff;
			include_once ("../../include/js/fckeditor/fckeditor.php");

			$oFCKeditor = new FCKeditor ( 'contenu' );
			$oFCKeditor->BasePath = '../../include/js/fckeditor/';
			$oFCKeditor->Width = '100%';
			$oFCKeditor->Height = '512';
			$oFCKeditor->ToolbarSet = 'Emploi';
			$oFCKeditor->Create ();
			$aff = '</td>';
			$aff .= '</tr>';
			$aff .= '</table>';

			$aff .= '<br /><tr><td><input  type="submit" value="Créer"></td></tr>';
		}

		$aff .= '</form>';

		$aff .= '<script>	function verif()
									{	 				
										if (document.getElementById(\'titre\').value == "")
										{
											alert(\'Vous devez indiquer un Titre\');											
											return false;
										}
								 }
										</script>';
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