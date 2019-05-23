<?php
class NotificationMail {
	private $MailFrom;
	private $MailTo;
	private $MailSubject;
	private $MailMessage;
	
	// Header
	private $MailContentType;
	private $MailReplyTo;
	private $MailBcc;
	private $MailContentTransferEncoding;
	private $MailAttachment;
	public function __construct() {
		$this->MailFrom = '';
		$this->MailTo = '';
		$this->MailSubject = '';
		$this->MailMessage = '';
		
		// Header
		$this->MailContentType = '';
		$this->MailReplyTo = '';
		$this->MailBcc = '';
		$this->MailContentTransferEncoding = '';
		
		$this->MailAttachment = array ();
	}
	
	// ###
	public function setFrom($newValue) {
		$this->MailFrom = $newValue;
	}
	public function setTo($newValue) {
		$this->MailTo = $newValue;
	}
	public function setSubject($newValue) {
		$this->MailSubject = $newValue;
	}
	public function setMessage($newValue) {
		$this->MailMessage = $newValue;
	}
	public function setHeaderReplyTo($newValue) {
		$this->MailReplyTo = $newValue;
	}
	public function setHeaderBcc($newValue) {
		$this->MailBcc = $newValue;
	}
	public function setHeaderContentType($newValue) {
		$this->MailContentType = $newValue;
	}
	public function setHeaderContentTransferEncoding($newValue) {
		$this->MailContentTransferEncoding = $newValue;
	}
	public function addAttachmentDATA($mime, $realname, $data_b64) {
		$passage_ligne = "\r\n";
		$boundary = "-----=" . md5 ( 'abakus' );
		$boundary_alt = "-----=" . md5 ( 'abakus' );
		$attachement = chunk_split ( $data_b64 );
		
		$message = "Content-Type: " . $mime . "; name=\"" . $realname . "\"" . $passage_ligne;
		$message .= "Content-Transfer-Encoding: base64" . $passage_ligne;
		$message .= "Content-Disposition: attachment; filename=\"" . $realname . "\"" . $passage_ligne;
		$message .= $passage_ligne . $attachement . $passage_ligne . $passage_ligne;
		
		$this->MailAttachment [] = $message;
	}
	public function addAttachment($mime, $realname, $url) {
		// Lecteur du contenu du fichier
		if (file_exists ( $url )) {
			$fichier = fopen ( $url, "r" );
			$attachement = fread ( $fichier, filesize ( $url ) );
			$attachement = chunk_split ( base64_encode ( $attachement ) );
			fclose ( $fichier );
			
			$passage_ligne = "\r\n";
			$boundary = "-----=" . md5 ( 'abakus' );
			$boundary_alt = "-----=" . md5 ( 'abakus' );
			
			$message = "Content-Type: " . $mime . "; name=\"" . $realname . "\"" . $passage_ligne;
			$message .= "Content-Transfer-Encoding: base64" . $passage_ligne;
			$message .= "Content-Disposition: attachment; filename=\"" . $realname . "\"" . $passage_ligne . $passage_ligne;
			$message .= $attachement . $passage_ligne . $passage_ligne;
			//$message .= "--" . $boundary . $passage_ligne;
			
			$this->MailAttachment [] = $message;
		}
	}
	public function getAttachment() {
		return $this->MailAttachment;
	}
	
	// ###
	public function send() {
		$passage_ligne = "\r\n";
		$boundary = "-----=" . md5 ( 'abakus' );
		$boundary_alt = "-----=" . md5 ( 'abakus' );
		
		// HEADER PRINCIPAL
		$headers = "From: " . $this->MailFrom . $passage_ligne;
		$headers .= "Reply-to: " . $this->MailReplyTo . $passage_ligne;
		$headers .= "Bcc: " . $this->MailBcc . $passage_ligne;
		$headers .= "MIME-Version: 1.0" . $passage_ligne;
		$headers .= "Content-Type: multipart/mixed;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne . $passage_ligne;
		
		// HEADER MESSAGE
		$message = "--" . $boundary . $passage_ligne;
		$message .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $passage_ligne;
		$message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne. $passage_ligne;
		$message .= $this->MailMessage . $passage_ligne . $passage_ligne;
		
		if (count ( $this->MailAttachment ) > 0) {			
			foreach ( $this->MailAttachment as $aAttachment ) {	
				$message .= "--" . $boundary . $passage_ligne;
				$message .= $aAttachment;
			}
		}

		$subject = mb_encode_mimeheader ( $this->MailSubject, "UTF-8", "B", "\n" );
		return mail ( $this->MailTo, stripslashes ( $subject ), $message, $headers, '-f' . $this->MailFrom );
	}
}
?>