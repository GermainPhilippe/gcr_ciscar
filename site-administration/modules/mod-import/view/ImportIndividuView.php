<?php
class ImportIndividuView {
	public function __construct() {
	}
	public function renderHTML() {
		$aff = '';
		$aff .= '<div id="FilAriane"><a href="../../?menu=1">Général</a>&nbsp;>&nbsp;Import Individu</div>';

		$aff .= '<form method="post" action="?action=import" id="formImportIndividu" enctype="multipart/form-data">';

		$aff .= '<p><label for="URLFile">Fichier </label><input type="file" id="URLFile" name="URLFile"> <a href="/admin/modules/mod-import/Modele_Import.csv"> >>> Modèle CSV <<<</a></p>';

		// LCA
		$aff .= '<p><u><b>LCA</b></u></p>';

		$aff .= '<p><label for="pLCACISCAR">CISCAR</label>';
		$aff .= '<input type="radio" name="pLCACISCAR" value="1">OUI';
		$aff .= '<input type="radio" name="pLCACISCAR" value="0" CHECKED>NON';
		$aff .= '</p>';

		$aff .= '<p><label for="PROFIL_RENAULT">Affichage</label>';
		$aff .= '<input type="radio" name="PROFIL_RENAULT" value="0">Renault';
		$aff .= '<input type="radio" name="PROFIL_RENAULT" value="1" CHECKED>Hors Renault';
		$aff .= '<input type="radio" name="PROFIL_RENAULT" value="2" CHECKED>Indra';
		$aff .= '</p>';

		// $aff .= '<p><label for="pLCAGCNF">GCNF</label>';
		// $aff .= '<input type="radio" name="pLCAGCNF" value="1">OUI';
		// $aff .= '<input type="radio" name="pLCAGCNF" value="0" CHECKED>NON';
		// $aff .= '</p>';

		$aff .= '<p><label for="pLCAGCR">GCR</label>';
		$aff .= '<input type="radio" name="pLCAGCR" value="1">OUI';
		$aff .= '<input type="radio" name="pLCAGCR" value="0" CHECKED>NON';
		$aff .= '</p>';

		$aff .= '<p><label for="pLCASiteEmploi">GCR - Site Emploi</label>';
		$aff .= '<input type="radio" name="pLCASiteEmploi" value="1">OUI';
		$aff .= '<input type="radio" name="pLCASiteEmploi" value="0" CHECKED>NON';
		$aff .= '</p>';

		$aff .= '<p><label for="pLCACiscom">Autologin - CIS-COM</label>';
		$aff .= '<input type="radio" name="pLCACiscom" value="1">OUI';
		$aff .= '<input type="radio" name="pLCACiscom" value="0" CHECKED>NON';
		$aff .= '</p>';

		$aff .= '<p><label for="pLCACarterie">Autologin - Carterie</label>';
		$aff .= '<input type="radio" name="pLCACarterie" value="1">OUI';
		$aff .= '<input type="radio" name="pLCACarterie" value="0" CHECKED>NON';
		$aff .= '</p>';

		$aff .= '<p><label for="pLCACISCARBELGE">CISCAR BELGE</label>';
		$aff .= '<input type="radio" name="pLCACISCARBELGE" value="1">OUI';
		$aff .= '<input type="radio" name="pLCACISCARBELGE" value="0" CHECKED>NON';
		$aff .= '</p>';

		$aff .= '<p><label for="pLCASTVA">Autologin - STVA</label>';
		$aff .= '<input type="radio" name="pLCASTVA" value="1">OUI';
		$aff .= '<input type="radio" name="pLCASTVA" value="0" CHECKED>NON';
		$aff .= '</p>';

		// Domaine activite + Function
		$aff .= '<p><u><b>Role</b></u></p>';
		$aff .= '<p><label>Domaine activite</label><select name="DomainActiviteID" id="DomainActiviteID">';
		$aff .= '<option value="0"></option>';
		$aDomaineActiviteListe = new DomaineActiviteListe ();
		$aDomaineActiviteListe->select_all_domaineactivite ();
		foreach ( $aDomaineActiviteListe->getDomaineActiviteListe () as $aDomaineActivite ) {
			$aff .= '<option value="' . $aDomaineActivite->getID () . '">' . stripslashes ( $aDomaineActivite->getName () ) . '</option>';
		}
		$aff .= '</select></p>';
		$aff .= '<p><p><label>Fonction</label><select name="FonctionDAID" id="FonctionDAID"></select></p>';

		$aff .= '<p><input type="submit" value="Importer"></p>';
		$aff .= '<form>';

		echo $aff;
	}
}