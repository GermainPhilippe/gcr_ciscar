<div class="headerContainer">
	<table width="100%">
		<tr>
			<td>
			<?php
			switch ($_SESSION ['SITE'] ['NAME']) {
				case 'CISCAR' :
					echo '<img src="/admin/include/images/LogoAdministration-CISCAR.JPG"/>'; // CISCAR
					break;
				case 'GCR' :
					echo '<img src="/admin/include/images/LogoAdministration-GCR.jpg"/>'; // GCR
					break;
				case 'GCRE' :
					echo '<img src="/admin/include/images/LogoAdministration-GCRE.jpg"/>'; // GCRE
					break;
				case 'ACNF' :
					echo '<img src="/admin/include/images/LogoAdministration-GCNF.jpg"/>'; // GCNF
					break;
				default :
					echo '<img src="/admin/include/images/LogoAdministration.JPG"/>'; // default
					break;
			}
			?>
			</td>
		</tr>
	</table>
</div>


<?php
if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	?>
<div class="searchBar">
	<table width="100%">
		<tr>
			<td width="50%" align="left" style="font-size: 11px;">
			<?php
	echo $_SESSION ['ADMIN'] ['USER'] ['FULLNAME'];
	echo ' (<a href="/admin/modules/individu?action=edit&id=' . $_SESSION ['ADMIN'] ['USER'] ['USERID'] . '">Mon compte</a> | ';
	echo '<a href="/admin/?action=q">Déconnexion</a>)';
	?>
		</td>
			<td width="50%" align="right">Rechercher : <input type="text"
				id="wordSearch1" name="wordSearch1" value="Individu"
				placeholder="Individu" onclick="search.onclick('wordSearch1');"
				onblur="search.onblur('wordSearch1');"
				onkeyup="search.keypress(event);"> <input type="text"
				id="wordSearch2" name="wordSearch2" value="Etablissement"
				placeholder="Etablissement" onclick="search.onclick('wordSearch2');"
				onblur="search.onblur('wordSearch2');"
				onkeyup="search.keypress(event);"> <input type="text"
				id="wordSearch3" name="wordSearch3" value="Publication"
				placeholder="Publication" onclick="search.onclick('wordSearch3');"
				onblur="search.onblur('wordSearch3');"
				onkeyup="search.keypress(event);"> <input type="button" value="ok"
				onclick="search.btSubmit();">
			</td>
		</tr>
	</table>

	<script>
		var search = {
			_submit : function () {
				
				var wordSearch1 = document.getElementById("wordSearch1");
				var wordSearch2 = document.getElementById("wordSearch2");
				var wordSearch3 = document.getElementById("wordSearch3");

				wordSearch1.value = (wordSearch1.value =="Individu" ? "" : wordSearch1.value );
				wordSearch2.value = (wordSearch2.value =="Etablissement" ? "" : wordSearch2.value );
				wordSearch3.value = (wordSearch3.value =="Publication" ? "" : wordSearch3.value );
				
				if(wordSearch1.value != "") {
					document.location.href="/admin/modules/individu?Recherche="+wordSearch1.value;
				} else if(wordSearch2.value != "") {
					document.location.href="/admin/modules/etablissement?Recherche="+wordSearch2.value;
				} else if(wordSearch3.value != "") {
					document.location.href="/admin/modules/document/DocInfoDyn?Recherche="+wordSearch3.value;
				} else {
					wordSearch1.value ="Individu";
					wordSearch2.value ="Etablissement";
					wordSearch3.value ="Publication";
				}
			},
			btSubmit : function () {
				search._submit();
			},
			onclick : function(idElement) {
				var element = document.getElementById(idElement);
				switch(element.value) {
					case "Individu" :
					case "Etablissement" :
					case "Publication" :
						element.value = "";
						break; 
				}	


				
				element.value = "";	
			},
			onblur : function(idElement) {
				var element = document.getElementById(idElement);

				if(element.value=="") {
					switch(idElement) {
						case "wordSearch1" :
							element.value = "Individu";
							break;
						case "wordSearch2" :
							element.value = "Etablissement";
							break;
						case "wordSearch3" :
							element.value = "Publication";
							break; 
					}
				}					
			},
			keypress : function (event) {

				// MSIE hack
				if (window.event)
				{
					event = window.event;
				}
				
				if( event.keyCode=="13") {
					search._submit();
				}
			}
		};
	</script>
