<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class SplitDocInfoDynListView {
	private $mySearch;
	private $myCat;
	public function __construct($aSearch, $aCat) {
		$this->mySearch = $aSearch;
		$this->myCat = $aCat;
	}

	// ###
	public function renderHTML() {
		// Navigation Bar
		$aff = '';

		if (! isset ( $_GET ['add'] )) {
			$aff .= '<div id="FilAriane"><a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;DocInfoDyn</div><br/>';
		}

		// Button Bar
		$aff .= '<table width="100%">';
		$aff .= '<tr>';
		$aff .= '	<td align="left">';
		if (! isset ( $_GET ['add'] )) {
			$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=new\'" />';
		} else {
			$aff .= '&nbsp;';
		}
		$aff .= '</td>';
		$aff .= '	<td align="right"><b>Filtre</b>&nbsp;&nbsp;';
		$aff .= '		<input type="text" id="Recherche" name="Recherche" value="' . $this->mySearch . '" style="padding-top:0px;height:25px;"/>';
		$aff .= '		<input type="hidden" id="current_categorie" value="0"/>';
		$aff .= '		<input type="button" id="SearchButton" onclick="searchDoc()" style="background:url(\'../../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"/>';
		$aff .= '		<input type="button" onclick="emptySearchDoc()" style="background:url(\'../../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"/>';
		$aff .= '	</td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		$aff .= '<script>
		$(\'#Recherche\').keypress(function(event) {if (event.which == \'13\') {searchDoc();}});		
		</script>';
		// Vue
		$aff .= '<table width="100%" border="1">';
		$aff .= '<tr><td valign="top" width="30%" id="leftColumn">';
		$aff .= '<img src="../../../include/images/loading.gif"/>veuillez patienter quelques secondes';
		$aff .= '</td><td valign="top" width="70%" id="rightColumn">';
		$aff .= 'Veuillez choisir une catégorie';
		$aff .= '</td></tr>';
		$aff .= '</table>';
		$aff .= HelperHead::includeJS ( 'include/DocumentSplit.js' );

		$aff .= '<script>';
		$aff .= 'function loadRightColumn()
					{
						$.ajax({
							   type: "GET",
							   url: "indexSimple.php?action=splitView_docInfoDyn' . (isset ( $_GET ['add'] ) ? 'add=&' : (isset ( $_GET ['add2'] ) ? 'add2=&' : '')) . '",
							   success: function(msg){
									$("#rightColumn").html(msg);
								}
							});
							return false;
					}
					
					function filterDoc(categorie_id)
{
	$("#td"+categorie_id+" :first-child").css(\'color\',\'#0000FF\');
	$("#td"+categorie_id+" :first-child").css(\'font-weight\',\'bold\');
	$("#td"+$("#current_categorie").val()+" :first-child").css(\'color\',\'#000000\');
	$("#td"+$("#current_categorie").val()+" :first-child").css(\'font-weight\',\'normal\');
	$("#rightColumn").html(\'<img src="../../../include/images/loading.gif"/>veuillez patienter quelques secondes\');
	$("#current_categorie").val(categorie_id);
	$("#Recherche").val(\'\');
	$("#tr"+categorie_id).attr(\'style\',\'color:blue;\');
	$.ajax({
		type: "GET",
		url: "indexSimple.php?action=splitView_docInfoDyn",
		data: "' . (isset ( $_GET ['add'] ) ? 'add=&' : (isset ( $_GET ['add2'] ) ? 'add2=&' : '')) . 'id="+categorie_id,
		success: function(msg){
			$("#rightColumn").html(msg);
		}
	});
}

function searchDoc()
{
	$("#rightColumn").html(\'<img src="../../../include/images/loading.gif"/>veuillez patienter quelques secondes\');
	$.ajax({
		type: "GET",
		url: "indexSimple.php?action=splitView_docInfoDyn",
		data: "' . (isset ( $_GET ['add'] ) ? 'add=&' : (isset ( $_GET ['add2'] ) ? 'add2=&' : '')) . 'id="+$("#current_categorie").val()+"&search="+$("#Recherche").val(),
		success: function(msg){
			$("#rightColumn").html(msg);
		}
	});
	
	return false;
}';

		$aff .= 'if($(\'#Recherche\').val()!="") {
			searchDoc();
		}
		';

		if ($this->myCat != '') {
			$aff .= ' filterDoc(\'' . $this->myCat . '\');';
		}
		$aff .= '</script>';
		echo $aff;
	}
}
?>