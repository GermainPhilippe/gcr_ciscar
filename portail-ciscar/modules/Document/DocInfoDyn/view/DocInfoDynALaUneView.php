<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage document
 * @version 1.0.4
 */
class DocInfoDynALaUneView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML() {
		$aff = '';
		
		if (count ( $this->myList )) {
			foreach ( $this->myList as $aDoc ) {
				$aCategorie = new Categorie ();
				$aCategorie->SQL_select ( $aDoc->getCatTypeID () );
				
				$aff .= '<table width="580" cellspacing="0">';
				
				// Profil INDRA
				if (in_array ( 15, $_SESSION [$_SESSION ['SITE'] ['NAME']] ['USER'] ['GROUPS'] )) {
					switch ($aCategorie->getID ()) {
						// Jaune : Informatique
						case '43' :
							$aff .= '<tr>';
							$aff .= '	<td style="background:#FFFFFF url(\'../../include/images/kit/INDRA_cat_informatique.jpg\') no-repeat;color:#FFFFFF;font-weight:bold;height:24px;text-align:left;padding-left:20px;">' . $aCategorie->getDescription () . '</td>';
							$aff .= '</tr>';
							$aff .= '<tr>';
							$aff .= '	<td style="background-image:url(\'include/images/kit/INDRA_gradient_informatique.jpg\');background-repeat:repeat-x ;">';
							break;
						// Rouge : Boutique
						case '13' :
							$aff .= '<tr>';
							$aff .= '	<td style="background:#FFFFFF url(\'../../include/images/kit/INDRA_cat_boutique.jpg\') no-repeat;color:#FFFFFF;font-weight:bold;height:24px;text-align:left;padding-left:20px;">' . $aCategorie->getDescription () . '</td>';
							$aff .= '</tr>';
							$aff .= '<tr>';
							$aff .= '	<td style="background-image:url(\'include/images/kit/INDRA_gradient_boutique.jpg\');background-repeat:repeat-x ;">';
							break;
						// Bleu Garage
						case '62' :
							$aff .= '<tr>';
							$aff .= '	<td style="background:#FFFFFF url(\'../../include/images/kit/INDRA_cat_garage.jpg\') no-repeat;color:#FFFFFF;font-weight:bold;height:24px;text-align:left;padding-left:20px;">' . $aCategorie->getDescription () . '</td>';
							$aff .= '</tr>';
							$aff .= '<tr>';
							$aff .= '	<td style="background-image:url(\'include/images/kit/INDRA_gradient_garage.jpg\');background-repeat:repeat-x ;">';
							break;
						// Autre categorie
						default :
							$aff .= '<tr>';
							$aff .= '	<td style="background:#FFFFFF url(\'../../include/images/kit/INDRA_cat_AutresRubriques.jpg\') no-repeat;color:#FFFFFF;font-weight:bold;height:24px;text-align:left;padding-left:20px;">' . $aCategorie->getDescription () . '</td>';
							$aff .= '</tr>';
							$aff .= '<tr>';
							$aff .= '	<td style="background-image:url(\'include/images/kit/INDRA_gradient_AutreRubriques.jpg\');background-repeat:repeat-x ;">';
							break;
					}
				} else {
					// Autre Profil
					switch ($aCategorie->getID ()) {
						// Jaune : Informatique
						case '43' :
							$aff .= '<tr>';
							$aff .= '	<td style="background:#FFFFFF url(\'../../include/images/kit/cat_informatique.jpg\') no-repeat;color:#FFFFFF;font-weight:bold;height:24px;text-align:left;padding-left:20px;">' . $aCategorie->getDescription () . '</td>';
							$aff .= '</tr>';
							$aff .= '<tr>';
							$aff .= '	<td style="background-image:url(\'include/images/ciscar/gradient_jaune.gif\');background-repeat:repeat-x ;">';
							break;
						// Rouge : Boutique
						case '13' :
							$aff .= '<tr>';
							$aff .= '	<td style="background:#FFFFFF url(\'../../include/images/kit/cat_boutique.jpg\') no-repeat;color:#FFFFFF;font-weight:bold;height:24px;text-align:left;padding-left:20px;">' . $aCategorie->getDescription () . '</td>';
							$aff .= '</tr>';
							$aff .= '<tr>';
							$aff .= '	<td style="background-image:url(\'include/images/ciscar/gradient_rose.gif\');background-repeat:repeat-x ;">';
							break;
						// Bleu Garage
						case '62' :
							$aff .= '<tr>';
							$aff .= '	<td style="background:#FFFFFF url(\'../../include/images/kit/cat_garage.jpg\') no-repeat;color:#FFFFFF;font-weight:bold;height:24px;text-align:left;padding-left:20px;">' . $aCategorie->getDescription () . '</td>';
							$aff .= '</tr>';
							$aff .= '<tr>';
							$aff .= '	<td style="background-image:url(\'include/images/ciscar/gradient_bleu.gif\');background-repeat:repeat-x ;">';
							break;
						// Autre categorie
						default :
							$aff .= '<tr>';
							$aff .= '	<td style="background:#FFFFFF url(\'../../include/images/kit/cat_AutresRubriques.jpg\') no-repeat;color:#FFFFFF;font-weight:bold;height:24px;text-align:left;padding-left:20px;">' . $aCategorie->getDescription () . '</td>';
							$aff .= '</tr>';
							$aff .= '<tr>';
							$aff .= '	<td style="background-image:url(\'include/images/ciscar/gradient_gris.gif\');background-repeat:repeat-x ;">';
							break;
					}
				}
				
				$aff .= '<table width="580" style="color:#000;font-size:12px;">';
				$aff .= '<tr>';
				$aff .= '	<td rowspan="5" width="170" align="center">';
				if ($aDoc->getVignetteAccroche () != '') {
					$aff .= '	<img src="' . $aDoc->getVignetteAccroche () . '" border="0"/>';
				}
				$aff .= '	</td>';
				$aff .= '	<td><b>' . $aDoc->getTitre () . '</b></td>';
				$aff .= '</tr>';
				$aff .= '<tr>';
				$aff .= '	<td>&nbsp;</td>';
				$aff .= '</tr>';
				$aff .= '<tr>';
				$aff .= '	<td>' . $aDoc->getAccroche () . '</td>';
				$aff .= '</tr>';
				$aff .= '<tr>';
				$aff .= '	<td>&nbsp;</td>';
				$aff .= '</tr>';
				$aff .= '<tr>';
				$aff .= '	<td><a href="?action=doc&id=' . $aDoc->getID () . '" style="color:#666666;">&raquo; En savoir plus</a></td>';
				$aff .= '</tr>';
				$aff .= '</table>';
				$aff .= '<br/>';
				$aff .= '</td></tr></table>';
			}
		} else {
			$aff .= '<i>Pas de doc A La Une</i>';
		}
		
