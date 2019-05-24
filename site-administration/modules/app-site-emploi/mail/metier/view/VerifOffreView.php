<?php
/**
 * Vue d'édition d'une offre
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 */
class VerifOffreView {
	private $myVerif;
	private $domaine;
	private $metier;
	private $depart;
	private $type;
	private $exp;
	private $niv;
	private $MessageErreur;
	public function __construct($aVerif = NULL, $aDomaine = NULL, $aMetier = NULL, $aDepart = NULL, $aType = NULL, $aExp = NULL, $aNiv = NULL) {
		$this->myVerif = $aVerif;
		$this->domaine = $aDomaine;
		$this->metier = $aMetier;
		$this->depart = $aDepart;

		$this->type = $aType;
		$this->exp = $aExp;
		$this->niv = $aNiv;

		$this->MessageErreur = '';
	}
	public function rendertreeview() {
		// On affche l'arbre contenant la liste des Régions : Départements
		$aff = '
 		<script type="text/javascript" src="../../include/js/jquery/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="../../include/js/jquery/jquery-ui-1.12.1.js"></script>
				<link rel="stylesheet" href="include/css/jstree/style.css">
		<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.3/jstree.min.js"></script>
		<script>
		$(function() {
		  $(\'#treeDep\').jstree
			({
		 		"core" : {
		            "data" : data,
					"themes": {
			                "name": "proton",
			                "responsive": true
			            }
				},
		 		"plugins" : ["wholerow","checkbox"]
			}).on(\'ready.jstree\', function () {
				setTimeout(function () {
								$("#treeDep").jstree("close_all");
								$("#treeDep").fadeIn(10);
								currentNode = $("#treeDep").jstree("get_checked");
								document.getElementById("depselect").value = currentNode;}, 100);});
			});
	
		$(function() {
		 $(\'#treeDep\').click(function(){
	
						currentNode = $("#treeDep").jstree("get_checked");
	
						document.getElementById("depselect").value = currentNode;
						});
			});
		</script>
				';
		return $aff;
	}
	public function setMessageErreur($msg) {
		$this->MessageErreur = $msg;
	}

	/**
	 *
	 * rendu de la vue
	 *
	 * @param
	 *        	$mod
	 */
	public function renderHTML($mod) {
		// On charge la liste des Regions / Départements
		/*
		 * $aff = '
		 *
		 * <script>
		 *
		 * var data = [
		 * {
		 * "id":"F1",
		 * "name":"task1",
		 * "text":"FRANCE",
		 * "icon": "&nbsp;",
		 * "parent_id":"0",
		 * "children":
		 * [';
		 *
		 * $listregion = new ListRegion ();
		 * $listregion->SQL_SELECT_ALL ();
		 *
		 * foreach ( $listregion->getList () as $region ) {
		 *
		 * if ($region->getidregion () != 92 && $region->getidregion () != 115) {
		 * $aff .= '
		 * {
		 * "id":"R' . $region->getidregion () . '",
		 * "name":"task' . $region->getidregion () . '",
		 * "text":"' . $region->getlibelle () . '",
		 * "icon": "nbsp;",
		 * "parent_id":"1",
		 * "children":[';
		 *
		 * $listdepartement = new ListDepartement ();
		 * $listdepartement->SQL_SELECT_REGION_DEPARTEMENT ( $region->getidregion () );
		 *
		 * foreach ( $listdepartement->getList () as $departement ) {
		 * $jstreeCheck = $listdepartement->SQL_FIND_OFFRE_DEPARTEMENT ( $departement->getid (), $this->myVerif->getnumoffre () );
		 * // if ($this->myVerif->getdepartementid() == '') $jstreeCheck = false;
		 * $aff .= '
		 * {
		 * "id":"' . $departement->getid () . '",
		 * "name":"task' . $departement->getid () . '",
		 * "text":"' . $departement->getCode () . '&nbsp;:&nbsp;' . $departement->getname () . '",
		 * "parent_id":"R' . $region->getidregion () . '",
		 * "icon": "&nbsp;",
		 * "children":[],';
		 * if ($jstreeCheck)
		 * $aff .= '"state": { "selected": true },';
		 * $aff .= '"data":{}
		 * },';
		 * }
		 *
		 * $aff .= ' ],
		 * "data":{}
		 * },';
		 * }
		 * ;
		 * }
		 *
		 * $aff .= '
		 * ],
		 * "data":{}
		 * }
		 * ]
		 *
		 * </script>';
		 */

		// $aff .= $this->rendertreeview ();
		$aff = '<script type="text/javascript">
		$( function() {
    	      $( "#datDebPost" ).datepicker({ dateFormat: "dd/mm/yy" });
    	} );       		
				
		function active(liste_id)
		{
			window.document.getElementByClass(liste_id).disabled=true;
		}
		function desactive(liste_id)
		{
			window.document.getElementByClass(liste_id).disabled=false;
		}
		</script>';

		switch ($mod) {
			case 'editoffre' :
				$aff .= '<div id="FilAriane" ><b><a href="../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;<a href="index.php">';
				$aff .= '<a href="?action=offres&list">Offres</a>&nbsp;>&nbsp;Editer une offre</b></div><br /><br />';
				break;
			case 'deleteoffre' :
				$aff .= '<b><a href="../../index.php">Admin</a>&nbsp;>&nbsp;<a href="index.php">';
				$aff .= '<a href="?action=offres&list">Liste des offres</a>&nbsp;>&nbsp;';
				$aff .= 'Supprimer une offre</b><br />';
				break;
		}

		switch ($mod) {
			case 'editoffre' :
				$aff .= '<form method="POST" enctype="multipart/form-data" action="?action=editoffre&id=' . $this->myVerif->getnumoffre () . '">';
				break;
			case 'deleteoffre' :
				$aff .= '<form method="POST" action="?action=deleteoffre&id=' . $this->myVerif->getnumoffre () . '">';
				break;
		}

		if ($this->MessageErreur != '') {
			$aff .= '<font style="color:red;font-weight:bold;">' . $this->MessageErreur . '</font>';
		}
		$aff .= '<textarea name="numoffre" style="display:none">' . $this->myVerif->getnumoffre () . '</textarea>';
		$aff .= '<table class="test">';
		$aff .= '<tr>';
		$aff .= '	<td class="colgauche"><font size=2 color="000080" face="Arial">N°</td>';
		$aff .= '	<td class="coldroite">' . $this->myVerif->getnumoffre () . '</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td class="colgauche"><font size=2 color="000080" face="Arial">Date de l\'offre</td>';
		$aff .= '	<td class="coldroite">' . $this->myVerif->getdateoffre () . '</td>';
		$aff .= '</tr>';

		$aff .= '<form enctype="multipart/form-data" method="POST" action="?action=editoffre&id=' . $this->myVerif->getnumoffre () . '">';

		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Titre de l\'offre </font></b></td><td class="coldroite"><input type="text" value="' . stripslashes ( $this->myVerif->gettitreoffre () ) . '" style="width:400px;" name="titre"></td></tr>';

		$aff .= '<tr>';
		$aff .= '<td class="colgauche" style="height:29px;" ><b><font size=2 color="#000080" face="Arial">Département </font></b></td>';
		// $aff .= '<td class="coldroite">';
		// $aff .= '<div style="width:10px;height:00px;float:left;background:transparent;"><input type="text" required name="depselect" id="depselect" value="" style="color:#f5f8fc;height:25px;width:185px;border-style:hidden;background:transparent;" /></div>';
		// $aff .= '<div id="treeDep" style="display:inline-block;padding-top:6px;vertical-align:top;text-align:left;margin-left:15px;float:left;"></div>';
		// $aff .= '</td></tr>';
		$aff .= '<td class="coldroite"><select name="depselect" style="width:400px;">';
		$aff .= '						<option value=""></option>';
		foreach ( $this->depart->getList () as $dep ) {
			$aff .= '<option value="' . $dep->getiddepartement () . '" ' . ($dep->getcode () == $this->myVerif->getdepartementlibelle () ? 'selected' : '') . '>' . $dep->getlibelle () . '</option>';
		}
		$aff .= '		</select></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Ville </font></b></td><td class="coldroite"><input type="text" value="' . stripslashes ( $this->myVerif->getville () ) . '" style="width:400px;" name="ville"></td></tr>';

		// $aff .= ' <tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Région </font></b></td><td class="coldroite"><select name="region" style="width:400px;">';
		// $aff .= ' <option value=""></option>';
		// foreach($this->region->getList() as $reg){
		// $aff .= '<option value="'.$reg->getidregion().'" '.($reg->getlibelle()==$this->myVerif->getregionid()?'selected':'').'>'.$reg->getlibelle().'</option>';
		// }
		// $aff .= ' </select></td></tr>';

		// $aff .= ' <tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Domaine d\'activité </font></b></td><td class="coldroite"><select name="domaine" style="width:400px;">';
		// $aff .= ' <option value=""></option>';
		// foreach ( $this->domaine->getList () as $dom ) {
		// $aff .= '<option value="' . $dom->getiddomaine () . '" ' . ($dom->getnomdomaine () == $this->myVerif->getiddomaine () ? 'selected' : '') . '>' . $dom->getnomdomaine () . '</option>';
		// }
		// $aff .= ' </select></td></tr>';

		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Type de métier </font></b></td><td class="coldroite"><select name="metier" style="width:400px;">';
		$aff .= '						<option value=""></option>';
		$precIdCatmetier = 0;
		foreach ( $this->metier->getList () as $met ) {
			if ($met->getidcatmetier () != $precIdCatmetier && $precIdCatmetier != 0) {
				$aff .= '</optgroup>';
			}
			if ($met->getidcatmetier () != $precIdCatmetier) {
				$aff .= '<optgroup label="' . $met->getnomcatmetier () . '">';
			}
			$aff .= '<option value="' . $met->getidmetier () . '" ' . ($met->getidmetier () == $this->myVerif->getidmetier () ? 'selected' : '') . '>' . $met->getnommetier () . '</option>';
			$precIdCatmetier = $met->getidcatmetier ();
		}
		$aff .= '</optgroup>';
		$aff .= '		</select></td></tr>';

		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Type de contrat </font></b></td><td class="coldroite"><select name="type" style="width:400px;">';
		$aff .= '						<option value=""></option>';
		foreach ( $this->type->getList () as $typ ) {
			$aff .= '<option value="' . $typ->getidtype () . '" ' . ($typ->getnomtype () == $this->myVerif->gettype () ? 'selected' : '') . '>' . $typ->getnomtype () . '</option>';
		}
		$aff .= '		</select></td></tr>';

		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Niveau </font></b></td><td class="coldroite"><select name="niveau" style="width:400px;">';
		$aff .= '						<option value=""></option>';
		foreach ( $this->niv->getList () as $lvl ) {
			$aff .= '<option value="' . $lvl->getidniveau () . '"' . ($lvl->getniveau () == $this->myVerif->getniveau () ? 'selected' : '') . '>' . $lvl->getniveau () . '</option>';
		}
		$aff .= '		</select></td></tr>';

		// $aff .= ' <tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Fonction </font></b></td><td class="coldroite"><input value="' . stripslashes ( $this->myVerif->getfonction () ) . '" type="text" style="width:400px;" name="fonction"></td></tr>';

		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Experience </font></b></td><td class="coldroite"><select name="exp" style="width:400px;">';
		$aff .= '						<option value=""></option>';
		foreach ( $this->exp->getList () as $xp ) {
			$aff .= '<option value="' . $xp->getidexp () . '" ' . ($xp->getexperience () == $this->myVerif->getexp () ? 'selected' : '') . '>' . $xp->getexperience () . '</option>';
		}
		$aff .= '		</select></td></tr>';

		$aff .= '		<tr><td class="colgauche" valign="top"><b><font size=2 color="000080" face="Arial">Commentaire </font></b></td><td class="coldroite"><textarea name="commentaire" style="width:400px;height:100px;">' . stripslashes ( $this->myVerif->getcommentaire () ) . '</textarea></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Date de Prise de poste </font></b></td>';
		$aff .= '       <td class="coldroite"><input style="width:30%" type="text" name="datDebPost" id="datDebPost" value="' . $this->myVerif->getdatedebpost () . '" ></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Personne à contacter </font></b></td><td class="coldroite"><input type="text" style="width:400px;" name="contact" value="' . stripslashes ( $this->myVerif->getcontact () ) . '" /></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">E-mail </font></b></td><td class="coldroite"><input value="' . $this->myVerif->getmail () . '" type="text"  style="width:400px;" name="mail"></td></tr>';

		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Fichier attaché</font></b>';

		$aff .= '		</td><td><a style="text-decoration:underline;color:blue;" href="mail/metier/getFichier.php?id=' . $this->myVerif->getnumoffre () . '" target="_BLANK">' . $this->myVerif->getfichier () . '</a>&nbsp;<input id="modif" type="button" onclick="javascript:affichefichier()" value="Modifier" /><br />';
		$aff .= '		<div id="fichier" style="display:none"><input type="hidden" name="MAX_FILE_SIZE" value="500000" /><input id="champ_fichier" style="width:400px;" type="file" name="fichier" class="champ"><input  type="button" onclick="javascript:cachefichier()" value="Annuler" /></div></td></tr>';

		$aff .= '<br>';

		switch ($mod) {
			case 'editoffre' :
				$aff .= '<tr>';
				$aff .= '	<td><font size=2 color="000080" face="Arial">Validation</td><td>';

				if (is_null ( $this->myVerif->getvalid () )) {
					$aff .= '<input type="radio" name="valid" value="1"/>OUI&nbsp;&nbsp;';
					$aff .= '<input type="radio" name="valid" value="0"/>NON';
				} elseif ($this->myVerif->getvalid () == 1) {
					$aff .= '<input type="radio" name="valid" value="1" CHECKED />OUI&nbsp;&nbsp;';
					$aff .= '<input type="radio" name="valid" value="0"/>NON';
				} else {
					$aff .= '<input type="radio" name="valid" value="1"/>OUI&nbsp;&nbsp;';
					$aff .= '<input type="radio" name="valid" value="0" CHECKED />NON';
				}

				$aff .= '</td></tr><tr><td><br /><input type="submit" value="Mettre à jour"></td></tr>';
				break;
			case 'deleteoffre' :
				$aff .= '<tr><td><form method="POST" action="?action=deleteoffre&id=' . $this->myVerif->getnumoffre () . '"><input type="hidden" name="numoffre" value="' . $this->myVerif->getnumoffre () . '"><input type="submit" value="Supprimer"></form></td></tr>';
				break;
		}

		$aff .= '</table>';
		$aff .= '</form>';

		$aff .= '<script>
				function affichefichier()
				{
        			if (document.getElementById("fichier").style.display = "none")
					{
						document.getElementById("fichier").style.display = "block";
						document.getElementById("modif").style.display = "none";							
					}
				}
				function cachefichier()
				{
					if(document.getElementById("fichier").style.display = "block")
					{
						document.getElementById("fichier").style.display = "none";
						document.getElementById("modif").style.display = "block";
						document.getElementById("champ_fichier").value = "";
					}		
				}
		</script>';

		echo $aff;
	}

	/**
	 *
	 * Redirection
	 *
	 * @param
	 *        	$url
	 */
	public function redirection($url) {
		$aff = '<script type="text/javascript">';
		// $aff .= 'alert(\'enregistrement réussi\');';
		$aff .= 'document.location.href="' . $url . '";';
		$aff .= '</script>';
		echo $aff;
	}
	/**
	 *
	 * Redirection après redirection
	 *
	 * @param
	 *        	$url
	 */
	public function redirection_delete($url) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href="' . $url . '";';
		$aff .= '</script>';
		echo $aff;
	}
}
?>