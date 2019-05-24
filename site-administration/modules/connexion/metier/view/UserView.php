<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage connexion
 * @version 1.0.4
 */
class UserView {
	private $myUser;

	function __construct($aUser)
	{
		$this->myUser = $aUser;
	}
	function UserView($aUser) {
		self::__construct($aUser);
	}

	// #############
	function render() {
		// Navigation bar
		$aff = '<b><a href="index.php">Admin</a>&nbsp;>&nbsp;<a href="index.php">';
		$aff .= '<a href="index.php">Connexion</a></b><br/><br/>';

		// Formulaire

		$aff .= '<form method="POST" action="?">';

		$aff .= '<table width="800">';

		$aff .= '<tr>';
		$aff .= '<td>Nom utilisateur</td>';
		$aff .= '<td><input type="text" name="Login" value=""/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Mot de passe</td>';
		$aff .= '<td><input type="password" name="Password" value=""/></td>';
		$aff .= '</tr>';

		$aff .= '<tr style="display:none;">';
		$aff .= '<td>Site</td>';
		$aff .= '<td>';
		if (isset ( $_SESSION ['SITE'] ['ID'] )) {
			$aff .= '<input type="hidden" name="SiteID" value="' . $_SESSION ['SITE'] ['ID'] . '"/>';
		}
		$aff .= '	<select' . (isset ( $_SESSION ['SITE'] ['ID'] ) ? ' disabled' : ' name="SiteID"') . '>';
		$aff .= '		<option value="1"' . (isset ( $_SESSION ['SITE'] ['ID'] ) && $_SESSION ['SITE'] ['ID'] == '1' ? 'SELECTED=SELECTED' : '') . '>CISCAR</option>';
		$aff .= '		<option value="2"' . (isset ( $_SESSION ['SITE'] ['ID'] ) && $_SESSION ['SITE'] ['ID'] == '2' ? 'SELECTED=SELECTED' : '') . '>GCR</option>';
		$aff .= '		<option value="3"' . (isset ( $_SESSION ['SITE'] ['ID'] ) && $_SESSION ['SITE'] ['ID'] == '3' ? 'SELECTED=SELECTED' : '') . '>ACNF</option>';
		$aff .= '		<option value="7"' . (isset ( $_SESSION ['SITE'] ['ID'] ) && $_SESSION ['SITE'] ['ID'] == '7' ? 'SELECTED=SELECTED' : '') . '>GCRE</option>';
		$aff .= '	</select>';
		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td colspan="2"><input type="submit" value="OK"></td>';
		$aff .= '</tr>';

		$aff .= '</table></form>';
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