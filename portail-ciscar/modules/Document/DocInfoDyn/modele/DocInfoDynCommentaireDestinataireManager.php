<?php
class DocInfoDynCommentaireDestinataireManager {
	public function __construct() {
	}
	
	// ###
	public function add(DocInfoDynCommentaireDestinataire $aDocInfoDynCommentaireDestinataire) {
		$sql = "INSERT INTO wcm_commentaire_destinataire (DocInfoDynID, IndividuID) VALUES('%s','%s')";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaireDestinataire->getDocInfoDynID () ), mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaireDestinataire->getIndividuID () ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete(DocInfoDynCommentaireDestinataire $aDocInfoDynCommentaireDestinataire) {
		$sql = "DELETE FROM wcm_commentaire_destinataire WHERE DocInfoDynID='%s' AND IndividuID='%s'";
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaireDestinataire->getDocInfoDynID () ), mysqli_real_escape_string ($_SESSION['LINK'] , $aDocInfoDynCommentaireDestinataire->getIndividuID () ) );
		
		mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function getList($DocInfoDynID, $debut = -1, $limite = -1) {
		$aArray = array ();
		
		$sql = "SELECT DocInfoDynID, IndividuID FROM wcm_commentaire_destinataire WHERE DocInfoDynID='%s'";
		if ($debut != - 1 || $limite != - 1) {
			$sql .= ' LIMIT ' . ( int ) $debut . ', ' . ( int ) $limite;
		}
		
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'] , $DocInfoDynID ) );
		$result = mysqli_query ( $_SESSION['LINK'] ,$query ) or die ( mysqli_error ($_SESSION['LINK']) );
		
		while ( $line = mysqli_fetch_array ( $result ) ) {
			$aDocInfoDynCommentaireDestinataire = new DocInfoDynCommentaireDestinataire ();
			$aDocInfoDynCommentaireDestinataire->setDocInfoDynID ( ( int ) $line [0] );
			$aDocInfoDynCommentaireDestinataire->setIndividuID ( ( int ) $line [1] );
			
			$aArray [] = $aDocInfoDynCommentaireDestinataire;
		}
		mysqli_free_result ( $result );
		
		return $aArray;
	}
}
?>