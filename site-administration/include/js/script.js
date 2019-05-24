function isset(variable){
	if(typeof(window[variable])!="undefined"){
		return true;
	}
	else {
		return false;
	}
}

function alert_travaux()
{
	alert('Cette fonctionnalit\351 est en cours de d\351veloppement!');
}

function checkForm(formName,fieldName)
{
	if(document.forms[formName][fieldName].value != "") 
	{
		return true;
	}
	else 
	{
		alert("Le champ '"+fieldName+"' ne peut \352tre vide !");
		return false;
	}
}

//Common

function verifEmail(myString) 
{
	var reg = /^([a-zA-Z0-9_-])+([.]?[a-zA-Z0-9_-]{1,})*@([a-zA-Z0-9-_]{2,}[.])+[a-zA-Z]{2,4}$/
	return (reg.exec(myString)!=null)
}

function verifCodePostal(myString)
{
   var reg = /^([0-9]{5,9})$/
   return (reg.exec(myString)!=null)
}

function verifTelephone(myString)
{
   var reg = /^([0]{1}[1-9]{1}[\.\- ]?[0-9]{2}[\.\- ]?[0-9]{2}[\.\- ]?[0-9]{2}[\.\- ]?[0-9]{2})$/
   return (reg.exec(myString)!=null)
}

function verifNumeric(myString)
{
   var reg = /^([0-9]+)$/
   return (reg.exec(myString)!=null)
}

function checkFormEtablissement()
{
	var result = true;
	var resultMessage = '';
	
	if(document.forms['EtablissementForm']['Telephone'].value!="")
	{
		if(!verifTelephone(document.forms['EtablissementForm']['Telephone'].value))
		{
			result = false;
			resultMessage = resultMessage+"le champ 'Telephone' est mal form\351\n";
		}
	}
	if(document.forms['EtablissementForm']['Fax'].value!="")
	{
		if(!verifTelephone(document.forms['EtablissementForm']['Fax'].value))
		{
			result = false;
			resultMessage = resultMessage+"le champ 'Fax' est mal form\351\n";
		}
	}
	
	if(document.forms['EtablissementForm']['Mail'].value!="")
	{
		if(!verifEmail(document.forms['EtablissementForm']['Mail'].value))
		{
			result = false;
			resultMessage = resultMessage+"le champ 'Mail' est mal form\351\n";
		}
	}
	if(document.forms['EtablissementForm']['RaisonSociale'].value=="")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Raison Sociale' ne peut \352tre vide\n";
	}
	if(document.forms['EtablissementForm']['Adresse1'].value=="")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Adresse 1' ne peut \352tre vide\n";
	}
	if(!verifCodePostal(document.forms['EtablissementForm']['CodePostal'].value))
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Code Postal' est mal form\351\n";
	}
	if(document.forms['EtablissementForm']['Ville'].value=="")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Ville' ne peut \352tre vide\n";
	}
	
	if(!verifNumeric(document.forms['EtablissementForm']['Effectifs'].value))
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Effectifs' doit \352tre numerique\n";
	}
	if(!verifNumeric(document.forms['EtablissementForm']['NombreVAR'].value))
	{
		result = false;
		resultMessage = resultMessage+"le champ 'NombreVAR' doit \352tre numerique\n";
	}
	if(!verifNumeric(document.forms['EtablissementForm']['NombreAgentsTotal'].value))
	{
		result = false;
		resultMessage = resultMessage+"le champ 'NombreAgentsTotal' doit \352tre numerique\n";
	}
	
	//Resultat final
	
	if(!result)
	{
		alert( "Certains champs ne sont pas corrects :\n"+resultMessage);
	}
	return result;
}

function checkFormIndividu()
{
	alert ('script');
	var result = true;
	var resultMessage = '';

	//Nom
	if(document.forms['IndividuForm']['Nom'].value=="")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Nom' ne peut \352tre vide\n";
	}
	//Prenom
	if(document.forms['IndividuForm']['Prenom'].value=="")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Pr\351nom' ne peut \352tre vide\n";
	}
	//telephone
	if(document.forms['IndividuForm']['Telephone'].value!="")
	{
		if(!verifTelephone(document.forms['IndividuForm']['Telephone'].value))
		{
			result = false;
			resultMessage = resultMessage+"le champ 'Telephone' est mal form\351\n";
		}
	}
	//Portable
	if(document.forms['IndividuForm']['TelephonePortable'].value!="")
	{
		if(!verifTelephone(document.forms['IndividuForm']['TelephonePortable'].value))
		{
			result = false;
			resultMessage = resultMessage+"le champ 'Telephone Portable' est mal form\351\n";
		}
	}
	//fax
	if(document.forms['IndividuForm']['Fax'].value!="")
	{
		if(!verifTelephone(document.forms['IndividuForm']['Fax'].value))
		{
			result = false;
			resultMessage = resultMessage+"le champ 'Fax' est mal form\351\n";
		}
	}
	//email
	if(document.forms['IndividuForm']['Mail'].value=="" || !verifEmail(document.forms['IndividuForm']['Mail'].value))
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Mail' est mal form\351 ou est vide\n";
	}
	//############
	//Domaine Activité
	if(isset('DomainActiviteID') && document.forms['IndividuForm']['DomainActiviteID'].value=="0")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Domaine Activit\351' ne peut \352tre vide\n";
	}
	//Fonction
	if(isset('FonctionDAID') && document.forms['IndividuForm']['FonctionDAID'].value=="0")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Fonction' de l'onglet 'Role' ne peut \352tre vide\n";
	}
	
	//Resultat final
	
	if(!result)
	{
		alert("Certains champs ne sont pas corrects : \n"+resultMessage);
	}
	return result;
}
