<?php
/**
 * @author Philippe GEMAIN
 * @package site-administration
 * @subpackage Newsletter
 * @version 2.0.1
 */
$baseURLModule = '../../modules/';
require ('../mvc_inc.php');

session_start ();

if (! isset ( $_SESSION ['ADMIN'] )) {
	$_SESSION ['ADMIN'] ['USER'] ['FULLNAME'] = 'Visitor';
	$_SESSION ['ADMIN'] ['USER'] ['SiteName'] = '';
	$_SESSION ['ADMIN'] ['USER'] ['CONNECTED'] = false;
	$_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] = 0;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />
	<?php
	echo HelperHead::includeCSS ( '../../include/css/Commun.css' );
	echo HelperHead::includeCSS ( '../../include/css/CommunLayout.css' );
	echo HelperHead::includeCSS ( '../../include/css/Individu.css' );
	echo HelperHead::includeJS ( '../../include/js/CommunScript.js' );
	echo HelperHead::includeJS ( '../../include/js/jquery/jquery-1.4.2.js' );
	echo HelperHead::includeJS ( '../../include/js/newsletter.js' );
	echo HelperHead::includeJS ( '../../include/js/formulaire_v3.js' );
	echo HelperHead::includeJS ( '../document/DocInfoDyn/include/jquery.tablesorter.min.js' );
	?>
	
	<style type="text/css">
[type="checkbox"]:not (:checked ), [type="checkbox"]:checked {
	display: none;
	/*position: absolute;
		left: -9999px;*/
}

[type="checkbox"]:not (:checked ) +label, [type="checkbox"]:checked+label
	{
	position: relative;
	padding-left: 75px;
	cursor: pointer;
}

[type="checkbox"]:not (:checked ) +label:before, [type="checkbox"]:checked+label:before,
	[type="checkbox"]:not (:checked ) +label:after, [type="checkbox"]:checked+label:after
	{
	content: '';
	position: absolute;
}

[type="checkbox"]:not (:checked ) +label:before, [type="checkbox"]:checked+label:before
	{
	left: 14px;
	top: -3px;
	width: 45px;
	height: 18px;
	background: red;
	border-radius: 13px;
	-webkit-transition: background-color .2s;
	-moz-transition: background-color .2s;
	-ms-transition: background-color .2s;
	transition: background-color .2s;
}

[type="checkbox"]:not (:checked ) +label:after, [type="checkbox"]:checked+label:after
	{
	width: 12px;
	height: 12px;
	-webkit-transition: all .2s;
	-moz-transition: all .2s;
	-ms-transition: all .2s;
	transition: all .2s;
	border-radius: 50%;
	background: green;
	top: 0px;
	left: 18px;
}

/* on checked */
[type="checkbox"]:checked+label:before {
	background: green;
}

[type="checkbox"]:checked+label:after {
	background: red;
	top: 0px;
	left: 41px;
}

[type="checkbox"]:checked+label .uiBN, [type="checkbox"]:checked+label .uiCOM,
	[type="checkbox"]:not (:checked ) +label .uiBN:before, [type="checkbox"]:not
	 (:checked ) +label .uiCOM:before, [type="checkbox"]:checked+label .uiCOM:after,
	[type="checkbox"]:checked+label .uiBN:after {
	position: absolute;
	width: 45px;
	border-radius: 15px;
	font-size: 12px;
	font-weight: bold;
	line-height: 18px;
	top: -3px;
	left: 14px;
	color: grey;
	background: grey;
	-webkit-transition: all .2s;
	-moz-transition: all .2s;
	-ms-transition: all .2s;
	transition: all .2s;
}

[type="checkbox"]:not (:checked ) +label .uiBN:before, [type="checkbox"]:not
	 (:checked ) +label .uiCOM:before {
	content: "";
	left: 14px;
	color: grey;
}

[type="checkbox"]:checked+label .uiBN:after, [type="checkbox"]:checked+label .uiCOM:after
	{
	content: "";
	color: grey;
}

[type="checkbox"]:focus+label:before {
	border: 1px #777;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	-ms-box-sizing: border-box;
	box-sizing: border-box;
	margin-top: 0px;
}
</style>



