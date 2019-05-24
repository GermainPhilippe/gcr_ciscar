<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage role
 * @version 1.0.4
 */
class RoleControler implements DefaultControler {
	public function __construct() {
	}
	function run() {
		switch ($_GET ['action']) {
			// Creer un User
			case 'new' :
			case 'c' :
				if (! isset ( $_POST ['EtablissementID'] )) {
					$modele = new Role ();

					$aIndividu = new Individu ();
					$aIndividu->select_individu ( trim ( $_GET ['idi'] ) );
					$modele->setIndividu ( $aIndividu );

					$aEtablissement = new Etablissement ();
					$aEtablissement->select_etablissement ( trim ( $_GET ['id'] ) );
					$modele->setEtablissement ( $aEtablissement );

					$vue = new RoleView ( $modele );
					$vue->render ( 'c' );
				} else {
					$aRole = new Role ();

					$aIndividu = new Individu ();
					$aIndividu->select_individu ( trim ( $_GET ['idi'] ) );
					$aRole->setIndividu ( $aIndividu );

					$aEtablissement = new Etablissement ();
					$aEtablissement->select_etablissement ( trim ( $_GET ['id'] ) );
					$aRole->setEtablissement ( $aEtablissement );

					$aAnnuaire = new Annuaire ();
					$aAnnuaire->select_annuaire ( trim ( $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
					$aRole->setAnnuaire ( $aAnnuaire );

					$aRole->create_role ();
					$roleID = mysqli_insert_id ($_SESSION['LINK']);

					// Role Domaine Activite Fonction
					$aDomaineActiviteFonction = new DomaineActiviteFonction ();
					$aDomaineActiviteFonction->setRoleID ( $roleID );
					$aDomaineActiviteFonction->setDomaineActiviteID ( trim ( $_POST ['DomainActiviteID'] ) );
					$aDomaineActiviteFonction->setFonctionDAID ( trim ( $_POST ['FonctionDAID'] ) );
					$aDomaineActiviteFonction->SQL_CREATE ();
					
					// on verifie si l'individu a un role principale valide
					$aRole->select_verif_rolePrincipal ( $aIndividu->getLieuTravailID (), $_GET ['idi'] );
					$rolePrincipal = $aRole->getLieuTravailID ();

					// si l'individu n'a pas de lieu de travail principal on renseigne le nouveau rôle comme lieu de travail
					if ($rolePrincipal == 0) {
						$aRole->select_rolePrincipal ( $roleID );
						$rolePrincipal = $aRole->getLieuTravailID ();
						if ($rolePrincipal == 0) {
							$LoginSage = $aEtablissement->getLoginSage ();
							// on met à jour le role principal de l'individu
							$aIndividu->defineWorkingPlace ( $_GET ['idi'], $_GET ['id'], $LoginSage );
						}
					}

					echo CommunFunction::goToURL ( '../etablissement/index.php?action=m&id=' . $aRole->getEtablissement ()->getID () );
				}
				break;
			case 'edit' :
			case 'u' :
				if (! isset ( $_POST ['EtablissementID'] )) {
					$modele = new Role ();
					$modele->select_role ( $_GET ['id'] );
					$vue = new RoleView ( $modele );
					$vue->render ( 'u' );
				} else {
					$aRole = new Role ();
					$aRole->select_role ( trim ( $_GET ['id'] ) );
					$aDomaineActiviteFonctionList = new DomaineActiviteFonctionList ();
					$aDomaineActiviteFonctionList->SQL_DELETE_ALL ( $aRole->getID () );

					for($i = 0; $i < $_POST ['DAFxCounter']; $i ++) {
						if (isset ( $_POST ['DA-' . $i] )) {
							$aDomaineActiviteFonction = new DomaineActiviteFonction ();
							$aDomaineActiviteFonction->setRoleID ( trim ( $_GET ['id'] ) );
							$aDomaineActiviteFonction->setDomaineActiviteID ( trim ( $_POST ['DA-' . $i] ) );
							$aDomaineActiviteFonction->setFonctionDAID ( $_POST ['Fx-' . $i] == 0 ? NULL : trim ( $_POST ['Fx-' . $i] ) );
							$aDomaineActiviteFonction->SQL_CREATE ();
						}
					}
					echo CommunFunction::goToURL ( '?' );
				}
				break;
			case 'delete' :
			case 'd' :
				if (isset ( $_GET ['id'] )) // IndividuID
				{
					$role = new Simple_Role ();
					$role->SQL_SELECT ( $_GET ['id'] );
					$aRole = new Role ();
					$aRole->setID ( $_GET ['id'] );

					if (isset ( $_GET ['ide'] )) // EtablissementID
					{
						$rolePrincipal = 0;
						if (isset ( $_GET ['roleid'] )) // RoleID
						{
							// Recherche si le rôle à supprimer est lieu de travail principal de l'individu
							$aRole->select_rolePrincipal ( $_GET ['roleid'] );
							$rolePrincipal = $aRole->getLieuTravailID ();
							// Suppression du role a partie de l'individu et etablissement
							$aRole->SQL_DELETE ( $_GET ['ide'] );
							// s'il reste des roles pour l'individu et que le rôle supprimé etait le role principal
							// on affecte le premier role disponible comme rôle principal
							if ($rolePrincipal > 0) {
								// on recupère le nouveau role pricncipal
								$rolePrincipal = $aRole->sql_new_rolePrincipal ( $_GET ['id'] );
								if ($rolePrincipal > 0) {
									// on recherche le LoginSage du nouveau role principal
									$aEtablissement = new Etablissement ();
									$aEtablissement->select_etablissement ( trim ( $rolePrincipal ) );
									$LoginSage = $aEtablissement->getLoginSage ();
									// on met à jour le role principal de l'individu
									// if(Individu::detectionAnamalieLieuTravail($_GET['id']))
									// {
									$aIndividu = new Individu ();
									$aIndividu->defineWorkingPlace ( $_GET ['id'], $rolePrincipal, $LoginSage );
									// }
								}
							}
						} else {
							// Suppression du role a partie de l'individu et etablissement
							$aRole->SQL_DELETE ( $_GET ['ide'] );
							if (Individu::detectionAnamalieLieuTravail ( $_GET ['id'] )) {
								$aIndividu = new Individu ();
								$aIndividu->defineWorkingPlace ( $_GET ['id'], NULL, NULL );
							}
						}

						echo CommunFunction::goToURL ( '../etablissement?action=m&id=' . $_GET ['ide'] );
					} else {

						$role = new Simple_Role ();
						$role->SQL_SELECT ( $_GET ['id'] );

						// Recherche si le rôle à supprimer est lieu de travail principal de l'individu
						$aRole = new Role ();
						$aRole->select_rolePrincipal ( $_GET ['id'] );
						$rolePrincipal = $aRole->getLieuTravailID ();
						// Suppression du role
						$role->SQL_DELETE ();
						// s'il reste des roles pour l'individu et que le rôle supprimé etait le role principal
						// on affecte le premier role disponible comme rôle principal
						if ($rolePrincipal > 0) {
							// on recupère le nouveau role pricncipal
							$rolePrincipal = $aRole->sql_new_rolePrincipal ( $role->getIndividuID () );
							if ($rolePrincipal > 0) {
								// on recherche le LoginSage du nouveau role principal
								$aEtablissement = new Etablissement ();
								$aEtablissement->select_etablissement ( trim ( $rolePrincipal ) );
								$LoginSage = $aEtablissement->getLoginSage ();
								// on met à jour le role principal de l'individu
								// print ($role->getIndividuID());
								// print (' - ');
								// print ($rolePrincipal);
								// print (' - ');
								// print ($LoginSage);

								// if(Individu::detectionAnamalieLieuTravail($role->getIndividuID()))
								// {
								$aIndividu = new Individu ();
								$aIndividu->defineWorkingPlace ( $role->getIndividuID (), $rolePrincipal, $LoginSage );
								// }
							}
						}
						echo CommunFunction::goToURL ( '?' );
					}
				}
			case 'lieuTravail' :
				if (isset ( $_GET ['uid'] ) && isset ( $_GET ['cid'] )) {
					$aEtablissement = new Etablissement ();
					$aEtablissement->select_etablissement ( trim ( $_GET ['cid'] ) );
					$LoginSage = $aEtablissement->getLoginSage ();
					$aIndividu = new Individu ();
					$aIndividu->defineWorkingPlace ( $_GET ['uid'], $_GET ['cid'], $LoginSage );

					echo CommunFunction::goToURL ( '?action=edit&id=' . $_GET ['id'] );
				}
				break;
		}
	}
}
?>