<?php
class ListeDiffusionCritere {
	private $myID;
	private $myListeID;
	private $myType;
	private $myContient;
	private $myIDElement;

	// Type pour Liste Simple
	const TYPE_ETABLISSEMENT = 'Etablissement';
	const TYPE_INDIVIDU = 'Individu';

	// Type pour Liste Spécifique
	const TYPE_DOMAINE_ACTIVITE = 'DomaineActivite';
	const TYPE_FONCTION_DOMAINE_ACTIVITE = 'FonctionDA';
	const TYPE_DELEGAION_REGIONAL = 'DelegationRegion';
	const TYPE_REGION = 'Region';
	const TYPE_FONCTION_REGION = 'FunctionRegion';
	const TYPE_COMMISSION = 'Commission';
	const TYPE_BUREAU_NATIONAL = 'BureauNational';
	const TYPE_FONCTION_COMMISSION = 'FonctionCommission';
	const TYPE_GROUPE_LCA = 'GroupeLCA';
	const TYPE_REGION_ETABLISSEMENT = 'RegionEtablissement';
	const TYPE_CSV = 'Csv';

	// Contient
	const CONTIENT_EST = 'est';
	const CONTIENT_NEST = 'n est';
	public function __construct() {
		$this->myID = NULL;
		$this->myListeID = NULL;
		$this->myType = self::TYPE_INDIVIDU;
		$this->myIDElement = NULL;
		$this->myContient = self::CONTIENT_EST;
	}

	// ### GETTER ###
	public function isNew() {
		return (is_null ( $this->myID ) || empty ( $this->myID ));
	}
	public function getID() {
		return $this->myID;
	}
	public function getListeID() {
		return $this->myListeID;
	}
	public function getType() {
		return $this->myType;
	}
	public function getElementID() {
		return $this->myIDElement;
	}
	public function getContient() {
		return $this->myContient;
	}