		return $aff;
	}
	
	/**
	 *
	 * @deprecated Enter description here ...
	 */
	public function renderHTML2() {
		$aff = '<img src="include/images/ciscar/modeConnecte/Une.gif"/><br/><br/>';
		
		if (count ( $this->myList )) {
			foreach ( $this->myList as $aDoc ) {
				$aCategorie = new Categorie ();
				$aCategorie->SQL_select ( $aDoc->getCatTypeID () );
				
				$aff .= '<table>';
				$aff .= '<tr>';
				$aff .= '	<td class="vTitre"><b>' . $aCategorie->getDescription () . '</b> : <A href="?action=doc&id=' . $aDoc->getID () . '">' . $aDoc->getTitre () . '</a></td>';
				$aff .= '	<td rowspan="3" class="vImg">';
				if ($aDoc->getVignetteAccroche () != '') {
					$aff .= '<img src="' . $aDoc->getVignetteAccroche () . '" border="0" />';
				}
				$aff .= '	</td>';
				$aff .= '</tr>';
				$aff .= '<tr>';
				$aff .= '	<td class="vAccroche">' . $aDoc->getAccroche () . '</td>';
				$aff .= '</tr>';
				$aff .= '<tr>';
				$aff .= '<td align="left">(' . $aDoc->getDateFR ( $aDoc->getDateCreation () ) . ')</td>';
				$aff .= '</tr>';
				$aff .= '</table>';
				
				$aff .= '<img src="include/images/ciscar/SeparateurGCRValid.gif" width="100%"/>';
			}
		} else {
			$aff .= '<i>Pas de doc A La Une</i>';
		}
		
		return $aff;
	}
}
?>