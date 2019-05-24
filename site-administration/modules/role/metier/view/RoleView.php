<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage role
 * @version 1.0.4
 */
class RoleView {
	private $myRole;

	function __construct($aRole)
	{
		$this->myRole = $aRole;
	}
	function RoleView($aRole) {
		self::__construct($aRole);
	}

	// ###############
	function render($mod) {

		// Navigation bar
		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;<a href="?">R&ocirc;le</a>&nbsp;>&nbsp;';

		// Formualire
		switch ($mod) {
			case 'c' :
				$aff .= 'Creation</div><br/><br/>';
				$aff .= '<form method="POST" action="?action=c&id=' . $_GET ['id'] . '&idi=' . $_GET ['idi'] . '" onsubmit="return ValidationFormulaireRoleNew()">';
				break;
			case 'u' :
				$aff .= 'Edition</div><br/><br/>';
				$aff .= '<form method="POST" action="?action=u&id=' . $this->myRole->getID () . '" onsubmit="return ValidationFormulaireRoleEdit()">';
				break;
		}

		$aff .= '<table width="800">';

		$aff .= '<tr>';
		$aff .= '<td width="150">Individu</td>';
		$aff .= '<td>' . $this->myRole->getIndividu ()->getNom () . ' ' . $this->myRole->getIndividu ()->getPrenom () . ' <a href="../individu/?action=edit&id=' . $this->myRole->getIndividu ()->getID () . '"><img src="../../include/images/doc.jpeg" border="0"/></a></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td width="150">Etablissement</td>';
		$aff .= '<td><input type="hidden" name="EtablissementID"/>' . $this->myRole->getEtablissement ()->getRaisonSociale () . ' <a href="../etablissement/?action=edit&id=' . $this->myRole->getEtablissement ()->getID () . '"><img src="../../include/images/doc.jpeg" border="0"/></a></td>';
		$aff .= '</tr>';
		$aff .= '</table><br/><br/>';

		$aff .= '<script type="text/javascript">';
		$aff .= '$(document).ready(function(){';
		$aff .= '$("#addDAFx").click(function(){
					if($("#DomainActiviteID").val()!="0")
					{
						var DAID = $("#DomainActiviteID option:selected").val();
						var DAString = $("#DomainActiviteID option:selected").text();
						var FxID = $("#FonctionDAID option:selected").val();
						var FxString = $("#FonctionDAID option:selected").text();
								
						var msg = "<tr>";
						msg += "<td><input type=\'hidden\' name=\'DA-"+$("#DAFxCounter").val()+"\' value=\'"+DAID+"\'/>"+DAString+"</td>";
						msg += "<td><input type=\'hidden\' name=\'Fx-"+$("#DAFxCounter").val()+"\' value=\'"+FxID+"\'/>"+FxString+"</td>";
						msg += "<td width=\'50\' align=\'center\'><a href=\'#\' onclick=\'if(confirm(\"Etes-vous sur?\")){$(this).parent().parent().remove();}\'><img src=\'../../include/images/garbage_empty.png\' border=\'0\'/></a></td>";
						msg += "</tr>";
						
						$("#DAFxTable").append(msg);
						$("#DAFxCounter").val(parseInt($("#DAFxCounter").val()) + 1);
						
						$("#DomainActiviteID option:first").attr("selected",true);
						$("#FonctionDAID option:first").attr("selected",true);
					}
					});';
		$aff .= '});';
		$aff .= '</script>';

		$aff .= '<input type="button" value="Définir comme \'Lieu de travail\'" onclick="document.location.href=\'?action=lieuTravail&uid=' . $this->myRole->getIndividu ()->getID () . '&cid=' . $this->myRole->getEtablissement ()->getID () . '&id=' . $this->myRole->getID () . '\'"/>';
		$aff .= '<table width="800" border="1" id="DAFxTable">';
		$aff .= '<tr>';
		$aff .= '	<td width="350" align="center"><b>Domaine Activit&eacute;</b></td>';
		$aff .= '	<td width="350" align="center"><b>Fonction</b></td>';
		if ($mod != 'c') {
			$aff .= '	<td width="50" align="center"><b>Action</b></td>';
		}
		$aff .= '</tr>';

		$aff .= '<tr><td valign="top">';
		$aff .= '<select name="DomainActiviteID" id="DomainActiviteID">';
		$aff .= '<option value="0">-Choisir un Domaine d\'activité-</option>';
		$aDomaineActiviteListe = new DomaineActiviteListe ();
		$aDomaineActiviteListe->select_all_domaineactivite ();
		$aDomaineActiviteID = NULL;
		foreach ( $aDomaineActiviteListe->getDomaineActiviteListe () as $aDomaineActivite ) {
			$aff .= '<option value="' . $aDomaineActivite->getID () . '">' . stripslashes ( $aDomaineActivite->getName () ) . '</option>';
			if (is_null ( $aDomaineActiviteID )) {
				$aDomaineActiviteID = 0;
			}
		}
		$aff .= '</select>';
		$aff .= '<script type="text/javascript">';
		$aff .= '$(document).ready(function(){';
		$aff .= '	$.ajax({
						   type: "GET",
						   url: "../lva/FonctionDA/indexAJAX.php",
						   data: "action=list&id="+' . $aDomaineActiviteID . ',
						   success: function(msg){
								$("#FonctionDAID").html(msg);
							}
						});';
		$aff .= '	$("#DomainActiviteID").change(function(){
						$.ajax({
						   type: "GET",
						   url: "../lva/FonctionDA/indexAJAX.php",
						   data: "action=list&id="+$("#DomainActiviteID").val(),
						   success: function(msg){
								$("#FonctionDAID").html(msg);
							}
						});
						return false;
					});';
		$aff .= '});';
		$aff .= '</script>';
		$aff .= '</td>';

		$aff .= '<td valign="top"><select name="FonctionDAID" id="FonctionDAID"></select></td>';
		if ($mod != 'c') {
			$aff .= '<td align="center" valign="top"><a href="#" id="addDAFx"><img src="../../include/images/add.png" border="0"/></a></td>';
		}
		$aff .= '</tr>';

		$aff .= '<tr><td colspan="3"><br/><br/></td></tr>';

		if ($mod != 'c') {
			// Liste des DA et Fonction existante

			$aDomaineActiviteFonctionList = new DomaineActiviteFonctionList ();
			$aDomaineActiviteFonctionList->SQL_SELECT_ALL ( $this->myRole->getID () );
			$DAFxCounter = 0;
			foreach ( $aDomaineActiviteFonctionList->getList () as $aDomaineActiviteFonction ) {
				$aDA = new DomaineActivite ();
				$aDA->select_domaineactivite ( $aDomaineActiviteFonction->getDomaineActiviteID () );
				$aFx = new FonctionDA ();
				$aFx->SQL_SELECT ( $aDomaineActiviteFonction->getFonctionDAID () );

				$aff .= '<tr>';
				$aff .= '<td><input type="hidden" name="DA-' . $DAFxCounter . '" value="' . $aDomaineActiviteFonction->getDomaineActiviteID () . '"/>' . $aDA->getName () . '</td>';
				$aff .= '<td><input type="hidden" name="Fx-' . $DAFxCounter . '" value="' . $aDomaineActiviteFonction->getFonctionDAID () . '"/>' . $aFx->getLibelle () . '</td>';
				$aff .= '<td width="50" align="center"><a href="#" onclick="if(confirm(\'Etes-vous sur?\')){$(this).parent().parent().remove();}"><img src="../../include/images/garbage_empty.png" border="0"/></a></td>';
				$aff .= '</tr>';
				$DAFxCounter ++;
			}
		}
		$aff .= '</table>';

		if ($mod != 'c') {
			$aff .= '<input type="hidden" name="DAFxCounter" id="DAFxCounter" value="' . $DAFxCounter . '"/>';
		}
		$aff .= '<br/>';

		switch ($mod) {
			case 'c' :
				$aff .= '<input type="submit" value="Créer"></td>';
				break;
			case 'u' :
				$aff .= '<input type="submit" value="Mettre à jour"></td>';
				break;
		}
		$aff .= '</form>';
		echo $aff;
	}
}
?>