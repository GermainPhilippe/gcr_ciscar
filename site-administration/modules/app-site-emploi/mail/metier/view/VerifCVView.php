<?php
/**
 * Vue d'édition d'un cv
 * @author Alexandre DIALLO
 * @package app-site-emploi
 * @subpackage mail
 * @version 1.0.4
 */
class VerifCVView {
	private $myVerif;
	private $pays;
	private $domaine;
	private $departement;
	private $MessageErreur;
	public function __construct($aVerif = NULL, $aPays = NULL, $aDomaine = NULL, $aDepartement = NULL) {
		$this->myVerif = $aVerif;
		$this->pays = $aPays;
		$this->domaine = $aDomaine;
		$this->departement = $aDepartement;

		$this->MessageErreur = '';
	}
	public function rendertreeview() {
		// On affche l'arbre contenant la liste des Régions : Départements
		$aff = '
 		<script type="text/javascript" src="../../include/js/jquery/jquery-1.12.4.min.js"></script>
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
				
		$(function() {
		 $(\'#treeDep\').load(function(){ 
						alert("toto");
						$("#treeDep").css("visibility",visible);

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
		$aff = '
		
		<script>
		
		var data =  [
		   {
		      "id":"F1",
		      "name":"task1",
		      "text":"FRANCE",
			  "icon": "&nbsp;",
			  "parent_id":"0",
		      "children":
			  [';

		$listregion = new ListRegion ();
		$listregion->SQL_SELECT_ALL ();

		foreach ( $listregion->getList () as $region ) {

			if ($region->getidregion () != 92 && $region->getidregion () != 115) {
				$aff .= '
		         {
		            "id":"R' . $region->getidregion () . '",
		            "name":"task' . $region->getidregion () . '",
		            "text":"' . $region->getlibelle () . '",
					"icon": "nbsp;",
		            "parent_id":"1",
		            "children":[';

				$listdepartement = new ListDepartement ();
				$listdepartement->SQL_SELECT_REGION_DEPARTEMENT ( $region->getidregion () );

				foreach ( $listdepartement->getList () as $departement ) {
					$jstreeCheck = $listdepartement->SQL_FIND_CANDIDATURE_DEPARTEMENT ( $departement->getid (), $this->myVerif->getnumcv () );
					// if ($this->myVerif->getdepartementid() == '') $jstreeCheck = false;
					$aff .= '
						{
						"id":"' . $departement->getid () . '",
						"name":"task' . $departement->getid () . '",
						"text":"' . $departement->getCode () . '&nbsp;:&nbsp;' . $departement->getname () . '",
						"parent_id":"R' . $region->getidregion () . '",
						"icon": "&nbsp;",
						"children":[],';
					if ($jstreeCheck)
						$aff .= '"state": { "selected": true },';
					$aff .= '"data":{}
			            },';
				}

				$aff .= '		],
			            "data":{}
		         },';
			}
			;
		}

		$aff .= '
			  ],
		      "data":{}
		   }
		]
		
		</script>';
		$aff .= $this->rendertreeview ();

		switch ($mod) {
			case 'editcv' :
				$aff .= '<form method="POST" enctype="multipart/form-data" action="?action=editcv&id=' . $this->myVerif->getnumcv () . '"><div id="FilAriane" ><b><a href="../../index.php?menu=4">Site Emploi</a>&nbsp;>&nbsp;<a href="index.php">';
				$aff .= '<a href="?action=cv&list">CV\'s</a>&nbsp;>&nbsp;Editer un CV</b><br /><br /></div>';
				break;
		}

		if ($this->MessageErreur != '') {
			$aff .= '<font style="color:red;font-weight:bold;">' . $this->MessageErreur . '</font>';
		}

		$aff .= '	<table class="test" margin="20px">';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">N°</font></b></td><td class="coldroite"><input value="' . $this->myVerif->getnumcv () . '" type="text" name="numcv" style="width:400px;" class="disabled" readonly></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Date de création</font></b></td><td class="coldroite"><input value="' . $this->myVerif->getdatecand () . '" type="text"  style="width:400px;" class="disabled" readonly></td></tr>';

		// $aff .= ' <tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Titre de votre candidature </font></b></td><td class="coldroite"><input value="' . stripslashes ( $this->myVerif->gettitrecand () ) . '" type="text" name="titre" style="width:400px;" class="champ"></td></tr>';

		// $aff .= '<tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Fonction recherchée </td><td class="coldroite"><input type="text" name="fonction" value="' . stripslashes ( $this->myVerif->getfonction () ) . '" style="width:400px;" class="champ"></td></tr>';
		$aff .= '&nbsp;';
		$aff .= '<td class="colgauche" style="height:29px;" ><b><font size=2 color="#000080" face="Arial">Département(s) de recherche</font></b></td>';
		$aff .= '<td class="coldroite">';
		$aff .= '<div style="width:10px;height:00px;float:left;background:transparent;"><input type="text" required name="depselect" id="depselect" value="" style="color:#f5f8fc;height:25px;width:185px;border-style:hidden;background:transparent;" /></div>';
		$aff .= '<div id="treeDep" style="display:inline-block;padding-top:6px;vertical-align:top;text-align:left;margin-left:15px;float:left;"></div>';
		$aff .= '</td></tr>';

		// $aff .= ' <tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Département de recherche </td><td class="coldroite"> ';
		// $aff .= ' <select name="departement" class="champ" style="width:400px;">';
		// $aff .= ' <option value=""></option>';
		// $aff .= ' <option value="0">-Toute la France-</option>';
		// foreach($this->departement->getList() as $dep)
		// {
		// $aff .= '<option value="'.$dep->getiddepartement().'" '.($dep->getiddepartement()==$this->myVerif->getdepartementid()?'selected':'').'>'.$dep->getlibelle().' ('.$dep->getcode().')</option>'; //Liste des départements
		// }
		// $aff .= ' </select></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Votre domaine d\'activité </td><td class="coldroite"><select name="domaine" class="champ" style="width:400px;">';
		$aff .= '						<option value=""></option>';
		foreach ( $this->domaine->getList () as $dom ) {
			$aff .= '<option value="' . $dom->getiddomaine () . '" ' . ($dom->getnomdomaine () == $this->myVerif->getiddomaine () ? 'selected' : '') . '>' . $dom->getnomdomaine () . '</option>';
		}
		$aff .= '		</select></td></tr>';
		$aff .= '		<tr><td style="text-decoration:underline;"><b><font size=2 color="000080" face="Arial"><br />Vos coordonnées :</td></tr>';
		$aff .= '&nbsp;';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Civilit&eacute; </td><td class="coldroite">';
		$aff .= '		<input type="radio" name="civilite" value="0"' . ($this->myVerif->getidcivilite () == 0 ? ' Checked' : '') . '/>Mr.';
		$aff .= '		<input type="radio" name="civilite" value="1"' . ($this->myVerif->getidcivilite () == 1 ? ' Checked' : '') . '/>Mme';
		$aff .= '		<input type="radio" name="civilite" value="2"' . ($this->myVerif->getidcivilite () == 2 ? ' Checked' : '') . '/>Mlle';
		$aff .= '		</td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Nom </td><td class="coldroite"><input type="text" name="nom" class="champ" value="' . $this->myVerif->getnom () . '" style="width:400px;"></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Prénom </td><td class="coldroite"><input type="text" name="prenom" class="champ" value="' . $this->myVerif->getprenom () . '" style="width:400px;"></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Adresse postale </td><td class="coldroite"><input value="' . stripslashes ( $this->myVerif->getadresse () ) . '" type="text" name="adresse" class="champ" style="width:400px;"></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Code postal </td><td class="coldroite"><input value="' . stripslashes ( $this->myVerif->getcp () ) . '" type="text" name="cp" class="champ" style="width:200px;"></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Ville </td><td class="coldroite"><input value="' . stripslashes ( $this->myVerif->getville () ) . '" type="text" name="ville" class="champ" style="width:300px;"></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Adresse e-mail </td><td class="coldroite"><input value="' . $this->myVerif->getmail () . '" type="text" name="mail" class="champ" style="width:400px;"></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Pays </td>';
		$aff .= '		<td><select name="Pays" class="champ" id="pays" onchange="javascript:afficheressort();" style="width:400px;">';
		foreach ( $this->pays->getList () as $lPays ) {
			if ($lPays->getnompays () == 'France') {
				$aff .= '<option ' . ($lPays->getnompays () == $this->myVerif->getidpays () ? 'selected' : '') . ' value="' . $lPays->getidpays () . '">' . $lPays->getnompays () . '</option>';
			} else {
				$aff .= '<option ' . ($lPays->getnompays () == $this->myVerif->getidpays () ? 'selected' : '') . ' value="' . $lPays->getidpays () . '">' . $lPays->getnompays () . '</option>';
			}
		}
		$aff .= '		</select></td></tr>';

		$aff .= '		<tr><td class="colgauche"> </td><td class="coldroite, ressort" id="ressort" ><b><font size=2 color="000080" face="Arial">';
		$aff .= '		<input type="checkbox" value=1 ' . ($this->myVerif->getressort () == 1 ? ' Checked' : '') . ' name="Ressortissants1" id="Ressortissants1">Ressortissants non communautaires</b><br />';
		// $aff .= ' <i>Pays n’appartenant pas à la Communauté européenne, ni au pays suivants :<br />';
		// $aff .= ' Islande, Norvège, Liechtenstein, Suisse, Monaco et Andorre.</i><br />';
		$aff .= '			Disposez-vous d\'un titre de séjour et d\'une autorisation de travail vous permettant de';
		$aff .= '			travailler en France ? <br />';
		$aff .= '			<select name="TitreSejour"  style="width:400px;">';
		$aff .= '			<option value=""></option>';
		$aff .= '			<option value=1 ' . ($this->myVerif->getsejour () == 1 ? "selected" : "") . '>Oui</option>';
		$aff .= '			<option value=0 ' . ($this->myVerif->getsejour () == 2 ? "selected" : "") . '>Non</option>';
		$aff .= '			</select><br />';
		$aff .= '			Quelles sont vos disponibilités pour passer des entretiens d\'embauche chez des';
		$aff .= '			concessionnaires en France et pour occuper un emploi en France ?<br />';
		$aff .= '			<input type="text" value="' . ($this->myVerif->getressort () == 1 ? $this->myVerif->getdispo () : '') . '" name="Disponibilite1" class="champ" id="Disponibilite1"><br />';
		$aff .= '			<b><input type="checkbox" value=2 ' . ($this->myVerif->getressort () == 2 ? ' Checked' : '') . ' name="Ressortissants2" id="Ressortissants2">Ressortissants communautaires</b><br />';
		// $aff .= ' <i>Pays appartenant à la Communauté européenne, ainsi que les pays suivants :<br />';
		// $aff .= ' Islande, Norvège, Liechtenstein, Suisse, Monaco et Andorre.<br />';
		$aff .= '			Quelles sont vos disponibilités pour passer des entretiens d\'embauche chez des';
		$aff .= '			concessionnaires en France et pour occuper un emploi en France ?<br />';
		$aff .= '			<input type="text"  value="' . ($this->myVerif->getressort () == 2 ? $this->myVerif->getdispo () : '') . '" name="Disponibilite2" class="champ" id="Disponibilite2"></td></tr>';

		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">C.V. </td><td class="coldroite">';
		$aff .= '		<a style="color:blue;text-decoration:underline;" href="mail/metier/getCV.php?id=' . $this->myVerif->getnumcv () . '" target="_BLANK">' . $this->myVerif->getcv () . '</a>&nbsp;<input id="modif" type="button" onclick="javascript:affichecv()" value="Modifier" /><br />';
		$aff .= '		<div id="cv" style="display:none"><input type="hidden" name="MAX_FILE_SIZE" value="500000" /><input id="champ_cv" type="file" name="cv" class="champ"><input  type="button" onclick="javascript:cachecv()" value="Annuler" /></div></td></tr>';
		$aff .= '		<tr><td class="colgauche"><b><font size=2 color="000080" face="Arial">Lettre de motivation </td><td class="coldroite">';
		$aff .= '<a style="color:blue;text-decoration:underline;" href="mail/metier/getLM.php?id=' . $this->myVerif->getnumcv () . '" target="_BLANK">' . $this->myVerif->getlettrem () . '</a>&nbsp;<input id="modiflettre" type="button" onclick="javascript:affichelettre()" value="Modifier" />';
		$aff .= '<div id="lettre" style="display:none"><input id="champ_lettre" type="file" name="lettre" class="champ"><input  type="button" onclick="javascript:cachelettre()" value="Annuler" /></div>';

		switch ($mod) {
			case 'editcv' :

				$aff .= '<tr>';
				$aff .= '	<td  class="colgauche"><font size=2 color="000080" face="Arial">Validation</td><td>';
				if (is_null ( $this->myVerif->getvalid () )) {
					$aff .= '<input type="radio" name="valid" value="1"/>OUI&nbsp;&nbsp;';
					$aff .= '<input type="radio" name="valid" value="0"/>NON';
				} elseif ($this->myVerif->getvalid () == 1) {
					$aff .= '<input type="radio" name="valid" value="1" CHECKED/>OUI&nbsp;&nbsp;';
					$aff .= '<input type="radio" name="valid" value="0"/>NON';
				} else {
					$aff .= '<input type="radio" name="valid" value="1"/>OUI&nbsp;&nbsp;';
					$aff .= '<input type="radio" name="valid" value="0" CHECKED/>NON';
				}

				$aff .= '</td></tr><tr><td><br /><input type="submit" value="Mettre à jour"></td></tr>';

				$aff .= '</tr>';
				break;
		}

		$aff .= '</table></form>';
		$aff .= '<script>
        			function afficheressort() {
        				res = window.document.forms[0].Pays;
						if (res.options[res.selectedIndex].text != "France")
						{
							document.getElementById("ressort").style.display = "block";
						}else
						{
							document.getElementById("ressort").style.display = "none";
						}		
					}
				function affichecv() {
        			
						if (document.getElementById("cv").style.display = "none")
							{
								document.getElementById("cv").style.display = "block";
								document.getElementById("modif").style.display = "none";							
							}
						}
				function cachecv(){
						if (document.getElementById("cv").style.display = "block")
							{
							document.getElementById("cv").style.display = "none";
							document.getElementById("modif").style.display = "block";
							document.getElementById("champ_cv").value = "";
							}		
						}
				function affichelettre() {
        			
						if (document.getElementById("lettre").style.display = "none")
							{
								document.getElementById("lettre").style.display = "block";
								document.getElementById("modiflettre").style.display = "none";							
							}
						}
				function cachelettre(){
						if (document.getElementById("lettre").style.display = "block")
							{
							document.getElementById("lettre").style.display = "none";
							document.getElementById("modiflettre").style.display = "block";
							document.getElementById("champ_lettre").value = "";
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