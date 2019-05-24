<?php
class DocInfoDynCommentaireView {
	private $myCommentaire;
	public function __construct(DocInfoDynCommentaire $aCommentaire) {
		$this->myCommentaire = $aCommentaire;
	}
	public function renderHTML() {
		// Fil D'ariane
		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?action=edit&id=' . $_GET ['id'] . '">DocInfoDyn</a>&nbsp;>&nbsp;Commentaire';
		$aff .= '</div>';

		$aIndividu = new Simple_Individu ();
		$aIndividu->SQL_SELECT ( ( int ) $this->myCommentaire->getAuthorID () );

		$aff .= '<table>';
		$aff .= '<tr><td valign="top"><b>Auteur</b></td><td>' . $aIndividu->getNom () . ' ' . $aIndividu->getPrenom () . '</td></tr>';
		$aff .= '<tr><td valign="top"><b>Date</b></td><td>' . $this->myCommentaire->getDateCreation () . '</td></tr>';
		$aff .= '<tr><td valign="top"><b>Commentaire</b></td><td>' . nl2br ( htmlentities ( stripslashes ( $this->myCommentaire->getRichTextContentValue () ) ) ) . '</td></tr>';
		$aff .= '</table>';

		echo $aff;
	}
}
?>