<title><?php echo $_SESSION['SITE']['NAME'];?> : Admin</title>
<script type="text/javascript">
		
	    function showdivBN()
	    {	    	
		     var elems = ''
	     	 // Mozilla Chrome
		     if (document.getElementsByClassName)
		     	elems = document.getElementsByClassName('BNdiv');
		     else
			 //I.E
			    elems = document.querySelectorAll('div.BNdiv');
							     	
			 var div = '';
		     len = elems.length;
		     
		     for (var i = 0;  i < len; i++)
		     {
		            var div = elems[i];

		            if (div.style.display == 'block') 
		            	div.style.display = 'none';
		            else
		            	div.style.display = 'block';
		     }		     
	    }

	    function showdivCOM()
	    {	    	
		     var elems = ''
	     	 // Mozilla Chrome
		     if (document.getElementsByClassName)
		     	elems = document.getElementsByClassName('COMdiv');
		     else
			 //I.E
			    elems = document.querySelectorAll('div.COMdiv');
							     	
			 var div = '';
		     len = elems.length;
		     
		     for (var i = 0;  i < len; i++)
		     {
		            var div = elems[i];

		            if (div.style.display == 'block') 
		            	div.style.display = 'none';
		            else
		            	div.style.display = 'block';
		     }		     
	    }

	    function showdivBN_Ind(BN_Ind)
	    {	 	
		     var elems = '';
		     var Name_Bn_Ind;
		     Name_BN_Ind = 'BNdiv_Ind' + BN_Ind;

	     	 // Mozilla Chrome
		     if (document.getElementsByClassName)
		     	elems = document.getElementsByClassName('BNdiv_Ind');
		     else
			 //I.E
			    elems = document.querySelectorAll('div.BNdiv_Ind');
							     	
			 var div = '';
		     len = elems.length;
		     
		     for (var i = 0;  i < len; i++)
		     {
		            var div = elems[i];
					if (div.id == Name_BN_Ind)
					{
						if (div.style.display == 'block') 
			            	div.style.display = 'none';
			            else
			            	div.style.display = 'block'
					}
		     }		     
	    }
	        
		$(document).ready(function() 
				{
				    $('#cocheToutBN').click(function() 
				    { // clic sur la case cocher/decocher de la liste des fonctions du BN
						
				     	// Mozilla Chrome
					    if (document.getElementsByClassName)
					    {
					    	elems = document.getElementsByClassName('chkbxBN');
					    	elems_ui = document.getElementsByClassName('uiBN');
						    elems_Fonc = document.getElementsByClassName('chkbxBN_Fonc');
						}
					    else
						//I.E
						{
						    elems = document.querySelectorAll('chkbxBN');
						    elems_ui = document.querySelectorAll('uiBN');
							elems_Fonc = document.querySelectorAll('chkbxBN_Fonc');
						}

						//si la cohe est grisée par une operation fille on dégrise
						var BN_UIchkbx_mere = document.getElementById('UIcocheToutBN');
					   	BN_UIchkbx_mere.innerHTML = "";
						
					    len = elems.length;
					    // on coche/ decoche toutes les cases des fonction
					    for (var i = 0;  i < len; i++)
					    {
					           var BN_chkbx = elems[i];

					           if(this.checked)
					           {
					           	   BN_chkbx.checked= true;
					           }
					           else
					           {
					        	   BN_chkbx.checked= false;
					           }
					     }

					    len = elems_ui.length;
					    // on degrise les coches des fonctions
					    for (var i = 0;  i < len; i++)
					    {
					           var BN_UIchkbx = elems_ui[i];
					           BN_UIchkbx.innerHTML = "";
					    }
					    
					    len = elems_Fonc.length;
					    // on coche/ decoche toutes les cases des individus
					    for (var i = 0;  i < len; i++)
					    {
					           var BN_chkbx = elems_Fonc[i];

					           if(this.checked)
					           {
					           	   BN_chkbx.checked= true;
					           }
					           else
					           {
					        	   BN_chkbx.checked= false;
					           }
					     }
					     
				    });				    
				});

		$(document).ready(function() 
				{
				    $('#cocheToutCOM').click(function() 
				    { // clic sur la case cocher/decocher de la liste des fonctions du BN
						
				     	// Mozilla Chrome
					    if (document.getElementsByClassName)
					    {
					    	elems = document.getElementsByClassName('chkbxCOM');
					    	elems_ui = document.getElementsByClassName('uiCOM');
						    elems_Fonc = document.getElementsByClassName('chkbxBN_Fonc');
						}
					    else
						//I.E
						{
						    elems = document.querySelectorAll('chkbxBN');
						    elems_ui = document.querySelectorAll('uiCOM');
							elems_Fonc = document.querySelectorAll('chkbxBN_Fonc');
						}

						//si la cohe est grisée par une operation fille on dégrise
						var BN_UIchkbx_mere = document.getElementById('UIcocheToutBN');
					   	BN_UIchkbx_mere.innerHTML = "";
						
					    len = elems.length;
					    // on coche/ decoche toutes les cases des fonction
					    for (var i = 0;  i < len; i++)
					    {
					           var BN_chkbx = elems[i];

					           if(this.checked)
					           {
					           	   BN_chkbx.checked= true;
					           }
					           else
					           {
					        	   BN_chkbx.checked= false;
					           }
					     }

					    len = elems_ui.length;
					    // on degrise les coches des fonctions
					    for (var i = 0;  i < len; i++)
					    {
					           var BN_UIchkbx = elems_ui[i];
					           BN_UIchkbx.innerHTML = "";
					    }
					    
					    len = elems_Fonc.length;
					    // on coche/ decoche toutes les cases des individus
					    for (var i = 0;  i < len; i++)
					    {
					           var BN_chkbx = elems_Fonc[i];

					           if(this.checked)
					           {
					           	   BN_chkbx.checked= true;
					           }
					           else
					           {
					        	   BN_chkbx.checked= false;
					           }
					     }
					     
				    });				    
				});
		
	    function cocheBN_Fonc(fonctionID) 
	    { // clic sur la case cocher/decocher de la liste des individus d'une fonction du BN
	     	// Mozilla Chrome
		    if (document.getElementsByClassName)
		    {
		    	elems = document.getElementsByClassName('chkbxBN_Fonc');
			}
		    else
			//I.E
			{
			    elems = document.querySelectorAll('chkbxBN_Fonc');
			}
		    len = elems.length;

		    // on coche/ decoche toutes les cases des individus
		    for (var i = 0;  i < len; i++)
		    {
		           var BN_chkbx = elems[i];
					
//		           if (BN_chkbx.id == 'BN_Fonc_Ind'+fonctionID)
				   BN_id = BN_chkbx.id;
		           if (BN_id.lastIndexOf('BN_Fonc'+fonctionID) >= 0)
		           {	        	   
		           	   	elem_check = document.getElementById('BN'+fonctionID);
		           	   	elem_UIcheck = document.getElementById('UIBN'+fonctionID);
				           
		           	   	//on degrise la fonction courante
					   	elem_UIcheck.innerHTML = "";
		           	   	
		        	   	if (elem_check.checked == true)
		        	   		BN_chkbx.checked= true;
		           	   	else
		           	   		BN_chkbx.checked= false;
				   }
		     }

		    //si une des fonctions n'est pas cochée, on grise la case mère
		    //Si toutes les fonctions sont cochées on coche la case mère
		    //Si toutes les fonctions sont décochées on décoche la case mère
	     	// Mozilla Chrome
		    if (document.getElementsByClassName)
		    {
		    	elems = document.getElementsByClassName('chkbxBN');
			}
		    else
			//I.E
			{
			    elems = document.querySelectorAll('chkbxBN');
			}
		    len = elems.length;
		    var decoche = 0;
		    var coche = 0 ;
		    for (var i = 0;  i < len; i++)
		    {
		           var BN_chkbx = elems[i];
		           if (BN_chkbx.checked == true)
		        	   coche += 1;
		           else
			           decoche += 1;
		    }
		    var BN_chkbx_mere = document.getElementById('cocheToutBN');
		    var BN_UIchkbx_mere = document.getElementById('UIcocheToutBN');

		    //Si toutes les fonctions sont cochées on coche la case mère
		    if (coche == len)
		    {
		    	BN_UIchkbx_mere.innerHTML = "";
		    	BN_chkbx_mere.checked = true;
		    }
		    //Si toutes les fonctions sont décochées on décoche la case mère
		    if (decoche == len)
		    {
		    	BN_UIchkbx_mere.innerHTML = "";
		    	BN_chkbx_mere.checked = false;
			}
		    //si une des fonctions n'est pas cochée, on grise la case mère
		    if (decoche > 0 && coche > 0)
		    {
		    	BN_UIchkbx_mere.innerHTML = "x";
		    	BN_chkbx_mere.checked = true;
			}		    
	    }

	    function cocheBN_Ind(fonctionID) 
	    { // clic sur la case cocher/decocher de la liste des individus d'une fonction du BN
	     	// Mozilla Chrome
		    if (document.getElementsByClassName)
		    {
		    	elems = document.getElementsByClassName('chkbxBN_Fonc');
			}
		    else
			//I.E
			{
			    elems = document.querySelectorAll('chkbxBN_Fonc');
			}
		    len = elems.length;

		    // on coche/ decoche toutes les cases des individus
			var len_Fonc =0 ;
			var decoche = 0;
			var coche = 0 ;
		    for (var i = 0;  i < len; i++)
		    {
		           var BN_chkbx = elems[i];
					
				   BN_id = BN_chkbx.id;
				   if (BN_id.lastIndexOf('BN_Fonc'+fonctionID) >= 0)
		           {	
			           if (BN_chkbx.checked == true)
			        	   coche += 1;
			           else
				           decoche += 1;
			           len_Fonc += 1;        	   
		           }
		     }
		     
		    var BN_chkbx_mere = document.getElementById('BN'+fonctionID);
		    var BN_UIchkbx_mere = document.getElementById('UIBN'+fonctionID);
		    
		    //Si toutes les fonctions sont cochées on coche la case mère
		    if (coche == len_Fonc)
		    {
		    	BN_UIchkbx_mere.innerHTML = "";
		    	BN_chkbx_mere.checked = true;
		    }
		    //Si toutes les fonctions sont décochées on décoche la case mère
		    if (decoche == len_Fonc)
		    {
		    	BN_UIchkbx_mere.innerHTML = "";
		    	BN_chkbx_mere.checked = false;
			}
		    //si une des fonctions n'est pas cochée, on grise la case mère
		    if (decoche > 0 && coche > 0)
		    {
		    	BN_UIchkbx_mere.innerHTML = "x";
		    	BN_chkbx_mere.checked = true;
			}	

	     	// Mozilla Chrome
		    if (document.getElementsByClassName)
		    {
		    	elems = document.getElementsByClassName('chkbxBN');
			}
		    else
			//I.E
			{
			    elems = document.querySelectorAll('chkbxBN');
			}
		    len = elems.length;
		    var decoche = 0;
		    var coche = 0 ;
		    for (var i = 0;  i < len; i++)
		    {
		           var BN_chkbx = elems[i];
		           if (BN_chkbx.checked == true)
		        	   coche += 1;
		           else
			           decoche += 1;
		    }
		    var BN_chkbx_mere = document.getElementById('cocheToutBN');
		    var BN_UIchkbx_mere = document.getElementById('UIcocheToutBN');

		    //Si toutes les fonctions sont cochées on coche la case mère
		    if (coche == len)
		    {
		    	BN_UIchkbx_mere.innerHTML = "";
		    	BN_chkbx_mere.checked = true;
		    }
		    //Si toutes les fonctions sont décochées on décoche la case mère
		    if (decoche == len)
		    {
		    	BN_UIchkbx_mere.innerHTML = "";
		    	BN_chkbx_mere.checked = false;
			}
		    //si une des fonctions n'est pas cochée, on grise la case mère
		    if (decoche > 0 && coche > 0)
		    {
		    	BN_UIchkbx_mere.innerHTML = "x";
		    	BN_chkbx_mere.checked = true;
			}		    
				    
	    }
	    
		</script>


