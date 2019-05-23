<?php
class NewsletterManager {
	public function get($aID) {
		$sql = "SELECT NewsID, Nom, FromTo, ReplyTo, Subject, RichContentValue, CssHeader, SiteID FROM wcm_newsletter";
		$sql .= " WHERE SiteID='%s' AND NewsID='%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ), mysqli_real_escape_string ($_SESSION['LINK'] , $aID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		$aNewsletter = new Newsletter ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			$aNewsletter->setID ( ( int ) $line [0] );
			$aNewsletter->setName ( $line [1] );
			$aNewsletter->setFrom ( $line [2] );
			$aNewsletter->setReplyTo ( $line [3] );
			$aNewsletter->setSubject ( $line [4] );
			$aNewsletter->setRichContentValue ( $line [5] );
			$aNewsletter->setCssHeader ( $line [6] );
			$aNewsletter->setSiteID ( ( int ) $line [7] );
		}
		
		mysqli_free_result ( $result );
		
		return $aNewsletter;
	}
	public function count() {
		$sql = "SELECT count(*) FROM wcm_newsletter WHERE SiteID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $_SESSION ['SITE'] ['ID'] ) );
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		$line = 0;
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			$line = $line [0];
		}
		mysqli_free_result ( $result );
		return $line;
	}
}

?>