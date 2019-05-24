<?php
class NewsletterEnvoisDetailsView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">Newsletter</a>&nbsp;>&nbsp;Détail</div><br/><br/>' . "\n";

		$aff .= '<table id="TableList">' . "\n";
		$aff .= '<tr class="title">';
		$aff .= '<td width="100px">IndividuID</td>';
		$aff .= '<td width="15%">Date dernière ouverture</td>';
		$aff .= '<td width="15%">Nom</td>';
		$aff .= '<td width="15%">Prénom</td>';
		$aff .= '<td width="15%">Mail</td>';
		$aff .= '<td width="15%">Login Sage</td>';
		$aff .= '<td width="150px">Ouvertures</td>';
		$aff .= '<td width="100px">Clicks</td>';
		$aff .= '</tr>' . "\n";

		foreach ( $this->myList as $aNewsletterEnvoisDetails ) {
			$aff .= '<tr>';
			$aff .= '<td width="50" align="center">' . $aNewsletterEnvoisDetails->getIndividuID () . '</td>';
			$aff .= '<td align="center">' . $aNewsletterEnvoisDetails->getDateDerOuv () . '</td>';
			$aff .= '<td>' . $aNewsletterEnvoisDetails->getNom () . '</td>';
			$aff .= '<td>' . $aNewsletterEnvoisDetails->getPrenom () . '</td>';
			$aff .= '<td>' . $aNewsletterEnvoisDetails->getMail () . '</td>';
			$aff .= '<td align="center">' . $aNewsletterEnvoisDetails->getLoginSage () . '</td>';
			$aff .= '<td align="center">' . $aNewsletterEnvoisDetails->getNbOuv () . '</td>';
			$aff .= '<td align="center">' . $aNewsletterEnvoisDetails->getNbClicks () . '</td>';
			$aff .= '</tr>' . "\n";
		}
		$aff .= '</table>';

		echo $aff;
	}
}
?>