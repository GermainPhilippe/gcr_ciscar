<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage document
 * @version 1.0.4
 */
session_start ();
function getDateFR($DateEN) {
	$tab = preg_split ( "/-+/", $DateEN, 3 );
	return $tab [2] . '/' . $tab [1] . '/' . $tab [0];
}

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}
if (isset ( $_POST ['CategorieID'] )) {
	// Connexion db
	include ('../../../../../../config/configuration.php');
	include ('../../../../../include/DbConnexion.php');

	$sql = "SELECT distinct(DocInfoDynID), Titre, DateDebut, DateFin";
	$sql .= " FROM wcm_document_infodyn_compact i";
	$sql .= " WHERE i.siteid='%s' and i.Titre LIKE '%s' and i.CatMetierID='%s'";

	$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], '%' . $_POST ['search'] . '%' ), mysqli_real_escape_string ($_SESSION['LINK'], $_POST ['CategorieID'] ) );

	$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

	$aff = '';

	$i = 0;
	while ( $line = mysqli_fetch_array  ( $result ) ) {

		$aff .= '<tr id="tr' . $line [0] . '" class="trCat' . $_POST ['CategorieID'] . '">';
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" style="padding-left:55px;"><table><tr><td></td><td>' . $line [0] . '</td></tr></table></td>';
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '">' . htmlentities ( $line [1], ENT_QUOTES ) . '</td>';
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center" width="80">';
		if ($line [2] == NULL) {
			$aff .= '<i>NC</i>';
		} else {
			$aff .= getDateFR ( $line [2] );
		}
		$aff .= '	</td><td class="' . ($i == 0 ? 'row1' : 'row2') . '" align="center" width="80">';
		if ($line [3] == NULL) {
			$aff .= '<i>NC</i>';
		} else {
			$aff .= getDateFR ( $line [3] );
		}
		$aff .= '	</td><td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=edit&id=' . $line [0] . '"><img src="../../../include/images/document_edit.png" border=0/></a></td>';
		$aff .= '	<td class="' . ($i == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=delete&id=' . $line [0] . '"><img src="../../../include/images/garbage_empty.png" border=0/></a></td>';
		$aff .= '</tr>';

		$i = ($i == 0 ? 1 : 0);
	}

	mysqli_free_result  ( $result );

	// Deconnexion BD
	include ('../../../../../include/DbDeconnexion.php');

	echo $aff;
} 
else {
	echo 'err';
}
?>