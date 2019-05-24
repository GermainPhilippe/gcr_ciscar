<?php
/**
 * @author Philippe GERMAIN
 * @package site-administration
 * @subpackage prestashop
 * @version 1.0.4
 */
class PrestashopControler {
	public function __construct() {
	}

	// ###
	public function run($individuID) {
		// ob_start (); // avant toute chose
		// header ( "Refresh: 0; http://ciscar.local/admin/modules/individu/?action=edit&id=17767");
		// ob_flush ();
		$aIndividuAnnuaire = new IndividuAnnuaire ();
		if ($individuID != 0)
			$aIndividuAnnuaire->SQL_SELECT_INDIVIDU_BY_ID ( $individuID );

		if ($aIndividuAnnuaire->getIndividuID () != 0) {
			$aPrestaShopCustomer = new PrestaShopCustomer ();
			$aPrestaShopCustomer->SQL_SELECT_CUSTOMER_BY_ID ( $aIndividuAnnuaire->getIndividuID () );
			if ($aPrestaShopCustomer->getIdCustomer () == $individuID) {
				$aPrestaShopCustomer->SQL_SELECT_CUSTOMER_BY_ID_EMAIL ( $aIndividuAnnuaire->getIndividuID (), $aIndividuAnnuaire->getIndividuMail () );
				if ($aPrestaShopCustomer->getIdCustomer () == $individuID) {
					$aPrestaShopCustomer->SQL_UPDATE_CUSTOMER_BY_ID ( $aIndividuAnnuaire );
					// on supprime les adresses du client
					$aPrestashopAdresses = new PrestaShopAdresses ();
					$aPrestashopAdresses->SQL_DELETE_ADRESSES_FROM_CUSTOMER_ID ( $aIndividuAnnuaire->getIndividuID () );
					// on ajoute les adresses de l'annuaire ciscar
					$aEtablissementListe = new EtablissementListe ();
					$aEtablissementListe->select_all_etablissements_by_individu_id ( $aIndividuAnnuaire->getIndividuID () );
					// on resenseigne toutes les adresses de l'individu dans prestashop
					foreach ( $aEtablissementListe->getEtablissementListe () as $aEtablissement ) {
						$aPrestaShopCustomer->SQL_INSERT_CUSTOMER_ADRESSES_BY_ID ( $aEtablissement, $aIndividuAnnuaire );
					}
					$result = '<span style="color:green;font-weight:bold;">Mise à jour enregistrée aves succès :</span>
							<br><span style="font-weight:bold;">Nom : </span>' . $aIndividuAnnuaire->getIndividuNom () . '
							<br><span style="font-weight:bold;">Mail : </span>' . $aIndividuAnnuaire->getIndividuMail () . '
							<br><span style="font-weight:bold;">Id: </span>' . $aIndividuAnnuaire->getIndividuID ();
				} else
					$result = '<span style="color:red;font-weight:bold;">Mise à jour impossibe : Le mail ne correspond pas à l\'ID</span>
							<br><span style="font-weight:bold;">Nom : </span>' . $aIndividuAnnuaire->getIndividuNom () . '
							<br><span style="font-weight:bold;">Mail ciscar.fr : </span>' . $aIndividuAnnuaire->getIndividuMail () . '
							<br><span style="font-weight:bold;">Mail ciscar.net : </span>' . $aPrestaShopCustomer->getEmail () . '
							<br><span style="font-weight:bold;">Id: </span>' . $aIndividuAnnuaire->getIndividuID ();
			} else {
				$aPrestaShopCustomer->SQL_SELECT_CUSTOMER_BY_EMAIL ( $aIndividuAnnuaire->getIndividuMail () );
				if ($aPrestaShopCustomer->getIdCustomer () > 0) {
					if (! $aPrestaShopCustomer->getDeleted ()) {
						if (! $aPrestaShopCustomer->getActive ()) {
							$aPrestaShopCustomer->SQL_DELETE_CUSTOMER_BY_ID ( $aPrestaShopCustomer->getIdCustomer () );
							$aPrestaShopCustomer->SQL_DESACTIVE_AUTO_INCREMENT ( 'ps_customer', 'id_customer' );
							$aPrestaShopCustomer->SQL_INSERT_CUSTOMER ( $aIndividuAnnuaire, $aPrestaShopCustomer );
							$aPrestaShopCustomer->SQL_ACTIVE_AUTO_INCREMENT ( 'ps_customer', 'id_customer' );

							// on supprime les adresses du client
							$aPrestashopAdresses = new PrestaShopAdresses ();
							$aPrestashopAdresses->SQL_DELETE_ADRESSES_FROM_CUSTOMER_ID ( $aPrestaShopCustomer->getIdCustomer () );
							// on ajoute les adresses de l'annuaire ciscar
							$aEtablissementListe = new EtablissementListe ();
							$aEtablissementListe->select_all_etablissements_by_individu_id ( $aIndividuAnnuaire->getIndividuID () );
							// on resenseigne toutes les adresses de l'individu dans prestashop
							foreach ( $aEtablissementListe->getEtablissementListe () as $aEtablissement ) {
								$aPrestaShopCustomer->SQL_INSERT_CUSTOMER_ADRESSES_BY_ID ( $aEtablissement, $aIndividuAnnuaire );
							}

							$result = '<span style="color:green;font-weight:bold;">Remplacement effectué avec succés.</span>
							<br><span style="font-weight:bold;">Nom : </span>' . $aIndividuAnnuaire->getIndividuNom () . '
							<br><span style="font-weight:bold;">Mail : </span>' . $aIndividuAnnuaire->getIndividuMail () . '
							<br><span style="font-weight:bold;">Id ciscar.net : </span>' . $aPrestaShopCustomer->getIdCustomer () . '
							<span style="color:green;"> remplacé par </span>
							<span style="font-weight:bold;">Id ciscar.fr : </span>' . $aIndividuAnnuaire->getIndividuID ();
						} else
							$result = '<span style="color:red;font-weight:bold;">Remplacement impossible : L\'utilisateur est actif.</span>
							<br><span style="font-weight:bold;">Nom : </span>' . $aIndividuAnnuaire->getIndividuNom () . '
							<br><span style="font-weight:bold;">Mail : </span>' . $aIndividuAnnuaire->getIndividuMail () . '
							<br><span style="font-weight:bold;">Id ciscar.net: </span>' . $aPrestaShopCustomer->getIdCustomer ();
					} else
						$result = '<span style="color:red;font-weight:bold;">Remplacement impossible : L\'utilisateur est supprimé.</span>
						<br><span style="font-weight:bold;">Nom : </span>' . $aIndividuAnnuaire->getIndividuNom () . '
						<br><span style="font-weight:bold;">Mail : </span>' . $aIndividuAnnuaire->getIndividuMail () . '
						<br><span style="font-weight:bold;">Id ciscar.net: </span>' . $aPrestaShopCustomer->getIdCustomer ();
				} else {
					if ($aPrestaShopCustomer->getIdCustomer () == 0) {
						$aPrestaShopCustomer->SQL_DESACTIVE_AUTO_INCREMENT ( 'ps_customer', 'id_customer' );
						$aPrestaShopCustomer->SQL_INSERT_CUSTOMER_BY_EMAIL ( $aIndividuAnnuaire );
						$aPrestaShopCustomer->SQL_ACTIVE_AUTO_INCREMENT ( 'ps_customer', 'id_customer' );

						// on recherche la liste des établissement de l'individu
						$aEtablissementListe = new EtablissementListe ();
						$aEtablissementListe->select_all_etablissements_by_individu_id ( $aIndividuAnnuaire->getIndividuID () );
						// on resenseigne toutes les adresses de l'individu dans prestashop
						foreach ( $aEtablissementListe->getEtablissementListe () as $aEtablissement ) {
							$aPrestaShopCustomer->SQL_INSERT_CUSTOMER_ADRESSES_BY_ID ( $aEtablissement, $aIndividuAnnuaire );
						}

						$result = '<span style="color:green;font-weight:bold;">Création réalisée avec succès.</span>
						<br><span style="font-weight:bold;">Nom : </span>' . $aIndividuAnnuaire->getIndividuNom () . '
						<br><span style="font-weight:bold;">Mail : </span>' . $aIndividuAnnuaire->getIndividuMail () . '
						<br><span style="font-weight:bold;">Id ciscar.net: </span>' . $aIndividuAnnuaire->getIndividuID ();
					} else {
						print 'Création impossible : Plusieurs individus utilisent cet email.';
						$result = '<span style="color:red;font-weight:bold;">Création impossible : Plusieurs individus utilisent cet email.</span>
						<br><span style="font-weight:bold;">Mail : </span>' . $aIndividuAnnuaire->getIndividuMail ();
					}
				}
			}
			$aPrestaShopView = new PrestaShopView ();
			$aPrestaShopView->render ( $result );
		}
	}
}
?>
