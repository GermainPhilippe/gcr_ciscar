<?php
class ListeOutlookView {
	private $myListeBN;
	private $myListeCommissions;
	private $myListeDomaines;
	public function __construct($aListeBN, $aListeCommissions, $aListeDomaines) {
		$this->myListeBN = $aListeBN;
		$this->myListeCommissions = $aListeCommissions;
		$this->myListeDomaines = $aListeDomaines;
	}
	public function renderHTMLBN() {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=1">Site</a>&nbsp;>&nbsp;Outlook</div><br/><br/>' . "\n";

		$aff .= '<table id="TableListOutlook">' . "\n";
		$aff .= '<tr class="title">';
		$aff .= '<td width="89px"><input type="checkbox" id="cocheToutBN"/><label for="cocheToutBN"><span class="uiBN" id="UIcocheToutBN"></span></label></td>';
		$aff .= '<td onclick="showdivBN()" style="cursor:pointer;">Bureau National</td>';
		$aff .= '</tr>' . "\n";
		$aff .= '</table>';

		$aff .= '<div class="BNdiv" name="BNdiv" id="BNdiv" style=" display:none;background-color: #D4D4D4;">';
		$aff .= '<table id="TableBN" border="0" cellspacing="0px" cellpadding="10px">' . "\n";
		$BN_Ind = 0;
		foreach ( $this->myListeBN as $aFonctionBN ) {
			// on recherche les individus rattachés à la fonction
			$myListeIndividus = array ();
			$aFonctionBNindividuListe = new FonctionBNListe ();
			$aFonctionBNindividuListe->select_individus_fonctionbn ( $aFonctionBN->getID () );
			$myListeIndividus = $aFonctionBNindividuListe->getFonctionBNIndividuListe ();

			$aff .= '<tr>';
			if (count ( $myListeIndividus ) > 0)
				$aff .= '<td style="border-bottom:1px solid #fff;" width="50" align="center" valign="top"><input class="chkbxBN" type="checkbox" onclick="cocheBN_Fonc(' . $aFonctionBN->getID () . ')" id="BN' . $aFonctionBN->getID () . '"/><label for="BN' . $aFonctionBN->getID () . '"><span class="uiBN" id="UIBN' . $aFonctionBN->getID () . '"></span></label></td>';
			else
				$aff .= '<td style="border-bottom:1px solid #fff;" width="50" align="center" valign="top">&nbsp;</td>';
			$aff .= '<td style="border-bottom:1px solid #fff;font-weight:bold;" width="50" align="center" valign="top">' . $aFonctionBN->getID () . '</td>';
			if (count ( $myListeIndividus ) > 0)
				$aff .= '<td style="border-bottom:1px solid #fff;border-right:1px solid #fff;cursor:pointer;font-weight:bold;text-decoration:underline;" valign="top" onclick="showdivBN_Ind(' . $aFonctionBN->getID () . ')">' . $aFonctionBN->getName () . '</td>';
			else
				$aff .= '<td style="border-bottom:1px solid #fff;border-right:1px solid #fff;font-weight:bold;" valign="top" >' . $aFonctionBN->getName () . '</td>';
			$aff .= '<td style="border-bottom:1px solid #fff;border-right:1px solid #fff;">' . count ( $myListeIndividus ) . ' contacts';
			if (count ( $myListeIndividus ) > 0) {
				$aff .= '<div class="BNdiv_Ind" name="BNdiv_Ind' . $aFonctionBN->getID () . '" id="BNdiv_Ind' . $aFonctionBN->getID () . '" style=" display:none;background-color: #D4D4D4;">';
				$aff .= '<table id="TableBN_Ind" cellspacing="6px" cellpadding="2px">';
				foreach ( $myListeIndividus as $aIndividusFonctionBN ) {
					$aff .= '<tr>';
					// $aff .= '<td width="50px" align="left" valign="middle"><input class="chkbxBN_Fonc" type="checkbox" onclick="cocheBN_Ind('.$aFonctionBN->getID().')" id="BN_Fonc'.$aFonctionBN->getID().'_Ind'.$aIndividusFonctionBN->getIndividuID().'"/><label for="BN_Fonc'.$aFonctionBN->getID().'_Ind'.$aIndividusFonctionBN->getIndividuID().'"><span class="ui"></span></label></td>';
					$aff .= '<td width="50px" align="left" valign="middle"><input class="chkbxBN_Fonc" type="checkbox" style="display:block;" onclick="cocheBN_Ind(' . $aFonctionBN->getID () . ')" id="BN_Fonc' . $aFonctionBN->getID () . '_Ind' . $aIndividusFonctionBN->getIndividuID () . '"/></td>';
					$aff .= '<td width="50px" align="left" valign="middle">' . $aIndividusFonctionBN->getIndividuID () . '</td>';
					$aff .= '<td width="200px" valign="middle">' . $aIndividusFonctionBN->getNomIndividu () . '</td>';
					$aff .= '<td width="200px" valign="middle">' . $aIndividusFonctionBN->getPrenomIndividu () . '</td>';
					$aff .= '<td width="400px" valign="middle">' . $aIndividusFonctionBN->getMailIndividu () . '</td>';
					$aff .= '</tr>' . "\n";
				}
				$aff .= '</table>';
				$aff .= '</div>';
			} else
				$aff .= '&nbsp;';
			$aff .= '</td>';
			$aff .= '</tr>' . "\n";
			$BN_Ind += 1;
		}
		$aff .= '</table>';
		$aff .= '</div>';
		echo $aff;
	}
	public function renderHTMLCOM() {
		// Navigation Bar
		$aff = '<table id="TableListOutlook">' . "\n";
		$aff .= '<tr class="title">';
		$aff .= '<td width="89px"><input type="checkbox" id="cocheToutCOM"/><label for="cocheToutCOM"><span class="uiCOM" id="UIcocheToutCOM"></span></label></td>';
		$aff .= '<td onclick="showdivCOM()" style="cursor:pointer;">Commissions</td>';
		$aff .= '</tr>' . "\n";
		$aff .= '</table>';

		$aff .= '<div class="COMdiv" name="COMdiv" id="COMdiv" style=" display:none;background-color: #D4D4D4;">';
		$aff .= '<table id="TableCOM" border="0" cellspacing="0px" cellpadding="10px">' . "\n";
		$COM_Ind = 0;
		foreach ( $this->myListeBN as $aFonctionCOM ) {
			// on recherche les individus rattachés à la fonction
			$myListeIndividus = array ();
			$aFonctionCOMindividuListe = new FonctionBNListe ();
			$aFonctionCOMindividuListe->select_individus_fonctionbn ( $aFonctionCOM->getID () );
			$myListeIndividus = $aFonctionCOMindividuListe->getFonctionBNIndividuListe ();

			$aff .= '<tr>';
			if (count ( $myListeIndividus ) > 0)
				$aff .= '<td style="border-bottom:1px solid #fff;" width="50" align="center" valign="top"><input class="chkbxCOM" type="checkbox" onclick="cocheCOM_Fonc(' . $aFonctionCOM->getID () . ')" id="COM' . $aFonctionCOM->getID () . '"/><label for="COM' . $aFonctionCOM->getID () . '"><span class="uiCOM" id="UICOM' . $aFonctionCOM->getID () . '"></span></label></td>';
			else
				$aff .= '<td style="border-bottom:1px solid #fff;" width="50" align="center" valign="top">&nbsp;</td>';
			$aff .= '<td style="border-bottom:1px solid #fff;font-weight:bold;" width="50" align="center" valign="top">' . $aFonctionCOM->getID () . '</td>';
			if (count ( $myListeIndividus ) > 0)
				$aff .= '<td style="border-bottom:1px solid #fff;border-right:1px solid #fff;cursor:pointer;font-weight:bold;text-decoration:underline;" valign="top" onclick="showdivCOM_Ind(' . $aFonctionCOM->getID () . ')">' . $aFonctionCOM->getName () . '</td>';
			else
				$aff .= '<td style="border-bottom:1px solid #fff;border-right:1px solid #fff;font-weight:bold;" valign="top" >' . $aFonctionCOM->getName () . '</td>';
			$aff .= '<td style="border-bottom:1px solid #fff;border-right:1px solid #fff;">';
			if (count ( $myListeIndividus ) > 0) {
				$aff .= '<div class="COMdiv_Ind" name="COMdiv_Ind' . $aFonctionCOM->getID () . '" id="COMdiv_Ind' . $aFonctionCOM->getID () . '" style=" display:none;background-color: #D4D4D4;">';
				$aff .= '<table id="TableCOM_Ind" cellspacing="6px" cellpadding="2px">';
				foreach ( $myListeIndividus as $aIndividusFonctionCOM ) {
					$aff .= '<tr>';
					$aff .= '<td width="50px" align="left" valign="middle"><input class="chkbxCOM_Fonc" type="checkbox" style="display:block;" onclick="cocheCOM_Ind(' . $aFonctionCOM->getID () . ')" id="COM_Fonc' . $aFonctionCOM->getID () . '_Ind' . $aIndividusFonctionCOM->getIndividuID () . '"/></td>';
					$aff .= '<td width="50px" align="left" valign="middle">' . $aIndividusFonctionCOM->getIndividuID () . '</td>';
					$aff .= '<td width="200px" valign="middle">' . $aIndividusFonctionCOM->getNomIndividu () . '</td>';
					$aff .= '<td width="200px" valign="middle">' . $aIndividusFonctionCOM->getPrenomIndividu () . '</td>';
					$aff .= '<td width="400px" valign="middle">' . $aIndividusFonctionCOM->getMailIndividu () . '</td>';
					$aff .= '</tr>' . "\n";
				}
				$aff .= '</table>';
				$aff .= '</div>';
			} else
				$aff .= '&nbsp;';
			$aff .= '</td>';
			$aff .= '</tr>' . "\n";
			$COM_Ind += 1;
		}
		$aff .= '</table>';
		$aff .= '</div>';
		echo $aff;
	}
	public function renderEnvoiHTML() {
		$aff = '<table id="TableListEnvois" class="TabEnvois">' . "\n";
		$aff .= '<tr">';
		$aff .= '<td align="center"><b>#</b></td>';
		$aff .= '<td align="center"><b>Date</b></td>';
		$aff .= '<td align="center"><b>Envois</b></td>';
		$aff .= '<td align="center"><b>Ouvertures</b></td>';
		$aff .= '<td align="center"><b>Clicks</b></td>';
		$aff .= '<td align="center"><b></b></b></td>';
		$aff .= '<td align="center"><b></b></b></td>';
		$aff .= '</tr>' . "\n";

		foreach ( $this->myList as $aNewsletterHistorique ) {
			$aNewsletterHistoriqueEnvoiManager = new NewsletterHistoriqueManager ();
			$aListEnvois = $aNewsletterHistoriqueEnvoiManager->getEnvois ( $aNewsletterHistorique->getEnvoiID () );

			foreach ( $aListEnvois as $aNewsletterEnvoisHistorique ) {
				if ($aNewsletterEnvoisHistorique->getNbTot () > 1) {
					$aff .= '<tr>';
					$aff .= '<td width="50" align="center">' . $aNewsletterEnvoisHistorique->getEnvoiID () . '</td>';
					$aff .= '<td align="center">' . $aNewsletterEnvoisHistorique->getDateCreation () . '</td>';
					$aff .= '<td align="center">' . $aNewsletterEnvoisHistorique->getNbTot () . '</td>';
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