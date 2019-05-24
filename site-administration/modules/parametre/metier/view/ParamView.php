<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage parametre
 * @version 1.0.4
 */
class ParamView {
	private $myParam;

	function __construct($aParam)
	{
		$this->myParam = $aParam;
	}
	function ParamView($aParam) {
		self::__construct($aParam);
	}
	
	// ###############
	function renderHTML($mod) {
		$this->render ( $mod );
	}
	function render($mod) {

		// Navigation bar
		$aff = '<b><a href="../../index.php">Général</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">Param&egrave;tres</a>&nbsp;>&nbsp;';
		switch ($mod) {
			case 'c' :
				$aff .= 'Creation</b><br/><br/>';
				$aff .= '<form method="POST" action="?action=c" name="ParamForm" onsubmit="return checkForm(\'ParamForm\',\'Nom\')">';
				break;
			case 'u' :
				$aff .= 'Edition</b><br/><br/>';
				$aff .= '<form method="POST" action="?action=u&id=' . $this->myParam->getID () . '" name="ParamForm" onsubmit="return checkForm(\'ParamForm\',\'Nom\')">';
				break;
		}

		$aff . '<br/>';
		$aff .= '<table width="800">';

		$aff .= '<tr>';
		$aff .= '<td>Nom</td>';
		$aff .= '<td><input type="text" size="50" name="Nom" value="' . $this->myParam->getName () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Valeur</td>';
		$aff .= '<td><textarea name="Valeur" cols="80" rows="10">' . stripslashes ( $this->myParam->getValue () ) . '</textarea></td>';
		$aff .= '</tr>';

		if ($mod == 'c') {
			$aff .= '<tr>';
			$aff .= '<td>Partager</td>';
			$aff .= '<td><input type="radio" name="partager" value="0" CHECKED/>NON<input type="radio" name="partager" value="1"/>OUI</td>';
			$aff .= '</tr>';
		} else {
			$aff .= '<tr>';
			$aff .= '<td>Partager</td>';
			$aff .= '<td><input type="radio" name="partager" value="0"' . ($this->myParam->getSiteID () != NULL ? ' CHECKED' : '') . '/>NON<input type="radio" name="partager" value="1"' . ($this->myParam->getSiteID () == NULL ? ' CHECKED' : '') . '/>OUI</td>';
			$aff .= '</tr>';
		}

		$aff .= '<tr>';

		if ($mod == 'c') {
			$aff .= '<td colspan="2"><input type="submit" value="Cr&eacute;er"></td>';
		} else if ($mod == 'u') {
			$aff .= '<td colspan="2"><input type="submit" value="Mettre &agrave; Jour"></td>';
		}

		$aff .= '</tr>';
		$aff .= '</table></form>';
		echo $aff;
	}
}
?>