<?php
/**
 * @author Philippe GERMAIN
 * @package site-administration
 * @subpackage prestashop
 * @version 1.0.4
 */
class PrestaShopAdresses {
	private $idAdresse;
	private $idCountry;
	private $countryName;
	private $idState;
	private $idCustomer;
	private $idManufacturer;
	private $idSupplier;
	private $idWharehouse;
	private $alias;
	private $company;
	private $lastname;
	private $firstname;
	private $adresse1;
	private $adresse2;
	private $postcode;
	private $city;
	private $phone;
	private $phoneMobile;
	private $vatNumber;
	private $dni;
	private $active;
	private $deleted;
	private $dateAdd;
	private $dateUpd;
	private $refCliSage;
	public function __construct() {
		$this->idAdresse = 0;
	}

	// ###
	public function getIdAdresse() {
		return $this->idAdresse;
	}
	public function getIdCountry() {
		return $this->idCountry;
	}
	public function getCountryName() {
		return $this->countryName;
	}
	public function getIdState() {
		return $this->idState;
	}
	public function getIdCustomer() {
		return $this->idCustomer;
	}
	public function getIdManufacturer() {
		return $this->idManufacturer;
	}
	public function getIdSupplier() {
		return $this->idSupplier;
	}
	public function getIdWharehouse() {
		return $this->idWharehouse;
	}
	public function getAlias() {
		return $this->alias;
	}
	public function getCompany() {
		return $this->company;
	}
	public function getLastname() {
		return $this->lastname;
	}
	public function getFirstname() {
		return $this->firstname;
	}
	public function getAdresse1() {
		return $this->adresse1;
	}
	public function getAdresse2() {
		return $this->adresse2;
	}
	public function getPostcode() {
		return $this->postcode;
	}
	public function getCity() {
		return $this->city;
	}
	public function getPhone() {
		return $this->phone;
	}
	public function getPhoneMobile() {
		return $this->phoneMobile;
	}
	public function getVatNumber() {
		return $this->vatNumber;
	}
	public function getDni() {
		return $this->dni;
	}
	public function getActive() {
		return $this->active;
	}
	public function getDeleted() {
		return $this->deleted;
	}
	public function getDateAdd() {
		return $this->dateAdd;
	}
	public function getDateUpd() {
		return $this->dateupd;
	}
	public function getRefCliSage() {
		return $this->refCliSage;
	}

	// ###
	public function setIdAdresse($newValue) {
		$this->idAdresse = $newValue;
	}
	public function setIdCountry($newValue) {
		$this->idCountry = $newValue;
	}
	public function setCountryName($newValue) {
		$this->countryName = $newValue;
	}
	public function setIdState($newValue) {
		$this->idState = $newValue;
	}
	public function setIdCustomer($newValue) {
		$this->idCustomer = $newValue;
	}
	public function setIdManufacturer($newValue) {
		$this->idManufacturer = $newValue;
	}
	public function setIdSupplier($newValue) {
		$this->idSupplier = $newValue;
	}
	public function setIdWharehouse($newValue) {
		$this->idWharehouse = $newValue;
	}
	public function setAlias($newValue) {
		$this->alias = $newValue;
	}
	public function setCompany($newValue) {
		$this->company = $newValue;
	}
	public function set($newValue) {
		$this->lastname = $newValue;
	}
	public function setFirstname($newValue) {
		$this->firstname = $newValue;
	}
	public function setAdresse1($newValue) {
		$this->adresse1 = $newValue;
	}
	public function setAdresse2($newValue) {
		$this->adresse2 = $newValue;
	}
	public function setPostcode($newValue) {
		$this->postcode = $newValue;
	}
	public function setCity($newValue) {
		$this->city = $newValue;
	}
	public function setPhone($newValue) {
		$this->phone = $newValue;
	}
	public function setPhoneMobile($newValue) {
		$this->phoneMobile = $newValue;
	}
	public function setVatNumber($newValue) {
		$this->vatNumber = $newValue;
	}
	public function setDni($newValue) {
		$this->dni = $newValue;
	}
	public function setActive($newValue) {
		$this->active = $newValue;
	}
	public function setDeleted($newValue) {
		$this->deleted = $newValue;
	}
	public function setDateAdd($newValue) {
		$this->dateAdd = $newValue;
	}
	public function setDateUpd($newValue) {
		$this->dateupd = $newValue;
	}
	public function setRefCliSage($newValue) {
		$this->refCliSage = $newValue;
	}

	// ###
	public function SQL_SELECT_ID_COUTRY_BY_NAME($country) {

		$sql = "SELECT id_country from ps_country_lang where id_lang = 1 and name ='" . mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $country ) . "'";
		$result = mysqli_query ( $_SESSION['LINK_PRESTASHOP'],$sql ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );
		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			$this->setCountryName ( $line [0] );
		} else {
			// Belgique par défaut
			$this->setCountryName ( 3 );
		}
		return $this->getCountryName ();
	}
	public function SQL_DELETE_ADRESSES_FROM_CUSTOMER_ID($customerID) {

		$sql = "Delete from ps_address where id_customer = %s";
		$query = sprintf ( $sql, mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $customerID ) );
		$result = mysqli_query ( $_SESSION['LINK_PRESTASHOP'],$query ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );
	}
	public function SQL_SELECT_ADRESSE_BY_CUSTOMER_ID($customerID) {

		$this->myList = array ();

		$sql = "SELECT id_address, id_country, id_state, id_customer, id_manufacturer, id_supplier, id_warehouse, alias, company, lastname, firstname, 
		address1, address2, postcode, city, other, phone, phone_mobile, vat_number, dni, date_add, date_upd, active, deleted, ref_cli_sage
		FROM prestashop.ps_address where id_customer = %s";
		$query = sprintf ( $sql, mysqli_real_escape_string ( $_SESSION['LINK_PRESTASHOP'] , $customerID ) );
		$result = mysqli_query ( $_SESSION['LINK_PRESTASHOP'],$query ) or die ( mysqli_error ($_SESSION['LINK_PRESTASHOP']) );

		if (mysqli_num_rows ( $result ) == 1) {
			$line = mysqli_fetch_array ( $result );
			$this->setIdAdresse ( $line [0] );
			$this->setIdCountry ( $line [1] );
			$this->setIdState ( $line [2] );
			$this->setIdCustomer ( $line [3] );
			$this->setIdManufacturer ( $line [4] );
			$this->setIdSupplier ( $line [5] );
			$this->setIdWharehouse ( $line [6] );
			$this->setAlias ( $line [7] );
			$this->setCompany ( $line [8] );
			$this->setLastname ( $line [9] );
			$this->setFirstname ( $line [10] );
			$this->setAdresse1 ( $line [11] );
			$this->setAdresse2 ( $line [12] );
			$this->setPostcode ( $line [13] );
			$this->setCity ( $line [14] );
			$this->setPhone ( $line [15] );
			$this->setPhoneMobile ( $line [16] );
			$this->setVatNumber ( $line [17] );
			$this->setDni ( $line [18] );
			$this->setDateAdd ( $line [19] );
			$this->setDateUpd ( $line [20] );
			$this->setActive ( $line [21] );
			$this->setDeleted ( $line [22] );
			$this->setRefCliSage ( $line [23] );
		} else {
			if (mysqli_num_rows ( $result ) > 1)
				$this->setIdAdresse ( - 1 );
			else
				$this->setIdAdresse ( 0 );
		}
		mysqli_free_result ( $result );
	}
}

?>