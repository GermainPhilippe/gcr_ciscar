<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage lva
 * @version 1.0.4
 */
class CommissionControler {
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'c' :
				if (! isset ( $_POST ['Nom'] )) {
					$modele = new Commission ();
					$vue = new CommissionView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aCommission = new Commission ();
					$aCommission->setName ( trim ( $_POST ['Nom'] ) );
					$aCommission->setDescription ( trim ( $_POST ['Description'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aCommission->setAnnuaire ( $aAnnuaire );

					$aTypeCommission = new TypeCommission ();
					$aTypeCommission->select_typecommission ( trim ( $_POST ['TypeCommissionID'] ) );
					$aCommission->setTypeCommission ( $aTypeCommission );

					$tmp = $aCommission->getTypeCommission ();
					if ($tmp->getID () == 2) {
						$aCommission2 = new Commission ();
						$aCommission2->select_commission ( trim ( $_POST ['CommissionParentID'] ) );
						$aCommission->setCommissionParent ( $aCommission2 );
					} else {
						$aCommission->setCommissionParent ( NULL );
					}

					$aCommission->create_commission ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'u' :
				if (! isset ( $_POST ['CommissionID'] )) {
					$modele = new Commission ();
					$modele->select_commission ( trim ( $_GET ['id'] ) );
					$vue = new CommissionView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aCommission = new Commission ();
					$aCommission->setID ( trim ( $_POST ['CommissionID'] ) );
					$aCommission->setName ( trim ( $_POST ['Nom'] ) );
					$aCommission->setDescription ( trim ( $_POST ['Description'] ) );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aCommission->setAnnuaire ( $aAnnuaire );

					$aTypeCommission = new TypeCommission ();
					$aTypeCommission->select_typecommission ( trim ( $_POST ['TypeCommissionID'] ) );
					$aCommission->setTypeCommission ( $aTypeCommission );

					$tmp = $aCommission->getTypeCommission ();
					if ($tmp->getID () == 2) {
						$aCommission2 = new Commission ();
						$aCommission2->select_commission ( trim ( $_POST ['CommissionParentID'] ) );
						$aCommission->setCommissionParent ( $aCommission2 );
					} else {
						$aCommission->setCommissionParent ( NULL );
					}

					$aCommission->update_commission ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'd' :
				if (isset ( $_GET ['id'] )) {
					$aCommission = new Commission ();
					$aCommission->setID ( $_GET ['id'] );
					$aCommission->remove_commission ();

					echo CommunFunction::goToURL ( '?' );
				}
				break;
		}
	}
}
?>