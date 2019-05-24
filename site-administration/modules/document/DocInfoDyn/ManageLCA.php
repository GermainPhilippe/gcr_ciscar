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

$aff = '<html>';
$aff .= '<head>';
$aff .= '	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>';
$aff .= '	<script src="../../../include/js/jquery/jquery-1.4.2.js"></script>';
$aff .= '	<link href="../../../include/js/jquery/treeTable/treeTable.css" rel="stylesheet" type="text/css"/>';
$aff .= '	<script src="../../../include/js/jquery/treeTable/treeTable.js"></script>';
$aff .= '	<script src="../../../include/js/jquery/datepicker/jquery-ui.min.js"></script>';
$aff .= '	<script src="../../../include/js/jquery/jqModal/jqModal.js"></script>';
$aff .= '	<link href="../../../include/js/jquery/jqModal/jqModal.css" rel="stylesheet" type="text/css"/>';
$aff .= '	<script src="include/DocumentLCA.js"></script>';
$aff .= '</head>';
$aff .= '<body>';

// DB Connection
include ('../../../../config/configuration.php');
include ('../../../include/DbConnexion.php');

$baseURLModule = '../../../modules/';
require ('../../mvc_inc.php');

$aDocInfoDynLCAList = new DocInfoDynLCAList ();
if (isset ( $_GET ['id'] ) && ! is_null ( $_GET ['id'] )) {
	$aDocInfoDynLCAList->SQL_select_all ( $_GET ['id'] );
}

// #####################
// #####################
// #####################

