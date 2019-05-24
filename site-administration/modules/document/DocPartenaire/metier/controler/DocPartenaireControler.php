<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class DocPartenaireControler {
	public function __construct() {
	}
	public function run() {
		switch ($_GET ['action']) {
			case 'new' :
				if (isset ( $_POST ['Nom'] )) {
					$aModele = new DocPartenaire ();
					$aModele->setNom ( trim ( $_POST ['Nom'] ) );
					$aModele->setAdresse ( trim ( $_POST ['Adresse'] ) );
					$aModele->setCodePostal ( trim ( $_POST ['CodePostal'] ) );
					$aModele->setBureauDistributeur ( trim ( $_POST ['BureauDistributeur'] ) );
					$aModele->setVille ( trim ( $_POST ['Ville'] ) );
					$aModele->setTelephone ( trim ( $_POST ['Telephone'] ) );
					$aModele->setFax ( trim ( $_POST ['Fax'] ) );
					$aModele->setMail ( trim ( $_POST ['EMail'] ) );
					$aModele->setNomContact ( trim ( $_POST ['Interlocuteur'] ) );
					$aModele->setLogoURLSmall ( trim ( $_POST ['PetitLogo'] ) );
					$aModele->setLogoURLBig ( trim ( $_POST ['GrandLogo'] ) );
					$aModele->setLogoPosition ( trim ( $_POST ['PositionLogo'] ) );
					$aModele->setMailContact ( trim ( $_POST ['EmailContact'] ) );
					$aModele->setURL ( trim ( $_POST ['URLSitePartenaire'] ) );
					$aModele->setPublication ( trim ( $_POST ['Actif'] ) );
					$aModele->setSiteID ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aModele->SQL_create ();

					echo CommunFunction::goToURL ( '?' );
				} else {
					$aModele = new DocPartenaire ();
					$aView = new DocPartenaireView ( $aModele );
					$aView->render ( 'new' );
				}
				break;
			case 'edit' :
				if (isset ( $_POST ['Nom'] )) {
					$aModele = new DocPartenaire ();
					$aModele->setID ( trim ( $_GET ['id'] ) );
					$aModele->setNom ( trim ( $_POST ['Nom'] ) );
					$aModele->setAdresse ( trim ( $_POST ['Adresse'] ) );
					$aModele->setCodePostal ( trim ( $_POST ['CodePostal'] ) );
					$aModele->setBureauDistributeur ( trim ( $_POST ['BureauDistributeur'] ) );
					$aModele->setVille ( trim ( $_POST ['Ville'] ) );
					$aModele->setTelephone ( trim ( $_POST ['Telephone'] ) );
					$aModele->setFax ( trim ( $_POST ['Fax'] ) );
					$aModele->setMail ( trim ( $_POST ['EMail'] ) );
					$aModele->setNomContact ( trim ( $_POST ['Interlocuteur'] ) );
					$aModele->setLogoURLSmall ( trim ( $_POST ['PetitLogo'] ) );
					$aModele->setLogoURLBig ( trim ( $_POST ['GrandLogo'] ) );
					$aModele->setLogoPosition ( trim ( $_POST ['PositionLogo'] ) );
					$aModele->setMailContact ( trim ( $_POST ['EmailContact'] ) );
					$aModele->setURL ( trim ( $_POST ['URLSitePartenaire'] ) );
					$aModele->setPublication ( trim ( $_POST ['Actif'] ) );
					$aModele->setSiteID ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aModele->SQL_update ();

					echo CommunFunction::goToURL ( '?' );
				} else {
					if (isset ( $_GET ['id'] )) {
						$aModele = new DocPartenaire ();
						$aModele->SQL_selection ( $_GET ['id'] );
						$aView = new DocPartenaireView ( $aModele );
						$aView->render ( 'edit' );
					}
				}
				break;
			case 'delete' :
				if (isset ( $_GET ['id'] )) {
					$aModele = new DocPartenaire ();
					$aModele->setID ( $_GET ['id'] );
					$aModele->SQL_delete ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>