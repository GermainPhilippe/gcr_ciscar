<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class PrestaShopCustomer {
	private $myList;
	private $id_customer;
	private $lastname;
	private $firstname;
	private $email;
	private $nextid;
	private $idShopGroup;
	private $idShop;
	private $idDefaultGroup;
	private $idLang;
	private $idRisk;
	private $fonction;
	private $marques;
	private $birthday;
	private $newsletter;
	private $ipRegistrationNewsletter;
	private $newsletterDatAdd;
	private $optin;
	private $website;
	private $outstandingAllowAmount;
	private $showPublicPrices;
	private $maxPaymentDays;
	private $secureKey;
	private $note;
	private $active;
	private $isGest;
	private $deleted;
	private $DateAdd;
	private $DateUpd;
	public function __construct() {
		$this->myList = array ();
		$this->id_customer = 0;
		$this->lastname = '';
		$this->firstname = '';
		$this->email = '';
		$this->nextid = 0;
	}

	// ###
	public function getList() {
		return $this->myList;
	}
	public function getIdCustomer() {
		return $this->id_customer;
	}
	public function getLastname() {
		return $this->lastname;
	}
	public function getFirstname() {
		return $this->firstname;
	}
	public function getEmail() {
		return $this->email;
	}
	public function getNextid() {
		return $this->nextid;
	}
	public function getActive() {
		return $this->active;
	}
	public function getDeleted() {
		return $this->deleted;
	}
	public function getIdShopGroup() {
		return $this->idShopGroup;
	}
	public function getIdShop() {
		return $this->idShop;
	}
	public function getIdDefaultGroup() {
		return $this->idDefaultGroup;
	}
	public function getIdLang() {
		return $this->idLang;
	}
	public function getIdRisk() {
		return $this->idRisk;
	}
	public function getFonction() {
		return $this->fonction;
	}
	public function getMarques() {
		return $this->marques;
	}
	public function getBirthday() {
		return $this->birthday;
	}
	public function getNewsletter() {
		return $this->newsletter;
	}
	public function getIpRegistrationNewsletter() {
		return $this->ipRegistrationNewsletter;
	}
	public function getNewsletterDatAdd() {
		return $this->NewsletterDatAdd;
	}
	public function getOptin() {
		return $this->optin;
	}
	public function getWebsite() {
		return $this->website;
	}
	public function getOutstandingAllowAmount() {
		return $this->outstandingAllowAmount;
	}
	public function getShowPublicPrices() {
		return $this->showPublicPrices;
	}
	public function getMaxPaymentDays() {
		return $this->maxPaymentDays;
	}
	public function getSecureKey() {
		return $this->secureKey;
	}
	public function getNote() {
		return $this->note;
	}
	public function getIsGest() {
		return $this->isGest;
	}
	public function getDateAdd() {
		return $this->dateAdd;
	}
	public function getDateUpd() {
		return $this->dateUpd;
	}
	public function setList($newValue) {
		$this->myList = $newValue;
	}
	public function setIdCustomer($newValue) {
		$this->id_customer = $newValue;
	}
	public function setLastname($newValue) {
		$this->lastname = $newValue;
	}
	public function setFirstname($newValue) {
		$this->firstname = $newValue;
	}
	public function setEmail($newValue) {
		$this->email = $newValue;
	}
	public function setNextid($newValue) {
		$this->nextid = $newValue;
	}
	public function setActive($newValue) {
		$this->active = $newValue;
	}
	public function setDeleted($newValue) {
		$this->deleted = $newValue;
	}
	public function setIdShopGroup($newValue) {
		$this->idShopGroup = $newValue;
	}
	public function setIdShop($newValue) {
		$this->idShop = $newValue;
	}
	public function setIdDefaultGroup($newValue) {
		$this->idDefaultGroup = $newValue;
	}
	public function setIdLang($newValue) {
		$this->idLang = $newValue;
	}
	public function setIdRisk($newValue) {
		$this->idRisk = $newValue;
	}
	public function setFonction($newValue) {
		$this->fonction = $newValue;
	}
	public function setMarques($newValue) {
		$this->marques = $newValue;
	}
	public function setBirthday($newValue) {
		$this->birthday = $newValue;
	}
	public function setNewsletter($newValue) {
		$this->newsletter = $newValue;
	}
	public function setIpRegistrationNewsletter($newValue) {
		$this->ipRegistrationNewsletter = $newValue;
	}
	public function setNewsletterDatAdd($newValue) {
		$this->NewsletterDatAdd = $newValue;
	}
	public function setOptin($newValue) {
		$this->optin = $newValue;
	}
	public function setWebsite($newValue) {
		$this->website = $newValue;
	}
	public function setOutstandingAllowAmount($newValue) {
		$this->outstandingAllowAmount = $newValue;
	}
	public function setShowPublicPrices($newValue) {
		$this->showPublicPrices = $newValue;
	}
	public function setMaxPaymentDays($newValue) {
		$this->maxPaymentDays = $newValue;
	}
	public function setSecureKey($newValue) {
		$this->secureKey = $newValue;
	}
	public function setNote($newValue) {
		$this->note = $newValue;
	}
	public function setIsGest($newValue) {
		$this->isGest = $newValue;
	}
	public function setDateAdd($newValue) {
		$this->dateAdd = $newValue;
	}
	public function setDateUpd($newValue) {
		$this->dateUpd = $newValue;
	}

	// ###
	public function SQL_SELECT_CUSTOMER_BY_ID($customerID) {

		$this->myList = array ();

		$sql = "SELECT id_customer, active, deleted, email FROM ps_customer WHERE id_customer ='%s' ";
		$query = sprintf ( $sql, mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $customerID ) );
		$result = mysqli_query ( $_SESSION['LINK_PRESTASHOP'] , $query ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );

			$this->setIdCustomer ( $line [0] );
			$this->setActive ( $line [1] );
			$this->setDeleted ( $line [2] );
			$this->setEmail ( $line [3] );
		} else {
			$this->setIdCustomer ( 0 );
		}
		mysqli_free_result ( $result );
	}
	public function SQL_SELECT_CUSTOMER_BY_ID_EMAIL($customerID, $mail) {

		$this->myList = array ();

		$sql = "SELECT id_customer, active, deleted, email FROM ps_customer WHERE id_customer ='%s' and email = '%s' ";
		$query = sprintf ( $sql, mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $customerID ), mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $mail ) );
		$result = mysqli_query ( $_SESSION['LINK_PRESTASHOP'] , $query ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );

			$this->setIdCustomer ( $line [0] );
			$this->setActive ( $line [1] );
			$this->setDeleted ( $line [2] );
			$this->setEmail ( $line [3] );
		} else {
			$this->setIdCustomer ( 0 );
		}
		mysqli_free_result ( $result );
	}
	public function SQL_SELECT_CUSTOMER_BY_EMAIL($mail) {

		$this->myList = array ();
		$sql = "SELECT id_customer, id_shop_group, id_shop, id_default_group, id_lang, id_risk, siret, ape, birthday, newsletter, ip_registration_newsletter, newsletter_date_add, 
				optin, website, outstanding_allow_amount, show_public_prices, max_payment_days, secure_key, note, active, is_guest, deleted, date_add, date_upd
				FROM ps_customer WHERE email = '%s' ";

		$query = sprintf ( $sql, mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $mail ) );
		$result = mysqli_query ( $_SESSION['LINK_PRESTASHOP'] , $query ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );

			$this->setIdCustomer ( $line [0] );
			$this->setIdShopGroup ( $line [1] );
			$this->setIdShop ( $line [2] );
			$this->setIdDefaultGroup ( $line [3] );
			$this->setIdLang ( $line [4] );
			$this->setIdRisk ( $line [5] );
			$this->setFonction ( $line [6] );
			$this->setMarques ( $line [7] );
			$this->setBirthday ( $line [8] );
			$this->setNewsletter ( $line [9] );
			$this->setIpRegistrationNewsletter ( $line [10] );
			$this->setNewsletterDatAdd ( $line [11] );
			$this->setOptin ( $line [12] );
			$this->setWebsite ( $line [13] );
			$this->setOutstandingAllowAmount ( $line [14] );
			$this->setShowPublicPrices ( $line [15] );
			$this->setMaxPaymentDays ( $line [16] );
			$this->setSecureKey ( $line [17] );
			$this->setNote ( $line [18] );
			$this->setActive ( $line [19] );
			$this->setIsGest ( $line [20] );
			$this->setDeleted ( $line [21] );
			$this->setDateAdd ( $line [22] );
			$this->setDateUpd ( $line [23] );
		} else {
			if (mysqli_num_rows ( $result ) > 1) {
				$this->setIdCustomer ( - 1 );
			} else {
				$this->setIdCustomer ( 0 );
			}
		}
		mysqli_free_result ( $result );
	}
	public function SQL_DELETE_CUSTOMER_BY_ID($idCustomer) {

		$this->myList = array ();

		$sql = "delete FROM ps_customer WHERE id_customer = '%s' ";
		$query = sprintf ( $sql, mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $idCustomer ) );
		$result = mysqli_query ( $_SESSION['LINK_PRESTASHOP'] , $query ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );
	}
	public function SQL_UPDATE_CUSTOMER_BY_ID($individuAnnuaire) {
		$cookie_key_prestashop = 'H8ZcCJUUK6IbUrYs3cMoFdE2JViQqo40SovXZdwPHz7afAKZPDrkpqzn';
		$aindividuAnnuaire = new IndividuAnnuaire ();
		$aindividuAnnuaire = $individuAnnuaire;

		$sql = 'update ps_customer set 
				id_gender = ' . $aindividuAnnuaire->getIndividuCivilite () . '
				,company = \'' . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuEtablissement () ) . '\'
				,firstname =  \'' . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuPrenom () ) . '\'
				,lastname = \'' . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuNom () ) . '\'
				,email = \'' . $aindividuAnnuaire->getIndividuMail () . '\'
				,passwd = \'' . md5 ( $cookie_key_prestashop . $aindividuAnnuaire->getIndividuPassword () ) . '\'
				,date_add = CURDATE()
				,date_upd = CURDATE()
				,login_ciscar = \'' . $aindividuAnnuaire->getIndividuLoginSage () . '\'
				,pwdclear = \'' . $aindividuAnnuaire->getIndividuPassword () . '\'
				where id_customer = %s';
		$query = sprintf ( $sql, mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuID () ) );

		mysqli_query ( $_SESSION['LINK_PRESTASHOP'] , $query ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );
	}
	public function SQL_INSERT_CUSTOMER($individuAnnuaire, $prestaShopCustomer) {

		$cookie_key_prestashop = 'H8ZcCJUUK6IbUrYs3cMoFdE2JViQqo40SovXZdwPHz7afAKZPDrkpqzn';
		$aindividuAnnuaire = new IndividuAnnuaire ();
		$aindividuAnnuaire = $individuAnnuaire;
		$aprestaShopCustomer = new PrestaShopCustomer ();
		$aprestaShopCustomer = $prestaShopCustomer;

		$sql = 'INSERT INTO prestashop.ps_customer(
	id_customer
	,id_shop_group
	,id_shop
	,id_gender
	,id_default_group
	,id_lang
	,id_risk
	,company
	,firstname
	,lastname
	,email
	,passwd
	,last_passwd_gen
	,newsletter
	,newsletter_date_add
	,optin
	,outstanding_allow_amount
	,show_public_prices
	,max_payment_days
	,secure_key
	,active
	,is_guest
	,deleted
	,date_add
	,date_upd
	,login_ciscar
	,pwdclear
	) VALUES (
	' . $aindividuAnnuaire->getIndividuID () . '
	,' . $aprestaShopCustomer->getIdShopGroup () . '
	,' . $aprestaShopCustomer->getIdShop () . '
	,' . $aindividuAnnuaire->getIndividuCivilite () . '
	,' . $aprestaShopCustomer->getIdShop () . '
	,' . $aprestaShopCustomer->getIdLang () . '
	,1
	,\'' . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuEtablissement () ) . '\'
	,\'' . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuPrenom () ) . '\'
	,\'' . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividunom () ) . '\'
	,\'' . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuMail () ) . '\'
	,\'' . md5 ( $cookie_key_prestashop . $aindividuAnnuaire->getIndividuPassword () ) . '\'
	,CURDATE()
	,' . $aprestaShopCustomer->getNewsletter () . '
	,CURDATE()
	,' . $aprestaShopCustomer->getOptin () . '
	,' . $aprestaShopCustomer->getOutstandingAllowAmount () . '
	,' . $aprestaShopCustomer->getShowPublicPrices () . '
	,' . $aprestaShopCustomer->getMaxPaymentDays () . '
	,\'' . md5 ( uniqid ( rand (), true ) ) . '\'
	,' . $aprestaShopCustomer->getActive () . '
	,' . $aprestaShopCustomer->getIsGest () . '
	,' . $aprestaShopCustomer->getDeleted () . '
	,CURDATE()
	,CURDATE()
	,\'' . $aindividuAnnuaire->getIndividuLoginSage () . '\'
	,\'' . $aindividuAnnuaire->getIndividuPassword () . '\'
	)';
		mysqli_query ( $_SESSION['LINK_PRESTASHOP'] , $sql ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );
	}
	public function SQL_INSERT_CUSTOMER_BY_EMAIL($individuAnnuaire) {

		$cookie_key_prestashop = 'H8ZcCJUUK6IbUrYs3cMoFdE2JViQqo40SovXZdwPHz7afAKZPDrkpqzn';
		$aindividuAnnuaire = new IndividuAnnuaire ();
		$aindividuAnnuaire = $individuAnnuaire;

		$sql = 'INSERT INTO prestashop.ps_customer(
	id_customer
	,id_shop_group
	,id_shop
	,id_gender
	,id_default_group
	,id_lang
	,id_risk
	,company
	,firstname
	,lastname
	,email
	,passwd
	,last_passwd_gen
	,newsletter
	,newsletter_date_add
	,optin
	,outstanding_allow_amount
	,show_public_prices
	,max_payment_days
	,secure_key
	,active
	,is_guest
	,deleted
	,date_add
	,date_upd
	,login_ciscar
	,pwdclear
	) VALUES (
	' . $aindividuAnnuaire->getIndividuID () . '
	,1
	,1
	,' . $aindividuAnnuaire->getIndividuCivilite () . '
	,3
	,1
	,0
	,\'' . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuEtablissement () ) . '\'
	,\'' . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuPrenom () ) . '\'
	,\'' . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuNom () ) . '\'
	,\'' . $aindividuAnnuaire->getIndividuMail () . '\'
	,\'' . md5 ( $cookie_key_prestashop . $aindividuAnnuaire->getIndividuPassword () ) . '\'
	,CURDATE()
	,1
	,CURDATE()
	,0
	,0
	,0
	,0
	,\'' . md5 ( uniqid ( rand (), true ) ) . '\'
	,0
	,0
	,0
	,CURDATE()
	,CURDATE()
	,\'' . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuLoginSage () ) . '\'
	,\'' . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuPassword () ) . '\'
	)';
		mysqli_query ( $_SESSION['LINK_PRESTASHOP'] , $sql ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );
	}
	public function SQL_INSERT_CUSTOMER_ADRESSES_BY_ID($etablissement, $individuAnnuaire) {

		$aPrestashopAdresses = new PrestaShopAdresses ();
		$aetablissement = new Etablissement ();
		$aetablissement = $etablissement;
		$aindividuAnnuaire = new IndividuAnnuaire ();
		$aindividuAnnuaire = $individuAnnuaire;

		$sql = "INSERT INTO ps_address(
		id_country
		,id_state
		,id_customer
		,id_manufacturer
		,id_supplier
		,id_warehouse
		,alias
		,company
		,lastname
		,firstname
		,address1
		,address2
		,postcode
		,city
		,other
		,phone
		,phone_mobile
		,vat_number
		,dni
		,date_add
		,date_upd
		,active
		,deleted
		,ref_cli_sage
		) VALUES (" . $aPrestashopAdresses->SQL_SELECT_ID_COUTRY_BY_NAME ( $aetablissement->getPays () ) . "
		,0
		," . $aindividuAnnuaire->getIndividuID () . "
		,0
		,0
		,0
		,'" . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aetablissement->getRaisonSociale () ) . " (" . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aetablissement->getCodePostal () ) . ")'" . "
		,'" . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aetablissement->getRaisonSociale () ) . "'
		,'" . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuNom () ) . "'
		,'" . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aindividuAnnuaire->getIndividuPrenom () ) . "'
		,'" . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aetablissement->getAdresse1 () ) . "'
		,'" . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aetablissement->getAdresse2 () ) . "'
		,'" . $aetablissement->getCodePostal () . "'
		,'" . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $aetablissement->getVille () ) . "'
		,''
		,'" . $aetablissement->getTelephone () . "'	
		,''
		,''
		,''
		,CURDATE()
		,CURDATE()
		,1
		,0
		,'" . $aetablissement->getLoginSage () . "')";

		mysqli_query ( $_SESSION['LINK_PRESTASHOP'] , $sql ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );
	}
	public function SQL_SELECT_AUTO_INCREMENT($table) {

		$sql = "SHOW TABLE STATUS LIKE '%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $table ) );
		$result = mysqli_query ( $_SESSION['LINK_PRESTASHOP'] , $query ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );
		$row = mysqli_fetch_array ( $result );
		$this->nextid = $row ['Auto_increment'];
		mysqli_free_result ( $result );
	}
	public function SQL_DESACTIVE_AUTO_INCREMENT($table, $nameID) {

		$sql = "ALTER TABLE %s CHANGE %s %s INT( 10 ) NOT NULL";
		$query = sprintf ( $sql, mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $table ), mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $nameID ), mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $nameID ) );
		$result = mysqli_query ( $_SESSION['LINK_PRESTASHOP'] , $query ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );
	}
	public function SQL_ACTIVE_AUTO_INCREMENT($table, $nameID) {

		$sql = "ALTER TABLE %s CHANGE %s %s INT( 10 ) NOT NULL AUTO_INCREMENT";
		$query = sprintf ( $sql, mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $table ), mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $nameID ), mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $nameID ) );
		$result = mysqli_query ( $_SESSION['LINK_PRESTASHOP'] , $query ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );
	}
}

?>