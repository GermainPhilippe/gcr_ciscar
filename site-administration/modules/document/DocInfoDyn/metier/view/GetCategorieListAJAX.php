<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

if (isset ( $_POST ['CategorieParentID'] )) {
	// Connexion db
	include ('../../../../../../config/configuration.php');
	include ('../../../../../include/DbConnexion.php');

	$tab = preg_split ( "/[-]+/", $_POST ['CategorieParentID'] );

	$noeud = substr ( $_POST ['CategorieParentID'], ((strlen ( $_POST ['CategorieParentID'] ) - 9) * - 1) );

	if ($_POST ['lvl'] == '1') {
		// Recherche des Theme
		$sql = "SELECT distinct(CatThemeID), c.Description";
		$sql .= " FROM wcm_document_infodyn_compact i, wcm_document_categorie c";
		$sql .= " WHERE i.SiteID='%s' and c.DocCategorieID=i.CatThemeID and i.Titre LIKE '%s' and i.CatTypeID='%s' ORDER BY c.Description";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $_POST ['search'] . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $tab [count ( $tab ) - 1] ) );
	} else {
		// Recherche des Metiers
		$sql = "SELECT distinct(CatMetierID), c.Description";
		$sql .= " FROM wcm_document_infodyn_compact i, wcm_document_categorie c";
		$sql .= " WHERE i.SiteID='%s' and c.DocCategorieID=i.CatMetierID and i.Titre LIKE '%s' and i.CatThemeID='%s' ORDER BY c.Description";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $_POST ['search'] . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $tab [count ( $tab ) - 1] ) );
	}
	$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

	$aff = '';

	$i = 0;
	while ( $line = mysqli_fetch_array  ( $result ) ) {
		$aff .= '<tr id="tr' . $line [0] . '" class="trCat' . $_POST ['CategorieParentID'] . '">';
		if ($_POST ['lvl'] == '1') {
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" style="padding-left:16px;cursor: pointer; cursor: hand"><table><tr><td><a onclick="expendCat(\'2\',\'' . $line [0] . '\')"><img src="../../../include/images/1.png" id="ImgType' . $line [0] . '" border="0"/></a></td><td>' . $line [0] . '</td></tr></table></td>';
			// $aff .= ' <td class="'.($i==0?'row1':'row2').'" style="padding-left:16px;"><a name="ancre'.$line[0].'"></a><table><tr><td><a href="?ancre'.$line[0].'" onclick="expendCat(\'2\',\''.$line[0].'\')"><img src="../../../include/images/1.png" id="ImgType'.$line[0].'" border="0"/></a></td><td>'.$line[0].'</td></tr></table></td>';
		} else {
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" style="padding-left:40px;cursor: pointer; cursor: hand"><table><tr><td><a onclick="expendDoc(\'' . $line [0] . '\')"><img src="../../../include/images/1.png" id="ImgType' . $line [0] . '" border="0"/></a></td><td>' . $line [0] . '</td></tr></table></td>';
			// $aff .= ' <td class="'.($i==0?'row1':'row2').'" style="padding-left:40px;"><a name="ancre'.$line[0].'"></a><table><tr><td><a href="?ancre'.$line[0].'" onclick="expendDoc(\''.$line[0].'\')"><img src="../../../include/images/1.png" id="ImgType'.$line[0].'" border="0"/></a></td><td>'.$line[0].'</td></tr></table></td>';
		}
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' . htmlentities ( $line [1], ENT_QUOTES ) . '</td>';
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="80"></td>';
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="80"></td>';
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"></td>';
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"></td>';
		$aff .= '</tr>';

		$i = ($i == 0 ? 1 : 0);
	}

	mysqli_free_result  ( $result );

	// Deconnexion BD
	include ('../../../../../include/DbDeconnexion.php');

	echo $aff;
} else {
	echo 'err';
}
?>