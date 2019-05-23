<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage recherche
 * @version 1.0.4
 */
class DocumentRechercheView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function getDateFR($DateEN) {
		$tab = preg_split ( "/-+/", $DateEN, 3 );
		return $tab [2] . '/' . $tab [1] . '/' . $tab [0];
	}
	public function renderHTML() {
		$aff = '';
		
		if (count ( $this->myList ) > 0) {
			foreach ( $this->myList as $aDoc ) {
				$aff .= '<table width="100%" style="color:#000;font-size:12px;">';
				$aff .= '<tr><td style="padding-left:20px;background:#515153;color:#FFFFFF;font-weight:bold;">' . stripslashes ( $aDoc [6] ) . ' : <a href="?action=doc&id=' . $aDoc [0] . '" style="text-decoration:none;color:#FFFFFF;">' . stripslashes ( $aDoc [1] ) . '</a></td></tr>';
				$aff .= '<tr><td>' . stripcslashes ( $aDoc [2] ) . '<br/></td></tr>';
				$aff .= '<tr><td style="font-size:10px;">(' . $this->getDateFR ( $aDoc [3] ) . ')</td></tr>';
				$aff .= '<tr><td><a href="?action=doc&id=' . $aDoc [0] . '" style="color:#666666;">&raquo; En savoir plus</a></td></tr>';
				$aff .= '<tr><td>&nbsp;</td></tr>';
				$aff .= '</table>';
			}
		} else {
			$aff .= '<p>Aucune publication ne correspond &agrave; votre s&eacute;lection.</p>';
		}
		
		return $aff;
	}
}
?>