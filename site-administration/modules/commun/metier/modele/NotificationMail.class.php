<?php
class NotificationMail {
	private $MailFrom;
	private $MailTo;
	private $MailSubject;
	private $MailMessage;

	// Header
	private $MailContentType;
	private $MailReplyTo;
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
	public function getMessage() {
		return $this->MailMessage;
	}
	public function setHeaderReplyTo($newValue) {
		$this->MailReplyTo = $newValue;
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
			$message .= "Content-Disposition: attachment; filename=\"" . $realname . "\"" . $passage_ligne;
			$message .= $passage_ligne . $attachement . $passage_ligne . $passage_ligne;
			$message .= $passage_ligne . "--" . $boundary . "--" . $passage_ligne;

			$this->MailAttachment [] = $message;
		}
	}
	public function getAttachment() {
		return $this->MailAttachment;
	}
	
	public function send_phpMailer() {
				
		$phpmail = new PHPMailer();
		
		$phpmail->isSMTP();
		$phpmail->Host = '192.168.16.201';
		$phpmail->Port = 587;
		$phpmail->SMTPAuth = true;
		$phpmail->SMTPSecure = 'tls';
		$phpmail->Username = 'administrateur';
		$phpmail->Password = 'h5MVP75z';
		$phpmail->Port = 25;
		$phpmail->isHTML();
		
		$phpmail->setFrom($this->MailFrom);
		
		$phpmail->addAddress($this->MailTo);
		$subject_stripslashes = stripslashes ( $this->MailSubject );
		$subject = mb_encode_mimeheader ( $subject_stripslashes, "UTF-8", "B", "\n" );
		$phpmail->Subject = $subject;
		
		$phpmail->Body = $this->MailMessage;
		if(!$phpmail->send())
		{
			echo $phpmail->ErrorInfo ;
		}
	}
	
	// ###
	public function send() {
		$passage_ligne = "\r\n";
		$boundary = "-----=" . md5 ( 'abakus' );
		$boundary_alt = "-----=" . md5 ( 'abakus' );

		// HEADER PRINCIPAL
		$headers = "From: " . $this->MailFrom . $passage_ligne;
		$headers .= "Reply-To: " . $this->MailReplyTo . $passage_ligne;
		// $headers.= "Return-Path: p.germain@gcrfrance.com".$passage_ligne;
		$headers .= "MIME-Version: 1.0" . $passage_ligne;
		$headers .= "Content-Type: multipart/mixed;" . $passage_ligne . " boundary=\"$boundary\"" . $passage_ligne;
		// $headers.= "Content-Type: multipart/mixed;charset=UTF-8".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
		// $headers.= "Content-Type: multipart/mixed; charset=\"ISO-8859-1\"".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

		// HEADER MESSAGE
		$message = $passage_ligne . "--" . $boundary . $passage_ligne;
		$message .= "Content-Type: text/html; charset=\"ISO-8859-1\"" . $passage_ligne;
		$message .= "Content-Transfer-Encoding: 8bit" . $passage_ligne;
		$message .= $passage_ligne . $this->MailMessage . $passage_ligne;

		if (count ( $this->MailAttachment ) > 0) {
			foreach ( $this->MailAttachment as $aAttachment ) {
				$message .= $passage_ligne . "--" . $boundary . $passage_ligne;
				$message .= $aAttachment;
			}
		}

		// return mail($this->MailTo, stripslashes($this->MailSubject), $message, $headers, '-f'.$this->MailFrom);
		// return mail($this->MailTo, stripslashes($this->MailSubject), $message, $headers, '-f'.$this->MailReplyTo);
		// return mail($this->MailTo, stripslashes($this->MailSubject), $message, $headers, '-fjanna.k@ciscar.fr');
		$subject_stripslashes = stripslashes ( $this->MailSubject );
		
		//$subject = mb_encode_mimeheader ( $subject_stripslashes, "UTF-8", "B", "\n" );
		//$subject = mb_encode_mimeheader ( $subject_stripslashes, "iso-8859-15", "B", "\n" );
		$subject = $subject_stripslashes;
		
		return mail ( $this->MailTo, $subject, $message, $headers, '-ff.chazarenc@ciscar.fr' );

		// die();
		// return mail($this->MailTo, stripslashes($this->MailSubject), $message, $headers);
	}
}
?>