</div>
<?php
}
?>


<div class="page">
		
<?php
if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	if (! isset ( $_SESSION ['SITE'] ['TAB'] )) {
		$_SESSION ['SITE'] ['TAB'] = '1';
	}
	if (isset ( $_GET ['menu'] )) {
		$_SESSION ['SITE'] ['TAB'] = $_GET ['menu'];
	}

	$menuID = isset ( $_GET ['menu'] ) ? $_GET ['menu'] : $_SESSION ['SITE'] ['TAB'];

	// Role Rules
	$ROLE_RULES ['General'] ['Fichier Attachés'] = array (
			1
	);
	$ROLE_RULES ['General'] ['Paramètres'] = array (
			1
	);
	$ROLE_RULES ['General'] ['LCA'] = array (
			1
	);
	$ROLE_RULES ['General'] ['Export'] = array (
			1,
			2
	);
	$ROLE_RULES ['General'] ['Anomalie'] = array (
			1
	);
	$ROLE_RULES ['Site'] ['Individu'] = array (
			1,
			2
	);
	$ROLE_RULES ['Site'] ['Role'] = array (
			1,
			2
	);
	$ROLE_RULES ['Site'] ['Etablissement'] = array (
			1,
			2
	);
	$ROLE_RULES ['Site'] ['Liste de Valeurs'] = array (
			1
	);
	$ROLE_RULES ['Site'] ['Mail'] = array (
			1
	);
	$ROLE_RULES ['Site'] ['Autologin'] = array (
			1
	);
	$ROLE_RULES ['Site'] ['Liste diffusion'] = array (
			1
	);
	$ROLE_RULES ['Site'] ['Newsletter'] = array (
			1,
			2
	);
	$ROLE_RULES ['WebContent'] ['Catégorie'] = array (
			1
	);
	$ROLE_RULES ['WebContent'] ['Bannière'] = array (
			1
	);
	$ROLE_RULES ['WebContent'] ['Partenaires'] = array (
			1
	);
	$ROLE_RULES ['WebContent'] ['DocInfoDyn'] = array (
			1
	);
	$ROLE_RULES ['WebContent'] ['DocZoom'] = array (
			1
	);
	$ROLE_RULES ['WebContent'] ['DocStatic'] = array (
			1
	);
	$ROLE_RULES ['WebContent'] ['Menu Dynamique'] = array (
			1
	);
	$ROLE_RULES ['WebContent'] ['Flash Info'] = array (
			1
	);
	$ROLE_RULES ['WebContent'] ['Formulaire en ligne'] = array (
			1,
			2
	);
	$ROLE_RULES ['SiteEmploi'] ['Mail'] = array (
			1
	);
	$ROLE_RULES ['SiteEmploi'] ['Accueil'] = array (
			1
	);
	$ROLE_RULES ['SiteEmploi'] ['Balises'] = array (
			1
	);
	$ROLE_RULES ['SiteEmploi'] ['CVs'] = array (
			1
	);
	$ROLE_RULES ['SiteEmploi'] ['Offres'] = array (
			1
	);
	$ROLE_RULES ['SiteEmploi'] ['Réponses'] = array (
			1
	);
	$ROLE_RULES ['SiteEmploi'] ['Page Infos'] = array (
			1
	);
	$ROLE_RULES ['SiteEmploi'] ['Statistiques'] = array (
			1
	);
	$ROLE_RULES ['SiteEmploi'] ['Regions'] = array (
			1
	);
	$ROLE_RULES ['Convention'] ['Conventions'] = array (
			1,
			2
	);
	$ROLE_RULES ['Convention'] ['Paramètres'] = array (
			1
	);
	$ROLE_RULES ['Statistique'] ['GCR'] = array (
			1
	);
	$ROLE_RULES ['Statistique'] ['GCRE'] = array (
			1
	);
	$ROLE_RULES ['Statistique'] ['GCNF'] = array (
			1
	);
	$ROLE_RULES ['Statistique'] ['CISCAR'] = array (
			1
	);

	echo '<div class="panes">';

	// Gestion des onglets
	echo '<ul class="tabs">';

	if ((in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['General'] ['Fichier Attachés'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['General'] ['Fichier Attachés'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['General'] ['Paramètres'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['General'] ['Paramètres'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['General'] ['LCA'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['General'] ['LCA'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['General'] ['Export'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['General'] ['Export'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['General'] ['Anomalie'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['General'] ['Anomalie'] ))) {
		echo '<li><a ' . ($menuID == '1' ? 'class="current"' : '') . ' href="/admin/?menu=1">G&eacute;néral</a></li>';
	}

	if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] != 'GCRE') {

		if ((in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Site'] ['Individu'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Site'] ['Individu'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Site'] ['Role'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Site'] ['Role'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Site'] ['Etablissement'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Site'] ['Etablissement'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Site'] ['Liste de Valeurs'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Site'] ['Liste de Valeurs'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Site'] ['Mail'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Site'] ['Mail'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Site'] ['Autologin'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Site'] ['Autologin'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Site'] ['Liste diffusion'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Site'] ['Liste diffusion'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Site'] ['Newsletter'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Site'] ['Newsletter'] ))) {
			echo '<li><a ' . ($menuID == '2' ? 'class="current"' : '') . ' href="/admin/?menu=2">Site</a></li>';
		}
	}

	if ((in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['WebContent'] ['Catégorie'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['WebContent'] ['Catégorie'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['WebContent'] ['Bannière'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['WebContent'] ['Bannière'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['WebContent'] ['Partenaires'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['WebContent'] ['Partenaires'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['WebContent'] ['DocInfoDyn'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['WebContent'] ['DocInfoDyn'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['WebContent'] ['DocZoom'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['WebContent'] ['DocZoom'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['WebContent'] ['DocStatic'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['WebContent'] ['DocStatic'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['WebContent'] ['Menu Dynamique'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['WebContent'] ['Menu Dynamique'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['WebContent'] ['Flash Info'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['WebContent'] ['Flash Info'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['WebContent'] ['Formulaire en ligne'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['WebContent'] ['Formulaire en ligne'] ))) {
		echo '<li><a ' . ($menuID == '3' ? 'class="current"' : '') . ' href="/admin/?menu=3">Web Content</a></li>';
	}

	if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'GCR') {
		if ((in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['SiteEmploi'] ['Mail'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['SiteEmploi'] ['Mail'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['SiteEmploi'] ['Accueil'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['SiteEmploi'] ['Accueil'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['SiteEmploi'] ['Balises'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['SiteEmploi'] ['Balises'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['SiteEmploi'] ['CVs'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['SiteEmploi'] ['CVs'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['SiteEmploi'] ['Offres'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['SiteEmploi'] ['Offres'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['SiteEmploi'] ['Réponses'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['SiteEmploi'] ['Réponses'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['SiteEmploi'] ['Page Infos'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['SiteEmploi'] ['Page Infos'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['SiteEmploi'] ['Statistiques'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['SiteEmploi'] ['Statistiques'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['SiteEmploi'] ['Regions'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['SiteEmploi'] ['Regions'] ))) {
			echo '<li><a ' . ($menuID == '4' ? 'class="current"' : '') . ' href="/admin/?menu=4">Site Emploi</a></li>';
		}

		if ((in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Convention'] ['Conventions'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Convention'] ['Conventions'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Convention'] ['Paramètres'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Convention'] ['Paramètres'] ))) {
			echo '<li><a ' . ($menuID == '5' ? 'class="current"' : '') . ' href="/admin/?menu=5">Convention</a></li>';
		}
	}

	if ((in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Statistique'] ['CISCAR'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Statistique'] ['CISCAR'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Statistique'] ['GCNF'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Statistique'] ['GCNF'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Statistique'] ['GCR'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Statistique'] ['GCR'] )) || (in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'], $ROLE_RULES ['Statistique'] ['GCRE'] ) || in_array ( $_SESSION ['ADMIN'] ['USER'] ['ISGESTIONNAIRES'], $ROLE_RULES ['Statistique'] ['GCRE'] ))) {
		echo '<li><a ' . ($menuID == '6' ? 'class="current"' : '') . ' class="" href="/admin/?menu=6">Statistiques</a></li>';
	}
	echo '</ul>';
	echo '</div><br><br>';
}
?>