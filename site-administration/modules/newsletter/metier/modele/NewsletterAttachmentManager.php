<?php
class NewsletterAttachmentManager {
	public function add(NewsletterAttachment $newsletterAttachment) {
		$sql = "INSERT INTO wcm_newsletter_attachment(id, newsletterID, name, size, mime, data)";
		$sql .= " VALUES(NULL,'%s', '%s', '%s', '%s', '%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $newsletterAttachment->getNewsletterID () ), mysqli_real_escape_string ($_SESSION['LINK'], $newsletterAttachment->getName () ), mysqli_real_escape_string ($_SESSION['LINK'], $newsletterAttachment->getSize () ), mysqli_real_escape_string ($_SESSION['LINK'], $newsletterAttachment->getMime () ), mysqli_real_escape_string ($_SESSION['LINK'], $newsletterAttachment->getData () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($id) {
		$sql = "DELETE FROM wcm_newsletter_attachment WHERE id='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function get($id) {
		$sql = "SELECT id, newsletterID, name, size, mime, data FROM wcm_newsletter_attachment WHERE id='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$newsletterAttachment = new NewsletterAttachment ();
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$newsletterAttachment->setID ( $line [0] );
			$newsletterAttachment->setNewsletterID ( $line [1] );
			$newsletterAttachment->setName ( $line [2] );
			$newsletterAttachment->setSize ( $line [3] );
			$newsletterAttachment->setMime ( $line [4] );
			$newsletterAttachment->setData ( $line [5] );
		}

		mysqli_free_result  ( $result );

		return $newsletterAttachment;
	}
	public function getListByNewsletter($id) {
		$sql = "SELECT id, newsletterID, name, size, mime, data FROM wcm_newsletter_attachment WHERE newsletterID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $id ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$collection = array ();
		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$newsletterAttachment = new NewsletterAttachment ();
			$newsletterAttachment->setID ( $line [0] );
			$newsletterAttachment->setNewsletterID ( $line [1] );
			$newsletterAttachment->setName ( $line [2] );
			$newsletterAttachment->setSize ( $line [3] );
			$newsletterAttachment->setMime ( $line [4] );
			$newsletterAttachment->setData ( $line [5] );
			$collection [] = $newsletterAttachment;
		}

		mysqli_free_result  ( $result );

		return $collection;
	}
}