	// ### SETTER ###
	public function setID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myID = $newValue;
		} else {
			$this->myID = NULL;
			trigger_error ( 'Champ ID Incorrecte !' );
		}
	}
	public function setListeID($newValue) {
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myListeID = $newValue;
		} else {
			$this->myListeID = NULL;
			trigger_error ( 'Champ ListeID Incorrecte !' );
		}
	}
	public function setType($newValue) {
		$aTypeArray = array ();
		$aTypeArray [] = self::TYPE_ETABLISSEMENT;
		$aTypeArray [] = self::TYPE_INDIVIDU;
		$aTypeArray [] = self::TYPE_DOMAINE_ACTIVITE;
		$aTypeArray [] = self::TYPE_FONCTION_DOMAINE_ACTIVITE;
		$aTypeArray [] = self::TYPE_REGION;
		$aTypeArray [] = self::TYPE_FONCTION_REGION;
		$aTypeArray [] = self::TYPE_COMMISSION;
		$aTypeArray [] = self::TYPE_FONCTION_COMMISSION;
		$aTypeArray [] = self::TYPE_GROUPE_LCA;
		$aTypeArray [] = self::TYPE_REGION_ETABLISSEMENT;
		$aTypeArray [] = self::TYPE_CSV;
		$aTypeArray [] = self::TYPE_BUREAU_NATIONAL;

		if (is_string ( $newValue ) && in_array ( $newValue, $aTypeArray )) {
			$this->myType = $newValue;
		} else {
			$this->myType = self::TYPE_INDIVIDU;
			trigger_error ( 'Champ Type Incorrecte !' );
		}
	}
	public function setElementID($newValue) {
		// to do germain
		// exit('setelementid');
		if (is_int ( $newValue ) && ! empty ( $newValue )) {
			$this->myIDElement = $newValue;
		} else {
			// $this->myIDElement = '%';
			$this->myIDElement = NULL;
			trigger_error ( 'Champ ElementID Incorrecte !' );
		}
	}
	public function setContient($newValue) {
		if (is_string ( $newValue ) && in_array ( $newValue, array (
				self::CONTIENT_EST,
				self::CONTIENT_NEST
		) )) {
			$this->myContient = $newValue;
		} else {
			$this->myContient = self::CONTIENT_EST;
		}
	}
	public static function generateSQL_For_Mails($id) {
		$tableFlag = array ();
		$tableFlag ['Individu'] = 0;
		$tableFlag ['Etablissement'] = 0;
		$tableFlag ['DA'] = 0;
		$tableFlag ['DR'] = 0;
		$tableFlag ['Commission'] = 0;
		$tableFlag ['GroupeLCA'] = 0;
		$tableFlag ['RegionEtablissement'] = 0;

		$tableFlag ['TYPE_FONCTION_DOMAINE_ACTIVITE'] = 0;
		$tableFlag ['TYPE_DOMAINE_ACTIVITE'] = 0;
		$tableFlag ['TYPE_ETABLISSEMENT'] = 0;
		$tableFlag ['TYPE_INDIVIDU'] = 0;
		$tableFlag ['TYPE_COMMISSION'] = 0;
		$tableFlag ['TYPE_BUREAU_NATIONAL'] = 0;
		$tableFlag ['TYPE_GROUPE_LCA'] = 0;
		$tableFlag ['TYPE_CSV'] = 0;

		$SQL_SELECT_BASE = 'SELECT DISTINCT(i.IndividuID), i.Nom as NOM, i.Prenom as PRENOM, i.Mail, i.Civilite';
		$SQL_FROM_BASE = 'FROM annuaire_individu i';

		$SQL_FROM = array ();
		$SQL_WHERE_BASE = "WHERE (i.AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "'";
		$SQL_JOINTURE = array ();
		$SQL_CRITERE = array ();
		$SQL_ORDER_BASE = 'ORDER BY NOM, PRENOM';

		// Selection des TABLES
		$aListeDiffusionManager = new ListeDiffusionManager ();
		$aListeDiffusion = $aListeDiffusionManager->get ( $id );
		$aOperateur = in_array ( $aListeDiffusion->getType (), array (
				ListeDiffusion::TYPE_SIMPLE_ET,
				ListeDiffusion::TYPE_SPECIFIQUE_ET,
				ListeDiffusion::TYPE_CSV_ET
		) ) ? 'AND' : 'OR';
		$aListeDiffusionCritereManager = new ListeDiffusionCritereManager ();
		$listeDiffusionCritere = $aListeDiffusionCritereManager->getList ( $id );
		if (! empty ( $listeDiffusionCritere )) {
			foreach ( $listeDiffusionCritere as $aCritere ) {
				$aSigne = $aCritere->getContient () == ListeDiffusionCritere::CONTIENT_EST ? '=' : '!=';
				switch ($aCritere->getType ()) {
					// Type Simple
					case ListeDiffusionCritere::TYPE_INDIVIDU :
						$tableFlag ['TYPE_INDIVIDU'] ++;
						if ($tableFlag ['TYPE_INDIVIDU'] == 1) {
							$SQL_CRITERE_TI = "i.IndividuID IN(";
						}
						$SQL_CRITERE_TI = $SQL_CRITERE_TI . "'" . $aCritere->getElementID () . "',";
						break;
					case ListeDiffusionCritere::TYPE_ETABLISSEMENT :
						$tableFlag ['TYPE_ETABLISSEMENT'] ++;
						if ($tableFlag ['TYPE_ETABLISSEMENT'] == 1) {
							$SQL_FROM_TE = 'annuaire_role r_te';
							$SQL_JOINTURE_TE = 'r_te.IndividuID=i.IndividuID';
							$SQL_CRITERE_TE = "r_te.EtablissementID IN(";
						}
						$SQL_CRITERE_TE = $SQL_CRITERE_TE . "'" . $aCritere->getElementID () . "',";
						break;
					// Type Spécifique
					case ListeDiffusionCritere::TYPE_DOMAINE_ACTIVITE :
						$tableFlag ['TYPE_DOMAINE_ACTIVITE'] ++;
						if ($tableFlag ['TYPE_DOMAINE_ACTIVITE'] == 1) {
							$SQL_FROM_TDA = 'annuaire_role r_tda,annuaire_role_domainactivite rda_tda ';
							$SQL_JOINTURE_TDA = 'r_tda.IndividuID=i.IndividuID AND r_tda.RoleID=rda_tda.RoleID';
							$SQL_CRITERE_TDA = "rda_tda.DomainActiviteID IN(";
						}
						$SQL_CRITERE_TDA = $SQL_CRITERE_TDA . "'" . $aCritere->getElementID () . "',";
						break;
					case ListeDiffusionCritere::TYPE_FONCTION_DOMAINE_ACTIVITE :
						$tableFlag ['TYPE_FONCTION_DOMAINE_ACTIVITE'] ++;
						if ($tableFlag ['TYPE_FONCTION_DOMAINE_ACTIVITE'] == 1) {
							$SQL_FROM_TFDA = 'annuaire_role r_tfda, annuaire_role_domainactivite rda_tfda';
							$SQL_JOINTURE_TFDA = 'r_tfda.IndividuID=i.IndividuID AND r_tfda.RoleID=rda_tfda.RoleID ';
							$SQL_CRITERE_TFDA = "rda_tfda.FonctionDAID IN (";
						}
						$SQL_CRITERE_TFDA = $SQL_CRITERE_TFDA . "'" . $aCritere->getElementID () . "',";
						break;
					case ListeDiffusionCritere::TYPE_COMMISSION :
						$tableFlag ['TYPE_COMMISSION'] ++;
						if ($tableFlag ['TYPE_COMMISSION'] == 1) {
							$SQL_FROM_TC = 'annuaire_individucommission c_tc';
							$SQL_JOINTURE_TC = 'c_tc.IndividuID=i.IndividuID';
							$SQL_CRITERE_TC = "c_tc.CommissionID IN(";
						}
						$SQL_CRITERE_TC = $SQL_CRITERE_TC . "'" . $aCritere->getElementID () . "',";
						break;
					case ListeDiffusionCritere::TYPE_BUREAU_NATIONAL :
						$tableFlag ['TYPE_BUREAU_NATIONAL'] ++;
						if ($tableFlag ['TYPE_BUREAU_NATIONAL'] == 1) {
							$SQL_FROM_TBN = 'annuaire_individufonctionbn ifbn_tbn';
							$SQL_JOINTURE_TBN = 'ifbn_tbn.IndividuID=i.IndividuID';
							$SQL_CRITERE_TBN = "ifbn_tbn.FonctionBNID IN(";
						}
						$SQL_CRITERE_TBN = $SQL_CRITERE_TBN . "'" . $aCritere->getElementID () . "',";
						break;
					case ListeDiffusionCritere::TYPE_GROUPE_LCA :
						$tableFlag ['TYPE_GROUPE_LCA'] ++;
						if ($tableFlag ['TYPE_GROUPE_LCA'] == 1) {
							$SQL_FROM_TGL = 'annuaire_lca_groupeindividu lca_tgl';
							$SQL_JOINTURE_TGL = 'lca_tgl.IndividuID=i.IndividuID';
							$SQL_CRITERE_TGL = "lca_tgl.GroupeID IN(";
						}
						$SQL_CRITERE_TGL = $SQL_CRITERE_TGL . "'" . $aCritere->getElementID () . "',";
						break;
					case ListeDiffusionCritere::TYPE_CSV :
						$tableFlag ['TYPE_CSV'] ++;
						if ($tableFlag ['TYPE_CSV'] == 1) {
							$SQL_SELECT_CSV = 'SELECT DISTINCT(i.IndividuID), IFNULL(i.Nom,r.csv_Nom) as NOM, IFNULL (i.Prenom,r.csv_Prenom) as PRENOM, IFNULL(r.csv_mail,i.Mail) as Mail, IFNULL(r.csv_Civilite,i.Civilite) as Civilite ';
							$SQL_FROM_CSV = 'FROM annuaire_individu i right join csv_liste_diffusion_detail r on (i.IndividuID = r.csv_Individu_ID )';
							$SQL_WHERE_CSV = "WHERE ((i.AnnuaireID IS NULL or i.AnnuaireID>'0')";
							$SQL_CRITERE_CSV = "r.csv_id IN(";
						}
						$SQL_CRITERE_CSV = $SQL_CRITERE_CSV . "'" . $aCritere->getElementID () . "',";
						// $SQL_CRITERE_CSV = "i.IndividuID in (select csv_Individu_ID from csv_liste_diffusion_detail where csv_id $aSigne '".$aCritere->getElementID()."'))";
						break;
				}
			}

			$UNION = 0;

			$sql = '';

			if ($tableFlag ['TYPE_CSV'] > 0) {
				if ($UNION == 0)
					$sql .= '';
				else
					$sql .= ' UNION ';
				$UNION += 1;
				$sql .= $SQL_SELECT_CSV . ' ' . $SQL_FROM_CSV;
				$sql .= ' ' . $SQL_WHERE_CSV;
				$sql .= ' AND ' . $SQL_CRITERE_CSV . "''))";
			}

			if ($tableFlag ['TYPE_GROUPE_LCA'] > 0) {
				if ($UNION == 0)
					$sql .= '';
				else
					$sql .= ' UNION ';
				$UNION += 1;
				$sql .= $SQL_SELECT_BASE . ' ' . $SQL_FROM_BASE . ',' . $SQL_FROM_TGL;
				$sql .= ' ' . $SQL_WHERE_BASE . ' AND ' . $SQL_JOINTURE_TGL;
				$sql .= ' AND ' . $SQL_CRITERE_TGL . "''))";
			}

			if ($tableFlag ['TYPE_COMMISSION'] > 0) {
				if ($UNION == 0)
					$sql .= '';
				else
					$sql .= ' UNION ';
				$UNION += 1;
				$sql .= $SQL_SELECT_BASE . ' ' . $SQL_FROM_BASE . ',' . $SQL_FROM_TC;
				$sql .= ' ' . $SQL_WHERE_BASE . ' AND ' . $SQL_JOINTURE_TC;
				$sql .= ' AND ' . $SQL_CRITERE_TC . "''))";
			}

			if ($tableFlag ['TYPE_INDIVIDU'] > 0) {
				if ($UNION == 0)
					$sql .= '';
				else
					$sql .= ' UNION ';
				$UNION += 1;
				$sql .= $SQL_SELECT_BASE . ' ' . $SQL_FROM_BASE;
				$sql .= ' ' . $SQL_WHERE_BASE;
				$sql .= ' AND ' . $SQL_CRITERE_TI . "''))";
			}

			if ($tableFlag ['TYPE_ETABLISSEMENT'] > 0) {
				if ($UNION == 0)
					$sql .= '';
				else
					$sql .= ' UNION ';
				$UNION += 1;
				$sql .= $SQL_SELECT_BASE . ' ' . $SQL_FROM_BASE . ',' . $SQL_FROM_TE;
				$sql .= ' ' . $SQL_WHERE_BASE . ' AND ' . $SQL_JOINTURE_TE;
				$sql .= ' AND ' . $SQL_CRITERE_TE . "''))";
			}

			if ($tableFlag ['TYPE_FONCTION_DOMAINE_ACTIVITE'] > 0) {
				if ($UNION == 0)
					$sql .= '';
				else
					$sql .= ' UNION ';
				$UNION += 1;
				$sql .= $SQL_SELECT_BASE . ' ' . $SQL_FROM_BASE . ',' . $SQL_FROM_TFDA;
				$sql .= ' ' . $SQL_WHERE_BASE . ' AND ' . $SQL_JOINTURE_TFDA;
				$sql .= ' AND ' . $SQL_CRITERE_TFDA . "''))";
			}

			if ($tableFlag ['TYPE_DOMAINE_ACTIVITE'] > 0) {
				if ($UNION == 0)
					$sql .= '';
				else
					$sql .= ' UNION ';
				$UNION += 1;
				$sql .= $SQL_SELECT_BASE . ' ' . $SQL_FROM_BASE . ',' . $SQL_FROM_TDA;
				$sql .= ' ' . $SQL_WHERE_BASE . ' AND ' . $SQL_JOINTURE_TDA;
				$sql .= ' AND ' . $SQL_CRITERE_TDA . "''))";
			}

			if ($tableFlag ['TYPE_BUREAU_NATIONAL'] > 0) {
				if ($UNION == 0)
					$sql .= '';
				else
					$sql .= ' UNION ';
				$UNION += 1;
				$sql .= $SQL_SELECT_BASE . ' ' . $SQL_FROM_BASE . ',' . $SQL_FROM_TBN;
				$sql .= ' ' . $SQL_WHERE_BASE . ' AND ' . $SQL_JOINTURE_TBN;
				$sql .= ' AND ' . $SQL_CRITERE_TBN . "''))";
			}

			$sql .= ' ' . $SQL_ORDER_BASE;

			// print $sql ;
			return $sql;
		} else {
			return null;
		}
	}
	public static function generateSQL($id) {
		$tableFlag = array ();
		$tableFlag ['Individu'] = 0;
		$tableFlag ['Etablissement'] = 0;
		$tableFlag ['DA'] = 0;
		$tableFlag ['DR'] = 0;
		$tableFlag ['Commission'] = 0;
		$tableFlag ['GroupeLCA'] = 0;
		$tableFlag ['RegionEtablissement'] = 0;

		$tableFlag ['TYPE_FONCTION_DOMAINE_ACTIVITE'] = 0;

		$SQL_SELECT_BASE = 'SELECT DISTINCT(i.IndividuID), i.Nom, i.Prenom, i.Mail, i.Civilite';
		$SQL_FROM_BASE = 'FROM annuaire_individu i';

		$SQL_FROM = array ();
		$SQL_WHERE_BASE = "WHERE (i.AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "'";
		$SQL_JOINTURE = array ();
		$SQL_CRITERE = array ();
		$SQL_ORDER_BASE = 'ORDER BY i.Nom, i.Prenom';

		// Selection des TABLES
		$aListeDiffusionManager = new ListeDiffusionManager ();
		$aListeDiffusion = $aListeDiffusionManager->get ( $id );
		$aOperateur = in_array ( $aListeDiffusion->getType (), array (
				ListeDiffusion::TYPE_SIMPLE_ET,
				ListeDiffusion::TYPE_SPECIFIQUE_ET,
				ListeDiffusion::TYPE_CSV_ET
		) ) ? 'AND' : 'OR';
		$aListeDiffusionCritereManager = new ListeDiffusionCritereManager ();
		$listeDiffusionCritere = $aListeDiffusionCritereManager->getList ( $id );
		if (! empty ( $listeDiffusionCritere )) {
			foreach ( $listeDiffusionCritere as $aCritere ) {
				$aSigne = $aCritere->getContient () == ListeDiffusionCritere::CONTIENT_EST ? '=' : '!=';
				switch ($aCritere->getType ()) {
					// Type Simple
					case ListeDiffusionCritere::TYPE_INDIVIDU :
						$SQL_CRITERE [] = "i.IndividuID $aSigne '" . $aCritere->getElementID () . "'";
						break;
					case ListeDiffusionCritere::TYPE_ETABLISSEMENT :
						if ($aSigne == '=') {
							$tableFlag ['Etablissement'] ++;
							$SQL_FROM [] = 'annuaire_role r' . $tableFlag ['Etablissement'];
							$SQL_JOINTURE [] = 'r' . $tableFlag ['Etablissement'] . '.IndividuID=i.IndividuID';
							$SQL_CRITERE [] = "r" . $tableFlag ['Etablissement'] . ".EtablissementID $aSigne '" . $aCritere->getElementID () . "'";
						} else {
							$SQL_CRITERE [] = "IFNULL(i.IndividuID,0) NOT IN (SELECT DISTINCT(IndividuID) FROM annuaire_role WHERE AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND EtablissementID='" . $aCritere->getElementID () . "')";
						}
						break;
					// Type Spécifique
					case ListeDiffusionCritere::TYPE_DOMAINE_ACTIVITE :
						if ($aSigne == '=') {
							$tableFlag ['Etablissement'] ++;
							$SQL_FROM [] = 'annuaire_role r' . $tableFlag ['Etablissement'];
							$tableFlag ['DA'] ++;
							$SQL_FROM [] = 'annuaire_role_domainactivite rda' . $tableFlag ['DA'];
							$SQL_JOINTURE [] = 'r' . $tableFlag ['Etablissement'] . '.IndividuID=i.IndividuID';
							$SQL_JOINTURE [] = 'r' . $tableFlag ['Etablissement'] . '.RoleID=rda' . $tableFlag ['DA'] . '.RoleID';
							$SQL_CRITERE [] = "rda" . $tableFlag ['DA'] . ".DomainActiviteID $aSigne '" . $aCritere->getElementID () . "'";
						} else {
							$SQL_CRITERE [] = "IFNULL(i.IndividuID,0) NOT IN (SELECT DISTINCT(r.IndividuID) FROM annuaire_role r, annuaire_role_domainactivite rda WHERE r.AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND r.RoleID=rda.RoleID AND rda.DomainActiviteID='" . $aCritere->getElementID () . "')";
						}
						break;
					case ListeDiffusionCritere::TYPE_FONCTION_DOMAINE_ACTIVITE :
						if ($aSigne == '=') {
							$tableFlag ['Etablissement'] ++;
							$SQL_FROM [] = 'annuaire_role r' . $tableFlag ['Etablissement'];
							$tableFlag ['DA'] ++;
							$SQL_FROM [] = 'annuaire_role_domainactivite rda' . $tableFlag ['DA'];
							$SQL_JOINTURE [] = 'r' . $tableFlag ['Etablissement'] . '.IndividuID=i.IndividuID';
							$SQL_JOINTURE [] = 'r' . $tableFlag ['Etablissement'] . '.RoleID=rda' . $tableFlag ['DA'] . '.RoleID';
							$SQL_CRITERE [] = "rda" . $tableFlag ['DA'] . ".FonctionDAID $aSigne '" . $aCritere->getElementID () . "'";
						} else {
							$SQL_CRITERE [] = "IFNULL(i.IndividuID,0) NOT IN (SELECT DISTINCT(r.IndividuID) FROM annuaire_role r, annuaire_role_domainactivite rda WHERE r.AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND r.RoleID=rda.RoleID AND rda.FonctionDAID='" . $aCritere->getElementID () . "')";
						}
						break;
					case ListeDiffusionCritere::TYPE_REGION :
						if ($aSigne == '=') {
							$tableFlag ['DR'] ++;
							$SQL_FROM [] = 'annuaire_delegationregionale dr' . $tableFlag ['DR'];
							$SQL_JOINTURE [] = 'dr' . $tableFlag ['DR'] . '.IndividuID=i.IndividuID';
							$SQL_CRITERE [] = "dr" . $tableFlag ['DR'] . ".RegionID $aSigne '" . $aCritere->getElementID () . "'";
						} else {
							$SQL_CRITERE [] = "IFNULL(i.IndividuID,0) NOT IN (SELECT DISTINCT(ii.IndividuID) FROM annuaire_delegationregionale dri, annuaire_individu ii WHERE ii.IndividuID=dri.IndividuID AND ii.AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND dri.RegionID='" . $aCritere->getElementID () . "')";
						}
						break;
					case ListeDiffusionCritere::TYPE_FONCTION_REGION :
						if ($aSigne == '=') {
							$tableFlag ['DR'] ++;
							$SQL_FROM [] = 'annuaire_delegationregionale dr' . $tableFlag ['DR'];
							$SQL_JOINTURE [] = 'dr' . $tableFlag ['DR'] . '.IndividuID=i.IndividuID';
							if ($aCritere->getElementID () == '9') {
								$SQL_CRITERE [] = "dr" . $tableFlag ['DR'] . ".FonctionDelegationID!=''";
							} else {
								$SQL_CRITERE [] = "dr" . $tableFlag ['DR'] . ".FonctionDelegationID $aSigne '" . $aCritere->getElementID () . "'";
							}
						} else {
							if ($aCritere->getElementID () == '9') {
								$SQL_CRITERE [] = "IFNULL(i.IndividuID,0) NOT IN (SELECT DISTINCT(ii.IndividuID) FROM annuaire_delegationregionale dri, annuaire_individu ii WHERE ii.IndividuID=dri.IndividuID AND ii.AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND dri.FonctionDelegationID='')";
							} else {
								$SQL_CRITERE [] = "IFNULL(i.IndividuID,0) NOT IN (SELECT DISTINCT(ii.IndividuID) FROM annuaire_delegationregionale dri, annuaire_individu ii WHERE ii.IndividuID=dri.IndividuID AND ii.AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND dri.FonctionDelegationID='" . $aCritere->getElementID () . "')";
							}
						}
						break;
					case ListeDiffusionCritere::TYPE_COMMISSION :
						if ($aSigne == '=') {
							$tableFlag ['Commission'] ++;
							$SQL_FROM [] = 'annuaire_individucommission c' . $tableFlag ['Commission'];
							$SQL_JOINTURE [] = 'c' . $tableFlag ['Commission'] . '.IndividuID=i.IndividuID';
							$SQL_CRITERE [] = "c" . $tableFlag ['Commission'] . ".CommissionID $aSigne '" . $aCritere->getElementID () . "'";
						} else {
							$SQL_CRITERE [] = "IFNULL(i.IndividuID,0) NOT IN (SELECT DISTINCT(ii.IndividuID) FROM annuaire_individucommission ci, annuaire_individu ii WHERE ii.IndividuID=ci.IndividuID AND ii.AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND ci.CommissionID='" . $aCritere->getElementID () . "')";
						}
						break;
					case ListeDiffusionCritere::TYPE_GROUPE_LCA :
						if ($aSigne == '=') {
							$tableFlag ['GroupeLCA'] ++;
							$SQL_FROM [] = 'annuaire_lca_groupeindividu lca' . $tableFlag ['GroupeLCA'];
							$SQL_JOINTURE [] = 'lca' . $tableFlag ['GroupeLCA'] . '.IndividuID=i.IndividuID';
							$SQL_CRITERE [] = "lca" . $tableFlag ['GroupeLCA'] . ".GroupeID $aSigne '" . $aCritere->getElementID () . "'";
						} else {
							$SQL_CRITERE [] = "IFNULL(i.IndividuID,0) NOT IN (SELECT DISTINCT(ii.IndividuID) FROM annuaire_lca_groupeindividu lcai, annuaire_individu ii WHERE ii.IndividuID=lcai.IndividuID AND ii.AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND lcai.GroupeID='" . $aCritere->getElementID () . "')";
						}
						break;
					case ListeDiffusionCritere::TYPE_REGION_ETABLISSEMENT :
						if ($aSigne == '=') {
							$tableFlag ['Etablissement'] ++;
							$SQL_FROM [] = 'annuaire_role r' . $tableFlag ['Etablissement'];
							$tableFlag ['RegionEtablissement'] ++;
							$SQL_FROM [] = 'annuaire_etablissement e' . $tableFlag ['RegionEtablissement'];
							$SQL_JOINTURE [] = 'r' . $tableFlag ['Etablissement'] . '.IndividuID=i.IndividuID';
							$SQL_JOINTURE [] = 'r' . $tableFlag ['Etablissement'] . '.EtablissementID=e' . $tableFlag ['RegionEtablissement'] . '.EtablissementID';
							if ($aCritere->getElementID () == '9') {
								$SQL_CRITERE [] = "e" . $tableFlag ['RegionEtablissement'] . ".RegionID!=''";
							} else {
								$SQL_CRITERE [] = "e" . $tableFlag ['RegionEtablissement'] . ".RegionID $aSigne '" . $aCritere->getElementID () . "'";
							}
						} else {
							if ($aCritere->getElementID () == '9') {
								$SQL_CRITERE [] = "IFNULL(i.IndividuID,0) NOT IN (SELECT DISTINCT(ii.IndividuID) FROM annuaire_etablissement ei, annuaire_role ri, annuaire_individu ii WHERE ii.IndividuID=ri.IndividuID AND ei.EtablissementID=ri.EtablissementID AND ii.AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND ei.RegionID='')";
							} else {
								$SQL_CRITERE [] = "IFNULL(i.IndividuID,0) NOT IN (SELECT DISTINCT(ii.IndividuID) FROM annuaire_etablissement ei, annuaire_role ri, annuaire_individu ii WHERE ii.IndividuID=ri.IndividuID AND ei.EtablissementID=ri.EtablissementID AND ii.AnnuaireID='" . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . "' AND ei.RegionID='" . $aCritere->getElementID () . "')";
							}
						}
						break;
					case ListeDiffusionCritere::TYPE_CSV :
						$SQL_SELECT_BASE = 'SELECT DISTINCT(i.IndividuID), IFNULL(i.Nom,r.csv_Nom) as Nom, IFNULL (i.Prenom,r.csv_Prenom) as Prenom, IFNULL(r.csv_mail,i.Mail) as Mail, IFNULL(r.csv_EtablissementID,\'\'),IFNULL(r.csv_Civilite,i.Civilite) as Civilite,IFNULL(r.csv_Liste_EtablissementID,\'\') ';
						$SQL_FROM_BASE = 'FROM annuaire_individu i right join csv_liste_diffusion_detail r on (i.IndividuID = r.csv_Individu_ID )';
						$SQL_WHERE_BASE = "WHERE ((i.AnnuaireID IS NULL or i.AnnuaireID>'0')";
						$SQL_CRITERE [] = "r.csv_id $aSigne '" . $aCritere->getElementID () . "'";
						// $SQL_CRITERE[] = "i.IndividuID in (select csv_Individu_ID from csv_liste_diffusion_detail where csv_id $aSigne '".$aCritere->getElementID()."')";
						$SQL_ORDER_BASE = ' ORDER BY r.csv_num_Id';
						break;
				}
			}

			$sql = $SQL_SELECT_BASE . ' ' . $SQL_FROM_BASE;
			if (count ( $SQL_FROM ) > 0) {
				foreach ( $SQL_FROM as $a ) {
					$sql .= ', ' . $a;
				}
			}
			$sql .= ' ' . $SQL_WHERE_BASE;
			if (count ( $SQL_JOINTURE ) > 0) {
				foreach ( $SQL_JOINTURE as $a ) {
					// Maj germain 20150324 gestion de la selection de <<tous>> les éléments
					$a = str_replace ( '= \'-1\'', ' like \'%\'', $a );
					$a = str_replace ( '=\'-1\'', ' like \'%\'', $a );
					$sql .= ' AND ' . $a;
				}
			}
			$sql .= ')';

			if (count ( $SQL_CRITERE ) > 0) {
				$sql .= ' AND (';
				$i = 0;
				foreach ( $SQL_CRITERE as $a ) {
					// Maj germain 20150324 gestion de la selection de <<tous>> les éléments
					$a = str_replace ( '= \'-1\'', ' like \'%\'', $a );
					$a = str_replace ( '=\'-1\'', ' like \'%\'', $a );
					$sql .= ($i > 0 ? ' ' . $aOperateur . ' ' : '') . $a;
					$i ++;
				}
				$sql .= ')';
			}

			// On élimine systématiquement les mails qui sont dans STOP PUB
			$sql .= ' AND IFNULL(i.IndividuID,0) NOT IN (SELECT DISTINCT(ii.IndividuID) FROM annuaire_lca_groupeindividu lcai, annuaire_individu ii WHERE ii.IndividuID=lcai.IndividuID AND ii.AnnuaireID=' . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . ' AND lcai.GroupeID=217) ';
			$sql .= ' ' . $SQL_ORDER_BASE;

			return $sql;
		} else {
			return null;
		}
	}
	/**
	 *
	 * @deprecated Enter description here ...
	 * @param unknown_type $aID
	 */
	public static function generateSQL2($aID) {
		$aListeDiffusionManager = new ListeDiffusionManager ();
		$aListeDiffusion = $aListeDiffusionManager->get ( $aID );
		$aListeDiffusionCritereManager = new ListeDiffusionCritereManager ();
		$aList = $aListeDiffusionCritereManager->getList ( $aID );

		$aTableFlag = array (
				0,
				0,
				0,
				0,
				0,
				0,
				0,
				0
		);

		$SQL_SELECT = "SELECT DISTINCT(i.IndividuID), i.Nom, i.Prenom, i.Mail";
		$SQL_FROM = "FROM annuaire_individu i";
		$SQL_JOINTURE = "";
		$SQL_WHERE = "";
		$aOperateur = in_array ( $aListeDiffusion->getType (), array (
				ListeDiffusion::TYPE_SIMPLE_ET,
				ListeDiffusion::TYPE_SPECIFIQUE_ET,
				ListeDiffusion::TYPE_CSV_ET
		) ) ? 'AND' : 'OR';
		foreach ( $aList as $aCritere ) {
			switch ($aCritere->getType ()) {
				case ListeDiffusionCritere::TYPE_INDIVIDU :
					$aTableFlag [0] = 1;
					$aSigne = $aCritere->getContient () == ListeDiffusionCritere::CONTIENT_EST ? '=' : '!=';
					$SQL_WHERE .= $SQL_WHERE == "" ? "i.IndividuID $aSigne '" . $aCritere->getElementID () . "'" : " $aOperateur i.IndividuID $aSigne '" . $aCritere->getElementID () . "'";
					break;
				case ListeDiffusionCritere::TYPE_ETABLISSEMENT :
					$aTableFlag [1] = 1;
					$aSigne = $aCritere->getContient () == ListeDiffusionCritere::CONTIENT_EST ? '=' : '!=';
					$SQL_WHERE .= $SQL_WHERE == "" ? "e.EtablissementID $aSigne '" . $aCritere->getElementID () . "'" : " $aOperateur e.EtablissementID $aSigne '" . $aCritere->getElementID () . "'";
					break;
				case ListeDiffusionCritere::TYPE_DOMAINE_ACTIVITE :
					$aTableFlag [2] = 1;
					$aSigne = $aCritere->getContient () == ListeDiffusionCritere::CONTIENT_EST ? '=' : '!=';
					$SQL_WHERE .= $SQL_WHERE == "" ? "rda.DomainActiviteID $aSigne '" . $aCritere->getElementID () . "'" : " $aOperateur rda.DomainActiviteID $aSigne '" . $aCritere->getElementID () . "'";
					break;
				case ListeDiffusionCritere::TYPE_FONCTION_DOMAINE_ACTIVITE :
					$aTableFlag [3] = 1;
					$aSigne = $aCritere->getContient () == ListeDiffusionCritere::CONTIENT_EST ? '=' : '!=';
					$SQL_WHERE .= $SQL_WHERE == "" ? "rda.FonctionDAID $aSigne '" . $aCritere->getElementID () . "'" : " $aOperateur rda.FonctionDAID $aSigne '" . $aCritere->getElementID () . "'";
					break;
				case ListeDiffusionCritere::TYPE_REGION :
					$aTableFlag [4] = 1;
					$aSigne = $aCritere->getContient () == ListeDiffusionCritere::CONTIENT_EST ? '=' : '!=';
					$SQL_WHERE .= $SQL_WHERE == "" ? "dr.RegionID $aSigne '" . $aCritere->getElementID () . "'" : " $aOperateur dr.RegionID $aSigne '" . $aCritere->getElementID () . "'";
					break;
				case ListeDiffusionCritere::TYPE_FONCTION_REGION :
					$aTableFlag [5] = 1;
					$aSigne = $aCritere->getContient () == ListeDiffusionCritere::CONTIENT_EST ? '=' : '!=';
					$SQL_WHERE .= $SQL_WHERE == "" ? "dr.FonctionDelegationID $aSigne '" . $aCritere->getElementID () . "'" : " $aOperateur dr.FonctionDelegationID $aSigne '" . $aCritere->getElementID () . "'";
					break;
				case ListeDiffusionCritere::TYPE_COMMISSION :
					$aTableFlag [6] = 1;
					$aSigne = $aCritere->getContient () == ListeDiffusionCritere::CONTIENT_EST ? '=' : '!=';
					$SQL_WHERE .= $SQL_WHERE == "" ? "ic.CommissionID $aSigne '" . $aCritere->getElementID () . "'" : " $aOperateur ic.CommissionID $aSigne '" . $aCritere->getElementID () . "'";
					break;
				case ListeDiffusionCritere::TYPE_GROUPE_LCA :
					$aTableFlag [7] = 1;
					$aSigne = $aCritere->getContient () == ListeDiffusionCritere::CONTIENT_EST ? '=' : '!=';
					$SQL_WHERE .= $SQL_WHERE == "" ? "lca.GroupeID $aSigne '" . $aCritere->getElementID () . "'" : " $aOperateur lca.GroupeID $aSigne '" . $aCritere->getElementID () . "'";
					break;
			}
		}

		$SQL_FROM .= $aTableFlag [1] == 1 ? ", annuaire_etablissement e" : "";
		$SQL_FROM .= ($aTableFlag [1] == 1 || $aTableFlag [2] == 1 || $aTableFlag [3] == 1) ? ", annuaire_role r" : "";
		$SQL_FROM .= ($aTableFlag [2] == 1 || $aTableFlag [3] == 1) ? ", annuaire_role_domainactivite rda" : "";
		$SQL_FROM .= ($aTableFlag [5] == 1 || $aTableFlag [4] == 1) ? ", annuaire_delegationregionale dr" : "";
		$SQL_FROM .= $aTableFlag [6] == 1 ? ", annuaire_individucommission ic" : "";
		$SQL_FROM .= $aTableFlag [7] == 1 ? ", annuaire_lca_groupeindividu lca" : "";

		$SQL_JOINTURE .= ($aTableFlag [1] == 1 || $aTableFlag [2] == 1 || $aTableFlag [3] == 1) ? ($SQL_JOINTURE == "" ? " i.IndividuID=r.IndividuID" : " AND i.IndividuID=r.IndividuID") : "";
		$SQL_JOINTURE .= $aTableFlag [1] == 1 ? ($SQL_JOINTURE == "" ? " e.EtablissementID=r.EtablissementID" : " AND e.EtablissementID=r.EtablissementID") : "";
		$SQL_JOINTURE .= ($aTableFlag [2] == 1 || $aTableFlag [3] == 1) ? ($SQL_JOINTURE == "" ? " r.RoleID=rda.RoleID" : " AND r.RoleID=rda.RoleID") : "";
		$SQL_JOINTURE .= ($aTableFlag [4] == 1 || $aTableFlag [5] == 1) ? ($SQL_JOINTURE == "" ? " i.IndividuID=dr.IndividuID" : " AND i.IndividuID=dr.IndividuID") : "";
		$SQL_JOINTURE .= $aTableFlag [6] == 1 ? ($SQL_JOINTURE == "" ? " i.IndividuID=ic.IndividuID" : " AND i.IndividuID=ic.IndividuID") : "";
		$SQL_JOINTURE .= $aTableFlag [7] == 1 ? ($SQL_JOINTURE == "" ? " i.IndividuID=lca.IndividuID" : " AND i.IndividuID=lca.IndividuID") : "";

		return $SQL_SELECT . ' ' . $SQL_FROM . ' WHERE ' . ($SQL_JOINTURE != "" ? '(' . $SQL_JOINTURE . ') AND' : '') . ' (i.AnnuaireID=\'' . $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] . '\')' . (count ( $aList ) > 0 ? ' AND (' . $SQL_WHERE . ')' : '') . ' ORDER BY i.Nom, i.Prenom';
	}
}
?>