<!-- Plugin JQUERY Tools Tab -->
<script type="text/javascript"
	src="/admin/include/js/jquery/Tools_Tabs/tools.tabs-1.0.4.js"></script>
<!-- Show - Hide in same time -->

<link href="/admin/include/js/jquery/Tools_Tabs/css/tabs.css"
	rel="stylesheet" type="text/css" />
<style>
a:active {
	outline: none;
}

:focus {
	-moz-outline-style: none;
}

/* tab pane styling */
div.panes div {
	padding: 15px 10px;
	border: 1px solid #999;
	border-top: 0;
	font-size: 14px;
	background-color: #fff;
}
</style>
</head>
<body>

<?php
include_once '../../searchBar_inc.php';

if ($_SESSION ['ADMIN'] ['USER'] ['CONNECTED']) {
	// Connexion BDD
	include ('../../../config/configuration.php');
	require ('../../include/DbConnexion.php');

	$aListeOutlookManager = new ListeOutlookManager ();

	$aFonctionBNListe = new FonctionBNListe ();
	$aFonctionBNListe->select_all_fonctionbn ();
	$ListeBN = $aFonctionBNListe->getFonctionBNListe ();

	$aCommissionListe = new CommissionListe ();
	$ListeCommissions = $aCommissionListe->select_all_commission ();

	$aDomaineActiviteListe = new DomaineActiviteListe ();
	$aListeDomaines = $aDomaineActiviteListe->select_all_domaineactivite ();

	$aListeOutlookView = new ListeOutlookView ( $ListeBN, $ListeCommissions, $aListeDomaines );

	$aListeOutlookView->renderHTMLBN ();
	$aListeOutlookView->renderHTMLCOM ();

	// Deconnexion BDD
	require ('../../include/DbDeconnexion.php');
} else {
	// Formulaire de connexion
	$aff = '<script type="text/javascript">';
	$aff .= 'document.location.href="../../index.php";';
	$aff .= '</script>';
	echo $aff;
}
?>
</div>

	<div class="footerContainer">
		<a href="http://www.abakus.fr"><img
			src="../../include/images/Logo_AbaKus.png" width="100" border="0" /></a><br>
		AbaKus &copy; 2009 - 2012
	</div>

</body>
</html>