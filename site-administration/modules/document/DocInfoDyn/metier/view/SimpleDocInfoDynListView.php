<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
class SimpleDocInfoDynListView {
	private $myList;
	private $mySearch;
	public function __construct($aList, $aSearch) {
		$this->myList = $aList;
		$this->mySearch = $aSearch;
	}
	public function renderHTML() {
		// Navigation Bar
		$aff = '<b><a href="../../../?menu=3">Web Content</a>&nbsp;>&nbsp;DocInfoDyn</b><br/><br/>';

		// Button Bar
		$aff .= '<table><tr><td><input type="button" value="Nouveau" onclick="location.href=\'?action=new\'" /></td><td width="300" align ="center" ><form method="POST" action="#" ><b>       Filtre</b><input type="text" name="Recherche" value="' . $this->mySearch . '" style="padding-top:0px;height:25px;"/><input value="" type="submit" style="background:url(\'../../../include/images/Icone_loupe.jpg\');cursor:hand;width=25px;"  /><input type="button" onclick="javascript:location.href=\'?\'" style="background:url(\'../../../include/images/Icone_loupe_sup.jpg\');cursor:hand;width=25px;"  /></form></td></tr></table><br/><br/>';

		// List
		$aff .= '<table class="list">';
		$aff .= '<tr class="title">';
		$aff .= '	<td width="100">#</td>';
		$aff .= '	<td>Nom / Titre </td>';
		$aff .= '	<td>Date D&eacute;but </td>';
		$aff .= '	<td>Date Fin</td>';
		$aff .= '	<td colspan="2" width="100">Action</td>';
		$aff .= '</tr>';

		$i = 0;
		foreach ( $this->myList as $aType ) {
			// Type
			$aff .= '<tr id="tr' . $aType->getID () . '">';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '"><table style="padding-left:0px;cursor: pointer; cursor: hand"><tr><td><a id="a' . $aType->getID () . '" onclick="expendCat(\'1\',\'' . $aType->getID () . '\')"><img src="../../../include/images/1.png" id="ImgType' . $aType->getID () . '" border="0"/></a></td><td>' . $aType->getID () . '</td></tr></table></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' . $aType->getDescription () . '</td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="80"></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="80"></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"></td>';
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"></td>';
			$aff .= '</tr>';
			$i = $i == 0 ? 1 : 0;
		}
		$aff .= '</table>';

		$aff .= '<script type="text/javascript">
  								
						function expendDoc(typeid)
						{
							var obj = $("#ImgType"+typeid);
							var ct = $(".trCat"+typeid).length;
							
							if(ct==0)
							{
								obj.attr(\'src\',\'../../../include/images/delai.jpg\');
								$.ajax({
									type: "POST",
									url: "./metier/view/GetDocumentListAJAX.php",
									data: "CategorieID="+typeid+"&search=' . $this->mySearch . '",
									success: function(msg){
										$("#tr"+typeid).after(msg);
										obj.attr(\'src\',\'../../../include/images/1bas.png\');
									}
								});
								
							}
							else
							{
								if(obj.attr(\'src\')==\'../../../include/images/1bas.png\')
								{
									obj.attr(\'src\',\'../../../include/images/1.png\');
									$(".trCat"+typeid).each(function()
									{
										$(this).hide();
										
									});
								}
								else
								{
									obj.attr(\'src\',\'../../../include/images/1bas.png\');
									$(".trCat"+typeid).each(function()
									{
										$(this).show();
										
									});
								}
							}
							return false;
						}	
		
		
						function expendCat(lvl, typeid)
						{
							var obj = $("#ImgType"+typeid);
							var ct = $(".trCat"+typeid).length;
							
							if(ct==0)
							{
								obj.attr(\'src\',\'../../../include/images/delai.jpg\');
								$.ajax({
									type: "POST",
									url: "./metier/view/GetCategorieListAJAX.php",
									data: "CategorieParentID="+typeid+"&lvl="+lvl+"&search=' . $this->mySearch . '",
									success: function(msg){
										$("#tr"+typeid).after(msg);
										obj.attr(\'src\',\'../../../include/images/1bas.png\');
									}
								});
								
							}
							else
							{
								if(obj.attr(\'src\')==\'../../../include/images/1bas.png\')
								{
									obj.attr(\'src\',\'../../../include/images/1.png\');
									$(".trCat"+typeid).each(function()
									{
										$(this).hide();
										
									});
								}
								else
								{
									obj.attr(\'src\',\'../../../include/images/1bas.png\');
									$(".trCat"+typeid).each(function()
									{
										$(this).show();
										
									});
								}
							}
							return false;
						}
						
						$(document).ready(function(){});
				</script>';
		echo $aff;
	}
}
?>