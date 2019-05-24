<?php
class ParamAccueilView {
	private $myParamAccueil;
	public function __construct($aParamAccueil) {
		$this->myParamAccueil = $aParamAccueil;
	}
	public function renderstyle() {
		$aff = '<style>';
		$aff .= 'textarea {width:600px;height:100px;}';
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
		$aff .= '<script type="text/javascript" src="../../modules/app-convention/include/js/tiny_mce/tiny_mce.js"></script>';

		return $aff;
	}
	/**
	 * rendu de la vue
	 */
	public function render() {
		$aff = $this->renderstyle ();
		$aff .= $this->renderscript ();

		$aff .= '<div id="FilAriane"><a href="../../?menu=4">Site Emploi</a>&nbsp;>&nbsp;Paramétrage de l\'accueil</div><br /><br />';

		$aff .= '<form method="post" name="SiteEmploiParamAccueil">';

		$aff .= '	<table width="80%" border="1" id="TableList">';
		$aff .= '		<tr ><td >Emploi dans le réseau Renault</td>';
		$aff .= '		<td><textarea id="paramemploirenault" name="paramemploirenault">' . $this->myParamAccueil->getparamemploirenault () . '</textarea></td></tr>';

		$aff .= '		<tr><td>Nos partenaires sur l\'accueil</td>';
		$aff .= '		<td><textarea id="parampictpartenaireacc" name="parampictpartenaireacc">' . $this->myParamAccueil->getparampictpartenaireacc () . '</textarea></td></tr>';

		$aff .= '		<tr><td>Nos partenaires sur l\'espace candidat</td>';
		$aff .= '		<td><textarea id="parampictpartenairecand" name="parampictpartenairecand">' . $this->myParamAccueil->getparampictpartenairecand () . '</textarea></td></tr>';

		$aff .= '		<tr><td>Nos partenaires sur l\'espace concessionnaire</td>';
		$aff .= '		<td><textarea id="parampictpartenaireconcess" name="parampictpartenaireconcess">' . $this->myParamAccueil->getparampictpartenaireconcess () . '</textarea></td></tr>';

		$aff .= '		<tr><td>Encart de concessionnaire dans la page d\'accueil</td>';
		$aff .= '		<td><textarea id="paramconcess" name="paramconcess">' . $this->myParamAccueil->getparamconcess () . '</textarea></td></tr>';

		$aff .= '		<tr><td>Encart de candidat dans la page d\'accueil</td>';
		$aff .= '		<td><textarea id="paramcandidat" name="paramcandidat">' . $this->myParamAccueil->getparamcandidat () . '</textarea></td></tr>';

		$aff .= '		<tr><td>Lien par défaut vers l\'espace concessionnaire</td>';
		$aff .= '		<td><input style="width:600px;" type="texte" id="paramlienconcession" name="paramlienconcession" value="' . $this->myParamAccueil->getparamlienconcession () . '"></td></tr>';

		$aff .= '		<tr><td>Lien par défaut vers l\'espace candidat</td>';
		$aff .= '		<td><input style="width:600px;" type="texte" id="paramliencandidat" name="paramliencandidat" value="' . $this->myParamAccueil->getparamliencandidat () . '"></td></tr>';

		$aff .= '		<tr><td>Libelle de la rubrique n°1 de concessionnaire</td>';
		$aff .= '		<td><input style="width:600px;" type="texte" id="paramlibelleco1" name="paramlibelleco1" value="' . $this->myParamAccueil->getparamlibelleco1 () . '"></td></tr>';

		$aff .= '		<tr><td>Libelle de la rubrique n°2 de concessionnaire</td>';
		$aff .= '		<td><input style="width:600px;" type="texte" id="paramlibelleco2" name="paramlibelleco2" value="' . $this->myParamAccueil->getparamlibelleco2 () . '"></td></tr>';

		$aff .= '		<tr><td>Libelle de la rubrique n°1 de candidat</td>';
		$aff .= '		<td><input style="width:600px;" type="texte" id="paramlibelleca1" name="paramlibelleca1" value="' . $this->myParamAccueil->getparamlibelleca1 () . '"></td></tr>';

		$aff .= '		<tr><td>Libelle de la rubrique n°2 de candidat</td>';
		$aff .= '		<td><input style="width:600px;" type="texte" id="paramlibelleca2" name="paramlibelleca2" value="' . $this->myParamAccueil->getparamlibelleca2 () . '"></td></tr>';

		$aff .= '		<tr><td>Lien du bandeau publicitaire</td>';
		$aff .= '		<td><input style="width:600px;" type="texte" id="paramlienpublicite" name="paramlienpublicite" value="' . $this->myParamAccueil->getparamlienpublicite () . '"></td></tr>';

		$aff .= '		<tr><td>Affichage des compteurs</td>';
		if ($this->myParamAccueil->getparamaffichecompteur () == 1) {
			$aff .= '		<td>oui <input type="radio" value="1" name="paramaffichecompteur" checked><br />';
			$aff .= '		non <input type="radio" value="0" name="paramaffichecompteur"></td></tr>';
		} else {
			$aff .= '		<td>oui <input type="radio" value="1" name="paramaffichecompteur"><br />';
			$aff .= '		non <input type="radio" value="0" name="paramaffichecompteur" checked></td></tr>';
		}
		$aff .= ' 	</table>';

		$aff .= '<input type="button" value="Enregistrer" onclick="Form.SiteEmploiParamAccueil.btEnregistrer()" /> ';
		$aff .= '<input type="button" value="Enregistrer et Fermer" onclick="Form.SiteEmploiParamAccueil.btEnregistrerEtFermer()"/>';
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

?>