<?php
class NewsletterHistoriqueView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">Newsletter</a>&nbsp;>&nbsp;Historique</div><br/><br/>' . "\n";

		$aff .= '<table id="TableList">' . "\n";
		$aff .= '<tr class="title">';
		$aff .= '<td width="50">#</td>';
		$aff .= '<td>Date</td>';
		$aff .= '<td>Description</td>';
		$aff .= '</tr>' . "\n";

		foreach ( $this->myList as $aNewsletterHistorique ) {
			$aff .= '<tr>';
			$aff .= '<td width="50" align="center">' . $aNewsletterHistorique->getID () . '</td>';
			$aff .= '<td align="center">' . $aNewsletterHistorique->getDateCreation () . '</td>';
			$aff .= '<td>' . $aNewsletterHistorique->getDescription () . '</td>';
			$aff .= '</tr>' . "\n";
		}
		$aff .= '</table>';

		echo $aff;
	}
	public function renderEnvoiHTML() {
		$aff = '<table id="TableListEnvois" class="TabEnvois">' . "\n";
		$aff .= '<tr">';
		$aff .= '<td align="center"><b>#</b></td>';
		$aff .= '<td align="center"><b>Date</b></td>';
		$aff .= '<td align="center"><b>Envois</b></td>';
		$aff .= '<td align="center"><b>Lecteurs</b></td>';
		$aff .= '<td align="center"><b>Ouvertures</b></td>';
		$aff .= '<td align="center"><b>Clicks</b></td>';
		$aff .= '<td align="center"><b></b></b></td>';
		$aff .= '<td align="center"><b></b></b></td>';
		$aff .= '</tr>' . "\n";

		foreach ( $this->myList as $aNewsletterHistorique ) {
			$aNewsletterHistoriqueEnvoiManager = new NewsletterHistoriqueManager ();
			$aListEnvois = $aNewsletterHistoriqueEnvoiManager->getEnvois ( $aNewsletterHistorique->getEnvoiID () );

			foreach ( $aListEnvois as $aNewsletterEnvoisHistorique ) {
				if ($aNewsletterEnvoisHistorique->getNbTot () > 10) {
					$aff .= '<tr>';
					$aff .= '<td width="50" align="center">' . $aNewsletterEnvoisHistorique->getEnvoiID () . '</td>';
					$aff .= '<td align="center">' . $aNewsletterEnvoisHistorique->getDateCreation () . '</td>';
					$aff .= '<td align="center">' . $aNewsletterEnvoisHistorique->getNbTot () . '</td>';
					$aff .= '<td align="center">' . $aNewsletterEnvoisHistorique->getNbLecteurs () . '</td>';
					$aff .= '<td align="center">' . $aNewsletterEnvoisHistorique->getNbOuv () . '</td>';
					$aff .= '<td align="center">' . $aNewsletterEnvoisHistorique->getNbClicks () . '</td>';
					$aff .= '<td width="50" align="center"><a href="index.php?action=detenv&envid=' . $aNewsletterEnvoisHistorique->getEnvoiID () . '" target="_parent"><img src="../../include/images/apercu.jpg" border=0/></a></td>';
					$aff .= '<td width="50" align="center"><a href="export.php?envid=' . $aNewsletterEnvoisHistorique->getEnvoiID () . '" target="_parent"><img src="../../include/images/export/csv_file.png" /></a></td>';
					$aff .= '</tr>' . "\n";
				}
			}
		}
		$aff .= '</table>';

		echo $aff;
	}
}
?>