<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage categorie
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
	include ('../../../../../config/configuration.php');
	include ('../../../../include/DbConnexion.php');

	$tab = preg_split ( "/[-]+/", $_POST ['CategorieParentID'] );

	$noeud = substr ( $_POST ['CategorieParentID'], ((strlen ( $_POST ['CategorieParentID'] ) - 9) * - 1) );

	$sql = "SELECT c.DocCategorieID, c.Description FROM wcm_document_categorie c WHERE c.SiteID='%s' AND DocCatParentID='%s' ORDER BY Description";

	$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $tab [count ( $tab ) - 1] ) );

	$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

	$aff = '';

	$i = 0;
	while ( $line = mysqli_fetch_array  ( $result ) ) {
		// Get More Information

		$query2 = sprintf ( "SELECT count(*) FROM wcm_document_infodyn_categorie d WHERE (d.CatTypeID='%s' OR d.CatThemeID='%s' OR d.CatMetierID='%s')", mysqli_real_escape_string ($_SESSION['LINK'], $line [0] ), mysqli_real_escape_string ($_SESSION['LINK'], $line [0] ), mysqli_real_escape_string ($_SESSION['LINK'], $line [0] ) );

		$result2 = mysqli_query ($_SESSION['LINK'], $query2 ) or die ( mysqli_error ($_SESSION['LINK']) );
		$line2 = 0;
		if (mysqli_num_rows ( $result2 ) == 1) {
			$line2 = mysqli_fetch_array  ( $result2 );
			$line2 = $line2 [0];
		}
		mysqli_free_result  ( $result2 );

		// ######

		$aff .= '<tr id="tr' . $line [0] . '" class="trCat' . $_POST ['CategorieParentID'] . '">';
		if ($_POST ['lvl'] == '1') {
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" style="padding-left:16px;cursor: pointer; cursor: hand"><table><tr><td><a onclick="expendCat(\'2\',\'' . $line [0] . '\')"><img src="../../include/images/1.png" id="ImgType' . $line [0] . '" border="0"/></a></td><td>' . $line [0] . '</td></tr></table></td>';
		} else {
			$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" style="padding-left:40px;"><table><tr><td></td><td>' . $line [0] . '</td></tr></table></td>';
		}
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' . htmlentities ( $line [1], ENT_QUOTES ) . '</td>';
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center">' . $line2 . '</td>';
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=edit&id=' . $line [0] . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="#" onclick="' . ($line2 > 0 ? 'NoDelete()' : 'confirmDelete(' . $line [0] . ')') . '"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
		$aff .= '</tr>';

		$i = ($i == 0 ? 1 : 0);
	}
	mysqli_free_result  ( $result );

	// Deconnexion BD
	include ('../../../../include/DbDeconnexion.php');

	echo $aff;
} else {
	echo 'err';
}
?>