<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage parametre
 * @version 1.0.4
 */
class ListeParamView {
	private $myListeParam;

	function __construct($aListeParam)
	{
		$this->myListeParam = $aListeParam;
	}
	function ListeParamView($aListeParam) {
		self::__construct($aListeParam);
	}
	
	function renderHTML() {
		$this->render ();
	}
	function render() {

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../index.php?menu=1">Général</a>&nbsp;>&nbsp;Param&egrave;tre';
		$aff .= '</div><br/><br/>';

		// Bouton sous menu
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=c\'"/><br/>';
		$aff .= '<br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList" style="width:100%">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center"><b>Valeur</b></td>';
		$aff .= '<td align="center" colspan="2" width="100"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myListeParam->getParamListe () as $aParam ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aParam->getName () . '</td>';
			$tmp = stripslashes ( $aParam->getValue () );
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . (strlen ( $tmp ) == 0 ? '&nbsp' : (strlen ( $tmp ) > 65) ? substr ( $tmp, 0, 64 ) . '...' : $tmp) . '</td>';

			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=u&id=' . $aParam->getID () . '"><img src="../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmDelete(' . $aParam->getID () . ')"><img src="../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table></div>';

		$aff .= '<script type="text/javascript">';
		$aff .= 'function confirmDelete(doc_id)
        		{
					if(confirm("Confirmation de suppression"))
					{
						document.location.href=\'?action=delete&id=\'+doc_id;	
					}
				}';
		$aff .= '</script>';

		echo $aff;
	}
}