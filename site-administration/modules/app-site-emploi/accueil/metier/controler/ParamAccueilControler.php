<?php
/**
 * Controleur permettant l'édition des paramètres disponibles dans la vue "Accueil"
 *  @author Alexandre Diallo
 *  @author Quentin BRISSON
 * @package app-site-emploi
 * @subpackage accueil
 * @version 1.0.4
 */
class ParamMailControler {
	public function __construct() {
	}
	/**
	 * $_GET['action']=?
	 *
	 * 'edit' met à jour les différents paramètres
	 * défaut : affiche les paramètres enregistrés
	 */
	public function run() {
		switch ($_GET ['action']) {

			case 'edit' :
				if (isset ( $_POST ['paramemploirenault'] )) {
					$adoc = new ParamMailPubOffre ();
					$adoc->setidaccueil ( $_POST ['idaccueil'] );
					$adoc->setparamemploirenault ( $_POST ['paramemploirenault'] );

					$adoc->setparampictpartenaireacc ( $_POST ['parampictpartenaireacc'] );
					$adoc->setparampictpartenairecand ( $_POST ['parampictpartenairecand'] );
					$adoc->setparampictpartenaireconcess ( $_POST ['parampictpartenaireconcess'] );

					$adoc->setparamconcess ( $_POST ['paramconcess'] );
					$adoc->setparamcandidat ( $_POST ['paramcandidat'] );
					$adoc->setparamlienconcession ( $_POST ['paramlienconcession'] );

					$adoc->setparamliencandidat ( $_POST ['paramliencandidat'] );
					$adoc->setparamlibelleco1 ( $_POST ['paramlibelleco1'] );
					$adoc->setparamlibelleco2 ( $_POST ['paramlibelleco2'] );

					$adoc->setparamlibelleca1 ( $_POST ['paramlibelleca1'] );
					$adoc->setparamlibelleca2 ( $_POST ['paramlibelleca2'] );
					$adoc->setparamlienpublicite ( $_POST ['paramlienpublicite'] );

					$adoc->setparamaffichecompteur ( $_POST ['paramaffichecompteur'] );
					$adoc->setparamhtmlmetakeyacc ( $_POST ['paramhtmlmetakeyacc'] );
					$adoc->setparamhtmlmetakeyconcess ( $_POST ['paramhtmlmetakeyconcess'] );

					$adoc->setparamhtmlmetakeycand ( $_POST ['paramhtmlmetakeycand'] );

					$adoc->sql_update_param_mail ();
					echo "enregistrement réussi";
				} else {
					$modele = new ParamMailPubOffre ();
					$modele->sql_select_param_mail ();
					$aView = new ParamMailView ( $modele );
					$aView->render ();
				}
				break;
		}
	}
}

?>