// SELECT des groupes LCA SITE
$sql_1 = "SELECT * FROM annuaire_lca_groupe WHERE SiteID='%s' AND TypeGroupeID=2 AND ParentID IS NOT NULL";
$query_1 = sprintf ( $sql_1, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

$result = mysqli_query ($_SESSION['LINK'], $query_1 ) or die ( mysqli_error ($_SESSION['LINK']) );

$aff .= '<table id="LCAGroupeTable">';
$aff .= '<tr id="ex2-node-root"><td colspan="3"></td></tr>';

if (mysqli_num_rows ( $result ) > 0) {
	$aff .= '<tr id="ex2-node-1" class="child-of-ex2-node-root">';
	$aff .= '	<td colspan="3"><b>Groupe LCA Site</b></td>';
	$aff .= '</tr>';

	while ( $line = mysqli_fetch_array  ( $result ) ) {
		$aff .= '<tr id="ex2-node-1-' . $line [0] . '" class="child-of-ex2-node-1">';
		$aff .= '	<td width="0">&nbsp;</td>';
		$aff .= '	<td>' . $line [2] . '</td>';
		$aff .= '	<td align="center" class="addLCAGroupe">';
		if ($aDocInfoDynLCAList->exist ( $line [0] )) {
			$aff .= '<a href="#" id="' . $line [0] . '-moins-' . htmlentities ( $line [2], ENT_QUOTES ) . '">';
			$aff .= '<img src="../../../include/images/checkbox_checked.jpg" border="0"/></a>';
		} else {
			$aff .= '<a href="#" id="' . $line [0] . '-plus-' . htmlentities ( $line [2], ENT_QUOTES ) . '">';
			$aff .= '<img src="../../../include/images/checkbox_empty.jpg" border="0"/></a>';
		}
		$aff .= '	</td>';
		$aff .= '</tr>';
	}
}

mysqli_free_result  ( $result );

// #####################
// #####################
// #####################

// SELECT des groupes DA
$sql_2 = "SELECT * FROM annuaire_lca_groupe WHERE SiteID='%s' AND TypeGroupeID=3 AND GroupeID IN (SELECT LCAGroupeID FROM annuaire_lva_domainactivite WHERE AnnuaireID='%s')";
$query_2 = sprintf ( $sql_2, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

$aff .= '<tr id="ex2-node-2" class="child-of-ex2-node-root">';
$aff .= '	<td colspan="3"><b>Groupe Domaine Activit&eacute;</b></td>';
$aff .= '</tr>';

$result = mysqli_query ($_SESSION['LINK'], $query_2 ) or die ( mysqli_error ($_SESSION['LINK']) );

if (mysqli_num_rows ( $result ) == 0) {
	$aff .= '<tr id="ex2-node-2-1" class="child-of-ex2-node-4">';
	$aff .= '<td colspan="3"><i>Pas de Domaine Activit&eacute;!</i></td>';
	$aff .= '</tr>';
}

while ( $line = mysqli_fetch_array  ( $result ) ) {
	$aff .= '<tr id="ex2-node-2-' . $line [0] . '" class="child-of-ex2-node-2">';
	$aff .= '	<td width="0">&nbsp;</td>';
	$aff .= '	<td>' . $line [2] . '</td>';
	$aff .= '	<td align="center" class="addLCAGroupe">';
	if ($aDocInfoDynLCAList->exist ( $line [0] )) {
		$aff .= '<a href="#" id="' . $line [0] . '-moins-' . htmlentities ( $line [2], ENT_QUOTES ) . '">';
		$aff .= '<img src="../../../include/images/checkbox_checked.jpg" border="0"/></a>';
	} else {
		$aff .= '<a href="#" id="' . $line [0] . '-plus-' . htmlentities ( $line [2], ENT_QUOTES ) . '">';
		$aff .= '<img src="../../../include/images/checkbox_empty.jpg" border="0"/></a>';
	}
	$aff .= '	</td>';
	$aff .= '</tr>';
}

mysqli_free_result  ( $result );

// #####################
// #####################
// #####################

// SELECT des groupes Commission
$sql_3 = "SELECT * FROM annuaire_lca_groupe WHERE SiteID='%s' AND TypeGroupeID=3 AND GroupeID IN (SELECT LCAGroupeID FROM annuaire_lva_commission WHERE AnnuaireID='%s')";
$query_3 = sprintf ( $sql_3, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

$aff .= '<tr id="ex2-node-3" class="child-of-ex2-node-root">';
$aff .= '	<td colspan="3"><b>Groupe Commission</b></td>';
$aff .= '</tr>';

$result = mysqli_query ($_SESSION['LINK'], $query_3 ) or die ( mysqli_error ($_SESSION['LINK']) );

if (mysqli_num_rows ( $result ) == 0) {
	$aff .= '<tr id="ex2-node-3-1" class="child-of-ex2-node-4">';
	$aff .= '<td colspan="3"><i>Pas de Commission!</i></td>';
	$aff .= '</tr>';
}

while ( $line = mysqli_fetch_array  ( $result ) ) {
	$aff .= '<tr id="ex2-node-3-' . $line [0] . '" class="child-of-ex2-node-3">';
	$aff .= '	<td width="0">&nbsp;</td>';
	$aff .= '	<td>' . $line [2] . '</td>';
	$aff .= '	<td align="center" class="addLCAGroupe">';
	if ($aDocInfoDynLCAList->exist ( $line [0] )) {
		$aff .= '<a href="#" id="' . $line [0] . '-moins-' . htmlentities ( $line [2], ENT_QUOTES ) . '">';
		$aff .= '<img src="../../../include/images/checkbox_checked.jpg" border="0"/></a>';
	} else {
		$aff .= '<a href="#" id="' . $line [0] . '-plus-' . htmlentities ( $line [2], ENT_QUOTES ) . '">';
		$aff .= '<img src="../../../include/images/checkbox_empty.jpg" border="0"/></a>';
	}
	$aff .= '	</td>';
	$aff .= '</tr>';
}

mysqli_free_result  ( $result );

// #####################
// #####################
// #####################

// SELECT des groupes Region
$sql_4 = "SELECT * FROM annuaire_lca_groupe WHERE SiteID='%s' AND TypeGroupeID=3 AND GroupeID IN (SELECT LCAGroupeID FROM annuaire_lva_region WHERE AnnuaireID='%s')";
$query_4 = sprintf ( $sql_4, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

$aff .= '<tr id="ex2-node-4" class="child-of-ex2-node-root">';
$aff .= '	<td colspan="3"><b>Groupe R&eacute;gion</b></td>';
$aff .= '</tr>';

$result = mysqli_query ($_SESSION['LINK'], $query_4 ) or die ( mysqli_error ($_SESSION['LINK']) );

if (mysqli_num_rows ( $result ) == 0) {
	$aff .= '<tr id="ex2-node-4-1" class="child-of-ex2-node-4">';
	$aff .= '<td colspan="3"><i>Pas de R&eacute;gion!</i></td>';
	$aff .= '</tr>';
}

while ( $line = mysqli_fetch_array  ( $result ) ) {
	$aff .= '<tr id="ex2-node-4-' . $line [0] . '" class="child-of-ex2-node-4">';
	$aff .= '	<td width="0">&nbsp;</td>';
	$aff .= '	<td>' . $line [2] . '</td>';
	$aff .= '	<td align="center" class="addLCAGroupe">';
	if ($aDocInfoDynLCAList->exist ( $line [0] )) {
		$aff .= '<a href="#" id="' . $line [0] . '-moins-' . htmlentities ( $line [2], ENT_QUOTES ) . '">';
		$aff .= '<img src="../../../include/images/checkbox_checked.jpg" border="0"/></a>';
	} else {
		$aff .= '<a href="#" id="' . $line [0] . '-plus-' . htmlentities ( $line [2], ENT_QUOTES ) . '">';
		$aff .= '<img src="../../../include/images/checkbox_empty.jpg" border="0"/></a>';
	}
	$aff .= '	</td>';
	$aff .= '</tr>';
}

mysqli_free_result  ( $result );

// DB Deconnection
include ('../../../include/DbDeconnexion.php');

$aff .= '</table>';
$aff .= '<script type="text/javascript">
  			$(document).ready(function()  {
  				$("#LCAGroupeTable").treeTable();
  				
  				$("#ex2-node-root").expand();
			});
		</script>';

echo $aff;
?>