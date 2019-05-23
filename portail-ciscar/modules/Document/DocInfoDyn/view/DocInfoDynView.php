<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynView {
	private $myDocInfoDyn;
	public function __construct(DocInfoDyn $aDocInfoDyn) {
		$this->myDocInfoDyn = $aDocInfoDyn;
	}
	public function render() {
		if (is_null ( $this->myDocInfoDyn->getID () )) {
			$aff = '<span style="color:red;font-weight:bold;">Document inexistant ou autorisation insuffisante...</span>';
		} else {
			$tabCategorie = $this->myDocInfoDyn->SQL_SELECT_DEFAULT_CATEGORIE ();
			
			$aff = '<table width="100%">';
			$aff .= '<tr><td colspan="2" valign="middle" style="padding-left:20px;background:#515153;color:#FFFFFF;font-weight:bold;height:30px;">' . ucfirst ( strtolower ( stripslashes ( $tabCategorie [1] ) ) ) . '</td></tr>';
			$aff .= '</table>';
			$aff .= '<br/>';
			
			$aff .= '<p style="font-size:20px;"><b>' . $this->myDocInfoDyn->getTitre () . '</b></p>';
			if ($this->myDocInfoDyn->getDateDebut () != '') {
				$aff .= '<p style="font-size:12px;">&eacute;crit le ' . $this->myDocInfoDyn->getDateFR ( $this->myDocInfoDyn->getDateDebut () ) . '</p>';
			}
			if ($this->myDocInfoDyn->getAuteurID () != '') {
				$aff .= ' par <u>Auteur(s) : ' . $this->myDocInfoDyn->getAuteurID () . '</u>';
			}
			$aff .= '<br/>';
			$aff .= '<p><a href="docInfoDyn.php?id=' . $this->myDocInfoDyn->getID () . '" target="_BLANK"><img src="include/images/kit/bout_imprimer.jpg" border="0"/></a></p>';
			
			$aff .= '<p style="color:#000000;">' . stripslashes ( $this->myDocInfoDyn->getContenuRichText () ) . '</p>';
			
			$aff .= '<br/><p><a href="docInfoDyn.php?id=' . $this->myDocInfoDyn->getID () . '" target="_BLANK"><img src="include/images/kit/bout_imprimer.jpg" border="0"/></a></p>';
		}
		return $aff;
	}
	public function renderHTMLPrint() {
		if (is_null ( $this->myDocInfoDyn->getID () )) {
			$aff = '<span style="color:red;font-weight:bold;">Document inexistant ou autorisation insuffisante...</span>';
		} else {
			$tabCategorie = $this->myDocInfoDyn->SQL_SELECT_DEFAULT_CATEGORIE ();
			
			$aff = '<html><body style="font-family:arial;"><table width="100%">';
			$aff .= '<tr><td colspan="2" valign="middle" style="padding-left:20px;background:#515153;color:#FFFFFF;font-weight:bold;height:30px;">' . ucfirst ( strtolower ( stripslashes ( $tabCategorie [1] ) ) ) . '</td></tr>';
			$aff .= '</table>';
			$aff .= '<br/>';
			
			$aff .= '<p style="font-size:20px;"><b>' . $this->myDocInfoDyn->getTitre () . '</b></p>';
			$aff .= '<p style="font-size:12px;">&eacute;crit le ' . $this->myDocInfoDyn->getDateFR ( $this->myDocInfoDyn->getDateDebut () ) . '</p>';
			if ($this->myDocInfoDyn->getAuteurID () != '') {
				$aff .= ' par <u>Auteur(s) : ' . $this->myDocInfoDyn->getAuteurID () . '</u>';
			}
			$aff .= '<br/>';
			$aff .= '<p><a href="docInfoDyn.php?id=' . $this->myDocInfoDyn->getID () . '"><img src="include/images/kit/bout_imprimer.jpg" border="0"/></a></p>';
			
			$aff .= '<p style="color:#000000;">' . stripslashes ( $this->myDocInfoDyn->getContenuRichText () ) . '</p>';
			
			$aff .= '<br/><p><a href="javascript:window.print()"><img src="include/images/kit/bout_imprimer.jpg" border="0"/></a></p>';
			$aff .= '</body></html>';
		}
		
		return $aff;
	}
}
?>