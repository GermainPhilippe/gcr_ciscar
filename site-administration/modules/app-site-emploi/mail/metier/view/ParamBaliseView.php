<?php
/**
 * Vue du paramétrage des balises
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 */
class ParamBaliseView {
	private $myParamBalise;
	public function __construct($aParamBalise) {
		$this->myParamBalise = $aParamBalise;
	}
	public function renderstyle() {
		$aff = '<style>';
		$aff .= '';
		$aff .= 'textarea {width:100%;height:150px;}';
		$aff .= '';
		$aff .= '</style>';

		return $aff;
	}
	/**
	 *
	 * rendu du style de la vue
	 *
	 * @return string
	 */
	public function renderscript() {
		$aff = '<script src="../../include/js/jquery/jquery-1.4.2.js"></script>';
		return $aff;
	}

	/**
	 * rendu de la vue
	 */
	public function render() {
		$aff = $this->renderstyle ();
		$aff .= $this->renderscript ();

		$aff .= '<div id="FilAriane" ><a href="../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?action=balise">Paramétrage des balises </a></div><br /><br />';

		$aff .= '<form method="POST" action="?action=balise">';

		$aff .= '<table border=1>';
		$aff .= '<tr><td>Balise titre des pages</td>';
		$aff .= '<td class="droite"><textarea rows=7 cols=100 name="paramtitrepage">' . $this->myParamBalise->getparamtitrepage () . '</textarea></td></tr>';
		$aff .= '<tr><td>Balise méta description de la page d\'accueil</td>';
		$aff .= '<td><textarea rows=7 cols=100 value="" name="paramhtmlmetadescacc">' . $this->myParamBalise->getparamhtmlmetadescacc () . '</textarea></td></tr>';
		$aff .= '<tr><td>Balise méta robot de la page d\'accueil</td>';
		$aff .= '<td><textarea rows=7 cols=100 value="" name="paramhtmlmetarobotacc">' . $this->myParamBalise->getparamhtmlmetarobotacc () . '</textarea></td></tr>';
		$aff .= '<tr><td>Balise méta mots-clés de la page d\'accueil</td>';
		$aff .= '<td><textarea rows=7 cols=100 value="" name="paramhtmlmetakeyacc">' . $this->myParamBalise->getparamhtmlmetakeyacc () . '</textarea></td></tr>';
		$aff .= '<tr><td>Balise méta description de l\'espace concessionnaire</td>';
		$aff .= '<td><textarea rows=7 cols=100 value="" name="paramhtmlmetadescconcess">' . $this->myParamBalise->getparamhtmlmetadescconcess () . '</textarea></td></tr>';
		$aff .= '<tr><td>Balise méta robot de l\'espace concessionnaire</td>';
		$aff .= '<td><textarea rows=7 cols=100 value="" name="paramhtmlmetarobotconcess">' . $this->myParamBalise->getparamhtmlmetarobotconcess () . '</textarea></td></tr>';
		$aff .= '<tr><td>Balise méta mots-clés de l\'espace concessionnaire</td>';
		$aff .= '<td><textarea rows=7 cols=100 value="" name="paramhtmlmetakeyconcess">' . $this->myParamBalise->getparamhtmlmetakeyconcess () . '</textarea></td></tr>';
		$aff .= '<tr><td>Balise méta description de l\'espace candidats</td>';
		$aff .= '<td><textarea rows=7 cols=100 value="" name="paramhtmlmetadesccand">' . $this->myParamBalise->getparamhtmlmetadesccand () . '</textarea></td></tr>';
		$aff .= '<tr><td>Balise méta robot de l\'espace candidat</td>';
		$aff .= '<td><textarea rows=7 cols=100 value="" name="paramhtmlmetarobotcand">' . $this->myParamBalise->getparamhtmlmetarobotcand () . '"</textarea></td></tr>';
		$aff .= '<tr><td>Balise méta mots-clés de l\'espace candidat</td>';
		$aff .= '<td><textarea rows=7 cols=100 value="" name="paramhtmlmetakeycand">' . $this->myParamBalise->getparamhtmlmetakeycand () . '</textarea></td></tr>';
		$aff .= '<tr><td>Balise de première ligne</td>';
		$aff .= '<td><textarea rows=7 cols=100 value="" name="paramh1acc1">' . $this->myParamBalise->getparamh1acc1 () . '</textarea></td></tr>';
		$aff .= '<tr><td>Balise de deuxième ligne</td>';
		$aff .= '<td><textarea rows=7 cols=100 value="" name="paramh2acc2">' . $this->myParamBalise->getparamh2acc2 () . '</textarea></td></tr>';
		$aff .= '<tr><td>Nom du site</td>';
		$aff .= '<td><textarea rows=7 cols=100 value="" name="nomsite">' . $this->myParamBalise->getnomsite () . '</textarea></td></tr>';
		$aff .= '</table>';

		$aff .= '<br /><input type="submit" value="Mettre à jour">';
		$aff .= '</form>';

		echo $aff;
	}
	public function redirection($url) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href="' . $url . '";';
		$aff .= '</script>';
		echo $aff;
	}
}