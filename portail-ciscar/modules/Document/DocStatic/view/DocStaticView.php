<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage document
 * @version 1.0.4
 */
class DocStaticView {
	private $myDocStatic;
	public function __construct($aDocStatic) {
		$this->myDocStatic = $aDocStatic;
	}
	public function render() {
		if (is_null ( $this->myDocStatic->getID () )) {
			$aff = '<span style="color:red;font-weight:bold;">Document inexistant...</span>';
		} else {
			$aParam = new Param ();
			$aParam->search_param ( 'CISCAR_PUB_HOMEPAGE_IMAGE' );
			$aParam2 = new Param ();
			$aParam2->search_param ( 'CISCAR_PUB_HOMEPAGE_URL' );
			
			$aff = stripslashes ( $this->myDocStatic->getContenuRichText () );
			$aff .= '<script>
				function confirmCatalogue()
				{
					if(confirm("Je souhaite m\'identifier pour consulter le catalogue."))
					{
						document.location.href="?action=catalogue";
					}
					else
					{
						window.open("' . $aParam2->getValue () . '","CISCAR");
					}
				}</script>';
			
			/*
			 * $aff .= '<p align="center">';
			 * $aff .= '<table width="100%">';
			 * $aff .= '<tr>';
			 * $aff .= '<td align="center"><a href="javascript:history.back()"><img src="include/images/ciscar/BtRevenir.gif" border="0"/></a></td>';
			 * $aff .= '<td align="center"><a href="?"><img src="include/images/ciscar/RetourUne.gif" border="0"/></a></td>';
			 * $aff .= '<td align="center"><a href="javascript:window.print()"><img src="include/images/ciscar/BtFormatImp.gif" border="0"/></a></td>';
			 * $aff .= '</tr>';
			 * $aff .= '</table>';
			 * $aff .= '</p>';
			 */
		}
		return $aff;
	}
}
?>