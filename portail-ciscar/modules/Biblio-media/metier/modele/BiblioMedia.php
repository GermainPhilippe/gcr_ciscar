<?php
class BiblioMedia {
	private $id;
	private $titre;
	private $description;
	private $create_on;
	private $file_name;
	private $file_mime;
	private $file_size;
	private $file_blob;
	
	// Constructor //
	public function __construct() {
		$this->id = null;
		$this->titre = '';
		$this->description = '';
		$this->create_on = date ( "Y-m-d" );
		
		$this->file_name = '';
		$this->file_mime = '';
		$this->file_size = 0;
		$this->file_blob = null;
	}
	
	// Getters & Setters //
	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getTitre() {
		return $this->titre;
	}
	public function setTitre($titre) {
		$this->titre = $titre;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
	}
	public function getCreateOn() {
		return $this->create_on;
	}
	public function setCreateOn($date) {
		$this->create_on = $date;
	}
	
	// Getters & Setters FILE //
	public function getFileName() {
		return $this->file_name;
	}
	public function setFileName($name) {
		$this->file_name = $name;
	}
	public function getFileMime() {
		return $this->file_mime;
	}
	public function setFileMime($mime) {
		$this->file_mime = $mime;
	}
	public function getFileSize() {
		return $this->file_size;
	}
	public function setFileSize($size) {
		$this->file_size = $size;
	}
	public function getFileBlob() {
		return $this->file_blob;
	}
	public function setFileBlob($blob) {
		$this->file_blob = $blob;
	}
	
	// Export //
	public function toXML() {
		$xml = '<BiblioMedia>' . PHP_EOL;
		$xml .= '<id>' . $this->id . '</id>' . PHP_EOL;
		$xml .= '<titre><![CDATA[' . $this->titre . ']]></titre>' . PHP_EOL;
		$xml .= '<description><![CDATA[' . $this->description . ']]></description>' . PHP_EOL;
		$xml .= '<createon><![CDATA[' . $this->create_on . ']]></createon>' . PHP_EOL;
		
		$xml .= '<filename><![CDATA[' . $this->file_name . ']]></filename>' . PHP_EOL;
		$xml .= '<filesize>' . $this->file_size . '</filesize>' . PHP_EOL;
		$xml .= '<filemime><![CDATA[' . $this->file_mime . ']]></filemime>' . PHP_EOL;
		$xml .= '</BiblioMedia>' . PHP_EOL;
		return $xml;
	}
}