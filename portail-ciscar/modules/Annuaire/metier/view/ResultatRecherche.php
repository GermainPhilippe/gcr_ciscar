<?php
/**
 * @author Florent DESPIERRES
 * @package portail-gcr
 * @subpackage annuaire
 * @version 1.0.4
 */
class ResultatRecherche {
	private $myList;
	private $myListCount;
	private $mySearch_Nom;
	private $mySearch_DA;
	public function __construct($aList, $Search_Nom, $Search_DA) {
		$this->myList = $aList;
		$this->myListCount = 0;
		$this->mySearch_Nom = $Search_Nom;
		$this->mySearch_DA = $Search_DA;
	}
	
	// ###
	public function renderHTML() {
		// $aff = '<img src="include/images/ResultatsDeLaRecherche.jpg"/><br/><br/>';
		$aff = '<br/>';
		$atmpList = new Individu ();
		$Entry = $atmpList->SQL_SEARCH_COUNT ( $this->mySearch_Nom, $this->mySearch_DA );
		
		$aff .= '	<script type="text/javascript">
        	function pageselectCallback(page_index, jq){
                $.get("index.php",{page:numpage})
				return false;
            }
        </script>	';
		
		$aff .= '<div id="Pagination" class="pagination"></div><br/><br/>
		<script>
			$(document).ready(function(){
				var num_entries = ' . $Entry . ';
                // Create pagination element
				$("#Pagination").pagination(num_entries, {
                    num_edge_entries: 1,
                    num_display_entries: 10,
					current_page:' . (isset ( $_GET ['page'] ) ? $_GET ['page'] : 0) . ',
					link_to:\'?action=annuaire&typeRecherche=individu&NomIndividu=' . $this->mySearch_Nom . '&FonctionIndividu=' . $this->mySearch_DA . '&page=__id__\',
					callback: pageselectCallback,
                    items_per_page:30,
                    prev_text:"PREC",
                    next_text:"SUIV"
                });
               
			});
		</script>
		';
		
		$aff .= '<table cellpadding="0" width="100%">';
		if (count ( $this->myList ) > 0) {
			$i = 0;
			$row1 = ' style="background:#FFFFFF url(\'../../include/images/kit/fd_liste_1.jpg\');"';
			$row2 = ' style="background:#FFFFFF url(\'../../include/images/kit/fd_liste_2.jpg\');"';
			
			foreach ( $this->myList as $aIndividu ) {
				$aff .= '<tr' . ($i == 0 ? $row1 : $row2) . '>';
				$aff .= '	<td width="20"><img src="include/images/kit/puce_menu_sidebar.jpg"/></td>';
				$aff .= '	<td><a href="?action=individu&id=' . $aIndividu->getID () . '"><font face="Arial" size="2" style="color:#930511">' . $aIndividu->getNom () . ' ' . $aIndividu->getPrenom () . '</font></a></td>';
				$aff .= '	<td><font face="Arial" size="2" style="color:#000000">' . $aIndividu->getRaisonSociale () . '</font></td>';
				$aff .= '</tr>';
				$i = ($i == 0 ? 1 : 0);
			}
		} else {
			$aff .= '<tr>';
			$aff .= '	<td><font face="Arial" size="2" style="color:#930511"><i>0 resultat</i></font></td>';
			$aff .= '</tr>';
		}
		$aff .= '<tr>';
		$aff .= '	<td align="center" colspan="3"><br/><a href="?action=annuaire"><img src="include/images/kit/bout_retour.jpg" border="0"></a></td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		
		return $aff;
	}
}
?>