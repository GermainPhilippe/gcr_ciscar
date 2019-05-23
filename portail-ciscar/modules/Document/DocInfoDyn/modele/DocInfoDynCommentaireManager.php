<?php
/**
 * Cette classe permet de gerer les commentaires en base de données
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage document
 * @version 2.0.1
 */
class DocInfoDynCommentaireManager {
	public function __construct() {
	}
	
	// ###
	
	/**
	 * Cette methode permet de créer un Commentaire
	 *
	 * @param DocInfoDynCommentaire $aDocInfoDynCommentaire        	
	 */
	public function add(DocInfoDynCommentaire $aDocInfoDynCommentaire) {
		$sql = "INSERT INTO wcm_commentaire (CommentaireID, SiteID, AuthorID, DocInfoDynID, DateCreation, RichContentValue)";
		$sql .= " VALUES(NULL,'%s','%s','%s', NOW() ,'%s')";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaire->getSiteID () ), mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaire->getAuthorID () ), mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaire->getDocInfoDynID () ), mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaire->getRichTextContentValue () ) );
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	
	/**
	 * Cette methode permet de modifier un Commentaire
	 *
	 * @param DocInfoDynCommentaire $aDocInfoDynCommentaire        	
	 */
	public function update(DocInfoDynCommentaire $aDocInfoDynCommentaire) {
		$sql = "UPDATE wcm_commentaire SET AuthorID='%s', DocInfoDynID='%s', DateCreation='%s', RichContentValue='%s' WHERE CommentaireID = '%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaire->getAuthorID () ), mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaire->getDocInfoDynID () ), mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaire->getDateCreation () ), mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaire->getRichTextContentValue () ), mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaire->getID () ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	
	/**
	 * Cette methode permet de supprimer un commentaire
	 *
	 * @param int $aCommentaireID        	
	 */
	public function delete($aCommentaireID) {
		$sql = "DELETE FROM wcm_commentaire WHERE CommentaireID='%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aCommentaireID ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	
	/**
	 * Cette methode permet de selectionner un commentaire
	 *
	 * @param int $aCommentaireID        	
	 * @return DocInfoDynCommentaire
	 */
	public function get($aCommentaireID) {
		$sql = "SELECT CommentaireID, AuthorID,DocInfoDynID, CONCAT('le ', DATE_FORMAT(DateCreation,GET_FORMAT(DATE,'EUR')),' à ', DATE_FORMAT(DateCreation,GET_FORMAT(TIME,'EUR'))), RichContentValue, SiteID ";
		$sql .= "FROM wcm_commentaire ";
		$sql .= "WHERE CommentaireID='%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aCommentaireID ) );
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		$aDocInfoDynCommentaire = new DocInfoDynCommentaire ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			$aDocInfoDynCommentaire->setID ( ( int ) $line [0] );
			$aDocInfoDynCommentaire->setAuthorID ( ( int ) $line [1] );
			$aDocInfoDynCommentaire->setDocInfoDynID ( ( int ) $line [2] );
			$aDocInfoDynCommentaire->setDateCreation ( $line [3] );
			$aDocInfoDynCommentaire->setRichTextContentValue ( $line [4] );
			$aDocInfoDynCommentaire->setSiteID ( ( int ) $line [5] );
		}
		mysqli_free_result ( $result );
		return $aDocInfoDynCommentaire;
	}
	
	/**
	 * Cette methode permet de sauvegarder un commentaire
	 *
	 * @param DocInfoDynCommentaire $aDocInfoDynCommentaire        	
	 */
	public function save(DocInfoDynCommentaire $aDocInfoDynCommentaire) {
		$aDocInfoDynCommentaire->isNew () ? $this->add ( $aDocInfoDynCommentaire ) : $this->update ( $aDocInfoDynCommentaire );
	}
	
	/**
	 * cette methode permet de renvoyer le nombre de commentaire
	 *
	 * @return int
	 */
	public function count() {
		$sql = "SELECT count(CommentaireID) FROM wcm_commentaire";
		$result = mysqli_query ( $_SESSION['LINK'] ,$sql ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		$line = 0;
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array ( $result );
			$line = $line [0];
		}
		mysqli_free_result ( $result );
		return $line;
	}
	
	/**
	 * Cette methode permet de selectionner une liste de commentaires
	 *
	 * @param int $debut        	
	 * @param int $limite        	
	 * @return DocInfoDynCommentaire[]
	 */
	public function getList($aDocInfoDynID, $debut = -1, $limite = -1) {
		$aArray = array ();
		
		$sql = "SELECT CommentaireID, AuthorID, DocInfoDynID, CONCAT('le ', DATE_FORMAT(DateCreation,GET_FORMAT(DATE,'EUR')),' à ', DATE_FORMAT(DateCreation,GET_FORMAT(TIME,'EUR'))), RichContentValue, SiteID FROM wcm_commentaire";
		$sql .= " WHERE DocInfoDynID='%s' ORDER BY DateCreation DESC";
		if ($debut != - 1 || $limite != - 1) {
			$sql .= ' LIMIT ' . ( int ) $debut . ', ' . ( int ) $limite;
		}
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynID ) );
		
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aDocInfoDynCommentaire = new DocInfoDynCommentaire ();
			$aDocInfoDynCommentaire->setID ( ( int ) $line [0] );
			$aDocInfoDynCommentaire->setAuthorID ( ( int ) $line [1] );
			$aDocInfoDynCommentaire->setDocInfoDynID ( ( int ) $line [2] );
			$aDocInfoDynCommentaire->setDateCreation ( $line [3] );
			$aDocInfoDynCommentaire->setRichTextContentValue ( $line [4] );
			$aDocInfoDynCommentaire->setSiteID ( ( int ) $line [5] );
			$aArray [] = $aDocInfoDynCommentaire;
		}
		mysqli_free_result ( $result );
		
		return $aArray;
	}
}
?>